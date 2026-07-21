<!DOCTYPE html><html lang="vi"><head><meta charset="utf-8">
<title>Flashcard SRS | HànNgữ</title>
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
:root{--card-width:380px;--card-height:260px}
.flashcard-container{max-width:900px;margin:auto;padding:104px 24px 64px}
.flashcard-header{text-align:center;margin-bottom:24px}
.flashcard-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);margin-bottom:4px;font-family:var(--font-display)}
.flashcard-header p{color:var(--gray);font-size:.9rem}
.flashcard-stats{display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin:16px 0}
.stat-pill{padding:8px 20px;border-radius:99px;font-weight:700;font-size:.9rem}
.stat-pill.due{background:#fef3c7;color:#b45309}
.stat-pill.total{background:#dbeafe;color:#1d4ed8}
.stat-pill.mastered{background:#d1fae5;color:#047857}
.level-tabs{display:flex;gap:8px;justify-content:center;flex-wrap:wrap;margin-bottom:24px}
.level-tabs .filter-tab{padding:8px 20px;border:2px solid var(--gray-light);border-radius:50px;background:#fff;font-size:.85rem;font-weight:600;cursor:pointer;transition:var(--transition);text-decoration:none;color:var(--dark-3);font-family:var(--font-sans)}
.level-tabs .filter-tab:hover{border-color:var(--teal);color:var(--teal)}
.level-tabs .filter-tab.active{background:var(--teal);border-color:var(--teal);color:#fff;box-shadow:0 4px 16px rgba(13,148,136,.3)}
.card-container{perspective:1000px;display:flex;justify-content:center;margin:32px 0}
.flashcard{width:var(--card-width);height:var(--card-height);position:relative;transform-style:preserve-3d;transition:transform .5s;cursor:pointer}
.flashcard.flipped{transform:rotateY(180deg)}
.card-face{position:absolute;width:100%;height:100%;backface-visibility:hidden;border-radius:20px;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px;box-shadow:0 10px 40px rgba(0,0,0,.12);box-sizing:border-box}
.card-front{background:linear-gradient(135deg,#0f766e,#134e4a);color:#fff}
.card-front .hanzi{font-size:3.5rem;font-weight:700;margin-bottom:16px;letter-spacing:4px;font-family:var(--font-hanzi)}
.card-front .hint{font-size:.85rem;opacity:.7}
.card-back{background:#fff;color:#1e293b;transform:rotateY(180deg);border:1px solid #e2e8f0}
.card-back .pinyin{font-size:1.5rem;color:var(--teal);margin-bottom:8px;font-weight:600}
.card-back .meaning{font-size:1.2rem;font-weight:600;margin-bottom:12px;color:var(--dark)}
.card-back .example{font-size:.9rem;color:#64748b;line-height:1.6;text-align:center}
.card-back .example-vi{font-size:.85rem;color:#94a3b8;margin-top:4px;text-align:center}
.quality-buttons{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-top:24px}
.quality-btn{padding:14px 24px;border-radius:12px;border:0;font-weight:700;font-size:.9rem;cursor:pointer;transition:.15s;min-width:80px;font-family:var(--font-sans)}
.quality-btn.again{background:#fee2e2;color:#b91c1c}
.quality-btn.hard{background:#fef3c7;color:#b45309}
.quality-btn.good{background:#dbeafe;color:#1d4ed8}
.quality-btn.easy{background:#d1fae5;color:#047857}
.quality-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,.15)}
.quality-btn:disabled{opacity:.5;cursor:not-allowed;transform:none}
.progress-bar{height:6px;background:#e2e8f0;border-radius:99px;overflow:hidden;margin:16px 0}
.progress-fill{height:100%;background:linear-gradient(90deg,var(--teal),#0d9488);border-radius:99px;transition:width .3s}
.progress-label{text-align:center;color:#64748b;font-size:.85rem;margin-top:-8px}
.add-panel{background:#f8fafc;border:1px solid #e2e8f0;border-radius:16px;padding:20px;margin-top:24px}
.add-panel h3{margin:0 0 12px;color:#102a56;font-size:1rem}
.word-chips{display:flex;flex-wrap:wrap;gap:8px}
.word-chip{padding:6px 14px;border-radius:99px;background:#fff;border:1px solid #dbeafe;font-size:.85rem;cursor:pointer;transition:.15s}
.word-chip:hover{background:#dbeafe;border-color:var(--teal)}
.keyboard-hints{text-align:center;margin-top:16px;font-size:.8rem;color:#94a3b8}
.kbd{display:inline-block;padding:2px 8px;background:#f1f5f9;border-radius:4px;font-family:monospace;font-size:.75rem;border:1px solid #e2e8f0;margin:0 2px}
.admin-table{width:100%;border-collapse:collapse;font-size:.85rem}
.admin-table th{text-align:left;padding:8px 12px;background:#f1f5f9;color:var(--dark-3);font-weight:600;border-bottom:2px solid #e2e8f0}
.admin-table td{padding:8px 12px;border-bottom:1px solid #f1f5f9}
.btn--small{padding:6px 14px;font-size:.8rem;border-radius:8px}
.empty-state{text-align:center;padding:60px 0;color:#64748b}
.empty-state .icon{font-size:3rem;margin-bottom:16px}
.empty-state h3{color:var(--dark);margin-bottom:8px}
@media(max-width:640px){
  :root{--card-width:300px;--card-height:220px}
  .card-front .hanzi{font-size:2.5rem}
  .flashcard-container{padding:84px 16px 48px}
  .quality-btn{min-width:64px;padding:12px 16px;font-size:.8rem}
}
</style>
</head><body>
<?php include __DIR__ . '/../../../../sidebar.php'; ?>
<div class="flashcard-container">
  <div class="flashcard-header">
    <h1>Flashcard SRS</h1>
    <p>Học từ vựng với thuật toán lặp lại ngắt quãng (SM-2)</p>
  </div>

  <div class="flashcard-stats">
    <span class="stat-pill total">Tổng: <?=$total?></span>
    <span class="stat-pill due">Hôm nay: <?=$dueCount?></span>
    <span class="stat-pill mastered">Đã nhớ: <?=$masteredCount?></span>
  </div>

  <div class="level-tabs">
    <a href="flashcard_srs.php" class="filter-tab <?=$level==0?'active':''?>">Tất cả</a>
    <?php for($i=1;$i<=6;$i++): ?>
    <a href="flashcard_srs.php?level=<?=$i?>" class="filter-tab <?=$level==$i?'active':''?>">HSK <?=$i?></a>
    <?php endfor; ?>
    <a href="flashcard_srs.php?action=stats" class="filter-tab">Thống kê</a>
  </div>

  <?php if(count($cards) > 0):
    $total = count($cards);
    $current = 1;
  ?>
  <div class="progress-bar">
    <div class="progress-fill" id="progressFill" style="width:<?=$current/$total*100?>%"></div>
  </div>
  <div class="progress-label" id="progressLabel"><?=$current?> / <?=$total?></div>

  <div class="card-container">
    <div class="flashcard" id="flashcard" onclick="this.classList.toggle('flipped')">
      <div class="card-face card-front">
        <div class="hanzi" id="cardHanzi"><?=htmlspecialchars($cards[0]['hanzi'])?></div>
        <div class="hint">Nhấn để xem đáp án</div>
      </div>
      <div class="card-face card-back">
        <div class="pinyin" id="cardPinyin"><?=htmlspecialchars($cards[0]['pinyin'])?></div>
        <div class="meaning" id="cardMeaning"><?=htmlspecialchars($cards[0]['meaning'])?></div>
        <?php if($cards[0]['example']): ?>
        <div class="example" id="cardExample"><?=htmlspecialchars($cards[0]['example'])?></div>
        <?php endif; ?>
        <?php if($cards[0]['example_vi']): ?>
        <div class="example-vi" id="cardExampleVi"><?=htmlspecialchars($cards[0]['example_vi'])?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="quality-buttons" id="qualityBtns">
    <button class="quality-btn again" onclick="rate(0)">Again</button>
    <button class="quality-btn hard" onclick="rate(2)">Hard</button>
    <button class="quality-btn good" onclick="rate(4)">Good</button>
    <button class="quality-btn easy" onclick="rate(5)">Easy</button>
  </div>

  <div class="keyboard-hints">
    <span class="kbd">1</span> Again &nbsp;
    <span class="kbd">2</span> Hard &nbsp;
    <span class="kbd">3</span> Good &nbsp;
    <span class="kbd">4</span> Easy &nbsp;
    <span class="kbd">Space</span> Flip
  </div>

  <?php else: ?>
  <div class="empty-state">
    <div class="icon">&#127881;</div>
    <h3>Tuyệt vời! Bạn đã học xong tất cả từ hôm nay.</h3>
    <p>Quay lại sau để ôn tập tiếp hoặc thêm từ mới bên dưới.</p>
  </div>
  <?php endif; ?>

  <?php if(count($newWords) > 0): ?>
  <div class="add-panel">
    <h3>+ Thêm từ mới để học</h3>
    <form method="post" action="flashcard_srs.php?action=add" style="margin:0">
      <input type="hidden" name="level" value="<?=$level?>">
      <table class="admin-table">
        <tr><th>Chữ</th><th>Pinyin</th><th>Nghĩa</th><th>HSK</th><th></th></tr>
        <?php foreach($newWords as $w): ?>
        <tr>
          <td style="font-weight:700;font-family:var(--font-hanzi)"><?=htmlspecialchars($w['hanzi'])?></td>
          <td><?=htmlspecialchars($w['pinyin'])?></td>
          <td><?=htmlspecialchars($w['meaning'])?></td>
          <td><?=$w['level']?></td>
          <td><button type="submit" name="vocab_id" value="<?=$w['id']?>" class="btn btn--small btn--primary">+ Thêm</button></td>
        </tr>
        <?php endforeach; ?>
      </table>
    </form>
  </div>
  <?php endif; ?>
</div>

<script>
const cards = <?=json_encode(array_map(function($c) {
    return [
        'id' => (int)$c['id'],
        'hanzi' => $c['hanzi'],
        'pinyin' => $c['pinyin'],
        'meaning' => $c['meaning'],
        'example' => $c['example'] ?? '',
        'example_vi' => $c['example_vi'] ?? ''
    ];
}, $cards))?>;

let currentIndex = 0;
const total = cards.length;

function speak(text) {
    if ('speechSynthesis' in window) {
        speechSynthesis.cancel();
        const u = new SpeechSynthesisUtterance(text);
        u.lang = 'zh-CN';
        u.rate = 0.75;
        const v = speechSynthesis.getVoices().find(v => /^zh/i.test(v.lang));
        if (v) u.voice = v;
        speechSynthesis.speak(u);
    }
}

function showCard(index) {
    const card = cards[index];
    if (!card) return;
    document.getElementById('cardHanzi').textContent = card.hanzi;
    document.getElementById('cardPinyin').textContent = card.pinyin;
    document.getElementById('cardMeaning').textContent = card.meaning;
    document.getElementById('cardExample').textContent = card.example || '';
    document.getElementById('cardExampleVi').textContent = card.example_vi || '';
    document.getElementById('flashcard').classList.remove('flipped');
    document.getElementById('progressFill').style.width = ((index + 1) / total * 100) + '%';
    document.getElementById('progressLabel').textContent = (index + 1) + ' / ' + total;
    speak(card.hanzi);
}

function rate(quality) {
    if (currentIndex >= total) return;
    const card = cards[currentIndex];

    fetch('flashcard_srs.php?action=review', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'id=' + card.id + '&quality=' + quality
    }).then(r => r.json()).then(() => {
        currentIndex++;
        if (currentIndex < total) {
            setTimeout(() => showCard(currentIndex), 300);
        } else {
            location.reload();
        }
    });
}

document.addEventListener('keydown', function(e) {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    if (e.key === ' ') {
        e.preventDefault();
        document.getElementById('flashcard')?.classList.toggle('flipped');
    } else if (e.key === '1') { document.querySelector('.quality-btn.again')?.click(); }
    else if (e.key === '2') { document.querySelector('.quality-btn.hard')?.click(); }
    else if (e.key === '3') { document.querySelector('.quality-btn.good')?.click(); }
    else if (e.key === '4') { document.querySelector('.quality-btn.easy')?.click(); }
});

if (cards.length > 0) {
    setTimeout(() => speak(cards[0].hanzi), 500);
    // Load voices
    if ('speechSynthesis' in window) speechSynthesis.getVoices();
}
</script>
<script src="utils.js"></script>
<script src="init.js"></script>
</body></html>
