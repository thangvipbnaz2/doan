<?php
declare(strict_types=1);
namespace App\Middleware;

use App\Auth\Auth;
use App\Helpers\View;

class GuestMiddleware
{
    public function handle(): void
    {
        if (Auth::check()) {
            header('Location: ' . View::baseUrl() . '/');
            exit;
        }
    }
}
