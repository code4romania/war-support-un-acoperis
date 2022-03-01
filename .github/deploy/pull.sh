set -e

cd ../..
git reset --hard HEAD
git pull

docker-compose -f docker-compose.stage.yml build
docker-compose -f docker-compose.stage.yml up -d

make migrate-f
