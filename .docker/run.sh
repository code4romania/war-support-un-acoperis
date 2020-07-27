#!/usr/bin/env bash

php artisan route:cache
php artisan view:cache
php artisan config:cache
php artisan event:cache

php artisan migrate --force

/usr/bin/supervisord
