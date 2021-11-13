<?php

use Imberel\Imberel\Http\Controllers\AuthController;
use Imberel\Imberel\Http\Controllers\HomeController;
use Imberel\Imberel\Http\Controllers\UserController;



$router->get("/", [HomeController::class, "home"]);
$router->get("/register", [AuthController::class, "register"]);
$router->post("/register", [AuthController::class, "register"]);
$router->get("/login", [AuthController::class, "login"]);
$router->post("/login", [AuthController::class, "login"]);
$router->get("/resetpassword", [AuthController::class, "resetpassword"]);
$router->post("/resetpassword", [AuthController::class, "resetpassword"]);
$router->get('/user', [UserController::class, "dashboard"]);