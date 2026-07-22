<main class="dict-container">
  <div class="dict-hero">
    <h1>Từ điển Trung - Việt</h1>
    <p>Tra cứu Hán tự, Pinyin, và nghĩa tiếng Việt</p>
  </div>

  <form method="get" action="dictionary_mvc.php">
    <div class="search-type-tabs">
      <button type="submit" name="type" value="hanzi" class="search-type-tab <?=$type==='hanzi'?'active':''?>">Hán tự</button>
      <button type="submit" name="type" value="pinyin" class="search-type-tab <?=$type==='pinyin'?'active':''?>">Pinyin</button>
      <button type="submit" name="type" value="vietnamese" class="search-type-tab <?=$type==='vietnamese'?'active':''?>">Tiếng Việt</button>
    </div>
    <div class="search-box">
      <input type="text" name="q" value="<?=htmlspecialchars($query)?>" placeholder="<?php
        switch($type) {
          case 'hanzi': echo 'Nhập chữ Hán...'; break;
          case 'pinyin': echo 'Nhập pinyin...'; break;
          case 'vietnamese': echo 'Nhập tiếng Việt...'; break;
        }
      ?>" autofocus>
      <button type="submit" class="search-btn">Tìm</button>
    </div>
  </form>

  <?php if($recentSearches && !$query): ?>
  <div class="recent-searches">
    <span style="font-size:.8rem;color:#94a3b8;padding-top:4px">Gần đây:</span>
    <?php foreach($recentSearches as $r): ?>
    <a href="dictionary_mvc.php?q=<?=urlencode($r['query'])?>&type=<?=$r['result_type']?>" class="recent-tag"><?=htmlspecialchars($r['query'])?></a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php if($query): ?>
  <div style="margin-bottom:12px;font-size:.85rem;color:#64748b">
    Tìm thấy <strong><?=$total?></strong> kết quả cho "<?=htmlspecialchars($query)?>"
  </div>
  <?php endif; ?>

  <div class="dict-layout">
    <div class="dict-results">
      <?php foreach($results as $v): ?>
      <div class="vocab-result-card">
        <div class="hanzi"><?=htmlspecialchars($v['hanzi'])?></div>
        <div class="info">
          <div class="pinyin"><?=htmlspecialchars($v['pinyin'])?></div>
          <div class="meaning"><?=htmlspecialchars($v['meaning'])?></div>
          <div class="meta">
            <span class="badge">HSK <?=$v['level']?></span>
            <?php if($v['radical']): ?><span class="badge">Bộ: <?=htmlspecialchars($v['radical'])?></span><?php endif; ?>
            <?php if($v['strokes']): ?><span class="badge"><?=$v['strokes']?> nét</span><?php endif; ?>
          </div>
        </div>
        <div class="actions">
          <button class="btn-play" onclick="speak('<?=htmlspecialchars($v['hanzi'], ENT_QUOTES)?>')" title="Nghe">▶</button>
          <button class="btn-flash" onclick="addFlashcard(<?=$v['id']?>)" title="Thêm flashcard">+</button>
          <?php if($v['lesson_id']): ?>
          <a href="lesson_view.php?id=<?=$v['lesson_id']?>" class="btn-lesson" style="text-decoration:none;display:flex;align-items:center;justify-content:center" title="Xem bài học">📖</a>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>

      <?php if(count($results) == 0 && $query): ?>
      <div style="text-align:center;padding:60px 0;color:#64748b">
        <div style="font-size:3rem;margin-bottom:12px">🔍</div>
        <h3>Không tìm thấy kết quả</h3>
        <p>Thử tìm kiếm với từ khóa khác hoặc chọn loại tìm kiếm khác.</p>
      </div>
      <?php endif; ?>

      <?php if($total > $perPage): ?>
      <div class="pagination">
        <?php $lastPage = ceil($total/$perPage); for($p=1;$p<=$lastPage;$p++): ?>
        <a href="dictionary_mvc.php?q=<?=urlencode($query)?>&type=<?=$type?>&page=<?=$p?>" class="page-link <?=$p==$page?'active':''?>"><?=$p?></a>
        <?php endfor; ?>
      </div>
      <?php endif; ?>
    </div>

    <div>
      <?php if($radicalInfo): ?>
      <div class="radical-panel">
        <h3>🔤 Thông tin bộ thủ</h3>
        <div class="radical-display"><?=htmlspecialchars($radicalInfo['char'])?></div>
        <div class="radical-info">
          <strong>Tên:</strong> <?=htmlspecialchars($radicalInfo['name'])?><br>
          <strong>Tên Việt:</strong> <?=htmlspecialchars($radicalInfo['name_vietnamese'])?><br>
          <strong>Số nét:</strong> <?=$radicalInfo['strokes']?><br>
          <strong>Phân loại:</strong> <?=htmlspecialchars($radicalInfo['category'] ?? 'Không')?><br>
          <?php if($radicalInfo['examples']): ?>
          <strong>Ví dụ:</strong> <?=htmlspecialchars($radicalInfo['examples'])?>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>

      <div class="radical-panel">
        <h3>🔤 Bộ thủ</h3>
        <div class="radical-categories">
          <?php foreach($radicalsByCategory as $cat => $rlist): ?>
          <div class="radical-cat">
            <h4><?=htmlspecialchars($cat)?></h4>
            <div class="radical-grid">
              <?php foreach($rlist as $r): ?>
              <a href="dictionary_mvc.php?q=<?=urlencode($r['char'])?>&type=hanzi" class="radical-item" title="<?=htmlspecialchars($r['name_vietnamese'])?>"><?=htmlspecialchars($r['char'])?></a>
              <?php endforeach; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
function speak(text) {
    if (!window.speechSynthesis) return;
    speechSynthesis.cancel();
    var u = new SpeechSynthesisUtterance(text);
    u.lang = 'zh-CN';
    u.rate = 0.75;
    var v = speechSynthesis.getVoices().find(function(v) { return /^zh/i.test(v.lang); });
    if (v) u.voice = v;
    speechSynthesis.speak(u);
}

function addFlashcard(vocabId) {
    fetch('flashcard_srs.php?action=add', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'vocab_id=' + vocabId
    }).then(function() {
        showToast('Đã thêm vào flashcard!', 'success');
    });
}

if ('speechSynthesis' in window) {
    speechSynthesis.onvoiceschanged = function() { speechSynthesis.getVoices(); };
}
</script>
