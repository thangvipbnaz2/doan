<?php
declare(strict_types=1);
namespace App\Middleware;

use App\Auth\Auth;
use App\Helpers\Session;
use App\Helpers\View;

class AuthMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            Session::flash('error', 'You must be logged in to access this page');
            header('Location: ' . View::baseUrl() . '/login.php');
            exit;
        }
    }
}
