<?php

require dirname(__FILE__, 2) . "/vendor/autoload.php";

use Theago\Beanstalkd\ProcessPaymentsWorker;

$worker = new ProcessPaymentsWorker();

$worker->runWorker([$worker, 'run']);
