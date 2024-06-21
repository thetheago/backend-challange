<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Throwable;

class InvalidTypeException extends AbstractCustomExceptions
{
    public function __construct(
        string $message = "Invalid type in payload",
        int $code = 400,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
