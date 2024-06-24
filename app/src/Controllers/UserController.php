<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Controllers;

use Theago\BackendChallange\Exceptions\Models\DuplicatedKeyException;
use Theago\BackendChallange\Models\UserModel;
use Theago\BackendChallange\Responses\JsonResponse;
use Theago\BackendChallange\Utils\Utils;

class UserController extends AbstractController
{
    /**
     * @throws DuplicatedKeyException
     */
    public function post(): JsonResponse
    {
        $user = new UserModel();
        $user->setName(name: $this->payload['name']);
        $user->setEmail(email: $this->payload['email']);
        $user->setCpf(cpf: $this->payload['cpf']);
        $user->setShopkeeper(shopkeeper: $this->payload['shopkeeper']);
        $user->setAmount(amount: $this->payload['amount']);
        $user->save();

        return new JsonResponse(status: 201, data: $user->getAttributes());
    }

    public function getById(int $id): JsonResponse
    {
        $model = new UserModel();
        $user = $model->findById($id);
        return new JsonResponse(status: 200, data: $user->getAttributes());
    }

    public function getAll(): JsonResponse
    {
        $model = new UserModel();
        $users = $model->findAll();
        return new JsonResponse(status: 200, data: $users);
    }
}
