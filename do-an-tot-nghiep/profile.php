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
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $isOwn ? 'Hồ sơ' : htmlspecialchars($viewUser['display_name']); ?> - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc,#eff6ff)}
        .profile-card{background:#fff;border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);max-width:700px;margin:0 auto}
        .profile-header{text-align:center;margin-bottom:32px;padding-bottom:24px;border-bottom:1px solid var(--gray-light)}
        .profile-avatar{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,var(--red),var(--gold));color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:800;margin:0 auto 16px;user-select:none;overflow:hidden;position:relative}
        .profile-avatar img{width:100%;height:100%;object-fit:cover}
        .profile-avatar .avatar-edit{position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.5);color:#fff;font-size:.7rem;padding:4px;cursor:pointer}
        .profile-name{font-size:1.5rem;font-weight:800;color:var(--dark)}
        .profile-username{font-size:.9rem;color:var(--gray);margin-top:4px}
        .profile-stats{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:32px}
        .stat-item{text-align:center;padding:16px 8px;background:var(--red-light);border-radius:var(--radius-sm)}
        .stat-item__num{display:block;font-size:1.5rem;font-weight:900;color:var(--red-dark)}
        .stat-item__label{font-size:.75rem;color:var(--gray)}
        .profile-details h3{font-size:1rem;font-weight:700;color:var(--dark);margin-bottom:16px}
        .info-row{display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--gray-light);font-size:.9rem}
        .info-row__label{color:var(--gray)}
        .info-row__value{color:var(--dark);font-weight:600}
        .profile-actions{display:flex;gap:12px;margin-top:24px;flex-wrap:wrap}
        .profile-actions .btn{flex:1;min-width:120px}
        .edit-form label{display:block;font-size:.85rem;font-weight:600;color:var(--dark);margin-top:16px;margin-bottom:6px}
        .edit-form input{width:100%;padding:12px 16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:1rem;outline:none;transition:var(--transition)}
        .edit-form input:focus{border-color:var(--red)}
        .edit-form .btn{margin-top:20px}

        .streak-section{display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:24px;padding:12px;background:var(--gold-light);border-radius:var(--radius-sm)}
        .streak-fire{font-size:2rem}
        .streak-num{font-size:1.3rem;font-weight:800;color:var(--gold-dark)}
        .streak-label{font-size:.85rem;color:var(--gray)}
        .streak-btn{background:var(--gold);color:var(--dark);padding:8px 20px;border-radius:var(--radius-sm);font-weight:600;cursor:pointer;border:none;font-size:.85rem}
        .streak-btn:hover{background:var(--gold-dark)}
        .streak-btn:disabled{opacity:.5;cursor:default}
        .chart-bars{display:flex;gap:6px;justify-content:center;align-items:flex-end;height:60px;margin-top:8px}
        .chart-bar{width:36px;background:var(--red-light);border-radius:6px 6px 0 0;transition:var(--transition);position:relative;min-height:8px}
        .chart-bar.filled{background:var(--red)}
        .chart-bar-label{position:absolute;bottom:-20px;left:50%;transform:translateX(-50%);font-size:.65rem;color:var(--gray);white-space:nowrap}

        .stats-dashboard{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);padding:28px;margin-top:28px}
        .stats-dashboard__title{font-size:1.2rem;font-weight:700;color:var(--dark);margin-bottom:20px;display:flex;align-items:center;gap:8px}
        .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:24px}
        .stats-grid .stat-item{background:var(--red-light);border-radius:var(--radius-sm);padding:16px;text-align:center}
        .stats-grid .stat-item__num{display:block;font-size:1.4rem;font-weight:900;color:var(--red-dark)}
        .stats-grid .stat-item__label{font-size:.75rem;color:var(--gray)}
        .stats-chart-wrap{position:relative;height:180px;margin-bottom:16px;background:var(--gray-light);border-radius:var(--radius-sm);padding:16px}
        .stats-chart-wrap canvas{width:100%;height:100%}
        .stats-levels{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px}
        .stats-level{background:var(--red-light);padding:8px 14px;border-radius:var(--radius-sm);font-size:.85rem;font-weight:600;color:var(--red-dark);display:flex;align-items:center;gap:6px}
        .stats-level__bar{width:60px;height:6px;background:#fff;border-radius:4px;overflow:hidden}
        .stats-level__fill{height:100%;background:var(--red);border-radius:4px}
        .stats-recent{max-height:300px;overflow-y:auto}
        .stats-recent__item{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--gray-light);font-size:.88rem}
        .stats-recent__item:last-child{border-bottom:none}
        .stats-recent__action{width:70px;font-size:.75rem;font-weight:600;padding:3px 8px;border-radius:6px;text-align:center;flex-shrink:0}
        .stats-recent__action.review{background:var(--red-light);color:var(--red-dark)}
        .stats-recent__action.write{background:#dbeafe;color:#1d4ed8}
        .stats-recent__action.view{background:var(--gray-light);color:var(--gray)}
        .stats-recent__action.handwriting{background:var(--gold-light);color:var(--gold-dark)}
        .stats-recent__word{font-family:'Noto Sans SC',sans-serif;font-weight:700;color:var(--dark)}
        .stats-recent__time{color:var(--gray);font-size:.78rem;margin-left:auto}
        .stats-empty{text-align:center;padding:40px;color:var(--gray)}

        @media(max-width:600px){.profile-stats{grid-template-columns:repeat(2,1fr)}.stats-grid{grid-template-columns:repeat(2,1fr)}}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="profile-page">
        <div class="container">
            <?php if (!$isOwn && isset($_SESSION['user_id'])): ?>
            <div style="max-width:700px;margin:0 auto 16px;">
                <a href="profile.php" class="btn btn--sm btn--outline ripple">← Hồ sơ của tôi</a>
            </div>
            <?php endif; ?>

            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar" id="avatar-container">
                        <?php if ($viewUser['avatar']): ?>
                            <img src="<?php echo htmlspecialchars($viewUser['avatar']); ?>" alt="Avatar">
                        <?php else: ?>
                            <?php echo strtoupper(mb_substr($viewUser['display_name'] ?: $viewUser['username'], 0, 1)); ?>
                        <?php endif; ?>
                        <?php if ($isOwn): ?>
                            <div class="avatar-edit" onclick="document.getElementById('avatar-input').click()">Đổi ảnh</div>
                            <input type="file" id="avatar-input" accept="image/*" style="display:none">
                        <?php endif; ?>
                    </div>
                    <h1 class="profile-name"><?php echo htmlspecialchars($viewUser['display_name'] ?: $viewUser['username']); ?></h1>
                    <p class="profile-username">@<?php echo htmlspecialchars($viewUser['username']); ?></p>
                    <?php if (!$isOwn): ?>
                    <p style="color:var(--gray);font-size:.85rem;margin-top:8px;"><?php echo htmlspecialchars($viewUser['created_at']); ?></p>
                    <?php endif; ?>
                </div>

                <?php if ($isOwn): ?>
                <div class="streak-section">
                    <span class="streak-fire"></span>
                    <div>
                        <span class="streak-num" data-count="<?php echo $streak; ?>">0</span>
                        <span class="streak-label">ngày liên tiếp</span>
                    </div>
                    <button class="streak-btn ripple" id="checkin-btn">Điểm danh</button>
                </div>

                <div style="text-align:center;margin-bottom:24px;">
                    <h3 style="font-size:.9rem;font-weight:600;color:var(--gray);margin-bottom:8px;">7 ngày gần đây</h3>
                    <div class="chart-bars" id="chart-bars">
                        <?php foreach ($chartData as $c): ?>
                        <div class="chart-bar <?php echo $c['checked'] ? 'filled' : ''; ?>" style="height:<?php echo $c['checked'] ? '40' : '8'; ?>px">
                            <span class="chart-bar-label"><?php echo date('d/m', strtotime($c['date'])); ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="profile-stats">
                    <div class="stat-item">
                        <span class="stat-item__num" data-count="<?php echo $learnedCount; ?>">0</span>
                        <span class="stat-item__label">Từ đã học</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__num" data-count="<?php echo $lessonsDone; ?>">0</span>
                        <span class="stat-item__label">Bài học</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__num" data-count="<?php echo $quizAvg; ?>">0</span><span>%</span>
                        <span class="stat-item__label">Quiz (<?php echo $quizCount; ?> lượt)</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-item__num" data-count="<?php echo $savedCount; ?>">0</span>
                        <span class="stat-item__label">Đã lưu</span>
                    </div>
                </div>

                <?php if ($isOwn): ?>
                <div id="view-mode">
                    <div class="profile-details">
                        <h3> Thông tin tài khoản</h3>
                        <div class="info-row"><span class="info-row__label">Email</span><span class="info-row__value" id="view-email"><?php echo htmlspecialchars($viewUser['email']); ?></span></div>
                        <div class="info-row"><span class="info-row__label">Ngày tham gia</span><span class="info-row__value"><?php echo $viewUser['created_at']; ?></span></div>
                        <div class="info-row"><span class="info-row__label">Tên đăng nhập</span><span class="info-row__value"><?php echo htmlspecialchars($viewUser['username']); ?></span></div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn btn--primary ripple" onclick="toggleEdit()"> Chỉnh sửa</button>
                        <a href="lessons.php" class="btn btn--outline ripple"> Tiếp tục học</a>
                    </div>
                </div>

                <div id="edit-mode" style="display:none;">
                    <h3> Chỉnh sửa hồ sơ</h3>
                    <form class="edit-form" id="profile-form" onsubmit="return false;">
                        <label>Tên hiển thị</label>
                        <input type="text" id="edit-display-name" value="<?php echo htmlspecialchars($viewUser['display_name'] ?: $viewUser['username']); ?>" required>
                        <label>Email</label>
                        <input type="email" id="edit-email" value="<?php echo htmlspecialchars($viewUser['email']); ?>" required>
                        <hr style="margin:20px 0;border:none;border-top:1px solid var(--gray-light);">
                        <label style="color:var(--gray);font-size:.8rem;">Đổi mật khẩu (để trống nếu không đổi)</label>
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" id="edit-cur-password" placeholder="Nhập mật khẩu hiện tại">
                        <label>Mật khẩu mới</label>
                        <input type="password" id="edit-new-password" placeholder="Nhập mật khẩu mới (tối thiểu 6 ký tự)">
                        <div class="profile-actions">
                            <button type="submit" class="btn btn--primary ripple" onclick="saveProfile()"> Lưu</button>
                            <button type="button" class="btn btn--outline ripple" onclick="toggleEdit()">Huỷ</button>
                        </div>
                    </form>
                </div>
                <?php else: ?>
                <div class="profile-actions">
                    <a href="leaderboard.php" class="btn btn--outline ripple"> BXH</a>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="pvp.php" class="btn btn--outline ripple"> PvP</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ($isOwn): ?>
            <div class="stats-dashboard" id="statsDashboard">
                <h3 class="stats-dashboard__title"> Thống kê học tập</h3>
                <div class="stats-grid" id="statsGrid">
                    <div class="stat-item"><span class="stat-item__num" data-count="0">0</span><span class="stat-item__label">Từ đã học</span></div>
                    <div class="stat-item"><span class="stat-item__num" data-count="0">0</span><span class="stat-item__label">Streak</span></div>
                    <div class="stat-item"><span class="stat-item__num" data-count="0">0</span><span class="stat-item__label">Đã ôn tập</span></div>
                    <div class="stat-item"><span class="stat-item__num" data-count="0">0</span><span class="stat-item__label">Quiz TB</span></div>
                </div>
                <h4 style="font-size:.9rem;font-weight:600;color:var(--gray);margin-bottom:8px;">Hoạt động 30 ngày</h4>
                <div class="stats-chart-wrap"><canvas id="activityChart"></canvas></div>
                <h4 style="font-size:.9rem;font-weight:600;color:var(--gray);margin-bottom:8px;">Từ vựng theo cấp độ</h4>
                <div class="stats-levels" id="statsLevels"></div>
                <h4 style="font-size:.9rem;font-weight:600;color:var(--gray);margin-bottom:8px;">Hoạt động gần đây</h4>
                <div class="stats-recent" id="statsRecent"><div class="stats-empty empty-state-float">Đang tải...</div></div>
            </div>
            <?php endif; ?>

        </div>
    </main>
    
    <script>
    // Loading spinner
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    // Auto-hide on load
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

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
        if (!data.display_name || !data.email) { toast('Vui lòng điền đầy đủ!', 'error'); return; }
        if (data.new_password && data.new_password.length < 6) { toast('Mật khẩu mới tối thiểu 6 ký tự!', 'error'); return; }

        const res = await fetch('auth.php?action=update_profile', {
            method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data)
        });
        const r = await res.json();
        if (r.success) {
            localStorage.setItem('hanngu_display_name', data.display_name);
            document.getElementById('view-email').textContent = data.email;
            document.querySelector('.profile-name').textContent = data.display_name;
            toast(' ' + r.message, 'success');
            toggleEdit();
        } else {
            toast(' ' + r.message, 'error');
        }
    }

    // Avatar upload
    document.getElementById('avatar-input').addEventListener('change', async function() {
        if (!this.files || !this.files[0]) return;
        const fd = new FormData();
        fd.append('avatar', this.files[0]);
        try {
            const res = await fetch('api.php?action=upload_avatar', { method: 'POST', body: fd });
            const r = await res.json();
            if (r.success) {
                localStorage.setItem('hanngu_avatar', r.url);
                document.getElementById('avatar-container').innerHTML = '<img src="' + r.url + '?t=' + Date.now() + '" alt="Avatar"><div class="avatar-edit" onclick="document.getElementById(\'avatar-input\').click()">Đổi ảnh</div>';
                toast(' Đã cập nhật ảnh đại diện!', 'success');
            } else {
                toast(' ' + r.message, 'error');
            }
        } catch (e) { toast(' Lỗi upload!', 'error'); }
    });

    // Check-in
    document.getElementById('checkin-btn').addEventListener('click', async function() {
        this.disabled = true;
        this.textContent = '';
        try {
            const res = await fetch('api.php?action=checkin', {
                method: 'POST', headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: '<?php echo $uid; ?>' })
            });
            const r = await res.json();
            if (r.success) {
                toast(' Đã điểm danh! Streak: ' + r.streak + ' ngày', 'success');
                document.querySelector('.streak-num').textContent = r.streak;
                this.textContent = ' Đã điểm danh';
                // Refresh chart
                location.reload();
            } else {
                this.textContent = ' Đã điểm danh';
                this.disabled = true;
            }
        } catch (e) { this.textContent = 'Điểm danh'; this.disabled = false; }
    });

    // Kiểm tra đã điểm danh hôm nay
    <?php if ($checkedInToday): ?>
    document.getElementById('checkin-btn').textContent = ' Đã điểm danh';
    document.getElementById('checkin-btn').disabled = true;
    <?php endif; ?>
    <?php endif; ?>

    // Stats dashboard
    async function loadStats() {
        try {
            const res = await fetch('api.php?action=get_study_stats&user_id=<?php echo $uid; ?>&days=30');
            const data = await res.json();
            if (!data) return;

            document.getElementById('statsGrid').innerHTML = `
                <div class="stat-item"><span class="stat-item__num" data-count="${data.total_studied}">0</span><span class="stat-item__label">Từ đã học</span></div>
                <div class="stat-item"><span class="stat-item__num" data-count="${data.current_streak}">0</span><span class="stat-item__label">Streak </span></div>
                <div class="stat-item"><span class="stat-item__num" data-count="${data.total_reviews}">0</span><span class="stat-item__label">Đã ôn tập</span></div>
                <div class="stat-item"><span class="stat-item__num" data-count="${data.quiz_avg}">0</span><span class="stat-item__label">Quiz TB (${data.quiz_count})</span></div>
            `;

            // Activity chart
            const daily = data.daily || [];
            renderActivityChart(daily);

            // Levels
            const levels = data.by_level || [];
            const maxLevel = levels.reduce((m, l) => Math.max(m, parseInt(l.count)), 0);
            document.getElementById('statsLevels').innerHTML = levels.length ? levels.map(l => `
                <div class="stats-level">
                    HSK ${l.level}
                    <div class="stats-level__bar"><div class="stats-level__fill" style="width:${(l.count / maxLevel * 100)}%"></div></div>
                    ${l.count}
                </div>
            `).join('') : '<span style="color:var(--gray);font-size:.85rem;">Chưa có dữ liệu</span>';

            // Recent activity
            const recent = data.recent || [];
            const actionLabels = {view: 'Xem', write: 'Viết', review: 'Ôn tập', handwriting: 'Viết tay'};
            document.getElementById('statsRecent').innerHTML = recent.length ? recent.map(r => `
                <div class="stats-recent__item">
                    <span class="stats-recent__action ${r.action}">${actionLabels[r.action] || r.action}</span>
                    <span class="stats-recent__word">${r.hanzi || '—'}</span>
                    <span style="color:var(--dark-3);font-size:.82rem;">${r.meaning || ''}</span>
                    <span class="stats-recent__time">${timeAgo(r.created_at)}</span>
                </div>
            `).join('') : '<div class="stats-empty">Chưa có hoạt động nào</div>';
        } catch(e) {
            console.error(e);
            showToast(' Không thể tải thống kê!', 'error');
        }
    }

    function renderActivityChart(daily) {
        const canvas = document.getElementById('activityChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        const W = canvas.parentElement.clientWidth - 32;
        const H = 160;
        canvas.width = W * 2;
        canvas.height = H * 2;
        canvas.style.width = W + 'px';
        canvas.style.height = H + 'px';
        ctx.scale(2, 2);

        const values = daily.map(d => parseInt(d.total || 0));
        const maxVal = Math.max(...values, 1);
        const barW = Math.max(4, Math.min(16, (W - 40) / values.length - 2));
        const gap = 2;

        ctx.clearRect(0, 0, W, H);

        // Grid lines
        ctx.strokeStyle = '#e2e8f0';
        ctx.lineWidth = 1;
        for (let i = 0; i < 4; i++) {
            const y = 10 + (H - 30) * i / 3;
            ctx.beginPath(); ctx.moveTo(30, y); ctx.lineTo(W - 10, y); ctx.stroke();
        }

        // Bars
        const r = 2;
        values.forEach((v, i) => {
            const x = 30 + i * (barW + gap);
            const barH = (v / maxVal) * (H - 40);
            const y = H - 20 - barH;

            const gradient = ctx.createLinearGradient(x, y, x, H - 20);
            gradient.addColorStop(0, '#3b82f6');
            gradient.addColorStop(1, '#60a5fa');
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

    function toast(msg, type, duration) {
        type = type || 'info';
        showToast(msg, type, duration);
    }

    
        

    document.addEventListener('click', function(e) {
        document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
    });
</script>

    
<script src="init.js"></script>
</body>
</html>
