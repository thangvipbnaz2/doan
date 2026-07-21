<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Câu hỏi đề thi | HànNgữ Admin</title>
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
        .admin-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:28px;flex-wrap:wrap;gap:12px}
        .admin-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);letter-spacing:-0.03em}
        .admin-header .sub{font-size:.9rem;color:var(--gray);font-weight:400}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:10px 20px;border-radius:var(--radius-sm);font-weight:600;font-size:.88rem;transition:var(--transition);cursor:pointer;border:none;font-family:var(--font-sans);gap:8px;text-decoration:none}
        .btn--primary{background:linear-gradient(135deg,var(--teal),var(--teal-dark));color:#fff}
        .btn--small{padding:5px 12px;font-size:.78rem;border-radius:6px}
        .btn--danger{background:#ef4444;color:#fff}
        .admin-card{background:#fff;border-radius:var(--radius);padding:24px;box-shadow:var(--shadow);border:1px solid var(--gray-light);margin-bottom:24px}
        .admin-table{width:100%;border-collapse:collapse;font-size:.88rem}
        .admin-table th{text-align:left;padding:10px 14px;font-size:.72rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600}
        .admin-table td{padding:10px 14px;border-bottom:1px solid var(--gray-light);vertical-align:middle}
        .admin-table tbody tr:hover{background:var(--teal-light)}
        .section-badge{padding:2px 8px;border-radius:4px;font-size:.7rem;font-weight:600}
        .section-badge.listening{background:#dbeafe;color:#2563eb}
        .section-badge.reading{background:#fef3c7;color:#d97706}
        .section-badge.grammar{background:#f3e8ff;color:#9333ea}
        .section-badge.writing{background:#fce7f3;color:#db2777}
        .form-card{background:#fff;border-radius:var(--radius);padding:24px;box-shadow:var(--shadow);border:1px solid var(--gray-light);margin-bottom:24px;max-width:700px}
        .form-card h3{font-size:1.1rem;font-weight:700;color:var(--dark);margin-bottom:16px}
        .fg{margin-bottom:16px}
        .fg label{display:block;font-size:.85rem;font-weight:600;color:var(--dark-3);margin-bottom:4px}
        .fg input,.fg select,.fg textarea{width:100%;padding:10px 14px;border:2px solid var(--gray-light);border-radius:8px;font-size:.9rem;transition:var(--transition);font-family:var(--font-sans);background:#fff;color:var(--dark)}
        .fg textarea{min-height:80px;resize:vertical}
        .fg input:focus,.fg select:focus,.fg textarea:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(13,148,136,.1)}
        .fg .help{font-size:.78rem;color:var(--gray);margin-top:4px}
        .actions{display:flex;gap:8px;margin-top:16px}
        .msg{padding:10px 16px;border-radius:8px;margin-bottom:16px;font-weight:500;font-size:.88rem}
        .msg.success{background:#d1fae5;color:#065f46}
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
            <div>
                <h1><?= escape($exam['title']) ?> <span class="sub">— Quản lý câu hỏi</span></h1>
                <p style="color:var(--gray);font-size:.9rem">HSK <?= (int)$exam['level'] ?> · <?= (int)$exam['total_questions'] ?> câu · <?= (int)$exam['duration_minutes'] ?> phút</p>
            </div>
            <a href="admin_mvc.php?action=exam" class="btn btn--primary">← Danh sách</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
        <div class="msg success"><?= $_GET['msg'] === 'added' ? 'Đã thêm câu hỏi!' : ($_GET['msg'] === 'deleted' ? 'Đã xóa câu hỏi!' : '') ?></div>
        <?php endif; ?>

        <div class="form-card">
            <h3>+ Thêm câu hỏi mới</h3>
            <form method="post" action="admin_mvc.php?action=exam_question_add">
                <input type="hidden" name="exam_id" value="<?= (int)$exam['id'] ?>">
                <div class="fg">
                    <label>Phần</label>
                    <select name="section">
                        <option value="listening">🎧 Nghe</option>
                        <option value="reading" selected>📖 Đọc</option>
                        <option value="grammar">🔤 Ngữ pháp</option>
                        <option value="writing">✍️ Viết</option>
                    </select>
                </div>
                <div class="fg">
                    <label>Câu hỏi</label>
                    <textarea name="question" required></textarea>
                </div>
                <div class="fg">
                    <label>Đáp án (mỗi dòng một lựa chọn)</label>
                    <textarea name="options" placeholder="Nhập các lựa chọn, mỗi dòng một đáp án. Để trống nếu là câu hỏi điền vào chỗ trống."></textarea>
                    <div class="help">Để trống nếu câu hỏi dạng điền từ (fill-in-the-blank)</div>
                </div>
                <div class="fg">
                    <label>Đáp án đúng</label>
                    <input type="text" name="answer" required>
                </div>
                <div class="fg">
                    <label>Giải thích</label>
                    <textarea name="explanation"></textarea>
                </div>
                <div class="fg">
                    <label>Điểm</label>
                    <input type="number" name="points" value="1" min="1">
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn--primary">Thêm câu hỏi</button>
                </div>
            </form>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead><tr><th>#</th><th>Phần</th><th>Câu hỏi</th><th>Đáp án</th><th>Điểm</th><th></th></tr></thead>
                <tbody>
                <?php if (empty($questions)): ?>
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--gray)">Chưa có câu hỏi nào</td></tr>
                <?php else: ?>
                    <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><?= (int)$q['question_number'] ?></td>
                        <td><span class="section-badge <?= $q['section'] ?>"><?= $q['section'] ?></span></td>
                        <td><?= escape(mb_truncate($q['question'], 80)) ?></td>
                        <td><?= escape(mb_truncate($q['answer'], 40)) ?></td>
                        <td><?= (int)$q['points'] ?></td>
                        <td><a href="admin_mvc.php?action=exam_question_delete&qid=<?= (int)$q['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa câu hỏi này?')">Xóa</a></td>
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
