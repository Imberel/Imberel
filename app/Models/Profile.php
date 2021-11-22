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
    public string $firstname;

    public string $lastname;

    public string $userid;

    public string $password = '';

    public function getUser(): object
    {
        return core()->queryDriver->select($this->table(), $this->key(), core()->session->get());
    }

    public function update()
    {
        $key = $this->key();
        $user = $this->getUser();
        $this->userid = $user->userid;
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        if ($this->request->isPost() && isset($this->request->body()['updateProfile'])) {
            $this->load($this->request->body());
            if ($this->validate()) {
                core()->queryDriver->update($this->table(), $key, $user->{$key}, $this->attributes());
                $this->password = '';
            }
        }
    }

    public function attributes(): array
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
        ];
    }
}