<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) { header('Location: login.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: daily_challenge.php');
    exit;
}

$date = $_POST['date'] ?? date('Y-m-d');
$results = $_POST['results'] ?? [];
$vocabIds = $_POST['vocab_ids'] ?? [];

foreach ($results as $vid => $result) {
    if (!in_array($result, ['knew', 'dunno'])) continue;

    $existing = $conn->prepare("SELECT id, learned, correct_count, wrong_count FROM vocab_progress WHERE user_id = ? AND vocab_id = ?");
    $existing->execute([$userId, $vid]);
    $row = $existing->fetch();

    if ($row) {
        if ($result === 'knew') {
            $conn->prepare("UPDATE vocab_progress SET learned = 1, correct_count = correct_count + 1, last_reviewed = NOW() WHERE id = ?")->execute([$row['id']]);
        } else {
            $conn->prepare("UPDATE vocab_progress SET wrong_count = wrong_count + 1, last_reviewed = NOW() WHERE id = ?")->execute([$row['id']]);
        }
    } else {
        $conn->prepare("INSERT INTO vocab_progress (user_id, vocab_id, learned, correct_count, wrong_count, last_reviewed) VALUES (?, ?, ?, ?, ?, NOW())")
            ->execute([$userId, $vid, $result === 'knew' ? 1 : 0, $result === 'knew' ? 1 : 0, $result === 'knew' ? 0 : 1]);
    }
}

// Update streak
$today = date('Y-m-d');
$streak = $conn->prepare("SELECT id, streak_days, last_activity_date FROM user_streaks WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$streak->execute([$userId]);
$s = $streak->fetch();

if ($s) {
    if ($s['last_activity_date'] !== $today) {
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $newStreak = $s['last_activity_date'] === $yesterday ? $s['streak_days'] + 1 : 1;
        $conn->prepare("UPDATE user_streaks SET streak_days = ?, last_activity_date = ?, updated_at = NOW() WHERE id = ?")
            ->execute([$newStreak, $today, $s['id']]);
    }
} else {
    $conn->prepare("INSERT INTO user_streaks (user_id, streak_days, last_activity_date) VALUES (?, 1, ?)")
        ->execute([$userId, $today]);
}

// Award XP
$knewCount = 0;
foreach ($results as $r) { if ($r === 'knew') $knewCount++; }
$xp = $knewCount * 10;

$prog = $conn->prepare("SELECT id FROM user_progress WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$prog->execute([$userId]);
$p = $prog->fetch();
if ($p) {
    $conn->prepare("UPDATE user_progress SET total_xp = total_xp + ?, vocab_mastered = vocab_mastered + ? WHERE id = ?")
        ->execute([$xp, $knewCount, $p['id']]);
} else {
    $conn->prepare("INSERT INTO user_progress (user_id, total_xp, vocab_mastered) VALUES (?, ?, ?)")
        ->execute([$userId, $xp, $knewCount]);
}

// Find next lesson recommendation
$nextLesson = $conn->prepare("SELECT l.id, l.title FROM lessons l WHERE l.id NOT IN (SELECT lesson_id FROM lesson_progress WHERE user_id = ? AND is_completed = 1) ORDER BY l.level, l.lesson_num LIMIT 1");
$nextLesson->execute([$userId]);
$next = $nextLesson->fetch();

$_SESSION['challenge_done'] = true;
$_SESSION['challenge_knew'] = $knewCount;
$_SESSION['challenge_total'] = count($results);
$_SESSION['challenge_xp'] = $xp;
$_SESSION['challenge_next_lesson'] = $next['title'] ?? '';
$_SESSION['challenge_next_id'] = $next['id'] ?? 0;

header('Location: daily_challenge.php?done=1');
exit;