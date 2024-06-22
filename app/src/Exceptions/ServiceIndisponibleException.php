<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Throwable;

class ServiceIndisponibleException extends AbstractCustomExceptions
{
    public function __construct(
        string $message = "Service indisponible.",
        int $code = 500,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
