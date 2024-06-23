#!/bin/bash

composer install
composer update
composer dumpautoload -o

php -S 0.0.0.0:8000 -t public &
php beanstalkd/process_payment.php # Só pq o supervisor tava dando muito trabalho pra configurar :T
