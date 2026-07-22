<?php
// Chạy bằng CLI: php run_commerce_migration.php
// Không chạy được từ trình duyệt để tránh lộ thao tác quản trị CSDL.
if (PHP_SAPI !== 'cli') { http_response_code(403); exit('CLI only'); }
require __DIR__ . '/db.php';
require __DIR__ . '/course_seed.php';

$sql = file_get_contents(__DIR__ . '/payment_migration.sql');
foreach (explode(';', $sql) as $statement) {
    $statement = trim(preg_replace('/--[^\r\n]*/', '', $statement));
    if ($statement !== '') $conn->exec($statement);
}

$courses = [
    ['hsk-1-nen-tang', 'HSK 1 - Nen tang tieng Trung', 0, 'Danh cho nguoi moi bat dau: Pinyin, tu vung va hoi thoai co ban.', 1],
    ['hsk-2-giao-tiep', 'HSK 2 - Giao tiep co ban', 0, 'Mo rong von tu va phan xa giao tiep tieng Trung hang ngay.', 2],
    ['hsk-3-so-cap', 'HSK 3 - So cap nang cao', 0, 'Cung co ngu phap, nghe doc va chuan bi thi HSK 3.', 3],
    ['hsk-4-trung-cap', 'HSK 4 - Trung cap', 0, 'Phat trien giao tiep, doc hieu va luyen thi HSK 4.', 4],
    ['hsk-5-nang-cao', 'HSK 5 - Nang cao', 0, 'Tang toc tu vung, ky nang doc viet va de thi chuyen sau.', 5],
    ['hsk-6-chuyen-sau', 'HSK 6 - Chuyen sau', 0, 'Lo trinh chinh phuc HSK 6 danh cho nguoi hoc trinh do cao.', 6],
];
$insert = $conn->prepare('INSERT INTO courses (slug,title,price,short_description,hsk_level,is_published) VALUES (?,?,?,?,?,1) ON DUPLICATE KEY UPDATE title=VALUES(title),price=VALUES(price),short_description=VALUES(short_description),hsk_level=VALUES(hsk_level),is_published=1');
foreach ($courses as $course) $insert->execute($course);

$conn->exec("INSERT IGNORE INTO course_lessons (course_id,lesson_id,sort_order)
    SELECT c.id,l.id,l.lesson_num FROM courses c JOIN lessons l ON l.level=c.hsk_level
    WHERE c.slug IN ('hsk-1-nen-tang','hsk-2-giao-tiep','hsk-3-so-cap','hsk-4-trung-cap','hsk-5-nang-cao','hsk-6-chuyen-sau')");

// Replace the lightweight bootstrap records with the complete HSK 1-6
// catalogue and make sure every course has its curriculum attached.
$seedResult = commerceSeedPaidCourses($conn);

$count = $conn->query("SELECT COUNT(*) FROM courses WHERE slug IN ('hsk-1-nen-tang','hsk-2-giao-tiep','hsk-3-so-cap','hsk-4-trung-cap','hsk-5-nang-cao','hsk-6-chuyen-sau')")->fetchColumn();
echo "Commerce migration complete. Courses: $count; lessons added: {$seedResult['lessons_added']}\n";
