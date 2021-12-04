<?php

declare(strict_types=1);

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
        return $this->render(
            'welcome',
            [
                'layout' => 'main',
                'title' => 'Imberel | Welcome'
            ]
        );
    }
}