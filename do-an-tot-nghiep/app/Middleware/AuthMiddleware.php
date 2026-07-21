<?php
namespace App\Middleware;

use App\Helpers\Session;

class AuthMiddleware
{
    public function handle(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            Session::flash('error', 'Vui lòng đăng nhập để tiếp tục.');
            header('Location: /do-an-tot-nghiep/login.php');
            exit;
        }
    }
}
