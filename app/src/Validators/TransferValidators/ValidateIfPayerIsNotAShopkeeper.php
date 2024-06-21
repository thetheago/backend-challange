<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TransferValidators;

use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Types\TransferType;
use Theago\BackendChallange\Validators\TransferValidators\TransferValidator;

class ValidateIfPayerIsNotAShopkeeper extends TransferValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(TransferType $transfer): bool
    {
        $payer = $transfer->getPayerEntity();
        if ($payer->isShopkeeper() === false) {
            return true;
        }

        throw new ValidationException("Shopkeepers cannot do transfers.");
    }
}