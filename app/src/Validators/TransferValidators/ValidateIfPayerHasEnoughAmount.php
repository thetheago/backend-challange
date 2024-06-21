<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TransferValidators;

use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Types\TransferType;
use Theago\BackendChallange\Validators\TransferValidators\TransferValidator;

class ValidateIfPayerHasEnoughAmount extends TransferValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(TransferType $transfer): bool
    {
        $payer = $transfer->getPayerEntity();
        $amountToTransfer = $transfer->getValue();
        $payerAmount      = $payer->getAmount();

        if ($payerAmount >= $amountToTransfer) {
            return true;
        }

        throw new ValidationException(
            "Payer {$transfer->getPayer()} does not have enough amount to pay {$amountToTransfer}"
        );
    }
}
