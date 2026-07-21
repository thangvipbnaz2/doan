<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bài nghe | HànNgữ Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--teal:#0d9488;--teal-dark:#0f766e;--teal-light:#ccfbf1;--coral:#f97316;--dark:#0f172a;--dark-3:#334155;--gray:#64748b;--gray-light:#e2e8f0;--bg:#fafbfc;--radius:16px;--radius-sm:10px;--shadow:0 4px 24px rgba(0,0,0,0.05);--transition:all .3s cubic-bezier(.4,0,.2,1);--font-sans:'Inter',sans-serif;--font-hanzi:'Noto Sans SC',sans-serif}
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
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 20px;border-radius:var(--radius-sm);font-weight:600;font-size:.85rem;transition:var(--transition);cursor:pointer;border:none;font-family:var(--font-sans);gap:8px;text-decoration:none}
        .btn--primary{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff}
        .btn--primary:hover{transform:translateY(-2px);box-shadow:0 4px 16px rgba(13,148,136,0.3)}
        .btn--small{padding:6px 12px;font-size:.78rem;border-radius:6px}
        .btn--danger{background:#ef4444;color:#fff}
        .btn--outline{border:2px solid var(--teal);color:var(--teal);background:transparent}
        .btn--outline:hover{background:var(--teal);color:#fff}
        .admin-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);border:1px solid var(--gray-light);overflow:hidden}
        .card-header{padding:20px 24px;border-bottom:1px solid var(--gray-light)}
        .filters{display:flex;gap:10px;align-items:center;flex-wrap:wrap}
        .filters select,.filters input{padding:8px 12px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-family:var(--font-sans);font-size:.85rem;background:#fafbfc;color:var(--dark)}
        .filters select:focus,.filters input:focus{outline:none;border-color:var(--teal)}
        .admin-table{width:100%;border-collapse:collapse}
        .admin-table th{text-align:left;padding:12px 16px;font-size:.75rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600;background:#fafbfc}
        .admin-table td{padding:12px 16px;border-bottom:1px solid var(--gray-light);vertical-align:middle}
        .admin-table tbody tr:hover{background:var(--teal-light)}
        .q-count{font-size:.78rem;color:var(--gray)}
        .pagination{display:flex;justify-content:center;gap:6px;padding:20px;flex-wrap:wrap}
        .page-link{padding:8px 14px;border:1px solid var(--gray-light);border-radius:6px;text-decoration:none;font-size:.85rem;font-weight:600;color:var(--dark-3);transition:var(--transition);background:#fff}
        .page-link:hover{border-color:var(--teal);color:var(--teal)}
        .page-link.active{background:var(--teal);border-color:var(--teal);color:#fff}
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
        <a href="admin_mvc.php?action=listening" class="admin-nav-item admin-nav-item--active"><span class="icon">🎧</span> Nghe</a>
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
            <h1>Bài nghe</h1>
            <a href="admin_mvc.php?action=listening_create" class="btn btn--primary">+ Thêm bài nghe</a>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <form method="GET" class="filters">
                    <input type="hidden" name="action" value="listening">
                    <select name="lesson_id">
                        <option value="">Tất cả bài học</option>
                        <?php foreach ($allLessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= (int)$lessonId === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn--primary btn--small">Lọc</button>
                </form>
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> bài nghe</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Tiêu đề</th><th>Bài học</th><th>Câu hỏi</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($listening)): ?>
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài nghe nào</td></tr>
                <?php else: ?>
                    <?php foreach ($listening as $ex): ?>
                    <tr>
                        <td><?= (int)$ex['id'] ?></td>
                        <td><strong><?= escape($ex['title']) ?></strong></td>
                        <td style="font-size:.82rem"><?= escape($ex['lesson_title'] ?? '-') ?></td>
                        <td class="q-count"><?= count($ex['questions']) ?> câu</td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="admin_mvc.php?action=listening_edit&id=<?= (int)$ex['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="admin_mvc.php?action=listening_delete&id=<?= (int)$ex['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài nghe này?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <?php if ($total > $perPage): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                <a href="admin_mvc.php?action=listening&page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>
</div>
</body>
</html>