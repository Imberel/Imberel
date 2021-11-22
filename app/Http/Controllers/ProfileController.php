<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Http\Middleware\LoggedIn;
use Imberel\Imberel\Core\Application\Controller;
use Imberel\Imberel\Models\Profile;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class ProfileController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware(new LoggedIn);
        $this->layout('user');
    }

    public function profile()
    {
        $model = new Profile;
        $model->updateUser();
        return $this->view->render(
            'user/profile',
            [
                'user' => $model->getUser(),
                'model' => $model
            ]
        );
    }
}