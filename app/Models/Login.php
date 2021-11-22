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
        $key = $this->key();
        return core()->queryDriver->select($this->table(), $key, $this->{$key});
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }
}
