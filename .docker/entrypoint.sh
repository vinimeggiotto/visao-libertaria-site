#!/usr/bin/env bash
set -e

if [ ! -f ".env" ]; then
    cp env.docker .env
fi

composer install

exec php-fpm
