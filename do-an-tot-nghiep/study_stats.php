<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) { header('Location: login.php'); exit; }

// Stats queries
$lp = $conn->prepare("SELECT COUNT(*) as total, SUM(is_completed) as done FROM lesson_progress WHERE user_id = ?");
$lp->execute([$userId]); $lpData = $lp->fetch();

$vp = $conn->prepare("SELECT COUNT(*) as total, SUM(learned) as done FROM vocab_progress WHERE user_id = ?");
$vp->execute([$userId]); $vpData = $vp->fetch();

$sl = $conn->prepare("SELECT activity_type, COUNT(*) as cnt, SUM(duration_seconds) as dur, AVG(score) as avg_score FROM study_logs WHERE user_id = ? GROUP BY activity_type");
$sl->execute([$userId]); $studyLogs = $sl->fetchAll();

$slDaily = $conn->prepare("SELECT DATE(completed_at) as dt, COUNT(*) as cnt, SUM(duration_seconds) as dur FROM study_logs WHERE user_id = ? AND completed_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) GROUP BY DATE(completed_at) ORDER BY dt");
$slDaily->execute([$userId]); $dailyActivity = $slDaily->fetchAll();

$er = $conn->prepare("SELECT AVG(score/max_score*100) as avg_s, COUNT(*) as total FROM exercise_results WHERE user_id = ?");
$er->execute([$userId]); $erData = $er->fetch();

