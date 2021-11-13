<?php

use Imberel\Imberel\Core\Migration\Migration;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 * @package Migration
 */
class I8vb0_2021_11_13_I8vb07DKoZ6rm8s extends Migration
{

    /**
     * Table Name
     *
     * @var string
     */
    private string $table = "sessions";

    /**
     * Run Migration
     *
     * @return void
     */
    public function up(): void
    {
        $statement = "CREATE TABLE IF NOT EXISTS $this->table (
                    `id` VARCHAR(100) NOT NULL,
                    `userid` VARCHAR(25) DEFAULT NULL,
                    `access` INT(15) UNSIGNED DEFAULT NULL,
                    `remember` TINYINT DEFAULT 0,
                    `user_agent` VARCHAR(250) DEFAULT NULL,
                    `data` TEXT,
                    PRIMARY KEY(`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        $this->pdo->exec($statement);
        return;
    }

    /**
     * Reverse Migration
     *
     * @return void
     */
    public function down(): void
    {
        $statement = "DROP TABLE $this->table";
        $this->pdo->exec($statement);
        return;
    }
}