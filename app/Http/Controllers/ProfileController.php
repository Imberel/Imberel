<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Http\Middleware\LoggedIn;
use Imberel\Imberel\Core\Application\Controller;
use Imberel\Imberel\Models\Password;
use Imberel\Imberel\Models\Profile;
use Imberel\Imberel\Models\Username;

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
        $model2 = new Username;
        $model3 = new Password;
        $model->update();
        $model2->update();
        $model3->update();
        return $this->view->render(
            'user/profile',
            [
                'user' => $model->getUser(),
                'model' => $model,
                'model2' => $model2,
                'model3' => $model3
            ]
        );
    }
}