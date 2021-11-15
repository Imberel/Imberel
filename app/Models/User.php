<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Application\Core;
use Imberel\Imberel\Core\Application\Model;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser(): object
    {
        $table = $this->tableName();
        $key = $this->key();
        $userid = core()->session->get();
        $stmt = $this->prepare("SELECT * FROM $table WHERE $key = :attr");
        $stmt->bindValue(":attr", $userid);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function tableName(): string
    {
        return 'users';
    }

    public function key(): string
    {
        return "userid";
    }
}
