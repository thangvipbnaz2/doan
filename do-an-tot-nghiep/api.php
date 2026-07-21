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
    require 'commerce.php';
} catch (Exception $e) {
    echo json_encode(['error' => 'Lỗi hệ thống: ' . $e->getMessage()]);
    exit;
}

$action = $_GET['action'] ?? '';

// CSRF helpers (dùng chung với auth.php)
function getCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function validateCsrfToken($token)
{
    if (empty($_SESSION['csrf_token']) || empty($token))
        return false;
    return hash_equals($_SESSION['csrf_token'], $token);
}
function requireCsrf()
{
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
            $stmt = $conn->prepare("SELECT v.*, p.write_completed, p.speech_completed
                                    FROM vocab v
                                    LEFT JOIN progress p ON v.id = p.vocab_id AND p.user_id = ?
                                    WHERE v.level = ?
                                    ORDER BY v.id");
            $stmt->execute([$userId, $level]);
        } else {
            $stmt = $conn->prepare("SELECT v.*, p.write_completed, p.speech_completed
                                    FROM vocab v
                                    LEFT JOIN progress p ON v.id = p.vocab_id AND p.user_id = ?
                                    ORDER BY v.level, v.id");
            $stmt->execute([$userId]);
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
    $data = json_decode(file_get_contents('php://input'), true);

    $title = htmlspecialchars(trim($data['title'] ?? ''), ENT_QUOTES, 'UTF-8');
    $content = htmlspecialchars(trim($data['content'] ?? ''), ENT_QUOTES, 'UTF-8');
    $author = htmlspecialchars(trim($data['author'] ?? 'Ẩn danh'), ENT_QUOTES, 'UTF-8');
    $tags = array_map(function ($t) {
        return htmlspecialchars(trim($t), ENT_QUOTES, 'UTF-8');
    }, $data['tags'] ?? []);

    if (!$title || !$content) {
        echo json_encode(['success' => false, 'message' => 'Tiêu đề và nội dung không được để trống']);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO posts (title, content, author, tags, status) VALUES (?, ?, ?, ?, 'pending')");
    $result = $stmt->execute([
        $title,
        $content,
        $author,
        implode(',', $tags)
    ]);

    echo json_encode(['success' => $result]);
    exit;
}

// API like bài viết (toggle)
if ($action === 'like_post') {
    $id = intval($_GET['id'] ?? 0);
    $userId = $_GET['user_id'] ?? $_SESSION['user_id'] ?? '';
    if (!$id || !$userId) {
        echo json_encode(['success' => false]);
        exit;
    }
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
        $vocabStmt2->bindValue(2, (int) $lesson['vocab_count'], PDO::PARAM_INT);
        $vocabStmt2->bindValue(3, (int) $offset, PDO::PARAM_INT);
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
    echo json_encode($stmt->fetchAll());
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
            foreach ($decoded as $c) {
                if (empty($c['strokes']) || empty($c['radical'])) {
                    $needsFix = true;
                    break;
                }
            }
            if ($needsFix)
                $vocabList[] = $row;
        }
    }
    $radMap = [];
    $radRows = $conn->query("SELECT `char`, strokes, name_vietnamese FROM radicals")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($radRows as $r)
        $radMap[$r['char']] = $r;

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
        if ($dbContent)
            $charDb = $dbContent;
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
    if ($sort === 'oldest')
        $order = "ORDER BY p.created_at ASC";
    elseif ($sort === 'popular')
        $order = "ORDER BY p.likes DESC, p.created_at DESC";
    else
        $order = "ORDER BY p.created_at DESC";

    try {
        $select = "p.*, " . ($userId ? "(SELECT COUNT(*) FROM post_likes pl WHERE pl.post_id = p.id AND pl.user_id = ?) as liked" : "0 as liked");
        $stmt = $conn->prepare("SELECT SQL_CALC_FOUND_ROWS $select FROM posts p WHERE $where $order LIMIT ? OFFSET ?");
        $i = 1;
        if ($userId)
            $stmt->bindValue($i++, $userId);
        foreach ($params as $p) {
            $stmt->bindValue($i++, $p);
        }
        $stmt->bindValue($i++, (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue($i++, (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        $total = $conn->query("SELECT FOUND_ROWS()")->fetchColumn();
        echo json_encode(['data' => $stmt->fetchAll(), 'total' => (int) $total, 'page' => $page, 'pages' => max(1, ceil($total / $limit))]);
    } catch (Exception $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    exit;
}

// API lấy bình luận
if ($action === 'get_comments') {
    $postId = intval($_GET['post_id'] ?? 0);
    if (!$postId) {
        echo json_encode([]);
        exit;
    }
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

    if (!$postId || !$content) {
        echo json_encode(['success' => false, 'message' => 'Thiếu thông tin']);
        exit;
    }
    $content = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
    $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, author, content, parent_id) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute([$postId, $userId, $author, $content, $parentId ?: null]);
    echo json_encode(['success' => $result, 'id' => $conn->lastInsertId()]);
    exit;
}

// API yêu cầu reset mật khẩu (tạo token)
if ($action === 'forgot_password') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = trim($data['email'] ?? '');
    if (!$email) {
        echo json_encode(['success' => false, 'message' => 'Nhập email']);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, username FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Email không tồn tại']);
        exit;
    }

    $token = bin2hex(random_bytes(32));
    $stmt2 = $conn->prepare("INSERT INTO password_resets (email, token) VALUES (?, ?)");
    $stmt2->execute([$email, $token]);

    $siteUrl = SITE_URL;
    $resetLink = $siteUrl . '/reset_password.php?token=' . $token;
    $fromName = defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : 'HànNgữ';
    $fromEmail = defined('SMTP_FROM') ? SMTP_FROM : 'noreply@hanngu.local';

    $mailSent = false;

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
            $mail->isHTML(false);
            $mail->Subject = 'Đặt lại mật khẩu - ' . $fromName;
            $mail->Body = "Xin chào {$user['username']},\n\n"
                . "Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng click vào link dưới đây:\n\n"
                . "$resetLink\n\n"
                . "Link có hiệu lực trong 1 giờ.\n\n"
                . "Nếu bạn không yêu cầu, hãy bỏ qua email này.\n\n"
                . "-- $fromName";
            $mail->send();
            $mailSent = true;
        } catch (Exception $e) {
            $mailSent = false;
        }
    }

    // Fallback: dùng mail() nếu PHPMailer không gửi được
    if (!$mailSent) {
        $subject = 'Đặt lại mật khẩu - HànNgữ';
        $message = "Xin chào {$user['username']},\n\n"
            . "Bạn đã yêu cầu đặt lại mật khẩu. Vui lòng click vào link dưới đây:\n\n"
            . "$resetLink\n\n"
            . "Link có hiệu lực trong 1 giờ.\n\n-- HànNgữ";
        $headers = "From: $fromEmail\r\nReply-To: $fromEmail\r\nX-Mailer: PHP/" . phpversion();
        $mailSent = @mail($email, $subject, $message, $headers);
    }

    echo json_encode([
        'success' => true,
        'message' => $mailSent
            ? 'Email đặt lại mật khẩu đã được gửi đến ' . $email
            : 'Không thể gửi email, vui lòng thử lại sau.'
    ]);
    exit;
}

// API reset mật khẩu
if ($action === 'reset_password') {
    $data = json_decode(file_get_contents('php://input'), true);
    $token = trim($data['token'] ?? '');
    $password = $data['password'] ?? '';

    if (!$token || strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Token hoặc mật khẩu không hợp lệ']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM password_resets WHERE token = ? AND created_at > NOW() - INTERVAL 1 HOUR");
    $stmt->execute([$token]);
    $reset = $stmt->fetch();
    if (!$reset) {
        echo json_encode(['success' => false, 'message' => 'Token không hợp lệ hoặc đã hết hạn']);
        exit;
    }

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
    session_start();
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }

    if (!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => 'Lỗi upload']);
        exit;
    }

    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($_FILES['avatar']['type'], $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Chỉ chấp nhận ảnh (JPEG, PNG, GIF, WebP)']);
        exit;
    }

    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = 'avatar_' . $_SESSION['user_id'] . '_' . time() . '.' . $ext;
    $dest = __DIR__ . '/uploads/' . $filename;
    if (!is_dir(__DIR__ . '/uploads'))
        mkdir(__DIR__ . '/uploads', 0755, true);

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
        if ($check->fetch()) {
            $streak++;
            $d->modify('-1 day');
        } else
            break;
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
        if ($check->fetch()) {
            $streak++;
            $d->modify('-1 day');
        } else
            break;
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
        if ($v['example'])
            $text .= "  VD: {$v['example']}\n";
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

    $upd = $conn->prepare("UPDATE pvp_rooms SET player2_id = ?, player2_name = ?, status = 'playing' WHERE id = ?");
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
        if ($p1pct > $p2pct)
            $winner = $updated['player1_name'];
        elseif ($p2pct > $p1pct)
            $winner = $updated['player2_name'];
        else
            $winner = 'Hòa';

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

// ===== LEADERBOARD =====
if ($action === 'get_leaderboard') {
    $limit = min(50, max(1, intval($_GET['limit'] ?? 20)));

    $stmt = $conn->query("
        SELECT
            u.id,
            u.display_name,
            u.username,
            (SELECT COUNT(*) FROM progress WHERE user_id = CONCAT('user_', u.id) AND (write_completed=1 OR speech_completed=1)) as vocab_learned,
            (SELECT COUNT(*) FROM quiz_results WHERE user_id = CONCAT('user_', u.id)) as quiz_count,
            COALESCE((SELECT AVG(score * 100.0 / total_questions) FROM quiz_results WHERE user_id = CONCAT('user_', u.id) AND total_questions > 0), 0) as quiz_avg,
            (SELECT COALESCE(SUM(score), 0) FROM quiz_results WHERE user_id = CONCAT('user_', u.id)) as total_score,
            (SELECT COUNT(*) FROM daily_streak WHERE user_id = CONCAT('user_', u.id) AND streak_date >= CURDATE() - INTERVAL 7 DAY) as streak
        FROM users u
        HAVING vocab_learned > 0 OR quiz_count > 0
        ORDER BY total_score DESC, vocab_learned DESC
        LIMIT $limit
    ");
    $results = $stmt->fetchAll();

    // Calculate ranks
    $rank = 0;
    $prevScore = null;
    foreach ($results as &$row) {
        if ($row['total_score'] !== $prevScore)
            $rank++;
        $row['rank'] = $rank;
        $row['display_name'] = $row['display_name'] ?: $row['username'];
        $row['quiz_avg'] = number_format($row['quiz_avg'], 1) . '%';
        $row['total_score'] = (int) $row['total_score'];
        $row['vocab_learned'] = (int) $row['vocab_learned'];
        $row['streak'] = (int) $row['streak'];
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
    $limit = min(50, max(1, intval($_GET['limit'] ?? 20)));

    $sql = "SELECT v.*, s.ease_factor, s.interval_days, s.consecutive_correct, s.next_review
            FROM vocab v
            LEFT JOIN srs s ON s.vocab_id = v.id AND s.user_id = ?
            WHERE (s.next_review IS NULL OR s.next_review <= CURDATE())";
    $params = [$userId];

    if ($level > 0 && $level <= 6) {
        $sql .= " AND v.level = ?";
        $params[] = $level;
    }

    $sql .= " ORDER BY COALESCE(s.next_review, '1900-01-01') ASC, v.level, v.id LIMIT " . intval($limit);
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $cards = $stmt->fetchAll();

    // Attach existing progress
    $vocabIds = array_column($cards, 'id');
    if (!empty($vocabIds)) {
        $placeholders = implode(',', array_fill(0, count($vocabIds), '?'));
        $pStmt = $conn->prepare("SELECT vocab_id, write_completed, speech_completed FROM progress WHERE user_id = ? AND vocab_id IN ($placeholders)");
        $pStmt->execute(array_merge([$userId], $vocabIds));
        $progressMap = [];
        foreach ($pStmt->fetchAll() as $p) {
            $progressMap[$p['vocab_id']] = $p;
        }
        foreach ($cards as &$card) {
            $pid = $card['id'];
            $card['write_completed'] = isset($progressMap[$pid]) ? $progressMap[$pid]['write_completed'] : 0;
            $card['speech_completed'] = isset($progressMap[$pid]) ? $progressMap[$pid]['speech_completed'] : 0;
        }
    }

    echo json_encode(['data' => $cards]);
    exit;
}

if ($action === 'submit_review') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userId = $input['user_id'] ?? 'default_user';
    $vocabId = intval($input['vocab_id'] ?? 0);
    $known = intval($input['known'] ?? 0);

    if (!$vocabId) {
        echo json_encode(['success' => false, 'message' => 'Thiếu vocab_id']);
        exit;
    }

    // Get current SRS entry
    $stmt = $conn->prepare("SELECT * FROM srs WHERE user_id = ? AND vocab_id = ?");
    $stmt->execute([$userId, $vocabId]);
    $srs = $stmt->fetch();

    if ($known) {
        $newConsecutive = ($srs ? $srs['consecutive_correct'] : 0) + 1;
        $easeFactor = $srs ? min(3.0, $srs['ease_factor'] + 0.1) : 2.5;
        $interval = $srs ? round($srs['interval_days'] * $easeFactor) : 1;
        if ($newConsecutive <= 1)
            $interval = 1;
        else if ($newConsecutive === 2)
            $interval = 3;
        else
            $interval = max(1, round($interval));
    } else {
        $newConsecutive = 0;
        $easeFactor = $srs ? max(1.3, $srs['ease_factor'] - 0.2) : 2.5;
        $interval = 1;
    }

    $nextReview = (new DateTime())->modify("+{$interval} days")->format('Y-m-d');

    if ($srs) {
        $stmt = $conn->prepare("UPDATE srs SET ease_factor=?, interval_days=?, consecutive_correct=?, next_review=?, last_reviewed=NOW() WHERE user_id=? AND vocab_id=?");
        $stmt->execute([$easeFactor, $interval, $newConsecutive, $nextReview, $userId, $vocabId]);
    } else {
        $stmt = $conn->prepare("INSERT INTO srs (user_id, vocab_id, ease_factor, interval_days, consecutive_correct, next_review) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $vocabId, $easeFactor, $interval, $newConsecutive, $nextReview]);
    }

    // Also log to study_logs
    $stmt = $conn->prepare("INSERT INTO study_logs (user_id, vocab_id, action, score) VALUES (?, ?, 'review', ?)");
    $stmt->execute([$userId, $vocabId, $known ? 1 : 0]);

    echo json_encode(['success' => true, 'interval' => $interval, 'next_review' => $nextReview]);
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

    $total = $conn->prepare("SELECT COUNT(DISTINCT reference_id) as count FROM study_logs WHERE user_id = ? AND reference_id IS NOT NULL AND activity_type = 'vocab'");
    $total->execute([$userId]);
    $totalStudied = $total->fetch()['count'];

    $daily = $conn->prepare("
        SELECT DATE(created_at) as date, 
               COUNT(*) as total,
               SUM(CASE WHEN activity_type IN ('vocab','flashcard') AND score >= 1 THEN 1 ELSE 0 END) as reviewed,
               SUM(CASE WHEN activity_type = 'writing' THEN 1 ELSE 0 END) as written,
               SUM(CASE WHEN activity_type = 'lesson' THEN 1 ELSE 0 END) as viewed
        FROM study_logs 
        WHERE user_id = ? AND created_at >= DATE_SUB(NOW(), INTERVAL ? DAY)
        GROUP BY DATE(created_at)
        ORDER BY date
    ");
    $daily->execute([$userId, $days]);
    $dailyData = $daily->fetchAll();

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

    $reviews = $conn->prepare("SELECT COUNT(*) as count FROM study_logs WHERE user_id = ? AND activity_type IN ('vocab','flashcard')");
    $reviews->execute([$userId]);

    $byLevel = $conn->prepare("
        SELECT v.level, COUNT(DISTINCT s.reference_id) as count 
        FROM study_logs s 
        JOIN vocab v ON v.id = s.reference_id 
        WHERE s.user_id = ? AND s.reference_id IS NOT NULL AND s.activity_type = 'vocab'
        GROUP BY v.level ORDER BY v.level
    ");
    $byLevel->execute([$userId]);

    $recent = $conn->prepare("
        SELECT s.activity_type as action, s.score, s.created_at, v.hanzi, v.pinyin, v.meaning
        FROM study_logs s 
        LEFT JOIN vocab v ON v.id = s.reference_id 
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
    $img = @imagecreatefromstring(base64_decode($imageData));

    if (!$img) {
        echo json_encode(['success' => false, 'message' => 'Không thể đọc ảnh']);
        exit;
    }

    $w = imagesx($img);
    $h = imagesy($img);

    // Divide canvas into 4x4 grid, count dark pixels in each cell
    $gridSize = 4;
    $cellW = $w / $gridSize;
    $cellH = $h / $gridSize;
    $darkThreshold = 100;
    $coverage = [];

    for ($gy = 0; $gy < $gridSize; $gy++) {
        for ($gx = 0; $gx < $gridSize; $gx++) {
            $darkPixels = 0;
            $totalPixels = 0;
            $startX = floor($gx * $cellW);
            $startY = floor($gy * $cellH);
            $endX = floor(($gx + 1) * $cellW);
            $endY = floor(($gy + 1) * $cellH);

            for ($y = $startY; $y < $endY; $y++) {
                for ($x = $startX; $x < $endX; $x++) {
                    $rgb = imagecolorat($img, $x, $y);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $brightness = ($r + $g + $b) / 3;
                    if ($brightness < $darkThreshold)
                        $darkPixels++;
                    $totalPixels++;
                }
            }
            $coverage[] = $totalPixels > 0 ? round($darkPixels / $totalPixels * 100, 1) : 0;
        }
    }

    imagedestroy($img);

    // Calculate score based on coverage (15-50% per cell is ideal for a single character)
    $totalScore = 0;
    $cellCount = count($coverage);
    foreach ($coverage as $pct) {
        if ($pct >= 15 && $pct <= 50)
            $totalScore += 100;
        else if ($pct >= 5 && $pct < 15)
            $totalScore += 60;
        else if ($pct > 50 && $pct <= 70)
            $totalScore += 50;
        else
            $totalScore += 10;
    }
    $score = round($totalScore / $cellCount);

    // Log the evaluation
    $userId = $input['user_id'] ?? 'default_user';
    $stmt = $conn->prepare("INSERT INTO study_logs (user_id, action, score) VALUES (?, 'handwriting', ?)");
    $stmt->execute([$userId, $score]);

    echo json_encode([
        'success' => true,
        'score' => $score,
        'coverage' => $coverage,
        'feedback' => $score >= 80 ? 'Tuyệt vời! Nét chữ rất đẹp 🎉' :
            ($score >= 60 ? 'Khá tốt! Cần luyện thêm một chút 💪' :
                ($score >= 40 ? 'Được rồi, cố gắng thêm nhé! ✍️' : 'Hãy viết đậm và rõ nét hơn! 📝'))
    ]);
    exit;
}

// ===== ADMIN ENDPOINTS =====

// Admin session check helper
function requireAdmin()
{
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    global $conn;
    $stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    if (!$user || $user['role'] !== 'admin') {
        echo json_encode(['success' => false, 'message' => 'Không phải admin']);
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
    if (!$hanzi) {
        echo json_encode(['success' => false, 'message' => 'Thiếu hanzi']);
        exit;
    }
    if ($id) {
        $stmt = $conn->prepare("UPDATE vocab SET hanzi=?, pinyin=?, meaning=?, level=?, strokes=?, radical=?, example=?, lesson_id=? WHERE id=?");
        $result = $stmt->execute([
            $hanzi,
            $data['pinyin'] ?? '',
            $data['meaning'] ?? '',
            intval($data['level'] ?? 1),
            intval($data['strokes'] ?? 0),
            $data['radical'] ?? '',
            $data['example'] ?? '',
            $data['lesson_id'] ?: null,
            $id
        ]);
    } else {
        $stmt = $conn->prepare("INSERT INTO vocab (hanzi, pinyin, meaning, level, strokes, radical, example, lesson_id) VALUES (?,?,?,?,?,?,?,?)");
        $result = $stmt->execute([
            $hanzi,
            $data['pinyin'] ?? '',
            $data['meaning'] ?? '',
            intval($data['level'] ?? 1),
            intval($data['strokes'] ?? 0),
            $data['radical'] ?? '',
            $data['example'] ?? '',
            $data['lesson_id'] ?: null
        ]);
    }
    echo json_encode(['success' => $result]);
    exit;
}

if ($action === 'delete_vocab') {
    requireAdmin();
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM vocab WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$id])]);
    exit;
}

if ($action === 'get_all_lessons') {
    requireAdmin();
    $level = intval($_GET['level'] ?? 0);
    $sql = "SELECT * FROM lessons";
    if ($level > 0)
        $sql .= " WHERE level = ?";
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
    if (!$title) {
        echo json_encode(['success' => false, 'message' => 'Thiếu tiêu đề']);
        exit;
    }
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
    requireAdmin();
    $id = intval($_GET['id'] ?? 0);
    $stmt = $conn->prepare("DELETE FROM lessons WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$id])]);
    exit;
}

if ($action === 'get_users') {
    requireAdmin();
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
    requireAdmin();
    $data = json_decode(file_get_contents('php://input'), true);
    $userId = intval($data['id'] ?? 0);
    $role = $data['role'] ?? 'user';
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$role, $userId])]);
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
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    $check = $conn->prepare("SELECT p.*, u.username, u.role FROM posts p LEFT JOIN users u ON u.username = p.author WHERE p.id = ?");
    $check->execute([$id]);
    $post = $check->fetch();
    if (!$post) {
        echo json_encode(['success' => false, 'message' => 'Bài viết không tồn tại']);
        exit;
    }
    $isOwner = isset($_SESSION['username']) && $post['author'] === $_SESSION['username'];
    $isAdmin = ($post['role'] ?? '') === 'admin';
    // Also check current user's admin status
    $userCheck = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $userCheck->execute([$_SESSION['user_id']]);
    $currentUser = $userCheck->fetch();
    $currentIsAdmin = $currentUser && $currentUser['role'] === 'admin';

    if (!$isOwner && !$currentIsAdmin) {
        echo json_encode(['success' => false, 'message' => 'Bạn không có quyền xóa bài này']);
        exit;
    }
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
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    $stmt = $conn->prepare("SELECT c.*, u.role FROM comments c LEFT JOIN users u ON u.username = c.author WHERE c.id = ?");
    $stmt->execute([$id]);
    $comment = $stmt->fetch();
    if (!$comment) {
        echo json_encode(['success' => false, 'message' => 'Bình luận không tồn tại']);
        exit;
    }
    $userCheck = $conn->prepare("SELECT role FROM users WHERE id = ?");
    $userCheck->execute([$_SESSION['user_id']]);
    $currentUser = $userCheck->fetch();
    $currentIsAdmin = $currentUser && $currentUser['role'] === 'admin';
    $currentName = $_SESSION['username'] ?? '';
    $isOwner = $comment['author'] === $currentName || $comment['user_id'] === $_SESSION['user_id'];
    if (!$isOwner && !$currentIsAdmin) {
        echo json_encode(['success' => false, 'message' => 'Bạn không có quyền xóa bình luận này']);
        exit;
    }
    $del = $conn->prepare("DELETE FROM comments WHERE id = ?");
    echo json_encode(['success' => $del->execute([$id])]);
    exit;
}

