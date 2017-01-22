FROM php:7.0-apache
COPY config/php7/php.ini /usr/local/etc/php/
RUN mkdir /y2search
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -; \
	apt-get install -y nodejs; \
	npm install --global gulp;
RUN mv /var/www/html /var/www/html.old \
    && ln -s /y2search/public /var/www/html
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '55d6ead61b29c7bdee5cccfb50076874187bd9f21f65d8991d46ec5cc90518f447387fb9f76ebae1fbbacf329e583e30') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/bin
RUN php -r "unlink('composer-setup.php');"
RUN mv /bin/composer.phar /bin/composer
