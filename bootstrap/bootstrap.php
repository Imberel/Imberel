<?php

define('ROOTDIR', dirname(__DIR__));

function collect(mixed $key)
{
    return $_ENV[$key] ?? \getenv($key);
}

function core()
{
    return new Imberel\Imberel\Core\Application\Core::$core;
}

function env(mixed $heystack)
{
    $position = \strpos($heystack, ',');
    $key = \substr($heystack, 0, $position);
    $value = \substr($heystack, $position + 1, \strlen($heystack));
    if (empty(collect($key))) {
        $_ENV[$key] = $value;
        \putenv(\trim($key) . "=" . \trim($value));
    }
    return;
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
    if (\collect('SESSION_DRIVER') === 'database') {
        $session = new Imberel\Imberel\Core\Session\DatabaseSession;
    }
    if (\collect('SESSION_DRIVER') === 'files') {
        $session = new Imberel\Imberel\Core\Session\FileSystemSession;
    }
    $session->open();
    $session->write(USER_SESSION_ID);
    $session->gc(\intval(\collect('SESSION_LIFETIME', true)));
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

function css(): string
{
    $dir = ROOTDIR . '/resources/css/';
    $csss = \scandir($dir, \SCANDIR_SORT_ASCENDING);
    foreach ($csss as $css) {
        if ($css === '.' || $css === '..') {
            continue;
        }
        $css .= require_once $dir . $css;
    }
    return \printf('
    <style type="text/css">
    %s
    </style>
    ', $css);
}

function javascript(): string
{
    $dir = ROOTDIR . '/resources/javascript/';
    $javascripts = \scandir($dir, \SCANDIR_SORT_ASCENDING);
    foreach ($javascripts as $javascript) {
        if ($javascript === '.' || $javascript === '..') {
            continue;
        }
        $javascript .= require_once $dir . $javascript;
    }
    return \printf('
    <script type="text/javascript">
    %s
    </script>
    ', $javascript);
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
    config();
}