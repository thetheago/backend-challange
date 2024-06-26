<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Exceptions\Routing;

use Theago\BackendChallange\Exceptions\AbstractCustomExceptions;

class RouteNotFoundException extends AbstractCustomExceptions
{
    public function __construct(string $message = "Route not found.")
    {
        parent::__construct($message, 404);
    }
}
