<?php
namespace App\Controllers\Admin;

use App\Helpers\Database;
use App\Helpers\Session;

class OrderController extends BaseController
{
    public function index(): void
    {
        $status = $_GET['status'] ?? '';
        $page = (int) ($_GET['page'] ?? 1);
        $perPage = 20;

        $where = '';
        $params = [];
        if ($status !== '') {
            $where = 'WHERE o.status = ?';
            $params[] = $status;
        }

        $total = Database::fetch("SELECT COUNT(*) as cnt FROM orders o {$where}", $params)['cnt'] ?? 0;
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = max(1, min($page, $lastPage));
        $offset = ($page - 1) * $perPage;

        $orders = Database::fetchAll(
            "SELECT o.*, u.display_name as fullname, u.email FROM orders o JOIN users u ON o.user_id = u.id {$where} ORDER BY o.created_at DESC LIMIT {$perPage} OFFSET {$offset}",
            $params
        );

        $this->adminView('orders/index', [
            'orders' => $orders,
            'status' => $status,
            'page' => $page,
            'lastPage' => $lastPage,
            'total' => $total,
        ]);
    }

    public function confirmPayment(int $id): void
    {
        Database::update('orders', [
            'status' => 'completed',
            'paid_at' => date('Y-m-d H:i:s'),
        ], 'id = :id', ['id' => $id]);

        Session::flash('success', 'Thanh toán đã được xác nhận.');
        $this->redirect('/do-an-tot-nghiep/admin/orders');
    }

    public function cancel(int $id): void
    {
        Database::update('orders', ['status' => 'cancelled'], 'id = :id', ['id' => $id]);
        Session::flash('success', 'Đơn hàng đã bị hủy.');
        $this->redirect('/do-an-tot-nghiep/admin/orders');
    }

    public function invoice(int $id): void
    {
        $order = Database::fetch(
            "SELECT o.*, u.display_name as fullname, u.email FROM orders o JOIN users u ON o.user_id = u.id WHERE o.id = ?",
            [$id]
        );
        if (!$order) {
            Session::flash('error', 'Không tìm thấy đơn hàng.');
            $this->redirect('/do-an-tot-nghiep/admin/orders');
        }

        $items = Database::fetchAll("SELECT * FROM orders WHERE id = ?", [$id]);
        $items = $items ? [$items[0]] : [];

        $this->adminView('orders/invoice', [
            'order' => $order,
            'items' => $items,
        ]);
    }
}
