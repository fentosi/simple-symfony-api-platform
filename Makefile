COMPOSER ?= composer
PHP = php

up:
	$(COMPOSER) install

clear:
	@echo "Clear cache and logs"
	rm -rf var/cache/*
	rm -rf var/logs/*

sf-clear:
	@echo "Symfony cache clear"
	$(PHP) bin/console cache:clear
	$(PHP) bin/console cache:warmup


validate: clear config sf-clear
	$(COMPOSER) validate --strict
	./bin/console doctrine:schema:validate --skip-sync -vvv --no-interaction

security: clear sf-clear
	./bin/console security:check --end-point=https://security.sensiolabs.org/check_lock

.PHONY: clear sf-clear validate security

