<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();
require_once __DIR__ . '/db.php';

$action = $_GET['action'] ?? 'list';
$userId = $_SESSION['user_id'] ?? 0;

$baseUrl = 'exam_mvc.php';

function escape($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }

switch ($action) {
    case 'list':
        $levelFilter = (int)($_GET['level'] ?? 0);
        $where = $levelFilter ? "WHERE level = $levelFilter" : "";
        $exams = $conn->query("SELECT * FROM exam_templates $where ORDER BY level, id")->fetchAll();

        $userResults = [];
        if ($userId) {
            $stmt = $conn->prepare("SELECT exam_id, MAX(score) as best_score, COUNT(*) as attempts FROM exam_results WHERE user_id = ? GROUP BY exam_id");
            $stmt->execute([$userId]);
            foreach ($stmt->fetchAll() as $r) {
                $userResults[$r['exam_id']] = $r;
            }
        }
        require 'app/Views/frontend/exam/list.php';
        break;

    case 'start':
        if (!$userId) { header('Location: login.php'); exit; }
        $examId = (int)($_GET['id'] ?? 0);
        $stmt = $conn->prepare("SELECT * FROM exam_templates WHERE id = ?");
        $stmt->execute([$examId]);
        $exam = $stmt->fetch();
        if (!$exam) { echo "Exam not found"; exit; }

        $stmt = $conn->prepare("SELECT * FROM exam_questions WHERE exam_id = ? ORDER BY FIELD(section,'listening','reading','grammar','writing'), sort_order");
        $stmt->execute([$examId]);
        $questions = $stmt->fetchAll();

        $grouped = ['listening' => [], 'reading' => [], 'grammar' => [], 'writing' => []];
        foreach ($questions as $q) {
            $section = $q['section'];
            $q['options_arr'] = $q['options'] ? json_decode($q['options'], true) : [];
            $grouped[$section][] = $q;
        }
        require 'app/Views/frontend/exam/take.php';
        break;

    case 'submit':
        if (!$userId) { header('Location: login.php'); exit; }
        $examId = (int)($_POST['exam_id'] ?? 0);
        $stmt = $conn->prepare("SELECT * FROM exam_templates WHERE id = ?");
        $stmt->execute([$examId]);
        $exam = $stmt->fetch();
        if (!$exam) { echo "Exam not found"; exit; }

        $stmt = $conn->prepare("SELECT * FROM exam_questions WHERE exam_id = ? ORDER BY FIELD(section,'listening','reading','grammar','writing'), sort_order");
        $stmt->execute([$examId]);
        $questions = $stmt->fetchAll();

        $answers = $_POST['answers'] ?? [];
        $score = 0;
        $totalPoints = count($questions);
        $details = [];

        foreach ($questions as $q) {
            $qid = $q['id'];
            $userAnswer = $answers[$qid] ?? '';
            $correct = strcasecmp(trim((string)$userAnswer), trim($q['answer'])) === 0;
            if ($correct) $score++;
            $details[] = [
                'id' => $qid,
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_answer' => $q['answer'],
                'user_answer' => $userAnswer,
                'correct' => $correct,
                'section' => $q['section'],
                'explanation' => $q['explanation'],
                'points' => $q['points'],
            ];
        }

        $startedAt = $_POST['started_at'] ?? date('Y-m-d H:i:s', time() - 60);

        $insStmt = $conn->prepare("INSERT INTO exam_results (user_id, exam_id, score, total_points, answers, started_at, completed_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $insStmt->execute([
            $userId, $examId, $score, $totalPoints,
            json_encode(['answers' => $answers, 'details' => $details]),
            $startedAt
        ]);
        $resultId = $conn->lastInsertId();

        header("Location: exam_mvc.php?action=result&id=$resultId");
        exit;

    case 'result':
        $resultId = (int)($_GET['id'] ?? 0);
        $stmt = $conn->prepare("SELECT r.*, e.title, e.level, e.total_questions, e.passing_score, e.duration_minutes FROM exam_results r JOIN exam_templates e ON r.exam_id = e.id WHERE r.id = ? AND r.user_id = ?");
        $stmt->execute([$resultId, $userId]);
        $result = $stmt->fetch();
        if (!$result) { echo "Result not found"; exit; }

        $data = json_decode($result['answers'], true);
        $details = $data['details'] ?? [];
        $sectionBreakdown = ['listening' => ['correct' => 0, 'total' => 0], 'reading' => ['correct' => 0, 'total' => 0], 'grammar' => ['correct' => 0, 'total' => 0], 'writing' => ['correct' => 0, 'total' => 0]];

        foreach ($details as $d) {
            $sec = $d['section'];
            if (!isset($sectionBreakdown[$sec])) $sectionBreakdown[$sec] = ['correct' => 0, 'total' => 0];
            $sectionBreakdown[$sec]['total']++;
            if ($d['correct']) $sectionBreakdown[$sec]['correct']++;
        }

        $percentage = $result['total_points'] > 0 ? round(($result['score'] / $result['total_points']) * 100) : 0;
        $passed = $percentage >= $result['passing_score'];

        require 'app/Views/frontend/exam/result.php';
        break;

    case 'history':
        if (!$userId) { header('Location: login.php'); exit; }
        $stmt = $conn->prepare("SELECT r.*, e.title, e.level, e.total_questions, e.passing_score FROM exam_results r JOIN exam_templates e ON r.exam_id = e.id WHERE r.user_id = ? ORDER BY r.created_at DESC LIMIT 50");
        $stmt->execute([$userId]);
        $history = $stmt->fetchAll();
        require 'app/Views/frontend/exam/history.php';
        break;

    default:
        header("Location: exam_mvc.php");
        exit;
}
