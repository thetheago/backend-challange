<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Routing;

use Theago\BackendChallange\Exceptions\Routing\RouteNotFoundException;

interface IRouting
{
    public function __construct(string $route, string $method, string $payload);

    /**
     * @throws RouteNotFoundException
     */
    public function handleRoute(): void;
}
