<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();
require_once __DIR__ . '/db.php';

$lessonId = (int) ($_GET['id'] ?? 0);
if (!$lessonId) {
    header('Location: lessons.php');
    exit;
}

$db = $conn;

$stmt = $db->prepare("SELECT * FROM lessons WHERE id = ?");
$stmt->execute([$lessonId]);
$lesson = $stmt->fetch();

if (!$lesson) {
    echo "<!DOCTYPE html><html><head><title>404</title><link rel='stylesheet' href='style.css'></head><body><div style='padding:100px 24px;text-align:center'><h1>Bài học không tồn tại</h1><a href='lessons.php' class='btn btn--primary'>Danh sách bài học</a></div></body></html>";
    exit;
}

$vocab = $db->prepare("SELECT * FROM vocab WHERE lesson_id = ? ORDER BY id");
$vocab->execute([$lessonId]);
$vocab = $vocab->fetchAll();

$grammarList = $db->prepare("SELECT g.*, ge.example_cn, ge.example_pinyin, ge.example_vi FROM grammar g LEFT JOIN grammar_examples ge ON ge.grammar_id = g.id WHERE g.lesson_id = ? ORDER BY g.sort_order");
$grammarList->execute([$lessonId]);
$grammarList = $grammarList->fetchAll();

$dialogues = $db->prepare("SELECT * FROM dialogues WHERE lesson_id = ? ORDER BY sort_order");
$dialogues->execute([$lessonId]);
$dialogues = $dialogues->fetchAll();
foreach ($dialogues as &$d) {
    $stmt2 = $db->prepare("SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order");
    $stmt2->execute([$d['id']]);
    $d['sentences'] = $stmt2->fetchAll();
}

$reading = $db->prepare("SELECT * FROM readings WHERE lesson_id = ? ORDER BY sort_order LIMIT 1");
$reading->execute([$lessonId]);
$reading = $reading->fetch();

$listening = $db->prepare("SELECT * FROM listening_exercises WHERE lesson_id = ? ORDER BY sort_order LIMIT 1");
$listening->execute([$lessonId]);
$listening = $listening->fetch();

if ($listening) {
    $listeningQuestions = $db->prepare("SELECT * FROM listening_questions WHERE listening_id = ? ORDER BY sort_order");
    $listeningQuestions->execute([$listening['id']]);
    $listening['questions'] = $listeningQuestions->fetchAll();
}

$speaking = $db->prepare("SELECT * FROM speaking_exercises WHERE lesson_id = ? ORDER BY sort_order");
$speaking->execute([$lessonId]);
$speaking = $speaking->fetchAll();

$writing = $db->prepare("SELECT * FROM writing_exercises WHERE lesson_id = ? ORDER BY sort_order");
$writing->execute([$lessonId]);
$writing = $writing->fetchAll();

$exercises = [];
$allGrammar = $db->prepare("SELECT id FROM grammar WHERE lesson_id = ?");
$allGrammar->execute([$lessonId]);
$gIds = $allGrammar->fetchAll(PDO::FETCH_COLUMN);
if (!empty($gIds)) {
    $placeholders = implode(',', array_fill(0, count($gIds), '?'));
    $exercises = $db->prepare("SELECT * FROM grammar_exercises WHERE grammar_id IN ($placeholders) ORDER BY sort_order");
    $exercises->execute($gIds);
    $exercises = $exercises->fetchAll();
}

$userId = $_SESSION['user_id'] ?? 0;
$progress = null;
$userNote = null;
if ($userId) {
    $pStmt = $db->prepare("SELECT * FROM lesson_progress WHERE user_id = ? AND lesson_id = ?");
    $pStmt->execute([$userId, $lessonId]);
    $progress = $pStmt->fetch();
    
    $nStmt = $db->prepare("SELECT * FROM user_notes WHERE user_id = ? AND lesson_id = ?");
    $nStmt->execute([$userId, $lessonId]);
    $userNote = $nStmt->fetch();
    
    // Log study history
    $hStmt = $db->prepare("INSERT INTO lesson_history (user_id, lesson_id, action, duration_seconds) VALUES (?, ?, 'view', 0)");
    $hStmt->execute([$userId, $lessonId]);
}

// Get review vocab (from previous lessons same level)
$reviewVocab = $db->prepare("SELECT v.* FROM vocab v JOIN lessons l ON v.lesson_id = l.id WHERE l.level = ? AND l.lesson_num < ? ORDER BY l.lesson_num DESC, v.id LIMIT 10");
$reviewVocab->execute([$lesson['level'], $lesson['lesson_num']]);
$reviewVocab = $reviewVocab->fetchAll();

$prevLesson = $db->prepare("SELECT id FROM lessons WHERE level = ? AND lesson_num < ? ORDER BY lesson_num DESC LIMIT 1");
$prevLesson->execute([$lesson['level'], $lesson['lesson_num']]);
$prevLesson = $prevLesson->fetch();

$nextLesson = $db->prepare("SELECT id, title FROM lessons WHERE level = ? AND lesson_num > ? ORDER BY lesson_num ASC LIMIT 1");
$nextLesson->execute([$lesson['level'], $lesson['lesson_num']]);
$nextLesson = $nextLesson->fetch();

require 'app/Views/frontend/lesson/show.php';
