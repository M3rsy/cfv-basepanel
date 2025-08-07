FROM php:8.2-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia y prepara Laravel
COPY ./src /var/www

# Instala dependencias
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist \
    && chmod -R 755 /var/www/storage \
    && chown -R www-data:www-data /var/www