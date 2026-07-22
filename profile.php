<?php
session_start();
require 'db.php';

$viewUserId = null;
$viewUser = null;
$isOwn = false;

$targetUser = $_GET['user'] ?? '';
$targetId = intval($_GET['id'] ?? 0);

if ($targetUser || $targetId) {
    if ($targetId) {
        $stmt = $conn->prepare("SELECT id, username, display_name, avatar, created_at FROM users WHERE id = ?");
        $stmt->execute([$targetId]);
    } else {
        $stmt = $conn->prepare("SELECT id, username, display_name, avatar, created_at FROM users WHERE username = ?");
        $stmt->execute([$targetUser]);
    }
    $viewUser = $stmt->fetch();
    if ($viewUser) {
        $viewUserId = $viewUser['id'];
        $isOwn = isset($_SESSION['user_id']) && $_SESSION['user_id'] == $viewUserId;
    }
} elseif (isset($_SESSION['user_id'])) {
    $viewUserId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT id, username, display_name, email, avatar, created_at FROM users WHERE id = ?");
    $stmt->execute([$viewUserId]);
    $viewUser = $stmt->fetch();
    $isOwn = true;
}

if (!$viewUser) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
    header('Location: profile.php');
    exit;
}

$uid = 'user_' . $viewUserId;
$vocabStmt = $conn->prepare("SELECT COUNT(*) FROM progress WHERE user_id = ? AND (write_completed = 1 OR speech_completed = 1)");
$vocabStmt->execute([$uid]);
$learnedCount = $vocabStmt->fetchColumn();

$quizStmt = $conn->prepare("SELECT COUNT(*) as cnt, COALESCE(ROUND(AVG(score * 100.0 / total_questions)), 0) as avg FROM quiz_results WHERE user_id = ?");
$quizStmt->execute([$uid]);
$qData = $quizStmt->fetch();
$quizCount = intval($qData['cnt'] ?? 0);
$quizAvg = intval($qData['avg'] ?? 0);

$lessonStmt = $conn->prepare("SELECT COUNT(*) FROM progress WHERE user_id = ? AND lesson_id IS NOT NULL AND write_completed = 1");
$lessonStmt->execute([$uid]);
$lessonsDone = $lessonStmt->fetchColumn();

$notebookStmt = $conn->prepare("SELECT COUNT(*) FROM notebook WHERE user_id = ?");
$notebookStmt->execute([$uid]);
$savedCount = $notebookStmt->fetchColumn();

// Lấy streak
$streak = 0;
$d = new DateTime();
while (true) {
    $check = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?");
    $check->execute([$uid, $d->format('Y-m-d')]);
    if ($check->fetch()) { $streak++; $d->modify('-1 day'); }
    else break;
}
$checkedToday = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = CURDATE()");
$checkedToday->execute([$uid]);
$checkedInToday = $checkedToday->fetch() ? true : false;

