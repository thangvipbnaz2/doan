<!DOCTYPE html><html lang="vi"><head><meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="favicon.png">
<title>Từ điển Trung - Việt | HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
.dict-container{max-width:1120px;margin:auto;padding:104px 24px 64px}
.dict-hero{background:linear-gradient(135deg,#0f766e,#134e4a);color:#fff;border-radius:24px;padding:32px;text-align:center;margin-bottom:24px}
.dict-hero h1{margin:0 0 8px;font-size:2rem}
.dict-hero p{margin:0;color:#d1fae5;font-size:.9rem}
.search-box{display:flex;gap:0;margin:24px auto;max-width:640px}
.search-box input{flex:1;padding:14px 18px;border:2px solid #e2e8f0;border-radius:12px 0 0 12px;font-size:1rem;outline:0;transition:.15s}
.search-box input:focus{border-color:var(--teal)}
.search-box button{padding:14px 28px;border:0;font-weight:700;cursor:pointer;font-size:1rem}
.search-box .search-btn{background:var(--teal);color:#fff;border-radius:0 12px 12px 0}
.search-box .search-btn:hover{background:#0d9488}
.search-type-tabs{display:flex;gap:0;margin:0 auto 24px;max-width:640px;border-radius:10px;overflow:hidden;border:1px solid #e2e8f0}
.search-type-tab{flex:1;padding:10px;text-align:center;cursor:pointer;background:#fff;font-size:.85rem;font-weight:600;transition:.15s;border:0;color:#475569}
.search-type-tab:hover{background:#f8fafc}
.search-type-tab.active{background:var(--teal);color:#fff}
.dict-layout{display:grid;grid-template-columns:minmax(0,1fr) 300px;gap:24px}
.dict-results{min-height:400px}
.vocab-result-card{display:flex;align-items:center;gap:16px;padding:16px;border:1px solid #e2e8f0;border-radius:12px;margin-bottom:10px;background:#fff;transition:.15s}
.vocab-result-card:hover{box-shadow:0 2px 12px rgba(0,0,0,.06)}
.vocab-result-card .hanzi{font-size:1.5rem;font-weight:700;min-width:80px;text-align:center;color:#102a56}
.vocab-result-card .info{flex:1}
.vocab-result-card .pinyin{color:var(--teal);font-weight:600}
.vocab-result-card .meaning{color:#475569;font-size:.85rem}
.vocab-result-card .meta{display:flex;gap:8px;margin-top:4px}
.vocab-result-card .badge{font-size:.7rem;padding:2px 8px;border-radius:99px;background:#f1f5f9;color:#475569}
.vocab-result-card .actions{display:flex;gap:6px}
.vocab-result-card .actions button{width:32px;height:32px;border-radius:50%;border:0;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;transition:.15s}
.btn-play{background:#ecfdf5;color:#047857}
.btn-play:hover{background:#bbf7d0}
.btn-flash{background:#fef3c7;color:#b45309}
.btn-flash:hover{background:#fde68a}
.btn-lesson{background:#dbeafe;color:#1d4ed8}
.btn-lesson:hover{background:#bfdbfe}
.radical-panel{background:#f8fafc;border-radius:16px;padding:20px;border:1px solid #e2e8f0;margin-bottom:16px}
.radical-panel h3{margin:0 0 12px;color:#102a56;font-size:1rem}
.radical-display{text-align:center;font-size:3rem;margin:8px 0;color:var(--teal)}
.radical-info{font-size:.85rem;color:#475569;line-height:1.8}
.radical-categories{display:flex;flex-direction:column;gap:16px}
.radical-cat h4{font-size:.85rem;color:#64748b;margin:0 0 8px;text-transform:uppercase;letter-spacing:1px}
.radical-grid{display:flex;flex-wrap:wrap;gap:6px}
.radical-item{width:40px;height:40px;border-radius:8px;display:flex;align-items:center;justify-content:center;background:#fff;border:1px solid #e2e8f0;cursor:pointer;font-size:1.1rem;transition:.15s;text-decoration:none;color:inherit}
.radical-item:hover{background:var(--teal);color:#fff;border-color:var(--teal)}
.radical-item.active{background:var(--teal);color:#fff;border-color:var(--teal)}
.recent-searches{display:flex;flex-wrap:wrap;gap:6px;margin:12px 0}
.recent-tag{padding:4px 12px;border-radius:99px;background:#f1f5f9;font-size:.8rem;cursor:pointer;transition:.15s;text-decoration:none;color:inherit}
.recent-tag:hover{background:var(--teal);color:#fff}
.pagination{display:flex;gap:6px;justify-content:center;flex-wrap:wrap}
.page-link{display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;border:1px solid #e2e8f0;background:#fff;font-size:.85rem;text-decoration:none;color:#475569;transition:.15s}
.page-link:hover{background:var(--teal);color:#fff;border-color:var(--teal)}
.page-link.active{background:var(--teal);color:#fff;border-color:var(--teal)}
@media(max-width:768px){.dict-layout{grid-template-columns:1fr}.dict-hero h1{font-size:1.4rem}.search-box input{font-size:.9rem}}
</style></head><body>
<?php include 'sidebar.php'; ?>
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
<script src="init.js"></script>
</body></html>
