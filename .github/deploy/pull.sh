set -e

cd /home/ec2-user/war-support-un-acoperis
git reset --hard HEAD
git pull

docker-compose -f docker-compose.stage.yml build --build-arg ENVIRONMENT=production
docker-compose -f docker-compose.stage.yml up -d

make migrate-f
