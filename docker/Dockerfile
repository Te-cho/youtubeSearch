FROM php:7.0.12-apache
COPY config/php7/php.ini /usr/local/etc/php/
RUN mkdir /y2search
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -; \
	apt-get update; \
	apt-get install -y nodejs; \
	apt-get install -y git; \
	npm install --global gulp;
RUN mv /var/www/html /var/www/html.old \
    && ln -s /y2search/public /var/www/html
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"
RUN chmod -R 777 /y2search/storage #make this optional, to not fail second time
#issue in kernel.php
    #purgeCahce and rebuild, caused an issue in LoadConfiguration.php
RUN chmod -R 777 /y2search/bootstrap/cache #make this optional, to not fail second time
#ln storage/log to var/logs
