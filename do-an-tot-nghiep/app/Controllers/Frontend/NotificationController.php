<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;

class NotificationController extends Controller
{
    public function index(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->redirect('login.php');
            return;
        }

        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $total = Database::fetch(
            "SELECT COUNT(*) as cnt FROM notifications WHERE user_id = ?",
            [$userId]
        )['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $notifications = Database::fetchAll(
            "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ? OFFSET ?",
            [$userId, $perPage, $offset]
        );

        $unreadCount = Database::fetch(
            "SELECT COUNT(*) as cnt FROM notifications WHERE user_id = ? AND is_read = 0",
            [$userId]
        )['cnt'] ?? 0;

        $this->view('frontend/notification/index', [
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function markRead(int $id): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        Database::update('notifications', ['is_read' => 1], 'id = :id AND user_id = :uid', ['id' => $id, 'uid' => $userId]);
        $this->redirect('notifications');
    }

    public function markAllRead(): void
    {
        $userId = Session::get('user_id');
        if ($userId) {
            Database::update('notifications', ['is_read' => 1], 'user_id = :uid AND is_read = 0', ['uid' => $userId]);
        }
        $this->redirect('notifications');
    }
}
