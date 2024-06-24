<?php

declare(strict_types=1);

namespace Theago\Tests;

use Exception;
use PDO;
use PHPUnit\Framework\TestCase;

class AbstractTestCase extends TestCase
{
    protected PDO $conn;

    protected function setUp(): void
    {
        $this->conn = $GLOBALS['conn'];
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
