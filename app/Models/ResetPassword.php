<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\ResetPasswordRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class ResetPassword extends ResetPasswordRequest
{
    public string $useremail = '';

    public string $password = '';

    public function resetPassword()
    {
        if ($this->request->isPost()) {
            $this->load($this->request->body());
            if ($this->validate()) {
                # co
            }
        }
        return;
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }
}