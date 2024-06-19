<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

use Theago\BackendChallange\Models\UserModel;
use Theago\BackendChallange\Utils\Utils;

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
        $model = new UserModel();
        $user = $model->findById($id);
    }

    public function getAll(): void
    {
        // Fetch users
        echo "Usuários buscados";
    }
}
