<?php

use Imberel\Imberel\Core\Database\Migration\Migration;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 * @package Migration
 */
class {{class}} extends Migration
{

     /**
     * Table Name
     *
     * @var string
     */
    private string $table = "{{table}}";

    /**
     * Run Migration
     *
     * @return void
     */
    public function up(): void
    {
        $statement = "CREATE TABLE IF NOT EXISTS $this->table (
                
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
