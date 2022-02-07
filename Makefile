COMPOSE=$(shell docker compose ps &> /dev/null; if [ $$? == 0 ]; then echo "docker compose"; else echo "docker-compose"; fi)

up:
	$(COMPOSE) up -d --build

down:
	$(COMPOSE) down --remove-orphans

run:
	$(COMPOSE) up --build

restart: down up

network:
	docker network create ftvlab

sh-php:
	$(COMPOSE) exec php /bin/sh

sh-front:
	$(COMPOSE) exec php /bin/sh

first-init: network up php-install php-mix

php-install:
	$(COMPOSE) exec php make nova-authenticate
	$(COMPOSE) exec php composer install
	$(COMPOSE) exec php npm install

php-mix:
	$(COMPOSE) exec php npm run dev

php-cache:
	$(COMPOSE) exec php php artisan responsecache:clear

php-clean-restart:
	$(COMPOSE) exec php php artisan config:clear
	$(COMPOSE) exec php php artisan cache:clear
	$(COMPOSE) exec php php artisan responsecache:clear
	$(COMPOSE) stop php web
	$(COMPOSE) up -d php web
