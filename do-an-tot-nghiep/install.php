<?php
// HànNgữ - Script cài đặt database
header('Content-Type: text/html; charset=utf-8');

function run() {
    $host = 'localhost';
    $dbname = 'hanyu_db';
    $username = 'root';
    $password = '';

    try {
        // Kết nối MySQL (không chọn database)
        $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Tạo database nếu chưa có
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "✅ Database '$dbname' đã được tạo/xác nhận.<br>";

        // Kết nối database
        $pdo->exec("USE `$dbname`");

        // Đọc và thực thi file SQL
        $sql = file_get_contents(__DIR__ . '/hanyu_db.sql');
        $statements = explode(';', $sql);

        $success = 0;
        $errors = 0;
        foreach ($statements as $stmt) {
            $stmt = trim($stmt);
            if (!empty($stmt)) {
                try {
                    $pdo->exec($stmt);
                    $success++;
                } catch (PDOException $e) {
                    echo "⚠️ " . htmlspecialchars(substr($stmt, 0, 80)) . "... - " . $e->getMessage() . "<br>";
                    $errors++;
                }
            }
        }
        echo "✅ Thực thi SQL: $success thành công, $errors lỗi nhẹ.<br>";

        // Kiểm tra các bảng
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "✅ Các bảng: " . implode(', ', $tables) . "<br>";

        $count = $pdo->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
        echo "📚 Từ vựng: $count từ.<br>";
        $count2 = $pdo->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
        echo "📖 Bài học: $count2 bài.<br>";
        $count3 = $pdo->query("SELECT COUNT(*) FROM radicals")->fetchColumn();
        echo "🔤 Bộ thủ: $count3 bộ.<br>";
        $count4 = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
        echo "👥 Người dùng: $count4.<br>";

        // Migration: thêm cột lesson_id cho vocab nếu chưa có
        try {
            $pdo->exec("ALTER TABLE vocab ADD COLUMN lesson_id INT DEFAULT NULL AFTER level");
            echo "✅ Migration: thêm cột lesson_id vào bảng vocab.<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Cột lesson_id đã tồn tại.<br>";
            } else {
                echo "⚠️ Migration: " . $e->getMessage() . "<br>";
            }
        }
        try {
            $pdo->exec("ALTER TABLE vocab ADD INDEX idx_lesson (lesson_id)");
        } catch (PDOException $e) {}

        // Migration: thêm cột avatar cho users
        try {
            $pdo->exec("ALTER TABLE users ADD COLUMN avatar VARCHAR(255) DEFAULT NULL AFTER display_name");
            echo "✅ Migration: thêm cột avatar vào bảng users.<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Cột avatar đã tồn tại.<br>";
            }
        }

        // Migration: thêm cột char_data cho vocab (dữ liệu từng chữ: nét, bộ thủ)
        try {
            $pdo->exec("ALTER TABLE vocab ADD COLUMN char_data LONGTEXT DEFAULT NULL AFTER strokes");
            echo "✅ Migration: thêm cột char_data vào bảng vocab.<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Cột char_data đã tồn tại.<br>";
            }
        }

        // Tự động populate char_data từ bảng radicals
        try {
            $vocabList = $pdo->query("SELECT id, hanzi FROM vocab WHERE char_data IS NULL OR char_data = '' OR char_data = '[]'")->fetchAll(PDO::FETCH_ASSOC);
            $fixStmt = $pdo->prepare("SELECT id, hanzi, char_data FROM vocab WHERE char_data IS NOT NULL AND char_data != '' AND char_data != '[]'");
            $fixStmt->execute();
            $fixRows = $fixStmt->fetchAll();
            foreach ($fixRows as $row) {
                $decoded = json_decode($row['char_data'], true);
                if (is_array($decoded) && count($decoded) > 0) {
                    $needsFix = false;
                    foreach ($decoded as $c) { if (empty($c['strokes']) || empty($c['radical'])) { $needsFix = true; break; } }
                    if ($needsFix) $vocabList[] = $row;
                }
            }
            $radMap = [];
            $radRows = $pdo->query("SELECT `char`, strokes, name_vietnamese FROM radicals")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($radRows as $r) $radMap[$r['char']] = $r;

            $charVocabMap = [];
            $charRows = $pdo->query("SELECT hanzi, strokes, radical FROM vocab WHERE CHAR_LENGTH(hanzi) = 1 AND strokes > 0")->fetchAll(PDO::FETCH_ASSOC);
            foreach ($charRows as $r) {
                if (!isset($radMap[$r['hanzi']])) {
                    $charVocabMap[$r['hanzi']] = $r;
                }
            }

            $charDb = [];
            $dbPath = __DIR__ . '/chardata.json';
            if (file_exists($dbPath)) {
                $dbContent = json_decode(file_get_contents($dbPath), true);
                if ($dbContent) $charDb = $dbContent;
            }

            $updated = 0;
            $stmt = $pdo->prepare("UPDATE vocab SET char_data = ? WHERE id = ?");
            foreach ($vocabList as $v) {
                $chars = [];
                foreach (preg_split('//u', $v['hanzi'], -1, PREG_SPLIT_NO_EMPTY) as $ch) {
                    $rd = $charDb[$ch] ?? $radMap[$ch] ?? $charVocabMap[$ch] ?? null;
                    $chars[] = [
                        'char' => $ch,
                        'strokes' => $rd ? intval($rd['strokes']) : 0,
                        'radical' => $rd ? ($rd['name_vietnamese'] ?? $rd['radical'] ?? '') : '',
                    ];
                }
                if (count($chars) > 0) {
                    $stmt->execute([json_encode($chars, JSON_UNESCAPED_UNICODE), $v['id']]);
                    $updated++;
                }
            }
            if ($updated > 0) echo "✅ Populate char_data: $updated từ đã cập nhật.<br>";
        } catch (PDOException $e) {
            echo "⚠️ Populate char_data: " . $e->getMessage() . "<br>";
        }

        // Migration: thêm cột role cho users
        try {
            $pdo->exec("ALTER TABLE users ADD COLUMN role VARCHAR(20) DEFAULT 'user' AFTER display_name");
            echo "✅ Migration: thêm cột role vào bảng users.<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Cột role đã tồn tại.<br>";
            }
        }

        // Migration: thêm cột remember_token
        try {
            $pdo->exec("ALTER TABLE users ADD COLUMN remember_token VARCHAR(64) DEFAULT NULL AFTER role");
            echo "✅ Migration: thêm cột remember_token.<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Cột remember_token đã tồn tại.<br>";
            }
        }

        // Thêm admin user mặc định
        try {
            $pdo->exec("INSERT IGNORE INTO users (username, password, display_name, role) VALUES ('admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "', 'Administrator', 'admin')");
            echo "✅ Admin user mặc định: admin / admin123<br>";
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "ℹ️ Admin user đã tồn tại.<br>";
            }
        }

        echo "<hr><strong style='color:#2563eb;'>✅ Cài đặt hoàn tất! Bạn có thể <a href='index.php'>về trang chủ</a>.</strong>";

    } catch (PDOException $e) {
        echo "❌ Lỗi: " . $e->getMessage() . "<br>";
        echo "💡 Hướng dẫn: Hãy đảm bảo MySQL đang chạy trong XAMPP.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cài đặt HànNgữ</title>
    <style>
        body{font-family:system-ui,sans-serif;max-width:700px;margin:40px auto;padding:24px;line-height:1.8;color:#0f172a}
        h1{font-size:1.8rem;margin-bottom:8px}
        .card{background:#fff;border-radius:12px;padding:24px;box-shadow:0 4px 24px rgba(0,0,0,.08)}
        .btn{display:inline-block;padding:14px 32px;background:#3b82f6;color:#fff;border-radius:10px;font-weight:600;text-decoration:none;border:none;cursor:pointer;font-size:1rem}
        .btn:hover{background:#2563eb}
        hr{margin:20px 0;border:none;border-top:1px solid #e2e8f0}
        small{color:#64748b}
        .menu{display:flex;gap:12px;margin-top:20px}
    </style>
</head>
<body>
    
    <div class="card">
        <h1>🀄 HànNgữ - Cài đặt</h1>
        <p>Script này sẽ tạo database và dữ liệu mẫu cho ứng dụng học tiếng Trung.</p>
        <hr>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            run();
        } else {
            echo '<form method="post"><button type="submit" class="btn">🚀 Bắt đầu cài đặt</button></form>';
            echo '<div class="menu"><a href="index.php" class="btn" style="background:#64748b;">🏠 Về trang chủ</a></div>';
            echo '<hr><small>Yêu cầu: XAMPP đang chạy, MySQL root không mật khẩu.</small>';
        }
        ?>
    </div>
</body>
</html>
