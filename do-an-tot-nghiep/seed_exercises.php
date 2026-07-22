<?php
require_once __DIR__ . '/db.php';

echo "=== Seed Exercises, Speaking, Writing ===\n";

// Check if already seeded
$count = $conn->query("SELECT COUNT(*) FROM grammar_exercises")->fetchColumn();
if ($count > 50) {
    echo "Exercises already seeded ($count). Skipping.\n";
    exit;
}

// Get all grammar points
$grammars = $conn->query("SELECT g.*, l.level, l.lesson_num FROM grammar g JOIN lessons l ON g.lesson_id = l.id ORDER BY g.lesson_id, g.sort_order")->fetchAll();
echo "Found " . count($grammars) . " grammar points\n";

// Get all lessons
$lessons = $conn->query("SELECT id, level, lesson_num FROM lessons ORDER BY id")->fetchAll();
echo "Found " . count($lessons) . " lessons\n";

// Get vocab for each lesson
$vocabByLesson = [];
$vStmt = $conn->query("SELECT id, lesson_id, hanzi, pinyin, meaning FROM vocab ORDER BY lesson_id");
while ($v = $vStmt->fetch(PDO::FETCH_ASSOC)) {
    $vocabByLesson[$v['lesson_id']][] = $v;
}

$conn->beginTransaction();
try {
    $exStmt = $conn->prepare("INSERT INTO grammar_exercises (grammar_id, type, question, options, answer, explanation, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $spStmt = $conn->prepare("INSERT INTO speaking_exercises (lesson_id, instruction, target_text, target_pinyin, sort_order) VALUES (?, ?, ?, ?, ?)");
    $wrStmt = $conn->prepare("INSERT INTO writing_exercises (lesson_id, character_char, stroke_count, radical, sort_order) VALUES (?, ?, ?, ?, ?)");
    
    $exCount = 0;
    $spCount = 0;
    $wrCount = 0;

    foreach ($grammars as $g) {
        $gid = $g['id'];
        $title = $g['title'];
        $formula = $g['formula'] ?? '';
        $lessonId = $g['lesson_id'];
        $level = $g['level'];
        $lessonNum = $g['lesson_num'];
        
        // Generate fill_blank exercise
        $exStmt->execute([$gid, 'fill_blank', 
            "Hãy điền từ thích hợp vào chỗ trống dựa trên cấu trúc: " . $title,
            null,
            $title,
            "Đây là bài tập điền từ cho điểm ngữ pháp \"" . $title . "\". Hãy xem lại công thức: " . $formula,
            0
        ]);
        $exCount++;

        // Generate multiple_choice exercise
        $optA = "Đúng";
        $optB = "Sai";
        if ($level <= 2) {
            $optA = "Sử dụng " . explode(' ', $title)[0] . " đúng";
            $optB = "Sử dụng " . explode(' ', $title)[0] . " sai";
        } else {
            $optA = "Câu sử dụng đúng cấu trúc " . $title;
            $optB = "Câu sử dụng sai cấu trúc " . $title;
        }
        $exStmt->execute([$gid, 'multiple_choice',
            "Chọn đáp án đúng về cách sử dụng \"" . $title . "\":",
            json_encode([$optA, $optB]),
            $optA,
            "Giải thích: " . $title . " - " . ($g['meaning'] ?? 'Xem lại công thức trong bài học'),
            1
        ]);
        $exCount++;
        
        // Generate sentence_order or transform for advanced levels
        if ($level >= 3) {
            $exStmt->execute([$gid, 'sentence_order',
                "Sắp xếp các từ sau thành câu hoàn chỉnh sử dụng " . $title . ":",
                null,
                $formula,
                "Cấu trúc đúng là: " . $formula,
                2
            ]);
            $exCount++;
        } else {
            $exStmt->execute([$gid, 'transform',
                "Viết lại câu sau sử dụng " . $title . ":",
                null,
                $formula,
                "Gợi ý: Sử dụng công thức " . $formula,
                2
            ]);
            $exCount++;
        }
    }

    // Speaking exercises per lesson
    foreach ($lessons as $lesson) {
        $lid = $lesson['id'];
        $level = $lesson['level'];
        $lessonNum = $lesson['lesson_num'];
        
        if ($level == 1) {
            $vocabs = $vocabByLesson[$lid] ?? [];
            if (count($vocabs) > 0) {
                $v = $vocabs[array_rand($vocabs)];
                $spStmt->execute([$lid, "Đọc to từ vựng sau:", $v['hanzi'], $v['pinyin'], 0]);
                $spCount++;
                if (count($vocabs) > 1) {
                    $v2 = $vocabs[array_rand($vocabs)];
                    $spStmt->execute([$lid, "Luyện phát âm từ:", $v2['hanzi'], $v2['pinyin'], 1]);
                    $spCount++;
                }
            }
        } elseif ($level == 2) {
            $spStmt->execute([$lid, "Đọc đoạn hội thoại ngắn sau:", "你好，请问你叫什么名字？", "nǐ hǎo, qǐng wèn nǐ jiào shénme míngzì?", 0]);
            $spCount++;
            $spStmt->execute([$lid, "Luyện đọc câu hỏi:", "你最近怎么样？", "nǐ zuìjìn zěnmeyàng?", 1]);
            $spCount++;
        } elseif ($level == 3) {
            $spStmt->execute([$lid, "Đọc đoạn văn ngắn sau:", "今天天气很好，我们一起去公园散步吧。", "jīntiān tiānqì hěn hǎo, wǒmen yīqǐ qù gōngyuán sànbù ba.", 0]);
            $spCount++;
            $spStmt->execute([$lid, "Luyện nói theo chủ đề:", "请介绍一下你的家庭。", "qǐng jièshào yīxià nǐ de jiātíng.", 1]);
            $spCount++;
        } elseif ($level >= 4) {
            $spStmt->execute([$lid, "Đọc và diễn đạt lại:", "随着经济的发展，人们的生活水平不断提高。", "suízhe jīngjì de fāzhǎn, rénmen de shēnghuó shuǐpíng bùduàn tígāo.", 0]);
            $spCount++;
            $spStmt->execute([$lid, "Thảo luận ngắn:", "你对这个问题有什么看法？", "nǐ duì zhège wèntí yǒu shénme kànfǎ?", 1]);
            $spCount++;
        }
    }

    // Writing exercises based on actual vocab
    $allVocab = [];
    $vStmt2 = $conn->query("SELECT id, lesson_id, hanzi, strokes, radical FROM vocab WHERE LENGTH(hanzi) <= 2 AND strokes > 0 ORDER BY lesson_id");
    while ($v = $vStmt2->fetch(PDO::FETCH_ASSOC)) {
        $allVocab[$v['lesson_id']][] = $v;
    }
    
    foreach ($lessons as $lesson) {
        $lid = $lesson['id'];
        $level = $lesson['level'];
        $vocabs = $allVocab[$lid] ?? [];
        
        if (count($vocabs) > 0) {
            $used = [];
            foreach ($vocabs as $v) {
                if (count($used) >= 3) break;
                if (in_array($v['hanzi'], $used)) continue;
                $used[] = $v['hanzi'];
                $wrStmt->execute([$lid, $v['hanzi'], $v['strokes'] ?? 5, $v['radical'] ?? '', count($used) - 1]);
                $wrCount++;
            }
        } else {
            // Fallback chars
            $chars = [
                1 => [['一',1,'一'],['二',2,'一'],['三',3,'一'],['人',2,'人']],
                2 => [['大',3,'大'],['小',3,'小'],['山',3,'山'],['水',4,'水']],
                3 => [['明',8,'日'],['好',6,'女'],['学',8,'子'],['生',5,'生']],
            ];
            $levelKey = min($level, 3);
            foreach (($chars[$levelKey] ?? $chars[1]) as $idx => $c) {
                $wrStmt->execute([$lid, $c[0], $c[1], $c[2], $idx]);
                $wrCount++;
            }
        }
    }

    $conn->commit();
    echo "Seeded $exCount exercises, $spCount speaking exercises, $wrCount writing exercises.\n";

} catch (Exception $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}

echo "Done.\n";
