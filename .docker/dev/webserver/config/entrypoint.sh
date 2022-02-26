#!/bin/bash

## setup .env if it does not exist
if [ ! -f ".env" ]
then
  cp .env.example .env
  chown 1000:1000 .env
fi

## install composer dependencies if the vendor dir doesn't exist
[ -d "vendor" ] && composer install

## generate app-key if it doesn't exist
if ! grep -q APP_KEY=base64 .env
then
  php artisan key:generate
fi

## Start supervisord
/usr/bin/supervisord
