FROM php:7.2-apache

RUN apt-get update && apt-get install -y

RUN docker-php-ext-install mysqli pdo_mysql

COPY src/ /var/www/html/

USER root
RUN chown root:root -R /var/www/html/
RUN chmod -R 777 /var/www/html/