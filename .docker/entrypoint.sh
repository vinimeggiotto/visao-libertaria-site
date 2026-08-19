#!/usr/bin/env bash
set -e

if [ ! -f ".env" ]; then
    cp env.docker .env
fi

composer install

mkdir -p writable/debugbar
chmod 0777 writable/debugbar

exec php-fpm
