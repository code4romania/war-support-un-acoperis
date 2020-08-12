#!/bin/bash
sudo docker exec $(sudo docker ps -q) scout:import App\\Clinic
sudo docker exec $(sudo docker ps -q) scout:import App\\HelpRequest
