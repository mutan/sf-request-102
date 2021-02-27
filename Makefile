.DEFAULT_GOAL := default

dockerdir := docker
docker-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/docker-compose.yml
php-cli-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/php-cli-docker-compose.yml
php-cli-compose-run := $(php-cli-compose) run --rm php-cli

default:
	@echo "make up"

# Example: make run bash
run:
	@$(php-cli-compose-run) $(filter-out $@,$(MAKECMDGOALS))

up:
	@make down
	@make build
	$(docker-compose) up -d --remove-orphans

down:
	$(docker-compose) down
	$(php-cli-compose) down

build:
	$(docker-compose) build
	$(php-cli-compose) build

rebuild:
	$(docker-compose) build --pull --no-cache
	$(php-cli-compose) build --pull --no-cache

logs:
	$(docker-compose) logs -f

migrate:
	$(php-cli-compose) run --rm php-fpm bin/console doctrine:migrations:migrate --no-interaction
