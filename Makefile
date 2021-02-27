.DEFAULT_GOAL := defaultntainer

dockerdir := docker
docker-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/docker-compose.yml
cli-compose := docker-compose --env-file=$(dockerdir)/.env -f $(dockerdir)/php-cli-docker-compose.yml

default:
	@echo "make up"

up:
	@make down
	$(docker-compose) build
	$(docker-compose) up -d --remove-orphans
	$(cli-compose) build
	$(cli-compose) up -d --remove-orphans

rebuild:
	$(docker-compose) build --pull --no-cache

down:
	$(docker-compose) down

logs:
	$(docker-compose) logs -f

migrate:
	$(docker-compose) run --rm php-fpm bin/console doctrine:migrations:migrate --no-interaction
