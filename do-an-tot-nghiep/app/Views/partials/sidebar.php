<aside class="sidebar" style="position: fixed; top: 0; left: 0; width: 260px; height: 100vh; background: #1a1a2e; color: #fff; padding: 20px 0; z-index: 1000; transition: transform 0.3s; overflow-y: auto;">
    <div class="sidebar-logo" style="padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;">
        <a href="/do-an-tot-nghiep/" style="text-decoration: none; color: #fff;">
            <h2 style="font-size: 22px; color: #e94560;">HànNgữ</h2>
            <small style="color: #aaa;">Học tiếng Trung Online</small>
        </a>
    </div>

    <nav class="sidebar-nav">
        <a href="/do-an-tot-nghiep/" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #ccc; text-decoration: none; transition: all 0.3s;">
            <i class="fas fa-home" style="width: 20px;"></i> Trang chủ
        </a>
        <a href="/do-an-tot-nghiep/lessons" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #ccc; text-decoration: none; transition: all 0.3s;">
            <i class="fas fa-book" style="width: 20px;"></i> Bài học
        </a>
        <a href="/do-an-tot-nghiep/dashboard" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #ccc; text-decoration: none; transition: all 0.3s;">
            <i class="fas fa-tachometer-alt" style="width: 20px;"></i> Bảng điều khiển
        </a>
        <a href="/do-an-tot-nghiep/dashboard" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #ccc; text-decoration: none; transition: all 0.3s;">
            <i class="fas fa-clone" style="width: 20px;"></i> Ôn tập
        </a>
    </nav>

    <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 20px 20px 0; padding-top: 20px;">
        <?php $userId = App\Helpers\Session::get('user_id'); ?>
        <?php if ($userId): ?>
        <a href="/do-an-tot-nghiep/logout.php" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #f5576c; text-decoration: none;">
            <i class="fas fa-sign-out-alt" style="width: 20px;"></i> Đăng xuất
        </a>
        <?php $role = App\Helpers\Session::get('role'); ?>
        <?php if ($role === 'admin'): ?>
        <a href="/do-an-tot-nghiep/admin" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #43e97b; text-decoration: none;">
            <i class="fas fa-cog" style="width: 20px;"></i> Quản trị
        </a>
        <?php endif; ?>
        <?php else: ?>
        <a href="/do-an-tot-nghiep/login.php" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #4facfe; text-decoration: none;">
            <i class="fas fa-user" style="width: 20px;"></i> Đăng nhập
        </a>
        <a href="/do-an-tot-nghiep/register.php" class="nav-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #43e97b; text-decoration: none;">
            <i class="fas fa-user-plus" style="width: 20px;"></i> Đăng ký
        </a>
        <?php endif; ?>
    </div>
</aside>

<style>
.main-content {
    margin-left: 260px;
    min-height: 100vh;
}
.sidebar-nav a:hover {
    background: rgba(233,69,96,0.15);
    color: #e94560;
    border-left: 3px solid #e94560;
}
</style>
