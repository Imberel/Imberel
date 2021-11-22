<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\UsernameRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Username extends UsernameRequest
{
    public string $userid;

    public string $username;

    public string $password = '';

    public function getUser(): object
    {
        return core()->queryDriver->select($this->table(), $this->key(), core()->session->get());
    }

    public function update()
    {
        $user = $this->getUser();
        $key = $this->key();
        $this->username = $user->username;
        $this->userid = $user->userid;
        if ($this->request->isPost() && isset($this->request->body()['updateUsername'])) {
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
            'username' => $this->username,
        ];
    }
}