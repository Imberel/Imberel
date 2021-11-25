<?php

require __DIR__ . '/../vendor/autoload.php';

$app = start(\microtime(true));

$app->run();

stop(\microtime(true));