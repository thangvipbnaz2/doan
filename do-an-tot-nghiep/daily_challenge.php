<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) { header('Location: login.php'); exit; }

$done = isset($_GET['done']);
$knew = $_SESSION['challenge_knew'] ?? 0;
$challengeTotal = $_SESSION['challenge_total'] ?? 0;
$xp = $_SESSION['challenge_xp'] ?? 0;
$nextLesson = $_SESSION['challenge_next_lesson'] ?? '';
$nextId = $_SESSION['challenge_next_id'] ?? 0;
if ($done) {
    unset($_SESSION['challenge_knew'], $_SESSION['challenge_total'], $_SESSION['challenge_xp'], $_SESSION['challenge_next_lesson'], $_SESSION['challenge_next_id'], $_SESSION['challenge_done']);
}

// Seed based on date for consistent daily challenge
$today = date('Y-m-d');
$seed = crc32($today . $userId);
srand($seed);

// Pick 5 random vocab items (not yet mastered)
$mastered = $conn->prepare("SELECT vocab_id FROM vocab_progress WHERE user_id = ? AND learned = 1");
$mastered->execute([$userId]);
$masteredIds = $mastered->fetchAll(PDO::FETCH_COLUMN);

$placeholders = $masteredIds ? 'WHERE id NOT IN (' . implode(',', array_fill(0, count($masteredIds), '?')) . ')' : '';
$params = $masteredIds ?: [];

$total = $conn->prepare("SELECT COUNT(*) FROM vocab $placeholders");
$total->execute($params);
$totalCount = $total->fetchColumn();

$challengeVocab = [];
if ($totalCount >= 5) {
    $randomOffset = rand(0, max(0, $totalCount - 5));
    $stmt = $conn->prepare("SELECT id, hanzi, pinyin, meaning, example, radical FROM vocab $placeholders ORDER BY id LIMIT 5 OFFSET $randomOffset");
    $stmt->execute($params);
    $challengeVocab = $stmt->fetchAll();
} elseif ($totalCount > 0) {
    $stmt = $conn->prepare("SELECT id, hanzi, pinyin, meaning, example, radical FROM vocab $placeholders ORDER BY id");
    $stmt->execute($params);
    $challengeVocab = $stmt->fetchAll();
} else {
    $stmt = $conn->query("SELECT id, hanzi, pinyin, meaning, example, radical FROM vocab ORDER BY RAND() LIMIT 5");
    $challengeVocab = $stmt->fetchAll();
}

// Shuffle challenge order
shuffle($challengeVocab);

