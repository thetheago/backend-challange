<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Validators;

interface IValidator
{
    public function setNext(IValidator $next);
}
