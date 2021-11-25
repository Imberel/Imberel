<?php

namespace Imberel\Imberel\Controller;

use Imberel\Inseminate\Application\Controller;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class HomeController extends Controller
{
    public function home()
    {
        return $this->view->render('imberel');
    }
}