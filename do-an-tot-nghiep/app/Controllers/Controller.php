<?php
namespace App\Controllers;

use App\BaseController as Base;
use App\Helpers\View;

class Controller extends Base
{
    protected function view(string $view, array $data = [], ?string $layout = null): void
    {
        View::render($view, $data, $layout);
    }

    protected function middleware(string $class): void
    {
        $middlewareClass = 'App\\Middleware\\' . $class;
        if (class_exists($middlewareClass)) {
            $instance = new $middlewareClass();
            $instance->handle();
        }
    }
}
