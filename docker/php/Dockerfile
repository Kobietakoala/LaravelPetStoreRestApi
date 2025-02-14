FROM php:8.4-fpm-alpine

ADD ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN docker-php-ext-install pdo pdo_mysql

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

COPY --from=composer/composer:latest-bin /composer /usr/local/bin/composer

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

ADD ./src/ .
COPY ./.env .

RUN chown -R laravel:laravel /var/www/html