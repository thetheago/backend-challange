<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TransferValidators;

use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Types\TransferType;
use Theago\BackendChallange\Utils\Utils;

class ValidateIfPayeeExists extends TransferValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(TransferType $transfer): bool
    {
        if ($transfer->getPayeeEntity() !== null) {
            return true;
        }

        throw new ValidationException("Payee {$transfer->getPayee()} does not exist");
    }
}
