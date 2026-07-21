<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();
require_once __DIR__ . '/db.php';

$userId = $_SESSION['user_id'] ?? 0;
$userStmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$userStmt->execute([$userId]);
$user = $userStmt->fetch(PDO::FETCH_ASSOC);
if (!$user || $user['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$action = $_GET['action'] ?? 'dashboard';
$db = $conn;

$baseUrl = 'admin_mvc.php';

if (!function_exists('mb_truncate')) { function mb_truncate($str, $len = 60) { return mb_strlen($str) > $len ? mb_substr($str, 0, $len) . '...' : $str; } }

$sidebarActive = function($check) use ($action) {
    return $action === $check ? 'admin-nav-item--active' : '';
};

switch ($action) {
    case 'dashboard':
        $stats = [];
        $stats['total_users'] = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        $stats['total_lessons'] = $db->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
        $stats['total_vocab'] = $db->query("SELECT COUNT(*) FROM vocab")->fetchColumn();
        $stats['total_orders'] = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
        $stats['total_revenue'] = $db->query("SELECT COALESCE(SUM(amount),0) FROM orders WHERE status='paid'")->fetchColumn();
        $stats['total_grammar'] = $db->query("SELECT COUNT(*) FROM grammar")->fetchColumn();
        $stats['total_dialogues'] = $db->query("SELECT COUNT(*) FROM dialogues")->fetchColumn();
        $recentOrders = $db->query("SELECT o.*, u.username, u.display_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT 10")->fetchAll();
        require 'app/Views/admin/dashboard/index.php';
        break;

    case 'lessons':
        $level = (int)($_GET['level'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $level ? "WHERE level = $level" : "";
        $total = $db->query("SELECT COUNT(*) FROM lessons $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $lessons = $db->query("SELECT * FROM lessons $where ORDER BY level, lesson_num LIMIT $perPage OFFSET $offset")->fetchAll();
        require 'app/Views/admin/lessons/index.php';
        break;

    case 'lesson_create':
        require 'app/Views/admin/lessons/form.php';
        break;

    case 'lesson_edit':
        $lessonId = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM lessons WHERE id = ?");
        $stmt->execute([$lessonId]);
        $lesson = $stmt->fetch();
        if (!$lesson) { echo "<p>Không tìm thấy bài học</p>"; exit; }
        $editing = true;
        require 'app/Views/admin/lessons/form.php';
        break;

    case 'lesson_save':
        $level = (int)($_POST['level'] ?? 1);
        $lesson_num = (int)($_POST['lesson_num'] ?? 1);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $vocab_count = (int)($_POST['vocab_count'] ?? 0);
        $type = $_POST['type'] ?? 'vocab';
        $grammar = $_POST['grammar'] ?? '';
        $stmt = $db->prepare("INSERT INTO lessons (level, lesson_num, title, description, vocab_count, grammar, type) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$level, $lesson_num, $title, $description, $vocab_count, $grammar, $type]);
        header("Location: admin_mvc.php?action=lessons&msg=created");
        exit;

    case 'lesson_update':
        $id = (int)($_GET['id'] ?? 0);
        $level = (int)($_POST['level'] ?? 1);
        $lesson_num = (int)($_POST['lesson_num'] ?? 1);
        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';
        $vocab_count = (int)($_POST['vocab_count'] ?? 0);
        $type = $_POST['type'] ?? 'vocab';
        $grammar = $_POST['grammar'] ?? '';
        $stmt = $db->prepare("UPDATE lessons SET level=?, lesson_num=?, title=?, description=?, vocab_count=?, grammar=?, type=? WHERE id=?");
        $stmt->execute([$level, $lesson_num, $title, $description, $vocab_count, $grammar, $type, $id]);
        header("Location: admin_mvc.php?action=lessons&msg=updated");
        exit;

    case 'lesson_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM lessons WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=lessons&msg=deleted");
        exit;

    case 'vocab':
        $level = $_GET['level'] ?? '';
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 30;
        $conditions = [];
        $params = [];
        if ($level !== '') { $conditions[] = "v.level = " . (int)$level; }
        if ($lessonId) { $conditions[] = "v.lesson_id = $lessonId"; }
        $where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";
        $total = $db->query("SELECT COUNT(*) FROM vocab v $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $vocab = $db->query("SELECT v.*, l.title as lesson_title FROM vocab v LEFT JOIN lessons l ON v.lesson_id = l.id $where ORDER BY v.level, v.hanzi LIMIT $perPage OFFSET $offset")->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/vocab/index.php';
        break;

    case 'vocab_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/vocab/form.php';
        break;

    case 'vocab_edit':
        $vid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM vocab WHERE id = ?");
        $stmt->execute([$vid]);
        $vocabItem = $stmt->fetch();
        if (!$vocabItem) { echo "<p>Không tìm thấy từ vựng</p>"; exit; }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/vocab/form.php';
        break;

    case 'vocab_save':
        $stmt = $db->prepare("INSERT INTO vocab (hanzi, pinyin, meaning, level, lesson_id, strokes, radical, example, example_vi) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
            $_POST['hanzi'] ?? '', $_POST['pinyin'] ?? '', $_POST['meaning'] ?? '',
            (int)($_POST['level'] ?? 1), (int)($_POST['lesson_id'] ?: 0) ?: null,
            (int)($_POST['strokes'] ?? 0), $_POST['radical'] ?? '', $_POST['example'] ?? '', $_POST['example_vi'] ?? ''
        ]);
        header("Location: admin_mvc.php?action=vocab&msg=created");
        exit;

    case 'vocab_update':
        $vid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("UPDATE vocab SET hanzi=?, pinyin=?, meaning=?, level=?, lesson_id=?, strokes=?, radical=?, example=?, example_vi=? WHERE id=?");
        $stmt->execute([
            $_POST['hanzi'] ?? '', $_POST['pinyin'] ?? '', $_POST['meaning'] ?? '',
            (int)($_POST['level'] ?? 1), (int)($_POST['lesson_id'] ?: 0) ?: null,
            (int)($_POST['strokes'] ?? 0), $_POST['radical'] ?? '', $_POST['example'] ?? '', $_POST['example_vi'] ?? '', $vid
        ]);
        header("Location: admin_mvc.php?action=vocab&msg=updated");
        exit;

    case 'vocab_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM vocab WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=vocab&msg=deleted");
        exit;

    case 'grammar':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE g.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM grammar g $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $grammar = $db->query("SELECT g.*, l.title as lesson_title FROM grammar g LEFT JOIN lessons l ON g.lesson_id = l.id $where ORDER BY g.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/grammar/index.php';
        break;

    case 'grammar_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/grammar/form.php';
        break;

    case 'grammar_edit':
        $gid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM grammar WHERE id = ?");
        $stmt->execute([$gid]);
        $grammarItem = $stmt->fetch();
        if (!$grammarItem) { echo "<p>Không tìm thấy ngữ pháp</p>"; exit; }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/grammar/form.php';
        break;

    case 'grammar_save':
        $stmt = $db->prepare("INSERT INTO grammar (lesson_id, title, formula, meaning, usage, notes, sort_order) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['formula'] ?? '',
            $_POST['meaning'] ?? '', $_POST['usage'] ?? '', $_POST['notes'] ?? '', (int)($_POST['sort_order'] ?? 0)
        ]);
        header("Location: admin_mvc.php?action=grammar&msg=created");
        exit;

    case 'grammar_update':
        $gid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("UPDATE grammar SET lesson_id=?, title=?, formula=?, meaning=?, usage=?, notes=?, sort_order=? WHERE id=?");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['formula'] ?? '',
            $_POST['meaning'] ?? '', $_POST['usage'] ?? '', $_POST['notes'] ?? '', (int)($_POST['sort_order'] ?? 0), $gid
        ]);
        header("Location: admin_mvc.php?action=grammar&msg=updated");
        exit;

    case 'grammar_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM grammar WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=grammar&msg=deleted");
        exit;

    case 'dialogues':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE d.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM dialogues d $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $dialogues = $db->query("SELECT d.*, l.title as lesson_title FROM dialogues d LEFT JOIN lessons l ON d.lesson_id = l.id $where ORDER BY d.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        foreach ($dialogues as &$d) {
            $stmt = $db->prepare("SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order");
            $stmt->execute([$d['id']]);
            $d['sentences'] = $stmt->fetchAll();
        }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/dialogues/index.php';
        break;

    case 'dialogues_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/dialogues/form.php';
        break;

    case 'dialogues_edit':
        $did = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM dialogues WHERE id = ?");
        $stmt->execute([$did]);
        $dialogueItem = $stmt->fetch();
        if (!$dialogueItem) { echo "<p>Không tìm thấy hội thoại</p>"; exit; }
        $stmt = $db->prepare("SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order");
        $stmt->execute([$did]);
        $sentences = $stmt->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/dialogues/form.php';
        break;

    case 'dialogues_save':
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("INSERT INTO dialogues (lesson_id, title, context, sort_order) VALUES (?,?,?,?)");
            $stmt->execute([(int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['context'] ?? '', (int)($_POST['sort_order'] ?? 0)]);
            $did = $db->lastInsertId();
            if (!empty($_POST['sentences'])) {
                $sStmt = $db->prepare("INSERT INTO dialogue_sentences (dialogue_id, speaker, chinese, pinyin, vietnamese, sort_order) VALUES (?,?,?,?,?,?)");
                foreach ($_POST['sentences'] as $i => $s) {
                    $sStmt->execute([$did, $s['speaker'] ?? '', $s['chinese'] ?? '', $s['pinyin'] ?? '', $s['vietnamese'] ?? '', $i]);
                }
            }
            $db->commit();
        } catch (Exception $e) { $db->rollBack(); throw $e; }
        header("Location: admin_mvc.php?action=dialogues&msg=created");
        exit;

    case 'dialogues_update':
        $did = (int)($_GET['id'] ?? 0);
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE dialogues SET lesson_id=?, title=?, context=?, sort_order=? WHERE id=?");
            $stmt->execute([(int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['context'] ?? '', (int)($_POST['sort_order'] ?? 0), $did]);
            $db->prepare("DELETE FROM dialogue_sentences WHERE dialogue_id = ?")->execute([$did]);
            if (!empty($_POST['sentences'])) {
                $sStmt = $db->prepare("INSERT INTO dialogue_sentences (dialogue_id, speaker, chinese, pinyin, vietnamese, sort_order) VALUES (?,?,?,?,?,?)");
                foreach ($_POST['sentences'] as $i => $s) {
                    $sStmt->execute([$did, $s['speaker'] ?? '', $s['chinese'] ?? '', $s['pinyin'] ?? '', $s['vietnamese'] ?? '', $i]);
                }
            }
            $db->commit();
        } catch (Exception $e) { $db->rollBack(); throw $e; }
        header("Location: admin_mvc.php?action=dialogues&msg=updated");
        exit;

    case 'dialogues_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM dialogues WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=dialogues&msg=deleted");
        exit;

    case 'users':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 30;
        $search = $_GET['search'] ?? '';
        $where = '';
        $params = [];
        if ($search !== '') {
            $where = "WHERE username LIKE ? OR email LIKE ? OR display_name LIKE ?";
            $params = ["%$search%", "%$search%", "%$search%"];
        }
        $total = $db->prepare("SELECT COUNT(*) FROM users $where");
        $total->execute($params);
        $totalUsers = $total->fetchColumn();
        $lastPage = max(1, (int)ceil($totalUsers / $perPage));
        $offset = ($page - 1) * $perPage;
        $users = $db->prepare("SELECT * FROM users $where ORDER BY created_at DESC LIMIT $perPage OFFSET $offset");
        $users->execute($params);
        $users = $users->fetchAll();
        require 'app/Views/admin/users/index.php';
        break;

    case 'user_update_role':
        $uid = (int)($_POST['id'] ?? 0);
        $role = $_POST['role'] ?? 'user';
        $db->prepare("UPDATE users SET role = ? WHERE id = ?")->execute([$role, $uid]);
        header("Location: admin_mvc.php?action=users&msg=updated");
        exit;

    case 'user_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=users&msg=deleted");
        exit;

    case 'orders':
        $status = $_GET['status'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $status ? "WHERE o.status = " . $db->quote($status) : "";
        $total = $db->query("SELECT COUNT(*) FROM orders o $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $orders = $db->query("SELECT o.*, u.username, u.display_name, u.email, c.title as course_title FROM orders o JOIN users u ON o.user_id = u.id LEFT JOIN courses c ON o.course_id = c.id $where ORDER BY o.created_at DESC LIMIT $perPage OFFSET $offset")->fetchAll();
        require 'app/Views/admin/orders/index.php';
        break;

    case 'order_confirm':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("UPDATE orders SET status = 'paid', paid_at = NOW() WHERE id = ? AND status = 'pending'")->execute([$id]);
        header("Location: admin_mvc.php?action=orders&msg=confirmed");
        exit;

    case 'order_cancel':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("UPDATE orders SET status = 'cancelled' WHERE id = ? AND status = 'pending'")->execute([$id]);
        header("Location: admin_mvc.php?action=orders&msg=cancelled");
        exit;

    case 'exam':
        $level = (int)($_GET['level'] ?? 0);
        $where = $level ? "WHERE level = $level" : "";
        $exams = $db->query("SELECT * FROM exam_templates $where ORDER BY level, id")->fetchAll();
        require 'app/Views/admin/exam/index.php';
        break;

    case 'exam_create':
        require 'app/Views/admin/exam/form.php';
        break;

    case 'exam_edit':
        $examId = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM exam_templates WHERE id = ?");
        $stmt->execute([$examId]);
        $exam = $stmt->fetch();
        if (!$exam) { echo "<p>Không tìm thấy đề thi</p>"; exit; }
        $editing = true;
        require 'app/Views/admin/exam/form.php';
        break;

    case 'exam_save':
        $level = (int)($_POST['level'] ?? 1);
        $title = $_POST['title'] ?? '';
        $duration = (int)($_POST['duration_minutes'] ?? 40);
        $questions = (int)($_POST['total_questions'] ?? 40);
        $passing = (int)($_POST['passing_score'] ?? 60);
        $stmt = $db->prepare("INSERT INTO exam_templates (level, title, duration_minutes, total_questions, passing_score) VALUES (?,?,?,?,?)");
        $stmt->execute([$level, $title, $duration, $questions, $passing]);
        header("Location: admin_mvc.php?action=exam&msg=created");
        exit;

    case 'exam_update':
        $id = (int)($_GET['id'] ?? 0);
        $level = (int)($_POST['level'] ?? 1);
        $title = $_POST['title'] ?? '';
        $duration = (int)($_POST['duration_minutes'] ?? 40);
        $questions = (int)($_POST['total_questions'] ?? 40);
        $passing = (int)($_POST['passing_score'] ?? 60);
        $stmt = $db->prepare("UPDATE exam_templates SET level=?, title=?, duration_minutes=?, total_questions=?, passing_score=? WHERE id=?");
        $stmt->execute([$level, $title, $duration, $questions, $passing, $id]);
        header("Location: admin_mvc.php?action=exam&msg=updated");
        exit;

    case 'exam_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM exam_templates WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=exam&msg=deleted");
        exit;

    case 'exam_questions':
        $examId = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM exam_templates WHERE id = ?");
        $stmt->execute([$examId]);
        $exam = $stmt->fetch();
        if (!$exam) { echo "<p>Không tìm thấy đề thi</p>"; exit; }
        $questions = $db->prepare("SELECT * FROM exam_questions WHERE exam_id = ? ORDER BY FIELD(section,'listening','reading','grammar','writing'), sort_order");
        $questions->execute([$examId]);
        $questions = $questions->fetchAll();
        require 'app/Views/admin/exam/questions.php';
        break;

    case 'exam_question_add':
        $examId = (int)($_POST['exam_id'] ?? 0);
        $section = $_POST['section'] ?? 'reading';
        $qText = $_POST['question'] ?? '';
        $options = $_POST['options'] ?? '';
        $answer = $_POST['answer'] ?? '';
        $explanation = $_POST['explanation'] ?? '';
        $points = (int)($_POST['points'] ?? 1);
        $jsonOptions = null;
        if ($options !== '') {
            $arr = explode("\n", str_replace("\r\n", "\n", $options));
            $arr = array_map('trim', $arr);
            $arr = array_filter($arr);
            $jsonOptions = json_encode(array_values($arr));
        }
        $stmt = $db->prepare("SELECT COALESCE(MAX(question_number),0)+1 FROM exam_questions WHERE exam_id=?");
        $stmt->execute([$examId]);
        $nextNum = (int)$stmt->fetchColumn();
        $ins = $db->prepare("INSERT INTO exam_questions (exam_id, section, question_number, question, options, answer, explanation, points) VALUES (?,?,?,?,?,?,?,?)");
        $ins->execute([$examId, $section, $nextNum, $qText, $jsonOptions, $answer, $explanation, $points]);
        header("Location: admin_mvc.php?action=exam_questions&id=$examId&msg=added");
        exit;

    case 'exam_question_delete':
        $qid = (int)($_GET['qid'] ?? 0);
        $stmt = $db->prepare("SELECT exam_id FROM exam_questions WHERE id = ?");
        $stmt->execute([$qid]);
        $eq = $stmt->fetch();
        $examId = $eq ? $eq['exam_id'] : 0;
        $db->prepare("DELETE FROM exam_questions WHERE id = ?")->execute([$qid]);
        header("Location: admin_mvc.php?action=exam_questions&id=$examId&msg=deleted");
        exit;

    case 'readings':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE r.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM readings r $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $readings = $db->query("SELECT r.*, l.title as lesson_title FROM readings r LEFT JOIN lessons l ON r.lesson_id = l.id $where ORDER BY r.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/readings/index.php';
        break;

    case 'reading_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/readings/form.php';
        break;

    case 'reading_edit':
        $rid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM readings WHERE id = ?");
        $stmt->execute([$rid]);
        $reading = $stmt->fetch();
        if (!$reading) { echo "<p>Không tìm thấy bài đọc</p>"; exit; }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/readings/form.php';
        break;

    case 'reading_save':
        $stmt = $db->prepare("INSERT INTO readings (lesson_id, title, content, pinyin, translation, vocabulary_notes, audio_url, sort_order) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['content'] ?? '',
            $_POST['pinyin'] ?? '', $_POST['translation'] ?? '', $_POST['vocabulary_notes'] ?? '',
            $_POST['audio_url'] ?? '', (int)($_POST['sort_order'] ?? 0)
        ]);
        header("Location: admin_mvc.php?action=readings&msg=created");
        exit;

    case 'reading_update':
        $rid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("UPDATE readings SET lesson_id=?, title=?, content=?, pinyin=?, translation=?, vocabulary_notes=?, audio_url=?, sort_order=? WHERE id=?");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['content'] ?? '',
            $_POST['pinyin'] ?? '', $_POST['translation'] ?? '', $_POST['vocabulary_notes'] ?? '',
            $_POST['audio_url'] ?? '', (int)($_POST['sort_order'] ?? 0), $rid
        ]);
        header("Location: admin_mvc.php?action=readings&msg=updated");
        exit;

    case 'reading_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM readings WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=readings&msg=deleted");
        exit;

    case 'listening':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE le.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM listening_exercises le $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $listening = $db->query("SELECT le.*, l.title as lesson_title FROM listening_exercises le LEFT JOIN lessons l ON le.lesson_id = l.id $where ORDER BY le.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        foreach ($listening as &$ex) {
            $stmt = $db->prepare("SELECT * FROM listening_questions WHERE listening_id = ? ORDER BY sort_order");
            $stmt->execute([$ex['id']]);
            $ex['questions'] = $stmt->fetchAll();
        }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/listening/index.php';
        break;

    case 'listening_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/listening/form.php';
        break;

    case 'listening_edit':
        $lid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM listening_exercises WHERE id = ?");
        $stmt->execute([$lid]);
        $listeningItem = $stmt->fetch();
        if (!$listeningItem) { echo "<p>Không tìm thấy bài nghe</p>"; exit; }
        $stmt = $db->prepare("SELECT * FROM listening_questions WHERE listening_id = ? ORDER BY sort_order");
        $stmt->execute([$lid]);
        $questions = $stmt->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/listening/form.php';
        break;

    case 'listening_save':
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("INSERT INTO listening_exercises (lesson_id, title, audio_url, transcript, transcript_pinyin, transcript_vi, sort_order) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([
                (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['audio_url'] ?? '',
                $_POST['transcript'] ?? '', $_POST['transcript_pinyin'] ?? '', $_POST['transcript_vi'] ?? '',
                (int)($_POST['sort_order'] ?? 0)
            ]);
            $lid = $db->lastInsertId();
            if (!empty($_POST['questions'])) {
                $qStmt = $db->prepare("INSERT INTO listening_questions (listening_id, question, options, answer, explanation, type, sort_order) VALUES (?,?,?,?,?,?,?)");
                foreach ($_POST['questions'] as $i => $q) {
                    $options = !empty($q['options']) ? json_encode(explode("\n", str_replace("\r\n", "\n", $q['options']))) : null;
                    $qStmt->execute([$lid, $q['question'] ?? '', $options, $q['answer'] ?? '', $q['explanation'] ?? '', $q['type'] ?? 'multiple_choice', $i]);
                }
            }
            $db->commit();
        } catch (Exception $e) { $db->rollBack(); throw $e; }
        header("Location: admin_mvc.php?action=listening&msg=created");
        exit;

    case 'listening_update':
        $lid = (int)($_GET['id'] ?? 0);
        $db->beginTransaction();
        try {
            $stmt = $db->prepare("UPDATE listening_exercises SET lesson_id=?, title=?, audio_url=?, transcript=?, transcript_pinyin=?, transcript_vi=?, sort_order=? WHERE id=?");
            $stmt->execute([
                (int)($_POST['lesson_id'] ?? 0), $_POST['title'] ?? '', $_POST['audio_url'] ?? '',
                $_POST['transcript'] ?? '', $_POST['transcript_pinyin'] ?? '', $_POST['transcript_vi'] ?? '',
                (int)($_POST['sort_order'] ?? 0), $lid
            ]);
            $db->prepare("DELETE FROM listening_questions WHERE listening_id = ?")->execute([$lid]);
            if (!empty($_POST['questions'])) {
                $qStmt = $db->prepare("INSERT INTO listening_questions (listening_id, question, options, answer, explanation, type, sort_order) VALUES (?,?,?,?,?,?,?)");
                foreach ($_POST['questions'] as $i => $q) {
                    $options = !empty($q['options']) ? json_encode(explode("\n", str_replace("\r\n", "\n", $q['options']))) : null;
                    $qStmt->execute([$lid, $q['question'] ?? '', $options, $q['answer'] ?? '', $q['explanation'] ?? '', $q['type'] ?? 'multiple_choice', $i]);
                }
            }
            $db->commit();
        } catch (Exception $e) { $db->rollBack(); throw $e; }
        header("Location: admin_mvc.php?action=listening&msg=updated");
        exit;

    case 'listening_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM listening_exercises WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=listening&msg=deleted");
        exit;

    case 'speaking':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE se.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM speaking_exercises se $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $speaking = $db->query("SELECT se.*, l.title as lesson_title FROM speaking_exercises se LEFT JOIN lessons l ON se.lesson_id = l.id $where ORDER BY se.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/speaking/index.php';
        break;

    case 'speaking_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/speaking/form.php';
        break;

    case 'speaking_edit':
        $sid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM speaking_exercises WHERE id = ?");
        $stmt->execute([$sid]);
        $speakingItem = $stmt->fetch();
        if (!$speakingItem) { echo "<p>Không tìm thấy bài nói</p>"; exit; }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/speaking/form.php';
        break;

    case 'speaking_save':
        $stmt = $db->prepare("INSERT INTO speaking_exercises (lesson_id, instruction, target_text, target_pinyin, audio_reference, sort_order) VALUES (?,?,?,?,?,?)");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['instruction'] ?? '', $_POST['target_text'] ?? '',
            $_POST['target_pinyin'] ?? '', $_POST['audio_reference'] ?? '', (int)($_POST['sort_order'] ?? 0)
        ]);
        header("Location: admin_mvc.php?action=speaking&msg=created");
        exit;

    case 'speaking_update':
        $sid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("UPDATE speaking_exercises SET lesson_id=?, instruction=?, target_text=?, target_pinyin=?, audio_reference=?, sort_order=? WHERE id=?");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['instruction'] ?? '', $_POST['target_text'] ?? '',
            $_POST['target_pinyin'] ?? '', $_POST['audio_reference'] ?? '', (int)($_POST['sort_order'] ?? 0), $sid
        ]);
        header("Location: admin_mvc.php?action=speaking&msg=updated");
        exit;

    case 'speaking_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM speaking_exercises WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=speaking&msg=deleted");
        exit;

    case 'writing':
        $lessonId = (int)($_GET['lesson_id'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 20;
        $where = $lessonId ? "WHERE we.lesson_id = $lessonId" : "";
        $total = $db->query("SELECT COUNT(*) FROM writing_exercises we $where")->fetchColumn();
        $lastPage = max(1, (int)ceil($total / $perPage));
        $offset = ($page - 1) * $perPage;
        $writing = $db->query("SELECT we.*, l.title as lesson_title FROM writing_exercises we LEFT JOIN lessons l ON we.lesson_id = l.id $where ORDER BY we.sort_order LIMIT $perPage OFFSET $offset")->fetchAll();
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/writing/index.php';
        break;

    case 'writing_create':
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        require 'app/Views/admin/writing/form.php';
        break;

    case 'writing_edit':
        $wid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("SELECT * FROM writing_exercises WHERE id = ?");
        $stmt->execute([$wid]);
        $writingItem = $stmt->fetch();
        if (!$writingItem) { echo "<p>Không tìm thấy bài viết</p>"; exit; }
        $allLessons = $db->query("SELECT * FROM lessons ORDER BY level, lesson_num")->fetchAll();
        $editing = true;
        require 'app/Views/admin/writing/form.php';
        break;

    case 'writing_save':
        $stmt = $db->prepare("INSERT INTO writing_exercises (lesson_id, character_char, stroke_count, radical, stroke_animation_svg, stroke_order_image, sort_order) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['character_char'] ?? '', (int)($_POST['stroke_count'] ?? 0),
            $_POST['radical'] ?? '', $_POST['stroke_animation_svg'] ?? '', $_POST['stroke_order_image'] ?? '',
            (int)($_POST['sort_order'] ?? 0)
        ]);
        header("Location: admin_mvc.php?action=writing&msg=created");
        exit;

    case 'writing_update':
        $wid = (int)($_GET['id'] ?? 0);
        $stmt = $db->prepare("UPDATE writing_exercises SET lesson_id=?, character_char=?, stroke_count=?, radical=?, stroke_animation_svg=?, stroke_order_image=?, sort_order=? WHERE id=?");
        $stmt->execute([
            (int)($_POST['lesson_id'] ?? 0), $_POST['character_char'] ?? '', (int)($_POST['stroke_count'] ?? 0),
            $_POST['radical'] ?? '', $_POST['stroke_animation_svg'] ?? '', $_POST['stroke_order_image'] ?? '',
            (int)($_POST['sort_order'] ?? 0), $wid
        ]);
        header("Location: admin_mvc.php?action=writing&msg=updated");
        exit;

    case 'writing_delete':
        $id = (int)($_GET['id'] ?? 0);
        $db->prepare("DELETE FROM writing_exercises WHERE id = ?")->execute([$id]);
        header("Location: admin_mvc.php?action=writing&msg=deleted");
        exit;

    default:
        echo "<!DOCTYPE html><html><head><title>404</title><link rel='stylesheet' href='style.css'></head><body><div style='padding:100px 24px;text-align:center'><h1>404</h1><p>Action not found</p><a href='admin_mvc.php' class='btn btn--primary'>Dashboard</a></div></body></html>";
}
