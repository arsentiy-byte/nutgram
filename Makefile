build-and-up: build up composer-install check-env
 	- docker-compose -f docker-compose.yml exec php php artisan optimize:clear

build:
	- docker-compose -f docker-compose.yml build && docker-compose -f docker-compose.yml pull

up:
	- docker-compose -f docker-compose.yml up -d

down:
	- docker-compose -f docker-compose.yml down

composer-install:
	- docker-compose -f docker-compose.yml exec php composer install

clean-dependencies:
	- rm -rf vendor

check-env:
ifeq (,$(wildcard ./.env))
	cp .env.example .env
endif

pint-test:
	- docker-compose -f docker-compose.yml exec php vendor/bin/pint --test --dirty --config pint.json

pint:
	- docker-compose -f docker-compose.yml exec php vendor/bin/pint --config pint.json

phpstan:
	- docker-compose -f docker-compose.yml exec php vendor/bin/phpstan analyse -c phpstan.neon

test:
	- docker-compose -f docker-compose.yml exec php vendor/bin/phpunit

swagger:
	- docker-compose -f docker-compose.yml exec php php artisan l5-swagger:generate

polling:
	- docker-compose -f docker-compose.yml exec php php artisan nutgram:hook:remove -d
	- docker-compose -f docker-compose.yml exec php php artisan nutgram:run

set-webhook:
	- docker-compose -f docker-compose.yml exec php php artisan nutgram:hook:set $(host)/api/webhook
