<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

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
        return $this;
    }

    public function findById(int $id): self
    {
        $user = $this->collection->findOne(['id' => $id]);
        $this->fillAttributes($user);
        return $this;
    }

    public function findByEmail(string $email): self
    {
        $user = $this->collection->findOne(['email' => $email]);
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
}
