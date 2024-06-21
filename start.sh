#!/bin/bash
php -S 0.0.0.0:8000 -t public &
php beanstalkd/process_payment.php # Só pq o supervisor tava dando muito trabalho pra configurar :T
