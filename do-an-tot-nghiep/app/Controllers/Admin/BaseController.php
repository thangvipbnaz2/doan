<?php
namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Helpers\View;
use App\Helpers\Session;
use App\Auth\Auth;

class BaseController extends Controller
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(View::baseUrl(), '/');

        if (!Auth::check() || !Auth::hasRole('admin')) {
            Session::flash('error', 'Bạn cần đăng nhập với quyền admin để truy cập trang này.');
            header('Location: ' . $this->baseUrl . '/login.php');
            exit;
        }
    }

    protected function adminView(string $view, array $data = []): void
    {
        $viewPath = 'admin/' . ltrim($view, '/');
        View::render($viewPath, $data, 'admin');
    }

    protected function adminRedirect(string $path): void
    {
        $this->redirect($this->baseUrl . '/' . ltrim($path, '/'));
    }
}
