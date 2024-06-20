<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

use Theago\BackendChallange\Exceptions\Routing\MethodNotAllowedException;
use Theago\BackendChallange\Responses\JsonResponse;

abstract class AbstractController implements IController
{
    public function __construct(
        public ?array $payload
    ) {
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function __call(string $name, array $arguments)
    {
        if ($name === 'get') {
            if (count($arguments) === 0) {
                return $this->getAll();
            } elseif (count($arguments) === 1) {
                return $this->getById($arguments[0]);
            }
        }

        throw new MethodNotAllowedException();
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function getById(int $id): JsonResponse
    {
        throw new MethodNotAllowedException("GET method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function getAll(): JsonResponse
    {
        throw new MethodNotAllowedException("GET method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function post(): JsonResponse
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function put(int $id): JsonResponse
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function patch(): void
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function options(): void
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function head(): void
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }

    /**
     * @throws MethodNotAllowedException
     */
    public function delete(int $id): JsonResponse
    {
        throw new MethodNotAllowedException(strtoupper(__FUNCTION__) . " method is not supported by this route.");
    }
}
