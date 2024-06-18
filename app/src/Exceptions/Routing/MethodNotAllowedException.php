<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions\Routing;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;

class MethodNotAllowedException extends AbstractCustomExceptions
{
    public function __construct(string $message = "This method is not supported by this route.")
    {
        header("HTTP/1.1 405 Method Not Allowed");
        parent::__construct($message, 405);
    }
}
