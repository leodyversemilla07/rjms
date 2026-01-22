# Multi-stage build for better caching
FROM php:8.3-fpm-alpine AS base

LABEL maintainer="RJMS Team"
LABEL description="RJMS Development Environment - PHP-FPM with Xdebug"
LABEL version="2.0"

# Set build arguments for flexibility
ARG XDEBUG_VERSION=3.4.0

# Install system dependencies and PHP extensions in one layer
RUN apk add --no-cache \
    bash \
    git \
    curl \
    wget \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    mysql-client \
    fcgi \
    # Clean up to reduce image size
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    mbstring \
    xml \
    fileinfo \
    zip \
    opcache \
    && rm -rf /tmp/*

# Development stage with Xdebug
FROM base AS development

# Install Xdebug for development
RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    linux-headers \
    && pecl install xdebug-${XDEBUG_VERSION} \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps \
    && rm -rf /tmp/pear

# Install Composer 2 from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure composer for better dev performance
RUN composer config -g process-timeout 3600 \
    && composer config -g cache-dir /root/.composer/cache \
    && mkdir -p /root/.composer/cache

# Set working directory
WORKDIR /var/www/html

# Copy custom PHP configuration (before app code for better caching)
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Configure Xdebug for development
RUN { \
    echo 'xdebug.mode=develop,debug,coverage'; \
    echo 'xdebug.client_host=host.docker.internal'; \
    echo 'xdebug.client_port=9003'; \
    echo 'xdebug.start_with_request=yes'; \
    echo 'xdebug.log=/var/log/xdebug.log'; \
    echo 'xdebug.log_level=0'; \
    echo 'xdebug.idekey=VSCODE'; \
    echo 'xdebug.discover_client_host=false'; \
} > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Create necessary directories with proper permissions
RUN mkdir -p \
    /var/www/html/storage/sessions \
    /var/www/html/storage/logs \
    /var/www/html/uploads \
    && chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/uploads

# Copy healthcheck script
RUN echo '#!/bin/sh' > /usr/local/bin/php-fpm-healthcheck \
    && echo 'SCRIPT_NAME=/ping SCRIPT_FILENAME=/ping REQUEST_METHOD=GET cgi-fcgi -bind -connect 127.0.0.1:9000 || exit 1' >> /usr/local/bin/php-fpm-healthcheck \
    && chmod +x /usr/local/bin/php-fpm-healthcheck

# Health check for PHP-FPM
HEALTHCHECK --interval=20s --timeout=3s --start-period=30s --retries=3 \
    CMD php-fpm-healthcheck || exit 1

# Don't copy app code here - mounted via volume for hot-reloading

# Expose PHP-FPM port
EXPOSE 9000

# Use exec form for better signal handling
CMD ["php-fpm", "-F"]
