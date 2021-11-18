tests: export APP_ENV=test
tests:
	cd ~/programming-projects/php-projects/CACourse && docker exec sf5_php /bin/bash -c "export APP_ENV=test && php sf5/bin/console doctrine:database:drop -fn"
	cd ~/programming-projects/php-projects/CACourse && docker exec sf5_php /bin/bash -c "export APP_ENV=test && php sf5/bin/console doctrine:database:create"
	cd ~/programming-projects/php-projects/CACourse && docker exec sf5_php /bin/bash -c "export APP_ENV=test && php sf5/bin/console doctrine:migrations:migrate -n"
	cd ~/programming-projects/php-projects/CACourse && docker exec sf5_php /bin/bash -c "export APP_ENV=test && php sf5/bin/console doctrine:fixtures:load -n"
	cd ~/programming-projects/php-projects/CACourse && docker exec sf5_php /bin/bash -c "cd sf5 && APP_ENV=test XDEBUG_MODE=coverage php bin/phpunit tests"
	cd ~/programming-projects/php-projects/CACourse && vendor/bin/phpat phpat.yaml
.PHONY: tests
