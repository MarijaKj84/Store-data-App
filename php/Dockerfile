FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
WORKDIR /var/www/html
COPY ./src/index.php index.php
COPY ./src/insert.php insert.php
EXPOSE 80
