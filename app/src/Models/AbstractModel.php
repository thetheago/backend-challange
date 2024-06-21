<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use Theago\BackendChallange\Utils\Utils;

class AbstractModel
{
    protected Client $client;
    protected Database $database;

    protected Collection $collection;

    public function __construct()
    {
        try {
            $this->client = new Client('mongodb://mongodb:27017');
            $this->database = $this->client->selectDatabase('payment');
        } catch (\Throwable $e) {
            Utils::dd($e->getMessage(), true);
        }
    }

    public function findAll(): array
    {
        $allData = [];
        $fetch = $this->collection->find();

        foreach ($fetch as $row) {
            $allData[] = $row;
        }
        return $allData;
    }
}
