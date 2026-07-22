<?php $base = App\Helpers\View::baseUrl(); ?>
<div class="fav-page">
    <div class="fav-header">
        <h1>Yêu thích</h1>
        <p class="fav-subtitle"><?= count($words) + count($lessons) ?> mục yêu thích</p>
    </div>

    <div class="fav-tabs">
        <button class="fav-tab active" onclick="switchTab('words')">Từ vựng (<?= count($words) ?>)</button>
        <button class="fav-tab" onclick="switchTab('lessons')">Bài học (<?= count($lessons) ?>)</button>
    </div>

    <div id="tab-words" class="fav-tab-content active">
        <?php if (empty($words)): ?>
        <div class="fav-empty">
            <div class="fav-empty-icon">❤️</div>
            <h3>Chưa có từ vựng yêu thích</h3>
            <p>Nhấn vào trái tim bên cạnh từ vựng để thêm vào danh sách yêu thích</p>
            <a href="<?= $base ?>/dictionary_mvc.php" class="btn btn--primary">Tra từ điển</a>
        </div>
        <?php else: ?>
        <div class="fav-word-grid">
            <?php foreach ($words as $w): ?>
            <div class="fav-word-card">
                <div class="fwc-hanzi"><?= App\Helpers\View::escape($w['hanzi']) ?></div>
                <div class="fwc-pinyin"><?= App\Helpers\View::escape($w['pinyin']) ?></div>
                <div class="fwc-meaning"><?= App\Helpers\View::escape(mb_substr($w['meaning'], 0, 60)) ?></div>
                <div class="fwc-meta">
                    <span class="badge badge-hsk<?= (int)$w['level'] ?>">HSK <?= (int)$w['level'] ?></span>
                    <span class="fwc-date"><?= date('d/m', strtotime($w['favorited_at'])) ?></span>
                </div>
                <button class="fwc-unfav" onclick="unfavVocab(<?= (int)$w['id'] ?>, this)" title="Bỏ yêu thích">♥</button>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div id="tab-lessons" class="fav-tab-content">
        <?php if (empty($lessons)): ?>
        <div class="fav-empty">
            <div class="fav-empty-icon">📖</div>
            <h3>Chưa có bài học yêu thích</h3>
            <p>Nhấn vào ngôi sao bên cạnh bài học để thêm vào danh sách yêu thích</p>
            <a href="<?= $base ?>/lessons" class="btn btn--primary">Xem bài học</a>
        </div>
        <?php else: ?>
        <div class="fav-lesson-list">
            <?php foreach ($lessons as $l): ?>
            <a href="<?= $base ?>/lesson/<?= (int)$l['id'] ?>" class="fav-lesson-item">
                <div class="fli-info">
                    <div class="fli-level">HSK <?= (int)$l['level'] ?> · Bài <?= (int)$l['lesson_num'] ?></div>
                    <div class="fli-title"><?= App\Helpers\View::escape($l['title']) ?></div>
                    <div class="fli-desc"><?= App\Helpers\View::escape(mb_substr($l['description'] ?? '', 0, 80)) ?></div>
                </div>
                <span class="fli-date"><?= date('d/m', strtotime($l['favorited_at'])) ?></span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function switchTab(tab) {
    document.querySelectorAll('.fav-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.fav-tab-content').forEach(c => c.classList.remove('active'));
    document.querySelector(`.fav-tab[onclick*="${tab}"]`).classList.add('active');
    document.getElementById(`tab-${tab}`).classList.add('active');
}
function unfavVocab(vocabId, btn) {
    fetch('<?= $base ?>/api.php?action=toggle_favorite', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({vocab_id: vocabId})
    }).then(r => r.json()).then(d => {
        if (d.success) btn.closest('.fav-word-card').remove();
    });
}
</script>

<style>
.fav-page{max-width:800px;margin:auto;padding:104px 24px 64px}
.fav-header{margin-bottom:24px}
.fav-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);margin:0 0 4px}
.fav-subtitle{color:var(--gray);font-size:.9rem;margin:0}
.fav-tabs{display:flex;gap:0;margin-bottom:24px;border-radius:10px;overflow:hidden;border:1px solid var(--gray-light)}
.fav-tab{padding:12px 24px;border:none;background:#fff;font-weight:600;font-size:.9rem;cursor:pointer;transition:var(--transition);flex:1}
.fav-tab.active{background:var(--teal);color:#fff}
.fav-tab:not(.active):hover{background:var(--teal-light)}
.fav-tab-content{display:none}
.fav-tab-content.active{display:block}
.fav-empty{text-align:center;padding:80px 20px;color:var(--gray)}
.fav-empty-icon{font-size:4rem;margin-bottom:16px}
.fav-empty h3{font-size:1.2rem;color:var(--dark);margin:0 0 8px}
.fav-empty p{margin:0 0 20px;font-size:.9rem}
.fav-word-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px}
.fav-word-card{background:#fff;border-radius:var(--radius-sm);padding:20px;border:1px solid var(--gray-light);position:relative;transition:var(--transition)}
.fav-word-card:hover{box-shadow:var(--shadow);transform:translateY(-2px)}
.fwc-hanzi{font-size:1.6rem;font-weight:700;color:var(--dark);margin-bottom:4px;font-family:var(--font-hanzi, 'Noto Sans SC', sans-serif)}
.fwc-pinyin{font-size:.85rem;color:var(--coral);margin-bottom:6px}
.fwc-meaning{font-size:.85rem;color:var(--gray);margin-bottom:10px;line-height:1.4}
.fwc-meta{display:flex;align-items:center;gap:8px;font-size:.75rem}
.fwc-date{color:#94a3b8;margin-left:auto}
.fwc-unfav{position:absolute;top:12px;right:12px;border:none;background:none;font-size:1.2rem;cursor:pointer;color:#f5576c;transition:var(--transition);padding:4px}
.fwc-unfav:hover{transform:scale(1.2)}
.fav-lesson-list{display:flex;flex-direction:column;gap:8px}
.fav-lesson-item{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;background:#fff;border-radius:var(--radius-sm);border:1px solid var(--gray-light);text-decoration:none;transition:var(--transition)}
.fav-lesson-item:hover{box-shadow:var(--shadow);border-color:var(--teal)}
.fli-level{font-size:.75rem;color:var(--teal);font-weight:600;margin-bottom:2px}
.fli-title{font-weight:700;color:var(--dark);font-size:1rem;margin-bottom:2px}
.fli-desc{font-size:.82rem;color:var(--gray)}
.fli-date{font-size:.78rem;color:#94a3b8;flex-shrink:0}
.badge-hsk1{background:#dbeafe;color:#1d4ed8}
.badge-hsk2{background:#d1fae5;color:#047857}
.badge-hsk3{background:#fef3c7;color:#b45309}
.badge-hsk4{background:#fee2e2;color:#dc2626}
.badge-hsk5{background:#f3e8ff;color:#7c3aed}
.badge-hsk6{background:#fce7f3;color:#be185d}
</style>