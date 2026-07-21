<?php
namespace App\Middleware;

use App\Helpers\Session;

class AdminMiddleware
{
    public function handle(): void
    {
        $userId = Session::get('user_id');
        $role = Session::get('role');

        if (!$userId || $role !== 'admin') {
            Session::flash('error', 'Bạn không có quyền truy cập trang này.');
            header('Location: /do-an-tot-nghiep/login.php');
            exit;
        }
    }
}
