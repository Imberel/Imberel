<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Core\Extra\Random;
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
            if ($this->validate() && $this->createResetLink('sxdcfgvhbg')) {
            }
        }
        return;
    }

    public function createResetLink(string $userid)
    {
        $rand = new Random;
        $link = \uniqid($rand->string(17));
        $values = [
            'userid' => $userid,
            'useremail' => 'Tiger@imberel.com',
            'resetlink' => $link
        ];
        core()->queryDriver->insert($this->table(), $values);
    }

    public function attributes(): array
    {
        return ['useremail', 'password'];
    }
}