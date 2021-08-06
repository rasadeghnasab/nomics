SAIL=bash ./vendor/bin/sail

# Colors
GREEN=\033[0;32m
BOLD_GREEN=\033[1;32m

ADDRESS=http://localhost

project: install
	$(SAIL) up -d
	$(SAIL) artisan key:generate
	$(SAIL) artisan migrate:refresh --seed
	$(SAIL) artisan passport:install --force
	$(SAIL) artisan optimize:clear
	cp .env.example .env
	@echo Visit: "${BOLD_GREEN} ${ADDRESS}"

install:
	docker run --rm \
	-u "$(id -u):$(id -g)" \
	-v $(pwd):/opt \
	-w /opt \
	laravelsail/php80-composer:latest \
	composer install --ignore-platform-reqs

dev:
	$(SAIL) up

dev-stop:
	$(SAIL) down

purge:
	$(SAIL) down -v
