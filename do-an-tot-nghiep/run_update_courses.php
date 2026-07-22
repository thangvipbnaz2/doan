<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

// Update slugs
$conn->exec("UPDATE courses SET slug = 'hsk-1-nen-tang' WHERE slug = 'hsk-1'");
$conn->exec("UPDATE courses SET slug = 'hsk-2-giao-tiep' WHERE slug = 'hsk-2'");
$conn->exec("UPDATE courses SET slug = 'hsk-3-so-cap' WHERE slug = 'hsk-3'");
$conn->exec("UPDATE courses SET slug = 'hsk-4-trung-cap' WHERE slug = 'hsk-4'");
$conn->exec("UPDATE courses SET slug = 'hsk-5-nang-cao' WHERE slug = 'hsk-5'");
$conn->exec("UPDATE courses SET slug = 'hsk-6-chuyen-sau' WHERE slug = 'hsk-6'");
echo "Updated slugs OK\n";

// Check if course_lessons already has data
$count = $conn->query("SELECT COUNT(*) FROM course_lessons")->fetchColumn();
if ($count > 0) {
    echo "course_lessons already has $count records, skipping insert\n";
} else {
    $inserts = [];
    // HSK1: lessons 1-15
    for ($i = 1; $i <= 15; $i++) $inserts[] = "(1, $i, $i)";
    // HSK2: lessons 16-30
    for ($i = 16; $i <= 30; $i++) $inserts[] = "(2, $i, " . ($i - 15) . ")";
    // HSK3: lessons 31-50
    for ($i = 31; $i <= 50; $i++) $inserts[] = "(3, $i, " . ($i - 30) . ")";
    // HSK4: lessons 51-70
    for ($i = 51; $i <= 70; $i++) $inserts[] = "(4, $i, " . ($i - 50) . ")";
    // HSK5: lessons 71-106
    for ($i = 71; $i <= 106; $i++) $inserts[] = "(5, $i, " . ($i - 70) . ")";
    // HSK6: lessons 107-146
    for ($i = 107; $i <= 146; $i++) $inserts[] = "(6, $i, " . ($i - 106) . ")";

    $sql = "INSERT IGNORE INTO course_lessons (course_id, lesson_id, sort_order) VALUES " . implode(',', $inserts);
    $conn->exec($sql);
    echo "Inserted course_lessons: " . count($inserts) . " records\n";
}

echo "Done.\n";
