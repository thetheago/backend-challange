<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Routing;

use Exception;
use Theago\BackendChallange\Controllers\UserController;
use Theago\BackendChallange\Exceptions\Routing\InvalidParamFormatExceptionException;
use Theago\BackendChallange\Exceptions\Routing\MethodNotAllowedException;
use Theago\BackendChallange\Exceptions\Routing\RouteNotFoundException;

class Routing implements IRouting
{
    private string $uri;
    private string $method;
    private array $payload = [];
    private array $routes = [
        '/user' => UserController::class,
        '/user/([^/]+)' => UserController::class,
    ];

    public function __construct(string $uri, string $method, string $payload)
    {
        if (str_ends_with($uri, "/")) {
            $uri = rtrim($uri, "/");
        }

        $this->uri = $uri;

        $this->method = strtolower($method);
        if (!empty($payload)) {
            $this->payload = json_decode($payload, true);
        }
    }

    /**
     * @throws RouteNotFoundException
     * @throws Exception
     */
    public function handleRoute(): void
    {
        try {
            $route = $this->matchRoute();

            $controller = new $route['controller']($this->payload);
            if (!empty($route['param'])) {
                $controller->{$this->method}($route['param']);
                return;
            }
            $controller->{$this->method}();
        } catch (RouteNotFoundException $e) {
            throw new RouteNotFoundException($e->getMessage());
        } catch (MethodNotAllowedException $e) {
            throw new MethodNotAllowedException($e->getMessage());
        }
    }

    /**
     * @throws RouteNotFoundException|InvalidParamFormatExceptionException
     */
    private function matchRoute(): ?array
    {
        if (empty($this->uri)) {
            throw new RouteNotFoundException();
        }

        foreach ($this->routes as $pattern => $controller) {
            if (preg_match("#^$pattern$#", $this->uri, $matches)) {
                array_shift($matches);
                if (!is_numeric($matches[0])) {

                    // Bad smell : Esta validação parece estar na classe errada, ferindo o SRP
                    throw new InvalidParamFormatExceptionException($matches[0]);

                } else {
                    $matches[0] = (int) $matches[0];
                }
                return ['controller' => $controller, 'param' => $matches[0]];
            }
        }

        throw new RouteNotFoundException();
    }
}
