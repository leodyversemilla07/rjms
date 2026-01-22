# Multi-stage build for RJMS (Research Journal Management System)

# Stage 1: Build CSS assets with Node.js
FROM node:18-alpine AS asset-builder

WORKDIR /app

# Copy package files
COPY package*.json ./
COPY build-css.js ./
COPY postcss.config.js ./

# Install Node.js dependencies
RUN npm ci --only=production

# Copy CSS source files
COPY resources/css ./resources/css

# Build production CSS
RUN npm run build

# Stage 2: PHP Application
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
    && docker-php-ext-install \
    pdo_mysql \
    mbstring \
    xml \
    fileinfo \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Copy application code
COPY . .

# Copy built CSS from asset-builder stage
COPY --from=asset-builder /app/public/css/tailwind.css ./public/css/tailwind.css

# Create necessary directories and set permissions
RUN mkdir -p uploads/submissions logs \
    && chown -R www-data:www-data uploads logs public/css \
    && chmod -R 775 uploads logs public/css

# Configure PHP-FPM
RUN echo "upload_max_filesize = 10M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 10M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini \
    && echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/uploads.ini

# Configure OPcache for production
RUN echo "opcache.enable=1" > /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# Expose PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
