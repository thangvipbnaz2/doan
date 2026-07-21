<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class UserController extends BaseController
{
    public function index(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;
        $search = $_GET['search'] ?? '';

        $where = '';
        $params = [];
        if ($search !== '') {
            $where = 'WHERE fullname LIKE ? OR email LIKE ? OR username LIKE ?';
            $params = ["%{$search}%", "%{$search}%", "%{$search}%"];
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM users {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $users = Database::fetchAll(
            "SELECT * FROM users {$where} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $this->adminView('users/index', [
            'users' => $users,
            'search' => $search,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function editRole(int $id): void
    {
        if ($this->isPost()) {
            $role = $_POST['role'] ?? 'user';
            Database::update('users', ['role' => $role], 'id = :id', ['id' => $id]);
            Session::flash('success', 'Vai trò người dùng đã được cập nhật.');
        }
        $this->redirect('/do-an-tot-nghiep/admin/users');
    }

    public function delete(int $id): void
    {
        Database::delete('users', 'id = ?', [$id]);
        Session::flash('success', 'Người dùng đã được xóa.');
        $this->redirect('/do-an-tot-nghiep/admin/users');
    }
}
