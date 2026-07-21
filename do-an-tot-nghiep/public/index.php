<?php
require_once __DIR__ . '/../app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();

$url = $_SERVER['REQUEST_URI'] ?? '/';
$url = parse_url($url, PHP_URL_PATH);
$url = rtrim($url, '/');

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if (strpos($url, $basePath) === 0) {
    $url = substr($url, strlen($basePath));
}
$url = $url ?: '/';

$routes = [
    '/' => ['Frontend\HomeController', 'index'],
    '/dashboard' => ['Frontend\DashboardController', 'index'],
    '/lessons' => ['Frontend\LessonController', 'index'],
    '/lesson/{id}' => ['Frontend\LessonController', 'show'],
    '/api/vocab' => ['Api\VocabApiController', 'list'],
    '/api/vocab/search' => ['Api\VocabApiController', 'search'],
    '/api/vocab/level/{level}' => ['Api\VocabApiController', 'byLevel'],
    '/api/vocab/lesson/{id}' => ['Api\VocabApiController', 'byLesson'],
    '/admin' => ['Admin\DashboardController', 'index'],
    '/admin/lessons' => ['Admin\LessonController', 'index'],
    '/admin/lessons/create' => ['Admin\LessonController', 'create'],
    '/admin/lessons/store' => ['Admin\LessonController', 'store'],
    '/admin/lessons/edit/{id}' => ['Admin\LessonController', 'edit'],
    '/admin/lessons/update/{id}' => ['Admin\LessonController', 'update'],
    '/admin/lessons/delete/{id}' => ['Admin\LessonController', 'delete'],
    '/admin/lessons/{id}/sections' => ['Admin\LessonController', 'manageSections'],
    '/admin/vocab' => ['Admin\VocabController', 'index'],
    '/admin/vocab/create' => ['Admin\VocabController', 'create'],
    '/admin/vocab/store' => ['Admin\VocabController', 'store'],
    '/admin/vocab/edit/{id}' => ['Admin\VocabController', 'edit'],
    '/admin/vocab/update/{id}' => ['Admin\VocabController', 'update'],
    '/admin/vocab/delete/{id}' => ['Admin\VocabController', 'delete'],
    '/admin/vocab/import' => ['Admin\VocabController', 'import'],
    '/admin/vocab/export' => ['Admin\VocabController', 'export'],
    '/admin/grammar' => ['Admin\GrammarController', 'index'],
    '/admin/grammar/create' => ['Admin\GrammarController', 'create'],
    '/admin/grammar/store' => ['Admin\GrammarController', 'store'],
    '/admin/grammar/edit/{id}' => ['Admin\GrammarController', 'edit'],
    '/admin/grammar/update/{id}' => ['Admin\GrammarController', 'update'],
    '/admin/grammar/delete/{id}' => ['Admin\GrammarController', 'delete'],
    '/admin/dialogues' => ['Admin\DialogueController', 'index'],
    '/admin/dialogues/create' => ['Admin\DialogueController', 'create'],
    '/admin/dialogues/store' => ['Admin\DialogueController', 'store'],
    '/admin/dialogues/edit/{id}' => ['Admin\DialogueController', 'edit'],
    '/admin/dialogues/update/{id}' => ['Admin\DialogueController', 'update'],
    '/admin/dialogues/delete/{id}' => ['Admin\DialogueController', 'delete'],
    '/admin/users' => ['Admin\UserController', 'index'],
    '/admin/users/edit-role/{id}' => ['Admin\UserController', 'editRole'],
    '/admin/users/delete/{id}' => ['Admin\UserController', 'delete'],
    '/admin/orders' => ['Admin\OrderController', 'index'],
    '/admin/orders/confirm/{id}' => ['Admin\OrderController', 'confirmPayment'],
    '/admin/orders/cancel/{id}' => ['Admin\OrderController', 'cancel'],
    '/admin/orders/invoice/{id}' => ['Admin\OrderController', 'invoice'],
];

$matched = false;
foreach ($routes as $pattern => $handler) {
    $regex = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);
    $regex = '#^' . $regex . '$#';
    if (preg_match($regex, $url, $matches)) {
        $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        $controller = 'App\\Controllers\\' . $handler[0];
        $action = $handler[1];

        if (class_exists($controller)) {
            $instance = new $controller();
            $instance->$action(...array_values($params));
            $matched = true;
            break;
        }
    }
}

if (!$matched) {
    http_response_code(404);
    include __DIR__ . '/../404.php';
}
