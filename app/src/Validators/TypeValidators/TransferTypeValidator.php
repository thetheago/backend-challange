<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TypeValidators;

use Theago\BackendChallange\Exceptions\InvalidTypeException;
use Theago\BackendChallange\Exceptions\Routing\MissingParameterException;
use TypeError;

class TransferTypeValidator extends AbstractTypeValidator
{
    /**
     * @throws InvalidTypeException
     * @throws MissingParameterException
     */
    public function validate(array $payload): bool
    {
        $this->required_items = ['value', 'payer', 'payee'];

        parent::validate($payload);

        try {
            $this->validateValueParameter($payload['value']);
        } catch (TypeError $e) {
            throw new InvalidTypeException("The (value) parameter must be of type 'float'.", $e->getCode());
        }

        try {
            $this->validatePayerParameter($payload['payer']);
        } catch (TypeError $e) {
            throw new InvalidTypeException("The (payer) parameter must be of type 'int'.", $e->getCode());
        }

        try {
            $this->validatePayeeParameter($payload['payee']);
        } catch (TypeError $e) {
            throw new InvalidTypeException("The (payee) parameter must be of type 'int'.", $e->getCode());
        }

        return true;
    }

    private function validateValueParameter(float $value)
    {
    }

    private function validatePayerParameter(int $payerId): void
    {
    }

    private function validatePayeeParameter(int $payeeId): void
    {
    }
}
