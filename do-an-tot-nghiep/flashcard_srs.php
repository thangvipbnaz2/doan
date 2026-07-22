<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();
require_once __DIR__ . '/db.php';

$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) { header('Location: login.php'); exit; }

$conn->exec("CREATE TABLE IF NOT EXISTS flashcards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    vocab_id INT NOT NULL,
    ease_factor DECIMAL(3,2) DEFAULT 2.50,
    interval_days INT DEFAULT 0,
    next_review_date DATE,
    review_count INT DEFAULT 0,
    last_reviewed_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (user_id, vocab_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$conn->exec("CREATE TABLE IF NOT EXISTS flashcard_reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    flashcard_id INT NOT NULL,
    quality TINYINT DEFAULT 0,
    reviewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

$action = $_GET['action'] ?? 'study';
$level = (int)($_GET['level'] ?? 0);

require __DIR__ . '/app/Views/layouts/_standalone_header.php';
switch ($action) {
    case 'study':
        $today = date('Y-m-d');
        $dueCards = $conn->prepare("
            SELECT f.*, v.hanzi, v.pinyin, v.meaning, v.example, v.example_vi, v.level, v.lesson_id
            FROM flashcards f
            JOIN vocab v ON f.vocab_id = v.id
            WHERE f.user_id = ? AND (f.next_review_date IS NULL OR f.next_review_date <= ?)
            ORDER BY f.next_review_date ASC, f.ease_factor ASC
            LIMIT 20
        ");
        $dueCards->execute([$userId, $today]);
        $cards = $dueCards->fetchAll();

        $levelFilter = $level ? "AND v.level = $level" : "";
        $newVocab = $conn->prepare("
            SELECT v.* FROM vocab v
            LEFT JOIN flashcards f ON f.vocab_id = v.id AND f.user_id = ?
            WHERE f.id IS NULL $levelFilter
            ORDER BY v.level, v.id
            LIMIT 10
        ");
        $newVocab->execute([$userId]);
        $newWords = $newVocab->fetchAll();

        $totalStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ?");
        $totalStmt->execute([$userId]);
        $total = (int)$totalStmt->fetchColumn();

        $dueStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ? AND (next_review_date IS NULL OR next_review_date <= ?)");
        $dueStmt->execute([$userId, $today]);
        $dueCount = (int)$dueStmt->fetchColumn();

        $masteredStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ? AND interval_days >= 30");
        $masteredStmt->execute([$userId]);
        $masteredCount = (int)$masteredStmt->fetchColumn();

        require __DIR__ . '/app/Views/frontend/flashcard/study.php';
        break;

    case 'add':
        $vocabId = (int)($_POST['vocab_id'] ?? 0);
        if ($vocabId) {
            $stmt = $conn->prepare("INSERT IGNORE INTO flashcards (user_id, vocab_id, ease_factor, interval_days, next_review_date) VALUES (?, ?, 2.50, 0, CURDATE())");
            $stmt->execute([$userId, $vocabId]);
        }
        header('Location: flashcard_srs.php?level=' . ($_POST['level'] ?? 0));
        break;

    case 'review':
        $flashcardId = (int)($_POST['id'] ?? 0);
        $quality = (int)($_POST['quality'] ?? 2);

        $card = $conn->prepare("SELECT * FROM flashcards WHERE id = ? AND user_id = ?");
        $card->execute([$flashcardId, $userId]);
        $card = $card->fetch();
        if (!$card) break;

        $ef = (float)$card['ease_factor'];
        $interval = (int)$card['interval_days'];
        $reviewCount = (int)$card['review_count'];

        if ($quality < 3) {
            $interval = 1;
            $ef = max(1.3, $ef + 0.2 - (3 - $quality) * 0.2);
        } else {
            $ef = max(1.3, $ef + 0.1 - (5 - $quality) * 0.08);
            if ($reviewCount == 0) $interval = 1;
            elseif ($reviewCount == 1) $interval = 3;
            else $interval = round($interval * $ef);
        }

        $nextDate = date('Y-m-d', strtotime("+$interval days"));
        $newReviewCount = $reviewCount + 1;

        $update = $conn->prepare("UPDATE flashcards SET ease_factor = ?, interval_days = ?, next_review_date = ?, review_count = ?, last_reviewed_at = NOW() WHERE id = ?");
        $update->execute([$ef, $interval, $nextDate, $newReviewCount, $flashcardId]);

        $log = $conn->prepare("INSERT INTO flashcard_reviews (flashcard_id, quality) VALUES (?, ?)");
        $log->execute([$flashcardId, $quality]);

        require_once __DIR__ . '/app/Helpers/Autoloader.php';
        App\Helpers\Autoloader::register();
        App\Models\Achievement::checkFlashcardAchievements($userId);

        echo json_encode(['success' => true, 'next_date' => $nextDate, 'interval' => $interval]);
        exit;

    case 'stats':
        $today = date('Y-m-d');

        $totalStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ?");
        $totalStmt->execute([$userId]);
        $total = (int)$totalStmt->fetchColumn();

        $dueStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ? AND (next_review_date IS NULL OR next_review_date <= ?)");
        $dueStmt->execute([$userId, $today]);
        $dueCount = (int)$dueStmt->fetchColumn();

        $masteredStmt = $conn->prepare("SELECT COUNT(*) FROM flashcards WHERE user_id = ? AND interval_days >= 30");
        $masteredStmt->execute([$userId]);
        $masteredCount = (int)$masteredStmt->fetchColumn();

        $learningCount = $total - $masteredCount;

        $reviewsTodayStmt = $conn->prepare("SELECT COUNT(*) FROM flashcard_reviews fr JOIN flashcards f ON fr.flashcard_id = f.id WHERE f.user_id = ? AND DATE(fr.reviewed_at) = ?");
        $reviewsTodayStmt->execute([$userId, $today]);
        $reviewsToday = (int)$reviewsTodayStmt->fetchColumn();

        $reviewsByDay = $conn->prepare("
            SELECT DATE(fr.reviewed_at) as day, COUNT(*) as count
            FROM flashcard_reviews fr
            JOIN flashcards f ON fr.flashcard_id = f.id
            WHERE f.user_id = ? AND fr.reviewed_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(fr.reviewed_at)
            ORDER BY day
        ");
        $reviewsByDay->execute([$userId]);
        $reviewsByDayData = $reviewsByDay->fetchAll();

        $cardsByLevel = $conn->prepare("
            SELECT v.level, COUNT(*) as count
            FROM flashcards f
            JOIN vocab v ON f.vocab_id = v.id
            WHERE f.user_id = ?
            GROUP BY v.level
            ORDER BY v.level
        ");
        $cardsByLevel->execute([$userId]);
        $cardsByLevelData = $cardsByLevel->fetchAll();

        $avgEase = $conn->prepare("SELECT AVG(ease_factor) FROM flashcards WHERE user_id = ?");
        $avgEase->execute([$userId]);
        $avgEaseFactor = round((float)$avgEase->fetchColumn(), 2);

        $totalReviewsStmt = $conn->prepare("SELECT COUNT(*) FROM flashcard_reviews fr JOIN flashcards f ON fr.flashcard_id = f.id WHERE f.user_id = ?");
        $totalReviewsStmt->execute([$userId]);
        $totalReviews = (int)$totalReviewsStmt->fetchColumn();

        require __DIR__ . '/app/Views/frontend/flashcard/stats.php';
        break;
}

require __DIR__ . '/app/Views/layouts/_standalone_footer.php';
