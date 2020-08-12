#!/bin/bash
sudo docker exec $(sudo docker ps -q) php artisan route:cache
sudo docker exec $(sudo docker ps -q) php artisan view:cache
sudo docker exec $(sudo docker ps -q) php artisan config:cache
sudo docker exec $(sudo docker ps -q) php artisan event:cache
