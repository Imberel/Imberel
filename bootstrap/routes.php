<?php

//$router = $app->router;
$dir = ROOTDIR . '/routes/';
$routes = \scandir($dir, \SORT_DESC);
foreach ($routes as $route) {
    if ($route === '.' || $route === '..') {
        continue;
    }
    require_once $dir . $route;
}