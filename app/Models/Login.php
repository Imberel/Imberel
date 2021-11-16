<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\LoginRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Login extends LoginRequest
{

    public string $useremail = '';

    public string $password = '';

    public function login()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $user = $this->getUser();
                $key = core()->key();
                $value = $user->{$key};
                core()->session->set($value);
                $this->response->redirect("/user");
            }
        }
        return;
    }

    public function getUser(): object
    {
        $table = $this->tableName();
        $stmt = $this->prepare("SELECT * FROM $table WHERE useremail = :attr");
        $stmt->bindValue(":attr", $this->useremail);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }
}