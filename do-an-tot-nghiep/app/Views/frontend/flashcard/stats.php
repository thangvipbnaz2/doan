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
