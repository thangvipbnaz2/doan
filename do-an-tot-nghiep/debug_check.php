<?php
echo "=== CHECKS ===\n\n";

// 1. File lesson_view.php
echo "1. FILE lesson_view.php:\n";
$lv = file_get_contents('lesson_view.php');
echo "   Length: " . strlen($lv) . " bytes\n";
echo "   Has userNote query: " . (strpos($lv, 'user_notes') !== false ? 'YES' : 'NO') . "\n";
echo "   Has lesson_history: " . (strpos($lv, 'lesson_history') !== false ? 'YES' : 'NO') . "\n";
echo "   Has reviewVocab: " . (strpos($lv, 'reviewVocab') !== false ? 'YES' : 'NO') . "\n\n";

// 2. File show.php
echo "2. FILE show.php:\n";
$sp = file_get_contents('app/Views/frontend/lesson/show.php');
echo "   Length: " . strlen($sp) . " bytes\n";
echo "   Has review-section: " . (strpos($sp, 'review-section') !== false ? 'YES' : 'NO') . "\n";
echo "   Has notes-section: " . (strpos($sp, 'notes-section') !== false ? 'YES' : 'NO') . "\n";
echo "   Has saveNote: " . (strpos($sp, 'saveNote') !== false ? 'YES' : 'NO') . "\n";
echo "   Has markLessonCompleted: " . (strpos($sp, 'markLessonCompleted') !== false ? 'YES' : 'NO') . "\n\n";

// 3. File api.php
echo "3. FILE api.php:\n";
$api = file_get_contents('api.php');
echo "   Length: " . strlen($api) . " bytes\n";
echo "   Has save_note endpoint: " . (strpos($api, "action === 'save_note'") !== false ? 'YES' : 'NO') . "\n";
echo "   Has complete_lesson endpoint: " . (strpos($api, "action === 'complete_lesson'") !== false ? 'YES' : 'NO') . "\n";
echo "   Has get_lesson_history endpoint: " . (strpos($api, "action === 'get_lesson_history'") !== false ? 'YES' : 'NO') . "\n\n";

// 4. Database schema file
echo "4. FILE database_schema.sql:\n";
$ds = file_get_contents('database_schema.sql');
echo "   Has user_notes table: " . (strpos($ds, 'user_notes') !== false ? 'YES' : 'NO') . "\n";
echo "   Has lesson_history table: " . (strpos($ds, 'lesson_history') !== false ? 'YES' : 'NO') . "\n\n";

// 5. Database connection & actual data
echo "5. DATABASE:\n";
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=hanyu_db', 'root', '');
    echo "   Connected OK\n";
    
    // Check tables exist
    $tbls = ['grammar_exercises', 'speaking_exercises', 'writing_exercises', 'user_notes', 'lesson_history'];
    foreach ($tbls as $t) {
        $exists = $pdo->query("SHOW TABLES LIKE '$t'")->fetchColumn();
        if ($exists) {
            $cnt = $pdo->query("SELECT COUNT(*) FROM $t")->fetchColumn();
            echo "   $t: EXISTS ($cnt rows)\n";
        } else {
            echo "   $t: NOT FOUND\n";
        }
    }
    
    // Check vocab columns
    $cols = $pdo->query("SHOW COLUMNS FROM vocab LIKE 'part_of_speech'")->fetchColumn();
    echo "   vocab.part_of_speech column: " . ($cols ? 'EXISTS' : 'NOT FOUND') . "\n";
    $cols2 = $pdo->query("SHOW COLUMNS FROM vocab LIKE 'audio_url'")->fetchColumn();
    echo "   vocab.audio_url column: " . ($cols2 ? 'EXISTS' : 'NOT FOUND') . "\n";
    
    // Lesson numbering
    echo "\n6. LESSON NUMBERING:\n";
    $stmt = $pdo->query("SELECT level, COUNT(*) as c, MIN(lesson_num) as min_n, MAX(lesson_num) as max_n, CONCAT('[', GROUP_CONCAT(DISTINCT lesson_num ORDER BY lesson_num SEPARATOR ','), ']') as nums FROM lessons GROUP BY level ORDER BY level");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "   HSK{$row['level']}: {$row['c']} lessons, range {$row['min_n']}-{$row['max_n']}\n";
    }
    
} catch (Exception $e) {
    echo "   ERROR: " . $e->getMessage() . "\n";
}

echo "\n=== END CHECKS ===\n";