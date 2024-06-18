<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

class UserController extends AbstractController
{
    public function post(): void
    {
        // Generate a new user
        echo "Novo usuário criado";
    }

    public function getById(int $id): void
    {
        // Fetch users
        echo "Usuário $id buscado";
    }

    public function getAll(): void
    {
        // Fetch users
        echo "Usuários buscados";
    }
}