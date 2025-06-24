FROM composer:latest AS composer

FROM php:8.2-apache

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    unzip git curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring

# Install Node.js (untuk Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Set working dir
WORKDIR /var/www/html

# Copy project
COPY . .

# Install composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install dep Laravel
RUN composer install --optimize-autoloader --no-dev

# Install frontend dep & build Vite
RUN npm install && npm run build

# Apache mod_rewrite
RUN a2enmod rewrite

# Set izin folder storage/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Konfigurasi Apache
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80
