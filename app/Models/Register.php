<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Extra\Random;
use Imberel\Imberel\Http\Requests\RegisterRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Register extends RegisterRequest
{
    public string $useremail = '';

    public string $userid;

    public string $username = '';

    public string $firstname = '';

    public string $lastname = '';

    public int $userstatus;

    public string $password = '';

    public string $confirmpassword = '';

    public function attributes(): array
    {
        return [
            'userid' => $this->userid,
            'useremail' => $this->useremail,
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'userstatus' => $this->userstatus,
            'password' => $this->password
        ];
    }

    public function register()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $this->userstatus = self::INACTIVE;
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $this->userid = Random::string(10);
                core()->queryDriver->insert($this->table(), $this->attributes());
                $this->password = '';
                $this->confirmpassword = '';
                $this->response->redirect("/login");
            }
        }
        return;
    }
}