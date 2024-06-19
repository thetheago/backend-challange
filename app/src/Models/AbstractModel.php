<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use Exception;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use Theago\BackendChallange\Utils\Utils;

class AbstractModel
{
    protected Database $database;

    protected Collection $collection;

    public function __construct()
    {
        try {
            $client = new Client('mongodb://mongodb:27017');
            $this->database = $client->selectDatabase('payment');
        } catch (\Throwable $e) {
            Utils::dd($e->getMessage(), true);
        }
    }
}
