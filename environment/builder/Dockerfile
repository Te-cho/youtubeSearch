FROM php:7.1.1-fpm-alpine

RUN apk update \
    && apk add git zip unzip \
    #node
    && apk add nodejs=6.7.0-r0 \
    #composer
    && mkdir -p /usr/local/bin/ \
    && curl -s -o installer.php "https://getcomposer.org/installer" \
    && php installer.php --install-dir=/usr/local/bin --filename=composer \
    && rm -f installer.php \
    && composer global require "hirak/prestissimo:^0.3"
