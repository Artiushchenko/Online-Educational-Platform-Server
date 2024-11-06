FROM php:8.2-fpm-alpine

RUN apk --no-cache update \
    && apk --no-cache add \
        autoconf \
        g++ \
        make \
        openssl-dev

RUN pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/app
