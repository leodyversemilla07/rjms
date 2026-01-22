# Development Dockerfile with hot-reloading support
FROM php:8.3-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    mysql-client \
    nodejs \
    npm \
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    xml \
    fileinfo

# Install Xdebug for development
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

# Configure Xdebug
RUN echo "xdebug.mode=develop,debug" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies (including dev dependencies)
RUN composer install --optimize-autoloader --no-interaction --no-progress

# Copy custom PHP configuration
COPY docker/php/php.ini /usr/local/etc/php/conf.d/custom.ini

# Create session directory
RUN mkdir -p /var/www/html/storage/sessions && chmod 777 /var/www/html/storage/sessions

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
