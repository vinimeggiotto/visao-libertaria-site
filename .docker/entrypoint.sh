#!/usr/bin/env bash
set -e

if [ ! -f ".env" ]; then
    cp env.docker .env
fi

composer install

php -S 0.0.0.0:80 -t /var/www/localhost/htdocs /var/www/localhost/htdocs/.docker/router.php
