FROM php:7.1-fpm

RUN apt-get update \
    && apt-get install -y libpq-dev libpng-dev libssl-dev libcurl4-openssl-dev pkg-config \
    && rm -rf /var/lib/apt/lists/*

RUN apt-get install -y libpng-dev

RUN docker-php-ext-install \
        bcmath \
        mbstring \
        zip \
        curl \
        opcache \
        gd \
        pdo pdo_mysql

RUN yes | pecl install apcu xdebug-beta \
        && echo "extension=apcu.so" > /usr/local/etc/php/conf.d/apcu.ini \
        && echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/apcu.ini \
        && echo "zend_extension=xdebug.so" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini

RUN apt-get update \
 && apt-get install -y cron \
 && rm -rf /var/lib/apt/lists/*


WORKDIR /app

COPY . /app/

RUN php composer.phar install