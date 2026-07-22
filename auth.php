<?php
header('Content-Type: application/json; charset=utf-8');
$allowedOrigins = ['http://localhost', 'http://localhost:3000', 'http://localhost:5173'];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Credentials: true');
}
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

session_start();
require 'db.php';

$action = $_GET['action'] ?? '';

// CSRF token management
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

if ($action === 'get_csrf_token') {
    echo json_encode(['csrf_token' => getCsrfToken()]);
    exit;
}

// Rate limit helper
function isRateLimited($conn, $identifier) {
    $maxAttempts = 5;
    $windowMinutes = 10;
    $stmt = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE identifier = ? AND attempted_at > NOW() - INTERVAL ? MINUTE");
    $stmt->execute([$identifier, $windowMinutes]);
    return $stmt->fetchColumn() >= $maxAttempts;
}

function recordAttempt($conn, $identifier) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    $stmt = $conn->prepare("INSERT INTO login_attempts (identifier, ip_address) VALUES (?, ?)");
    $stmt->execute([$identifier, $ip]);
}

function clearAttempts($conn, $identifier) {
    $stmt = $conn->prepare("DELETE FROM login_attempts WHERE identifier = ?");
    $stmt->execute([$identifier]);
}

// Đăng ký
if ($action === 'register') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!validateCsrfToken($data['csrf_token'] ?? '')) {
        echo json_encode(['success' => false, 'message' => 'Token bảo mật không hợp lệ']);
        exit;
    }
    $username = trim($data['username'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $displayName = trim($data['display_name'] ?? $username);

    if (!$username || !$email || !$password) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin']);
        exit;
    }

    if (strlen($password) < 6) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu phải có ít nhất 6 ký tự']);
        exit;
    }

    // Kiểm tra username/email đã tồn tại
    $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check->execute([$username, $email]);
    if ($check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Tên đăng nhập hoặc email đã tồn tại']);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, display_name) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$username, $email, $hash, $displayName]);

    if ($result) {
        $userId = $conn->lastInsertId();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
        $_SESSION['username'] = $username;
        $_SESSION['display_name'] = $displayName;
        $_SESSION['role'] = 'user';
        echo json_encode([
            'success' => true,
            'message' => 'Đăng ký thành công!',
            'user' => ['id' => $userId, 'username' => $username, 'display_name' => $displayName, 'role' => 'user', 'avatar' => '']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Lỗi đăng ký']);
    }
    exit;
}

// Đăng nhập (có rate limit + remember me)
if ($action === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (!validateCsrfToken($data['csrf_token'] ?? '')) {
        echo json_encode(['success' => false, 'message' => 'Token bảo mật không hợp lệ']);
        exit;
    }
    $username = trim($data['username'] ?? '');
    $password = $data['password'] ?? '';
    $remember = !empty($data['remember']);

    if (!$username || !$password) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập tên đăng nhập và mật khẩu']);
        exit;
    }

    // Kiểm tra rate limit
    if (isRateLimited($conn, $username)) {
        echo json_encode(['success' => false, 'message' => 'Quá nhiều lần đăng nhập sai. Vui lòng thử lại sau 10 phút.']);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if (!$user || !password_verify($password, $user['password'])) {
        recordAttempt($conn, $username);
        echo json_encode(['success' => false, 'message' => 'Sai tên đăng nhập hoặc mật khẩu']);
        exit;
    }

    if (!empty($user['banned'])) {
        echo json_encode(['success' => false, 'message' => 'Tài khoản của bạn đã bị khoá. Vui lòng liên hệ quản trị viên để biết thêm chi tiết.']);
        exit;
    }

    // Xóa lịch sử đăng nhập sai
    clearAttempts($conn, $username);
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['display_name'] = $user['display_name'];
    $_SESSION['role'] = $user['role'] ?? 'user';

    // Remember Me: lưu cookie 1 ngày
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        $stmt = $conn->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);
        $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        setcookie('remember_token', $token, time() + 86400, '/', '', $secure, true);
        setcookie('remember_user', $user['id'], time() + 86400, '/', '', $secure, true);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Đăng nhập thành công!',
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'display_name' => $user['display_name'],
            'role' => $user['role'] ?? 'user',
            'avatar' => $user['avatar'] ?? ''
        ]
    ]);
    exit;
}

// Kiểm tra session (có check remember me)
if ($action === 'check') {
    if (isset($_SESSION['user_id'])) {
        $uStmt = $conn->prepare("SELECT avatar FROM users WHERE id = ?");
        $uStmt->execute([$_SESSION['user_id']]);
        $uRow = $uStmt->fetch();
        echo json_encode([
            'logged_in' => true,
            'user_id' => 'user_' . $_SESSION['user_id'],
            'user' => [
                'id' => $_SESSION['user_id'],
                'username' => $_SESSION['username'],
                'display_name' => $_SESSION['display_name'],
                'role' => $_SESSION['role'] ?? 'user',
                'avatar' => $uRow ? $uRow['avatar'] : ''
            ]
        ]);
        exit;
    }

    // Thử auto-login bằng remember_token
    if (isset($_COOKIE['remember_token']) && isset($_COOKIE['remember_user'])) {
        $stmt = $conn->prepare("SELECT id, username, display_name, role, avatar FROM users WHERE id = ? AND remember_token = ?");
        $stmt->execute([$_COOKIE['remember_user'], $_COOKIE['remember_token']]);
        $user = $stmt->fetch();
        if ($user) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['display_name'] = $user['display_name'];
            $_SESSION['role'] = $user['role'] ?? 'user';
            echo json_encode([
                'logged_in' => true,
                'user_id' => 'user_' . $user['id'],
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'display_name' => $user['display_name'],
                    'role' => $user['role'] ?? 'user',
                    'avatar' => $user['avatar'] ?? ''
                ]
            ]);
            exit;
        }
    }

    echo json_encode(['logged_in' => false]);
    exit;
}

