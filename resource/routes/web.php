<?php

use Imberel\Imberel\Controller\HomeController;

$router->get('/', [HomeController::class, 'home']);