<?php

namespace Imberel\Imberel\Http\Controllers;

use Imberel\Imberel\Core\Application\Controller;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class HomeController extends Controller
{
    public function home()
    {
        return $this->view->render("home");
    }
}