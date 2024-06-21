#!/bin/bash

if [ -z "$(ls -A vendor)" ]; then
    echo "Installing development dependencies..."
    composer install --no-progress --no-suggest -q  --no-interaction
fi

php -S 0.0.0.0:8000 -t public &
php beanstalkd/process_payment.php # Só pq o supervisor tava dando muito trabalho pra configurar :T
