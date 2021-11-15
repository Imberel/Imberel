<?php

namespace Imberel\Imberel\Core\Connection;


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
    }

    public function prepare(string $query): object
    {
        return $this->pdo->prepare($query);
    }

    public function pdo()
    {
        return $this->pdo;
    }
}