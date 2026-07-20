<?php
session_start();
require 'db.php';
require 'course_access.php';

try {
    $course = courseAccessRequireEnrollment($conn, (string) ($_GET['slug'] ?? ''));
    $lessons = courseAccessCurriculum($conn, (int) $course['id'], (int) $course['access_user_id']);
} catch (Throwable $e) {
    http_response_code($e->getCode() >= 400 ? $e->getCode() : 403);
    $message = $e->getMessage();
    $course = null;
    $lessons = [];
}
?>
<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $course ? htmlspecialchars($course['title']) : 'Khóa học' ?> | HànNgữ</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .learning-page{max-width:1060px;margin:auto;padding:105px 24px 64px}.learning-hero{padding:34px;border-radius:24px;color:#fff;background:linear-gradient(135deg,#0f766e,#134e4a)}.learning-hero h1{margin:8px 0;font-size:clamp(1.9rem,4vw,2.8rem)}.learning-hero p{margin:0;color:#d1fae5;line-height:1.6}.learning-list{margin-top:26px;background:#fff;border:1px solid #e2e8f0;border-radius:18px;overflow:hidden}.learning-item{display:flex;align-items:center;gap:15px;padding:18px 20px;border-bottom:1px solid #eef2f7;color:#172554;text-decoration:none}.learning-item:last-child{border:0}.learning-item:hover{background:#f0fdfa}.learning-no{display:grid;place-items:center;flex:none;width:34px;height:34px;border-radius:50%;background:#ccfbf1;color:#0f766e;font-weight:800}.learning-done{margin-left:auto;color:#047857;font-weight:700;font-size:.85rem}.learning-empty,.learning-error{margin-top:28px;padding:25px;border-radius:16px;background:#fff;border:1px solid #e2e8f0}.learning-error{color:#991b1b}
  </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="learning-page">
<?php if (!$course): ?>
  <section class="learning-error"><h1>Chưa thể vào khóa học</h1><p><?= htmlspecialchars($message ?? 'Không có quyền truy cập.') ?></p><a class="btn btn--primary" href="courses.php">Xem các khóa học</a></section>
<?php else: ?>
  <header class="learning-hero"><span>KHÓA HỌC ĐÃ MỞ</span><h1><?= htmlspecialchars($course['title']) ?></h1><p><?= $course['admin_preview'] ? 'Bạn đang xem với quyền quản trị.' : 'Chọn một bài học để bắt đầu lộ trình của bạn.' ?></p></header>
  <section class="learning-list" aria-label="Danh sách bài học">
    <?php if (!$lessons): ?><p class="learning-empty">Khóa học đang được cập nhật nội dung.</p><?php endif; ?>
    <?php foreach ($lessons as $index => $lesson): ?>
      <a class="learning-item" href="lesson.php?level=<?= (int) $lesson['level'] ?>&lesson=<?= (int) $lesson['lesson_num'] ?>">
        <span class="learning-no"><?= $index + 1 ?></span>
        <span><strong><?= htmlspecialchars($lesson['title']) ?></strong><br><small><?= htmlspecialchars($lesson['description'] ?? '') ?></small></span>
        <?php if ($lesson['completed']): ?><span class="learning-done">Đã hoàn thành</span><?php endif; ?>
      </a>
    <?php endforeach; ?>
  </section>
<?php endif; ?>
</main>
</body>
</html>
