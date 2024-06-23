<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use PDO;
use Theago\BackendChallange\Utils\Utils;

class UserModel extends AbstractModel
{
    private int $id;
    private string $name;
    private string $email;
    private string $cpf;
    private bool $shopkeeper;
    private float $amount;

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

    private function setId(int $id): void
    {
        $this->id = $id;
    }

    public function save(): self
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (':name, :email, :cpf, :shopkeeper, :amount')");
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':shopkeeper', $this->shopkeeper, PDO::PARAM_BOOL);
            $stmt->bindParam(':amount', $this->amount);

            $stmt->execute();

            return $this;
        } catch (\Throwable $e) {
            Utils::dd($e->getMessage());

            return $this;
        }
    }

    public function findById(int $id): self|null
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $this->execute($stmt);
    }

    public function findByEmail(string $email): self|null
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        return $this->execute($stmt);
    }

    private function fillAttributes(array $user): void
    {
        $this->setId($user['id']);
        $this->setName($user['name']);
        $this->setEmail($user['email']);
        $this->setCpf($user['cpf']);
        $this->setShopkeeper($user['shopkeeper']);
        $this->setAmount($user['amount']);
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
        $stmt = $this->conn->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $user) {
            $newUser = new $this();

            $user['shopkeeper'] = $user['shopkeeper'] === 1;
            $user['amount']     = (float) $user['amount'];

            $newUser->fillAttributes($user);
            $allUsers[] = [
                'id' => $newUser->getId(),
                'name' => $newUser->getName(),
                'email' => $newUser->getEmail(),
                'cpf' => $newUser->getCpf(),
                'shopkeeper' => $newUser->isShopkeeper(),
                'amount' => $newUser->getAmount()
            ];
        }

        return $allUsers;
    }

    /**
     * @param false|\PDOStatement $stmt
     * @return $this|null
     */
    public function execute(false|\PDOStatement $stmt): ?UserModel
    {
        // TODO: Bad smell, metodo fazendo mais de uma coisa.
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }
        $user['shopkeeper'] = $user['shopkeeper'] === 1;
        $user['amount'] = (float)$user['amount'];
        $this->fillAttributes($user);
        return $this;
    }
}
