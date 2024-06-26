<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions;

use Exception;
use Throwable;

abstract class AbstractCustomExceptions extends Exception
{
    public function __construct(string $message = "", int $code = 500, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
