FROM ubuntu:16.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get install -y \
        ca-certificates \
        php \
        php-xdebug \
        php-dom \
        php-mbstring \
        php-curl \
        git \
        zip \
    && php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm /tmp/composer-setup.php

RUN mkdir /app

RUN adduser --disabled-password --gecos "" dev
RUN chown dev -R /app

WORKDIR /app
USER dev