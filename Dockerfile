FROM php:8.1 as php

RUN apt update -y
RUN apt install -y unzip libpq-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath

RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8080
ENTRYPOINT ["Docker/entrypoint.sh"]