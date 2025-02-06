FROM dcr.at.gsmpay.cloud/base/api/php:8.2-fpm-alpine

RUN apk add --no-cache mariadb-client mariadb-connector-c

COPY --chown=www-data:www-data docker/php/99-php.ini /usr/local/etc/php/conf.d/99-php.ini

USER www-data
COPY --chown=www-data:www-data ./composer.json ./composer.json
COPY --chown=www-data:www-data ./composer.lock ./composer.lock
COPY --chown=www-data:www-data ./packages ./packages
RUN composer install
COPY --chown=www-data:www-data . .
COPY --chown=www-data:www-data .env.testing.example .env.testing
RUN composer run-script post-install
RUN composer dump-autoload
