.PHONY: bootstrap
bootstrap: migrate seed
	npm install && npm run dev

.PHONY: start
start:
	docker-compose up -d

.PHONY: stop
stop:
	docker-compose down

.PHONY: build
build:
	docker-compose build

.PHONY: logs
logs:
	docker-compose logs -f

.PHONY: shell
shell:
	docker exec -it helpforhealth_web bash

.PHONY: migrate
migrate:
	docker exec helpforhealth_web bash -c "php artisan migrate"

.PHONY: seed
seed:
	docker exec helpforhealth_web bash -c "php artisan db:seed"

.PHONY: cc
cc:
	docker exec helpforhealth_web bash -c "php artisan ca:cl"
