<?php

require_once "../vendor/autoload.php";

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Theago\BackendChallange\Routing\Routing;

try {
    $payload = file_get_contents('php://input');
    $routing = new Routing(uri: $_SERVER['REQUEST_URI'], method: $_SERVER['REQUEST_METHOD'], payload: $payload);
    $routing->handleRoute();
} catch (Throwable $e) {
    if ($e instanceof AbstractCustomExceptions) {
        echo $e->getMessage();
        die();
    }

    // TODO: Dar uma olhada no Observable Pattern para logar o erro em um file com o HASH no nome (gerado random)
     echo $e->getMessage();
    //Log
}
