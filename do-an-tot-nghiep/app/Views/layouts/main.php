<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HànNgữ - Học tiếng Trung</title>
    <link rel="stylesheet" href="<?= App\Helpers\View::baseUrl() ?>/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <?php include __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="main-content">
        <?php
        $flashMessages = App\Helpers\Session::getFlashMessages();
        foreach ($flashMessages as $key => $message): ?>
            <div class="alert alert-<?= App\Helpers\View::escape($key === 'error' ? 'danger' : 'success') ?>">
                <?= App\Helpers\View::escape($message) ?>
            </div>
        <?php endforeach; ?>

        <?= $content ?? '' ?>
    </main>

    <script src="<?= App\Helpers\View::baseUrl() ?>/init.js"></script>
    <script src="<?= App\Helpers\View::baseUrl() ?>/utils.js"></script>
    <?= $extraScripts ?? '' ?>
</body>
</html>
