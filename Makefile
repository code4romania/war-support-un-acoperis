bootstrap: migrate seed
	npm install && npm run dev

start:
	docker-compose up -d

stop:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f

shell:
	docker exec -it helpforhealth_web bash

migrate:
	docker exec helpforhealth_web bash -c "php artisan migrate"

seed:
	docker exec helpforhealth_web bash -c "php artisan db:seed"

cc:
	docker exec helpforhealth_web bash -c "php artisan ca:cl"

.PHONY: bootstrap start stop build logs shell migrate seed cc
