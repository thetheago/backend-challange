<?php

require_once "../vendor/autoload.php";

header("Content-Type: application/json");
var_dump($_SERVER);

// Importar o routing, o routing vai pegar qual endpoint e mandar para qual controller, a controller vai ficar responsável por dizer
// se ela implementa aquele método no tal endpoint, se sim executa, se não lança uma exception que será tratada pelo ExceptionHandler
// no catch do Routing.php talvez
