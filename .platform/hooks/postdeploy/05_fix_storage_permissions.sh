#!/bin/bash
sudo docker exec $(sudo docker ps -q) chown -R www-data:www-data /var/www/html/storage
