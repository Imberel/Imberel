<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Models\Login;
use Imberel\Imberel\Models\Register;
use Imberel\Imberel\Core\Application\Controller;
use Imberel\Imberel\Models\Password;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class AuthController extends Controller
{
    public function register()
    {
        $model = new Register;
        $model->register();
        return $this->view->render(
            "register",
            [
                'model' => $model
            ]
        );
    }

    public function login()
    {
        $model = new Login;
        $model->login();
        return $this->view->render(
            "login",
            [
                'model' => $model
            ]
        );
    }

    public function resetpassword()
    {
        $model = new Password;
        $model->reset();
        return $this->view->render(
            'password',
            [
                'model' => $model
            ]
        );
    }
}