<?php

use Imberel\Imberel\Core\Database\Schema\Blueprint;
use Imberel\Imberel\Core\Database\Schema\Schema;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 * @package Migration
 */
class GvyY7_2021_11_17_GvyY72wBDE3YbE2
{

    /**
     * Table Name
     *
     * @var string
     */
    private string $table = "random";

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
                $table->string('userd'),
                $table->timestamp('created_at')
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