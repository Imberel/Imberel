<?php

use Imberel\Imberel\Core\Database\Schema\Blueprint;
use Imberel\Imberel\Core\Database\Schema\Schema;

/**
 *  U1YcU_2021_11_17_U1YcULqttrkVE22 Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class U1YcU_2021_11_17_U1YcULqttrkVE22
{

    /**
     * Table Name
     *
     * @var string
     */
    private string $table = "password_reset";

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
                $table->varchar('resetlink')->unique(),
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