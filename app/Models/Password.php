<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\PasswordRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Password extends PasswordRequest
{
    public string $userid;

    public string $password = '';

    public string $newPassword = '';

    public string $confirmPassword = '';

    public function getUser(): object
    {
        return core()->queryDriver->select($this->table(), $this->key(), core()->session->get());
    }

    public function update()
    {
        $user = $this->getUser();
        $key = $this->key();
        $this->userid = $user->userid;
        if ($this->request->isPost() && isset($this->request->body()['updatePassword'])) {
            $this->load($this->request->body());
            if ($this->validate()) {
                $this->newPassword = \password_hash($this->newPassword, PASSWORD_DEFAULT);
                core()->queryDriver->update($this->table(), $key, $user->{$key}, $this->attributes());
                $this->password = '';
                $this->newPassword = '';
                $this->confirmPassword = '';
            }
        }
    }

    public function reset()
    {
        $this->useremail = '';
    }

    public function attributes(): array
    {
        return [
            'password' => $this->newPassword
        ];
    }
}