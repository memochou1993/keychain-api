FROM php:7.2-fpm

RUN apt-get update \
    && apt-get -y install zip

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www

RUN composer install --optimize-autoloader --no-dev --no-scripts

RUN chown -R www-data:www-data \
    /var/www/storage \
    /var/www/bootstrap/cache

RUN apt-get install -y libmcrypt-dev \
    libmagickwand-dev --no-install-recommends \
    && pecl install mcrypt-1.0.2 \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-enable mcrypt