// Lấy chart data (7 ngày)
$chartData = [];
for ($i = 6; $i >= 0; $i--) {
    $date = (new DateTime())->modify("-{$i} days")->format('Y-m-d');
    $check = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?");
    $check->execute([$uid, $date]);
    $chartData[] = ['date' => $date, 'checked' => $check->fetch() ? 1 : 0];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isOwn ? 'Hồ sơ' : htmlspecialchars($viewUser['display_name']); ?> - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f0fdfa 0%,#f8fafc 40%,#eff6ff 100%)}
        .profile-hero{padding:48px 32px 36px;background:linear-gradient(135deg,#0f172a 0%,#1e293b 100%);border-radius:20px;margin-bottom:28px;position:relative;overflow:hidden;text-align:center}
        .profile-hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 0%,rgba(13,148,136,.12) 0%,transparent 60%),radial-gradient(ellipse at 80% 100%,rgba(59,130,246,.08) 0%,transparent 60%);pointer-events:none}
        .profile-hero::after{content:'';position:absolute;top:0;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,rgba(255,255,255,.08),transparent)}
        .profile-avatar-wrap{position:relative;z-index:1;display:inline-block;margin-bottom:16px}
        .profile-avatar{width:88px;height:88px;border-radius:50%;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;display:flex;align-items:center;justify-content:center;font-size:2.2rem;font-weight:800;margin:0 auto;user-select:none;overflow:hidden;border:3px solid rgba(255,255,255,.15);box-shadow:0 4px 20px rgba(0,0,0,.2)}
        .profile-avatar img{width:100%;height:100%;object-fit:cover}
        .profile-avatar__edit{position:absolute;bottom:0;left:50%;transform:translateX(-50%) translateY(50%);background:rgba(15,23,42,.85);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.1);color:#e2e8f0;font-size:.7rem;font-weight:600;padding:5px 14px;border-radius:50px;cursor:pointer;transition:all .2s;white-space:nowrap}
        .profile-avatar__edit:hover{background:#0d9488;color:#fff}
        .profile-hero__name{font-size:1.6rem;font-weight:800;color:#fff;position:relative;z-index:1}
        .profile-hero__username{color:#64748b;font-size:.9rem;margin-top:2px;position:relative;z-index:1}
        .profile-hero__badge{display:inline-flex;align-items:center;gap:6px;padding:4px 14px;background:rgba(13,148,136,.12);border:1px solid rgba(13,148,136,.2);border-radius:50px;color:#5eead4;font-size:.75rem;font-weight:600;margin-top:8px;position:relative;z-index:1}
        .profile-content{display:grid;grid-template-columns:1fr;gap:24px}
        .p-glass{background:rgba(255,255,255,.7);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px);border:1px solid rgba(255,255,255,.5);border-radius:16px;box-shadow:0 4px 24px rgba(0,0,0,.04),0 1px 4px rgba(0,0,0,.02)}
        .p-glass--solid{background:#fff;border:1px solid #f1f5f9}

        .streak-bar{display:flex;align-items:center;gap:20px;padding:16px 24px;margin-bottom:8px}
        .streak-fire{font-size:2rem;flex-shrink:0}
        .streak-info{flex:1}
        .streak-num{font-size:1.5rem;font-weight:800;color:#0f172a}
        .streak-label{font-size:.82rem;color:#64748b;margin-top:1px}
        .streak-btn{flex-shrink:0;padding:8px 24px;border-radius:50px;font-size:.82rem;font-weight:600;cursor:pointer;border:none;transition:all .2s;font-family:inherit;background:#0d9488;color:#fff}
        .streak-btn:hover{background:#0f766e;transform:translateY(-1px)}
        .streak-btn:disabled{opacity:.4;cursor:default;transform:none}
        .streak-chart{display:flex;justify-content:center;gap:6px;padding:0 24px 16px;height:48px;align-items:flex-end}
        .streak-chart__bar{width:28px;border-radius:4px 4px 0 0;background:#e2e8f0;transition:all .3s;min-height:6px;position:relative}
        .streak-chart__bar.filled{background:linear-gradient(180deg,#fbbf24,#f59e0b)}
        .streak-chart__label{position:absolute;bottom:-18px;left:50%;transform:translateX(-50%);font-size:.6rem;color:#94a3b8;white-space:nowrap;font-weight:500}

        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;padding:20px 24px}
        .stat-card{text-align:center;padding:16px 8px;background:#f8fafc;border-radius:12px;transition:all .2s}
        .stat-card:hover{background:#f1f5f9;transform:translateY(-2px)}
        .stat-card__icon{font-size:1.3rem;margin-bottom:4px;display:block}
        .stat-card__num{display:block;font-size:1.5rem;font-weight:800;color:#0f172a;line-height:1.2;font-variant-numeric:tabular-nums}
        .stat-card__label{font-size:.72rem;color:#64748b;font-weight:500;margin-top:2px;text-transform:uppercase;letter-spacing:.3px}

        .section-title{font-size:.82rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.6px;padding:20px 24px 0;display:flex;align-items:center;gap:8px}
        .section-title svg{flex-shrink:0}
        .info-grid{display:grid;grid-template-columns:1fr 1fr;gap:0;padding:12px 24px 20px}
        .info-item{padding:12px 0;border-bottom:1px solid #f1f5f9}
        .info-item:nth-last-child(-n+2){border-bottom:none}
        .info-item__label{font-size:.78rem;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:.3px}
        .info-item__value{font-size:.92rem;color:#0f172a;font-weight:600;margin-top:2px}
        .profile-actions{display:flex;gap:12px;padding:0 24px 24px;flex-wrap:wrap}
        .profile-actions .btn{flex:1;min-width:100px;justify-content:center}

        .edit-section{padding:20px 24px}
        .edit-form label{display:block;font-size:.78rem;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:.3px;margin-top:16px;margin-bottom:6px}
        .edit-form input{width:100%;padding:10px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:.92rem;outline:none;transition:all .2s;font-family:inherit;background:#fff}
        .edit-form input:focus{border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,.08)}
        .edit-actions{display:flex;gap:12px;margin-top:24px}

        .dashboard-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-top:8px}
        .d-card{padding:20px 24px}
        .d-card__title{font-size:.82rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:16px;display:flex;align-items:center;gap:8px}
        .d-stats{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .d-stat{text-align:center;padding:14px 8px;background:#f8fafc;border-radius:10px}
        .d-stat__num{font-size:1.3rem;font-weight:800;color:#0f172a}
        .d-stat__label{font-size:.7rem;color:#94a3b8;text-transform:uppercase;letter-spacing:.3px;margin-top:2px}
        .chart-wrap{position:relative;height:160px;margin-bottom:8px}
        .chart-wrap canvas{width:100%;height:100%}
        .levels-wrap{display:flex;flex-direction:column;gap:8px}
        .level-row{display:flex;align-items:center;gap:10px;font-size:.85rem;font-weight:600;color:#475569}
        .level-row__bar{flex:1;height:8px;background:#e2e8f0;border-radius:6px;overflow:hidden}
        .level-row__fill{height:100%;border-radius:6px;background:linear-gradient(90deg,#0d9488,#14b8a6);transition:width .6s ease}
        .level-row__count{font-size:.82rem;color:#94a3b8;font-weight:500;min-width:24px;text-align:right}
        .recent-list{max-height:260px;overflow-y:auto}
        .recent-item{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9;font-size:.85rem}
        .recent-item:last-child{border-bottom:none}
        .recent-item__tag{font-size:.7rem;font-weight:700;padding:3px 10px;border-radius:6px;text-align:center;flex-shrink:0;text-transform:uppercase;letter-spacing:.3px}
        .recent-item__tag.review{background:#f0fdfa;color:#0d9488}
        .recent-item__tag.write{background:#eff6ff;color:#3b82f6}
        .recent-item__tag.view{background:#f8fafc;color:#64748b}
        .recent-item__tag.handwriting{background:#fffbeb;color:#d97706}
        .recent-item__hanzi{font-family:'Noto Sans SC',sans-serif;font-weight:700;color:#0f172a}
        .recent-item__meaning{color:#94a3b8;font-size:.8rem}
        .recent-item__time{color:#cbd5e1;font-size:.75rem;margin-left:auto;white-space:nowrap}
        .empty-state{text-align:center;padding:40px 20px;color:#94a3b8}
        .empty-state__icon{font-size:3rem;margin-bottom:12px}
        .empty-state h4{font-size:1rem;font-weight:700;color:#475569;margin-bottom:4px}
        .empty-state p{font-size:.85rem}
        .back-link{display:inline-flex;align-items:center;gap:6px;font-size:.88rem;font-weight:600;color:#0d9488;text-decoration:none;padding:8px 0 0 4px;transition:all .2s}
        .back-link:hover{color:#0f766e;gap:10px}

        @media(max-width:768px){
            .stats-grid{grid-template-columns:repeat(2,1fr)}
            .info-grid{grid-template-columns:1fr}
            .dashboard-grid{grid-template-columns:1fr}
            .profile-hero{padding:36px 20px 28px}
            .profile-hero__name{font-size:1.3rem}
            .stat-card__num{font-size:1.2rem}
        }

        [data-theme="dark"] .profile-page { background: linear-gradient(180deg, #0f172a, #1e293b); }
        [data-theme="dark"] .p-glass { background: rgba(30,41,59,.7); border-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .p-glass--solid { background: #1e293b; border-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .stat-card { background: rgba(255,255,255,.04); }
        [data-theme="dark"] .stat-card:hover { background: rgba(255,255,255,.08); }
        [data-theme="dark"] .stat-card__num { color: #f1f5f9; }
        [data-theme="dark"] .stat-card__label { color: #64748b; }
        [data-theme="dark"] .section-title { color: #94a3b8; }
        [data-theme="dark"] .info-item { border-bottom-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .info-item__label { color: #64748b; }
        [data-theme="dark"] .info-item__value { color: #f1f5f9; }
        [data-theme="dark"] .streak-num { color: #f1f5f9; }
        [data-theme="dark"] .streak-label { color: #94a3b8; }
        [data-theme="dark"] .streak-chart__bar { background: rgba(255,255,255,.08); }
        [data-theme="dark"] .streak-chart__label { color: #64748b; }
        [data-theme="dark"] .edit-form label { color: #94a3b8; }
        [data-theme="dark"] .edit-form input { background: #0f172a; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .edit-form input:focus { border-color: #0d9488; }
        [data-theme="dark"] .d-card__title { color: #94a3b8; }
        [data-theme="dark"] .d-stat { background: rgba(255,255,255,.04); }
        [data-theme="dark"] .d-stat__num { color: #f1f5f9; }
        [data-theme="dark"] .d-stat__label { color: #64748b; }
        [data-theme="dark"] .level-row { color: #94a3b8; }
        [data-theme="dark"] .level-row__bar { background: rgba(255,255,255,.08); }
        [data-theme="dark"] .level-row__count { color: #64748b; }
        [data-theme="dark"] .recent-item { border-bottom-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .recent-item__tag.view { background: rgba(255,255,255,.06); color: #94a3b8; }
        [data-theme="dark"] .recent-item__hanzi { color: #f1f5f9; }
        [data-theme="dark"] .recent-item__meaning { color: #64748b; }
        [data-theme="dark"] .recent-item__time { color: rgba(255,255,255,.15); }
        [data-theme="dark"] .empty-state { color: #64748b; }
        [data-theme="dark"] .empty-state h4 { color: #94a3b8; }
        [data-theme="dark"] .edit-form div[style*="background"] { background: rgba(255,255,255,.08) !important; }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="profile-page">
    <div class="container">
        <?php if (!$isOwn && isset($_SESSION['user_id'])): ?>
        <a href="profile.php" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            Hồ sơ của tôi
        </a>
        <?php endif; ?>

        <div class="profile-hero">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar" id="avatar-container">
                    <?php if ($viewUser['avatar']): ?>
                        <img src="<?php echo htmlspecialchars($viewUser['avatar']); ?>" alt="Avatar">
                    <?php else: ?>
                        <?php echo strtoupper(mb_substr($viewUser['display_name'] ?: $viewUser['username'], 0, 1)); ?>
                    <?php endif; ?>
                </div>
                <?php if ($isOwn): ?>
                <div class="profile-avatar__edit" onclick="document.getElementById('avatar-input').click()">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:middle;margin-right:4px"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                    Đổi ảnh
                </div>
                <input type="file" id="avatar-input" accept="image/*" style="display:none">
                <?php endif; ?>
            </div>
            <h1 class="profile-hero__name"><?php echo htmlspecialchars($viewUser['display_name'] ?: $viewUser['username']); ?></h1>
            <p class="profile-hero__username">@<?php echo htmlspecialchars($viewUser['username']); ?><?php if (!$isOwn): ?> · <?php echo htmlspecialchars($viewUser['created_at']); ?><?php endif; ?></p>
            <?php if ($isOwn): ?>
            <div class="profile-hero__badge">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                Học viên HànNgữ
            </div>
            <?php endif; ?>
        </div>

        <div class="profile-content">
            <?php if ($isOwn): ?>
            <div class="p-glass">
                <div class="streak-bar">
                    <span class="streak-fire"><?php echo $streak >= 7 ? '🔥' : ($streak >= 3 ? '🔥' : '🔥'); ?></span>
                    <div class="streak-info">
                        <div class="streak-num" data-count="<?php echo $streak; ?>">0</div>
                        <div class="streak-label">ngày liên tiếp</div>
                    </div>
                    <button class="streak-btn ripple" id="checkin-btn">Điểm danh</button>
                </div>
                <div class="streak-chart" id="chart-bars">
                    <?php foreach ($chartData as $c): ?>
                    <div class="streak-chart__bar <?php echo $c['checked'] ? 'filled' : ''; ?>" style="height:<?php echo $c['checked'] ? 36 + ($streak * 2) : 6; ?>px">
                        <span class="streak-chart__label"><?php echo date('d/m', strtotime($c['date'])); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="p-glass">
                <div class="stats-grid">
                    <div class="stat-card">
                        <span class="stat-card__icon">📖</span>
                        <span class="stat-card__num" data-count="<?php echo $learnedCount; ?>">0</span>
                        <span class="stat-card__label">Từ đã học</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__icon">📚</span>
                        <span class="stat-card__num" data-count="<?php echo $lessonsDone; ?>">0</span>
                        <span class="stat-card__label">Bài học</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__icon">📝</span>
                        <span class="stat-card__num" data-count="<?php echo $quizAvg; ?>">0</span>
                        <span class="stat-card__label">Quiz (<?php echo $quizCount; ?> lượt)</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__icon">💾</span>
                        <span class="stat-card__num" data-count="<?php echo $savedCount; ?>">0</span>
                        <span class="stat-card__label">Đã lưu</span>
                    </div>
                </div>

                <?php if ($isOwn): ?>
                <div id="view-mode">
                    <div class="section-title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        Thông tin tài khoản
                    </div>
                    <div class="info-grid">
                        <div class="info-item"><div class="info-item__label">Email</div><div class="info-item__value" id="view-email"><?php echo htmlspecialchars($viewUser['email']); ?></div></div>
                        <div class="info-item"><div class="info-item__label">Ngày tham gia</div><div class="info-item__value"><?php echo $viewUser['created_at']; ?></div></div>
                        <div class="info-item"><div class="info-item__label">Tên đăng nhập</div><div class="info-item__value"><?php echo htmlspecialchars($viewUser['username']); ?></div></div>
                        <div class="info-item"><div class="info-item__label">ID người dùng</div><div class="info-item__value">#<?php echo $viewUserId; ?></div></div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn btn--primary ripple" onclick="toggleEdit()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                            Chỉnh sửa
                        </button>
                        <a href="lessons.php" class="btn btn--outline ripple">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            Tiếp tục học
                        </a>
                    </div>
                </div>

                <div id="edit-mode" style="display:none;">
                    <div class="edit-section">
                        <div class="section-title">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                            Chỉnh sửa hồ sơ
                        </div>
                        <form class="edit-form" id="profile-form" onsubmit="return false;">
                            <label>Tên hiển thị</label>
                            <input type="text" id="edit-display-name" value="<?php echo htmlspecialchars($viewUser['display_name'] ?: $viewUser['username']); ?>" required>
                            <label>Email</label>
                            <input type="email" id="edit-email" value="<?php echo htmlspecialchars($viewUser['email']); ?>" required>
                            <div style="height:1px;background:#e2e8f0;margin:20px 0"></div>
                            <label style="color:#94a3b8;font-weight:500;text-transform:none;letter-spacing:0;">Đổi mật khẩu (để trống nếu không đổi)</label>
                            <label>Mật khẩu hiện tại</label>
                            <input type="password" id="edit-cur-password" placeholder="Nhập mật khẩu hiện tại">
                            <label>Mật khẩu mới</label>
                            <input type="password" id="edit-new-password" placeholder="Tối thiểu 6 ký tự">
                            <div class="edit-actions">
                                <button type="submit" class="btn btn--primary ripple" onclick="saveProfile()" style="flex:1">Lưu thay đổi</button>
                                <button type="button" class="btn btn--outline ripple" onclick="toggleEdit()" style="flex:1">Huỷ</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="profile-actions" style="padding-bottom:20px;">
                    <a href="leaderboard.php" class="btn btn--outline ripple">🏆 BXH</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="pvp.php" class="btn btn--outline ripple">⚔ PvP</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($isOwn): ?>
            <div class="dashboard-grid">
                <div class="p-glass d-card">
                    <div class="d-card__title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                        Thống kê
                    </div>
                    <div class="d-stats" id="statsGrid">
                        <div class="d-stat"><div class="d-stat__num">-</div><div class="d-stat__label">Từ đã học</div></div>
                        <div class="d-stat"><div class="d-stat__num">-</div><div class="d-stat__label">Streak</div></div>
                        <div class="d-stat"><div class="d-stat__num">-</div><div class="d-stat__label">Đã ôn tập</div></div>
                        <div class="d-stat"><div class="d-stat__num">-</div><div class="d-stat__label">Quiz TB</div></div>
                    </div>
                </div>
                <div class="p-glass d-card">
                    <div class="d-card__title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                        Hoạt động 30 ngày
                    </div>
                    <div class="chart-wrap"><canvas id="activityChart"></canvas></div>
                </div>
                <div class="p-glass d-card">
                    <div class="d-card__title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        Từ vựng theo cấp độ
                    </div>
                    <div class="levels-wrap" id="statsLevels"></div>
                </div>
                <div class="p-glass d-card">
                    <div class="d-card__title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        Hoạt động gần đây
                    </div>
                    <div class="recent-list" id="statsRecent"><div class="empty-state" style="padding:20px">Đang tải...</div></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
<?php if ($isOwn): ?>
function toggleEdit() {
    document.getElementById('view-mode').style.display =
        document.getElementById('view-mode').style.display === 'none' ? 'block' : 'none';
    document.getElementById('edit-mode').style.display =
        document.getElementById('edit-mode').style.display === 'none' ? 'block' : 'none';
}

let _csrfToken = null;
async function getCsrfToken() {
    if (!_csrfToken) {
        const r = await fetch('auth.php?action=get_csrf_token');
        const d = await r.json();
        _csrfToken = d.csrf_token;
    }
    return _csrfToken;
}

async function saveProfile() {
    const token = await getCsrfToken();
    const data = {
        csrf_token: token,
        display_name: document.getElementById('edit-display-name').value.trim(),
        email: document.getElementById('edit-email').value.trim(),
        current_password: document.getElementById('edit-cur-password').value,
        new_password: document.getElementById('edit-new-password').value
    };
    if (!data.display_name || !data.email) { showToast('⚠ Vui lòng điền đầy đủ!', 'error'); return; }
    if (data.new_password && data.new_password.length < 6) { showToast('⚠ Mật khẩu mới tối thiểu 6 ký tự!', 'error'); return; }

    const res = await fetch('auth.php?action=update_profile', {
        method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data)
    });
    const r = await res.json();
    if (r.success) {
        localStorage.setItem('hanngu_display_name', data.display_name);
        document.getElementById('view-email').textContent = data.email;
        document.querySelector('.profile-hero__name').textContent = data.display_name;
        showToast('✅ ' + r.message, 'success');
        toggleEdit();
    } else {
        showToast('❌ ' + r.message, 'error');
    }
}

document.getElementById('avatar-input').addEventListener('change', async function() {
    if (!this.files || !this.files[0]) return;
    const fd = new FormData();
    fd.append('avatar', this.files[0]);
    try {
        const res = await fetch('api.php?action=upload_avatar', { method: 'POST', body: fd });
        const r = await res.json();
        if (r.success) {
            localStorage.setItem('hanngu_avatar', r.url);
            document.getElementById('avatar-container').innerHTML = '<img src="' + r.url + '?t=' + Date.now() + '" alt="Avatar">';
            showToast('✅ Đã cập nhật ảnh đại diện!', 'success');
        } else {
            showToast('❌ ' + r.message, 'error');
        }
    } catch (e) { showToast('❌ Lỗi upload!', 'error'); }
});

document.getElementById('checkin-btn').addEventListener('click', async function() {
    this.disabled = true;
    this.textContent = '⏳';
    try {
        const res = await fetch('api.php?action=checkin', {
            method: 'POST', headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: '<?php echo $uid; ?>' })
        });
        const r = await res.json();
        if (r.success) {
            showToast('✅ Đã điểm danh! Streak: ' + r.streak + ' ngày', 'success');
            document.querySelector('.streak-num').textContent = r.streak;
            this.textContent = '✅ Đã điểm danh';
            location.reload();
        } else {
            this.textContent = '✅ Đã điểm danh';
            this.disabled = true;
        }
    } catch (e) { this.textContent = 'Điểm danh'; this.disabled = false; }
});

<?php if ($checkedInToday): ?>
document.getElementById('checkin-btn').textContent = '✅ Đã điểm danh';
document.getElementById('checkin-btn').disabled = true;
<?php endif; ?>
<?php endif; ?>

async function loadStats() {
    try {
        const res = await fetch('api.php?action=get_study_stats&user_id=<?php echo $uid; ?>&days=30');
        const data = await res.json();
        if (!data) return;

        document.getElementById('statsGrid').innerHTML = `
            <div class="d-stat"><div class="d-stat__num">${data.total_studied}</div><div class="d-stat__label">Từ đã học</div></div>
            <div class="d-stat"><div class="d-stat__num">${data.current_streak}</div><div class="d-stat__label">Streak</div></div>
            <div class="d-stat"><div class="d-stat__num">${data.total_reviews}</div><div class="d-stat__label">Đã ôn tập</div></div>
            <div class="d-stat"><div class="d-stat__num">${data.quiz_avg}%</div><div class="d-stat__label">Quiz (${data.quiz_count})</div></div>
        `;

        const daily = data.daily || [];
        renderActivityChart(daily);

        const levels = data.by_level || [];
        const maxLevel = levels.reduce((m, l) => Math.max(m, parseInt(l.count)), 0);
        document.getElementById('statsLevels').innerHTML = levels.length ? levels.map(l =>
            '<div class="level-row"><span>HSK ' + l.level + '</span><div class="level-row__bar"><div class="level-row__fill" style="width:' + (l.count / maxLevel * 100) + '%"></div></div><span class="level-row__count">' + l.count + '</span></div>'
        ).join('') : '<div style="color:#94a3b8;font-size:.85rem;text-align:center;padding:20px;">Chưa có dữ liệu</div>';

        const recent = data.recent || [];
        const actionLabels = {view: 'Xem', write: 'Viết', review: 'Ôn tập', handwriting: 'Viết tay'};
        document.getElementById('statsRecent').innerHTML = recent.length ? recent.map(r =>
            '<div class="recent-item"><span class="recent-item__tag ' + r.action + '">' + (actionLabels[r.action] || r.action) + '</span><span class="recent-item__hanzi">' + (r.hanzi || '—') + '</span><span class="recent-item__meaning">' + (r.meaning || '') + '</span><span class="recent-item__time">' + timeAgo(r.created_at) + '</span></div>'
        ).join('') : '<div class="empty-state"><div class="empty-state__icon">📭</div><h4>Chưa có hoạt động</h4><p>Học bài để bắt đầu ghi lại tiến trình</p></div>';
    } catch(e) {
        console.error(e);
        showToast('❌ Không thể tải thống kê!', 'error');
    }
}

function renderActivityChart(daily) {
    const canvas = document.getElementById('activityChart');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const W = canvas.parentElement.clientWidth - 32;
    const H = 140;
    canvas.width = W * 2;
    canvas.height = H * 2;
    canvas.style.width = W + 'px';
    canvas.style.height = H + 'px';
    ctx.scale(2, 2);

    const values = daily.map(d => parseInt(d.total || 0));
    const maxVal = Math.max(...values, 1);
    const barW = Math.max(4, Math.min(14, (W - 40) / values.length - 2));
    const gap = 2;

    ctx.clearRect(0, 0, W, H);

    ctx.strokeStyle = '#e2e8f0';
    ctx.lineWidth = 1;
    for (let i = 0; i < 4; i++) {
        const y = 10 + (H - 30) * i / 3;
        ctx.beginPath(); ctx.moveTo(30, y); ctx.lineTo(W - 10, y); ctx.stroke();
    }

    const r = 2;
    values.forEach((v, i) => {
        const x = 30 + i * (barW + gap);
        const barH = (v / maxVal) * (H - 40);
        const y = H - 20 - barH;
        const gradient = ctx.createLinearGradient(x, y, x, H - 20);
        gradient.addColorStop(0, '#0d9488');
        gradient.addColorStop(1, '#5eead4');
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.moveTo(x + r, y);
        ctx.lineTo(x + barW - r, y);
        ctx.quadraticCurveTo(x + barW, y, x + barW, y + r);
        ctx.lineTo(x + barW, y + barH);
        ctx.lineTo(x, y + barH);
        ctx.lineTo(x, y + r);
        ctx.quadraticCurveTo(x, y, x + r, y);
        ctx.closePath();
        ctx.fill();
    });
}

function timeAgo(dateStr) {
    const d = new Date(dateStr.replace(' ', 'T') + 'Z');
    const now = new Date();
    const diff = Math.floor((now - d) / 1000);
    if (diff < 60) return 'Vừa xong';
    if (diff < 3600) return Math.floor(diff / 60) + ' phút';
    if (diff < 86400) return Math.floor(diff / 3600) + ' giờ';
    return Math.floor(diff / 86400) + ' ngày';
}

<?php if ($isOwn): ?>
loadStats();
<?php endif; ?>
</script>
</body>
</html>
