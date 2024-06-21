<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions\Transfer;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;
use Throwable;

class TransferException extends AbstractCustomExceptions
{
    public function __construct(
        string $message = "Algo deu errado na transferência do dinheiro, favor tentar novamente.",
        int $code = 500,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
