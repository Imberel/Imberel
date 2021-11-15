<?php

use Imberel\Imberel\Core\Database\Migration\Migration;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 * @package Migration
 */
class EIWR3_2021_11_13_EIWR3PG22GJxNsx extends Migration
{

    /**
     * Table Name
     *
     * @var string
     */
    private string $table = "users";

    /**
     * Run Migration
     *
     * @return void
     */
    public function up(): void
    {
        $statement = "CREATE TABLE IF NOT EXISTS $this->table (
                    `id` int(250) PRIMARY KEY AUTO_INCREMENT,
                    `userid` VARCHAR(250) UNIQUE NOT NULL,
                    `useremail` VARCHAR(250) UNIQUE NOT NULL,
                    `username` VARCHAR(250) UNIQUE NOT NULL,
                    `firstname` VARCHAR(250) NOT NULL,
                    `lastname` VARCHAR(250) NOT NULL,
                    `userstatus` TINYINT DEFAULT 0,
                    `password` VARCHAR(250) NOT NULL,
                    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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
