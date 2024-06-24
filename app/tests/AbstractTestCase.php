<?php

declare(strict_types=1);

namespace Theago\Tests;

use Exception;
use PDO;
use PHPUnit\Framework\TestCase;
use Theago\BackendChallange\Utils\Utils;

class AbstractTestCase extends TestCase
{
    protected PDO $conn;

    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->conn = $GLOBALS['conn'];
    }

    protected function setUp(): void
    {
        $this->conn->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->conn->rollBack();
    }

    /**
     * @throws Exception
     */
    protected function resetDbTest(): void
    {
        $this->runMigration('/var/scripts/tests_bootstrap.sql');
    }

    /**
     * @throws Exception
     */
    private function runMigration(string $migrationFile): void
    {
        $sql = file_get_contents($migrationFile);

        if ($sql === false) {
            throw new Exception("Não foi possível ler o arquivo de migration: $migrationFile");
        }

        $queries = explode(';', $sql);

        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                $this->conn->exec($query);
            }
        }
    }
}
