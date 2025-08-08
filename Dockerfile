FROM php:8.3-fpm

# Instalar extensiones necesarias para Laravel + PostgreSQL
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libpng-dev libjpeg-dev libfreetype6-dev locales \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip gd bcmath \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copia y prepara Laravel
#COPY ./src /var/www

# Copiar solo composer.* primero para aprovechar la cache de Docker
COPY composer.json composer.lock ./

# Instalar dependencias de PHP sin ejecutar scripts de Laravel
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts --no-autoloader

# Instala dependencias ignorando la comprobación de root
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --ignore-platform-reqs --no-interaction --prefer-dist \
    && chmod -R 775 storage bootstrap/cache \
    && chown -R www-data:www-data .
# Ahora copiamos todo el código
COPY . .

CMD ["php-fpm"]
