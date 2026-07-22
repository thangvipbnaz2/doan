<?php
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

$allowedOrigins = ['http://localhost', 'http://localhost:3000', 'http://localhost:5173'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Credentials: true');
}
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

session_start();

try {
    require 'db.php';
    require 'config.php';
} catch (Exception $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

$action = $_GET['action'] ?? '';

// Auto-create error_reports table
try {
    $conn->exec("CREATE TABLE IF NOT EXISTS `error_reports` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `vocab_id` INT NOT NULL,
        `hanzi` VARCHAR(50) NOT NULL,
        `field` VARCHAR(20) NOT NULL COMMENT 'pinyin|meaning',
        `old_value` TEXT,
        `new_value` TEXT NOT NULL,
        `note` TEXT,
        `user_id` INT DEFAULT NULL,
        `status` VARCHAR(20) DEFAULT 'pending' COMMENT 'pending|fixed|dismissed',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
} catch (Exception $e) {}

// CSRF helpers (dùng chung với auth.php)
function getCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function validateCsrfToken($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) return false;
    return hash_equals($_SESSION['csrf_token'], $token);
}
function requireCsrf() {
    $input = json_decode(file_get_contents('php://input'), true) ?: [];
    $token = $input['csrf_token'] ?? ($_GET['csrf_token'] ?? '');
    if (!validateCsrfToken($token)) {
        echo json_encode(['success' => false, 'message' => 'Token bảo mật không hợp lệ']);
        exit;
    }
}

if ($action === 'get_csrf_token') {
    echo json_encode(['csrf_token' => getCsrfToken()]);
    exit;
}

// Health check endpoint
if ($action === 'health') {
    try {
        $stmt = $conn->query("SELECT COUNT(*) as cnt FROM vocab");
        $vocabCount = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt2 = $conn->query("SELECT COUNT(*) as cnt FROM notebook");
        $notebookCount = $stmt2->fetch(PDO::FETCH_ASSOC);
        echo json_encode(['status' => 'ok', 'vocab_count' => $vocabCount['cnt'], 'notebook_count' => $notebookCount['cnt']]);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

// API lấy danh sách từ vựng
if ($action === 'get_vocab') {
    $level = intval($_GET['level'] ?? 0);
    $userId = $_GET['user_id'] ?? 'default_user';

    try {
        if ($level > 0) {
            $stmt = $conn->prepare("SELECT v.*, p.write_completed, p.speech_completed,
                                           s.next_review, s.interval_days, s.consecutive_correct, s.ease_factor
                                    FROM vocab v
                                    LEFT JOIN progress p ON v.id = p.vocab_id AND p.user_id = ?
                                    LEFT JOIN srs s ON v.id = s.vocab_id AND s.user_id = ?
                                    WHERE v.level = ?
                                    ORDER BY v.id");
            $stmt->execute([$userId, $userId, $level]);
        } else {
            $stmt = $conn->prepare("SELECT v.*, p.write_completed, p.speech_completed,
                                           s.next_review, s.interval_days, s.consecutive_correct, s.ease_factor
                                    FROM vocab v
                                    LEFT JOIN progress p ON v.id = p.vocab_id AND p.user_id = ?
                                    LEFT JOIN srs s ON v.id = s.vocab_id AND s.user_id = ?
                                    ORDER BY v.level, v.id");
            $stmt->execute([$userId, $userId]);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}



// API lấy tiến trình (vocab + lesson)
if ($action === 'get_progress') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("SELECT vocab_id, lesson_id, write_completed, speech_completed FROM progress WHERE user_id = ?");
    $stmt->execute([$userId]);
    $result = $stmt->fetchAll();

    $vocabProgress = [];
    $lessonProgress = [];
    foreach ($result as $row) {
        if ($row['vocab_id']) {
            $vocabProgress[$row['vocab_id']] = $row;
        }
        if ($row['lesson_id']) {
            $lessonProgress[$row['lesson_id']] = $row;
        }
    }
    echo json_encode([
        'vocab' => $vocabProgress,
        'lesson' => $lessonProgress
    ]);
    exit;
}

// API lấy lesson progress riêng
if ($action === 'get_lesson_progress') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $level = intval($_GET['level'] ?? 0);
    if ($level > 0) {
        $stmt = $conn->prepare("SELECT p.* FROM progress p JOIN lessons l ON p.lesson_id = l.id WHERE p.user_id = ? AND l.level = ?");
        $stmt->execute([$userId, $level]);
    } else {
        $stmt = $conn->prepare("SELECT * FROM progress WHERE user_id = ? AND lesson_id IS NOT NULL");
        $stmt->execute([$userId]);
    }
    $result = $stmt->fetchAll();
    $mapped = [];
    foreach ($result as $row) {
        $mapped[$row['lesson_id']] = $row;
    }
    echo json_encode($mapped);
    exit;
}

// API lưu vào sổ tay
if ($action === 'save_to_notebook') {
    $rawInput = file_get_contents('php://input');
    $data = json_decode($rawInput, true);

    $vocabId = isset($data['vocab_id']) ? intval($data['vocab_id']) : 0;
    $userId = $data['user_id'] ?? 'default_user';

    if (!$vocabId || $vocabId == 0) {
        echo json_encode(['success' => false, 'message' => 'Thiếu hoặc sai vocab_id']);
        exit;
    }

    // Kiểm tra đã lưu chưa (theo user)
    $check = $conn->prepare("SELECT id FROM notebook WHERE vocab_id = ? AND user_id = ?");
    $check->execute([$vocabId, $userId]);
    $existing = $check->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        echo json_encode(['success' => false, 'message' => 'Đã tồn tại trong sổ tay', 'vocab_id' => $vocabId]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notebook (vocab_id, user_id) VALUES (?, ?)");
    $result = $stmt->execute([$vocabId, $userId]);

    if ($result) {
        $newId = $conn->lastInsertId();
        echo json_encode(['success' => true, 'message' => 'Lưu thành công', 'vocab_id' => $vocabId, 'notebook_id' => $newId]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi khi lưu vào database']);
    }
    exit;
}

// API lưu từ AI vào sổ tay (ai_image.php)
if ($action === 'add_notebook') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = $data['user_id'] ?? 'default_user';
    $hanzi = trim($data['hanzi'] ?? '');
    $pinyin = trim($data['pinyin'] ?? '');
    $meaning = trim($data['meaning'] ?? '');

    if (!$hanzi) {
        echo json_encode(['success' => false, 'message' => 'Thiếu chữ Hán']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO notebook (vocab_id, user_id, custom_hanzi, custom_pinyin, custom_meaning, custom_strokes, custom_radical, custom_example) VALUES (0, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([
        $userId,
        $hanzi,
        $pinyin,
        $meaning,
        intval($data['strokes'] ?? 0),
        trim($data['radical'] ?? ''),
        trim(($data['example'] ?? '') ?: ($data['example_vi'] ?? ''))
    ]);

    echo json_encode(['success' => (bool)$result, 'message' => $result ? 'Đã lưu vào sổ tay' : 'Lỗi lưu!']);
    exit;
}

// API lấy từ trong sổ tay
if ($action === 'get_notebook') {
    try {
        $userId = $_GET['user_id'] ?? 'default_user';
        $stmt = $conn->prepare("SELECT n.id, n.vocab_id, n.saved_at,
                                    COALESCE(v.hanzi, n.custom_hanzi) AS hanzi,
                                    COALESCE(v.pinyin, n.custom_pinyin) AS pinyin,
                                    COALESCE(v.meaning, n.custom_meaning) AS meaning,
                                    COALESCE(v.strokes, n.custom_strokes) AS strokes,
                                    COALESCE(v.radical, n.custom_radical) AS radical,
                                    COALESCE(v.example, n.custom_example) AS example,
                                    n.custom_hanzi, n.custom_pinyin, n.custom_meaning,
                                    n.custom_strokes, n.custom_radical, n.custom_example
                                FROM notebook n
                                LEFT JOIN vocab v ON n.vocab_id = v.id
                                WHERE n.user_id = ?
                                ORDER BY n.saved_at DESC");
        $stmt->execute([$userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Cast numeric fields
        foreach ($rows as &$r) {
            $r['id'] = intval($r['id']);
            $r['vocab_id'] = $r['vocab_id'] !== null ? intval($r['vocab_id']) : null;
            $r['strokes'] = $r['strokes'] !== null ? intval($r['strokes']) : null;
            $r['custom_strokes'] = $r['custom_strokes'] !== null ? intval($r['custom_strokes']) : null;
        }
        echo json_encode($rows);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// Test endpoint - lấy tất cả notebook (không join)
if ($action === 'get_notebook_raw') {
    try {
        $stmt = $conn->query("SELECT * FROM notebook ORDER BY saved_at DESC LIMIT 10");
        echo json_encode($stmt->fetchAll());
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// API cập nhật tiến trình học
if ($action === 'update_progress') {
    // Hỗ trợ cả GET và POST
    $input = json_decode(file_get_contents('php://input'), true) ?: [];
    $vocabId = $_GET['vocab_id'] ?? $input['vocab_id'] ?? 0;
    $userId = $_GET['user_id'] ?? $input['user_id'] ?? 'default_user';
    $type = $_GET['type'] ?? $input['type'] ?? 'write';

    if (!$vocabId) {
        echo json_encode(['success' => false, 'message' => 'Thiếu vocab_id']);
        exit;
    }

    // Kiểm tra đã có progress chưa
    $check = $conn->prepare("SELECT id FROM progress WHERE vocab_id = ? AND user_id = ?");
    $check->execute([$vocabId, $userId]);

    if ($check->fetch()) {
        // Update
        if ($type === 'write' || $type === 'all') {
            $stmt = $conn->prepare("UPDATE progress SET write_completed = 1 WHERE vocab_id = ? AND user_id = ?");
            $stmt->execute([$vocabId, $userId]);
        }
        if ($type === 'speech' || $type === 'all') {
            $stmt = $conn->prepare("UPDATE progress SET speech_completed = 1 WHERE vocab_id = ? AND user_id = ?");
            $stmt->execute([$vocabId, $userId]);
        }
    } else {
        // Insert
        $write = ($type === 'write' || $type === 'all') ? 1 : 0;
        $speech = ($type === 'speech' || $type === 'all') ? 1 : 0;
        $stmt = $conn->prepare("INSERT INTO progress (vocab_id, user_id, write_completed, speech_completed) VALUES (?, ?, ?, ?)");
        $stmt->execute([$vocabId, $userId, $write, $speech]);
    }

    echo json_encode(['success' => true, 'message' => 'Đã cập nhật tiến trình']);
    exit;
}

// API xóa khỏi sổ tay
if ($action === 'delete_notebook') {
    $id = $_GET['id'] ?? 0;
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("DELETE FROM notebook WHERE id = ? AND user_id = ?");
    $result = $stmt->execute([$id, $userId]);
    echo json_encode(['success' => $result]);
    exit;
}

// API xóa tất cả sổ tay theo user
if ($action === 'clear_notebook') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("DELETE FROM notebook WHERE user_id = ?");
    $result = $stmt->execute([$userId]);
    echo json_encode(['success' => $result, 'message' => 'Đã xóa tất cả']);
    exit;
}

// API đăng bài cộng đồng
if ($action === 'add_post') {
    $data = $_POST;
    $title = htmlspecialchars(trim($data['title'] ?? ''), ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars(trim($data['content'] ?? ''), ENT_QUOTES, 'UTF-8');
    $author = htmlspecialchars(trim($data['author'] ?? 'Ẩn danh'), ENT_QUOTES, 'UTF-8');
    $tags = !empty($data['tags']) ? explode(',', $data['tags']) : [];

    if (!$title || !$content) {
        echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung không được để trống']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content, author, tags, status) VALUES (?, ?, ?, ?, 'pending')");
    $result = $stmt->execute([
        $title, $content,
        $author,
        implode(',', $tags)
    ]);

    $postId = $conn->lastInsertId();

    // Upload images
    if ($result && !empty($_FILES['images']['name'][0])) {
        $uploadDir = __DIR__ . '/uploads/posts/';
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $images = $_FILES['images'];
        $imgStmt = $conn->prepare("INSERT INTO post_images (post_id, image_path) VALUES (?, ?)");

        foreach ($images['name'] as $i => $name) {
            if ($images['error'][$i] !== UPLOAD_ERR_OK) continue;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed)) continue;
            $filename = $postId . '_' . time() . '_' . $i . '.' . $ext;
            $dest = $uploadDir . $filename;
            if (move_uploaded_file($images['tmp_name'][$i], $dest)) {
                $imgStmt->execute([$postId, 'uploads/posts/' . $filename]);
            }
        }
    }

    echo json_encode(['success' => (bool)$result, 'id' => $postId]);
    exit;
}

// API like bài viết (toggle)
if ($action === 'like_post') {
    $id = intval($_GET['id'] ?? 0);
    $userId = $_GET['user_id'] ?? $_SESSION['user_id'] ?? '';
    if (!$id || !$userId) { echo json_encode(['success' => false]); exit; }
    $check = $conn->prepare("SELECT id FROM post_likes WHERE post_id = ? AND user_id = ?");
    $check->execute([$id, $userId]);
    if ($check->fetch()) {
        $conn->prepare("DELETE FROM post_likes WHERE post_id = ? AND user_id = ?")->execute([$id, $userId]);
        $conn->prepare("UPDATE posts SET likes = GREATEST(likes - 1, 0) WHERE id = ?")->execute([$id]);
        echo json_encode(['success' => true, 'liked' => false]);
    } else {
        $conn->prepare("INSERT IGNORE INTO post_likes (post_id, user_id) VALUES (?, ?)")->execute([$id, $userId]);
        $conn->prepare("UPDATE posts SET likes = likes + 1 WHERE id = ?")->execute([$id]);
        echo json_encode(['success' => true, 'liked' => true]);
    }
    exit;
}

// API thống kê
if ($action === 'get_stats') {
    $vocabCount = $conn->query("SELECT COUNT(*) as total FROM vocab")->fetch();
    $hsk1 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 1")->fetch();
    $hsk2 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 2")->fetch();
    $hsk3 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 3")->fetch();
    $hsk4 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 4")->fetch();
    $hsk5 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 5")->fetch();
    $hsk6 = $conn->query("SELECT COUNT(*) as count FROM vocab WHERE level = 6")->fetch();

    echo json_encode([
        'total' => $vocabCount['total'],
        'hsk1' => $hsk1['count'],
        'hsk2' => $hsk2['count'],
        'hsk3' => $hsk3['count'],
        'hsk4' => $hsk4['count'],
        'hsk5' => $hsk5['count'],
        'hsk6' => $hsk6['count'],
    ]);
    exit;
}

// API lấy danh sách bài học
if ($action === 'get_lessons') {
    $level = $_GET['level'] ?? '';
    if ($level !== '') {
        $stmt = $conn->prepare("SELECT * FROM lessons WHERE level = ? ORDER BY lesson_num");
        $stmt->execute([$level]);
    } else {
        $stmt = $conn->query("SELECT * FROM lessons ORDER BY level, lesson_num");
    }
    echo json_encode($stmt->fetchAll());
    exit;
}

// API lấy chi tiết bài học
if ($action === 'get_lesson_detail') {
    $lesson_id = intval($_GET['lesson_id'] ?? 0);
    $stmt = $conn->prepare("SELECT * FROM lessons WHERE id = ?");
    $stmt->execute([$lesson_id]);
    $lesson = $stmt->fetch();

    if (!$lesson) {
        echo json_encode(['error' => 'Lesson not found']);
        exit;
    }

    // Lấy từ vựng của bài học: ưu tiên lesson_id, fallback offset
    $vocabStmt = $conn->prepare("SELECT * FROM vocab WHERE lesson_id = ? ORDER BY id");
    $vocabStmt->execute([$lesson_id]);
    $vocab = $vocabStmt->fetchAll();

    if (empty($vocab)) {
        // fallback: lấy vocab theo level + offset dựa trên các lesson trước
        $offsetStmt = $conn->prepare("SELECT SUM(vocab_count) FROM lessons WHERE level = ? AND id < ?");
        $offsetStmt->execute([$lesson['level'], $lesson_id]);
        $offset = intval($offsetStmt->fetchColumn());

        $vocabStmt2 = $conn->prepare("SELECT * FROM vocab WHERE level = ? ORDER BY id LIMIT ? OFFSET ?");
        $vocabStmt2->bindValue(1, $lesson['level'], PDO::PARAM_INT);
        $vocabStmt2->bindValue(2, (int)$lesson['vocab_count'], PDO::PARAM_INT);
        $vocabStmt2->bindValue(3, (int)$offset, PDO::PARAM_INT);
        $vocabStmt2->execute();
        $vocab = $vocabStmt2->fetchAll();
    }

    echo json_encode([
        'lesson' => $lesson,
        'vocab' => $vocab
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// API cập nhật lesson progress (từ lesson.php)
if ($action === 'update_lesson_progress') {
    $data = json_decode(file_get_contents('php://input'), true);

    $lesson_id = intval($data['lesson_id'] ?? 0);
    $userId = $data['user_id'] ?? 'default_user';

    if (!$lesson_id) {
        echo json_encode(['success' => false, 'message' => 'Thiếu lesson_id']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO progress (lesson_id, user_id, write_completed, completed_at)
                            VALUES (?, ?, TRUE, NOW())
                            ON DUPLICATE KEY UPDATE write_completed = TRUE, completed_at = NOW()");
    $result = $stmt->execute([$lesson_id, $userId]);

    echo json_encode(['success' => $result, 'message' => 'Đã cập nhật tiến trình bài học']);
    exit;
}

// API lấy bộ thủ
if ($action === 'get_radicals') {
    $stmt = $conn->query("SELECT * FROM radicals ORDER BY strokes, id");
    $radicals = $stmt->fetchAll();
    $examples = [];
    if (file_exists(__DIR__ . '/data/radical_examples.php')) {
        $examples = include __DIR__ . '/data/radical_examples.php';
    }
    foreach ($radicals as &$r) {
        $r['examples'] = $examples[$r['char']] ?? [];
    }
    echo json_encode($radicals);
    exit;
}

// API populate char_data cho vocab
if ($action === 'populate_char_data') {
    requireAdmin();
    @set_time_limit(120); // cho phép chạy lâu hơn
    $vocabList = $conn->query("SELECT id, hanzi FROM vocab WHERE char_data IS NULL OR char_data = '' OR char_data = '[]'")->fetchAll(PDO::FETCH_ASSOC);
    // Also handle entries where char_data has all strokes=0
    $fixStmt = $conn->prepare("SELECT id, hanzi, char_data FROM vocab WHERE char_data IS NOT NULL AND char_data != '' AND char_data != '[]'");
    $fixResult = $fixStmt->execute();
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
    $radRows = $conn->query("SELECT `char`, strokes, name_vietnamese FROM radicals")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($radRows as $r) $radMap[$r['char']] = $r;

    // Also build map từ các từ đơn trong vocab (VD: 人 → strokes:2, radical: "人 (nhân)")
    $charVocabMap = [];
    $charRows = $conn->query("SELECT hanzi, strokes, radical FROM vocab WHERE CHAR_LENGTH(hanzi) = 1 AND strokes > 0")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($charRows as $r) {
        if (!isset($radMap[$r['hanzi']])) {
            $charVocabMap[$r['hanzi']] = $r;
        }
    }

    // Load character database (built from existing vocab data)
    $charDb = [];
    $dbPath = __DIR__ . '/chardata.json';
    if (file_exists($dbPath)) {
        $dbContent = json_decode(file_get_contents($dbPath), true);
        if ($dbContent) $charDb = $dbContent;
    }

    $updated = 0;
    $stmt = $conn->prepare("UPDATE vocab SET char_data = ? WHERE id = ?");
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
    echo json_encode(['success' => true, 'updated' => $updated]);
    exit;
}

// API lưu kết quả quiz
if ($action === 'save_quiz_result') {
    $data = json_decode(file_get_contents('php://input'), true);

    $stmt = $conn->prepare("INSERT INTO quiz_results (user_id, quiz_type, level, score, total_questions) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute([
        $data['user_id'] ?? 'default_user',
        $data['quiz_type'],
        $data['level'] ?? 0,
        $data['score'],
        $data['total_questions']
    ]);

    echo json_encode(['success' => $result]);
    exit;
}

// API lấy lịch sử quiz
if ($action === 'get_quiz_history') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("SELECT * FROM quiz_results WHERE user_id = ? ORDER BY completed_at DESC LIMIT 20");
    $stmt->execute([$userId]);
    echo json_encode($stmt->fetchAll());
    exit;
}

// API lấy câu hỏi luyện tập từ ngân hàng đề
if ($action === 'get_practice_questions') {
    $level = intval($_GET['level'] ?? 1);
    $moduleId = $_GET['module_id'] ?? '';
    $count = intval($_GET['count'] ?? 10);
    if ($level < 1 || $level > 6) $level = 1;
    $file = __DIR__ . "/data/practice/questions_hsk{$level}.json";
    if (!file_exists($file)) {
        echo json_encode([]);
        exit;
    }
    $questions = json_decode(file_get_contents($file), true);
    if (!$questions) {
        echo json_encode([]);
        exit;
    }
    if ($moduleId) {
        $questions = array_values(array_filter($questions, fn($q) => ($q['module_id'] ?? '') === $moduleId));
    }
    shuffle($questions);
    $questions = array_slice($questions, 0, $count);
    echo json_encode($questions);
    exit;
}

// API lấy bài viết (có phân trang + tìm kiếm)
if ($action === 'get_posts') {
    $tag = $_GET['tag'] ?? '';
    $search = $_GET['search'] ?? '';
    $author = $_GET['author'] ?? '';
    $sort = $_GET['sort'] ?? 'newest';
    $page = max(1, intval($_GET['page'] ?? 1));
    $limit = min(20, max(5, intval($_GET['limit'] ?? 10)));
    $offset = ($page - 1) * $limit;
    $userId = $_GET['user_id'] ?? '';

    $where = "p.status='approved'";
    $params = [];
    if ($tag) {
        $where .= " AND p.tags LIKE ?";
        $params[] = "%$tag%";
    }
    if ($search) {
        $where .= " AND (p.title LIKE ? OR p.content LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    if ($author) {
        $where .= " AND p.author = ?";
        $params[] = $author;
    }
    if ($sort === 'oldest') $order = "ORDER BY p.created_at ASC";
    elseif ($sort === 'popular') $order = "ORDER BY p.likes DESC, p.created_at DESC";
    else $order = "ORDER BY p.created_at DESC";

    try {
        $select = "p.*, "
            . ($userId ? "(SELECT COUNT(*) FROM post_likes pl WHERE pl.post_id = p.id AND pl.user_id = ?) as liked" : "0 as liked")
            . ", (SELECT COUNT(*) FROM comments c WHERE c.post_id = p.id) as comment_count";
        $stmt = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS $select FROM posts p WHERE $where $order LIMIT ? OFFSET ?");
        $i = 1;
        if ($userId) $stmt->bindValue($i++, $userId);
        foreach ($params as $p) { $stmt->bindValue($i++, $p); }
        $stmt->bindValue($i++, (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue($i++, (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $posts = $stmt->fetchAll();
        $total = $conn->query("SELECT FOUND_ROWS()")->fetchColumn();
        // Gắn images cho từng bài
        $imgStmt = $conn->prepare("SELECT image_path FROM post_images WHERE post_id = ? ORDER BY id ASC");
        foreach ($posts as &$post) {
            $imgStmt->execute([$post['id']]);
            $post['images'] = array_column($imgStmt->fetchAll(), 'image_path');
        }
        echo json_encode(['data' => $posts, 'total' => (int)$total, 'page' => $page, 'pages' => max(1, ceil($total / $limit))]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// API lấy bình luận
if ($action === 'get_comments') {
    $postId = intval($_GET['post_id'] ?? 0);
    if (!$postId) { echo json_encode([]); exit; }
    $stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? AND (parent_id IS NULL OR parent_id = 0) ORDER BY created_at ASC");
    $stmt->execute([$postId]);
    $comments = $stmt->fetchAll();
    foreach ($comments as &$c) {
        $r = $conn->prepare("SELECT * FROM comments WHERE parent_id = ? ORDER BY created_at ASC");
        $r->execute([$c['id']]);
        $c['replies'] = $r->fetchAll();
    }
    echo json_encode($comments);
    exit;
}

// API thêm bình luận
if ($action === 'add_comment') {
    $data = json_decode(file_get_contents('php://input'), true);
    $postId = intval($data['post_id'] ?? 0);
    $content = trim($data['content'] ?? '');
    $author = htmlspecialchars(trim($data['author'] ?? 'Ẩn danh'), ENT_QUOTES, 'UTF-8');
    $userId = $data['user_id'] ?? 'default_user';
    $parentId = intval($data['parent_id'] ?? 0);

    if (!$postId || !$content) { echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']); exit; }
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, author, content, parent_id) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute([$postId, $userId, $author, $content, $parentId ?: null]);
    echo json_encode(['success' => $result, 'id' => $conn->lastInsertId()]);
    exit;
}

// API yêu cầu reset mật khẩu (tạo token + OTP)
if ($action === 'forgot_password') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = trim($data['email'] ?? '');
    if (!$email) { echo json_encode(['success' => false, 'message' => 'Nhập email']); exit; }

    $stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (!$user) { echo json_encode(['success' => false, 'message' => 'Email không tồn tại']); exit; }

    $token = bin2hex(random_bytes(32));
    $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $stmt2 = $conn->prepare("INSERT INTO password_resets (email, token, otp) VALUES (?, ?, ?)");
    $stmt2->execute([$email, $token, $otp]);

    // Lấy thời gian hết hạn
    $expiresAt = date('H:i d/m/Y', strtotime('+1 hour'));

    $siteUrl = SITE_URL;
    $resetLink = $siteUrl . '/reset_password.php?token=' . $token;
    $fromName = defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : 'HànNgữ';
    $fromEmail = defined('SMTP_FROM') ? SMTP_FROM : 'noreply@hanngu.local';
    $shopName = 'HànNgữ';

    $mailSent = false;

    // Nội dung email
    $emailSubject = 'Đặt lại mật khẩu - ' . $shopName;
    $emailBody = "Xin chào,\n\n"
        . "Bạn (hoặc ai đó) vừa yêu cầu đặt lại mật khẩu trên $shopName.\n\n"
        . "Mã OTP: $otp\n"
        . "Hết hạn: $expiresAt\n\n"
        . "Bạn có thể nhập mã OTP tại trang \"Quên mật khẩu\" hoặc bấm vào đây để đặt lại ngay:\n"
        . "$resetLink\n\n"
        . "Nếu không phải bạn, hãy bỏ qua email này.\n\n"
        . "Trân trọng,\n"
        . "$shopName";

    // Thử gửi bằng PHPMailer nếu có SMTP config
    if (defined('SMTP_HOST') && SMTP_HOST && defined('SMTP_USER') && SMTP_USER && defined('SMTP_PASS') && SMTP_PASS) {
        try {
            require_once __DIR__ . '/phpmailer/PHPMailer.php';
            require_once __DIR__ . '/phpmailer/SMTP.php';
            require_once __DIR__ . '/phpmailer/Exception.php';

            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = defined('SMTP_ENCRYPTION') ? SMTP_ENCRYPTION : 'tls';
            $mail->Port = defined('SMTP_PORT') ? SMTP_PORT : 587;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($email, $user['username']);
            $mail->isHTML(true);
            $mail->Subject = $emailSubject;
            $mail->Body = nl2br(htmlspecialchars(
                "Xin chào,\n\n"
                . "Bạn (hoặc ai đó) vừa yêu cầu đặt lại mật khẩu trên $shopName.\n\n"
                . "Mã OTP: $otp\n"
                . "Hết hạn: $expiresAt\n\n"
                . "Bạn có thể nhập mã OTP tại trang \"Quên mật khẩu\" hoặc bấm vào đây để đặt lại ngay.\n\n"
                . "Nếu không phải bạn, hãy bỏ qua email này.\n\n"
                . "Trân trọng,\n$shopName"
            ));
            // Thay "bấm vào đây" bằng link HTML
            $mail->Body = str_replace(
                'bấm vào đây',
                "<a href=\"$resetLink\" style=\"color:#0d9488;font-weight:600\">bấm vào đây</a>",
                $mail->Body
            );
            $mail->AltBody = $emailBody;
            $mail->send();
            $mailSent = true;
        } catch (Exception $e) {
            $mailSent = false;
        }
    }

    // Fallback: dùng mail() nếu PHPMailer không gửi được
    if (!$mailSent) {
        $headers = "From: $fromEmail\r\nReply-To: $fromEmail\r\nX-Mailer: PHP/" . phpversion();
        $mailSent = @mail($email, $emailSubject, $emailBody, $headers);
    }

    // Luôn trả về thành công (che giấu lỗi SMTP để tránh lộ thông tin)
    echo json_encode([
        'success' => true,
        'message' => 'Email đặt lại mật khẩu đã được gửi đến ' . $email
    ]);
    exit;
}

// API xác thực OTP
if ($action === 'verify_otp') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = trim($data['email'] ?? '');
    $otp = trim($data['otp'] ?? '');

    if (!$email || !$otp) { echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']); exit; }

    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE email = ? AND otp = ? AND created_at > NOW() - INTERVAL 1 HOUR ORDER BY created_at DESC LIMIT 1");
    $stmt->execute([$email, $otp]);
    $reset = $stmt->fetch();

    if (!$reset) { echo json_encode(['success' => false, 'message' => 'Mã OTP không đúng hoặc đã hết hạn']); exit; }

    echo json_encode([
        'success' => true,
        'token' => $reset['token'],
        'message' => 'Xác thực OTP thành công'
    ]);
    exit;
}

// API reset mật khẩu
if ($action === 'reset_password') {
    $data = json_decode(file_get_contents('php://input'), true);
    $token = trim($data['token'] ?? '');
    $password = $data['password'] ?? '';

    if (!$token || strlen($password) < 6) { echo json_encode(['success' => false, 'message' => 'Token hoặc mật khẩu không hợp lệ']); exit; }

    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND created_at > NOW() - INTERVAL 1 HOUR");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();
    if (!$reset) { echo json_encode(['success' => false, 'message' => 'Token không hợp lệ hoặc đã hết hạn']); exit; }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt2 = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt2->execute([$hash, $reset['email']]);
    $stmt3 = $conn->prepare("DELETE FROM password_resets WHERE token = ?");
    $stmt3->execute([$token]);

    echo json_encode(['success' => true, 'message' => 'Đặt lại mật khẩu thành công']);
    exit;
}

// API upload avatar
if ($action === 'upload_avatar') {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!isset($_SESSION['user_id'])) { echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']); exit; }

    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Lỗi upload']); exit;
    }

    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES['avatar']['type'], $allowed)) { echo json_encode(['success' => false, 'message' => 'Chỉ chấp nhận ảnh (JPEG, PNG, GIF, WebP)']); exit; }

    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = 'avatar_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
    $dest = __DIR__ . '/uploads/' . $filename;
    if (!is_dir(__DIR__ . '/uploads')) mkdir(__DIR__ . '/uploads', 0755, true);

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dest)) {
        $url = 'uploads/' . $filename;
        $stmt = $conn->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->execute([$url, $_SESSION['user_id']]);
        echo json_encode(['success' => true, 'url' => $url]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi lưu file']);
    }
    exit;
}

// API điểm danh
if ($action === 'checkin') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = $data['user_id'] ?? 'default_user';
    $today = date('Y-m-d');

    $stmt = $conn->prepare("INSERT IGNORE INTO daily_streak (user_id, streak_date) VALUES (?, ?)");
    $result = $stmt->execute([$userId, $today]);

    // Đếm streak
    $streak = 0;
    $d = new DateTime();
    while (true) {
        $date = $d->format('Y-m-d');
        $check = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?");
        $check->execute([$userId, $date]);
        if ($check->fetch()) { $streak++; $d->modify('-1 day'); }
        else break;
    }

    echo json_encode(['success' => $result, 'streak' => $streak, 'today' => $today]);
    exit;
}

// API lấy streak
if ($action === 'get_streak') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $streak = 0;
    $d = new DateTime();
    while (true) {
        $date = $d->format('Y-m-d');
        $check = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?");
        $check->execute([$userId, $date]);
        if ($check->fetch()) { $streak++; $d->modify('-1 day'); }
        else break;
    }
    // Kiểm tra đã điểm danh hôm nay chưa
    $today = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = CURDATE()");
    $today->execute([$userId]);

    echo json_encode(['streak' => $streak, 'checked_in_today' => $today->fetch() ? true : false]);
    exit;
}

// API export sổ tay (text)
if ($action === 'export_notebook') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("
        SELECT COALESCE(v.hanzi, n.custom_hanzi) AS hanzi,
               COALESCE(v.pinyin, n.custom_pinyin) AS pinyin,
               COALESCE(v.meaning, n.custom_meaning) AS meaning,
               COALESCE(v.example, n.custom_example) AS example
        FROM notebook n
        LEFT JOIN vocab v ON n.vocab_id = v.id
        WHERE n.user_id = ?
        ORDER BY n.saved_at DESC
    ");
    $stmt->execute([$userId]);
    $items = $stmt->fetchAll();

    $text = "=== HànNgữ - Sổ tay từ vựng ===\n\n";
    foreach ($items as $v) {
        $text .= "{$v['hanzi']} ({$v['pinyin']}) - {$v['meaning']}\n";
        if ($v['example']) $text .= "  VD: {$v['example']}\n";
        $text .= "\n";
    }
    $text .= "--- Xuất từ HànNgữ ---\n";

    header('Content-Type: text/plain; charset=utf-8');
    header('Content-Disposition: attachment; filename="hanngu_notebook.txt"');
    echo $text;
    exit;
}

// API export sổ tay PDF
if ($action === 'export_notebook_pdf') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("
        SELECT COALESCE(v.hanzi, n.custom_hanzi) AS hanzi,
               COALESCE(v.pinyin, n.custom_pinyin) AS pinyin,
               COALESCE(v.meaning, n.custom_meaning) AS meaning,
               COALESCE(v.example, n.custom_example) AS example
        FROM notebook n
        LEFT JOIN vocab v ON n.vocab_id = v.id
        WHERE n.user_id = ? ORDER BY n.saved_at DESC");
    $stmt->execute([$userId]);
    $items = $stmt->fetchAll();

    require_once __DIR__ . '/tcpdf/tcpdf.php';
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('HànNgữ');
    $pdf->SetTitle('Sổ tay từ vựng');
    $pdf->SetMargins(15, 15, 15);
    $pdf->AddPage();
    $pdf->SetFont('dejavusans', 'B', 20);
    $pdf->Cell(0, 12, 'HànNgữ - Sổ tay từ vựng', 0, 1, 'C');
    $pdf->SetFont('dejavusans', '', 10);
    $pdf->Cell(0, 8, 'Ngày xuất: ' . date('d/m/Y'), 0, 1, 'C');
    $pdf->Ln(8);

    if (empty($items)) {
        $pdf->SetFont('dejavusans', '', 12);
        $pdf->Cell(0, 10, 'Chưa có từ vựng nào.', 0, 1, 'C');
    } else {
        $pdf->SetFont('dejavusans', 'B', 10);
        $pdf->SetFillColor(16, 185, 129);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 8, 'Hán tự', 1, 0, 'C', true);
        $pdf->Cell(40, 8, 'Pinyin', 1, 0, 'C', true);
        $pdf->Cell(85, 8, 'Nghĩa', 1, 1, 'C', true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('dejavusans', '', 10);

        foreach ($items as $v) {
            $h = 8;
            $pdf->Cell(50, $h, $v['hanzi'], 1, 0, 'C');
            $pdf->Cell(40, $h, $v['pinyin'], 1, 0, 'C');
            $pdf->Cell(85, $h, $v['meaning'], 1, 1, 'L');
            if ($v['example']) {
                $pdf->SetFont('dejavusans', '', 8);
                $pdf->SetTextColor(100, 100, 100);
                $pdf->Cell(0, 6, 'VD: ' . $v['example'], 0, 1, 'L');
                $pdf->SetTextColor(0, 0, 0);
                $pdf->SetFont('dejavusans', '', 10);
            }
        }
    }

    $pdf->Output('hanngu_notebook.pdf', 'D');
    exit;
}

// API lấy biểu đồ (thống kê cho profile)
if ($action === 'get_chart_data') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $data = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = (new DateTime())->modify("-{$i} days")->format('Y-m-d');
        $check = $conn->prepare("SELECT id FROM daily_streak WHERE user_id = ? AND streak_date = ?");
        $check->execute([$userId, $date]);
        $data[] = ['date' => $date, 'checked' => $check->fetch() ? 1 : 0];
    }

    echo json_encode($data);
    exit;
}

// ===== PVP ENDPOINTS =====
if ($action === 'create_room') {
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = $data['user_id'] ?? 'default_user';
    $userName = $data['user_name'] ?? $userId;
    $level = intval($data['level'] ?? 1);
    $quizType = $data['quiz_type'] ?? 'choice';
    $totalQuestions = intval($data['total_questions'] ?? 10);

    // Generate unique room code
    do {
        $roomCode = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        $check = $conn->prepare("SELECT id FROM pvp_rooms WHERE room_code = ? AND status = 'waiting'");
        $check->execute([$roomCode]);
    } while ($check->fetch());

    $stmt = $conn->prepare("INSERT INTO pvp_rooms (room_code, player1_id, player1_name, level, quiz_type, total_questions, status)
                            VALUES (?, ?, ?, ?, ?, ?, 'waiting')");
    $result = $stmt->execute([$roomCode, $userId, $userName, $level, $quizType, $totalQuestions]);

    echo json_encode([
        'success' => $result,
        'room_code' => $roomCode,
        'room_id' => $conn->lastInsertId()
    ]);
    exit;
}

if ($action === 'join_room') {
    $data = json_decode(file_get_contents('php://input'), true);
    $roomCode = strtoupper(trim($data['room_code'] ?? ''));
    $userId = $data['user_id'] ?? 'default_user';
    $userName = $data['user_name'] ?? $userId;

    $stmt = $conn->prepare("SELECT * FROM pvp_rooms WHERE room_code = ? AND status = 'waiting'");
    $stmt->execute([$roomCode]);
    $room = $stmt->fetch();

    if (!$room) {
        echo json_encode(['success' => false, 'message' => 'Phòng không tồn tại hoặc đã bắt đầu']);
        exit;
    }
    if ($room['player1_id'] === $userId) {
        echo json_encode(['success' => false, 'message' => 'Bạn là chủ phòng']);
        exit;
    }

    $upd = $conn->prepare("UPDATE pvp_rooms SET player2_id = ?, player2_name = ? WHERE id = ?");
    $upd->execute([$userId, $userName, $room['id']]);

    // Re-fetch updated room
    $stmt2 = $conn->prepare("SELECT * FROM pvp_rooms WHERE id = ?");
    $stmt2->execute([$room['id']]);
    $room = $stmt2->fetch();

    echo json_encode([
        'success' => true,
        'room' => $room
    ]);
    exit;
}

if ($action === 'start_room') {
    $data = json_decode(file_get_contents('php://input'), true);
    $roomCode = strtoupper(trim($data['room_code'] ?? ''));
    $userId = $data['user_id'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM pvp_rooms WHERE room_code = ?");
    $stmt->execute([$roomCode]);
    $room = $stmt->fetch();

    if (!$room) {
        echo json_encode(['success' => false, 'message' => 'Phòng không tồn tại']);
        exit;
    }
    if ($room['player1_id'] !== $userId) {
        echo json_encode(['success' => false, 'message' => 'Chỉ chủ phòng mới có thể bắt đầu']);
        exit;
    }
    if (!$room['player2_id']) {
        echo json_encode(['success' => false, 'message' => 'Chưa có đối thủ']);
        exit;
    }

    $upd = $conn->prepare("UPDATE pvp_rooms SET status = 'playing' WHERE id = ?");
    $upd->execute([$room['id']]);

    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'get_room') {
    $roomCode = strtoupper(trim($_GET['room_code'] ?? ''));
    $userId = $_GET['user_id'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM pvp_rooms WHERE room_code = ?");
    $stmt->execute([$roomCode]);
    $room = $stmt->fetch();

    if (!$room) {
        echo json_encode(['success' => false, 'message' => 'Phòng không tồn tại']);
        exit;
    }

    echo json_encode(['success' => true, 'room' => $room]);
    exit;
}

if ($action === 'submit_pvp_score') {
    $data = json_decode(file_get_contents('php://input'), true);
    $roomCode = strtoupper(trim($data['room_code'] ?? ''));
    $userId = $data['user_id'] ?? '';
    $score = intval($data['score'] ?? 0);
    $total = intval($data['total'] ?? 0);

    $stmt = $conn->prepare("SELECT * FROM pvp_rooms WHERE room_code = ?");
    $stmt->execute([$roomCode]);
    $room = $stmt->fetch();

    if (!$room) {
        echo json_encode(['success' => false, 'message' => 'Phòng không tồn tại']);
        exit;
    }

    // Determine if player1 or player2
    if ($room['player1_id'] === $userId) {
        $upd = $conn->prepare("UPDATE pvp_rooms SET player1_score = ?, player1_total = ? WHERE id = ?");
        $upd->execute([$score, $total, $room['id']]);
    } elseif ($room['player2_id'] === $userId) {
        $upd = $conn->prepare("UPDATE pvp_rooms SET player2_score = ?, player2_total = ? WHERE id = ?");
        $upd->execute([$score, $total, $room['id']]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Bạn không trong phòng này']);
        exit;
    }

    // Check if both players have submitted
    $stmt2 = $conn->prepare("SELECT * FROM pvp_rooms WHERE id = ?");
    $stmt2->execute([$room['id']]);
    $updated = $stmt2->fetch();

    $winner = null;
    if ($updated['player1_total'] > 0 && $updated['player2_total'] > 0) {
        // Both done
        $p1pct = $updated['player1_total'] > 0 ? $updated['player1_score'] / $updated['player1_total'] : 0;
        $p2pct = $updated['player2_total'] > 0 ? $updated['player2_score'] / $updated['player2_total'] : 0;
        if ($p1pct > $p2pct) $winner = $updated['player1_name'];
        elseif ($p2pct > $p1pct) $winner = $updated['player2_name'];
        else $winner = 'Hòa';

        $finish = $conn->prepare("UPDATE pvp_rooms SET status = 'finished', completed_at = NOW() WHERE id = ?");
        $finish->execute([$room['id']]);
    }

    echo json_encode([
        'success' => true,
        'winner' => $winner,
        'room' => $updated
    ]);
    exit;
}

if ($action === 'get_user_info') {
    $userId = $_GET['user_id'] ?? '';
    if (!$userId || $userId === 'default_user') {
        echo json_encode(['success' => false]);
        exit;
    }
    $numericId = preg_replace('/[^0-9]/', '', $userId);
    $stmt = $conn->prepare("SELECT id, username, display_name, avatar FROM users WHERE id = ?");
    $stmt->execute([$numericId]);
    $user = $stmt->fetch();
    echo json_encode(['success' => true, 'user' => $user]);
    exit;
}

// ===== LEADERBOARD =====
if ($action === 'get_leaderboard') {
    $limit = min(50, max(1, intval($_GET['limit'] ?? 20)));

    $stmt = $conn->query("
        SELECT
            u.id,
            u.display_name,
            u.username,
            (SELECT COUNT(DISTINCT lesson_id) FROM progress WHERE user_id = CONCAT('user_', u.id) AND lesson_id IS NOT NULL AND write_completed = 1) as lessons_completed,
            (SELECT COUNT(*) FROM quiz_results WHERE user_id = CONCAT('user_', u.id)) as quiz_count,
            COALESCE((SELECT AVG(score * 100.0 / total_questions) FROM quiz_results WHERE user_id = CONCAT('user_', u.id) AND total_questions > 0), 0) as quiz_avg,
            (SELECT COALESCE(SUM(score), 0) FROM quiz_results WHERE user_id = CONCAT('user_', u.id)) as total_score,
            (SELECT COUNT(*) FROM daily_streak WHERE user_id = CONCAT('user_', u.id) AND streak_date >= CURDATE() - INTERVAL 7 DAY) as streak
        FROM users u
        HAVING lessons_completed > 0 OR quiz_count > 0
        ORDER BY lessons_completed DESC, quiz_avg DESC, total_score DESC
        LIMIT $limit
    ");
    $results = $stmt->fetchAll();

    // Calculate ranks
    $rank = 0;
    $prevScore = null;
    foreach ($results as &$row) {
        if ($row['total_score'] !== $prevScore) $rank++;
        $row['rank'] = $rank;
        $row['display_name'] = $row['display_name'] ?: $row['username'];
        $row['quiz_avg'] = number_format($row['quiz_avg'], 1) . '%';
        $row['total_score'] = (int)$row['total_score'];
        $row['lessons_completed'] = (int)$row['lessons_completed'];
        $row['streak'] = (int)$row['streak'];
        $prevScore = $row['total_score'];
    }

    echo json_encode($results);
    exit;
}

// ===== DICTIONARY SEARCH =====
if ($action === 'search_vocab') {
    $q = trim($_GET['q'] ?? '');
    $level = intval($_GET['level'] ?? 0);
    $limit = min(100, max(1, intval($_GET['limit'] ?? 50)));

    if (strlen($q) < 1) {
        echo json_encode(['data' => []]);
        exit;
    }

    // Enable emulated prepares for LIKE search with Unicode
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

    $sql = "SELECT id, hanzi, pinyin, meaning, strokes, level FROM vocab WHERE (hanzi LIKE ? OR pinyin LIKE ? OR meaning LIKE ?)";
    $params = ["%$q%", "%$q%", "%$q%"];

    if ($level > 0 && $level <= 6) {
        $sql .= " AND level = ?";
        $params[] = $level;
    }

    $sql .= " ORDER BY level, id LIMIT " . intval($limit);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $results = $stmt->fetchAll();

    echo json_encode(['data' => $results]);
    exit;
}

// ===== SRS (SPACED REPETITION) =====
if ($action === 'get_review_cards') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $level = intval($_GET['level'] ?? 0);
    $limit = min(60, max(1, intval($_GET['limit'] ?? 30)));
    $includeNew = intval($_GET['new'] ?? 10);

    // Due reviews: cards with next_review <= today
    $sql = "SELECT v.*, s.ease_factor, s.interval_days, s.consecutive_correct, s.next_review, 'review' as card_type
            FROM vocab v
            INNER JOIN srs s ON s.vocab_id = v.id AND s.user_id = ?
            WHERE s.next_review <= CURDATE()";
    $params = [$userId];

    if ($level > 0 && $level <= 6) {
        $sql .= " AND v.level = ?";
        $params[] = $level;
    }

    $sql .= " ORDER BY s.next_review ASC, v.level, v.id LIMIT " . intval($limit);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $cards = $stmt->fetchAll();

    $reviewCount = count($cards);

    // New cards: never studied (no SRS entry), up to $includeNew
    if ($reviewCount < $limit && $includeNew > 0) {
        $newLimit = min($includeNew, $limit - $reviewCount);
        $newSql = "SELECT v.*, NULL as ease_factor, 0 as interval_days, 0 as consecutive_correct, NULL as next_review, 'new' as card_type
                   FROM vocab v
                   LEFT JOIN srs s ON s.vocab_id = v.id AND s.user_id = ?
                   WHERE s.id IS NULL";
        $newParams = [$userId];

        if ($level > 0 && $level <= 6) {
            $newSql .= " AND v.level = ?";
            $newParams[] = $level;
        }

        $newSql .= " ORDER BY v.level, v.id LIMIT " . intval($newLimit);
        $nStmt = $conn->prepare($newSql);
        $nStmt->execute($newParams);
        $newCards = $nStmt->fetchAll();
        $cards = array_merge($cards, $newCards);
    }

    echo json_encode(['data' => $cards, 'review_count' => $reviewCount, 'new_count' => count($cards) - $reviewCount]);
    exit;
}

if ($action === 'get_flashcard_stats') {
    $userId = $_GET['user_id'] ?? 'default_user';

    $due = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ? AND next_review <= CURDATE()");
    $due->execute([$userId]);
    $dueCount = intval($due->fetchColumn());

    $studying = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ? AND consecutive_correct < 3");
    $studying->execute([$userId]);
    $studyingCount = intval($studying->fetchColumn());

    $mastered = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ? AND consecutive_correct >= 3");
    $mastered->execute([$userId]);
    $masteredCount = intval($mastered->fetchColumn());

    $today = $conn->prepare("SELECT COUNT(*) FROM study_logs WHERE user_id = ? AND action = 'review' AND DATE(created_at) = CURDATE()");
    $today->execute([$userId]);
    $todayCount = intval($today->fetchColumn());

    $newAvailable = $conn->prepare("SELECT COUNT(*) FROM vocab v LEFT JOIN srs s ON s.vocab_id = v.id AND s.user_id = ? WHERE s.id IS NULL");
    $newAvailable->execute([$userId]);
    $newCount = intval($newAvailable->fetchColumn());

    $total = $conn->prepare("SELECT COUNT(*) FROM vocab");
    $total->execute();
    $totalVocab = intval($total->fetchColumn());

    echo json_encode([
        'success' => true,
        'due' => $dueCount,
        'studying' => $studyingCount,
        'mastered' => $masteredCount,
        'today' => $todayCount,
        'new_available' => $newCount,
        'total_vocab' => $totalVocab
    ]);
    exit;
}

if ($action === 'submit_review') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $input['user_id'] ?? 'default_user';
    $vocabId = intval($input['vocab_id'] ?? 0);
    $rating = intval($input['rating'] ?? 2);

    $conn->exec("CREATE TABLE IF NOT EXISTS `srs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `user_id` VARCHAR(100) NOT NULL,
        `vocab_id` INT NOT NULL,
        `ease_factor` DECIMAL(4,2) DEFAULT 2.50,
        `interval_days` INT DEFAULT 0,
        `consecutive_correct` INT DEFAULT 0,
        `next_review` DATE DEFAULT NULL,
        `last_reviewed` TIMESTAMP NULL DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY `user_vocab` (`user_id`, `vocab_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $conn->exec("CREATE TABLE IF NOT EXISTS `study_logs` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `user_id` VARCHAR(100) NOT NULL,
        `vocab_id` INT DEFAULT NULL,
        `action` VARCHAR(50) NOT NULL,
        `score` INT DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    if (!$vocabId) {
        echo json_encode(['success' => false, 'message' => 'Thiếu vocab_id']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM srs WHERE user_id = ? AND vocab_id = ?");
    $stmt->execute([$userId, $vocabId]);
    $srs = $stmt->fetch();

    $prevInterval = $srs ? intval($srs['interval_days']) : 0;
    $prevEase = $srs ? floatval($srs['ease_factor']) : 2.5;

    switch ($rating) {
        case 1: // Again — forgot
            $newConsecutive = 0;
            $interval = max(1, intval($prevInterval * 0.5));
            $easeFactor = max(1.3, $prevEase - 0.2);
            break;
        case 2: // Hard — correct but difficult
            $newConsecutive = ($srs ? $srs['consecutive_correct'] : 0) + 1;
            $interval = max(1, intval($prevInterval * 1.2));
            $easeFactor = max(1.3, $prevEase - 0.15);
            break;
        case 3: // Good — normal recall
            $newConsecutive = ($srs ? $srs['consecutive_correct'] : 0) + 1;
            $easeFactor = $prevEase;
            if ($prevInterval === 0) $interval = 1;
            else $interval = max(1, intval($prevInterval * $prevEase));
            break;
        case 4: // Easy — effortless
            $newConsecutive = ($srs ? $srs['consecutive_correct'] : 0) + 1;
            $easeFactor = min(3.0, $prevEase + 0.15);
            if ($prevInterval === 0) $interval = 4;
            else $interval = max(1, intval($prevInterval * $prevEase * 1.3));
            break;
        default:
            $newConsecutive = ($srs ? $srs['consecutive_correct'] : 0) + 1;
            $easeFactor = $prevEase;
            $interval = max(1, $prevInterval);
    }

    $nextReview = (new DateTime())->modify("+{$interval} days")->format('Y-m-d');

    if ($srs) {
        $stmt = $conn->prepare("UPDATE srs SET ease_factor=?, interval_days=?, consecutive_correct=?, next_review=?, last_reviewed=NOW() WHERE user_id=? AND vocab_id=?");
        $stmt->execute([$easeFactor, $interval, $newConsecutive, $nextReview, $userId, $vocabId]);
    } else {
        $stmt = $conn->prepare("INSERT INTO srs (user_id, vocab_id, ease_factor, interval_days, consecutive_correct, next_review) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $vocabId, $easeFactor, $interval, $newConsecutive, $nextReview]);
    }

    $stmt = $conn->prepare("INSERT INTO study_logs (user_id, vocab_id, action, score) VALUES (?, ?, 'review', ?)");
    $stmt->execute([$userId, $vocabId, $rating]);

    echo json_encode(['success' => true, 'interval' => $interval, 'next_review' => $nextReview, 'ease_factor' => $easeFactor, 'consecutive_correct' => $newConsecutive]);
    exit;
}

// ===== STUDY LOGS =====
if ($action === 'log_study') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $input['user_id'] ?? 'default_user';
    $vocabId = intval($input['vocab_id'] ?? 0);
    $action = $input['action'] ?? 'view';
    $score = isset($input['score']) ? intval($input['score']) : null;

    $stmt = $conn->prepare("INSERT INTO study_logs (user_id, vocab_id, action, score) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $vocabId ?: null, $action, $score]);

    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'get_study_stats') {
    $userId = $_GET['user_id'] ?? 'default_user';
    $days = min(90, max(7, intval($_GET['days'] ?? 30)));

    // Total words studied (distinct vocab in progress or study_logs)
    $total = $conn->prepare("SELECT COUNT(DISTINCT vocab_id) as count FROM study_logs WHERE user_id = ? AND vocab_id IS NOT NULL");
    $total->execute([$userId]);
    $totalStudied = $total->fetch()['count'];

    // Daily activity (last N days)
    $daily = $conn->prepare("
        SELECT DATE(created_at) as date, 
               COUNT(*) as total,
               SUM(CASE WHEN action = 'review' AND score = 1 THEN 1 ELSE 0 END) as reviewed,
               SUM(CASE WHEN action = 'write' THEN 1 ELSE 0 END) as written,
               SUM(CASE WHEN action = 'view' THEN 1 ELSE 0 END) as viewed
        FROM study_logs 
        WHERE user_id = ? AND created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
        GROUP BY DATE(created_at)
        ORDER BY date
    ");
    $daily->execute([$userId, $days]);
    $dailyData = $daily->fetchAll();

    // Streak from daily_streak
    $streak = $conn->prepare("SELECT streak_date FROM daily_streak WHERE user_id = ? ORDER BY streak_date DESC");
    $streak->execute([$userId]);
    $dates = $streak->fetchAll(PDO::FETCH_COLUMN);
    $currentStreak = 0;
    $checkDate = new DateTime();
    foreach ($dates as $d) {
        if ($d === $checkDate->format('Y-m-d')) {
            $currentStreak++;
            $checkDate->modify('-1 day');
        } else {
            break;
        }
    }

    // Total reviews done
    $reviews = $conn->prepare("SELECT COUNT(*) as count FROM study_logs WHERE user_id = ? AND action = 'review'");
    $reviews->execute([$userId]);

    // Words by level
    $byLevel = $conn->prepare("
        SELECT v.level, COUNT(DISTINCT s.vocab_id) as count 
        FROM study_logs s 
        JOIN vocab v ON v.id = s.vocab_id 
        WHERE s.user_id = ? AND s.vocab_id IS NOT NULL
        GROUP BY v.level ORDER BY v.level
    ");
    $byLevel->execute([$userId]);

    // Recent activity
    $recent = $conn->prepare("
        SELECT s.action, s.score, s.created_at, v.hanzi, v.pinyin, v.meaning
        FROM study_logs s 
        LEFT JOIN vocab v ON v.id = s.vocab_id 
        WHERE s.user_id = ? 
        ORDER BY s.created_at DESC LIMIT 20
    ");
    $recent->execute([$userId]);

    // Quiz average
    $quiz = $conn->prepare("SELECT COUNT(*) as count, COALESCE(AVG(score * 100.0 / total_questions), 0) as avg_score FROM quiz_results WHERE user_id = ?");
    $quiz->execute([$userId]);
    $quizData = $quiz->fetch();

    echo json_encode([
        'total_studied' => intval($totalStudied),
        'current_streak' => $currentStreak,
        'total_reviews' => intval($reviews->fetch()['count']),
        'daily' => $dailyData,
        'by_level' => $byLevel->fetchAll(),
        'recent' => $recent->fetchAll(),
        'quiz_count' => intval($quizData['count']),
        'quiz_avg' => round(floatval($quizData['avg_score']), 1),
    ]);
    exit;
}

// ===== HANDWRITING EVALUATION =====
if ($action === 'evaluate_handwriting') {
    $input = json_decode(file_get_contents('php://input'), true);
    $imageData = $input['image'] ?? '';
    $hanzi = $input['hanzi'] ?? '';

    if (!$imageData || !$hanzi) {
        echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu']);
        exit;
    }

    // Decode base64 image
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    if (!function_exists('imagecreatefromstring')) {
        echo json_encode(['success' => false, 'message' => 'Hệ thống chưa cài GD extension để xử lý ảnh']);
        exit;
    }
    $userImg = @imagecreatefromstring(base64_decode($imageData));

    if (!$userImg) {
        echo json_encode(['success' => false, 'message' => 'Không thể đọc ảnh']);
        exit;
    }

    $size = 140;
    $threshold = 150;

    // Resize user image to 140x140
    $userResized = imagecreatetruecolor($size, $size);
    imagecopyresampled($userResized, $userImg, 0, 0, 0, 0, $size, $size, 280, 280);
    imagedestroy($userImg);

    // Binarize user image
    $userBin = imagecreatetruecolor($size, $size);
    $white = imagecolorallocate($userBin, 255, 255, 255);
    $black = imagecolorallocate($userBin, 0, 0, 0);
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $rgb = imagecolorat($userResized, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $brightness = ($r + $g + $b) / 3;
            imagesetpixel($userBin, $x, $y, $brightness < $threshold ? $black : $white);
        }
    }
    imagedestroy($userResized);

    // Create reference image from the target character
    $refImg = imagecreatetruecolor($size, $size);
    $refWhite = imagecolorallocate($refImg, 255, 255, 255);
    $refBlack = imagecolorallocate($refImg, 0, 0, 0);
    imagefill($refImg, 0, 0, $refWhite);

    // Try to render the hanzi using available Chinese fonts
    $fontCandidates = [
        'C:/Windows/Fonts/simsun.ttc',
        'C:/Windows/Fonts/msyh.ttc',
        'C:/Windows/Fonts/mingliub.ttc',
        'C:/Windows/Fonts/msyhbd.ttc',
        'C:/Windows/Fonts/simsunb.ttf',
    ];
    $fontPath = '';
    foreach ($fontCandidates as $fp) {
        if (file_exists($fp)) { $fontPath = $fp; break; }
    }

    if ($fontPath) {
        $fontSize = 100;
        $bbox = @imagettfbbox($fontSize, 0, $fontPath, $hanzi);
        if ($bbox) {
            $charW = abs($bbox[2] - $bbox[0]) + 4;
            $charH = abs($bbox[7] - $bbox[1]) + 4;
            $x = max(0, ($size - $charW) / 2);
            $y = $size - max(0, ($size - $charH) / 2);
            @imagettftext($refImg, $fontSize, 0, $x, $y, $refBlack, $fontPath, $hanzi);
        }
    }

    // Binarize reference
    $refBin = imagecreatetruecolor($size, $size);
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $rgb = imagecolorat($refImg, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            imagesetpixel($refBin, $x, $y, ($r + $g + $b) / 3 < $threshold ? $black : $white);
        }
    }
    imagedestroy($refImg);

    // === PART A: Pixel overlap comparison (F1 score) ===
    $tp = 0; $fp = 0; $fn = 0;
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $userDark = (imagecolorat($userBin, $x, $y) & 0xFF) < 128;
            $refDark = (imagecolorat($refBin, $x, $y) & 0xFF) < 128;
            if ($userDark && $refDark) $tp++;
            elseif ($userDark && !$refDark) $fp++;
            elseif (!$userDark && $refDark) $fn++;
        }
    }

    $precision = ($tp + $fp) > 0 ? $tp / ($tp + $fp) : 0;
    $recall = ($tp + $fn) > 0 ? $tp / ($tp + $fn) : 0;
    $f1Score = ($precision + $recall) > 0 ? 2 * $precision * $recall / ($precision + $recall) : 0;
    $overlapScore = round($f1Score * 100);

    // === PART B: 8x8 grid coverage comparison ===
    $gridSize = 8;
    $cellW = $size / $gridSize;
    $cellH = $size / $gridSize;

    $userCoverage = [];
    $refCoverage = [];

    for ($gy = 0; $gy < $gridSize; $gy++) {
        for ($gx = 0; $gx < $gridSize; $gx++) {
            $userDark = 0; $refDark = 0; $total = 0;
            $startX = floor($gx * $cellW);
            $startY = floor($gy * $cellH);
            $endX = floor(($gx + 1) * $cellW);
            $endY = floor(($gy + 1) * $cellH);

            for ($y = $startY; $y < $endY; $y++) {
                for ($x = $startX; $x < $endX; $x++) {
                    $total++;
                    if ((imagecolorat($userBin, $x, $y) & 0xFF) < 128) $userDark++;
                    if ((imagecolorat($refBin, $x, $y) & 0xFF) < 128) $refDark++;
                }
            }
            $userCoverage[] = $total > 0 ? $userDark / $total : 0;
            $refCoverage[] = $total > 0 ? $refDark / $total : 0;
        }
    }

    imagedestroy($userBin);
    imagedestroy($refBin);

    // Score coverage similarity (compare user vs reference per cell)
    $coverageScore = 0;
    $cellCount = count($userCoverage);
    for ($i = 0; $i < $cellCount; $i++) {
        $diff = abs($userCoverage[$i] - $refCoverage[$i]);
        if ($diff <= 0.05) $coverageScore += 100;
        elseif ($diff <= 0.15) $coverageScore += 70;
        elseif ($diff <= 0.30) $coverageScore += 40;
        else $coverageScore += 10;
    }
    $coverageScore = round($coverageScore / $cellCount);

    // Final score: overlap 60%, coverage 40%
    $score = max(0, min(100, round($overlapScore * 0.6 + $coverageScore * 0.4)));

    // Log the evaluation
    $userId = $input['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("INSERT INTO study_logs (user_id, action, score) VALUES (?, 'handwriting', ?)");
    $stmt->execute([$userId, $score]);

    echo json_encode([
        'success' => true,
        'score' => $score,
        'feedback' => $score >= 80 ? 'Tuyệt vời! Nét chữ rất đẹp 🎉' :
                      ($score >= 60 ? 'Khá tốt! Cần luyện thêm một chút 💪' :
                      ($score >= 40 ? 'Được rồi, cố gắng thêm nhé! ✍️' : 'Hãy viết đậm và rõ nét hơn! 📝'))
    ]);
    exit;
}

// ===== ADMIN ENDPOINTS =====

// Admin session check helper (backward compat: admin OR super_admin)
function requireAdmin() {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    global $conn;
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if (!$user || !in_array($user['role'], ['admin', 'super_admin', 'content_creator', 'moderator'])) {
        echo json_encode(['success' => false, 'message' => 'Không phải admin']);
        exit;
    }
}

function requireRole(...$roles) {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    global $conn;
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if (!$user || !in_array($user['role'], $roles)) {
        echo json_encode(['success' => false, 'message' => 'Bạn không có quyền thực hiện hành động này']);
        exit;
    }
}

if ($action === 'get_all_vocab') {
    $stmt = $conn->query("SELECT * FROM vocab ORDER BY level, id");
    $results = $stmt->fetchAll();
    echo json_encode($results);
    exit;
}

if ($action === 'add_vocab') {
    requireAdmin();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $hanzi = trim($data['hanzi'] ?? '');
    if (!$hanzi) { echo json_encode(['success' => false, 'message' => 'Thiếu hanzi']); exit; }
    if ($id) {
        $stmt = $conn->prepare("UPDATE vocab SET hanzi=?, pinyin=?, meaning=?, level=?, strokes=?, radical=?, example=?, lesson_id=? WHERE id=?");
        $result = $stmt->execute([
            $hanzi, $data['pinyin'] ?? '', $data['meaning'] ?? '', intval($data['level'] ?? 1),
            intval($data['strokes'] ?? 0), $data['radical'] ?? '', $data['example'] ?? '',
            $data['lesson_id'] ?: null, $id
        ]);
    } else {
        $stmt = $conn->prepare("INSERT INTO vocab (hanzi, pinyin, meaning, level, strokes, radical, example, lesson_id) VALUES (?,?,?,?,?,?,?,?)");
        $result = $stmt->execute([
            $hanzi, $data['pinyin'] ?? '', $data['meaning'] ?? '', intval($data['level'] ?? 1),
            intval($data['strokes'] ?? 0), $data['radical'] ?? '', $data['example'] ?? '',
            $data['lesson_id'] ?: null
        ]);
    }
    echo json_encode(['success' => $result]);
    exit;
}

if ($action === 'delete_vocab') {
    requireRole('super_admin');
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM vocab WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$id])]);
    exit;
}

if ($action === 'export_vocab') {
    requireAdmin();
    $stmt = $conn->query("SELECT * FROM vocab ORDER BY level, id");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="vocab_export.csv"');
    $out = fopen('php://output', 'w');
    fprintf($out, "\xEF\xBB\xBF"); // BOM
    fputcsv($out, ['hanzi','pinyin','meaning','level','strokes','radical','example','lesson_id']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['hanzi'],$r['pinyin'],$r['meaning'],$r['level'],$r['strokes'],$r['radical'],$r['example'],$r['lesson_id']]);
    }
    fclose($out);
    exit;
}

if ($action === 'import_vocab') {
    requireAdmin();
    if (empty($_FILES['file'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa chọn file']);
        exit;
    }
    $tmp = $_FILES['file']['tmp_name'];
    $fh = fopen($tmp, 'r');
    // Detect BOM
    $bom = fread($fh, 3);
    if ($bom !== "\xEF\xBB\xBF") rewind($fh);
    $header = fgetcsv($fh);
    if (!$header || strtolower(trim($header[0] ?? '')) !== 'hanzi') {
        fclose($fh);
        echo json_encode(['success' => false, 'message' => 'File CSV không đúng định dạng. Cột đầu tiên phải là "hanzi"']);
        exit;
    }
    $insert = $conn->prepare("INSERT INTO vocab (hanzi,pinyin,meaning,level,strokes,radical,example,lesson_id) VALUES (?,?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE pinyin=VALUES(pinyin),meaning=VALUES(meaning),level=VALUES(level),strokes=VALUES(strokes),radical=VALUES(radical),example=VALUES(example),lesson_id=VALUES(lesson_id)");
    $count = 0;
    while ($row = fgetcsv($fh)) {
        $hanzi = trim($row[0] ?? '');
        if (!$hanzi) continue;
        $pinyin = trim($row[1] ?? '');
        $meaning = trim($row[2] ?? '');
        $level = intval($row[3] ?? 1);
        $strokes = intval($row[4] ?? 0);
        $radical = trim($row[5] ?? '');
        $example = trim($row[6] ?? '');
        $lessonId = $row[7] ?? null;
        $insert->execute([$hanzi,$pinyin,$meaning,$level,$strokes,$radical,$example,$lessonId ?: null]);
        $count++;
    }
    fclose($fh);
    echo json_encode(['success' => true, 'count' => $count]);
    exit;
}

if ($action === 'get_all_lessons') {
    requireAdmin();
    $level = intval($_GET['level'] ?? 0);
    $sql = "SELECT * FROM lessons";
    if ($level > 0) $sql .= " WHERE level = ?";
    $sql .= " ORDER BY level, lesson_num";
    $stmt = $conn->prepare($sql);
    $stmt->execute($level > 0 ? [$level] : []);
    echo json_encode($stmt->fetchAll());
    exit;
}

if ($action === 'add_lesson') {
    requireAdmin();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = $data['id'] ?? null;
    $title = trim($data['title'] ?? '');
    $level = intval($data['level'] ?? 1);
    if (!$title) { echo json_encode(['success' => false, 'message' => 'Thiếu tiêu đề']); exit; }
    if ($id) {
        $stmt = $conn->prepare("UPDATE lessons SET title=?, description=?, vocab_count=?, level=? WHERE id=?");
        $result = $stmt->execute([$title, $data['description'] ?? '', intval($data['vocab_count'] ?? 10), $level, $id]);
    } else {
        // Auto-generate lesson_num
        $max = $conn->prepare("SELECT COALESCE(MAX(lesson_num),0)+1 FROM lessons WHERE level=?");
        $max->execute([$level]);
        $num = intval($max->fetchColumn());
        $stmt = $conn->prepare("INSERT INTO lessons (title, description, vocab_count, level, lesson_num) VALUES (?,?,?,?,?)");
        $result = $stmt->execute([$title, $data['description'] ?? '', intval($data['vocab_count'] ?? 10), $level, $num]);
    }
    echo json_encode(['success' => $result]);
    exit;
}

if ($action === 'delete_lesson') {
    requireRole('super_admin');
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM lessons WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$id])]);
    exit;
}

if ($action === 'export_lessons') {
    requireAdmin();
    $stmt = $conn->query("SELECT * FROM lessons ORDER BY level, lesson_num");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="lessons_export.csv"');
    $out = fopen('php://output', 'w');
    fprintf($out, "\xEF\xBB\xBF");
    fputcsv($out, ['title','description','vocab_count','level','lesson_num']);
    foreach ($rows as $r) {
        fputcsv($out, [$r['title'],$r['description'],$r['vocab_count'],$r['level'],$r['lesson_num']]);
    }
    fclose($out);
    exit;
}

if ($action === 'import_lessons') {
    requireAdmin();
    if (empty($_FILES['file'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa chọn file']);
        exit;
    }
    $tmp = $_FILES['file']['tmp_name'];
    $fh = fopen($tmp, 'r');
    $bom = fread($fh, 3);
    if ($bom !== "\xEF\xBB\xBF") rewind($fh);
    $header = fgetcsv($fh);
    if (!$header || strtolower(trim($header[0] ?? '')) !== 'title') {
        fclose($fh);
        echo json_encode(['success' => false, 'message' => 'File CSV không đúng định dạng. Cột đầu tiên phải là "title"']);
        exit;
    }
    $insert = $conn->prepare("INSERT INTO lessons (title,description,vocab_count,level,lesson_num) VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE description=VALUES(description),vocab_count=VALUES(vocab_count),level=VALUES(level)");
    $count = 0;
    while ($row = fgetcsv($fh)) {
        $title = trim($row[0] ?? '');
        if (!$title) continue;
        $desc = trim($row[1] ?? '');
        $vc = intval($row[2] ?? 10);
        $level = intval($row[3] ?? 1);
        $num = intval($row[4] ?? 0);
        if ($num === 0) {
            $max = $conn->prepare("SELECT COALESCE(MAX(lesson_num),0)+1 FROM lessons WHERE level=?");
            $max->execute([$level]);
            $num = intval($max->fetchColumn());
        }
        $insert->execute([$title,$desc,$vc,$level,$num]);
        $count++;
    }
    fclose($fh);
    echo json_encode(['success' => true, 'count' => $count]);
    exit;
}

if ($action === 'get_users') {
    requireRole('super_admin');
    $stmt = $conn->query("
        SELECT u.*,
            (SELECT COUNT(*) FROM progress WHERE user_id = CONCAT('user_', u.id)) as vocab_count,
            (SELECT COUNT(*) FROM quiz_results WHERE user_id = CONCAT('user_', u.id)) as quiz_count
        FROM users u ORDER BY u.id
    ");
    echo json_encode($stmt->fetchAll());
    exit;
}

if ($action === 'update_user_role') {
    requireRole('super_admin');
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = intval($data['id'] ?? 0);
    $role = $data['role'] ?? 'user';
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$role, $userId])]);
    exit;
}

if ($action === 'toggle_user_ban') {
    requireRole('super_admin');
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = intval($data['id'] ?? 0);
    if ($userId <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
        exit;
    }
    $stmt = $conn->prepare("SELECT role, banned FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Người dùng không tồn tại']);
        exit;
    }
    if ($user['role'] === 'super_admin') {
        echo json_encode(['success' => false, 'message' => 'Không thể khoá tài khoản admin']);
        exit;
    }
    $newBanned = $user['banned'] ? 0 : 1;
    $stmt = $conn->prepare("UPDATE users SET banned = ? WHERE id = ?");
    $stmt->execute([$newBanned, $userId]);
    echo json_encode(['success' => true, 'banned' => $newBanned]);
    exit;
}

if ($action === 'check_ban_status') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['banned' => false]);
        exit;
    }
    $stmt = $conn->prepare("SELECT banned FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $u = $stmt->fetch();
    echo json_encode(['banned' => !empty($u['banned'])]);
    exit;
}

if ($action === 'get_all_posts') {
    requireAdmin();
    $stmt = $conn->query("SELECT p.*, (SELECT COUNT(*) FROM comments WHERE post_id = p.id) as comment_count FROM posts p ORDER BY p.created_at DESC");
    echo json_encode($stmt->fetchAll());
    exit;
}

if ($action === 'delete_post') {
    $id = intval($_GET['id'] ?? 0);
    requireAdmin();
    $conn->prepare("DELETE FROM comments WHERE post_id = ?")->execute([$id]);
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$id])]);
    exit;
}

if ($action === 'get_all_comments') {
    requireAdmin();
    $stmt = $conn->query("SELECT c.*, p.title as post_title FROM comments c LEFT JOIN posts p ON c.post_id = p.id ORDER BY c.created_at DESC LIMIT 200");
    echo json_encode($stmt->fetchAll());
    exit;
}

if ($action === 'delete_comment') {
    $id = intval($_GET['id'] ?? 0);
    requireAdmin();
    $del = $conn->prepare("DELETE FROM comments WHERE id = ?");
    echo json_encode(['success' => $del->execute([$id])]);
    exit;
}

if ($action === 'update_post_status') {
    requireAdmin();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id'] ?? 0);
    $status = $data['status'] ?? 'approved';
    // Only allow changing if post is currently pending
    $check = $conn->prepare("SELECT status FROM posts WHERE id = ?");
    $check->execute([$id]);
    $current = $check->fetchColumn();
    if ($current && $current !== 'pending') {
        echo json_encode(['success' => false, 'message' => 'Bài viết đã được xử lý, không thể thay đổi trạng thái']);
        exit;
    }
    $stmt = $conn->prepare("UPDATE posts SET status = ? WHERE id = ? AND status = 'pending'");
    echo json_encode(['success' => (bool)$stmt->execute([$status, $id]) && $stmt->rowCount() > 0]);
    exit;
}

if ($action === 'submit_error_report') {
    $data = json_decode(file_get_contents('php://input'), true);
    $vocabId = intval($data['vocab_id'] ?? 0);
    $hanzi = trim($data['hanzi'] ?? '');
    $field = $data['field'] ?? '';
    $oldValue = $data['old_value'] ?? '';
    $newValue = trim($data['new_value'] ?? '');
    $note = trim($data['note'] ?? '');
    $userId = $_SESSION['user_id'] ?? null;
    if (!$vocabId || !$hanzi || !$field || !$newValue) {
        echo json_encode(['success' => false, 'message' => 'Thiếu thông tin báo lỗi']);
        exit;
    }
    if (!in_array($field, ['pinyin', 'meaning'])) {
        echo json_encode(['success' => false, 'message' => 'Trường không hợp lệ']);
        exit;
    }
    $stmt = $conn->prepare("INSERT INTO error_reports (vocab_id, hanzi, field, old_value, new_value, note, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $ok = $stmt->execute([$vocabId, $hanzi, $field, $oldValue, $newValue, $note, $userId]);
    echo json_encode(['success' => $ok, 'message' => $ok ? 'Cảm ơn bạn đã báo lỗi!' : 'Lỗi khi lưu']);
    exit;
}

if ($action === 'get_error_reports') {
    requireRole('super_admin', 'content_creator', 'moderator');
    $stmt = $conn->query("SELECT e.*, COALESCE(u.display_name, u.username, 'Khách') AS reporter FROM error_reports e LEFT JOIN users u ON e.user_id = u.id ORDER BY e.created_at DESC");
    echo json_encode($stmt->fetchAll());
    exit;
}

if ($action === 'delete_error_report') {
    requireRole('super_admin');
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id'] ?? 0);
    $del = $conn->prepare("DELETE FROM error_reports WHERE id = ?");
    echo json_encode(['success' => $del->execute([$id])]);
    exit;
}

if ($action === 'fix_error_report') {
    requireRole('super_admin', 'content_creator');
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id'] ?? 0);
    $vocabId = intval($data['vocab_id'] ?? 0);
    $field = $data['field'] ?? '';
    $newValue = trim($data['new_value'] ?? '');
    if (!$id || !$vocabId || !$field || !$newValue) {
        echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']);
        exit;
    }
    $col = $field === 'pinyin' ? 'pinyin' : 'meaning';
    $upd = $conn->prepare("UPDATE vocab SET $col = ? WHERE id = ?");
    $ok = $upd->execute([$newValue, $vocabId]);
    if ($ok) {
        $done = $conn->prepare("UPDATE error_reports SET status = 'fixed' WHERE id = ?");
        $done->execute([$id]);
    }
    echo json_encode(['success' => $ok, 'message' => $ok ? 'Đã cập nhật từ vựng!' : 'Lỗi khi cập nhật']);
    exit;
}

if ($action === 'get_admin_stats') {
    requireAdmin();
    $vocab = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
    $lessons = $conn->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
    $users = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
    $posts = $conn->query("SELECT COUNT(*) FROM posts")->fetchColumn();
    $comments = $conn->query("SELECT COUNT(*) FROM comments")->fetchColumn();
    $pending = $conn->query("SELECT COUNT(*) FROM posts WHERE status='pending'")->fetchColumn();
    $todayUsers = $conn->query("SELECT COUNT(*) FROM users WHERE DATE(created_at) = CURDATE()")->fetchColumn();
    echo json_encode([
        'vocab' => (int)$vocab, 'lessons' => (int)$lessons, 'users' => (int)$users,
        'posts' => (int)$posts, 'comments' => (int)$comments, 'pending' => (int)$pending,
        'todayUsers' => (int)$todayUsers
    ]);
    exit;
}

if ($action === 'get_admin_chart_data') {
    requireAdmin();
    // Registrations last 30 days
    $reg = $conn->query("SELECT DATE(created_at) as date, COUNT(*) as cnt FROM users WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY DATE(created_at) ORDER BY date");
    $registrations = $reg->fetchAll(PDO::FETCH_ASSOC);
    // Fill missing dates
    $regMap = [];
    foreach ($registrations as $r) $regMap[$r['date']] = (int)$r['cnt'];
    $chartReg = [];
    for ($i = 29; $i >= 0; $i--) {
        $d = date('Y-m-d', strtotime("-{$i} days"));
        $chartReg[] = ['date' => $d, 'count' => $regMap[$d] ?? 0];
    }
    // HSK distribution from quiz_results
    $hsk = $conn->query("SELECT q.level, COUNT(DISTINCT q.user_id) as cnt FROM quiz_results q WHERE q.level BETWEEN 1 AND 6 GROUP BY q.level ORDER BY q.level");
    $hskDist = $hsk->fetchAll(PDO::FETCH_ASSOC);
    $hskMap = [1=>0,2=>0,3=>0,4=>0,5=>0,6=>0];
    foreach ($hskDist as $h) $hskMap[(int)$h['level']] = (int)$h['cnt'];
    echo json_encode([
        'registrations' => $chartReg,
        'hskDistribution' => [1=>$hskMap[1],2=>$hskMap[2],3=>$hskMap[3],4=>$hskMap[4],5=>$hskMap[5],6=>$hskMap[6]]
    ]);
    exit;
}

if ($action === 'get_user_detail') {
    requireAdmin();
    $userId = intval($_GET['user_id'] ?? 0);
    if (!$userId) { echo json_encode(['success'=>false,'message'=>'Thiếu user_id']); exit; }

    // User info
    $u = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $u->execute([$userId]);
    $user = $u->fetch();
    if (!$user) { echo json_encode(['success'=>false,'message'=>'Không tìm thấy user']); exit; }

    $uid = 'user_' . $userId;

    // Current HSK level (most recent quiz level)
    $hsk = $conn->prepare("SELECT level FROM quiz_results WHERE user_id = ? ORDER BY completed_at DESC LIMIT 1");
    $hsk->execute([$uid]);
    $currentLevel = $hsk->fetchColumn();
    if (!$currentLevel) $currentLevel = 1;

    // HSK distribution of quizzes taken
    $dist = $conn->prepare("SELECT level, COUNT(*) as cnt FROM quiz_results WHERE user_id = ? GROUP BY level ORDER BY level");
    $dist->execute([$uid]);
    $hskDist = $dist->fetchAll();

    // Streak (daily_streak)
    $streak = $conn->prepare("SELECT streak_date FROM daily_streak WHERE user_id = ? ORDER BY streak_date DESC");
    $streak->execute([$uid]);
    $dates = $streak->fetchAll(PDO::FETCH_COLUMN);
    $currentStreak = 0;
    $d = new DateTime();
    foreach ($dates as $date) {
        if ($date === $d->format('Y-m-d') || $date === $d->modify('-1 day')->format('Y-m-d')) {
            $currentStreak++;
            $d->modify('-1 day');
        } else break;
    }

    // SRS stats
    $srsDue = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ? AND next_review <= NOW()");
    $srsDue->execute([$uid]);
    $srsMastered = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ? AND consecutive_correct >= 3");
    $srsMastered->execute([$uid]);
    $srsTotal = $conn->prepare("SELECT COUNT(*) FROM srs WHERE user_id = ?");
    $srsTotal->execute([$uid]);

    // Progress (vocab learned)
    $progTotal = $conn->prepare("SELECT COUNT(*) FROM progress WHERE user_id = ?");
    $progTotal->execute([$uid]);

    // Recent quizzes
    $quizzes = $conn->prepare("SELECT * FROM quiz_results WHERE user_id = ? ORDER BY completed_at DESC LIMIT 10");
    $quizzes->execute([$uid]);

    echo json_encode([
        'success' => true,
        'user' => $user,
        'currentLevel' => (int)$currentLevel,
        'hskDistribution' => $hskDist,
        'streak' => $currentStreak,
        'srsDue' => (int)$srsDue->fetchColumn(),
        'srsMastered' => (int)$srsMastered->fetchColumn(),
        'srsTotal' => (int)$srsTotal->fetchColumn(),
        'vocabLearned' => (int)$progTotal->fetchColumn(),
        'recentQuizzes' => $quizzes->fetchAll()
    ]);
    exit;
}

// AI Image Recognition with Gemini
if ($action === 'ai_recognize') {
    try {
    $input = json_decode(file_get_contents('php://input'), true);
    $imageDataUrl = $input['image'] ?? '';
    $userId = $input['user_id'] ?? 'default_user';
    // Convert user_id to numeric
    $numericUserId = 0;
    if (is_numeric($userId)) {
        $numericUserId = intval($userId);
    } elseif (strpos($userId, 'user_') === 0) {
        $numericUserId = intval(substr($userId, 5));
    }

    if (!$imageDataUrl) {
        echo json_encode(['success' => false, 'message' => 'Thiếu dữ liệu ảnh']);
        exit;
    }

    // Extract mime type and base64 data
    $mime = 'image/jpeg';
    $imageData = $imageDataUrl;
    if (strpos($imageDataUrl, 'base64,') !== false) {
        preg_match('/^data:(image\/\w+);base64,/', $imageDataUrl, $mimeMatch);
        if ($mimeMatch) $mime = $mimeMatch[1];
        $imageData = substr($imageDataUrl, strpos($imageDataUrl, 'base64,') + 7);
    }

    // Save image file
    $ext = str_replace('image/', '', $mime);
    $filename = uniqid('ai_') . '.' . $ext;
    $filepath = AI_UPLOAD_DIR . $filename;
    file_put_contents($filepath, base64_decode($imageData));
    $relativePath = 'uploads/ai/' . $filename;

    // Call Gemini API
    $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=" . GEMINI_API_KEY;

    $requestBody = [
        'contents' => [[
            'parts' => [
                ['text' => 'Bạn là AI nhận diện vật thể và từ điển tiếng Trung. Hãy xem ảnh này và xác định các vật thể/vật phẩm/đối tượng chính có trong ảnh. Với mỗi vật thể, hãy cung cấp:
- name: tên vật thể bằng tiếng Việt
- chinese: chữ Hán tương ứng (có thể là 1 từ hoặc 1 cụm từ)
- pinyin: phiên âm pinyin
- meaning: nghĩa tiếng Việt của chữ Hán đó
- stroke_count: số nét chữ của chữ Hán
- radical: bộ thủ của chữ Hán (ví dụ: 木, 口, 水)
- example: câu ví dụ bằng tiếng Trung có chứa từ này
- example_vi: nghĩa tiếng Việt của câu ví dụ

Trả về KẾT QUẢ dưới dạng JSON, CHỈ JSON, không markdown, không code block, không giải thích:
{"objects":[{"name":"tên vật thể","chinese":"chữ Hán","pinyin":"pinyin","meaning":"nghĩa tiếng Việt","stroke_count":12,"radical":"bộ thủ","example":"câu ví dụ bằng tiếng Trung","example_vi":"nghĩa tiếng Việt của câu ví dụ","confidence":95}]}

Nếu không tìm thấy vật thể nào, trả về {"objects":[]}.'],
                ['inline_data' => ['mimeType' => $mime, 'data' => $imageData]]
            ]
        ]]
    ];

    $ch = curl_init($apiUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($requestBody),
        CURLOPT_TIMEOUT => 30
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        echo json_encode(['success' => false, 'message' => 'Lỗi kết nối Gemini: ' . $curlError]);
        exit;
    }
    if ($httpCode !== 200) {
        echo json_encode(['success' => false, 'message' => 'Gemini API lỗi (HTTP ' . $httpCode . ')']);
        exit;
    }

    $geminiResult = json_decode($response, true);
    $text = $geminiResult['candidates'][0]['content']['parts'][0]['text'] ?? '';

    // Parse JSON from response - try multiple formats
    $objects = [];
    // Try direct JSON parse first
    $parsed = json_decode($text, true);
    if ($parsed && isset($parsed['objects'])) {
        $objects = $parsed['objects'];
    } else {
        // Try extracting JSON from markdown code block
        preg_match('/```(?:json)?\s*(\{.*"objects".*\})\s*```/s', $text, $matches);
        if (!$matches) {
            preg_match('/\{.*"objects".*\}/s', $text, $matches);
        }
        if ($matches) {
            $parsed = json_decode($matches[1] ?? $matches[0], true);
            if ($parsed && isset($parsed['objects'])) {
                $objects = $parsed['objects'];
            }
        }
    }

    // Look up each object in vocab table for Chinese translation
    $results = [];
    foreach ($objects as $item) {
        $name = trim($item['name'] ?? '');
        if (!$name) continue;
        $confidence = floatval($item['confidence'] ?? 0);

        $results[] = [
            'object' => $name,
            'char' => trim($item['chinese'] ?? ''),
            'pinyin' => trim($item['pinyin'] ?? ''),
            'meaning' => trim($item['meaning'] ?? ''),
            'strokes' => intval($item['stroke_count'] ?? 0),
            'radical' => trim($item['radical'] ?? ''),
            'example' => trim($item['example'] ?? ''),
            'example_vi' => trim($item['example_vi'] ?? ''),
            'confidence' => $confidence
        ];
    }

    // Save to history
    $detectedJson = json_encode(['objects' => $objects, 'results' => $results]);
    if ($numericUserId > 0) {
        $stmt = $conn->prepare("INSERT INTO ai_image_history (user_id, image_path, detected_text) VALUES (?, ?, ?)");
        $stmt->execute([$numericUserId, $relativePath, $detectedJson]);
        $historyId = $conn->lastInsertId();
    } else {
        $historyId = 0;
    }

    echo json_encode([
        'success' => true,
        'data' => [
            'results' => $results,
            'history_id' => intval($historyId)
        ]
    ]);
    exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Lỗi xử lý: ' . $e->getMessage()]);
        exit;
    }
}

// Get AI recognition history
if ($action === 'get_ai_history') {
    $userId = $_GET['user_id'] ?? 0;
    $numericUserId = is_numeric($userId) ? intval($userId) : (strpos($userId, 'user_') === 0 ? intval(substr($userId, 5)) : 0);

    $stmt = $conn->prepare("SELECT * FROM ai_image_history WHERE user_id = ? ORDER BY created_at DESC LIMIT 50");
    $stmt->execute([$numericUserId]);
    $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($history as &$h) {
        $h['id'] = intval($h['id']);
    }

    echo json_encode(['success' => true, 'data' => $history]);
    exit;
}

// Delete AI history item
if ($action === 'delete_ai_history') {
    $id = intval($_GET['id'] ?? 0);
    $userId = $_GET['user_id'] ?? 0;
    $numericUserId = is_numeric($userId) ? intval($userId) : (strpos($userId, 'user_') === 0 ? intval(substr($userId, 5)) : 0);

    if (!$id) {
        echo json_encode(['success' => false, 'message' => 'Thiếu ID']);
        exit;
    }

    // Get image path to delete file
    $stmt = $conn->prepare("SELECT image_path FROM ai_image_history WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, $numericUserId]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $filePath = __DIR__ . '/' . $item['image_path'];
        if (file_exists($filePath)) unlink($filePath);
        $stmt = $conn->prepare("DELETE FROM ai_image_history WHERE id = ? AND user_id = ?");
        $stmt->execute([$id, $numericUserId]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy']);
    }
    exit;
}

// Voice chat - Chinese teacher evaluation
if ($action === 'voice_chat') {
    $data = json_decode(file_get_contents('php://input'), true);
    $audioBase64 = $data['audio'] ?? '';
    if (!$audioBase64) { echo json_encode(['reply' => 'Không có dữ liệu âm thanh']); exit; }
    $mime = $data['mime'] ?? 'audio/webm';

    $systemPrompt = 'Bạn là giáo viên tiếng Trung giàu kinh nghiệm. Học viên nói tiếng Trung với bạn qua ghi âm. Hãy nghe và:
1. Nhận xét phát âm, ngữ pháp, từ vựng (bằng tiếng Việt)
2. Sửa lỗi nếu có, đưa ra phiên âm pinyin và nghĩa tiếng Việt
3. Gợi ý câu trả lời mẫu hoặc từ vựng mới
4. Kết thúc bằng một câu hỏi tiếp theo để luyện tập

Luôn trả lời đúng format sau, dùng dấu 【】cho các tiêu đề:
【Đánh Giá】<nhận xét bằng tiếng Việt>
【Sửa Lỗi】<nếu có lỗi - đưa chữ Hán, pinyin, nghĩa>
【Gợi Ý】<từ vựng hoặc câu mẫu mới>
【Luyện Tập】<câu hỏi tiếng Trung để học viên trả lời>';

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . GEMINI_API_KEY;
    $payload = [
        'contents' => [[
            'parts' => [
                ['text' => $systemPrompt],
                ['inline_data' => ['mime_type' => $mime, 'data' => $audioBase64]]
            ]
        ]]
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_TIMEOUT => 60
    ]);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (!$resp || $httpCode !== 200) { echo json_encode(['reply' => 'Lỗi kết nối Gemini']); exit; }
    $json = json_decode($resp, true);
    $reply = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa thể đánh giá được.';
    echo json_encode(['reply' => $reply]);
    exit;
}

// Chatbot endpoint with RAG
if ($action === 'chatbot') {
    $data = json_decode(file_get_contents('php://input'), true);
    $prompt = trim($data['prompt'] ?? '');
    if (!$prompt) { echo json_encode(['reply' => '']); exit; }

    // RAG: Tìm kiếm dữ liệu từ database
    $context = '';
    $keyword = mb_substr($prompt, 0, 100);

    // Trích xuất chữ Hán từ câu hỏi
    preg_match_all('/[\x{4e00}-\x{9fff}]/u', $prompt, $hanziMatches);
    $hanziChars = array_unique($hanziMatches[0] ?? []);

    // 1. Tìm từ vựng
    $vocabParams = [];
    $vocabWhere = [];
    $keywordLike = '%' . $keyword . '%';
    $vocabWhere[] = "hanzi LIKE ? OR pinyin LIKE ? OR meaning LIKE ?";
    $vocabParams = [$keywordLike, $keywordLike, $keywordLike];

    foreach ($hanziChars as $char) {
        $vocabWhere[] = "hanzi LIKE ?";
        $vocabParams[] = '%' . $char . '%';
    }

    $stmt = $conn->prepare("SELECT hanzi, pinyin, meaning, example, example_vi FROM vocab WHERE " . implode(' OR ', $vocabWhere) . " LIMIT 5");
    $stmt->execute($vocabParams);
    $rows = $stmt->fetchAll();
    if (count($rows) > 0) {
        $context .= "[Từ vựng HànNgữ]\n";
        foreach ($rows as $r) {
            $context .= "- {$r['hanzi']} ({$r['pinyin']}): {$r['meaning']}";
            if ($r['example']) $context .= " | Ví dụ: {$r['example']} ({$r['example_vi']})";
            $context .= "\n";
        }
    }

    // 2. Tìm bài học
    $stmt = $conn->prepare("SELECT title, description, grammar FROM lessons WHERE title LIKE ? OR description LIKE ? LIMIT 3");
    $stmt->execute([$keywordLike, $keywordLike]);
    $rows = $stmt->fetchAll();
    if (count($rows) > 0) {
        $context .= "\n[Bài học HànNgữ]\n";
        foreach ($rows as $r) {
            $context .= "- {$r['title']}: {$r['description']}";
            if ($r['grammar']) $context .= " | Ngữ pháp: {$r['grammar']}";
            $context .= "\n";
        }
    }

    // 3. Tìm bộ thủ
    $radicalParams = [];
    $radicalWhere = ["name_vietnamese LIKE ?"];
    $radicalParams[] = $keywordLike;
    foreach ($hanziChars as $char) {
        $radicalWhere[] = "`char` = ?";
        $radicalParams[] = $char;
    }
    $stmt = $conn->prepare("SELECT `char`, name_vietnamese, examples FROM radicals WHERE " . implode(' OR ', $radicalWhere) . " LIMIT 5");
    $stmt->execute($radicalParams);
    $rows = $stmt->fetchAll();
    if (count($rows) > 0) {
        $context .= "\n[Bộ thủ HànNgữ]\n";
        foreach ($rows as $r) {
            $context .= "- {$r['char']}: {$r['name_vietnamese']}";
            if ($r['examples']) $context .= " (VD: {$r['examples']})";
            $context .= "\n";
        }
    }

    // Build Gemini request
    $history = $data['history'] ?? [];
    $contents = [];
    foreach ($history as $msg) {
        $role = $msg['role'] === 'ai' ? 'model' : 'user';
        $contents[] = ['role' => $role, 'parts' => [['text' => $msg['text']]]];
    }
    $contents[] = ['role' => 'user', 'parts' => [['text' => $prompt]]];

    $systemPrompt = 'Bạn là trợ lý AI của HànNgữ - website học tiếng Trung online. Nhiệm vụ của bạn:
- Trả lời các câu hỏi về tiếng Trung: từ vựng, ngữ pháp, phát âm, chữ Hán, bộ thủ, HSK
- Giải thích bằng tiếng Việt, có kèm chữ Hán và pinyin khi cần
- Chỉ trả lời những gì liên quan đến tiếng Trung và việc học tiếng Trung
- Nếu câu hỏi ngoài chủ đề, hãy từ chối nhẹ nhàng và gợi ý quay lại chủ đề tiếng Trung
- Trả lời ngắn gọn, dễ hiểu, thân thiện
- Dựa vào dữ liệu từ website HànNgữ được cung cấp bên dưới để trả lời chính xác';

    if ($context) {
        $systemPrompt .= "\n\n[Dữ liệu từ website HànNgữ]\n" . $context;
    }

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:generateContent?key=" . GEMINI_API_KEY;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode([
            'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
            'contents' => $contents
        ]),
        CURLOPT_TIMEOUT => 30
    ]);
    $resp = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if (!$resp || $httpCode !== 200) { echo json_encode(['reply' => 'Xin lỗi, tôi đang gặp sự cố kết nối.']); exit; }
    $json = json_decode($resp, true);
    $reply = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa hiểu ý bạn.';
    echo json_encode(['reply' => $reply]);
    exit;
}

echo json_encode(['error' => 'Invalid action']);