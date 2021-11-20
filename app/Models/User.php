<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\UserRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class User extends UserRequest
{
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
}