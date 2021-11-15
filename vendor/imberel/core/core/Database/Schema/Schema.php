<?php

namespace Imberel\Imberel\Core\Database\Schema;

use Imberel\Imberel\Core\Connection\Connection;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Schema extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create(string $table, callable $callback, string $engine = 'InnoDB', string $charset = 'utf8mb4')
    {
        $statement = "CREATE TABLE IF NOT EXISTS $table (
                $callback
                ) ENGINE=$engine DEFAULT CHARSET=$charset";
        $this->pdo->exec($statement);
        return;
    }

    public function drop(string $table)
    {
        $statement = "DROP TABLE IF EXISTS $table";
        return $this->pdo->exec($statement);
    }
}