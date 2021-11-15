<?php

namespace Imberel\Imberel\Core\Routing;

use Imberel\Imberel\Core\Extra\ICatch;
use Imberel\Imberel\Core\View\View;
use Imberel\Imberel\Core\Request\Request;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Router
{
    public Request $request;

    public View $view;

    public function __construct()
    {
        $this->request = new Request;
        $this->view = new View;
    }


    protected array $routes = [];

    public function get($path, $callback): void
    {
        $this->routes['get'][$path] = $callback;
        return;
    }

    public function post($path, $callback): void
    {
        $this->routes['post'][$path] = $callback;
        return;
    }

    public function resolve()
    {
        $callback = $this->routes[$this->request->method()][$this->request->path()] ?? false;
        try {
            return $this->check($callback);
        } catch (\Throwable $th) {
            new ICatch($th);
        }
    }

    private function check(mixed $callback)
    {
        if ($callback === false) {
            throw new \Exception("Page Not Found", 404);
        }

        if (is_string($callback)) {
            $this->view->render($callback);
            return;
        }
        if (is_array($callback)) {
            $callback[0] =  new $callback[0];
            foreach ($callback[0]->middlewares() as $middleware) {
                $middleware->handle();
            }
        }

        return call_user_func($callback);
    }
}