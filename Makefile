all: run tests showcase down

run:
	@docker-compose build
	@docker-compose up -d
	@sleep 5
	@docker-compose exec php composer install -o -a -n
	@docker-compose exec php bin/console doctrine:schema:update --force

bash:
	@docker-compose exec php bash

tests:
	@docker-compose exec php vendor/bin/psalm.phar
	@docker-compose exec php bin/phpunit

showcase:
	@docker-compose exec php bin/console app:author:add --name=John --email=john@email.local
	@docker-compose exec php bin/console app:author:get --email=john@email.local

down:
	@docker-compose down
