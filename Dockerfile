FROM php:8-cli

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd zip
RUN mkdir public

EXPOSE 8000

CMD ["php","-S","0.0.0.0:8000","-t","/var/www/public"]
