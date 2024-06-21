<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use Theago\BackendChallange\Utils\Utils;

class UserModel extends AbstractModel
{
    private int $id;
    private string $name;
    private string $email;
    private string $cpf;
    private bool $shopkeeper;
    private float $amount;

    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->database->selectCollection('users');
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    public function isShopkeeper(): bool
    {
        return $this->shopkeeper;
    }

    public function setShopkeeper(bool $shopkeeper): void
    {
        $this->shopkeeper = $shopkeeper;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function save(): self
    {
        try {
            if ($this->getId() == null) {
                $this->setId(rand(1, 100));
            }

            $this->collection->insertOne([
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'shopkeeper' => $this->shopkeeper,
                'amount' => $this->amount,
            ]);

            return $this;
        } catch (\Throwable $e) {
            Utils::dd($e->getMessage());

            return $this;
        }
    }

    public function findById(int $id): self|null
    {
        $user = $this->collection->findOne(['id' => $id]);
        if ($user === null) {
            return null;
        }
        $this->fillAttributes($user);
        return $this;
    }

    public function findByEmail(string $email): self|null
    {
        $user = $this->collection->findOne(['email' => $email]);
        if ($user === null) {
            return null;
        }
        $this->fillAttributes($user);
        return $this;
    }

    private function fillAttributes(object $user): void
    {
        $this->setId($user->id);
        $this->setName($user->name);
        $this->setEmail($user->email);
        $this->setCpf($user->cpf);
        $this->setShopkeeper($user->shopkeeper);
        $this->setAmount($user->amount);
    }

    public function getAttributes(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'shopkeeper' => $this->shopkeeper,
            'amount' => $this->amount
        ];
    }

    public function findAll(): array
    {
        $allUsers = [];
        $all = parent::findAll();

        foreach ($all as $user) {
            $newUser = new $this();
            $newUser->fillAttributes($user);
            $allUsers[] = $newUser;
        }

        return $allUsers;
    }
}
