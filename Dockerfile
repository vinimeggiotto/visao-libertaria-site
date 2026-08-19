FROM php:8.2-cli-alpine

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache bash \
    && install-php-extensions mysqli pdo_mysql intl gd mbstring exif opcache redis @composer

COPY .docker/php-uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY .docker/php-opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www/localhost/htdocs

COPY .docker/entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
