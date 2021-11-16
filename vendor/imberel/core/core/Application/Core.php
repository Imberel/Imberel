<?php

namespace Imberel\Imberel\Core\Application;

use Imberel\Imberel\Core\Extra\ICatch;
use Imberel\Imberel\Core\Routing\Router;
use Imberel\Imberel\Core\Session\Session;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class Core
{
    public Router $router;

    public static Core $core;

    public Controller $controller;

    public const BEFORE_REQUEST = "Before Request";

    public const AFTER_REQUEST = "After Request";

    protected array $listeners = [];


    public function __construct()
    {
        self::$core = $this;
        $this->session = isession_start();
        $this->router = new Router;
        $this->controller = new Controller;
    }

    public function run()
    {
        echo $this->triggerEvent(self::BEFORE_REQUEST);
        echo $this->router->resolve();
        return;
    }

    public function triggerEvent($event)
    {
        $callbacks = $this->listeners[$event] ?? [];
        foreach ($callbacks as $callback) {
            return call_user_func($callback);
        }
    }

    public function on($event, $callback)
    {
        $this->listeners[$event][] = $callback;
    }

    public function isGuest()
    {
        if ($this->session->guest(USER_SESSION_ID)) {
            return true;
        }

        return false;
    }

    public function key()
    {
        return collect('APP_KEY') ?? 'userid';
    }
}