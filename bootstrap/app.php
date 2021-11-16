<?php


new Imberel\Imberel\Core\Dotenv\Dotenv(ROOTDIR . '/.env');

bootstrap();

$app = new Imberel\Imberel\Core\Application\Core;


route($app);


$app->run();