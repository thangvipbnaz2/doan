<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($editing) ? 'Sửa' : 'Thêm' ?> đề thi | HànNgữ Admin</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--teal:#0d9488;--teal-dark:#0f766e;--teal-light:#ccfbf1;--coral:#f97316;--dark:#0f172a;--dark-2:#1e293b;--dark-3:#334155;--gray:#64748b;--gray-light:#e2e8f0;--bg:#fafbfc;--radius:16px;--radius-sm:10px;--shadow:0 4px 24px rgba(0,0,0,0.05);--transition:all .3s cubic-bezier(.4,0,.2,1);--font-sans:'Inter',sans-serif}
        body{font-family:var(--font-sans);background:var(--bg);color:var(--dark)}
        .admin-layout{display:flex;min-height:100vh}
        .admin-sidebar{width:260px;background:linear-gradient(180deg,#0f172a,#0b0f1a);color:#cbd5e1;padding:24px 0;position:fixed;height:100vh;overflow-y:auto;display:flex;flex-direction:column;z-index:100;border-right:1px solid rgba(255,255,255,0.04)}
        .admin-logo{display:flex;align-items:center;gap:12px;padding:0 20px 24px;border-bottom:1px solid rgba(255,255,255,0.06);margin-bottom:12px;font-family:'Noto Sans SC',sans-serif;font-size:1.4rem;font-weight:900;color:#fff;text-decoration:none}
        .admin-nav-item{display:flex;align-items:center;gap:12px;padding:12px 20px;color:#64748b;font-size:.88rem;font-weight:500;text-decoration:none;transition:all .25s;border-left:3px solid transparent}
        .admin-nav-item:hover{color:#fff;background:rgba(255,255,255,.05);border-left-color:var(--teal);padding-left:24px}
        .admin-nav-item--active{color:#fff;background:rgba(13,148,136,.12);border-left-color:var(--teal)}
        .admin-content{flex:1;margin-left:260px;padding:32px;background:linear-gradient(180deg,#f8fafb,#eff6ff);min-height:100vh}
        .admin-header{margin-bottom:28px}
        .admin-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);letter-spacing:-0.03em}
        .form-card{background:#fff;border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);border:1px solid var(--gray-light);max-width:600px}
        .fg{margin-bottom:20px}
        .fg label{display:block;font-size:.88rem;font-weight:600;color:var(--dark-3);margin-bottom:6px}
        .fg input,.fg select{width:100%;padding:12px 16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;transition:var(--transition);font-family:var(--font-sans);background:#fff;color:var(--dark)}
        .fg input:focus,.fg select:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(13,148,136,.1)}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 28px;border-radius:var(--radius-sm);font-weight:600;font-size:.9rem;transition:var(--transition);cursor:pointer;border:none;font-family:var(--font-sans);gap:8px;text-decoration:none}
        .btn--primary{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff;box-shadow:0 4px 16px rgba(13,148,136,0.3)}
        .btn--primary:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(13,148,136,0.4)}
        .btn--outline{border:2px solid var(--teal);color:var(--teal);background:transparent}
        .btn--outline:hover{background:var(--teal);color:#fff}
        .actions{display:flex;gap:12px;margin-top:24px}
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
            <h1><?= isset($editing) ? 'Sửa đề thi' : 'Thêm đề thi mới' ?></h1>
        </div>
        <div class="form-card">
            <form method="post" action="admin_mvc.php?action=<?= isset($editing) ? 'exam_update&id=' . (int)$exam['id'] : 'exam_save' ?>">
                <div class="fg">
                    <label>Cấp độ HSK</label>
                    <select name="level">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <option value="<?= $i ?>" <?= (isset($exam) && (int)$exam['level'] === $i) ? 'selected' : '' ?>>HSK <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" value="<?= isset($exam) ? escape($exam['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Thời gian (phút)</label>
                    <input type="number" name="duration_minutes" value="<?= isset($exam) ? (int)$exam['duration_minutes'] : 40 ?>" min="1" required>
                </div>
                <div class="fg">
                    <label>Tổng số câu hỏi</label>
                    <input type="number" name="total_questions" value="<?= isset($exam) ? (int)$exam['total_questions'] : 40 ?>" min="1" required>
                </div>
                <div class="fg">
                    <label>Điểm đạt (%)</label>
                    <input type="number" name="passing_score" value="<?= isset($exam) ? (int)$exam['passing_score'] : 60 ?>" min="1" max="100" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn--primary"><?= isset($editing) ? 'Cập nhật' : 'Tạo đề thi' ?></button>
                    <a href="admin_mvc.php?action=exam" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
