<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Types;

use Theago\BackendChallange\Models\UserModel;

class TransferType
{

    private UserModel|null $payerEntity = null;
    private UserModel|null $payeeEntity = null;

    public function __construct(
        private float $value,
        private int $payer,
        private int $payee
    )
    {
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setValue(float $value): void
    {
        $this->value = $value;
    }

    public function getPayer(): int
    {
        return $this->payer;
    }

    public function setPayer(int $payer): void
    {
        $this->payer = $payer;
    }

    public function getPayee(): int
    {
        return $this->payee;
    }

    public function setPayee(int $payee): void
    {
        $this->payee = $payee;
    }

    public function getPayerEntity(): UserModel|null
    {
        return $this->payerEntity;
    }

    public function setPayerEntity(UserModel|null $payerEntity): void
    {
        $this->payerEntity = $payerEntity;
    }

    public function getPayeeEntity(): UserModel|null
    {
        return $this->payeeEntity;
    }

    public function setPayeeEntity(UserModel|null $payeeEntity): void
    {
        $this->payeeEntity = $payeeEntity;
    }
}
