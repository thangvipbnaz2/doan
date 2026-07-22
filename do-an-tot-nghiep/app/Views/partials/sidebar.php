<?php
$base = App\Helpers\View::baseUrl();
$userId = App\Helpers\Session::get('user_id');
$unreadNotifCount = 0;
$recentNotifs = [];
if ($userId) {
    $unreadNotifCount = App\Helpers\Database::fetch(
        "SELECT COUNT(*) as cnt FROM notifications WHERE user_id = ? AND is_read = 0",
        [$userId]
    )['cnt'] ?? 0;
    $recentNotifs = App\Helpers\Database::fetchAll(
        "SELECT * FROM notifications WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC LIMIT 5",
        [$userId]
    );
}
?>
<aside class="sidebar">
    <div class="sidebar-logo">
        <a href="<?= $base ?>/" class="logo-link">
            <h2>HànNgữ</h2>
            <small>Học tiếng Trung Online</small>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="<?= $base ?>/" class="nav-item"><i class="fas fa-home"></i> Trang chủ</a>
        <a href="<?= $base ?>/lessons" class="nav-item"><i class="fas fa-book"></i> Bài học</a>
        <a href="<?= $base ?>/flashcard_srs.php?action=study" class="nav-item"><i class="fas fa-tachometer-alt"></i> Ôn tập</a>
        <a href="<?= $base ?>/practice.php" class="nav-item"><i class="fas fa-clone"></i> Luyện tập</a>
        <a href="<?= $base ?>/dictionary_mvc.php" class="nav-item"><i class="fas fa-search"></i> Từ điển</a>
        <a href="<?= $base ?>/exam_mvc.php" class="nav-item"><i class="fas fa-file-alt"></i> Thi thử</a>
        <a href="<?= $base ?>/study_stats.php" class="nav-item"><i class="fas fa-chart-bar"></i> Thống kê</a>
        <a href="<?= $base ?>/community.php" class="nav-item"><i class="fas fa-users"></i> Cộng đồng</a>

        <?php if ($userId): ?>
        <div class="nav-section-label">Cá nhân</div>
        <a href="<?= $base ?>/dashboard" class="nav-item"><i class="fas fa-columns"></i> Bảng điều khiển</a>
        <a href="<?= $base ?>/goals" class="nav-item"><i class="fas fa-bullseye"></i> Mục tiêu</a>
        <a href="<?= $base ?>/favorites" class="nav-item"><i class="fas fa-heart"></i> Yêu thích</a>
        <a href="<?= $base ?>/notifications" class="nav-item notif-nav">
            <i class="fas fa-bell"></i> Thông báo
            <?php if ($unreadNotifCount > 0): ?>
            <span class="notif-badge"><?= $unreadNotifCount ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= $base ?>/profile.php" class="nav-item"><i class="fas fa-user"></i> Hồ sơ</a>
        <?php endif; ?>
    </nav>

    <div class="sidebar-footer">
        <?php if ($userId): ?>
        <a href="<?= $base ?>/logout.php" class="nav-item logout"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
        <?php $role = App\Helpers\Session::get('role'); ?>
        <?php if ($role === 'admin'): ?>
        <a href="<?= $base ?>/admin" class="nav-item admin-link"><i class="fas fa-cog"></i> Quản trị</a>
        <?php endif; ?>
        <?php else: ?>
        <a href="<?= $base ?>/login.php" class="nav-item"><i class="fas fa-user"></i> Đăng nhập</a>
        <a href="<?= $base ?>/register.php" class="nav-item register"><i class="fas fa-user-plus"></i> Đăng ký</a>
        <?php endif; ?>
    </div>

    <?php if (!empty($recentNotifs)): ?>
    <div class="notif-dropdown" id="notifDropdown">
        <div class="notif-dropdown-header">
            <span>Thông báo mới</span>
            <a href="<?= $base ?>/notifications" class="see-all">Xem tất cả</a>
        </div>
        <?php foreach ($recentNotifs as $n): ?>
        <a href="<?= $base ?>/notifications/mark-read/<?= $n['id'] ?>" class="notif-dropdown-item">
            <div class="ndi-icon notif-<?= $n['type'] ?>">
                <?php $icons = ['streak'=>'🔥','achievement'=>'🏆','reminder'=>'⏰','payment'=>'💰','course'=>'📚','system'=>'🔔']; echo $icons[$n['type']] ?? '🔔'; ?>
            </div>
            <div class="ndi-body">
                <div class="ndi-title"><?= App\Helpers\View::escape($n['title'] ?? '') ?></div>
                <div class="ndi-time"><?= date('H:i d/m', strtotime($n['created_at'])) ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</aside>

<style>
.sidebar {
    position: fixed; top: 0; left: 0; width: 260px; height: 100vh;
    background: #1a1a2e; color: #fff; padding: 20px 0;
    z-index: 1000; transition: transform 0.3s; overflow-y: auto;
    display: flex; flex-direction: column;
}
.sidebar-logo { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 8px; }
.logo-link { text-decoration: none; color: #fff; }
.sidebar-logo h2 { font-size: 22px; color: #e94560; margin: 0 0 2px; }
.sidebar-logo small { color: #aaa; font-size: 12px; }
.sidebar-nav { flex: 1; padding: 4px 0; }
.nav-section-label { padding: 16px 20px 4px; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #64748b; font-weight: 600; }
.nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 20px; color: #ccc; text-decoration: none;
    transition: all 0.2s; font-size: .9rem;
}
.nav-item:hover { background: rgba(233,69,96,0.15); color: #e94560; border-left: 3px solid #e94560; }
.nav-item i { width: 20px; text-align: center; font-size: 1rem; }
.notif-nav { position: relative; }
.notif-badge {
    margin-left: auto; background: #e94560; color: #fff;
    font-size: 11px; font-weight: 700; min-width: 20px; height: 20px;
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    padding: 0 6px;
}
.sidebar-footer { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 8px; margin-top: auto; }
.logout { color: #f5576c !important; }
.admin-link { color: #43e97b !important; }
.register { color: #43e97b !important; }
.main-content { margin-left: 260px; min-height: 100vh; }

.notif-dropdown {
    position: absolute; bottom: 60px; left: 20px; right: 20px;
    background: #16213e; border-radius: 12px; border: 1px solid rgba(255,255,255,0.1);
    padding: 12px; display: none; z-index: 100;
}
.sidebar:hover .notif-dropdown { display: block; }
.notif-dropdown-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; font-size: .8rem; }
.notif-dropdown-header span { font-weight: 600; font-size: .85rem; }
.see-all { color: #4facfe; text-decoration: none; font-size: .75rem; }
.notif-dropdown-item {
    display: flex; gap: 10px; padding: 8px 0; text-decoration: none;
    border-bottom: 1px solid rgba(255,255,255,0.05); align-items: flex-start;
}
.notif-dropdown-item:last-child { border-bottom: none; }
.ndi-icon { font-size: 1.2rem; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; flex-shrink: 0; }
.ndi-body { flex: 1; min-width: 0; }
.ndi-title { font-size: .8rem; color: #e2e8f0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.ndi-time { font-size: .7rem; color: #64748b; }
.notif-streak { background: rgba(251,191,36,0.2); }
.notif-achievement { background: rgba(250,204,21,0.2); }
.notif-reminder { background: rgba(59,130,246,0.2); }
.notif-payment { background: rgba(16,185,129,0.2); }
.notif-course { background: rgba(139,92,246,0.2); }
.notif-system { background: rgba(100,116,139,0.2); }
</style>
