<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Helpers\View;
use App\Helpers\Session;

class BaseController extends Controller
{
    public function __construct()
    {
        $userId = Session::get('user_id');
        $role = Session::get('role');

        if (!$userId || $role !== 'admin') {
            Session::flash('error', 'Bạn cần đăng nhập với quyền admin để truy cập trang này.');
            header('Location: /do-an-tot-nghiep/login.php');
            exit;
        }
    }

    protected function adminView(string $view, array $data = []): void
    {
        $viewPath = 'admin/' . ltrim($view, '/');
        View::render($viewPath, $data, 'admin');
    }
}
