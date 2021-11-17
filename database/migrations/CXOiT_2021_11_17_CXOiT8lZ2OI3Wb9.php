<?php

use Imberel\Imberel\Core\Database\Schema\Blueprint;
use Imberel\Imberel\Core\Database\Schema\Schema;

/**
 *  CXOiT_2021_11_17_CXOiT8lZ2OI3Wb9 Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class CXOiT_2021_11_17_CXOiT8lZ2OI3Wb9
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
        Schema::create($this->table, function (Blueprint $table) {
            $column = [
                $table->int('id')->primary(),
                $table->varchar('userid')->unique(),
                $table->varchar('useremail')->unique(),
                $table->varchar('username')->unique(),
                $table->varchar('firstname')->notnull(),
                $table->varchar('lastname')->notnull(),
                $table->tinyint('userstatus')->default(0),
                $table->varchar('password', 200)->notnull(),
                $table->timestamp('created_at')->currentTime(),
                $table->timestamp('updated_at')->currentTime()
            ];
            return $column;
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