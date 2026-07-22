<?php
$current_page = basename($_SERVER['PHP_SELF']);
function sidebarActive(string $page, string $current): string {
    return $current === $page ? ' sidebar__link--active' : '';
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<div class="loading-overlay" id="loading-overlay" style="display:none"><div class="spinner spinner--lg"></div></div>
<div class="sidebar-toggle-group">
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
</div>
<nav class="sidebar" id="sidebar">
    <ul class="sidebar__menu">
        <li><a href="index.php" class="sidebar__link<?= sidebarActive('index.php', $current_page) ?>"><i class="bi bi-house sidebar__icon"></i> Trang chủ</a></li>
        <li><a href="lessons.php" class="sidebar__link<?= sidebarActive('lessons.php', $current_page) ?><?= ($current_page === 'lesson.php' || $current_page === 'lesson-detail.php') ? ' sidebar__link--active' : '' ?>"><i class="bi bi-book sidebar__icon"></i> Bài học</a></li>
        <li><a href="flashcard.php" class="sidebar__link<?= sidebarActive('flashcard.php', $current_page) ?>"><i class="bi bi-collection sidebar__icon"></i> Flashcard</a></li>
        <li><a href="practice.php" class="sidebar__link<?= sidebarActive('practice.php', $current_page) ?>"><i class="bi bi-pencil-square sidebar__icon"></i> Luyện tập</a></li>
        <li><a href="dictionary.php" class="sidebar__link<?= sidebarActive('dictionary.php', $current_page) ?>"><i class="bi bi-bookmark sidebar__icon"></i> Từ điển</a></li>
        <li><a href="notebook.php" class="sidebar__link<?= sidebarActive('notebook.php', $current_page) ?>"><i class="bi bi-journal sidebar__icon"></i> Sổ tay</a></li>
        <li><a href="community.php" class="sidebar__link<?= sidebarActive('community.php', $current_page) ?>"><i class="bi bi-people sidebar__icon"></i> Cộng đồng</a></li>
        <li><a href="pvp.php" class="sidebar__link<?= sidebarActive('pvp.php', $current_page) ?>"><i class="bi bi-controller sidebar__icon"></i> PvP</a></li>
        <li><a href="leaderboard.php" class="sidebar__link<?= sidebarActive('leaderboard.php', $current_page) ?>"><i class="bi bi-trophy sidebar__icon"></i> BXH</a></li>
        <li><a href="radicals.php" class="sidebar__link<?= sidebarActive('radicals.php', $current_page) ?>"><i class="bi bi-grid-3x3 sidebar__icon"></i> Bộ thủ</a></li>
        <li><a href="ai_image.php" class="sidebar__link<?= sidebarActive('ai_image.php', $current_page) ?>"><i class="bi bi-camera sidebar__icon"></i> Nhận diện AI</a></li>
        <li><a href="voice_ai.php" class="sidebar__link<?= sidebarActive('voice_ai.php', $current_page) ?>"><i class="bi bi-mic sidebar__icon"></i> Luyện nói</a></li>
    </ul>
</nav>

<div class="header-auth" id="headerAuth">
    <button class="header-auth__theme-btn" id="theme-toggle" aria-label="Toggle theme">🌙</button>
    <div class="header-auth__guest" id="headerAuthGuest">
        <a href="login.php" class="btn btn--outline" style="padding:7px 14px;font-size:.82rem;font-weight:600"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
        <a href="register.php" class="btn btn--primary" style="padding:7px 14px;font-size:.82rem;font-weight:600"><i class="bi bi-person-plus"></i> Đăng ký</a>
    </div>
    <div class="header-auth__user" id="headerAuthUser" style="display:none">
        <div class="header-auth__avatar" id="headerAuthAvatar">?</div>
        <div class="header-auth__dropdown">
            <a href="profile.php" class="header-auth__dropdown-item"><i class="bi bi-person"></i> Hồ sơ</a>
            <a href="community.php?my=1" class="header-auth__dropdown-item"><i class="bi bi-file-text"></i> Bài viết của tôi</a>
            <a href="change_password.php" class="header-auth__dropdown-item"><i class="bi bi-shield-lock"></i> Đổi mật khẩu</a>
            <a href="admin.php" id="headerAuthAdmin" class="header-auth__dropdown-item" style="display:none"><i class="bi bi-gear"></i> Quản trị</a>
            <div class="header-auth__dropdown-divider"></div>
            <button id="headerAuthLogout" class="header-auth__dropdown-item" style="color:var(--coral);background:none;border:none;cursor:pointer;font-family:inherit;font-size:.9rem;width:100%;text-align:left;padding:10px 16px"><i class="bi bi-box-arrow-right"></i> Đăng xuất</button>
        </div>
    </div>
</div>

<script>
(function() {
    var theme = localStorage.getItem('hanngu_theme');
    if (theme === 'dark') document.documentElement.setAttribute('data-theme', 'dark');

    var toggle = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('sidebar');
    if (toggle && sidebar) {
        var overlay = document.createElement('div');
        overlay.className = 'sidebar-overlay';
        document.body.appendChild(overlay);
        sidebar.addEventListener('mouseenter', function(){ sidebar.classList.add('sidebar--open'); });
        sidebar.addEventListener('mouseleave', function(){ sidebar.classList.remove('sidebar--open'); toggle.classList.remove('sidebar-toggle--active'); overlay.classList.remove('sidebar-overlay--visible'); });
        toggle.addEventListener('mouseenter', function(){ sidebar.classList.add('sidebar--open'); });
        toggle.addEventListener('click', function(e){
            e.stopPropagation();
            sidebar.classList.toggle('sidebar--open');
            toggle.classList.toggle('sidebar-toggle--active');
            overlay.classList.toggle('sidebar-overlay--visible');
        });
        overlay.addEventListener('click', function(){
            sidebar.classList.remove('sidebar--open');
            toggle.classList.remove('sidebar-toggle--active');
            overlay.classList.remove('sidebar-overlay--visible');
        });
        document.addEventListener('click', function(e){
            if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('sidebar--open');
                toggle.classList.remove('sidebar-toggle--active');
                overlay.classList.remove('sidebar-overlay--visible');
            }
        });
    }

    var themeBtn = document.getElementById('theme-toggle');
    if (themeBtn) {
        var isDark = localStorage.getItem('hanngu_theme') === 'dark';
        if (isDark) document.documentElement.setAttribute('data-theme', 'dark');
        themeBtn.textContent = isDark ? '☀️' : '🌙';
        themeBtn.addEventListener('click', function(){
            var dark = document.documentElement.getAttribute('data-theme') === 'dark';
            if (dark) { document.documentElement.removeAttribute('data-theme'); localStorage.setItem('hanngu_theme', 'light'); themeBtn.textContent = '🌙'; }
            else { document.documentElement.setAttribute('data-theme', 'dark'); localStorage.setItem('hanngu_theme', 'dark'); themeBtn.textContent = '☀️'; }
        });
    }

    fetch('auth.php?action=check').then(function(r){return r.json()}).then(function(data){
        var guestEl = document.getElementById('headerAuthGuest');
        var userEl = document.getElementById('headerAuthUser');
        var avatar = document.getElementById('headerAuthAvatar');
        var adminEl = document.getElementById('headerAuthAdmin');
        if (data.logged_in && data.user_id) {
            localStorage.setItem('hanngu_user_id', data.user_id);
            localStorage.setItem('hanngu_username', data.user.username);
            localStorage.setItem('hanngu_display_name', data.user.display_name);
            localStorage.setItem('hanngu_avatar', data.user.avatar || '');
            if (guestEl) guestEl.style.display = 'none';
            if (userEl) userEl.style.display = 'block';
            var name = data.user.display_name || data.user.username || '?';
            if (avatar) {
                if (data.user.avatar) {
                    avatar.innerHTML = '<img src="' + data.user.avatar + '" style="width:100%;height:100%;border-radius:50%;object-fit:cover">';
                } else {
                    avatar.textContent = name.charAt(0).toUpperCase();
                }
            }
            if (adminEl && data.user.role === 'admin') adminEl.style.display = 'block';
        } else {
            var uid = localStorage.getItem('hanngu_user_id');
            var dn = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username');
            var av = localStorage.getItem('hanngu_avatar');
            if (uid && uid !== 'default_user') {
                if (guestEl) guestEl.style.display = 'none';
                if (userEl) userEl.style.display = 'block';
                if (avatar) {
                    if (av) {
                        avatar.innerHTML = '<img src="' + av + '" style="width:100%;height:100%;border-radius:50%;object-fit:cover">';
                    } else {
                        avatar.textContent = dn ? dn.charAt(0).toUpperCase() : '?';
                    }
                }
            }
        }
    }).catch(function(){});

    var logoutBtn = document.getElementById('headerAuthLogout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e){
            e.preventDefault();
            fetch('auth.php?action=logout').then(function(){
                localStorage.removeItem('hanngu_user_id');
                localStorage.removeItem('hanngu_username');
                localStorage.removeItem('hanngu_display_name');
                localStorage.removeItem('hanngu_avatar');
                window.location.reload();
            });
        });
    }
})();
</script>
<script src="utils.js"></script>
<script>
(function(){
    var userId = localStorage.getItem('hanngu_user_id');
    if (!userId) return;
    function checkBan() {
        fetch('api.php?action=check_ban_status')
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.banned) {
                    if (typeof showToast === 'function') {
                        showToast('Tài khoản của bạn đã bị khoá. Đang đăng xuất...', 'error');
                    }
                    setTimeout(function(){
                        localStorage.removeItem('hanngu_user_id');
                        localStorage.removeItem('hanngu_username');
                        localStorage.removeItem('hanngu_display_name');
                        localStorage.removeItem('hanngu_avatar');
                        fetch('auth.php?action=logout').then(function(){
                            window.location.href = 'login.php';
                        });
                    }, 2000);
                }
            })
            .catch(function(){});
    }
    checkBan();
    setInterval(checkBan, 45000);
})();
</script>
