.DEFAULT_GOAL := defaultntainer

docker-compose := docker-compose -f docker-compose.yml -f docker-compose.override.yml

default:
	@echo "make up"

up:
	@make down
	$(docker-compose) build
	$(docker-compose) up -d --remove-orphans

rebuild:
	$(docker-compose) build --pull --no-cache

down:
	$(docker-compose) down

logs:
	$(docker-compose) logs -f

migrate:
	$(docker-compose) run --rm php-fpm bin/console doctrine:migrations:migrate --no-interaction

container-php:
	docker container exec -it app-php-fpm bash