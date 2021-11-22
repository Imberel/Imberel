<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Models\User;
use Imberel\Imberel\Core\Application\Controller;
use Imberel\Imberel\Http\Middleware\LoggedIn;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(new LoggedIn);
        $this->layout('user');
    }


    public function dashboard()
    {
        $model = new User;
        return $this->view->render(
            'user/dashboard',
            [
                'user' => $model->getUser()
            ]
        );
    }

    public function logout()
    {
        $model = new User;
        $model->logout();
    }
}