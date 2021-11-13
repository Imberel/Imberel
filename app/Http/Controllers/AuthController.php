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
    }

    public function register()
    {
        $model = new Register;
        if ($this->request->isPost()) {
            $model->loadData($this->request->body());
            if ($model->validate() && $model->register()) {
                $this->response->redirect("/login");
            }
        }
        $this->title(getenv('APP_NAME') . " | Sign Up");
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
        if ($this->request->isPost()) {
            $model->loadData($this->request->body());
            if ($model->validate() && $model->login()) {
                $this->response->redirect("/user");
            }
        }
        $this->title(getenv('APP_NAME') . " | Sign In");
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
        if ($this->request->isPost()) {
            $model->loadData($this->request->body());
            if ($model->validate() && $model->reset()) {
                # code...
            }
        }
        return $this->view->render(
            'resetpassword',
            [
                'model' => $model
            ]
        );
    }
}