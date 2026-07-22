<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .flashcard-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafb, #eff6ff); }
        .page-header { text-align: center; margin-bottom: 40px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--teal-light); color: var(--teal-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
        .page-header__desc { font-size: .95rem; color: var(--gray); }

        .mode-toggle { display: flex; justify-content: center; gap: 8px; margin-bottom: 24px; background: var(--gray-light); border-radius: var(--radius-sm); padding: 4px; max-width: 300px; margin-left: auto; margin-right: auto; }
        .mode-btn { flex: 1; padding: 10px 20px; border: none; background: transparent; border-radius: 8px; font-size: .9rem; font-weight: 600; color: var(--gray); cursor: pointer; transition: var(--transition); }
        .mode-btn:hover { color: var(--dark); }
        .mode-btn.active { background: #fff; color: var(--dark); box-shadow: 0 2px 8px rgba(0,0,0,.08); }

        .srs-stats { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; margin-bottom: 20px; }
        .srs-stat { background: #fff; border-radius: var(--radius-sm); padding: 12px 20px; box-shadow: var(--shadow); text-align: center; min-width: 100px; }
        .srs-stat__num { font-size: 1.3rem; font-weight: 800; color: var(--dark); }
        .srs-stat__label { font-size: .78rem; color: var(--gray); margin-top: 2px; }

        .level-select { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px; }
        .level-btn { padding: 12px 28px; border-radius: var(--radius-sm); font-weight: 600; font-size: 1rem; border: 2px solid var(--gray-light); background: #fff; cursor: pointer; transition: var(--transition); color: var(--dark-3); }
        .level-btn:hover { border-color: var(--teal); color: var(--teal); }
        .level-btn.active { background: var(--teal); border-color: var(--teal); color: #fff; box-shadow: 0 4px 16px rgba(13,148,136,.3); }

        .card-area { max-width: 500px; margin: 0 auto 32px; perspective: 1200px; }
        .flashcard { position: relative; width: 100%; aspect-ratio: 3/4; min-height: 260px; cursor: pointer; transition: transform .6s cubic-bezier(.4,0,.2,1); transform-style: preserve-3d; }
        .flashcard.flipped { transform: rotateY(180deg); }
        @supports not (aspect-ratio: 1/1) { .flashcard { height: 60vh; max-height: 500px; min-height: 260px; } }
        .card-face { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; backface-visibility: hidden; border-radius: var(--radius); box-shadow: var(--shadow-lg); padding: 40px 24px; }
        .card-front { background: linear-gradient(160deg, #fff, #eff6ff); border: 2px solid var(--teal-light); }
        .card-back { background: linear-gradient(160deg, #fff, #fff7ed); border: 2px solid var(--coral-light); transform: rotateY(180deg); }
        .card-hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 5rem; font-weight: 900; color: var(--dark); margin-bottom: 16px; line-height: 1.2; }
        .card-pinyin { font-size: 1.4rem; color: var(--teal); font-weight: 600; font-style: italic; }
        .card-meaning { font-size: 1.3rem; color: var(--dark-3); font-weight: 600; margin-bottom: 12px; }
        .card-example { font-size: .9rem; color: var(--gray); text-align: center; max-width: 80%; line-height: 1.6; }
        .card-hint { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); font-size: .8rem; color: var(--gray); opacity: .6; }
        .card-level { position: absolute; top: 16px; right: 16px; background: var(--teal-light); color: var(--teal-dark); padding: 4px 12px; border-radius: 50px; font-size: .75rem; font-weight: 600; }
        .card-next { position: absolute; bottom: 16px; left: 50%; transform: translateX(-50%); font-size: .7rem; color: var(--gray); opacity: .5; }
        .card-ease { position: absolute; top: 16px; left: 16px; background: var(--coral-light); color: var(--coral-dark); padding: 4px 10px; border-radius: 50px; font-size: .7rem; font-weight: 600; }

        .card-controls { display: flex; justify-content: center; gap: 16px; margin-bottom: 32px; }
        .ctrl-btn { width: 56px; height: 56px; border-radius: 50%; border: none; font-size: 1.4rem; cursor: pointer; transition: var(--transition); display: flex; align-items: center; justify-content: center; background: #fff; box-shadow: var(--shadow); }
        .ctrl-btn:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .ctrl-btn:disabled { opacity: .3; cursor: not-allowed; transform: none; }
        .ctrl-btn.know { color: var(--teal); border: 2px solid var(--teal-light); }
        .ctrl-btn.know:hover { background: var(--teal); color: #fff; }
        .ctrl-btn.dunno { color: var(--coral); border: 2px solid var(--coral-light); }
        .ctrl-btn.dunno:hover { background: var(--coral); color: #fff; }
        .ctrl-btn.shuffle { color: var(--coral-dark); }
        .ctrl-btn.prev, .ctrl-btn.next { color: var(--dark-3); }

        .stats-bar { display: flex; justify-content: center; gap: 32px; margin-bottom: 24px; }
        .stat-item { text-align: center; }
        .stat-item__num { font-size: 1.2rem; font-weight: 800; color: var(--dark); }
        .stat-item__label { font-size: .8rem; color: var(--gray); }

        .progress-bar { max-width: 500px; margin: 0 auto; height: 6px; background: var(--gray-light); border-radius: 4px; overflow: hidden; }
        .progress-bar__fill { height: 100%; background: linear-gradient(90deg, var(--teal), var(--coral)); border-radius: 4px; transition: width .4s ease; }

        .empty-state { text-align: center; padding: 60px 24px; color: var(--gray); }
        .empty-state__icon { font-size: 4rem; margin-bottom: 16px; }
        .empty-state__text { font-size: 1.1rem; }

        @media(max-width:768px) {
            .card-hanzi { font-size: 3.5rem; }
            .card-area { max-width: 90vw; }
            .flashcard { aspect-ratio: 2/3; }
            .srs-stats { gap: 8px; }
            .srs-stat { min-width: 70px; padding: 8px 12px; }
        }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="flashcard-page">
        <div class="container">
            <div class="page-header reveal">
                <div class="page-header__badge"> Học qua Flashcard</div>
                <h1 class="page-header__title">Flashcard từ vựng</h1>
                <p class="page-header__desc">Lật thẻ để học từ vựng tiếng Trung một cách nhanh chóng</p>
            </div>

            <div class="mode-toggle reveal" id="modeToggle">
                <button class="mode-btn ripple active" data-mode="normal" onclick="setMode('normal')"> Thường</button>
                <button class="mode-btn ripple" data-mode="srs" onclick="setMode('srs')"> Ôn tập (SRS)</button>
            </div>

            <div id="srsStats" style="display:none;"></div>

            <div class="level-select reveal" id="levelSelect"></div>

            <div id="cardContainer"><div style="display:flex;flex-direction:column;align-items:center;gap:16px;padding:40px;"><div class="skeleton skeleton--card" style="max-width:400px;height:260px;"></div><div class="skeleton skeleton--button"></div><div class="skeleton skeleton--button"></div></div></div>
        </div>
    </div>

    <script>
        const API = 'api.php';
        let currentVocab = [];
        let currentIndex = 0;
        let knownCount = 0;
        let unknownCount = 0;
        let isFlipped = false;
        let userId = localStorage.getItem('hanngu_user_id') || 'default_user';
        let currentMode = 'normal';
        let currentLevel = 0;
        let srsCards = [];

        async function fetchLevels() {
            try {
                const r = await fetch(API + '?action=get_vocab&user_id=' + userId);
                const all = await r.json();
                if (!Array.isArray(all)) return;
                const levels = [...new Set(all.map(v => v.level))].sort((a,b) => a-b);
                const container = document.getElementById('levelSelect');
                container.innerHTML = '<button class="level-btn ripple" data-level="0">Tất cả</button>' +
                    levels.map(l => `<button class="level-btn ripple" data-level="${l}">HSK ${l}</button>`).join('');
                container.querySelectorAll('.level-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        container.querySelectorAll('.level-btn').forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');
                        currentLevel = parseInt(btn.dataset.level);
                        if (currentMode === 'srs') loadSRS();
                        else loadVocab(currentLevel);
                    });
                });
                if (levels.length) {
                    container.querySelector('[data-level="0"]').classList.add('active');
                    if (currentMode === 'srs') loadSRS();
                    else loadVocab(0);
                }
            } catch(e) {
                console.error(e);
                showToast(' Lỗi kết nối!', 'error');
            }
        }

        function setMode(mode) {
            currentMode = mode;
            document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
            document.querySelector(`[data-mode="${mode}"]`).classList.add('active');
            showToast(' Đã chuyển chế độ ' + (mode === 'srs' ? 'Ôn tập (SRS)' : 'Thường'), 'info', 1500);
            if (mode === 'srs') loadSRS();
            else loadVocab(currentLevel);
        }

        async function loadSRS() {
            const url = API + '?action=get_review_cards&user_id=' + userId + (currentLevel ? '&level=' + currentLevel : '') + '&limit=30';
            try {
                document.getElementById('cardContainer').innerHTML = '<div class="loading-pulse">Đang tải...</div>';
                const r = await fetch(url);
                const data = await r.json();
                const cards = data && data.data ? data.data : [];
                if (!cards.length) {
                    document.getElementById('cardContainer').innerHTML =
                        '<div class="empty-state"><div class="empty-state__icon"></div><div class="empty-state__text">Không có thẻ cần ôn tập hôm nay!</div></div>';
                    document.getElementById('srsStats').style.display = 'none';
                    return;
                }
                srsCards = cards;
                document.getElementById('srsStats').style.display = 'flex';
                document.getElementById('srsStats').className = 'srs-stats reveal';
                document.getElementById('srsStats').innerHTML = `
                    <div class="srs-stat"><div class="srs-stat__num">${cards.length}</div><div class="srs-stat__label">Cần ôn hôm nay</div></div>
                `;
                currentVocab = cards;
                currentIndex = 0;
                knownCount = 0;
                unknownCount = 0;
                isFlipped = false;
                renderSRS();
            } catch(e) {
                console.error(e);
                showToast(' Lỗi kết nối!', 'error');
                document.getElementById('cardContainer').innerHTML =
                    '<div class="empty-state"><div class="empty-state__icon"></div><div class="empty-state__text">Lỗi tải dữ liệu</div></div>';
            }
        }

        function renderSRS() {
            const container = document.getElementById('cardContainer');
            if (!srsCards.length || currentIndex >= srsCards.length) {
                container.innerHTML =
                    '<div class="empty-state"><div class="empty-state__icon"></div><div class="empty-state__text">Đã ôn xong tất cả thẻ hôm nay!</div></div>';
                return;
            }

            const v = srsCards[currentIndex];
            const daysUntilNext = v.next_review ? Math.ceil((new Date(v.next_review) - new Date()) / (1000*60*60*24)) : 'Hôm nay';
            const pct = srsCards.length ? ((currentIndex + 1) / srsCards.length * 100) : 0;

            container.innerHTML = `
                <div class="stats-bar reveal">
                    <div class="stat-item"><div class="stat-item__num" id="indexDisplay">${currentIndex+1}/${srsCards.length}</div><div class="stat-item__label">Thẻ</div></div>
                </div>
                <div class="progress-bar"><div class="progress-bar__fill" style="width:${pct}%"></div></div>
                <div class="card-area reveal">
                    <div class="flashcard" id="flashcard" onclick="flipCard()">
                        <div class="card-face card-front">
                            <div class="card-level">HSK ${v.level}</div>
                            <div class="card-ease">Hệ số: ${v.ease_factor || '2.5'}</div>
                            <div class="card-hanzi">${v.hanzi || v.word}</div>
                            <div class="card-pinyin">${v.pinyin}</div>
                            <div class="card-hint"> Chạm để xem nghĩa</div>
                        </div>
                        <div class="card-face card-back">
                            <div class="card-level">HSK ${v.level}</div>
                            <div class="card-meaning">${v.meaning}</div>
                            <div class="card-example">${v.example || ''}</div>
                            <div class="card-next"> Ôn lại sau ${typeof daysUntilNext === 'number' ? daysUntilNext + ' ngày' : daysUntilNext}</div>
                            <div class="card-hint"> Chạm để lật lại</div>
                        </div>
                    </div>
                </div>
                <div class="card-controls">
                    <button class="ctrl-btn ripple dunno" onclick="srsUnknown()">✕ Chưa nhớ</button>
                    <button class="ctrl-btn ripple know" onclick="srsKnown()">✓ Đã nhớ</button>
                </div>
            `;
        }

        async function srsKnown() {
            const v = srsCards[currentIndex];
            try {
                await fetch(API + '?action=submit_review', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({user_id: userId, vocab_id: v.id, known: 1})
                });
                showToast(' Đã đánh dấu "Đã nhớ"!', 'success', 2000);
            } catch(e) { console.error(e); showToast(' Lỗi kết nối!', 'error'); }
            knownCount++;
            currentIndex++;
            isFlipped = false;
            renderSRS();
        }

        async function srsUnknown() {
            const v = srsCards[currentIndex];
            try {
                await fetch(API + '?action=submit_review', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({user_id: userId, vocab_id: v.id, known: 0})
                });
                showToast(' Sẽ ôn lại sau!', 'info', 2000);
            } catch(e) { console.error(e); showToast(' Lỗi kết nối!', 'error'); }
            unknownCount++;
            // Move card to end of array for re-study
            const card = srsCards.splice(currentIndex, 1)[0];
            srsCards.push(card);
            isFlipped = false;
            renderSRS();
        }

        async function loadVocab(level) {
            const url = API + '?action=get_vocab&user_id=' + userId + (level ? '&level=' + level : '');
            try {
                document.getElementById('cardContainer').innerHTML = '<div class="loading-pulse">Đang tải...</div>';
                const r = await fetch(url);
                const data = await r.json();
                if (!Array.isArray(data) || !data.length) {
                    document.getElementById('cardContainer').innerHTML =
                        '<div class="empty-state"><div class="empty-state__icon"></div><div class="empty-state__text">Chưa có từ vựng cho cấp độ này</div></div>';
                    return;
                }
                currentVocab = data;
                currentIndex = 0;
                knownCount = 0;
                unknownCount = 0;
                isFlipped = false;
                renderCard();
            } catch(e) {
                console.error(e);
                showToast(' Lỗi kết nối!', 'error');
            }
        }

        function renderCard() {
            const container = document.getElementById('cardContainer');
            if (!currentVocab.length || currentIndex >= currentVocab.length) {
                container.innerHTML =
                    '<div class="empty-state"><div class="empty-state__icon"></div><div class="empty-state__text">Đã học xong tất cả thẻ!</div></div>';
                return;
            }

            const v = currentVocab[currentIndex];
            const pct = currentVocab.length ? ((currentIndex + 1) / currentVocab.length * 100) : 0;

            container.innerHTML = `
                <div class="stats-bar reveal">
                    <div class="stat-item"><div class="stat-item__num" id="knownCount">${knownCount}</div><div class="stat-item__label">Đã biết</div></div>
                    <div class="stat-item"><div class="stat-item__num" id="indexDisplay">${currentIndex+1}/${currentVocab.length}</div><div class="stat-item__label">Thẻ</div></div>
                    <div class="stat-item"><div class="stat-item__num" id="unknownCount">${unknownCount}</div><div class="stat-item__label">Chưa thuộc</div></div>
                </div>
                <div class="progress-bar"><div class="progress-bar__fill" style="width:${pct}%"></div></div>
                <div class="card-area reveal">
                    <div class="flashcard" id="flashcard" onclick="flipCard()">
                        <div class="card-face card-front">
                            <div class="card-level">HSK ${v.level}</div>
                            <div class="card-hanzi">${v.hanzi || v.word}</div>
                            <div class="card-pinyin">${v.pinyin}</div>
                            <div class="card-hint"> Chạm để lật thẻ</div>
                        </div>
                        <div class="card-face card-back">
                            <div class="card-level">HSK ${v.level}</div>
                            <div class="card-meaning">${v.meaning}</div>
                            <div class="card-example">${v.example || ''}</div>
                            <div class="card-hint"> Chạm để lật lại</div>
                        </div>
                    </div>
                </div>
                <div class="card-controls">
                    <button class="ctrl-btn ripple prev" onclick="prevCard()" ${currentIndex === 0 ? 'disabled' : ''} aria-label="Thẻ trước">◀</button>
                    <button class="ctrl-btn ripple dunno" onclick="markUnknown()" aria-label="Chưa nhớ">✕</button>
                    <button class="ctrl-btn ripple shuffle" onclick="shuffleCards()" aria-label="Xáo trộn">⟳</button>
                    <button class="ctrl-btn ripple know" onclick="markKnown()" aria-label="Đã nhớ">✓</button>
                    <button class="ctrl-btn ripple next" onclick="nextCard()" ${currentIndex >= currentVocab.length - 1 ? 'disabled' : ''} aria-label="Thẻ tiếp">▶</button>
                </div>
            `;
        }

        function flipCard() {
            const card = document.getElementById('flashcard');
            if (card) {
                isFlipped = !isFlipped;
                card.classList.toggle('flipped');
            }
        }

        function nextCard() {
            if (currentIndex < currentVocab.length - 1) {
                currentIndex++;
                isFlipped = false;
                renderCard();
            }
        }

        function prevCard() {
            if (currentIndex > 0) {
                currentIndex--;
                isFlipped = false;
                renderCard();
            }
        }

        function markKnown() {
            knownCount++;
            showToast(' Đã đánh dấu "Đã nhớ"!', 'success', 2000);
            if (currentIndex < currentVocab.length - 1) {
                currentIndex++;
            }
            isFlipped = false;
            renderCard();
        }

        function markUnknown() {
            const card = currentVocab.splice(currentIndex, 1)[0];
            currentVocab.push(card);
            unknownCount++;
            showToast(' Sẽ ôn lại sau!', 'info', 2000);
            isFlipped = false;
            renderCard();
        }

        function shuffleCards() {
            for (let i = currentVocab.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [currentVocab[i], currentVocab[j]] = [currentVocab[j], currentVocab[i]];
            }
            currentIndex = 0;
            isFlipped = false;
            renderCard();
        }

        async function checkSession() {
            try {
                const r = await fetch('auth.php?action=check');
                const data = await r.json();
                if (data.logged_in && data.user) {
                    userId = 'user_' + data.user.id;
                    localStorage.setItem('hanngu_user_id', userId);
                }
            } catch(e) { console.error(e); }
            fetchLevels();
        }

        document.addEventListener('DOMContentLoaded', checkSession);

        document.addEventListener('keydown', function(e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
            if (currentMode === 'srs') {
                if (e.key === 'ArrowRight' || e.key === ' ' || e.key === 'y' || e.key === 'k') { e.preventDefault(); srsKnown(); }
                if (e.key === 'ArrowLeft' || e.key === 'n' || e.key === 'u') { e.preventDefault(); srsUnknown(); }
                if (e.key === 'f' || e.key === 'Enter') { flipCard(); }
            } else {
                if (e.key === 'ArrowRight' || e.key === ' ') { e.preventDefault(); nextCard(); }
                if (e.key === 'ArrowLeft') { e.preventDefault(); prevCard(); }
                if (e.key === 'f' || e.key === 'Enter') { flipCard(); }
                if (e.key === 'y' || e.key === 'k') { markKnown(); }
                if (e.key === 'n' || e.key === 'u') { markUnknown(); }
                if (e.key === 's') { shuffleCards(); }
            }
        });
    </script>

    
<script src="utils.js"></script>
<script src="init.js"></script>
</body>
</html>
