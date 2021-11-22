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
    public string $useremail = '';

    public string $password = '';

    public function reset()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
            }
        }
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }
}