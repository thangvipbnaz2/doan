<?php
require_once __DIR__ . '/../app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();

$config = require __DIR__ . '/../config/app.php';
date_default_timezone_set($config['timezone'] ?? 'Asia/Ho_Chi_Minh');
setlocale(LC_ALL, 'vi_VN.UTF-8', 'vi_VN', 'Vietnamese');

$router = new App\Router();

$routesCallback = require __DIR__ . '/../config/routes.php';
$routesCallback($router);

$router->resolve();
