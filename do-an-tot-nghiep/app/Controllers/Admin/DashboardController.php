<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class DashboardController extends BaseController
{
    public function index(): void
    {
        $stats = [
            'total_users' => Database::fetch("SELECT COUNT(*) as cnt FROM users")['cnt'] ?? 0,
            'total_lessons' => Database::fetch("SELECT COUNT(*) as cnt FROM lessons")['cnt'] ?? 0,
            'total_vocab' => Database::fetch("SELECT COUNT(*) as cnt FROM vocab")['cnt'] ?? 0,
            'total_orders' => Database::fetch("SELECT COUNT(*) as cnt FROM orders")['cnt'] ?? 0,
            'total_revenue' => Database::fetch("SELECT SUM(amount) as total FROM orders WHERE status = 'completed'")['total'] ?? 0,
        ];

        $recentOrders = Database::fetchAll(
            "SELECT o.*, u.display_name as fullname FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT 5"
        );

        $this->adminView('dashboard/index', [
            'stats' => $stats,
            'recentOrders' => $recentOrders,
        ]);
    }
}
