<?php

namespace Imberel\Imberel\Core\View;

use Imberel\Imberel\Core\Application\Core;
use Imberel\Imberel\Core\Interface\View as InterfaceView;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class View implements InterfaceView
{
    public function view(string $view, array $params): string
    {
        foreach ($params as $key => $value) {

            $$key = $value;
        }
        \ob_start();
        require_once \getenv('VIEWS_DIR')  . $view . \getenv('VIEW_EXTENSION');
        return \ob_get_clean();
    }

    public function layout(): string
    {
        $layout = Core::$core->controller->getLayout();
        \ob_start();
        require_once \getenv('LAYOUTS_DIR') . getenv('LAYOUT_PREFIX') . $layout . \getenv('LAYOUT_EXTENSION');
        return \ob_get_clean();
    }

    public function render(string $view, array $params = []): string
    {
        return \str_replace(VIEW_PLACEHOLDER, $this->view($view, $params), $this->layout());
    }
}