#!/bin/bash

## setup .env if it does not exist
if [ ! -f ".env" ]
then
  cp .env.example .env
  chown 1000:1000 .env
fi

## install composer dependencies if the vendor dir doesn't exist
[ ! -d "vendor" ] && composer install

## generate app-key if it doesn't exist
if ! grep -q APP_KEY=base64 .env
then
  php artisan key:generate
fi

# add captcha keys if they don't exist
if [ ! $(cat .env | grep NOCAPTCHA_SECRET | sed 's/NOCAPTCHA_SECRET=//') ]; then
  sed -i 's/NOCAPTCHA_SECRET=/NOCAPTCHA_SECRET=6LeHnKEeAAAAAAc83Y09CX4kIE0eu92lW-29ZhsI/' .env
  sed -i 's/NOCAPTCHA_SITEKEY=/NOCAPTCHA_SITEKEY=6LeHnKEeAAAAAOqo6kw0ksQESiPwic7KO1Ao_1tq/' .env
fi

## Start supervisord
/usr/bin/supervisord
