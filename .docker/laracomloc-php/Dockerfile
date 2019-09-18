FROM php:7.2-fpm
MAINTAINER Marc Pont <slayerbleast@gmail.com>
RUN apt-get update && apt-get install -y git zlib1g-dev libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng-dev
RUN apt-get update && apt-get install -y \
    libjpeg62-turbo-dev \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gmp \
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo pdo_mysql zip gd