#!/bin/bash

docker exec sf5_php /bin/bash -c "export APP_ENV=test && php sf5/bin/phpunit sf5/tests"
