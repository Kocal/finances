
PHP = symfony php
CONSOLE = symfony console


.PHONY: db-reset
db-reset:
	$(CONSOLE) doctrine:database:drop --force --if-exists
	$(CONSOLE) doctrine:database:create
	$(CONSOLE) doctrine:schema:create
	$(CONSOLE) doctrine:fixtures:load --no-interaction

.PHONY: db-reset@test
db-reset@test: export APP_ENV=test
db-reset@test: db-reset
