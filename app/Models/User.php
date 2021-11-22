<?php

namespace Imberel\Imberel\Models;

use Imberel\Imberel\Http\Requests\UserRequest;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class User extends UserRequest
{
    public function getUser(): object
    {
        return core()->queryDriver->select($this->table(), $this->key(), core()->session->get());
    }

    public function logout()
    {
        core()->session->destroy(USER_SESSION_ID);
        $this->response->redirect('/login');
    }
}