tests: export APP_ENV=test
tests:
	cd ~/programming-projects/php-projects/CACourse && php bin/console doctrine:database:drop --force || true
	cd ~/programming-projects/php-projects/CACourse && php bin/console doctrine:database:create
	cd ~/programming-projects/php-projects/CACourse && php bin/console doctrine:migrations:migrate -n
	cd ~/programming-projects/php-projects/CACourse && php bin/console doctrine:fixtures:load -n
	cd ~/programming-projects/php-projects/CACourse && php bin/phpunit $@
.PHONY: tests