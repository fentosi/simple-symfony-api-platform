COMPOSER ?= composer
PHP = php

up:
	$(COMPOSER) install

clear:
	@echo "Clear cache and logs"
	rm -rf var/cache/*
	rm -rf var/logs/*

db:
	$(PHP) bin/console doctrine:database:drop --force
	$(PHP) bin/console doctrine:database:create
	$(PHP) bin/console doctrine:schema:update --force
	$(PHP) bin/console doctrine:fixtures:load -n

sf-clear:
	@echo "Symfony cache clear"
	$(PHP) bin/console cache:clear
	$(PHP) bin/console cache:warmup


test: clear sf-clear
	./bin/phpunit

validate: clear config sf-clear
	$(COMPOSER) validate --strict
	./bin/console doctrine:schema:validate --skip-sync -vvv --no-interaction

security: clear sf-clear
	./bin/console security:check --end-point=https://security.sensiolabs.org/check_lock

.PHONY: clear sf-clear validate security

