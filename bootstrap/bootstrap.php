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

function bootstrap()
{
    config();
}