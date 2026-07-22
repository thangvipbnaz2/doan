<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luyện tập - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .practice-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafc, #eff6ff); }
        .page-header { text-align: center; margin-bottom: 40px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--red-light); color: var(--red-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
        .page-header__desc { font-size: .95rem; color: var(--gray); }

        .practice-types { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; max-width: 1000px; margin: 0 auto; }
        .practice-card { background: #fff; border-radius: var(--radius); padding: 32px 24px; box-shadow: var(--shadow); text-align: center; cursor: pointer; transition: var(--transition); border: 2px solid transparent; text-decoration: none; display:block; position:relative; overflow:hidden; }
        .practice-card:hover { border-color: var(--red); transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .practice-card__badge { position:absolute; top:12px; right:12px; padding:3px 10px; border-radius:20px; font-size:.72rem; font-weight:700; line-height:1.6; z-index:1; }
        .practice-card__badge--has { background:#0d9488; color:#fff; }
        .practice-card__badge--none { background:var(--gray-light); color:var(--gray); }
        .practice-card__icon { font-size: 3rem; margin-bottom: 16px; display:flex; align-items:center; justify-content:center; }
        .practice-card__icon .bi { font-size: 3rem; }
        .practice-card__title { font-size: 1.3rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .practice-card__desc { font-size: .9rem; color: var(--gray); line-height: 1.6; }
        .practice-card__btn { display: inline-block; margin-top: 16px; padding: 10px 24px; background: var(--red); color: #fff; border-radius: var(--radius-sm); font-weight: 600; }

        .hist-overlay { position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:9999; display:none; align-items:center; justify-content:center; padding:20px; backdrop-filter:blur(4px); }
        .hist-overlay.active { display:flex; }
        .hist-panel { background:#fff; border-radius:24px; max-width:780px; width:100%; max-height:85vh; display:flex; flex-direction:column; box-shadow:0 24px 80px rgba(0,0,0,0.2); animation:histIn .3s ease; }
        @keyframes histIn { from { opacity:0; transform:scale(.92) translateY(20px); } to { opacity:1; transform:scale(1) translateY(0); } }
        .hist-header { display:flex; align-items:center; justify-content:space-between; padding:20px 28px 16px; border-bottom:1px solid var(--gray-light); flex-shrink:0; }
        .hist-header h2 { font-size:1.3rem; font-weight:800; color:var(--dark); margin:0; display:flex; align-items:center; gap:10px; }
        .hist-header h2 i { color:var(--red); }
        .hist-close { width:36px; height:36px; border:none; background:var(--gray-light); border-radius:50%; font-size:1.3rem; cursor:pointer; display:flex; align-items:center; justify-content:center; color:var(--gray); transition:all .2s; }
        .hist-close:hover { background:var(--red); color:#fff; transform:rotate(90deg); }
        .hist-body { padding:20px 28px 28px; overflow-y:auto; flex:1; }
        .hist-empty { text-align:center; padding:40px 20px; color:var(--gray); }
        .hist-empty i { font-size:3rem; display:block; margin-bottom:12px; opacity:.4; }

        .hist-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:12px; margin-bottom:28px; }
        .hist-grid__item { background:var(--gray-light); border-radius:14px; padding:14px 12px; text-align:center; transition:all .2s; }
        .hist-grid__item:hover { background:var(--teal-light); transform:translateY(-2px); }
        .hist-grid__item-icon { font-size:1.3rem; margin-bottom:4px; }
        .hist-grid__item-name { font-size:.78rem; font-weight:600; color:var(--dark); margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .hist-grid__item-score { font-size:.95rem; font-weight:800; }
        .hist-grid__item-score--good { color:#0d9488; }
        .hist-grid__item-score--mid { color:#d97706; }
        .hist-grid__item-score--low { color:#ef4444; }
        .hist-grid__item-count { font-size:.68rem; color:var(--gray); margin-top:2px; }

        .hist-recent-title { font-size:.9rem; font-weight:700; color:var(--dark); margin-bottom:12px; display:flex; align-items:center; gap:8px; }
        .hist-list { display:flex; flex-direction:column; gap:8px; }
        .hist-row { display:flex; align-items:center; gap:12px; padding:10px 14px; background:var(--gray-light); border-radius:10px; font-size:.82rem; transition:all .2s; }
        .hist-row:hover { background:var(--teal-light); }
        .hist-row__icon { font-size:1rem; width:24px; text-align:center; flex-shrink:0; }
        .hist-row__name { font-weight:600; color:var(--dark); min-width:100px; flex-shrink:0; }
        .hist-row__level { color:var(--gray); font-size:.72rem; min-width:48px; }
        .hist-row__score { font-weight:700; margin-left:auto; }
        .hist-row__score--pass { color:#0d9488; }
        .hist-row__score--fail { color:#ef4444; }
        .hist-row__date { color:var(--gray); font-size:.72rem; min-width:75px; text-align:right; flex-shrink:0; }

        [data-theme="dark"] .practice-page { background: linear-gradient(180deg, #0f172a, #1e293b); }
        [data-theme="dark"] .page-header { background: #1e293b; }
        [data-theme="dark"] .page-header__title { color: #f1f5f9; }
        [data-theme="dark"] .page-header__desc { color: #94a3b8; }
        [data-theme="dark"] .practice-card { background: #1e293b; }
        [data-theme="dark"] .practice-card__title { color: #f1f5f9; }
        [data-theme="dark"] .practice-card__desc { color: #94a3b8; }
        [data-theme="dark"] .practice-card__badge--none { background:#334155; color:#64748b; }
        [data-theme="dark"] #level-select { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] #practice-config label[style*="color"] { color: #f1f5f9 !important; }
        [data-theme="dark"] .hist-panel { background:#1e293b; }
        [data-theme="dark"] .hist-header { border-color:rgba(255,255,255,.06); }
        [data-theme="dark"] .hist-header h2 { color:#f1f5f9; }
        [data-theme="dark"] .hist-close { background:#334155; color:#94a3b8; }
        [data-theme="dark"] .hist-grid__item { background:#334155; }
        [data-theme="dark"] .hist-grid__item:hover { background:rgba(13,148,136,.15); }
        [data-theme="dark"] .hist-grid__item-name { color:#f1f5f9; }
        [data-theme="dark"] .hist-row { background:#334155; }
        [data-theme="dark"] .hist-row:hover { background:rgba(13,148,136,.12); }
        [data-theme="dark"] .hist-row__name { color:#f1f5f9; }
        [data-theme="dark"] .hist-recent-title { color:#f1f5f9; }
        @media(max-width:600px){ .hist-grid { grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); gap:8px; } .hist-body { padding:16px; } .hist-header { padding:16px 16px 12px; } .hist-row { flex-wrap:wrap; gap:6px; } .hist-row__date { margin-left:36px; } }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="practice-page">
    <div class="container">
        <div class="page-header">
            <span class="page-header__badge"> Luyện tập</span>
            <h1 class="page-header__title">Chọn hình thức <span class="text-gradient">luyện tập</span></h1>
            <p class="page-header__desc">Ôn tập từ vựng và ngữ pháp qua các bài tập tương tác</p>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
            <div style="display:flex;align-items:center;gap:12px;">
                <label style="font-weight:600;color:var(--dark);"><i class="bi bi-bar-chart"></i> Chọn cấp độ:</label>
                <select id="level-select" style="padding:10px 18px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;font-weight:600;background:#fff;cursor:pointer;">
                    <option value="1">HSK 1</option>
                    <option value="2">HSK 2</option>
                    <option value="3">HSK 3</option>
                    <option value="4">HSK 4</option>
                    <option value="5">HSK 5</option>
                    <option value="6">HSK 6</option>
                </select>
            </div>
            <button class="btn btn--outline btn--sm ripple" onclick="openHistory()"><i class="bi bi-clock-history"></i> Lịch sử</button>
        </div>

        <div class="practice-types" id="practice-types">
            <a class="practice-card reveal" data-hsk-min="1" data-hsk-max="3" data-module="quiz" onclick="go('basic-practice.php','quiz')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-basic_quiz">—</span>
                <div class="practice-card__icon"><i class="bi bi-patch-question-fill" style="color:#0d9488"></i></div>
                <h3 class="practice-card__title">Trắc nghiệm từ vựng</h3>
                <p class="practice-card__desc">Chọn nghĩa đúng của chữ Hán hiển thị (HSK 1-3)</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="1" data-hsk-max="3" data-module="audio" onclick="go('basic-practice.php','audio')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-basic_audio">—</span>
                <div class="practice-card__icon"><i class="bi bi-headphones" style="color:#fb923c"></i></div>
                <h3 class="practice-card__title">Nghe và chọn</h3>
                <p class="practice-card__desc">Nghe phát âm và chọn đáp án đúng</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="1" data-hsk-max="2" data-module="radical" onclick="go('basic-practice.php','radical')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-basic_radical">—</span>
                <div class="practice-card__icon"><i class="bi bi-puzzle-fill" style="color:#8b5cf6"></i></div>
                <h3 class="practice-card__title">Ghép bộ thủ</h3>
                <p class="practice-card__desc">Kéo các bộ thủ vào khung để tạo thành chữ</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="3" data-hsk-max="4" data-module="ghep_cau" onclick="go('sentence-builder.php','')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-ghep_cau">—</span>
                <div class="practice-card__icon"><i class="bi bi-columns-gap" style="color:#6366f1"></i></div>
                <h3 class="practice-card__title">Ghép câu</h3>
                <p class="practice-card__desc">Sắp xếp từ thành câu hoàn chỉnh (HSK 3-4)</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="4" data-hsk-max="6" data-module="cloze" onclick="go('reading-context.php','cloze')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-reading_cloze">—</span>
                <div class="practice-card__icon"><i class="bi bi-pencil-square" style="color:#d97706"></i></div>
                <h3 class="practice-card__title">Điền khuyết</h3>
                <p class="practice-card__desc">Điền từ thích hợp vào chỗ trống trong đoạn văn</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="4" data-hsk-max="6" data-module="synonym" onclick="go('reading-context.php','synonym')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-reading_synonym">—</span>
                <div class="practice-card__icon"><i class="bi bi-shuffle" style="color:#0d9488"></i></div>
                <h3 class="practice-card__title">Chọn từ đồng nghĩa</h3>
                <p class="practice-card__desc">Chọn từ thay thế phù hợp nhất với ngữ cảnh</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="5" data-hsk-max="6" data-module="grammar" onclick="go('advanced-academic.php','grammar')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-academic_grammar">—</span>
                <div class="practice-card__icon"><i class="bi bi-exclamation-triangle" style="color:#ef4444"></i></div>
                <h3 class="practice-card__title">Tìm lỗi ngữ pháp</h3>
                <p class="practice-card__desc">Xác định và sửa lỗi sai trong câu (HSK 5-6)</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="5" data-hsk-max="6" data-module="essay" onclick="go('advanced-academic.php','essay')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-academic_essay">—</span>
                <div class="practice-card__icon"><i class="bi bi-pencil-square" style="color:#0d9488"></i></div>
                <h3 class="practice-card__title">Viết đoạn văn</h3>
                <p class="practice-card__desc">Viết đoạn văn dựa trên từ khoá cho sẵn (HSK 5-6)</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
            <a class="practice-card reveal" data-hsk-min="5" data-hsk-max="6" data-module="summary" onclick="go('advanced-academic.php','summary')">
                <span class="practice-card__badge practice-card__badge--none" id="badge-academic_summary">—</span>
                <div class="practice-card__icon"><i class="bi bi-clock-history" style="color:#7c3aed"></i></div>
                <h3 class="practice-card__title">Tóm tắt văn bản</h3>
                <p class="practice-card__desc">Đọc và viết tóm tắt văn bản tiếng Trung (HSK 5-6)</p>
                <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
            </a>
        </div>
    </div>
</main>

<div class="hist-overlay" id="histOverlay">
    <div class="hist-panel">
        <div class="hist-header">
            <h2><i class="bi bi-clock-history"></i> Lịch sử luyện tập</h2>
            <button class="hist-close" onclick="closeHistory()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="hist-body" id="histBody">
            <div class="hist-empty"><i class="bi bi-arrow-repeat"></i> Đang tải...</div>
        </div>
    </div>
</div>

<script>
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';

async function fetchAPI(action, data = null, method = 'GET') {
    try {
        let url = API_URL + '?action=' + action;
        let options = { method, headers: { 'Content-Type': 'application/json' } };
        if (method === 'GET' && data) {
            const d = { ...data, user_id: USER_ID };
            url += '&' + new URLSearchParams(d).toString();
        } else if (data) {
            data.user_id = USER_ID;
            options.body = JSON.stringify(data);
        }
        return await (await fetch(url, options)).json();
    } catch (e) { showToast(' Lỗi tải dữ liệu!', 'error'); return null; }
}

// ===== MODULE LABELS & ICONS =====
const moduleMeta = {
    basic_quiz:    { label:'Trắc nghiệm từ vựng', icon:'bi-patch-question-fill', color:'#0d9488', short:'Trắc nghiệm' },
    basic_audio:   { label:'Nghe và chọn',        icon:'bi-headphones',         color:'#fb923c', short:'Nghe' },
    basic_radical: { label:'Ghép bộ thủ',          icon:'bi-puzzle-fill',        color:'#8b5cf6', short:'Bộ thủ' },
    ghep_cau:      { label:'Ghép câu',             icon:'bi-columns-gap',        color:'#6366f1', short:'Ghép câu' },
    reading_cloze: { label:'Điền khuyết',           icon:'bi-pencil-square',     color:'#d97706', short:'Điền khuyết' },
    reading_synonym:{label:'Chọn từ đồng nghĩa',    icon:'bi-shuffle',           color:'#0d9488', short:'Đồng nghĩa' },
    academic_grammar:{label:'Tìm lỗi ngữ pháp',     icon:'bi-exclamation-triangle',color:'#ef4444', short:'Ngữ pháp' },
    academic_essay:{label:'Viết đoạn văn',          icon:'bi-pencil-square',     color:'#0d9488', short:'Viết' },
    academic_summary:{label:'Tóm tắt văn bản',      icon:'bi-clock-history',     color:'#7c3aed', short:'Tóm tắt' },
    time_summary:  { label:'Tóm tắt có giờ',        icon:'bi-stopwatch',         color:'#7c3aed', short:'Tóm tắt TG' }
};

function getModuleMeta(type) {
    return moduleMeta[type] || { label:type, icon:'bi-question-circle', color:'#94a3b8', short:type };
}

// ===== SCORE BADGES ON CARDS =====
async function loadCardBadges() {
    const stats = await fetchAPI('get_practice_stats');
    if (!stats) return;
    Object.keys(stats).forEach(function(type) {
        var s = stats[type];
        var pct = Math.round(parseFloat(s.best_pct));
        if (isNaN(pct)) return;
        var el = document.getElementById('badge-' + type);
        if (!el) return;
        el.textContent = pct + '%';
        el.className = 'practice-card__badge practice-card__badge--has';
        el.title = 'Điểm cao nhất: ' + pct + '% (' + s.attempt_count + ' lần)';
    });
}

// ===== HISTORY MODAL =====
function openHistory() {
    document.getElementById('histOverlay').classList.add('active');
    renderHistory();
}

function closeHistory() {
    document.getElementById('histOverlay').classList.remove('active');
}

document.getElementById('histOverlay').addEventListener('click', function(e) {
    if (e.target === this) closeHistory();
});

async function renderHistory() {
    var body = document.getElementById('histBody');
    body.innerHTML = '<div class="hist-empty"><i class="bi bi-arrow-repeat"></i> Đang tải...</div>';
    var [stats, history] = await Promise.all([
        fetchAPI('get_practice_stats'),
        fetchAPI('get_quiz_history')
    ]);
    if (!stats && !history) {
        body.innerHTML = '<div class="hist-empty"><i class="bi bi-inbox"></i> Không thể tải dữ liệu.</div>';
        return;
    }
    var hasData = (stats && Object.keys(stats).length > 0) || (history && history.length > 0);
    if (!hasData) {
        body.innerHTML = '<div class="hist-empty"><i class="bi bi-inbox"></i> Chưa có lịch sử luyện tập.</div>';
        return;
    }

    var html = '';

    // Summary grid
    if (stats && Object.keys(stats).length > 0) {
        html += '<div class="hist-grid">';
        var typeKeys = Object.keys(stats).sort();
        typeKeys.forEach(function(type) {
            var s = stats[type];
            var meta = getModuleMeta(type);
            var pct = Math.round(parseFloat(s.best_pct));
            if (isNaN(pct)) return;
            var scoreClass = pct >= 80 ? 'hist-grid__item-score--good' : pct >= 50 ? 'hist-grid__item-score--mid' : 'hist-grid__item-score--low';
            html += '<div class="hist-grid__item"><div class="hist-grid__item-icon"><i class="bi ' + meta.icon + '" style="color:' + meta.color + '"></i></div><div class="hist-grid__item-name">' + meta.short + '</div><div class="hist-grid__item-score ' + scoreClass + '">' + pct + '%</div><div class="hist-grid__item-count">' + s.attempt_count + ' lần</div></div>';
        });
        html += '</div>';
    }

    // Recent list
    if (history && history.length > 0) {
        html += '<div class="hist-recent-title"><i class="bi bi-list-ul"></i> Lần gần đây</div><div class="hist-list">';
        var shown = 0;
        history.forEach(function(r) {
            if (shown >= 30) return;
            var meta = getModuleMeta(r.quiz_type);
            var pct = Math.round(r.score / r.total_questions * 100);
            if (isNaN(pct)) return;
            var scoreClass = pct >= 80 ? 'hist-row__score--pass' : 'hist-row__score--fail';
            var dateStr = r.completed_at ? new Date(r.completed_at).toLocaleDateString('vi-VN', {day:'2-digit',month:'2-digit',hour:'2-digit',minute:'2-digit'}) : '';
            html += '<div class="hist-row"><div class="hist-row__icon"><i class="bi ' + meta.icon + '" style="color:' + meta.color + '"></i></div><div class="hist-row__name">' + meta.short + '</div><div class="hist-row__level">HSK ' + (r.level || '—') + '</div><div class="hist-row__score ' + scoreClass + '">' + r.score + '/' + r.total_questions + ' (' + pct + '%)</div><div class="hist-row__date">' + dateStr + '</div></div>';
            shown++;
        });
        html += '</div>';
    }

    body.innerHTML = html;
}

// ===== LEVEL FILTER =====
function filterByLevel(level) {
    document.querySelectorAll('#practice-types .practice-card').forEach(function(card) {
        const min = parseInt(card.dataset.hskMin) || 1;
        const max = parseInt(card.dataset.hskMax) || 6;
        if (level >= min && level <= max) {
            card.style.opacity = '1';
            card.style.filter = 'none';
            card.style.pointerEvents = 'auto';
        } else {
            card.style.opacity = '.3';
            card.style.filter = 'grayscale(.7)';
            card.style.pointerEvents = 'none';
        }
    });
}

function go(page, module) {
    const level = document.getElementById('level-select').value;
    localStorage.setItem('hanngu_practice_level', level);
    let url = page;
    if (module) url += '?module=' + module + '&level=' + level;
    else url += '?level=' + level;
    window.location.href = url;
}

var sel = document.getElementById('level-select');
var urlLevel = new URLSearchParams(location.search).get('level');
var saved = urlLevel || localStorage.getItem('hanngu_practice_level');
if (saved) { sel.value = saved; localStorage.setItem('hanngu_practice_level', saved); }

sel.addEventListener('change', function() {
    var v = parseInt(this.value);
    localStorage.setItem('hanngu_practice_level', v);
    filterByLevel(v);
});

filterByLevel(parseInt(sel.value));
loadCardBadges();
</script>
</body></html>
