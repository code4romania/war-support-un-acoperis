#!/usr/bin/env sh

set -e

cd /home/ec2-user/app
git reset --hard HEAD
git pull

docker-compose -f docker-compose.yml build
docker-compose -f docker-compose.yml up -d

# make migrate-stage
