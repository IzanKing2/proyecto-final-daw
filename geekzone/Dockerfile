FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev \
    libxml2-dev libzip-dev zip unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo_mysql mbstring exif pcntl bcmath gd zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN a2enmod rewrite

COPY docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html