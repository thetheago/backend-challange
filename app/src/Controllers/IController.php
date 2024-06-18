<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

interface IController
{
    public function getById(int $id): void;
    public function getAll(): void;
    public function post(): void;
    public function put(int $id): void;
    public function delete(int $id): void;
}