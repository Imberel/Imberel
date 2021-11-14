<?php

function env(mixed $heystack)
{
    $position = \strpos($heystack, ',');
    $key = \substr($heystack, 0, $position);
    $value = \substr($heystack, $position + 1, \strlen($heystack));
    \putenv(\trim($key) . "=" . \trim($value));
}

function cons(mixed $heystack)
{
    $position = \strpos($heystack, ',');
    $key = \substr($heystack, 0, $position);
    $value = \substr($heystack, $position + 1, \strlen($heystack));
    \define(\trim($key), \trim($value));
}

function isession_start()
{
    if (\getenv('SESSION_DRIVER') === 'database') {
        $session = new Imberel\Imberel\Core\Session\DatabaseSession;
    }
    if (\getenv('SESSION_DRIVER') === 'files') {
        $session = new Imberel\Imberel\Core\Session\FileSystemSession;
    }
    $session->open();
    $session->write(USER_SESSION_ID);
    return $session;
}

function config()
{
    $dir = ROOTDIR . '/config/';
    $configs = \scandir($dir, \SORT_DESC);
    foreach ($configs as $config) {
        if ($config === '.' || $config === '..') {
            continue;
        }
        require_once $dir . $config;
    }
}

function css()
{
    $dir = ROOTDIR . '/resources/css/';
    $csss = \scandir($dir, \SORT_DESC);
    foreach ($csss as $css) {
        if ($css === '.' || $css === '..') {
            continue;
        }
        require_once $dir . $css;
    }
}

function javascript()
{
    $dir = ROOTDIR . '/resources/javascript/';
    $javascripts = \scandir($dir, \SORT_DESC);
    foreach ($javascripts as $javascript) {
        if ($javascript === '.' || $javascript === '..') {
            continue;
        }
        require_once $dir . $javascript;
    }
}

function route(Imberel\Imberel\Core\Application\Core $app)
{
    $router = $app->router;
    $dir = ROOTDIR . '/routes/';
    $routes = \scandir($dir, \SORT_DESC);
    foreach ($routes as $route) {
        if ($route === '.' || $route === '..') {
            continue;
        }
        require_once $dir . $route;
    }
}

function bootstrap()
{

    \error_reporting(E_ERROR);
    config();
    \restore_error_handler();
}






define('ROOTDIR', dirname(__DIR__));