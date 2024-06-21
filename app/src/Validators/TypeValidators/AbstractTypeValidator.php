<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators\TypeValidators;

use Theago\BackendChallange\Exceptions\Routing\MissingParameterException;

class AbstractTypeValidator
{
    protected array $required_items;

    /**
     * @throws MissingParameterException
     */
    public function validate(array $payload): bool
    {
        if (empty($this->validateRequiredItems($payload))) {
            return true;
        }

        throw new MissingParameterException(
            message: 'Required parameters missing: ' . implode(separator: ', ', array: $this->required_items),
            code: 422
        );
    }

    private function validateRequiredItems(array $payload): array
    {
        $payload_keys=array_keys($payload);
        $required_items_keys=array_keys(array_flip($this->required_items));
        return array_keys(array_diff_key($payload_keys, $required_items_keys));
    }
}
