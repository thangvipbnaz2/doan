<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - HànNgữ</title>
    <?php $base = App\Helpers\View::baseUrl(); ?>
    <link rel="stylesheet" href="<?= $base ?>/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .admin-wrapper { display: flex; min-height: 100vh; }
        .admin-sidebar { width: 260px; background: #1a1a2e; color: #fff; padding: 20px 0; position: fixed; height: 100%; overflow-y: auto; }
        .admin-sidebar .logo { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .admin-sidebar .logo h2 { font-size: 20px; color: #e94560; }
        .admin-sidebar .logo small { color: #aaa; font-size: 12px; }
        .admin-sidebar nav a { display: flex; align-items: center; gap: 12px; padding: 12px 20px; color: #ccc; text-decoration: none; transition: all 0.3s; }
        .admin-sidebar nav a:hover, .admin-sidebar nav a.active { background: rgba(233,69,96,0.15); color: #e94560; border-left: 3px solid #e94560; }
        .admin-sidebar nav a i { width: 20px; text-align: center; }
        .admin-content { flex: 1; margin-left: 260px; padding: 30px; background: #f5f6fa; min-height: 100vh; }
        .admin-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .admin-header h1 { font-size: 24px; color: #2d3436; }
        .admin-header .user-info { display: flex; align-items: center; gap: 15px; }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="logo">
                <h2>HànNgữ</h2>
                <small>Admin Panel</small>
            </div>
            <nav>
                <a href="<?= $base ?>/admin" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin') && !str_contains($_SERVER['REQUEST_URI'], '/admin/') ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="<?= $base ?>/admin/lessons" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/lessons') ? 'active' : '' ?>">
                    <i class="fas fa-book"></i> Bài học
                </a>
                <a href="<?= $base ?>/admin/reading" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/reading') ? 'active' : '' ?>">
                    <i class="fas fa-book-open"></i> Đọc
                </a>
                <a href="<?= $base ?>/admin/listening" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/listening') ? 'active' : '' ?>">
                    <i class="fas fa-headphones"></i> Nghe
                </a>
                <a href="<?= $base ?>/admin/speaking" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/speaking') ? 'active' : '' ?>">
                    <i class="fas fa-microphone"></i> Nói
                </a>
                <a href="<?= $base ?>/admin/writing" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/writing') ? 'active' : '' ?>">
                    <i class="fas fa-pen"></i> Viết
                </a>
                <a href="<?= $base ?>/admin/exam" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/exam') ? 'active' : '' ?>">
                    <i class="fas fa-file-alt"></i> Đề thi
                </a>
                <a href="<?= $base ?>/admin/vocab" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/vocab') ? 'active' : '' ?>">
                    <i class="fas fa-font"></i> Từ vựng
                </a>
                <a href="<?= $base ?>/admin/grammar" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/grammar') ? 'active' : '' ?>">
                    <i class="fas fa-language"></i> Ngữ pháp
                </a>
                <a href="<?= $base ?>/admin/dialogues" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/dialogues') ? 'active' : '' ?>">
                    <i class="fas fa-comments"></i> Hội thoại
                </a>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 20px;">
                <a href="<?= $base ?>/admin/users" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/users') ? 'active' : '' ?>">
                    <i class="fas fa-users"></i> Người dùng
                </a>
                <a href="<?= $base ?>/admin/orders" class="<?= str_contains($_SERVER['REQUEST_URI'], '/admin/orders') ? 'active' : '' ?>">
                    <i class="fas fa-shopping-cart"></i> Đơn hàng
                </a>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 20px;">
                <a href="<?= $base ?>/"><i class="fas fa-home"></i> Về trang chủ</a>
                <a href="<?= $base ?>/logout.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
            </nav>
        </aside>
        <main class="admin-content">
            <?php
            $flashMessages = App\Helpers\Session::getFlashMessages();
            foreach ($flashMessages as $key => $message): ?>
                <div class="alert alert-<?= $key === 'error' || $key === 'danger' ? 'danger' : 'success' ?>">
                    <?= App\Helpers\View::escape($message) ?>
                </div>
            <?php endforeach; ?>

            <?= $content ?? '' ?>
        </main>
    </div>
</body>
</html>
