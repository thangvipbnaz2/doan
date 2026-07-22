<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class NotificationController extends BaseController
{
    public function index(): void
    {
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM notifications")['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $notifications = Database::fetchAll(
            "SELECT n.*, u.display_name, u.username FROM notifications n LEFT JOIN users u ON n.user_id = u.id ORDER BY n.created_at DESC LIMIT ? OFFSET ?",
            [$perPage, $offset]
        );

        $this->adminView('notifications/index', [
            'notifications' => $notifications,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function markRead(int $id): void
    {
        Database::update('notifications', ['is_read' => 1, 'read_at' => date('Y-m-d H:i:s')], 'id = :id', ['id' => $id]);
        Session::flash('success', 'Đã đánh dấu đã đọc.');
        $this->adminRedirect('admin/notifications');
    }

    public function delete(int $id): void
    {
        Database::delete('notifications', 'id = ?', [$id]);
        Session::flash('success', 'Đã xóa thông báo.');
        $this->adminRedirect('admin/notifications');
    }
}
