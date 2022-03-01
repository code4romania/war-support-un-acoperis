.PHONY: start
start:
	docker-compose up -d

.PHONY: stop
stop:
	docker-compose down

.PHONY: build
build:
	docker-compose build

.PHONY: install
install:
	docker-compose up -d
	docker-compose exec php sh -c 'composer install'
	docker-compose exec php sh -c 'php artisan migrate --seed'
	docker-compose exec nodejs sh -c 'npm ci && npm run dev'

.PHONY: logs
logs:
	docker-compose logs -f

.PHONY: shell
shell:
	docker-compose exec php bash

.PHONY: migrate
migrate:
	docker-compose exec php sh -c 'php artisan migrate'

.PHONY: migrate-f
migrate-f:
	docker-compose exec php sh -c 'php artisan migrate --force'

.PHONY: seed
seed:
	docker-compose exec php sh -c 'php artisan db:seed'

.PHONY: cc
cc:
	docker-compose exec php sh -c 'php artisan ca:cl'

.PHONY: npm-watch
npm-watch:
	docker-compose exec nodejs sh -c 'npm run watch'
