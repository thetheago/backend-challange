<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

use Theago\BackendChallange\Responses\JsonResponse;

interface IController
{
    public function getById(int $id): JsonResponse;
    public function getAll(): JsonResponse;
    public function post(): JsonResponse;
    public function put(int $id): JsonResponse;
    public function delete(int $id): JsonResponse;
}
