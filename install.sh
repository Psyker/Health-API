#!/usr/bin/env bash

php bin/console doctrine:database:create --env=dev --if-not-exists
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load -n