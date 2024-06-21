<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TransferValidators;

use Theago\BackendChallange\Exceptions\ValidationException;
use Theago\BackendChallange\Types\TransferType;
use Theago\BackendChallange\Validators\AbstractValidator;

abstract class TransferValidator extends AbstractValidator
{
    /**
     * @throws ValidationException
     */
    public function processValidation(TransferType $transfer): bool
    {
        if ($this->validate($transfer)) {
            $this->next?->processValidation($transfer);

            return true;
        }

        return false;
    }

    abstract protected function validate(TransferType $transfer): bool;
}
