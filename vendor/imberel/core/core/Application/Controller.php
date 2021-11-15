<?php

namespace Imberel\Imberel\Core\Application;

use Imberel\Imberel\Core\View\View;
use Imberel\Imberel\Core\Request\Request;
use Imberel\Imberel\Core\Application\Core;
use Imberel\Imberel\Core\Response\Response;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Controller
{
    public View $view;

    public Request $request;

    public Response $response;

    public string $layout = 'main';

    public string $title;

    public array $middlewares = [];

    public function __construct()
    {
        $this->view = new View;
        $this->request = new Request;
        $this->response = new Response;
    }

    public function layout(string $layout)
    {
        Core::$core->controller->setLayout($layout);
    }

    public function title(string $title)
    {
        Core::$core->controller->setTitle($title);
    }

    /**
     * Get the value of layout
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * Set the value of layout
     *
     * @return  self
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title  ?? $this->altTitle();
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    private function altTitle()
    {
        return getenv('APP_NAME') . " | " . getenv('APP_DESC');
    }

    public function middlewares()
    {
        return $this->middlewares;
    }

    public function middleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}