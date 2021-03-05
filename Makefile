.DEFAULT_GOAL := help

# Mark targets that do not represent physical files in the file system
.PHONY: help run
.PHONY: up down build rebuild logs
.PHONY: migrate tests unit functional style

# Define constants
dockerdir := docker
docker-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/docker-compose.yml
php-cli-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/php-cli-docker-compose.yml
php-cli-compose-run := $(php-cli-compose) run --rm --name=app-php-cli php-cli

# Some explanations
# To escape a dollar sign $ in a makefile, you have to double it
# %-30s minus indicates left alignment, 30 is the "field width"
# \033[32m green color
# \033[33m yellow color
# \033[0m reset color
help:
	@tail -n +2 $(MAKEFILE_LIST) | \
		grep -E '(^##)|(^[a-zA-Z_-]+:\s+##.*$$)' | \
		awk 'BEGIN {FS = ": ## "}; {printf "\033[32m%-15s\033[0m %s\n", $$1, $$2}' | \
		sed -e 's/\[32m## /[33m/'

## Docker main containers

up: ## Down, then build and up main containers
	@make down
	@make build
	$(docker-compose) up -d --remove-orphans

down: ## Down main containers
	$(docker-compose) down

build: ## Build main containers
	$(docker-compose) build
	$(php-cli-compose) build

rebuild: ## Pull images and rebuild main containers without using cache
	$(docker-compose) build --pull --no-cache
	$(php-cli-compose) build --pull --no-cache

logs: ## See docker-compose logs
	$(docker-compose) logs -f

## Docker php-cli container

run: ## Run commands inside php-cli container. Example: make run bash OR make run bin/console make:migration
	@$(php-cli-compose-run) $(filter-out $@, $(MAKECMDGOALS))

migrate: ## Migrate
	$(php-cli-compose-run) bin/console doctrine:migrations:migrate --no-interaction

## Tests and style

tests: ## Run all tests in project
	$(php-cli-compose-run) bin/phpunit --testdox

unit: ## Run unit tests
	$(php-cli-compose-run) bin/phpunit --testdox --testsuite "Unit Test Suite"

func: ## Run functional tests
	$(php-cli-compose-run) bin/phpunit --testdox --testsuite "Functional Test Suite"

style: ## Run CS Fixer to fix style
	$(php-cli-compose-run) vendor/bin/php-cs-fixer fix -vvv