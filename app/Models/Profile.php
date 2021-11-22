<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\ProfileRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Profile extends ProfileRequest
{
    public string $username;

    public string $firstname;

    public string $lastname;

    public string $userid;

    public string $password = '';

    public function getUser(): object
    {
        return core()->queryDriver->select($this->table(), $this->key(), core()->session->get());
    }

    public function updateUser()
    {
        $key = $this->key();
        $user = $this->getUser();
        $this->userid = $user->userid;
        $this->username = $user->username;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                return core()->queryDriver->update($this->table(), $key, $user->{$key}, $this->attributes());
            }
        }
    }

    public function attributes(): array
    {
        return [
            'username' => $this->username,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
        ];
    }
}