<?php

namespace Imberel\Imberel\Core\Connection;

use Imberel\Imberel\Core\Extra\ICatch;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Connection extends Connect
{
    public function __construct()
    {
        parent::__construct();
        try {
            return $this->pdo;
        } catch (\Throwable $th) {
            new ICatch($th, 'Connection');
        }
    }

    public function prepare(string $query): object
    {
        return $this->pdo->prepare($query);
    }
}