$st = $conn->prepare("SELECT streak_days, last_activity_date FROM user_streaks WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$st->execute([$userId]); $streak = $st->fetch();

$up = $conn->prepare("SELECT total_xp, level, vocab_mastered, grammar_mastered, exams_passed FROM user_progress WHERE user_id = ? ORDER BY id DESC LIMIT 1");
$up->execute([$userId]); $prog = $up->fetch();

$ac = $conn->prepare("SELECT COUNT(*) as cnt FROM user_achievements WHERE user_id = ?");
$ac->execute([$userId]); $achCount = $ac->fetchColumn();

$totLessons = $conn->query("SELECT COUNT(*) FROM lessons")->fetchColumn();
$totVocab = $conn->query("SELECT COUNT(*) FROM vocab")->fetchColumn();

// Study hours by day of week
$dayOfWeek = [0,0,0,0,0,0,0];
$dayNames = ['CN','T2','T3','T4','T5','T6','T7'];
foreach ($dailyActivity as $d) {
    $ts = strtotime($d['dt']);
    $dow = (int)date('w', $ts);
    $dayOfWeek[$dow] += (int)$d['dur'];
}
$maxDow = max($dayOfWeek) ?: 1;

// Recent exercise scores (last 10)
$erRecent = $conn->prepare("SELECT score, max_score, completed_at FROM exercise_results WHERE user_id = ? ORDER BY completed_at DESC LIMIT 10");
$erRecent->execute([$userId]); $recentScores = $erRecent->fetchAll();
$recentScores = array_reverse($recentScores);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Thống kê học tập | HànNgữ</title>
<link rel="icon" type="image/svg+xml" href="favicon.svg">
<link rel="stylesheet" href="style.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
.stats-page{max-width:1100px;margin:auto;padding:105px 24px 64px}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:30px}
.stat-card{border-radius:16px;padding:22px;color:#fff}
.stat-card__num{font-size:2rem;font-weight:800;line-height:1.2}
.stat-card__label{font-size:.8rem;opacity:.85;margin-top:4px}
.chart-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:24px}
.chart-card{background:var(--white,#fff);border-radius:16px;padding:22px;box-shadow:0 4px 20px rgba(0,0,0,.06);border:1px solid #eef2f7}
.chart-card.full{grid-column:1/-1}
.chart-card h3{font-size:.95rem;font-weight:700;margin-bottom:14px;color:var(--dark,#0f172a)}
.chart-card canvas{max-height:260px}
.activity-list{display:flex;flex-wrap:wrap;gap:6px}
.activity-dot{width:14px;height:14px;border-radius:3px}
.activity-dot--0{background:#f1f5f9}
.activity-dot--1{background:#bbf7d0}
.activity-dot--2{background:#86efac}
.activity-dot--3{background:#4ade80}
.activity-dot--4{background:#22c55e}
.day-bar{display:flex;align-items:center;gap:10px;margin:6px 0}
.day-bar__label{width:28px;font-size:.8rem;color:var(--gray,#64748b);text-align:right}
.day-bar__track{flex:1;height:22px;background:#f1f5f9;border-radius:6px;overflow:hidden}
.day-bar__fill{height:100%;border-radius:6px;background:linear-gradient(90deg,#0d9488,#14b8a6);transition:width .4s}
@media(max-width:720px){.chart-grid{grid-template-columns:1fr}}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="stats-page">
<h1 style="font-size:1.6rem;margin-bottom:6px">Thống kê học tập</h1>
<p style="color:var(--gray,#64748b);margin-bottom:22px">Theo dõi quá trình học tiếng Trung của bạn</p>

<div class="stats-grid">
  <div class="stat-card" style="background:linear-gradient(135deg,#0d9488,#0f766e)">
    <div class="stat-card__num"><?= (int)($lpData['done']??0) ?><small style="font-size:.9rem;opacity:.7">/<?= $totLessons ?></small></div>
    <div class="stat-card__label">Bài học đã hoàn thành</div>
  </div>
  <div class="stat-card" style="background:linear-gradient(135deg,#f97316,#ea580c)">
    <div class="stat-card__num"><?= (int)($vpData['done']??0) ?><small style="font-size:.9rem;opacity:.7">/<?= $totVocab ?></small></div>
    <div class="stat-card__label">Từ vựng đã học</div>
  </div>
  <div class="stat-card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed)">
    <div class="stat-card__num"><?= (int)($prog['total_xp']??0) ?></div>
    <div class="stat-card__label">Tổng XP</div>
  </div>
  <div class="stat-card" style="background:linear-gradient(135deg,#10b981,#047857)">
    <div class="stat-card__num"><?= (int)($streak['streak_days']??0) ?></div>
    <div class="stat-card__label">Streak hiện tại (ngày)</div>
  </div>
  <div class="stat-card" style="background:linear-gradient(135deg,#ec4899,#db2777)">
    <div class="stat-card__num"><?= round($erData['avg_s']??0) ?>%</div>
    <div class="stat-card__label">Điểm bài tập Tb</div>
  </div>
  <div class="stat-card" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">
    <div class="stat-card__num"><?= (int)$achCount ?></div>
    <div class="stat-card__label">Huy hiệu đã đạt</div>
  </div>
</div>

<div class="chart-grid">
  <div class="chart-card">
    <h3>Hoạt động 30 ngày qua</h3>
    <canvas id="dailyChart"></canvas>
  </div>
  <div class="chart-card">
    <h3>Phân bố thời gian theo loại</h3>
    <canvas id="typeChart"></canvas>
  </div>
  <div class="chart-card">
    <h3>Thời gian học theo ngày trong tuần</h3>
    <?php foreach ($dayOfWeek as $i => $d): ?>
    <div class="day-bar">
      <span class="day-bar__label"><?= $dayNames[$i] ?></span>
      <div class="day-bar__track">
        <div class="day-bar__fill" style="width:<?= round($d/$maxDow*100) ?>%"></div>
      </div>
      <span style="font-size:.8rem;color:#64748b;width:60px;text-align:right"><?= $d>3600 ? round($d/3600,1).'h' : round($d/60).'p' ?></span>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="chart-card">
    <h3>Điểm bài tập gần đây</h3>
    <canvas id="scoreChart"></canvas>
  </div>
  <?php if (!empty($studyLogs)): ?>
  <div class="chart-card full">
    <h3>Chi tiết hoạt động học tập</h3>
    <div style="overflow-x:auto">
    <table style="width:100%;border-collapse:collapse;font-size:.85rem">
      <thead><tr style="border-bottom:2px solid #e2e8f0">
        <th style="text-align:left;padding:10px 8px">Loại</th>
        <th style="text-align:right;padding:10px 8px">Số lượt</th>
        <th style="text-align:right;padding:10px 8px">Thời gian</th>
        <th style="text-align:right;padding:10px 8px">Điểm Tb</th>
      </tr></thead>
      <tbody>
      <?php 
      $typeLabels = ['lesson'=>'Bài học','vocab'=>'Từ vựng','grammar'=>'Ngữ pháp','dialogue'=>'Hội thoại','reading'=>'Đọc hiểu','listening'=>'Nghe','speaking'=>'Nói','writing'=>'Viết','flashcard'=>'Flashcard','quiz'=>'Kiểm tra','exam'=>'Thi'];
      foreach ($studyLogs as $s): ?>
      <tr style="border-bottom:1px solid #f1f5f9">
        <td style="padding:10px 8px"><?= $typeLabels[$s['activity_type']]??$s['activity_type'] ?></td>
        <td style="text-align:right;padding:10px 8px;font-weight:600"><?= $s['cnt'] ?></td>
        <td style="text-align:right;padding:10px 8px"><?= $s['dur']>3600 ? round($s['dur']/3600,1).'h' : round($s['dur']/60).'p' ?></td>
        <td style="text-align:right;padding:10px 8px"><?= $s['avg_score'] ? round($s['avg_score']).'%' : '-' ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody></table>
    </div>
  </div>
  <?php endif; ?>
</div>

<div style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap">
  <a href="lessons.php" class="btn btn--primary" style="padding:10px 24px">Tiếp tục học</a>
  <a href="flashcard_srs.php" class="btn btn--outline" style="padding:10px 24px">Ôn tập flashcard</a>
  <a href="exam_mvc.php" class="btn btn--outline" style="padding:10px 24px">Thi thử HSK</a>
</div>
</main>

<script>
<?php
$dailyLabels = []; $dailyCounts = []; $dailyDurs = [];
foreach ($dailyActivity as $d) {
    $dailyLabels[] = date('d/m', strtotime($d['dt']));
    $dailyCounts[] = (int)$d['cnt'];
    $dailyDurs[] = round((int)$d['dur']/60);
}

$typeLabelsAr = []; $typeDursAr = [];
foreach ($studyLogs as $s) {
    $typeLabelsAr[] = $typeLabels[$s['activity_type']]??$s['activity_type'];
    $typeDursAr[] = round((int)$s['dur']/60);
}

$scoreLabels = []; $scoreValues = [];
foreach ($recentScores as $s) {
    $scoreLabels[] = date('d/m', strtotime($s['completed_at']));
    $scoreValues[] = $s['max_score'] > 0 ? round($s['score']/$s['max_score']*100) : 0;
}
?>

new Chart(document.getElementById('dailyChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($dailyLabels) ?>,
        datasets: [{
            label: 'Phút',
            data: <?= json_encode($dailyDurs) ?>,
            backgroundColor: 'rgba(13,148,136,.65)',
            borderColor: '#0d9488',
            borderWidth: 1,
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 10 } },
            x: { ticks: { maxRotation: 0, font: { size: 10 } } }
        }
    }
});

new Chart(document.getElementById('typeChart'), {
    type: 'doughnut',
    data: {
        labels: <?= json_encode($typeLabelsAr) ?>,
        datasets: [{
            data: <?= json_encode($typeDursAr) ?>,
            backgroundColor: ['#0d9488','#f97316','#8b5cf6','#10b981','#06b6d4','#ec4899','#eab308','#6366f1','#f43f5e','#14b8a6','#a855f7']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom', labels: { boxWidth: 12, padding: 12, font: { size: 11 } } }
        }
    }
});

new Chart(document.getElementById('scoreChart'), {
    type: 'line',
    data: {
        labels: <?= json_encode($scoreLabels) ?>,
        datasets: [{
            label: 'Điểm %',
            data: <?= json_encode($scoreValues) ?>,
            borderColor: '#0d9488',
            backgroundColor: 'rgba(13,148,136,.1)',
            fill: true,
            tension: .3,
            pointRadius: 4,
            pointBackgroundColor: '#0d9488'
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, max: 100, ticks: { stepSize: 20 } }
        }
    }
});
</script>
</body>
</html>