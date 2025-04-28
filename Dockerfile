FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    && docker-php-ext-install pdo_sqlite

RUN a2enmod rewrite
RUN service apache2 restart

ENV APACHE_DOCUMENT_ROOT /var/www/html
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

RUN mkdir -p /var/www/html /.composer && chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html

COPY --chown=www-data . /var/www/html/

COPY . .
