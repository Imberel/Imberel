<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Models\Login;
use Imberel\Imberel\Models\Register;
use Imberel\Imberel\Models\ResetPassword;
use Imberel\Imberel\Core\Application\Controller;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->title(collect('APP_NAME') . " | Auth");
    }

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
        $model = new ResetPassword;
        $model->resetPassword();
        return $this->view->render(
            'resetpassword',
            [
                'model' => $model
            ]
        );
    }
}