// Đăng xuất (xóa remember me)
if ($action === 'logout') {
    if (isset($_SESSION['user_id'])) {
        $stmt = $conn->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
    }
    $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    setcookie('remember_token', '', time() - 3600, '/', '', $secure, true);
    setcookie('remember_user', '', time() - 3600, '/', '', $secure, true);
    session_destroy();
    echo json_encode(['success' => true, 'message' => 'Đã đăng xuất']);
    exit;
}

// Cập nhật hồ sơ
if ($action === 'update_profile') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (!validateCsrfToken($data['csrf_token'] ?? '')) {
        echo json_encode(['success' => false, 'message' => 'Token bảo mật không hợp lệ']);
        exit;
    }
    $userId = $_SESSION['user_id'];
    $displayName = trim($data['display_name'] ?? '');
    $email = trim($data['email'] ?? '');
    $currentPassword = $data['current_password'] ?? '';
    $newPassword = $data['new_password'] ?? '';

    if (!$displayName || !$email) {
        echo json_encode(['success' => false, 'message' => 'Tên hiển thị và email không được để trống']);
        exit;
    }

    // Kiểm tra email không trùng user khác
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $check->execute([$email, $userId]);
    if ($check->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Email đã được sử dụng']);
        exit;
    }

    // Nếu có đổi mật khẩu
    if ($newPassword) {
        if (!$currentPassword) {
            echo json_encode(['success' => false, 'message' => 'Nhập mật khẩu hiện tại để đổi mật khẩu mới']);
            exit;
        }
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        if (!password_verify($currentPassword, $user['password'])) {
            echo json_encode(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng']);
            exit;
        }
        if (strlen($newPassword) < 6) {
            echo json_encode(['success' => false, 'message' => 'Mật khẩu mới phải có ít nhất 6 ký tự']);
            exit;
        }
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET display_name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$displayName, $email, $hash, $userId]);
    } else {
        $stmt = $conn->prepare("UPDATE users SET display_name = ?, email = ? WHERE id = ?");
        $stmt->execute([$displayName, $email, $userId]);
    }

    $_SESSION['display_name'] = $displayName;
    echo json_encode(['success' => true, 'message' => 'Đã cập nhật hồ sơ']);
    exit;
}

// Lấy thông tin user (cho profile public)
if ($action === 'get_user') {
    $username = $_GET['username'] ?? '';
    $id = intval($_GET['id'] ?? 0);

    if ($id > 0) {
        $stmt = $conn->prepare("SELECT id, username, display_name, created_at FROM users WHERE id = ?");
        $stmt->execute([$id]);
    } elseif ($username) {
        $stmt = $conn->prepare("SELECT id, username, display_name, created_at FROM users WHERE username = ?");
        $stmt->execute([$username]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thiếu username hoặc id']);
        exit;
    }

    $user = $stmt->fetch();
    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Người dùng không tồn tại']);
        exit;
    }

    // Thống kê
    $userId = 'user_' . $user['id'];
    $vocab = $conn->prepare("SELECT COUNT(*) FROM progress WHERE user_id = ? AND (write_completed = 1 OR speech_completed = 1)");
    $vocab->execute([$userId]);
    $user['vocab_learned'] = intval($vocab->fetchColumn());

    $quiz = $conn->prepare("SELECT COUNT(*) as cnt, COALESCE(ROUND(AVG(score * 100.0 / total_questions)), 0) as avg FROM quiz_results WHERE user_id = ?");
    $quiz->execute([$userId]);
    $qData = $quiz->fetch(PDO::FETCH_ASSOC);
    $user['quiz_count'] = intval($qData['cnt'] ?? 0);
    $user['quiz_avg'] = intval($qData['avg'] ?? 0);

    $lessons = $conn->prepare("SELECT COUNT(*) FROM progress WHERE user_id = ? AND lesson_id IS NOT NULL AND write_completed = 1");
    $lessons->execute([$userId]);
    $user['lessons_done'] = intval($lessons->fetchColumn());

    echo json_encode(['success' => true, 'user' => $user]);
    exit;
}

// Đổi mật khẩu (khi đã đăng nhập)
if ($action === 'change_password') {
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'Chưa đăng nhập']);
        exit;
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (!validateCsrfToken($data['csrf_token'] ?? '')) {
        echo json_encode(['success' => false, 'message' => 'Token bảo mật không hợp lệ']);
        exit;
    }
    $userId = $_SESSION['user_id'];
    $currentPassword = $data['current_password'] ?? '';
    $newPassword = $data['new_password'] ?? '';

    if (!$currentPassword || !$newPassword) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
        exit;
    }
    if (strlen($newPassword) < 6) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu mới phải có ít nhất 6 ký tự']);
        exit;
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();
    if (!password_verify($currentPassword, $user['password'])) {
        echo json_encode(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng']);
        exit;
    }

    $hash = password_hash($newPassword, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->execute([$hash, $userId]);

    echo json_encode(['success' => true, 'message' => 'Đổi mật khẩu thành công']);
    exit;
}

echo json_encode(['error' => 'Invalid action']);
