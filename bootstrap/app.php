<?php

config();

$app = new Imberel\Imberel\Core\Application\Core;


route($app);


$app->run();