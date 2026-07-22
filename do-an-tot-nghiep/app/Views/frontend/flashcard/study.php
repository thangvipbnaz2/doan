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
