FROM php:8.3-fpm

# Instalar extensiones necesarias para Laravel + PostgreSQL
RUN apt-get update && apt-get install -y --no-install-recommends \
    curl \
    unzip \
    libpq-dev \
    libonig-dev \
    libssl-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) \
    pdo_mysql \
    pdo_pgsql \
    pgsql \
    opcache \
    intl \
    zip \
    bcmath \
    soap \
    && pecl install redis xdebug \
    && docker-php-ext-enable redis xdebug\
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get autoremove -y && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/*


WORKDIR /var/www
# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia y prepara Laravel
COPY . /var/www

# Copiar solo composer.* primero para aprovechar la cache de Docker
COPY composer.json ./

# Instalar dependencias de PHP sin ejecutar scripts de Laravel
RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist --no-scripts --no-autoloader

# Ahora copiamos todo el código
COPY . .
# Instala dependencias ignorando la comprobación de root
#RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --ignore-platform-reqs --no-interaction --prefer-dist \
     ##chmod -R 775 storage bootstrap/cache \
     ## +chown -R www-data:www-data .


CMD ["php-fpm"]
