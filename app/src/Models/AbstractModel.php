<?php

declare(strict_types=1);

namespace Theago\BackendChallange\Models;

use PDO;
use PDOException;
use Theago\BackendChallange\Utils\Utils;

abstract class AbstractModel
{
    protected ?PDO $conn = null;

    public function __construct()
    {
        try {
            $host = getenv('DB_HOST');
            $username = getenv('DB_USER');
            $password = getenv('DB_PASS');
            $dbName = getenv('DB_NAME');

            $this->conn = new PDO(
                dsn: 'mysql:host=' . $host . ';dbname=' . $dbName,
                username: $username,
                password: $password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        } catch (\Throwable $e) {
            Utils::dd($e->getMessage(), true);
        }
    }
}
