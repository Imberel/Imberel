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
        return ['userid', 'useremail', 'username', 'firstname', 'lastname', 'userstatus', 'password'];
    }

    public function register()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $this->userstatus = self::INACTIVE;
                $this->password = password_hash($this->password, PASSWORD_DEFAULT);
                $randid = new Random;
                $this->userid = $randid->string(10);
                $this->save();
                $this->response->redirect("/login");
            }
        }
        return;
    }

    public function save()
    {
        $table = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn ($attr) => ":$attr", $attributes);
        $stmt = $this->prepare("INSERT INTO $table (" . implode(",", $attributes) . ") 
        VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attibute) {
            $stmt->bindValue(":$attibute", $this->{$attibute});
        }
        $stmt->execute();
        return true;
    }
}