if ($action === 'update_post_status') {
    requireAdmin();
    $data = json_decode(file_get_contents('php://input'), true);
    $id = intval($data['id'] ?? 0);
    $status = $data['status'] ?? 'approved';
    $stmt = $conn->prepare("UPDATE posts SET status = ? WHERE id = ?");
    echo json_encode(['success' => $stmt->execute([$status, $id])]);
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
        'vocab' => (int) $vocab,
        'lessons' => (int) $lessons,
        'users' => (int) $users,
        'posts' => (int) $posts,
        'comments' => (int) $comments,
        'pending' => (int) $pending,
        'todayUsers' => (int) $todayUsers
    ]);
    exit;
}

// ===== PAID COURSES, QR PAYMENT & INVOICES =====
function commerceCsrfOrFail(array $data): void
{
    if (!validateCsrfToken($data['csrf_token'] ?? ''))
        throw new RuntimeException('Token bảo mật không hợp lệ.');
}

if ($action === 'get_courses') {
    $includeDraft = !empty($_SESSION['user_id']) && (function () use ($conn) {
        $s = $conn->prepare('SELECT role FROM users WHERE id=?');
        $s->execute([$_SESSION['user_id']]);
        return $s->fetchColumn() === 'admin'; })();
    $sql = 'SELECT c.*, (SELECT COUNT(*) FROM course_lessons cl WHERE cl.course_id=c.id) lesson_count FROM courses c';
    if (!$includeDraft)
        $sql .= ' WHERE c.is_published=1';
    $sql .= ' ORDER BY c.created_at DESC';
    echo json_encode(['success' => true, 'courses' => $conn->query($sql)->fetchAll()]);
    exit;
}

