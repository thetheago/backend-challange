<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators;

abstract class AbstractValidator implements IValidator
{
    protected IValidator|null $next = null;

    public function setNext(IValidator $next): void
    {
        $this->next = $next;
    }
}
