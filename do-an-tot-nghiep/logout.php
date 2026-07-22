<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();

use App\Helpers\Session;

Session::start();
Session::destroy();

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
    exit;
}

header('Location: index.php');
exit;
