<?php
session_start();
require 'db.php';

$userId = $_SESSION['user_id'] ?? 0;
if (!$userId) { header('Location: login.php'); exit; }

$level = isset($_GET['level']) ? (int)$_GET['level'] : 1;
if ($level < 1 || $level > 6) $level = 1;

$vocab = $conn->prepare("SELECT id, hanzi, pinyin, meaning, radical, example FROM vocab WHERE hanzi IS NOT NULL AND hanzi != '' ORDER BY id");
$vocab->execute();
$allVocab = $vocab->fetchAll();

$progress = $conn->prepare("SELECT vocab_id, write_completed FROM progress WHERE user_id = ? AND write_completed = 1");
$progress->execute([(string)$userId]);
$writtenIds = $progress->fetchAll(PDO::FETCH_COLUMN);
$writtenIds = array_map('intval', $writtenIds);

$writtenSet = array_flip($writtenIds);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Luyện viết chữ Hán | HànNgữ</title>
<link rel="icon" type="image/svg+xml" href="favicon.svg">
<link rel="stylesheet" href="style.css">
<style>
.writing-page{max-width:960px;margin:auto;padding:105px 24px 64px}
.writing-header{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:24px}
.writing-header h1{font-size:1.5rem}
.char-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(60px,1fr));gap:8px;margin-bottom:28px}
.char-item{aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-family:'Noto Sans SC',sans-serif;border-radius:10px;cursor:pointer;border:2px solid #e2e8f0;background:#fff;transition:all .2s;font-weight:500}
.char-item:hover{border-color:#0d9488;background:#f0fdfa}
.char-item.active{border-color:#0d9488;background:#ccfbf1;color:#0f766e;font-weight:700}
.char-item.done{background:#d1fae5;border-color:#6ee7b7;color:#047857}
.char-item.done::after{content:'✓';position:absolute;font-size:.6rem;color:#047857;margin-top:18px}
.practice-area{display:grid;grid-template-columns:1fr 1fr;gap:24px;background:#fff;border-radius:20px;padding:26px;box-shadow:0 4px 20px rgba(0,0,0,.06);border:1px solid #eef2f7}
.char-display{text-align:center}
.char-display__hanzi{font-size:5rem;font-family:'Noto Sans SC',sans-serif;line-height:1.3;color:var(--dark,#0f172a)}
.char-display__pinyin{font-size:1.1rem;color:var(--teal,#0d9488);font-weight:500;margin:4px 0 2px}
.char-display__meaning{font-size:.9rem;color:var(--gray,#64748b);margin-bottom:12px}
.char-display__info{font-size:.8rem;color:var(--gray-light,#94a3b8)}
canvas{border:2px dashed #cbd5e1;border-radius:12px;width:100%;max-width:320px;aspect-ratio:1;cursor:crosshair;touch-action:none;display:block;margin:0 auto}
.writing-controls{display:flex;gap:8px;justify-content:center;margin-top:12px;flex-wrap:wrap}
.char-info{text-align:left;font-size:.85rem;line-height:1.7}
.char-info strong{color:var(--dark,#0f172a)}
@media(max-width:640px){.practice-area{grid-template-columns:1fr}.char-display__hanzi{font-size:3.5rem}canvas{max-width:260px}}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="writing-page">
<div class="writing-header">
  <h1>Luyện viết chữ Hán</h1>
  <div style="display:flex;gap:8px;align-items:center">
    <label style="font-size:.85rem;color:var(--gray,#64748b)">HSK:</label>
    <select id="levelSelect" onchange="window.location='hanzi_writing.php?level='+this.value" style="padding:6px 12px;border-radius:8px;border:1px solid #e2e8f0;font-size:.85rem">
      <?php for ($i=1; $i<=6; $i++): ?>
      <option value="<?= $i ?>" <?= $i===$level?'selected':'' ?>>HSK <?= $i ?></option>
      <?php endfor; ?>
    </select>
  </div>
</div>

<div class="char-grid" id="charGrid">
<?php foreach ($allVocab as $v):
  $isDone = isset($writtenSet[$v['id']]);
  $char = $v['hanzi'];
  if (mb_strlen($char) > 2) continue; // Skip phrases, focus on single characters
  $c = mb_substr($char, 0, 1);
?>
  <div class="char-item <?= $isDone ? 'done' : '' ?>" data-char="<?= htmlspecialchars($c) ?>" data-pinyin="<?= htmlspecialchars($v['pinyin']) ?>" data-meaning="<?= htmlspecialchars($v['meaning']) ?>" data-radical="<?= htmlspecialchars($v['radical']??'') ?>" onclick="selectChar(this)"><?= htmlspecialchars($c) ?></div>
<?php endforeach; ?>
</div>

<div class="practice-area" id="practiceArea" style="display:none">
  <div class="char-display">
    <div class="char-display__hanzi" id="currentHanzi">学</div>
    <div class="char-display__pinyin" id="currentPinyin">xué</div>
    <div class="char-display__meaning" id="currentMeaning">Học</div>
    <div class="char-display__info" id="currentInfo"></div>
    <div class="writing-controls">
      <button type="button" class="btn btn--outline" style="padding:6px 16px;font-size:.82rem" onclick="clearCanvas()">Xoá</button>
      <button type="button" class="btn btn--primary" style="padding:6px 16px;font-size:.82rem" onclick="undoStroke()">↩ Hoàn tác</button>
    </div>
    <div id="saveMsg" style="font-size:.8rem;color:#047857;margin-top:8px;display:none">Đã lưu tiến độ!</div>
  </div>
  <div>
    <canvas id="writeCanvas" width="320" height="320"></canvas>
    <div class="char-info" id="charInfo"></div>
  </div>
</div>

<div id="noCharMsg" style="text-align:center;padding:40px;color:var(--gray,#64748b);background:#fff;border-radius:20px;border:1px solid #eef2f7">
  <div style="font-size:3rem;margin-bottom:8px">✍️</div>
  <p>Chọn một chữ Hán ở trên để bắt đầu luyện viết</p>
</div>
</main>

<script>
const canvas = document.getElementById('writeCanvas');
const ctx = canvas.getContext('2d');
let drawing = false;
let lastX = 0, lastY = 0;
let strokes = [];

function initCanvas() {
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = '#0f172a';
    ctx.lineWidth = 4;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
}

canvas.addEventListener('mousedown', startDraw);
canvas.addEventListener('mousemove', draw);
canvas.addEventListener('mouseup', stopDraw);
canvas.addEventListener('mouseleave', stopDraw);
canvas.addEventListener('touchstart', e => { e.preventDefault(); const t = e.touches[0]; startDraw({ offsetX: t.clientX - canvas.getBoundingClientRect().left, offsetY: t.clientY - canvas.getBoundingClientRect().top }); });
canvas.addEventListener('touchmove', e => { e.preventDefault(); const t = e.touches[0]; draw({ offsetX: t.clientX - canvas.getBoundingClientRect().left, offsetY: t.clientY - canvas.getBoundingClientRect().top }); });
canvas.addEventListener('touchend', stopDraw);

function getPos(e) {
    const rect = canvas.getBoundingClientRect();
    return { x: e.clientX - rect.left, y: e.clientY - rect.top };
}

function startDraw(e) {
    drawing = true;
    const pos = e.offsetX !== undefined ? e : getPos(e);
    lastX = pos.offsetX || pos.x;
    lastY = pos.offsetY || pos.y;
    ctx.beginPath();
    ctx.moveTo(lastX, lastY);
}

function draw(e) {
    if (!drawing) return;
    const pos = e.offsetX !== undefined ? e : getPos(e);
    const x = pos.offsetX || pos.x;
    const y = pos.offsetY || pos.y;
    ctx.lineTo(x, y);
    ctx.stroke();
    lastX = x; lastY = y;
}

function stopDraw() {
    if (drawing) {
        drawing = false;
        strokes.push({});
    }
}

function clearCanvas() {
    initCanvas();
    strokes = [];
}

function undoStroke() {
    if (strokes.length === 0) return;
    strokes.pop();
    initCanvas();
    ctx.beginPath();
    // Re-draw all remaining strokes - simplified approach just clears
}

let currentChar = null;

function selectChar(el) {
    document.querySelectorAll('.char-item.active').forEach(c => c.classList.remove('active'));
    el.classList.add('active');

    currentChar = el.dataset.char;
    document.getElementById('currentHanzi').textContent = el.dataset.char;
    document.getElementById('currentPinyin').textContent = el.dataset.pinyin;
    document.getElementById('currentMeaning').textContent = el.dataset.meaning;
    const info = [];
    if (el.dataset.radical) info.push('Bộ: ' + el.dataset.radical);
    document.getElementById('currentInfo').textContent = info.join(' · ');
    document.getElementById('practiceArea').style.display = 'grid';
    document.getElementById('noCharMsg').style.display = 'none';
    document.getElementById('saveMsg').style.display = 'none';
    clearCanvas();
    loadRefImage(el.dataset.char);
}

function loadRefImage(char) {
    // Load reference grid lines
    ctx.strokeStyle = '#f1f5f9';
    ctx.lineWidth = 1;
    ctx.beginPath();
    for (let i = 0; i <= 4; i++) {
        ctx.moveTo(i * 80, 0); ctx.lineTo(i * 80, 320);
        ctx.moveTo(0, i * 80); ctx.lineTo(320, i * 80);
    }
    ctx.stroke();
    ctx.strokeStyle = '#0f172a';
    ctx.lineWidth = 4;
}

// Save function
function saveProgress() {
    if (!currentChar) return;
    fetch('api.php?action=evaluate_handwriting', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            character: currentChar,
            image_data: canvas.toDataURL('image/png'),
            csrf_token: '<?= $_SESSION['csrf_token'] ?? '' ?>'
        })
    }).then(r => r.json()).then(d => {
        document.getElementById('saveMsg').style.display = 'block';
        if (d.success) {
            document.querySelector('.char-item.active')?.classList.add('done');
        }
    }).catch(() => {});
}

// Keyboard shortcut
document.addEventListener('keydown', e => {
    if (e.key === 'c' || e.key === 'C') clearCanvas();
    if (e.key === 's' || e.key === 'S') saveProgress();
});

initCanvas();
</script>
</body>
</html>