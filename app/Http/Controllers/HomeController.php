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
    public function __construct()
    {
        $this->title(collect('APP_NAME') . " | " . collect('APP_DESC'));
        $this->layout("main");
    }

    public function home()
    {
        return $this->render("home");
    }
}