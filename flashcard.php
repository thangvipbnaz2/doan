<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .fc-page { padding: 100px 0 60px; min-height: 100vh;
            background: linear-gradient(180deg, #0f172a, #0c1a1a, #0f172a); }
        .fc-header { text-align: center; margin-bottom: 32px; }
        .fc-header__badge { display: inline-flex; align-items:center; gap:6px; padding:6px 18px;
            background: rgba(13,148,136,0.12); border: 1px solid rgba(13,148,136,0.25);
            border-radius: 50px; color: #5eead4; font-size: .8rem; font-weight: 600; margin-bottom: 12px; }
        .fc-header h1 { font-size: 2rem; font-weight: 900; color: #f1f5f9; margin-bottom: 6px; }
        .fc-header p { color: #64748b; font-size: .95rem; }

        .fc-stats { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 24px; }
        .fc-stat { background: rgba(30,41,59,0.5); backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.06); border-radius: 12px;
            padding: 12px 18px; text-align: center; min-width: 90px; }
        .fc-stat__num { font-size: 1.3rem; font-weight: 800; color: #f1f5f9;
            font-variant-numeric: tabular-nums; }
        .fc-stat__label { font-size: .72rem; color: #64748b; margin-top: 2px;
            text-transform: uppercase; letter-spacing: .3px; }
        .fc-stat--due .fc-stat__num { color: #fca5a5; }
        .fc-stat--mastered .fc-stat__num { color: #6ee7b7; }

        .fc-levels { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; margin-bottom: 32px; }
        .fc-level { padding: 8px 20px; border-radius: 50px; font-weight: 600; font-size: .85rem;
            border: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.03);
            cursor: pointer; transition: all .2s; color: #94a3b8; }
        .fc-level:hover { border-color: rgba(13,148,136,0.3); color: #5eead4; }
        .fc-level.active { background: rgba(13,148,136,0.15); border-color: rgba(13,148,136,0.3);
            color: #5eead4; }

        .fc-card-area { max-width: 480px; margin: 0 auto 24px; perspective: 1200px; }
        .fc-card { position: relative; width: 100%; aspect-ratio: 3/4; min-height: 260px;
            cursor: pointer; transition: transform .5s cubic-bezier(.4,0,.2,1);
            transform-style: preserve-3d; }
        .fc-card.flipped { transform: rotateY(180deg); }
        @supports not (aspect-ratio: 1/1) { .fc-card { height: 55vh; max-height: 460px; min-height: 260px; } }

        .fc-face { position: absolute; inset: 0; display: flex; flex-direction: column;
            align-items: center; justify-content: center; backface-visibility: hidden;
            border-radius: 20px; padding: 36px 24px; }
        .fc-front { background: linear-gradient(160deg, rgba(30,41,59,0.8), rgba(15,23,42,0.9));
            border: 1px solid rgba(255,255,255,0.06); box-shadow: 0 8px 32px rgba(0,0,0,0.2),
                        inset 0 1px 0 rgba(255,255,255,0.05); }
        .fc-back { background: linear-gradient(160deg, rgba(30,41,59,0.8), rgba(15,23,42,0.9));
            border: 1px solid rgba(13,148,136,0.15); transform: rotateY(180deg);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2), inset 0 1px 0 rgba(13,148,136,0.05); }

        .fc-level-tag { position: absolute; top: 16px; right: 16px; padding: 4px 12px;
            border-radius: 50px; font-size: .72rem; font-weight: 600;
            background: rgba(13,148,136,0.1); color: #5eead4; }
        .fc-type-tag { position: absolute; top: 16px; left: 16px; padding: 4px 12px;
            border-radius: 50px; font-size: .72rem; font-weight: 600; }
        .fc-type-tag--new { background: rgba(251,191,36,0.1); color: #fcd34d; }
        .fc-type-tag--review { background: rgba(99,102,241,0.1); color: #a5b4fc; }

        .fc-hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 5rem;
            font-weight: 900; color: #f1f5f9; margin-bottom: 8px; line-height: 1.2; }
        .fc-pinyin { font-size: 1.2rem; color: #5eead4; font-weight: 500;
            font-style: italic; margin-bottom: 4px; }
        .fc-meaning { font-size: 1.5rem; color: #f1f5f9; font-weight: 700; margin-bottom: 8px; }
        .fc-example { font-size: .9rem; color: #94a3b8; text-align: center;
            max-width: 90%; line-height: 1.6; }

        .fc-ease-info { position: absolute; bottom: 14px; left: 16px;
            font-size: .72rem; color: #475569; }
        .fc-flip-hint { position: absolute; bottom: 14px; right: 16px;
            font-size: .75rem; color: #475569; }

        .fc-rating { display: flex; gap: 10px; justify-content: center; max-width: 480px;
            margin: 0 auto 24px; opacity: 0; transform: translateY(10px);
            transition: all .3s; pointer-events: none; }
        .fc-rating.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
        .fc-rate-btn { flex: 1; padding: 14px 8px; border: none; border-radius: 14px;
            font-weight: 700; font-size: .85rem; cursor: pointer; transition: all .2s;
            display: flex; flex-direction: column; align-items: center; gap: 2px; line-height: 1.3; }
        .fc-rate-btn .key { font-size: .65rem; font-weight: 400; opacity: .6; }
        .fc-rate-btn:hover { transform: translateY(-2px); }
        .fc-rate-btn--again { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .fc-rate-btn--again:hover { background: rgba(239,68,68,0.25); box-shadow: 0 4px 16px rgba(239,68,68,0.15); }
        .fc-rate-btn--hard { background: rgba(251,146,60,0.15); color: #fdba74; }
        .fc-rate-btn--hard:hover { background: rgba(251,146,60,0.25); box-shadow: 0 4px 16px rgba(251,146,60,0.15); }
        .fc-rate-btn--good { background: rgba(16,185,129,0.15); color: #6ee7b7; }
        .fc-rate-btn--good:hover { background: rgba(16,185,129,0.25); box-shadow: 0 4px 16px rgba(16,185,129,0.15); }
        .fc-rate-btn--easy { background: rgba(59,130,246,0.15); color: #93c5fd; }
        .fc-rate-btn--easy:hover { background: rgba(59,130,246,0.25); box-shadow: 0 4px 16px rgba(59,130,246,0.15); }

        .fc-progress { max-width: 480px; margin: 0 auto; height: 4px;
            background: rgba(255,255,255,0.06); border-radius: 4px; overflow: hidden; }
        .fc-progress__bar { height: 100%; background: linear-gradient(90deg, var(--teal), #5eead4);
            border-radius: 4px; transition: width .4s ease; width: 0%; }

        .fc-done { text-align: center; padding: 60px 24px; }
        .fc-done__icon { font-size: 4rem; margin-bottom: 16px; }
        .fc-done__title { font-size: 1.3rem; font-weight: 700; color: #f1f5f9; margin-bottom: 8px; }
        .fc-done__text { color: #64748b; font-size: .95rem; margin-bottom: 24px; }
        .fc-done__stats { display: flex; gap: 20px; justify-content: center; margin-bottom: 24px; }

        .fc-empty { text-align: center; padding: 60px 24px; }
        .fc-empty__icon { font-size: 4rem; margin-bottom: 16px; }
        .fc-empty__title { font-size: 1.2rem; font-weight: 700; color: #94a3b8; margin-bottom: 8px; }
        .fc-empty__text { color: #64748b; }

        @media(max-width:640px) {
            .fc-hanzi { font-size: 3.5rem; }
            .fc-card-area { max-width: 90vw; }
            .fc-card { aspect-ratio: 2/3; }
            .fc-rate-btn { font-size: .78rem; padding: 12px 6px; }
            .fc-stats { gap: 8px; }
            .fc-stat { min-width: 70px; padding: 8px 12px; }
            .fc-stat__num { font-size: 1.1rem; }
        }

        [data-theme="light"] .fc-page { background: linear-gradient(180deg, #f0fdfa, #f8fafc, #eff6ff); }
        [data-theme="light"] .fc-header h1 { color: #1e293b; }
        [data-theme="light"] .fc-stat { background: rgba(255,255,255,0.7); border-color: rgba(13,148,136,0.1); }
        [data-theme="light"] .fc-stat__num { color: #1e293b; }
        [data-theme="light"] .fc-front, [data-theme="light"] .fc-back {
            background: linear-gradient(160deg, #fff, #f0fdfa);
            border-color: rgba(13,148,136,0.1); }
        [data-theme="light"] .fc-hanzi { color: #1e293b; }
        [data-theme="light"] .fc-pinyin { color: #0d9488; }
        [data-theme="light"] .fc-meaning { color: #1e293b; }
        [data-theme="light"] .fc-level { background: #fff; border-color: #e2e8f0; color: #64748b; }
        [data-theme="light"] .fc-level:hover { border-color: var(--teal); color: var(--teal); }
        [data-theme="light"] .fc-level.active { background: #f0fdfa; border-color: var(--teal); color: var(--teal); }
        [data-theme="light"] .fc-example { color: #64748b; }
        [data-theme="light"] .fc-flip-hint { color: #94a3b8; }
        [data-theme="light"] .fc-ease-info { color: #94a3b8; }
        [data-theme="light"] .fc-done__title { color: #1e293b; }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="fc-page">
    <div class="container">
        <div class="fc-header">
            <div class="fc-header__badge"> Flashcard thông minh</div>
            <h1>Flashcard từ vựng</h1>
            <p>Ôn tập theo lộ trình — nhớ lâu hơn mỗi ngày</p>
        </div>

        <div class="fc-stats" id="fc-stats"></div>
        <div class="fc-levels" id="fc-levels"></div>
        <div class="fc-card-area" id="fc-card-area"></div>
                <div class="fc-rating" id="fc-rating">
                    <button class="fc-rate-btn fc-rate-btn--again" onclick="if(isFlipped)rateCard(1)">
                        <span>Lại</span>
                        <span class="key">1</span>
                    </button>
                    <button class="fc-rate-btn fc-rate-btn--hard" onclick="if(isFlipped)rateCard(2)">
                        <span>Khó</span>
                        <span class="key">2</span>
                    </button>
                    <button class="fc-rate-btn fc-rate-btn--good" onclick="if(isFlipped)rateCard(3)">
                        <span>Tốt</span>
                        <span class="key">3</span>
                    </button>
                    <button class="fc-rate-btn fc-rate-btn--easy" onclick="if(isFlipped)rateCard(4)">
                        <span>Dễ</span>
                        <span class="key">4</span>
                    </button>
                </div>
        <div class="fc-progress"><div class="fc-progress__bar" id="fc-progress-bar"></div></div>
    </div>
</main>

<script>
const API = 'api.php';
const userId = localStorage.getItem('hanngu_user_id') || 'default_user';
let cards = [];
let currentIndex = 0;
let isFlipped = false;
let currentLevel = 0;
let sessionResults = [];
let isLoading = false;

async function fetchAPI(action, data, method) {
    try {
        let url = API + '?action=' + action;
        const opts = { method: method || 'GET', headers: { 'Content-Type': 'application/json' } };
        if (method === 'POST' && data) opts.body = JSON.stringify(data);
        else if (data) url += '&' + new URLSearchParams(data).toString();
        return await (await fetch(url, opts)).json();
    } catch (e) { return null; }
}

async function loadStats() {
    const r = await fetchAPI('get_flashcard_stats', { user_id: userId });
    if (r && r.success) {
        document.getElementById('fc-stats').innerHTML = `
            <div class="fc-stat fc-stat--due"><div class="fc-stat__num">${r.due}</div><div class="fc-stat__label">Cần ôn</div></div>
            <div class="fc-stat"><div class="fc-stat__num">${r.studying}</div><div class="fc-stat__label">Đang học</div></div>
            <div class="fc-stat fc-stat--mastered"><div class="fc-stat__num">${r.mastered}</div><div class="fc-stat__label">Đã thuộc</div></div>
            <div class="fc-stat"><div class="fc-stat__num">${r.today}</div><div class="fc-stat__label">Hôm nay</div></div>
            <div class="fc-stat"><div class="fc-stat__num">${r.new_available}</div><div class="fc-stat__label">Từ mới</div></div>
        `;
    }
}

async function loadLevels() {
    const r = await fetchAPI('get_vocab', { user_id: userId });
    if (!Array.isArray(r)) return;
    const levels = [...new Set(r.map(v => v.level))].sort((a, b) => a - b);
    const container = document.getElementById('fc-levels');
    container.innerHTML = '<button class="fc-level active" data-level="0">Tất cả</button>' +
        levels.map(l => `<button class="fc-level" data-level="${l}">HSK ${l}</button>`).join('');
    container.querySelectorAll('.fc-level').forEach(btn => {
        btn.addEventListener('click', () => {
            container.querySelectorAll('.fc-level').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentLevel = parseInt(btn.dataset.level);
            loadCards();
        });
    });
}

async function loadCards() {
    if (isLoading) return;
    isLoading = true;
    const r = await fetchAPI('get_review_cards', { user_id: userId, level: currentLevel, limit: 30, new: 10 });
    if (r && r.data && r.data.length) {
        cards = r.data;
        currentIndex = 0;
        isFlipped = false;
        sessionResults = [];
        renderProgress();
        showCard();
    } else {
        document.getElementById('fc-card-area').innerHTML =
            '<div class="fc-empty"><div class="fc-empty__icon">🎉</div><div class="fc-empty__title">Tuyệt vời!</div><div class="fc-empty__text">Hôm nay bạn đã học xong tất cả từ vựng!</div></div>';
        document.getElementById('fc-rating').classList.remove('show');
        document.getElementById('fc-progress-bar').style.width = '100%';
    }
    isLoading = false;
}

function showCard() {
    const area = document.getElementById('fc-card-area');
    if (currentIndex >= cards.length) {
        const correct = sessionResults.filter(r => r >= 2).length;
        const total = sessionResults.length;
        area.innerHTML = `
            <div class="fc-done">
                <div class="fc-done__icon">🎯</div>
                <div class="fc-done__title">Hoàn thành buổi học!</div>
                <div class="fc-done__text">Bạn đã ôn tập ${total} từ vựng</div>
                <div class="fc-done__stats">
                    <div class="fc-stat"><div class="fc-stat__num">${total}</div><div class="fc-stat__label">Đã học</div></div>
                    <div class="fc-stat fc-stat--mastered"><div class="fc-stat__num">${correct}</div><div class="fc-stat__label">Nhớ</div></div>
                    <div class="fc-stat fc-stat--due"><div class="fc-stat__num">${total - correct}</div><div class="fc-stat__label">Cần ôn lại</div></div>
                </div>
                <button class="btn btn--primary ripple" onclick="loadCards()">🔄 Học tiếp</button>
            </div>`;
        document.getElementById('fc-rating').classList.remove('show');
        document.getElementById('fc-progress-bar').style.width = '100%';
        return;
    }

    const v = cards[currentIndex];
    const pct = ((currentIndex) / cards.length * 100);
    document.getElementById('fc-progress-bar').style.width = pct + '%';

    const isNew = v.card_type === 'new';
    const typeLabel = isNew ? 'Từ mới' : 'Ôn tập';
    const typeClass = isNew ? 'fc-type-tag--new' : 'fc-type-tag--review';

    area.innerHTML = `
        <div class="fc-card" id="fc-card" onclick="flipCard()">
            <div class="fc-face fc-front">
                <span class="fc-level-tag">HSK ${v.level}</span>
                <span class="fc-type-tag ${typeClass}">${typeLabel}</span>
                <div class="fc-hanzi">${esc(v.hanzi || v.word)}</div>
                <div class="fc-pinyin">${esc(v.pinyin)}</div>
                <div class="fc-flip-hint"> Chạm để lật thẻ</div>
            </div>
            <div class="fc-face fc-back">
                <span class="fc-level-tag">HSK ${v.level}</span>
                <div class="fc-meaning">${esc(v.meaning)}</div>
                <div class="fc-example">${esc(v.example || '')}</div>
                <div class="fc-flip-hint">1-4 để đánh giá</div>
                <div class="fc-ease-info" id="fc-ease-info"></div>
            </div>
        </div>
    `;

    document.getElementById('fc-rating').classList.remove('show');
    isFlipped = false;
}

function flipCard() {
    const card = document.getElementById('fc-card');
    if (!card) return;
    isFlipped = !isFlipped;
    card.classList.toggle('flipped');

    if (isFlipped) {
        const v = cards[currentIndex];
        document.getElementById('fc-ease-info').textContent =
            v.ease_factor ? 'Hệ số: ' + v.ease_factor : '';
        document.getElementById('fc-rating').classList.add('show');
    } else {
        document.getElementById('fc-rating').classList.remove('show');
    }
}

async function rateCard(rating) {
    const v = cards[currentIndex];
    if (!v || !v.id) return;

    const r = await fetchAPI('submit_review', {
        user_id: userId, vocab_id: v.id, rating: rating
    }, 'POST');

    sessionResults.push(rating);
    currentIndex++;
    isFlipped = false;
    document.getElementById('fc-rating').classList.remove('show');

    const labels = { 1: 'Lại', 2: 'Khó', 3: 'Tốt', 4: 'Dễ' };
    showToast(labels[rating] + ' — ' + (r ? r.interval + ' ngày' : 'ok'), 'info', 1000);

    loadStats();
    showCard();
}

function renderProgress() {
    document.getElementById('fc-progress-bar').style.width = '0%';
}

document.addEventListener('keydown', function(e) {
    if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
    if (e.key === ' ' || e.key === 'Enter') {
        e.preventDefault();
        if (!isFlipped) flipCard();
        else {
            const ratings = document.getElementById('fc-rating');
            if (ratings.classList.contains('show')) {
                if (e.key === 'Enter') flipCard();
            }
        }
    }
    if (e.key >= '1' && e.key <= '4' && isFlipped) {
        rateCard(parseInt(e.key));
    }
});

function esc(s) { const d = document.createElement('div'); d.textContent = s || ''; return d.innerHTML; }

async function init() {
    await loadStats();
    await loadLevels();
    await loadCards();
}

init();
</script>
</body>
</html>