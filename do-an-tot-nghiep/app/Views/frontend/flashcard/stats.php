<!DOCTYPE html><html lang="vi"><head><meta charset="utf-8">
<title>Thống kê Flashcard | HànNgữ</title>
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
.stats-page{max-width:1000px;margin:auto;padding:104px 24px 64px}
.stats-page h1{font-size:1.8rem;font-weight:800;color:var(--dark);margin-bottom:4px;font-family:var(--font-display);text-align:center}
.stats-page .subtitle{text-align:center;color:var(--gray);font-size:.9rem;margin-bottom:32px}
.stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:32px}
.stat-card{border-radius:16px;padding:24px;background:#fff;box-shadow:var(--shadow);text-align:center}
.stat-card .num{font-size:2.2rem;font-weight:800;color:var(--dark);line-height:1.2}
.stat-card .label{font-size:.85rem;color:var(--gray);margin-top:4px}
.stat-card .sub{font-size:.75rem;color:#94a3b8;margin-top:2px}
.stat-card.primary{border-left:4px solid var(--teal)}
.stat-card.warning{border-left:4px solid var(--coral)}
.stat-card.success{border-left:4px solid var(--emerald)}
.stat-card.info{border-left:4px solid #3b82f6}
.chart-section{background:#fff;border-radius:16px;box-shadow:var(--shadow);padding:24px;margin-bottom:24px}
.chart-section h3{font-size:1.05rem;font-weight:700;color:var(--dark);margin-bottom:16px}
.bar-chart{display:flex;align-items:flex-end;gap:12px;height:160px;padding:0 8px}
.bar-wrapper{flex:1;display:flex;flex-direction:column;align-items:center;height:100%;justify-content:flex-end}
.bar{width:100%;max-width:48px;border-radius:6px 6px 0 0;background:linear-gradient(180deg,var(--teal),#0d9488);min-height:4px;transition:height .4s}
.bar-label{font-size:.75rem;color:var(--gray);margin-top:8px;text-align:center}
.bar-value{font-size:.7rem;color:var(--dark-3);font-weight:600;margin-bottom:4px}
.level-chart{display:flex;flex-wrap:wrap;gap:12px}
.level-bar-item{flex:1;min-width:120px}
.level-bar-header{display:flex;justify-content:space-between;font-size:.85rem;margin-bottom:4px}
.level-bar-header .name{font-weight:600;color:var(--dark)}
.level-bar-header .val{color:var(--gray)}
.level-bar-track{height:8px;background:#f1f5f9;border-radius:99px;overflow:hidden}
.level-bar-fill{height:100%;border-radius:99px;background:linear-gradient(90deg,var(--teal),#0d9488);transition:width .4s}
.donut{width:160px;height:160px;border-radius:50%;position:relative;margin:0 auto 16px}
.donut-center{position:absolute;inset:20px;border-radius:50%;background:#fff;display:flex;flex-direction:column;align-items:center;justify-content:center}
.donut-center .num{font-size:1.6rem;font-weight:800;color:var(--dark)}
.donut-center .label{font-size:.7rem;color:var(--gray)}
.donut-legend{display:flex;justify-content:center;gap:20px;flex-wrap:wrap;font-size:.85rem}
.donut-legend-item{display:flex;align-items:center;gap:6px}
.donut-legend-dot{width:12px;height:12px;border-radius:50%}
.back-link{display:inline-flex;align-items:center;gap:8px;margin-bottom:24px;color:var(--teal);font-weight:600;font-size:.9rem;text-decoration:none}
.back-link:hover{text-decoration:underline}
@media(max-width:640px){
  .stats-page{padding:84px 16px 48px}
  .stats-grid{grid-template-columns:repeat(2,1fr);gap:12px}
  .stat-card .num{font-size:1.6rem}
  .bar-chart{height:120px;gap:8px}
}
</style>
</head><body>
<?php include __DIR__ . '/../../../../sidebar.php'; ?>
<div class="stats-page">
  <a href="flashcard_srs.php" class="back-link">&larr; Quay lại ôn tập</a>
  <h1>Thống kê Flashcard</h1>
  <p class="subtitle">Theo dõi tiến độ học từ vựng của bạn</p>

  <div class="stats-grid">
    <div class="stat-card primary">
      <div class="num"><?=$total?></div>
      <div class="label">Tổng số thẻ</div>
      <div class="sub">Từ vựng đang học</div>
    </div>
    <div class="stat-card warning">
      <div class="num"><?=$dueCount?></div>
      <div class="label">Cần ôn hôm nay</div>
      <div class="sub">Đến hạn ôn tập</div>
    </div>
    <div class="stat-card success">
      <div class="num"><?=$masteredCount?></div>
      <div class="label">Đã ghi nhớ</div>
      <div class="sub">Khoảng cách &ge; 30 ngày</div>
    </div>
    <div class="stat-card info">
      <div class="num"><?=$learningCount?></div>
      <div class="label">Đang học</div>
      <div class="sub">Chưa ghi nhớ hoàn toàn</div>
    </div>
  </div>

  <div class="stats-grid">
    <div class="stat-card primary">
      <div class="num"><?=$totalReviews?></div>
      <div class="label">Tổng lượt ôn tập</div>
      <div class="sub">Tất cả thời gian</div>
    </div>
    <div class="stat-card warning">
      <div class="num"><?=$reviewsToday?></div>
      <div class="label">Ôn tập hôm nay</div>
      <div class="sub">Lượt đã làm</div>
    </div>
    <div class="stat-card info">
      <div class="num"><?=$avgEaseFactor?></div>
      <div class="label">Hệ số dễ EF</div>
      <div class="sub">Trung bình (1.3 - 3.0)</div>
    </div>
    <div class="stat-card success">
      <div class="num"><?=$masteredCount > 0 ? round($masteredCount / max(1, $total) * 100) : 0?>%</div>
      <div class="label">Tỷ lệ ghi nhớ</div>
      <div class="sub">Đã nhớ / Tổng số</div>
    </div>
  </div>

  <div class="chart-section">
    <h3>Phân bố thẻ theo cấp độ HSK</h3>
    <div class="level-chart">
      <?php
      $maxLevelCount = 1;
      foreach ($cardsByLevelData as $d) {
          if ($d['count'] > $maxLevelCount) $maxLevelCount = $d['count'];
      }
      $colors = ['#0d9488','#f97316','#10b981','#3b82f6','#8b5cf6','#ec4899'];
      ?>
      <?php foreach ($cardsByLevelData as $i => $d): ?>
      <div class="level-bar-item">
        <div class="level-bar-header">
          <span class="name">HSK <?=$d['level']?></span>
          <span class="val"><?=$d['count']?> thẻ</span>
        </div>
        <div class="level-bar-track">
          <div class="level-bar-fill" style="width:<?=round($d['count']/$maxLevelCount*100)?>%;background:<?=$colors[$i % count($colors)]?>"></div>
        </div>
      </div>
      <?php endforeach; ?>
      <?php if (empty($cardsByLevelData)): ?>
      <p style="color:var(--gray);text-align:center;width:100%;padding:20px 0">Chưa có dữ liệu. Hãy bắt đầu học thêm thẻ mới!</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="chart-section">
    <h3>Ôn tập 7 ngày gần đây</h3>
    <?php
    $reviewDates = [];
    foreach ($reviewsByDayData as $d) {
        $reviewDates[$d['day']] = (int)$d['count'];
    }
    $maxReview = 1;
    foreach ($reviewDates as $c) { if ($c > $maxReview) $maxReview = $c; }
    $dayLabels = [];
    for ($i = 6; $i >= 0; $i--) {
        $dayLabels[] = date('Y-m-d', strtotime("-$i days"));
    }
    ?>
    <div class="bar-chart">
      <?php foreach ($dayLabels as $day): ?>
      <div class="bar-wrapper">
        <div class="bar-value"><?=$reviewDates[$day] ?? 0?></div>
        <div class="bar" style="height:<?=round(($reviewDates[$day] ?? 0) / $maxReview * 150)?>px"></div>
        <div class="bar-label"><?=date('d/m', strtotime($day))?></div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php if(empty($reviewsByDayData)): ?>
    <p style="color:var(--gray);text-align:center;padding:20px 0">Chưa có lượt ôn tập nào trong 7 ngày qua.</p>
    <?php endif; ?>
  </div>

  <div class="chart-section" style="text-align:center">
    <h3>Tổng quan bộ nhớ</h3>
    <?php
    $pctMastered = $total > 0 ? round($masteredCount / $total * 100) : 0;
    $pctLearning = $total > 0 ? round($learningCount / $total * 100) : 0;
    $conicGrad = "conic-gradient(#047857 0% {$pctMastered}%, #0d9488 {$pctMastered}% " . ($pctMastered + $pctLearning) . "%, #e2e8f0 " . ($pctMastered + $pctLearning) . "% 100%)";
    ?>
    <div class="donut" style="background:<?=$conicGrad?>">
      <div class="donut-center">
        <div class="num"><?=$total?></div>
        <div class="label">Tổng thẻ</div>
      </div>
    </div>
    <div class="donut-legend">
      <div class="donut-legend-item">
        <div class="donut-legend-dot" style="background:#047857"></div>
        <span>Đã nhớ (<?=$masteredCount?>)</span>
      </div>
      <div class="donut-legend-item">
        <div class="donut-legend-dot" style="background:#0d9488"></div>
        <span>Đang học (<?=$learningCount?>)</span>
      </div>
      <div class="donut-legend-item">
        <div class="donut-legend-dot" style="background:#e2e8f0"></div>
        <span>Chưa học</span>
      </div>
    </div>
  </div>
</div>
<script src="utils.js"></script>
<script src="init.js"></script>
</body></html>
