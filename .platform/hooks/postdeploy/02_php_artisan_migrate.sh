#!/bin/bash
sudo docker exec $(sudo docker ps -q) php artisan migrate --force
