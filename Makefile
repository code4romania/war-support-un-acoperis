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
	$(shell test ! -e .env && cp .env.example .env)
	docker-compose up -d
	docker-compose exec php sh -c 'composer install'
	docker-compose exec php sh -c 'php artisan migrate --seed'
	docker-compose exec php sh -c 'php artisan key:generate'

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

.PHONY: migrate-stage
migrate-stage:
	docker-compose -f docker-compose.stage.yml exec php sh -c 'php artisan migrate --force'

.PHONY: seed
seed:
	docker-compose exec php sh -c 'php artisan db:seed'

.PHONY: cc
cc:
	docker-compose exec php sh -c 'php artisan ca:cl'

.PHONY: generate-key
generate-key:
	docker-compose exec php sh -c 'php artisan key:generate'

.PHONY: npm-watch
npm-watch:
	docker-compose run --rm nodejs sh -c 'npm run watch'

.PHONY: clean
clean:
	$(shell test ! -e .env && cp .env.example .env)
	docker-compose down --volumes --remove-orphans --rmi=all
	git clean -fdx -e .env
