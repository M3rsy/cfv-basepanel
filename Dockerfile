FROM php:8.2-fpm

# Instala extensiones necesarias
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www

# Copia el código fuente del proyecto
COPY ./src /var/www

# Instala las dependencias de Laravel
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data .
    