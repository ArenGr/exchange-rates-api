FROM php:8.4-apache

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV APACHE_ALLOW_SUPERUSER=1

RUN apt-get update && apt-get install -y \
    libsqlite3-dev \
    curl \
    git \
    unzip \
    && docker-php-ext-install pdo_sqlite \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && rm -rf /var/lib/apt/lists/*

COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/

RUN composer install --no-scripts --no-interaction --optimize-autoloader

RUN a2enmod rewrite
RUN service apache2 restart

ENV APACHE_DOCUMENT_ROOT /var/www/html
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

COPY . .

RUN chmod -R 775 /var/www/html/database && \
    chown -R www-data:www-data /var/www/html/database

WORKDIR /var/www/html

COPY --chown=www-data . /var/www/html/