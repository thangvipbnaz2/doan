<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | HànNgữ Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .admin-layout{display:flex;min-height:100vh}
        .admin-sidebar{width:260px;background:linear-gradient(180deg,#0f172a,#0b0f1a);color:#cbd5e1;padding:24px 0;position:fixed;height:100vh;overflow-y:auto;display:flex;flex-direction:column;z-index:100;border-right:1px solid rgba(255,255,255,0.04)}
        .admin-logo{display:flex;align-items:center;gap:12px;padding:0 20px 24px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:12px;font-family:'Noto Sans SC',sans-serif;font-size:1.4rem;font-weight:900;color:#fff;text-decoration:none}
        .admin-nav-item{display:flex;align-items:center;gap:12px;padding:12px 20px;color:#64748b;font-size:.88rem;font-weight:500;text-decoration:none;transition:all .25s;border-left:3px solid transparent}
        .admin-nav-item:hover{color:#fff;background:rgba(255,255,255,.05);border-left-color:var(--teal);padding-left:24px}
        .admin-nav-item--active{color:#fff;background:rgba(13,148,136,.12);border-left-color:var(--teal)}
        .admin-nav-item .icon{font-size:1.1rem;width:24px;text-align:center;opacity:.6}
        .admin-nav-item:hover .icon,.admin-nav-item--active .icon{opacity:1}
        .admin-content{flex:1;margin-left:260px;padding:32px;background:linear-gradient(180deg,#f8fafb,#eff6ff);min-height:100vh}
        .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:12px}
        .admin-header h1{font-family:'Inter',sans-serif;font-size:1.8rem;font-weight:800;color:var(--dark);letter-spacing:-0.03em}
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:32px}
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
        .badge-info{background:#dbeafe;color:#2563eb}
        .quick-actions{display:flex;flex-direction:column;gap:10px}
        .quick-action-btn{display:flex;align-items:center;gap:12px;padding:14px 20px;border-radius:var(--radius-sm);background:var(--teal-light);color:var(--teal-dark);font-weight:600;font-size:.9rem;text-decoration:none;transition:var(--transition)}
        .quick-action-btn:hover{background:var(--teal);color:#fff;transform:translateX(4px)}
        .grid-2{display:grid;grid-template-columns:2fr 1fr;gap:24px}
        @media(max-width:900px){.admin-sidebar{width:220px}.admin-content{margin-left:220px;padding:24px}.grid-2{grid-template-columns:1fr}}
        @media(max-width:640px){.admin-sidebar{display:none}.admin-content{margin-left:0}}
    </style>
</head>
<body>
<div class="admin-layout">
    <nav class="admin-sidebar">
        <a href="admin_mvc.php" class="admin-logo">HànNgữ</a>
        <a href="admin_mvc.php" class="admin-nav-item admin-nav-item--active"><span class="icon">📊</span> Dashboard</a>
        <a href="admin_mvc.php?action=lessons" class="admin-nav-item"><span class="icon">📖</span> Bài học</a>
        <a href="admin_mvc.php?action=vocab" class="admin-nav-item"><span class="icon">📚</span> Từ vựng</a>
        <a href="admin_mvc.php?action=grammar" class="admin-nav-item"><span class="icon">🔤</span> Ngữ pháp</a>
        <a href="admin_mvc.php?action=dialogues" class="admin-nav-item"><span class="icon">💬</span> Hội thoại</a>
        <a href="admin_mvc.php?action=readings" class="admin-nav-item"><span class="icon">📖</span> Đọc</a>
        <a href="admin_mvc.php?action=listening" class="admin-nav-item"><span class="icon">🎧</span> Nghe</a>
        <a href="admin_mvc.php?action=speaking" class="admin-nav-item"><span class="icon">🎤</span> Nói</a>
        <a href="admin_mvc.php?action=writing" class="admin-nav-item"><span class="icon">✍️</span> Viết</a>
        <a href="admin_mvc.php?action=exam" class="admin-nav-item"><span class="icon">📝</span> Đề thi</a>
        <a href="admin_mvc.php?action=users" class="admin-nav-item"><span class="icon">👥</span> Người dùng</a>
        <a href="admin_mvc.php?action=orders" class="admin-nav-item"><span class="icon">🛒</span> Đơn hàng</a>
        <div style="flex:1"></div>
        <a href="index.php" class="admin-nav-item" style="margin-top:auto;border-top:1px solid rgba(255,255,255,0.06);padding-top:16px"><span class="icon">←</span> Về trang chủ</a>
    </nav>
    <main class="admin-content">
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
            <div class="stat-card stat-card--blue" style="grid-column:span 1">
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
                    <a href="admin_mvc.php?action=lesson_create" class="quick-action-btn">📖 Thêm bài học mới</a>
                    <a href="admin_mvc.php?action=vocab_create" class="quick-action-btn">📚 Thêm từ vựng mới</a>
                    <a href="admin_mvc.php?action=grammar_create" class="quick-action-btn">🔤 Thêm ngữ pháp mới</a>
                    <a href="admin_mvc.php?action=dialogues_create" class="quick-action-btn">💬 Thêm hội thoại mới</a>
                    <a href="admin_mvc.php?action=orders" class="quick-action-btn">🛒 Xem đơn hàng</a>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
