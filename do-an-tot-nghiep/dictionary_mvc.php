<?php
require_once __DIR__ . '/app/Helpers/Autoloader.php';
App\Helpers\Autoloader::register();
App\Helpers\Session::start();
require_once __DIR__ . '/db.php';

$userId = $_SESSION['user_id'] ?? 0;
$query = trim($_GET['q'] ?? '');
$type = $_GET['type'] ?? 'hanzi';
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 20;

$results = [];
$total = 0;
$radicalInfo = null;

if ($query) {
    switch ($type) {
        case 'hanzi':
            $sql = "SELECT * FROM vocab WHERE hanzi LIKE ? ORDER BY level, hanzi";
            $params = ["%$query%"];
            break;
        case 'pinyin':
            $sql = "SELECT * FROM vocab WHERE pinyin LIKE ? ORDER BY level, hanzi";
            $params = ["%$query%"];
            break;
        case 'vietnamese':
            $sql = "SELECT * FROM vocab WHERE meaning LIKE ? OR example_vi LIKE ? ORDER BY level, hanzi";
            $params = ["%$query%", "%$query%"];
            break;
    }

    $countStmt = $conn->prepare(str_replace("SELECT *", "SELECT COUNT(*)", $sql));
    $countStmt->execute($params);
    $total = (int)$countStmt->fetchColumn();

    $offset = ($page - 1) * $perPage;
    $stmt = $conn->prepare($sql . " LIMIT $perPage OFFSET $offset");
    $stmt->execute($params);
    $results = $stmt->fetchAll();

    if ($userId && $query) {
        $log = $conn->prepare("INSERT INTO dictionary_lookup_history (user_id, query, result_type) VALUES (?, ?, ?)");
        $log->execute([$userId, $query, $type]);
    }

    if ($type === 'hanzi' && mb_strlen($query) === 1) {
        $radStmt = $conn->prepare("SELECT * FROM radicals WHERE char = ?");
        $radStmt->execute([$query]);
        $radicalInfo = $radStmt->fetch();
    }
}

$recentSearches = [];
if ($userId) {
    $recent = $conn->prepare("SELECT DISTINCT query, result_type FROM dictionary_lookup_history WHERE user_id = ? GROUP BY query, result_type ORDER BY MAX(created_at) DESC LIMIT 10");
    $recent->execute([$userId]);
    $recentSearches = $recent->fetchAll();
}

$radicals = $conn->query("SELECT * FROM radicals ORDER BY strokes, char")->fetchAll();
$radicalsByCategory = [];
foreach ($radicals as $r) {
    $cat = $r['category'] ?? 'Khác';
    $radicalsByCategory[$cat][] = $r;
}

require 'app/Views/frontend/dictionary/index.php';
