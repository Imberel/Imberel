<?php

use Imberel\Imberel\Core\Database\Schema\Blueprint;
use Imberel\Imberel\Core\Database\Schema\Schema;

/**
 *  CreatePassword_resetTable Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class CreatePassword_resetTable
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
                $table->tinyint('linkstatus')->default(0),
                $table->timestamp('created_at')->currentTime()
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