// Log challenge view
$log = $conn->prepare("INSERT INTO study_logs (user_id, activity_type, reference_id, completed_at) VALUES (?, 'flashcard', 0, NOW())");
$log->execute([$userId]);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Thử thách hằng ngày | HànNgữ</title>
<link rel="icon" type="image/svg+xml" href="favicon.svg">
<link rel="stylesheet" href="style.css">
<style>
.challenge-page{max-width:860px;margin:auto;padding:105px 24px 64px}
.challenge-header{text-align:center;margin-bottom:28px}
.challenge-header h1{font-size:1.7rem;margin-bottom:6px}
.challenge-header p{color:var(--gray,#64748b)}
.challenge-date{display:inline-block;background:var(--teal-light,#ccfbf1);color:var(--teal-dark,#0f766e);padding:4px 14px;border-radius:20px;font-size:.85rem;font-weight:600;margin-bottom:12px}
.card-grid{display:grid;gap:16px}
.challenge-card{background:var(--white,#fff);border-radius:16px;padding:22px;box-shadow:0 4px 20px rgba(0,0,0,.06);border:1px solid #eef2f7;transition:all .25s}
.challenge-card.revealed{border-color:#0d9488}
.challenge-card__hanzi{font-size:2rem;font-weight:700;font-family:'Noto Sans SC',sans-serif;margin-bottom:4px;color:var(--dark,#0f172a)}
.challenge-card__pinyin{font-size:.95rem;color:var(--teal,#0d9488);font-weight:500;margin-bottom:2px}
.challenge-card__meaning{font-size:.9rem;color:var(--gray,#64748b)}
.challenge-card__extra{font-size:.8rem;color:var(--gray-light,#94a3b8);margin-top:6px}
.challenge-card__actions{margin-top:12px;display:flex;gap:8px}
.challenge-btn{flex:1;padding:8px;border-radius:8px;border:1px solid #e2e8f0;background:#f8fafc;cursor:pointer;font-size:.82rem;font-weight:600;transition:all .2s}
.challenge-btn:hover{background:#e2e8f0}
.challenge-btn.knew{background:#d1fae5;border-color:#6ee7b7;color:#047857}
.challenge-btn.knew:hover{background:#a7f3d0}
.challenge-btn.dunno{background:#fee2e2;border-color:#fca5a5;color:#991b1b}
.challenge-btn.dunno:hover{background:#fecaca}
.challenge-btn:disabled{opacity:.5;cursor:default}
.finish-box{text-align:center;padding:40px;background:linear-gradient(135deg,#f0fdfa,#ccfbf1);border-radius:20px;margin-top:20px}
.finish-box h2{font-size:1.3rem;margin-bottom:8px}
.finish-box p{color:var(--gray,#64748b);margin-bottom:16px}
.progress-bar{height:6px;background:#e2e8f0;border-radius:3px;margin-bottom:24px;overflow:hidden}
.progress-fill{height:100%;background:linear-gradient(90deg,#0d9488,#14b8a6);border-radius:3px;transition:width .5s ease}
@media(max-width:560px){.challenge-card__hanzi{font-size:1.6rem}}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="challenge-page">
<div class="challenge-header">
  <div class="challenge-date"><?= date('d/m/Y') ?></div>
  <h1>Thử thách từ vựng hằng ngày</h1>
  <p>Học 5 từ mới mỗi ngày, củng cố vốn từ vựng tiếng Trung</p>
</div>

<?php if ($done): ?>
<div class="finish-box">
  <h2>Hoàn thành thử thách hôm nay! 🎯</h2>
  <p>Kết quả: <strong><?= $knew ?>/<?= $challengeTotal ?></strong> từ đã biết · +<strong><?= $xp ?></strong> XP</p>
  <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:16px">
    <a href="daily_challenge.php" class="btn btn--primary" style="padding:10px 24px">Thử thách mới</a>
    <?php if ($nextId): ?>
    <a href="lesson_view.php?id=<?= $nextId ?>" class="btn btn--outline" style="padding:10px 24px">Bài tiếp: <?= htmlspecialchars($nextLesson) ?></a>
    <?php endif; ?>
    <a href="flashcard_srs.php" class="btn btn--outline" style="padding:10px 24px">Flashcard SRS</a>
    <a href="study_stats.php" class="btn btn--outline" style="padding:10px 24px">Xem thống kê</a>
  </div>
</div>
<?php elseif (count($challengeVocab) > 0): ?>
<div class="progress-bar">
  <div class="progress-fill" id="progressFill" style="width:0%"></div>
</div>
<form id="challengeForm" method="post" action="daily_challenge_result.php">
<input type="hidden" name="date" value="<?= $today ?>">
<div class="card-grid" id="cardGrid">
<?php foreach ($challengeVocab as $i => $v): ?>
<div class="challenge-card" data-index="<?= $i ?>" id="card<?= $i ?>">
  <input type="hidden" name="vocab_ids[]" value="<?= $v['id'] ?>">
  <input type="hidden" name="results[<?= $v['id'] ?>]" id="result<?= $i ?>" value="pending">
  <div class="challenge-card__hanzi"><?= htmlspecialchars($v['hanzi']) ?></div>
  <div class="challenge-card__pinyin" id="pinyin<?= $i ?>" style="display:none"><?= htmlspecialchars($v['pinyin']) ?></div>
  <div class="challenge-card__meaning" id="meaning<?= $i ?>" style="display:none"><?= htmlspecialchars($v['meaning']) ?></div>
  <?php if ($v['radical']): ?>
  <div class="challenge-card__extra" id="extra<?= $i ?>" style="display:none">Bộ: <?= htmlspecialchars($v['radical']) ?></div>
  <?php endif; ?>
  <?php if ($v['example']): ?>
  <div class="challenge-card__extra" id="example<?= $i ?>" style="display:none">例: <?= htmlspecialchars($v['example']) ?></div>
  <?php endif; ?>
  <div class="challenge-card__actions">
    <button type="button" class="challenge-btn" onclick="reveal(<?= $i ?>)">Xem đáp án</button>
    <button type="button" class="challenge-btn knew" disabled onclick="mark(<?= $i ?>, 'knew')">Đã biết</button>
    <button type="button" class="challenge-btn dunno" disabled onclick="mark(<?= $i ?>, 'dunno')">Chưa biết</button>
  </div>
</div>
<?php endforeach; ?>
</div>
</form>
<?php else: ?>
<div style="text-align:center;padding:60px 20px;margin-top:20px">
  <div style="font-size:4rem;margin-bottom:12px">🎉</div>
  <h2>Bạn đã học hết tất cả từ vựng!</h2>
  <p style="color:var(--gray,#64748b);margin-bottom:20px">Quay lại sau khi có thêm bài học mới.</p>
  <a href="lessons.php" class="btn btn--primary">Học bài mới</a>
</div>
<?php endif; ?>
</main>

<script>
let currentIndex = 0;
const total = <?= count($challengeVocab) ?>;

function reveal(idx) {
    document.getElementById('pinyin' + idx).style.display = 'block';
    document.getElementById('meaning' + idx).style.display = 'block';
    const ex = document.getElementById('example' + idx);
    if (ex) ex.style.display = 'block';
    const ex2 = document.getElementById('extra' + idx);
    if (ex2) ex2.style.display = 'block';
    const card = document.getElementById('card' + idx);
    card.classList.add('revealed');
    // Enable buttons
    card.querySelectorAll('.challenge-btn:not(:first-child)').forEach(b => b.disabled = false);
}

function mark(idx, result) {
    document.getElementById('result' + idx).value = result;
    const card = document.getElementById('card' + idx);
    card.querySelectorAll('.challenge-btn').forEach(b => b.disabled = true);
    if (result === 'knew') {
        card.querySelector('.challenge-btn.knew').classList.add('knew');
    } else {
        card.querySelector('.challenge-btn.dunno').classList.add('dunno');
    }
    currentIndex++;
    document.getElementById('progressFill').style.width = (currentIndex / total * 100) + '%';
    if (currentIndex >= total) {
        const finish = document.getElementById('finishArea');
        finish.style.display = 'block';
        const knew = document.querySelectorAll('input[value="knew"]').length;
        document.getElementById('resultSummary').textContent = 'Bạn đã biết ' + knew + '/' + total + ' từ. Hãy ôn lại những từ chưa nhớ!';
    }
}
// Auto-reveal first card
setTimeout(() => reveal(0), 500);
</script>
</body>
</html>