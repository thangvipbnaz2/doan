<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PvP - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .pvp-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(135deg,#f8fafc,#eff6ff)}
        .pvp-header{text-align:center;margin-bottom:32px}
        .pvp-header h1{font-size:2rem;font-weight:900;color:var(--dark)}
        .pvp-header p{color:var(--gray);margin-top:8px}
        .pvp-box{background:#fff;border-radius:var(--radius);padding:32px;box-shadow:var(--shadow);max-width:600px;margin:0 auto 32px;display:none}
        .pvp-box.active{display:block}
        .pvp-box h2{font-size:1.2rem;font-weight:700;margin-bottom:16px;color:var(--dark)}
        .pvp-box label{display:block;font-size:.9rem;font-weight:600;color:var(--dark);margin-bottom:6px}
        .pvp-box select,.pvp-box input{width:100%;padding:12px 16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:1rem;margin-bottom:16px;outline:none;transition:var(--transition)}
        .pvp-box select:focus,.pvp-box input:focus{border-color:var(--red)}
        .pvp-actions{display:flex;gap:12px;flex-wrap:wrap}
        .pvp-actions .btn{flex:1}
        .pvp-or{text-align:center;margin:24px 0;position:relative}
        .pvp-or::before{content:'';display:block;height:1px;background:var(--gray-light);position:absolute;top:50%;left:0;right:0}
        .pvp-or span{background:#fff;padding:0 16px;position:relative;color:var(--gray);font-size:.9rem}
        .room-code{font-size:3rem;font-weight:900;text-align:center;letter-spacing:12px;color:var(--red-dark);padding:24px;background:var(--red-light);border-radius:var(--radius-sm);margin:16px 0}
        .pvp-result{text-align:center;padding:32px}
        .pvp-result__scores{display:grid;grid-template-columns:1fr auto 1fr;gap:24px;align-items:center;margin:24px 0}
        .pvp-player{padding:24px;border-radius:var(--radius-sm);background:var(--red-light)}
        .pvp-player__name{font-weight:700;font-size:1.1rem;color:var(--dark)}
        .pvp-player__score{font-size:2.5rem;font-weight:900;color:var(--red-dark)}
        .pvp-vs{font-size:1.5rem;font-weight:900;color:var(--gray)}
        .pvp-winner{padding:16px;border-radius:var(--radius-sm);background:linear-gradient(135deg,#fbbf24,#f59e0b);color:#fff;font-weight:700;font-size:1.1rem}
        .quiz-question{text-align:center;margin-bottom:24px}
        .quiz-question__hanzi{font-family:'Noto Sans SC',sans-serif;font-size:3.5rem;font-weight:900;color:var(--dark);margin-bottom:8px}
        .quiz-question__pinyin{font-size:1.2rem;color:var(--red);font-style:italic;margin-bottom:8px}
        .options-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .option-btn{padding:16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:1rem;cursor:pointer;transition:var(--transition);background:#fff}
        .option-btn:hover{border-color:var(--red)}
        .option-btn.selected{background:var(--red);border-color:var(--red);color:#fff}
        .option-btn.correct{background:var(--red-light);border-color:var(--red);color:var(--red-dark)}
        .option-btn.wrong{background:var(--red-light);border-color:var(--red);color:var(--red-dark)}
        @media(max-width:600px){.options-grid{grid-template-columns:1fr}.pvp-result__scores{grid-template-columns:1fr;gap:12px}.pvp-vs{display:none}}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="pvp-page">
        <div class="container">
            <div class="pvp-header">
                <h1> PvP — Thi đấu</h1>
                <p>Thách đấu bạn bè xem ai giỏi tiếng Trung hơn!</p>
            </div>

            <!-- Step 1: Chọn tạo hoặc join -->
            <div class="pvp-box active" id="step-menu">
                <h2> Chọn hành động</h2>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:20px;">
                    <button class="btn btn--primary ripple" onclick="showCreate()"> Tạo phòng mới</button>
                    <button class="btn btn--outline ripple" onclick="showJoin()"> Nhập mã phòng</button>
                </div>
            </div>

            <!-- Step 2a: Tạo phòng -->
            <div class="pvp-box" id="step-create">
                <h2> Tạo phòng thi đấu</h2>
                <label>Cấp độ</label>
                <select id="create-level">
                    <option value="1">HSK 1</option>
                    <option value="2">HSK 2</option>
                    <option value="3">HSK 3</option>
                    <option value="4">HSK 4</option>
                    <option value="5">HSK 5</option>
                    <option value="6">HSK 6</option>
                    <option value="0">Tất cả</option>
                </select>
                <label>Loại câu hỏi</label>
                <select id="create-type">
                    <option value="choice">Trắc nghiệm</option>
                    <option value="match">Nối từ</option>
                    <option value="listen">Nghe</option>
                </select>
                <label>Số câu</label>
                <select id="create-count">
                    <option value="5">5 câu</option>
                    <option value="10" selected>10 câu</option>
                    <option value="15">15 câu</option>
                </select>
                <div class="pvp-actions">
                    <button class="btn btn--outline ripple" onclick="backMenu()">← Quay lại</button>
                    <button class="btn btn--primary ripple" onclick="createRoom()"> Tạo phòng</button>
                </div>
            </div>

            <!-- Step 2b: Join phòng -->
            <div class="pvp-box" id="step-join">
                <h2> Nhập mã phòng</h2>
                <input type="text" id="join-code" placeholder="Nhập mã 6 ký tự" maxlength="6" style="text-transform:uppercase;text-align:center;font-size:1.5rem;letter-spacing:8px;font-weight:700;">
                <div class="pvp-actions">
                    <button class="btn btn--outline ripple" onclick="backMenu()">← Quay lại</button>
                    <button class="btn btn--primary ripple" onclick="joinRoom()"> Vào phòng</button>
                </div>
            </div>

            <!-- Step 3: Chờ đối thủ (sau khi tạo) -->
            <div class="pvp-box" id="step-waiting">
                <h2> Chờ đối thủ</h2>
                <p style="color:var(--gray);text-align:center;">Chia sẻ mã phòng này cho bạn bè:</p>
                <div class="room-code" id="room-code-display">------</div>
                <p class="empty-state-float" style="text-align:center;color:var(--gray);font-size:.85rem;">Đang chờ người chơi khác...</p>
                <p id="waiting-msg" style="text-align:center;color:var(--gray);font-size:.85rem;margin-top:8px;"></p>
                <div style="text-align:center;margin-top:16px;">
                    <button class="btn btn--primary ripple" onclick="startPvPGame()"> Bắt đầu trước</button>
                    <button class="btn btn--outline ripple" onclick="cancelRoom()" style="margin-left:8px;">Huỷ</button>
                </div>
            </div>

            <!-- Step 4: Thi đấu -->
            <div class="pvp-box" id="step-game">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                    <span style="font-weight:600;color:var(--red-dark);" id="pvp-round">1/10</span>
                    <span style="font-weight:700;color:var(--dark);" id="pvp-score"> 0</span>
                </div>
                <div id="pvp-question-area"></div>
                <div style="margin-top:20px;text-align:center;">
                    <button class="btn btn--primary ripple" id="pvp-check-btn" onclick="checkPvPAnswer()">Kiểm tra</button>
                </div>
            </div>

            <!-- Step 5: Kết quả -->
            <div class="pvp-box" id="step-result">
                <div class="pvp-result">
                    <h2 style="margin-bottom:24px;"> Kết quả</h2>
                    <div class="pvp-result__scores">
                        <div class="pvp-player" id="result-p1">
                            <div class="pvp-player__name" id="r-p1-name">Bạn</div>
                            <div class="pvp-player__score" id="r-p1-score">0/0</div>
                        </div>
                        <div class="pvp-vs">VS</div>
                        <div class="pvp-player" id="result-p2">
                            <div class="pvp-player__name" id="r-p2-name">Đối thủ</div>
                            <div class="pvp-player__score" id="r-p2-score">0/0</div>
                        </div>
                    </div>
                    <div class="pvp-winner" id="result-winner"> Bạn thắng!</div>
                    <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;">
                        <a href="pvp.php" class="btn btn--primary ripple"> Đấu tiếp</a>
                        <a href="practice.php" class="btn btn--outline ripple"> Luyện tập</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
    // Loading spinner
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    // Auto-hide on load
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

    <script>
    const API_URL = 'api.php';
    const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
    const USER_NAME = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || USER_ID;
    let roomCode = '';
    let roomId = null;
    let isCreator = false;
    let vocabList = [];
    let currentQ = 0;
    let score = 0;
    let totalQ = 10;
    let answerState = null;

    async function fetchAPI(action, data, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
            const opts = { method, headers: { 'Content-Type': 'application/json' } };
            if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
            else if (data) opts.body = JSON.stringify(data);
            return await (await fetch(url, opts)).json();
        } catch (e) { return null; }
    }

    function show(el) { document.querySelectorAll('.pvp-box').forEach(b => b.classList.remove('active')); document.getElementById(el).classList.add('active'); }
    function backMenu() { show('step-menu'); }

    function showCreate() { show('step-create'); }
    function showJoin() { show('step-join'); }

    async function createRoom() {
        const level = document.getElementById('create-level').value;
        const type = document.getElementById('create-type').value;
        const count = document.getElementById('create-count').value;
        const r = await fetchAPI('create_room', { user_id: USER_ID, user_name: USER_NAME, level: parseInt(level), quiz_type: type, total_questions: parseInt(count) }, 'POST');
        if (r && r.success) {
            roomCode = r.room_code;
            roomId = r.room_id;
            isCreator = true;
            totalQ = parseInt(count);
            document.getElementById('room-code-display').textContent = roomCode;
            show('step-waiting');
            showToast(' Đã tạo phòng! Mã: ' + roomCode, 'success');
            // Load vocab trước
            await loadVocab(parseInt(level));
        } else {
            showToast(' ' + (r?.message || 'Lỗi tạo phòng'), 'error');
        }
    }

    async function joinRoom() {
        const code = document.getElementById('join-code').value.trim().toUpperCase();
        if (code.length < 4) { showToast('⚠ Nhập mã phòng!', 'warning'); return; }
        const r = await fetchAPI('join_room', { room_code: code, user_id: USER_ID, user_name: USER_NAME }, 'POST');
        if (r && r.success) {
            roomCode = code;
            roomId = r.room.id;
            isCreator = false;
            totalQ = r.room.total_questions;
            await loadVocab(r.room.level);
            startPvPGame();
        } else {
            showToast(' ' + (r?.message || 'Không vào được phòng'), 'error');
        }
    }

    async function loadVocab(level) {
        document.getElementById('pvp-question-area').innerHTML = '<div class="loading-pulse">Đang tải...</div>';
        const data = await fetchAPI('get_vocab', { level });
        if (data && data.length > 0) {
            vocabList = level > 0 ? data.filter(v => v.level == level) : data;
        }
        if (vocabList.length < 4) vocabList = [
            { hanzi: '你好', pinyin: 'nǐ hǎo', meaning: 'Xin chào' },
            { hanzi: '谢谢', pinyin: 'xièxie', meaning: 'Cảm ơn' },
            { hanzi: '再见', pinyin: 'zàijiàn', meaning: 'Tạm biệt' },
            { hanzi: '对不起', pinyin: 'duìbuqǐ', meaning: 'Xin lỗi' },
            { hanzi: '没关系', pinyin: 'méiguānxi', meaning: 'Không sao' },
            { hanzi: '你好吗', pinyin: 'nǐ hǎo ma', meaning: 'Bạn khoẻ không' },
        ];
    }

    async function startPvPGame() {
        showToast(' Đối thủ đã vào phòng!', 'info');
        showToast(' Trận đấu bắt đầu!', 'info', 2000);
        currentQ = 0; score = 0;
        show('step-game');
        renderPvPQuestion();
    }

    async function cancelRoom() {
        show('step-menu');
    }

    function renderPvPQuestion() {
        if (currentQ >= totalQ || !vocabList.length) {
            submitPvPResult();
            return;
        }
        const v = vocabList[currentQ % vocabList.length];
        document.getElementById('pvp-round').textContent = `${currentQ + 1}/${totalQ}`;
        document.getElementById('pvp-score').textContent = ` ${score}`;

        const area = document.getElementById('pvp-question-area');
        answerState = { vocab: v, answered: false, selected: null };

        // Tạo options
        const seen = new Set([v.meaning]);
        const opts = [v.meaning];
        const shuffled = [...vocabList].sort(() => Math.random() - 0.5);
        for (const w of shuffled) { if (opts.length >= 4) break; if (!seen.has(w.meaning)) { opts.push(w.meaning); seen.add(w.meaning); } }
        opts.sort(() => Math.random() - 0.5);

        area.innerHTML = `
            <div class="quiz-question">
                <div class="quiz-question__hanzi">${esc(v.hanzi)}</div>
                <div class="quiz-question__pinyin">${esc(v.pinyin)}</div>
            </div>
            <div class="options-grid">
                ${opts.map(o => `<button class="option-btn" onclick="selectPvPOption(this, '${esc(o)}')">${esc(o)}</button>`).join('')}
            </div>
        `;
        document.getElementById('pvp-check-btn').textContent = 'Kiểm tra';
    }

    function selectPvPOption(btn, value) {
        if (answerState.answered) return;
        document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
        btn.classList.add('selected');
        answerState.selected = value;
    }

    function checkPvPAnswer() {
        if (answerState.answered) return;
        const v = answerState.vocab;
        const correct = answerState.selected === v.meaning;
        if (correct) score++;

        document.querySelectorAll('.option-btn').forEach(b => {
            if (b.textContent === v.meaning) b.classList.add('correct');
            else if (b.classList.contains('selected') && !correct) b.classList.add('wrong');
        });
        answerState.answered = true;
        document.getElementById('pvp-check-btn').textContent = 'Tiếp →';
        document.getElementById('pvp-score').textContent = ` ${score}`;

        setTimeout(() => { currentQ++; renderPvPQuestion(); }, 1000);
    }

    async function submitPvPResult() {
        const r = await fetchAPI('submit_pvp_score', { room_code: roomCode, user_id: USER_ID, score, total: totalQ }, 'POST');
        if (r && r.success && r.winner === null) {
            show('step-waiting');
            document.getElementById('room-code-display').textContent = roomCode;
            document.getElementById('waiting-msg').textContent = ' Đang chờ đối thủ hoàn thành...';
            waitForResult();
        } else {
            showPvPResult(r);
        }
    }

    async function waitForResult() {
        const interval = setInterval(async () => {
            const r = await fetchAPI('get_room', { room_code: roomCode, user_id: USER_ID });
            if (r && r.room && r.room.status === 'finished') {
                clearInterval(interval);
                showPvPResult(r.room);
            }
        }, 2000);
    }

    function showPvPResult(data) {
        show('step-result');
        const r = data.room || data;
        const p1 = data.room ? data.room : data;
        const p1s = r.player1_score || 0;
        const p1t = r.player1_total || totalQ;
        const p2s = r.player2_score || 0;
        const p2t = r.player2_total || totalQ;
        const p1n = r.player1_name || 'Bạn';
        const p2n = r.player2_name || 'Đối thủ';
        const myId = r.player1_id === USER_ID ? '1' : '2';
        const myScore = myId === '1' ? p1s : p2s;
        const myTotal = myId === '1' ? p1t : p2t;
        const opScore = myId === '1' ? p2s : p1s;
        const opTotal = myId === '1' ? p2t : p1t;
        const opName = myId === '1' ? p2n : p1n;

        document.getElementById('r-p1-name').textContent = 'Bạn (' + (myId === '1' ? p1n : p2n) + ')';
        document.getElementById('r-p1-score').textContent = `${myScore}/${myTotal}`;
        document.getElementById('r-p2-name').textContent = opName;
        document.getElementById('r-p2-score').textContent = `${opScore}/${opTotal}`;

        const myPct = myTotal > 0 ? (myScore / myTotal * 100) : 0;
        const opPct = opTotal > 0 ? (opScore / opTotal * 100) : 0;
        let msg = '';
        if (data.winner === 'Hòa' || myPct === opPct) msg = ' Hòa nhau!';
        else if (myPct > opPct) msg = ' Bạn đã thắng!';
        else msg = ' Đối thủ thắng! Cố gắng lần sau!';
        document.getElementById('result-winner').textContent = msg;
        showToast(' ' + msg, 'success');
    }

    function esc(s) { const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

    // Nav
    
        

    document.addEventListener('click', function(e) {
        document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
    });
</script>

    

    
<script src="init.js"></script>
</body>
</html>
