<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Models\User;
use Imberel\Imberel\Core\Application\Controller;
use Imberel\Imberel\Http\Middleware\UserMiddleware;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(new UserMiddleware());
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
}