start:
	docker-compose up -d

stop:
	docker-compose down

build:
	docker-compose build

install:
	docker-compose up -d
	docker-compose exec php sh -c 'composer install'
	docker-compose exec php sh -c 'php artisan migrate --seed'
	docker-compose exec nodejs sh -c 'npm ci && npm run dev'

logs:
	docker-compose logs -f

shell:
	docker-compose exec php bash

migrate:
	docker-compose exec php sh -c 'php artisan migrate'

migrate-f:
	docker-compose exec php sh -c 'php artisan migrate --force'

migrate-stage:
	docker-compose -f docker-compose.stage.yml exec php sh -c 'php artisan migrate --force'

seed:
	docker-compose exec php sh -c 'php artisan db:seed'

cc:
	docker-compose exec php sh -c 'php artisan ca:cl'

npm-watch:
	docker-compose exec nodejs sh -c 'npm run watch'
