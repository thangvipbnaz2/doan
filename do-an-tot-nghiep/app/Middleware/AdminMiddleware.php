<?php
declare(strict_types=1);
namespace App\Middleware;

use App\Auth\Auth;
use App\Helpers\Session;
use App\Helpers\View;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            Session::flash('error', 'You must be logged in to access this page');
            header('Location: ' . View::baseUrl() . '/login.php');
            exit;
        }

        $user = Auth::user();
        $role = $user['role'] ?? '';
        $roleId = $user['role_id'] ?? 0;

        if ($role !== 'admin' && (int) $roleId !== 1) {
            http_response_code(403);
            echo '<h1>403 - Forbidden</h1><p>You do not have permission to access this page.</p>';
            exit;
        }
    }
}
