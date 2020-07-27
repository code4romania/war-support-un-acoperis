#!/usr/bin/env bash

php artisan optimize:clear

php artisan migrate

/usr/bin/supervisord
