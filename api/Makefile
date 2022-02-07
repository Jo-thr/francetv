reset:
	php artisan db:wipe
	php artisan migrate:fresh
	php artisan db:seed
	php artisan ftv:user:dev

fix:
	php artisan fixer:fix

test:
	APP_ENV=testing make reset
	php artisan test

down:
	docker-compose exec php chmod -R 777 storage/
	docker-compose exec php chmod -R 777 public/
	docker-compose exec php chmod -R 777 bootstrap/cache

nova-authenticate:
	composer config http-basic.nova.laravel.com $$COMPOSER_NOVA_USERNAME $$COMPOSER_NOVA_PASSWORD