if ($action === 'get_course') {
    $slug = trim($_GET['slug'] ?? '');
    $stmt = $conn->prepare('SELECT c.*, (SELECT COUNT(*) FROM course_lessons cl WHERE cl.course_id=c.id) lesson_count FROM courses c WHERE c.slug=?');
    $stmt->execute([$slug]);
    $course = $stmt->fetch();
    if (!$course) {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy khóa học.']);
        exit;
    }
    $stmt = $conn->prepare('SELECT l.id,l.title,l.level,l.lesson_num,l.description,l.vocab_count,l.grammar,l.type FROM course_lessons cl JOIN lessons l ON l.id=cl.lesson_id WHERE cl.course_id=? ORDER BY cl.sort_order,l.lesson_num');
    $stmt->execute([$course['id']]);
    $course['lessons'] = $stmt->fetchAll();
    $course['enrolled'] = false;
    if (!empty($_SESSION['user_id'])) {
        $s = $conn->prepare('SELECT id FROM enrollments WHERE user_id=? AND course_id=?');
        $s->execute([$_SESSION['user_id'], $course['id']]);
        $course['enrolled'] = (bool) $s->fetchColumn();
    }
    echo json_encode(['success' => true, 'course' => $course]);
    exit;
}

if ($action === 'create_order') {
    try {
        $data = commerceInput();
        commerceCsrfOrFail($data);
        $userId = commerceRequireLogin();
        $courseId = (int) ($data['course_id'] ?? 0);
        $stmt = $conn->prepare('SELECT * FROM courses WHERE id=? AND is_published=1');
        $stmt->execute([$courseId]);
        $course = $stmt->fetch();
        if (!$course)
            throw new RuntimeException('Khóa học không khả dụng.');
        $owned = $conn->prepare('SELECT id FROM enrollments WHERE user_id=? AND course_id=?');
        $owned->execute([$userId, $courseId]);
        if ($owned->fetchColumn())
            throw new RuntimeException('Bạn đã sở hữu khóa học này.');
        // Never reuse an old pending order when an administrator has changed
        // the course price. Its VietQR image would otherwise contain the old amount.
        $old = $conn->prepare("SELECT id FROM orders WHERE user_id=? AND course_id=? AND amount=? AND status='pending' AND expires_at > NOW() ORDER BY id DESC LIMIT 1");
        $old->execute([$userId, $courseId, $course['price']]);
        $orderId = $old->fetchColumn();
        if (!$orderId) {
            $code = commerceOrderCode();
            $new = $conn->prepare("INSERT INTO orders (order_code,user_id,course_id,amount,status,expires_at) VALUES (?,?,?,?, 'pending', DATE_ADD(NOW(), INTERVAL 30 MINUTE))");
            $new->execute([$code, $userId, $courseId, $course['price']]);
            $orderId = (int) $conn->lastInsertId();
        }
        $order = commerceOrderDetails($conn, (int) $orderId);
        // Free courses are enrolled immediately; no bank transfer or QR code is needed.
        if ((float) $course['price'] <= 0 && $order['status'] === 'pending') {
            $order = commerceCompletePayment(
                $conn,
                (int) $orderId,
                'FREE-' . $order['order_code'],
                'free_course',
                json_encode(['source' => 'free_course'], JSON_UNESCAPED_UNICODE),
                null
            );
        }
        $order['qr_url'] = commerceQrUrl($order['order_code'], (float) $order['amount']);
        echo json_encode(['success' => true, 'order' => $order]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'get_order') {
    try {
        $userId = commerceRequireLogin();
        $order = commerceOrderDetails($conn, (int) ($_GET['id'] ?? 0));
        if ($order['user_id'] != $userId)
            commerceRequireAdmin($conn);
        $order['qr_url'] = $order['status'] === 'pending' ? commerceQrUrl($order['order_code'], (float) $order['amount']) : '';
        echo json_encode(['success' => true, 'order' => $order]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'get_my_orders') {
    try {
        $userId = commerceRequireLogin();
        $s = $conn->prepare('SELECT o.*,c.title course_title,c.slug course_slug,i.invoice_number FROM orders o JOIN courses c ON c.id=o.course_id LEFT JOIN invoices i ON i.order_id=o.id WHERE o.user_id=? ORDER BY o.created_at DESC');
        $s->execute([$userId]);
        echo json_encode(['success' => true, 'orders' => $s->fetchAll()]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'admin_save_course') {
    try {
        $data = commerceInput();
        commerceCsrfOrFail($data);
        commerceRequireAdmin($conn);
        $id = (int) ($data['id'] ?? 0);
        $title = trim($data['title'] ?? '');
        $slug = strtolower(trim($data['slug'] ?? ''));
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $price = max(0, (int) ($data['price'] ?? 0));
        if (!$title || !$slug)
            throw new RuntimeException('Nhập tên và slug không dấu của khóa học.');
        if ($id) {
            $s = $conn->prepare('UPDATE courses SET title=?,slug=?,short_description=?,description=?,price=?,thumbnail=?,hsk_level=?,is_published=? WHERE id=?');
            $s->execute([$title, $slug, trim($data['short_description'] ?? ''), trim($data['description'] ?? ''), $price, trim($data['thumbnail'] ?? ''), (int) ($data['hsk_level'] ?? 0) ?: null, !empty($data['is_published']) ? 1 : 0, $id]);
        } else {
            $s = $conn->prepare('INSERT INTO courses (title,slug,short_description,description,price,thumbnail,hsk_level,is_published) VALUES (?,?,?,?,?,?,?,?)');
            $s->execute([$title, $slug, trim($data['short_description'] ?? ''), trim($data['description'] ?? ''), $price, trim($data['thumbnail'] ?? ''), (int) ($data['hsk_level'] ?? 0) ?: null, !empty($data['is_published']) ? 1 : 0]);
            $id = (int) $conn->lastInsertId();
        }
        echo json_encode(['success' => true, 'id' => $id]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'admin_set_course_lessons') {
    try {
        $data = commerceInput();
        commerceCsrfOrFail($data);
        commerceRequireAdmin($conn);
        $courseId = (int) ($data['course_id'] ?? 0);
        $lessonIds = $data['lesson_ids'] ?? [];
        if (!is_array($lessonIds))
            $lessonIds = [];
        $conn->beginTransaction();
        $conn->prepare('DELETE FROM course_lessons WHERE course_id=?')->execute([$courseId]);
        $s = $conn->prepare('INSERT INTO course_lessons (course_id,lesson_id,sort_order) VALUES (?,?,?)');
        foreach (array_values(array_unique(array_map('intval', $lessonIds))) as $i => $lessonId)
            if ($lessonId > 0)
                $s->execute([$courseId, $lessonId, $i + 1]);
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Throwable $e) {
        if ($conn->inTransaction())
            $conn->rollBack();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'admin_list_orders') {
    try {
        commerceRequireAdmin($conn);
        $status = $_GET['status'] ?? '';
        $sql = 'SELECT o.*,u.username,u.email,c.title course_title,i.invoice_number FROM orders o JOIN users u ON u.id=o.user_id JOIN courses c ON c.id=o.course_id LEFT JOIN invoices i ON i.order_id=o.id';
        $args = [];
        if (in_array($status, ['pending', 'paid', 'expired', 'cancelled', 'refunded'], true)) {
            $sql .= ' WHERE o.status=?';
            $args[] = $status;
        }
        $sql .= ' ORDER BY o.created_at DESC LIMIT 300';
        $s = $conn->prepare($sql);
        $s->execute($args);
        echo json_encode(['success' => true, 'orders' => $s->fetchAll()]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit;
}

if ($action === 'admin_confirm_payment') {
    try {
        $data = commerceInput();
        commerceCsrfOrFail($data);
        $adminId = commerceRequireAdmin($conn);
        $order = commerceCompletePayment($conn, (int) ($data['order_id'] ?? 0), trim($data['transaction_id'] ?? ''), 'admin_confirm', json_encode(['note' => trim($data['note'] ?? ''), 'by' => $adminId], JSON_UNESCAPED_UNICODE), $adminId);
        $sent = commerceSendInvoiceEmail($conn, $order);
        echo json_encode(['success' => true, 'email_sent' => $sent, 'invoice_number' => $order['invoice_number']]);
    } catch (Throwable $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
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
            if ($mimeMatch)
                $mime = $mimeMatch[1];
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
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => 'Bạn là AI nhận diện vật thể và từ điển tiếng Trung. Hãy xem ảnh này và xác định các vật thể/vật phẩm/đối tượng chính có trong ảnh. Với mỗi vật thể, hãy cung cấp:
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

Nếu không tìm thấy vật thể nào, trả về {"objects":[]}.'
                        ],
                        ['inline_data' => ['mimeType' => $mime, 'data' => $imageData]]
                    ]
                ]
            ]
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
            if (!$name)
                continue;
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
        if (file_exists($filePath))
            unlink($filePath);
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
    if (!$audioBase64) {
        echo json_encode(['reply' => 'Không có dữ liệu âm thanh']);
        exit;
    }
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
        'contents' => [
            [
                'parts' => [
                    ['text' => $systemPrompt],
                    ['inline_data' => ['mime_type' => $mime, 'data' => $audioBase64]]
                ]
            ]
        ]
    ];

    $resp = @file_get_contents($url, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($payload),
            'timeout' => 60
        ]
    ]));
    if (!$resp) {
        echo json_encode(['reply' => 'Lỗi kết nối Gemini']);
        exit;
    }
    $json = json_decode($resp, true);
    $reply = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa thể đánh giá được.';
    echo json_encode(['reply' => $reply]);
    exit;
}

// Chatbot endpoint with RAG
if ($action === 'chatbot') {
    $data = json_decode(file_get_contents('php://input'), true);
    $prompt = trim($data['prompt'] ?? '');
    if (!$prompt) {
        echo json_encode(['reply' => '']);
        exit;
    }

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
            if ($r['example'])
                $context .= " | Ví dụ: {$r['example']} ({$r['example_vi']})";
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
            if ($r['grammar'])
                $context .= " | Ngữ pháp: {$r['grammar']}";
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
            if ($r['examples'])
                $context .= " (VD: {$r['examples']})";
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
    $resp = @file_get_contents($url, false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode([
                'system_instruction' => ['parts' => [['text' => $systemPrompt]]],
                'contents' => $contents
            ]),
            'timeout' => 30
        ]
    ]));
    if (!$resp) {
        echo json_encode(['reply' => 'Xin lỗi, tôi đang gặp sự cố kết nối.']);
        exit;
    }
    $json = json_decode($resp, true);
    $reply = $json['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa hiểu ý bạn.';
    echo json_encode(['reply' => $reply]);
    exit;
}

echo json_encode(['error' => 'Invalid action']);
