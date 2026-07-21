<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đề thi | HànNgữ Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--teal:#0d9488;--teal-dark:#0f766e;--teal-light:#ccfbf1;--coral:#f97316;--coral-dark:#ea580c;--gold:#f59e0b;--dark:#0f172a;--dark-2:#1e293b;--dark-3:#334155;--gray:#64748b;--gray-light:#e2e8f0;--bg:#fafbfc;--radius:16px;--radius-sm:10px;--shadow:0 4px 24px rgba(0,0,0,0.05);--shadow-lg:0 8px 40px rgba(0,0,0,0.08);--transition:all .3s cubic-bezier(.4,0,.2,1);--font-sans:'Inter',sans-serif;--font-hanzi:'Noto Sans SC',sans-serif}
        body{font-family:var(--font-sans);background:var(--bg);color:var(--dark)}
        .admin-layout{display:flex;min-height:100vh}
        .admin-sidebar{width:260px;background:linear-gradient(180deg,#0f172a,#0b0f1a);color:#cbd5e1;padding:24px 0;position:fixed;height:100vh;overflow-y:auto;display:flex;flex-direction:column;z-index:100;border-right:1px solid rgba(255,255,255,0.04)}
        .admin-logo{display:flex;align-items:center;gap:12px;padding:0 20px 24px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:12px;font-family:var(--font-hanzi);font-size:1.4rem;font-weight:900;color:#fff;text-decoration:none}
        .admin-nav-item{display:flex;align-items:center;gap:12px;padding:12px 20px;color:#64748b;font-size:.88rem;font-weight:500;text-decoration:none;transition:all .25s;border-left:3px solid transparent}
        .admin-nav-item:hover{color:#fff;background:rgba(255,255,255,.05);border-left-color:var(--teal);padding-left:24px}
        .admin-nav-item--active{color:#fff;background:rgba(13,148,136,.12);border-left-color:var(--teal)}
        .admin-nav-item .icon{font-size:1.1rem;width:24px;text-align:center;opacity:.6}
        .admin-content{flex:1;margin-left:260px;padding:32px;background:linear-gradient(180deg,#f8fafb,#eff6ff);min-height:100vh}
        .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:12px}
        .admin-header h1{font-family:var(--font-sans);font-size:1.8rem;font-weight:800;color:var(--dark);letter-spacing:-0.03em}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 24px;border-radius:var(--radius-sm);font-weight:600;font-size:.9rem;transition:var(--transition);cursor:pointer;border:none;font-family:var(--font-sans);gap:8px;text-decoration:none}
        .btn--primary{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 4px 16px rgba(13,148,136,0.3)}
        .btn--primary:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(13,148,136,0.4)}
        .btn--small{padding:6px 14px;font-size:.82rem;border-radius:6px}
        .btn--danger{background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff}
        .btn--danger:hover{transform:translateY(-2px);box-shadow:0 4px 16px rgba(239,68,68,0.3)}
        .admin-card{background:#fff;border-radius:var(--radius);padding:24px;box-shadow:var(--shadow);border:1px solid var(--gray-light);margin-bottom:24px}
        .admin-table{width:100%;border-collapse:collapse;font-size:.9rem}
        .admin-table th{text-align:left;padding:12px 16px;font-size:.75rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600}
        .admin-table td{padding:12px 16px;border-bottom:1px solid var(--gray-light);vertical-align:middle}
        .admin-table tbody tr:hover{background:var(--teal-light)}
        .filter-tabs{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px}
        .filter-tab{padding:8px 20px;border:2px solid var(--gray-light);border-radius:8px;background:#fff;font-size:.85rem;font-weight:600;color:var(--gray);text-decoration:none;transition:var(--transition);font-family:var(--font-sans)}
        .filter-tab:hover{border-color:var(--teal);color:var(--teal)}
        .filter-tab--active,.filter-tab.active{background:var(--teal);border-color:var(--teal);color:#fff}
        .badge{padding:4px 12px;border-radius:50px;font-size:.75rem;font-weight:600;display:inline-block}
        .badge-hsk{background:var(--teal-light);color:var(--teal-dark)}
        .badge-hsk1{background:#dbeafe;color:#2563eb}
        .badge-hsk2{background:#fef3c7;color:#d97706}
        .badge-hsk3{background:#dbeafe;color:#2563eb}
        .badge-hsk4{background:#f3e8ff;color:#9333ea}
        .badge-hsk5{background:#fce7f3;color:#db2777}
        .badge-hsk6{background:#e0e7ff;color:#4338ca}
        .actions{display:flex;gap:6px;flex-wrap:wrap}
        @media(max-width:640px){.admin-sidebar{display:none}.admin-content{margin-left:0}}
    </style>
</head>
<body>
<div class="admin-layout">
    <nav class="admin-sidebar">
        <a href="admin_mvc.php" class="admin-logo">HànNgữ</a>
        <a href="admin_mvc.php" class="admin-nav-item"><span class="icon">📊</span> Dashboard</a>
        <a href="admin_mvc.php?action=lessons" class="admin-nav-item"><span class="icon">📖</span> Bài học</a>
        <a href="admin_mvc.php?action=vocab" class="admin-nav-item"><span class="icon">📚</span> Từ vựng</a>
        <a href="admin_mvc.php?action=grammar" class="admin-nav-item"><span class="icon">🔤</span> Ngữ pháp</a>
        <a href="admin_mvc.php?action=dialogues" class="admin-nav-item"><span class="icon">💬</span> Hội thoại</a>
        <a href="admin_mvc.php?action=readings" class="admin-nav-item"><span class="icon">📖</span> Đọc</a>
        <a href="admin_mvc.php?action=listening" class="admin-nav-item"><span class="icon">🎧</span> Nghe</a>
        <a href="admin_mvc.php?action=speaking" class="admin-nav-item"><span class="icon">🎤</span> Nói</a>
        <a href="admin_mvc.php?action=writing" class="admin-nav-item"><span class="icon">✍️</span> Viết</a>
        <a href="admin_mvc.php?action=exam" class="admin-nav-item admin-nav-item--active"><span class="icon">📝</span> Đề thi</a>
        <a href="admin_mvc.php?action=users" class="admin-nav-item"><span class="icon">👥</span> Người dùng</a>
        <a href="admin_mvc.php?action=orders" class="admin-nav-item"><span class="icon">🛒</span> Đơn hàng</a>
        <div style="flex:1"></div>
        <a href="index.php" class="admin-nav-item" style="margin-top:auto;border-top:1px solid rgba(255,255,255,0.06);padding-top:16px"><span class="icon">←</span> Về trang chủ</a>
    </nav>
    <main class="admin-content">
        <div class="admin-header">
            <h1>Đề thi</h1>
            <a href="admin_mvc.php?action=exam_create" class="btn btn--primary">+ Thêm đề thi</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
        <div style="padding:12px 20px;background:#d1fae5;color:#065f46;border-radius:10px;margin-bottom:20px;font-weight:500">
            <?= escape($_GET['msg'] === 'created' ? 'Đã tạo đề thi!' : ($_GET['msg'] === 'updated' ? 'Đã cập nhật!' : ($_GET['msg'] === 'deleted' ? 'Đã xóa!' : ''))) ?>
        </div>
        <?php endif; ?>

        <div class="filter-tabs">
            <a href="admin_mvc.php?action=exam" class="filter-tab <?= !$level ? 'active' : '' ?>">Tất cả</a>
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <a href="admin_mvc.php?action=exam&level=<?= $i ?>" class="filter-tab <?= $level === $i ? 'active' : '' ?>">HSK <?= $i ?></a>
            <?php endfor; ?>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Cấp độ</th><th>Tiêu đề</th><th>Thời gian</th><th>Số câu</th><th>Điểm đạt</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($exams)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--gray)">Chưa có đề thi nào</td></tr>
                <?php else: ?>
                    <?php foreach ($exams as $e): ?>
                    <tr>
                        <td><?= (int)$e['id'] ?></td>
                        <td><span class="badge badge-hsk<?= (int)$e['level'] ?>">HSK <?= (int)$e['level'] ?></span></td>
                        <td><strong><?= escape($e['title']) ?></strong></td>
                        <td><?= (int)$e['duration_minutes'] ?> phút</td>
                        <td><?= (int)$e['total_questions'] ?></td>
                        <td>≥ <?= (int)$e['passing_score'] ?>%</td>
                        <td class="actions">
                            <a href="admin_mvc.php?action=exam_edit&id=<?= (int)$e['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                            <a href="admin_mvc.php?action=exam_questions&id=<?= (int)$e['id'] ?>" class="btn btn--small btn--primary" style="background:var(--coral)">Câu hỏi</a>
                            <a href="admin_mvc.php?action=exam_delete&id=<?= (int)$e['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa đề thi này? Các câu hỏi liên quan cũng sẽ bị xóa.')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
</body>
</html>
