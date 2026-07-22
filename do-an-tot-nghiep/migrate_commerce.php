<?php
// Chạy một lần sau khi cập nhật source. Chỉ admin đã đăng nhập mới được chạy.
session_start(); require 'db.php'; require 'commerce.php'; require 'course_seed.php';
try { commerceRequireAdmin($conn); } catch (Throwable $e) { http_response_code(403); exit('Bạn không có quyền.'); }
$messages=[];
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $sql=file_get_contents(__DIR__.'/payment_migration.sql');
    foreach (explode(';',$sql) as $statement) { $statement=trim(preg_replace('/--[^\r\n]*/','',$statement)); if($statement==='') continue; try{$conn->exec($statement);$messages[]='Đã chạy migration.';}catch(Throwable $e){$messages[]='Lỗi: '.$e->getMessage();} }
    // Tạo sẵn các khóa học miễn phí.
    $seed = [
        ['hsk-1-nen-tang','HSK 1 - Nền tảng tiếng Trung',0,'Dành cho người mới bắt đầu: Pinyin, từ vựng và hội thoại cơ bản.',1],
        ['hsk-2-giao-tiep','HSK 2 - Giao tiếp cơ bản',0,'Mở rộng vốn từ và phản xạ giao tiếp tiếng Trung hàng ngày.',2],
        ['hsk-3-so-cap','HSK 3 - Sơ cấp nâng cao',0,'Củng cố ngữ pháp, nghe đọc và chuẩn bị thi HSK 3.',3],
        ['hsk-4-trung-cap','HSK 4 - Trung cấp',0,'Phát triển giao tiếp, đọc hiểu và luyện thi HSK 4.',4],
        ['hsk-5-nang-cao','HSK 5 - Nâng cao',0,'Tăng tốc từ vựng, kỹ năng đọc viết và đề thi chuyên sâu.',5],
        ['hsk-6-chuyen-sau','HSK 6 - Chuyên sâu',0,'Lộ trình chinh phục HSK 6 dành cho người học trình độ cao.',6],
    ];
    $insert=$conn->prepare('INSERT INTO courses (slug,title,price,short_description,hsk_level,is_published) VALUES (?,?,?,?,?,1) ON DUPLICATE KEY UPDATE title=VALUES(title),price=VALUES(price),short_description=VALUES(short_description),hsk_level=VALUES(hsk_level),is_published=1');
    foreach($seed as $course) $insert->execute($course);
    $conn->exec("INSERT IGNORE INTO course_lessons (course_id,lesson_id,sort_order)
        SELECT c.id,l.id,l.lesson_num FROM courses c JOIN lessons l ON l.level=c.hsk_level WHERE c.slug IN ('hsk-1-nen-tang','hsk-2-giao-tiep','hsk-3-so-cap','hsk-4-trung-cap','hsk-5-nang-cao','hsk-6-chuyen-sau')");
    $seedResult = commerceSeedPaidCourses($conn);
    $messages[]='Đã đồng bộ nội dung chi tiết cho 6 khóa HSK và '.$seedResult['lessons_added'].' bài học mới.';
    $messages[]='Đã tạo sẵn 6 khóa học HSK để bán.';
}
?><!doctype html><html lang="vi"><meta charset="utf-8"><title>Migration bán khóa học</title><style>body{font:16px system-ui;max-width:700px;margin:50px auto;padding:20px}button{padding:12px 20px;background:#0d9488;color:white;border:0;border-radius:8px;font-weight:bold;cursor:pointer}.ok{color:#047857}</style><h1>Thiết lập module bán khóa học</h1><p>Thao tác này tạo các bảng courses, orders, payments, enrollments và invoices; không xóa dữ liệu cũ.</p><?php foreach($messages as $m) echo '<p class="ok">'.htmlspecialchars($m).'</p>'; ?><form method="post" onsubmit="return confirm('Chạy migration CSDL?')"><button>Chạy migration</button></form><p><a href="admin_commerce.php">Đến trang quản lý khóa học</a></p></html>
