<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions\Models;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Throwable;

class DuplicatedKeyException extends AbstractCustomExceptions
{
    public function __construct(string $message = "", int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
