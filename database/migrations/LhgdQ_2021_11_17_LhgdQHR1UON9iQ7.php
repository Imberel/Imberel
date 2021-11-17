<?php

use Imberel\Imberel\Core\Database\Schema\Blueprint;
use Imberel\Imberel\Core\Database\Schema\Schema;

/**
 *  LhgdQ_2021_11_17_LhgdQHR1UON9iQ7 Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class LhgdQ_2021_11_17_LhgdQHR1UON9iQ7
{

    /**
     * Table Name
     *
     * @var string
     */
    private string $table = "random_tab";

    /**
     * Run Migration
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $row = [
                $table->id(),
            ];
            return $row;
        });
    }

    /**
     * Reverse Migration
     *
     * @return void
     */
    public function down(): void
    {
        Schema::drop($this->table);
    }
}