<?php

namespace Imberel\Imberel\Core\Connection;

use Imberel\Imberel\Core\Extra\ICatch;
use PDO;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Connect extends Construct
{
    /**
     * Represent the PDO class
     *
     * @var \PDO
     */
    public PDO $pdo;

    public function __construct()
    {
        try {
            parent::__construct();
            $this->pdo = new PDO($this->DSN(), $this->dbUser(), $this->dbPassword());
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\Throwable $th) {
            new ICatch($th, 'Connection');
        }
    }
}