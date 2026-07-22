<?php $base = App\Helpers\View::baseUrl(); ?>
<div class="admin-header">
    <h1>Dashboard</h1>
    <span style="font-size:.85rem;color:var(--gray)">Admin Panel</span>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value"><?= number_format($stats['total_users']) ?></div>
        <div class="stat-label">Người dùng</div>
    </div>
    <div class="stat-card stat-card--coral">
        <div class="stat-value"><?= number_format($stats['total_lessons']) ?></div>
        <div class="stat-label">Bài học</div>
    </div>
    <div class="stat-card stat-card--blue">
        <div class="stat-value"><?= number_format($stats['total_vocab']) ?></div>
        <div class="stat-label">Từ vựng</div>
    </div>
    <div class="stat-card">
        <div class="stat-value"><?= number_format($stats['total_grammar']) ?></div>
        <div class="stat-label">Ngữ pháp</div>
    </div>
    <div class="stat-card stat-card--purple">
        <div class="stat-value"><?= number_format($stats['total_dialogues']) ?></div>
        <div class="stat-label">Hội thoại</div>
    </div>
    <div class="stat-card stat-card--coral">
        <div class="stat-value"><?= number_format($stats['total_orders']) ?></div>
        <div class="stat-label">Đơn hàng</div>
    </div>
    <div class="stat-card stat-card--blue">
        <div class="stat-value"><?= number_format($stats['total_revenue'], 0, ',', '.') ?>₫</div>
        <div class="stat-label">Doanh thu</div>
    </div>
    <div class="stat-card" style="background:linear-gradient(135deg,#0f172a,#1a2332);color:#fff">
        <div class="stat-value" style="color:#fff"><?= number_format($stats['total_users'] + $stats['total_vocab'] + $stats['total_lessons']) ?></div>
        <div class="stat-label" style="color:rgba(255,255,255,0.6)">Tổng tương tác</div>
    </div>
</div>

<div class="grid-2">
    <div class="admin-card">
        <h3>Đơn hàng gần đây</h3>
        <table class="admin-table">
            <thead><tr><th>Mã ĐH</th><th>Khách hàng</th><th>Số tiền</th><th>Trạng thái</th><th>Ngày</th></tr></thead>
            <tbody>
            <?php if (empty($recentOrders)): ?>
                <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có đơn hàng nào</td></tr>
            <?php else: ?>
                <?php foreach ($recentOrders as $o): ?>
                <tr>
                    <td style="font-weight:600">#<?= escape($o['id']) ?></td>
                    <td><?= escape($o['display_name'] ?: $o['username']) ?></td>
                    <td style="font-weight:600"><?= number_format($o['amount'], 0, ',', '.') ?>₫</td>
                    <td><span class="badge badge-<?= $o['status'] === 'paid' ? 'success' : ($o['status'] === 'pending' ? 'warning' : 'danger') ?>"><?= escape($o['status']) ?></span></td>
                    <td style="font-size:.82rem;color:var(--gray)"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="admin-card">
        <h3>Thao tác nhanh</h3>
        <div class="quick-actions">
            <a href="<?= $base ?>/admin/lessons/create" class="quick-action-btn">📖 Thêm bài học mới</a>
            <a href="<?= $base ?>/admin/vocab/create" class="quick-action-btn">📚 Thêm từ vựng mới</a>
            <a href="<?= $base ?>/admin/grammar/create" class="quick-action-btn">🔤 Thêm ngữ pháp mới</a>
            <a href="<?= $base ?>/admin/dialogues/create" class="quick-action-btn">💬 Thêm hội thoại mới</a>
            <a href="<?= $base ?>/admin/orders" class="quick-action-btn">🛒 Xem đơn hàng</a>
        </div>
    </div>
</div>

<style>
    .stat-card{background:#fff;border-radius:var(--radius);padding:24px;box-shadow:var(--shadow);border:1px solid var(--gray-light);transition:var(--transition);position:relative;overflow:hidden}
    .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--teal),var(--coral))}
    .stat-card:hover{transform:translateY(-2px);box-shadow:var(--shadow-lg)}
    .stat-card .stat-value{font-size:2.2rem;font-weight:900;color:var(--teal);font-family:'Inter',sans-serif;letter-spacing:-0.03em;line-height:1.2}
    .stat-card .stat-label{font-size:.82rem;color:var(--gray);margin-top:4px;font-weight:500}
    .stat-card--coral::before{background:linear-gradient(90deg,var(--coral),#f59e0b)}
    .stat-card--coral .stat-value{color:var(--coral)}
    .stat-card--blue::before{background:linear-gradient(90deg,#3b82f6,#6366f1)}
    .stat-card--blue .stat-value{color:#3b82f6}
    .stat-card--purple::before{background:linear-gradient(90deg,#8b5cf6,#a855f7)}
    .stat-card--purple .stat-value{color:#8b5cf6}
    .admin-card{background:#fff;border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);border:1px solid var(--gray-light);margin-bottom:24px}
    .admin-card h3{font-size:1.1rem;font-weight:700;color:var(--dark);margin-bottom:16px;font-family:'Inter',sans-serif}
    .admin-table{width:100%;border-collapse:collapse;font-size:.9rem}
    .admin-table th{text-align:left;padding:12px 16px;font-size:.75rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600}
    .admin-table td{padding:12px 16px;border-bottom:1px solid var(--gray-light);vertical-align:middle}
    .admin-table tbody tr:hover{background:var(--teal-light)}
    .badge{padding:4px 12px;border-radius:50px;font-size:.75rem;font-weight:600;display:inline-block}
    .badge-success{background:#d1fae5;color:#065f46}
    .badge-warning{background:#fef3c7;color:#d97706}
    .badge-danger{background:#fee2e2;color:#dc2626}
    .quick-actions{display:flex;flex-direction:column;gap:10px}
    .quick-action-btn{display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:var(--radius-sm);background:var(--teal-light);color:var(--teal-dark);font-weight:600;font-size:.9rem;text-decoration:none;transition:var(--transition)}
    .quick-action-btn:hover{background:var(--teal);color:#fff;transform:translateX(4px)}
    .grid-2{display:grid;grid-template-columns:2fr 1fr;gap:24px}
    .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:32px}
</style>