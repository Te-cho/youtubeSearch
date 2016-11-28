FROM php:7.0-apache
COPY config/php7/php.ini /usr/local/etc/php/
RUN mkdir /y2search
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -; \
	apt-get install -y nodejs; \
	npm install --global gulp;
RUN mv /var/www/html /var/www/html.old \
    && ln -s /y2search/public /var/www/html