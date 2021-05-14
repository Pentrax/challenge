# Prerequisito: https://docs.docker.com/engine/install/
#Ejecutar este comando desde una consola de Linux en la raiz del proyecto docker-compose up -d --build
FROM php:7.4.1-apache
LABEL autor="SG"

USER root

# CARPETA DE APP EN EL CONTENEDOR
WORKDIR /var/www/html

# Instala las dependencias y extenciones requeridas por Laravel
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# COPIAR DEPENDENCIAS
COPY composer.json ./
COPY composer.lock ./

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
