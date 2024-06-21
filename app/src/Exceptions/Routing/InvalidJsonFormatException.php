<?php

namespace Theago\BackendChallange\Exceptions\Routing;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;

class InvalidJsonFormatException extends AbstractCustomExceptions
{
    public function __construct(string $message = "Invalid JSON format")
    {
        parent::__construct($message, 500);
    }
}