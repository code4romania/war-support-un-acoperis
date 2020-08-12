#!/bin/bash
sudo docker exec $(sudo docker ps -q) php artisan scout:import App\\Clinic
sudo docker exec $(sudo docker ps -q) php artisan scout:import App\\HelpRequest
