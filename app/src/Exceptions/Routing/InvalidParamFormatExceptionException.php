<?php

namespace Theago\BackendChallange\Exceptions\Routing;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;

class InvalidParamFormatExceptionException extends AbstractCustomExceptions
{
    public function __construct(mixed $param, string $message = "Invalid param format")
    {
        parent::__construct($message . ' {' . $param . '}', 400);
    }
}
