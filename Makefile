.DEFAULT_GOAL := default

# Mark targets that do not represent physical files in the file system
.PHONY: default run up down build rebuild logs migrate

# Define constants
dockerdir := docker
docker-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/docker-compose.yml
php-cli-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/php-cli-docker-compose.yml
php-cli-compose-run := $(php-cli-compose) run --rm --name=app-php-cli php-cli

default:
	@echo "make up"

# Run commands inside php-cli container
# Example: make run bash OR make run bin/console make:migration
run:
	@$(php-cli-compose-run) $(filter-out $@, $(MAKECMDGOALS))

up:
	@make down
	@make build
	$(docker-compose) up -d --remove-orphans

down:
	$(docker-compose) down

build:
	$(docker-compose) build
	$(php-cli-compose) build

rebuild:
	$(docker-compose) build --pull --no-cache
	$(php-cli-compose) build --pull --no-cache

logs:
	$(docker-compose) logs -f

migrate:
	$(php-cli-compose-run) bin/console doctrine:migrations:migrate --no-interaction
