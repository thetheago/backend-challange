<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Throwable;

class ValidationException extends AbstractCustomExceptions
{
    public function __construct(
        string $message = "Something in your request is invalid.",
        int $code = 400,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
