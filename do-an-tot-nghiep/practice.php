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
    <style>
        .practice-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafc, #eff6ff); }
        .page-header { text-align: center; margin-bottom: 40px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--red-light); color: var(--red-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
        .page-header__desc { font-size: .95rem; color: var(--gray); }

        .practice-types { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; max-width: 1000px; margin: 0 auto; }
        .practice-card { background: #fff; border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow); text-align: center; cursor: pointer; transition: var(--transition); border: 2px solid transparent; }
        .practice-card:hover { border-color: var(--red); transform: translateY(-6px); box-shadow: var(--shadow-lg); }
        .practice-card__icon { font-size: 3.5rem; margin-bottom: 16px; }
        .practice-card__title { font-size: 1.3rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .practice-card__desc { font-size: .9rem; color: var(--gray); line-height: 1.6; }
        .practice-card__btn { display: inline-block; margin-top: 16px; padding: 10px 24px; background: var(--red); color: #fff; border-radius: var(--radius-sm); font-weight: 600; }

        /* Practice Box Styles */
        .practice-box { display: none; background: #fff; border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow); max-width: 800px; margin: 0 auto; }
        .practice-box.active { display: block; }

        .question-box { text-align: center; margin-bottom: 32px; }
        .question-box__hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 4rem; font-weight: 900; color: var(--dark); margin-bottom: 16px; }
        .question-box__pinyin { font-size: 1.4rem; color: var(--red); font-weight: 600; font-style: italic; margin-bottom: 8px; }
        .question-box__meaning { font-size: 1.1rem; color: var(--gray); }

        .drag-area { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; margin-bottom: 24px; min-height: 60px; padding: 16px; background: var(--red-light); border-radius: var(--radius-sm); border: 2px dashed var(--red); }
        .drag-area.drag-over { background: var(--red); border-color: var(--dark); }
        .drag-word { padding: 12px 20px; background: #fff; border-radius: var(--radius-sm); font-size: 1.1rem; font-weight: 600; cursor: grab; box-shadow: var(--shadow); user-select: none; transition: all 0.2s; display: inline-block; }
        .drag-word:hover { transform: scale(1.05); box-shadow: var(--shadow-lg); border: 2px solid var(--red); }
        .drag-word:active { cursor: grabbing; }
        .drag-word.dropped { display: none; }

        .options-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; }
        .match-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        @media(max-width:480px){.match-grid{grid-template-columns:1fr}}
        .option-btn { padding: 16px 20px; background: #fff; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); font-size: 1rem; cursor: pointer; transition: var(--transition); }
        .option-btn:hover { border-color: var(--red); }
        .option-btn.selected { background: var(--red); border-color: var(--red); color: #fff; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3); }
        .option-btn.correct { background: var(--red-light); border-color: var(--red); color: var(--red-dark); }
        .option-btn.wrong { background: var(--red-light); border-color: var(--red); color: var(--red-dark); }

        .sentence-area { display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-bottom: 24px; }
        .sentence-slot { min-width: 50px; min-height: 40px; padding: 8px; border-bottom: 3px solid var(--red); text-align: center; font-size: 1.3rem; font-weight: 600; }
        .sentence-word { padding: 8px 14px; background: var(--red); color: #fff; border-radius: 6px; font-size: 1rem; cursor: pointer; }

        .quiz-nav { display: flex; justify-content: space-between; align-items: center; margin-top: 24px; padding-top: 24px; border-top: 1px solid var(--gray-light); }
        .quiz-progress { font-size: .9rem; color: var(--gray); }
        .quiz-actions { display: flex; gap: 12px; }

        .result-box { text-align: center; padding: 40px; }
        .result-box__score { font-size: 5rem; font-weight: 900; color: var(--red); }
        .result-box__message { font-size: 1.2rem; color: var(--dark); margin: 16px 0; }
        .result-detail { margin: 20px auto; max-width: 400px; }
        .result-detail__row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--gray-light); font-size: .9rem; }
        .result-detail__label { color: var(--gray); }
        .result-detail__value { font-weight: 600; color: var(--dark); }

        .passage-box { background: var(--red-light); border-radius: var(--radius-sm); padding: 20px; margin-bottom: 20px; }
        .passage-box__text { font-family: 'Noto Sans SC', sans-serif; font-size: 1.3rem; font-weight: 700; color: var(--dark); line-height: 1.8; margin-bottom: 8px; }
        .passage-box__note { font-size: .85rem; color: var(--gray); }

        .cloze-blank { display: inline-block; min-width: 80px; border-bottom: 3px solid var(--red); margin: 0 4px; padding: 0 4px; color: var(--red); font-weight: 700; font-size: 1.2rem; }

        .typing-input { width: 100%; max-width: 300px; padding: 16px 20px; border: 3px solid var(--gray-light); border-radius: var(--radius-sm); font-family: 'Noto Sans SC', sans-serif; font-size: 2rem; text-align: center; font-weight: 700; outline: none; transition: var(--transition); }
        .typing-input:focus { border-color: var(--red); box-shadow: 0 0 0 4px rgba(13,148,136,.15); }
        .typing-input.correct { border-color: var(--red); background: var(--red-light); }
        .typing-input.wrong { border-color: var(--red); background: var(--red-light); }

        .timer-bar { position: fixed; top: 0; left: 0; width: 100%; height: 4px; background: var(--gray-light); z-index: 1000; }
        .timer-bar__fill { height: 100%; background: linear-gradient(90deg, var(--red), var(--gold), var(--red)); transition: width 1s linear; }
        .timer-display { text-align: center; font-size: 1.2rem; font-weight: 800; color: var(--dark); margin-bottom: 16px; }
        .timer-display span { color: var(--red); }
        .timer-display.warning span { color: var(--gold-dark); }
        .timer-display.danger span { color: var(--red); }

        .sentence-parts { display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin: 20px 0; padding: 20px; background: #f8fafb; border-radius: var(--radius-sm); border: 1px solid var(--gray-light); }
        .sentence-part { padding: 12px 20px; background: #fff; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); font-family: 'Noto Sans SC', sans-serif; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: var(--transition); user-select: none; }
        .sentence-part:hover { border-color: var(--red); transform: translateY(-2px); }
        .sentence-part.selected { border-color: var(--red); background: var(--red); color: #fff; }
        .sentence-part.used { opacity: .3; pointer-events: none; }
        .sentence-answer { display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; min-height: 50px; padding: 12px; background: var(--red-light); border-radius: var(--radius-sm); margin-bottom: 12px; border: 2px dashed var(--red); }
        .sentence-answer__part { padding: 8px 16px; background: var(--red); color: #fff; border-radius: 6px; font-family: 'Noto Sans SC', sans-serif; font-size: 1rem; font-weight: 600; cursor: pointer; transition: var(--transition); }
        .sentence-answer__part:hover { opacity: .8; }

        @media(max-width:768px) { .options-grid{grid-template-columns:1fr} }
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

            <div id="practice-config">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
                <div style="display:flex;align-items:center;gap:12px;">
                    <label style="font-weight:600;color:var(--dark);">Chọn cấp độ:</label>
                    <select id="level-select" style="padding:10px 18px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;font-weight:600;background:#fff;cursor:pointer;">
                        <option value="0"> Tất cả</option>
                        <option value="1" selected>HSK 1</option>
                        <option value="2">HSK 2</option>
                        <option value="3">HSK 3</option>
                        <option value="4">HSK 4</option>
                        <option value="5">HSK 5</option>
                        <option value="6">HSK 6</option>
                    </select>
                </div>
                <button class="btn btn--outline btn--sm ripple" onclick="toggleHistory()"> Lịch sử</button>
            </div>

            <!-- Quiz History -->
            <div id="quiz-history" style="display:none;margin-bottom:24px;">
                <div class="user-progress">
                    <div class="user-progress__title"> Lịch sử luyện tập</div>
                    <div id="history-list" style="margin-top:12px;max-height:300px;overflow-y:auto;"></div>
                </div>
            </div>

            <div class="practice-types" id="practice-types">
                <div class="practice-card reveal" onclick="startPractice('choice')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Trắc nghiệm từ vựng</h3>
                    <p class="practice-card__desc">Chọn nghĩa đúng của từ tiếng Trung</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('match')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Nối từ - Nghĩa</h3>
                    <p class="practice-card__desc">Nối từ tiếng Trung với nghĩa tiếng Việt tương ứng</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('drag')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Xếp chữ thành từ/câu</h3>
                    <p class="practice-card__desc">Xếp các chữ/ký tự theo thứ tự đúng dựa vào nghĩa</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('listen')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Nghe và chọn</h3>
                    <p class="practice-card__desc">Nghe phát âm và chọn từ đúng</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('reading')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Đọc hiểu</h3>
                    <p class="practice-card__desc">Đọc câu tiếng Trung và chọn nghĩa đúng</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('cloze')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Điền khuyết</h3>
                    <p class="practice-card__desc">Điền từ còn thiếu vào câu</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('typing')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Gõ chữ Hán</h3>
                    <p class="practice-card__desc">Nhìn pinyin và nghĩa, gõ chữ Hán tương ứng</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('sentence')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Ghép câu</h3>
                    <p class="practice-card__desc">Sắp xếp các phần để tạo thành câu hoàn chỉnh</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
                <div class="practice-card reveal" onclick="startPractice('timed')">
                    <div class="practice-card__icon"></div>
                    <h3 class="practice-card__title">Thử thách</h3>
                    <p class="practice-card__desc">Trả lời nhanh trong 60 giây</p>
                    <span class="practice-card__btn">Bắt đầu</span>
                </div>
            </div>
            </div>

            <!-- Practice Box - Drag & Drop -->
            <div class="practice-box" id="practice-box">
                <div id="practice-area"></div>

                <div class="quiz-nav">
                    <span class="quiz-progress" id="quiz-progress">Câu 1/10</span>
                    <div class="quiz-actions">
                        <button class="btn btn--outline ripple" onclick="showMenu()">← Quay lại</button>
                        <button class="btn btn--primary ripple" id="btn-check" onclick="checkAnswer()">Kiểm tra</button>
                    </div>
                </div>
            </div>

            <!-- Result Box -->
            <div class="practice-box" id="result-box">
                <div class="result-box">
                    <div class="result-box__score" id="result-score">0%</div>
                    <div class="result-box__message" id="result-message">Chưa hoàn thành</div>
                    <div class="quiz-actions" style="justify-content: center;">
                        <button class="btn btn--primary ripple" onclick="showMenu()">Làm lại</button>
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
    const fallbackVocab = [
        { id: 1, hanzi: '你好', pinyin: 'nǐ hǎo', meaning: 'Xin chào', level: 1 },
        { id: 2, hanzi: '谢谢', pinyin: 'xièxie', meaning: 'Cảm ơn', level: 1 },
        { id: 3, hanzi: '再见', pinyin: 'zàijiàn', meaning: 'Tạm biệt', level: 1 },
        { id: 4, hanzi: '对不起', pinyin: 'duìbuqǐ', meaning: 'Xin lỗi', level: 1 },
        { id: 5, hanzi: '没关系', pinyin: 'méiguānxi', meaning: 'Không sao', level: 1 },
        { id: 6, hanzi: '我爱你', pinyin: 'wǒ ài nǐ', meaning: 'Tôi yêu bạn', level: 1 },
        { id: 7, hanzi: '早上好', pinyin: 'zǎoshang hǎo', meaning: 'Chào buổi sáng', level: 1 },
        { id: 8, hanzi: '晚上好', pinyin: 'wǎnshang hǎo', meaning: 'Chào buổi tối', level: 1 },
        { id: 9, hanzi: '你叫什么', pinyin: 'nǐ jiào shénme', meaning: 'Bạn tên gì', level: 1 },
        { id: 10, hanzi: '我是学生', pinyin: 'wǒ shì xuéshēng', meaning: 'Tôi là học sinh', level: 1 },
    ];

    let vocabList = [];
    let currentIndex = 0;
    let score = 0;
    let totalQuestions = 10;
    let currentType = '';
    let currentLevel = 0;
    let answerState = null;
    let currentTimedSubType = 'choice';
    let timedTimer = null;
    let timedTimeLeft = 60;
    let timedScore = 0;
    let timedTotal = 0;

    async function fetchAPI(action, data = null, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
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

    async function loadVocab(level) {
        document.getElementById('practice-area').innerHTML = '<div class="loading-pulse">Đang tải...</div>';
        const data = await fetchAPI('get_vocab', { level: level || 0 });
        console.log('Vocab data:', data);
        let list = data && data.length > 0 ? data : fallbackVocab;
        if (level > 0) {
            list = list.filter(v => v.level == level);
        }
        vocabList = list;
        console.log('Vocab list loaded, count:', vocabList.length);
    }

    function speak(text) {
        if ('speechSynthesis' in window) {
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'zh-CN';
            utterance.rate = 0.8;
            speechSynthesis.speak(utterance);
        }
    }

    async function startPractice(type) {
        const levelSelect = document.getElementById('level-select');
        currentLevel = parseInt(levelSelect?.value) || 0;
        showToast(' Đã chọn HSK ' + (currentLevel || 'tất cả'), 'info', 1500);

        document.getElementById('practice-area').innerHTML = '<div style="text-align:center;padding:40px;"> Đang tải dữ liệu...</div>';
        await loadVocab(currentLevel);

        if (vocabList.length < 4) {
            document.getElementById('practice-area').innerHTML = '<div class="empty-state-float" style="text-align:center;padding:40px;color:var(--gray);"> Cần ít nhất 4 từ vựng để luyện tập.</div>';
            return;
        }

        currentType = type;
        currentIndex = 0;
        score = 0;
        document.getElementById('practice-config').style.display = 'none';
        document.getElementById('practice-types').style.display = 'none';
        document.getElementById('practice-box').classList.add('active');
        document.getElementById('result-box').classList.remove('active');
        renderQuestion();
    }

    function renderQuestion() {
        if (!vocabList || vocabList.length === 0) {
            document.getElementById('practice-area').innerHTML = '<div class="empty-state-float" style="text-align:center;padding:40px;color:var(--gray);"> Chưa có từ vựng. Vui lòng vào bài học trước!</div>';
            return;
        }

        const vocab = vocabList[currentIndex % vocabList.length];
        document.getElementById('quiz-progress').textContent = `Câu ${currentIndex + 1}/${totalQuestions}`;

        const area = document.getElementById('practice-area');
        answerState = { vocab: vocab, answered: false };

        if (currentType === 'choice') {
            const options = generateOptions(vocab);
            answerState.correctAnswer = vocab.meaning;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Chọn nghĩa đúng của từ:</p>
                <div class="question-box__hanzi" style="font-size:3rem;">${escapeHtml(vocab.hanzi)}</div>
                <div class="question-box__pinyin">${escapeHtml(vocab.pinyin)}</div>
                <div class="options-grid">
                    ${options.map(o => `<button class="option-btn" onclick="selectOption(this, '${escapeHtml(o)}')">${escapeHtml(o)}</button>`).join('')}
                </div>
            `;
        } else if (currentType === 'match') {
            // Nối từ - nghĩa dùng chung 1 bảng
            const pool = shuffleArray([vocab, ...getRandomVocab(3)]);
            answerState = { vocab: vocab, answered: false, selectedHanzi: null, selectedMeaning: null };
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Nối từ với nghĩa đúng (chọn 1 ô mỗi cột):</p>
                <div class="match-grid">
                    <div>
                        <h4 style="text-align:center;margin-bottom:12px;">Từ tiếng Trung</h4>
                        ${pool.map(v => `<button class="option-btn match-btn" data-type="hanzi" data-vocab-id="${v.id}" onclick="selectMatchOption(this, 'hanzi', ${v.id})">${escapeHtml(v.hanzi)}</button>`).join('')}
                    </div>
                    <div>
                        <h4 style="text-align:center;margin-bottom:12px;">Nghĩa tiếng Việt</h4>
                        ${shuffleArray([...pool]).map(v => `<button class="option-btn match-btn" data-type="meaning" data-vocab-id="${v.id}" onclick="selectMatchOption(this, 'meaning', ${v.id})">${escapeHtml(v.meaning)}</button>`).join('')}
                    </div>
                </div>
            `;
        } else if (currentType === 'drag') {
            // Xếp chữ theo thứ tự đúng
            const chars = vocab.hanzi.split('');
            const shuffled = shuffleArray(chars);

            answerState.sentence = chars;
            answerState.userAnswer = [];

            area.innerHTML = `
                <div style="text-align:center;margin-bottom:20px;padding:16px;background:var(--red-light);border-radius:12px;">
                    <p style="font-size:0.9rem;color:var(--gray);margin-bottom:8px;"> Sắp xếp các chữ để tạo thành từ "${escapeHtml(vocab.meaning)}":</p>
                    <p style="font-size:1.4rem;font-weight:700;color:var(--dark);">${escapeHtml(vocab.pinyin)}</p>
                </div>
                <div class="drag-area" id="drop-zone" style="flex-direction:row;">
                    <span style="color:var(--gray);font-size:0.9rem;"> Click chọn chữ để xếp</span>
                </div>
                <div id="word-container" style="display:flex;gap:10px;flex-wrap:wrap;justify-content:center;margin-top:20px;padding:20px;background:#f8fafb;border-radius:12px;border:1px solid var(--gray-light);">
                    ${shuffled.map((w, i) => `<div class="drag-word" data-char="${escapeHtml(w)}" onclick="toggleWord(this)">${escapeHtml(w)}</div>`).join('')}
                </div>
            `;
        } else if (currentType === 'listen') {
            const options = generateOptions(vocab);
            answerState.correctAnswer = vocab.meaning;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Nghe và chọn nghĩa:</p>
                <button class="btn btn--primary ripple" onclick="speak('${escapeHtml(vocab.hanzi)}')" style="margin-bottom:20px;"> Nghe phát âm</button>
                <div class="options-grid">
                    ${options.map(o => `<button class="option-btn" onclick="selectOption(this, '${escapeHtml(o)}')">${escapeHtml(o)}</button>`).join('')}
                </div>
            `;
            setTimeout(() => speak(vocab.hanzi), 500);
        } else if (currentType === 'reading') {
            const passage = vocab.example || vocab.hanzi;
            const options = generateReadingOptions(vocab);
            answerState.correctAnswer = vocab.example_vi || vocab.meaning;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Đọc câu sau và chọn nghĩa đúng:</p>
                <div class="passage-box">
                    <div class="passage-box__text">${escapeHtml(passage)}</div>
                    <div class="passage-box__note">${escapeHtml(vocab.pinyin)}</div>
                </div>
                <div class="options-grid">
                    ${options.map(o => `<button class="option-btn" onclick="selectOption(this, '${escapeHtml(o)}')">${escapeHtml(o)}</button>`).join('')}
                </div>
            `;
        } else if (currentType === 'cloze') {
            const sentence = (vocab.example || vocab.hanzi).replace(vocab.hanzi, '______');
            const options = generateClozeOptions(vocab);
            answerState.correctAnswer = vocab.hanzi;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Chọn từ còn thiếu trong câu:</p>
                <div class="passage-box">
                    <div class="passage-box__text">${escapeHtml(sentence)}</div>
                    <div class="passage-box__note">${escapeHtml(vocab.meaning)}</div>
                </div>
                <div class="options-grid">
                    ${options.map(o => `<button class="option-btn" onclick="selectOption(this, '${escapeHtml(o)}')">${escapeHtml(o)}</button>`).join('')}
                </div>
            `;
        } else if (currentType === 'typing') {
            answerState.correctAnswer = vocab.hanzi;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Nhìn pinyin và nghĩa, gõ chữ Hán tương ứng:</p>
                <div class="question-box__pinyin">${escapeHtml(vocab.pinyin)}</div>
                <div style="font-size:1.1rem;color:var(--gray);margin-bottom:20px;">${escapeHtml(vocab.meaning)}</div>
                <input type="text" class="typing-input" id="typing-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Gõ chữ Hán...">
                <div style="margin-top:12px;font-size:.85rem;color:var(--gray);">Nhấn Enter để kiểm tra</div>
            `;
            setTimeout(() => {
                const inp = document.getElementById('typing-input');
                if (inp) { inp.focus(); inp.addEventListener('keydown', function handler(e) { if (e.key === 'Enter') { e.preventDefault(); checkAnswer(); inp.removeEventListener('keydown', handler); } }); }
            }, 100);
        } else if (currentType === 'sentence') {
            const parts = (vocab.example || vocab.hanzi).split(/[，。！？、；：\s]+/).filter(Boolean);
            if (parts.length < 2) parts.push(...vocab.hanzi.split(''));
            const shuffled = shuffleArray([...parts]);
            answerState.sentenceParts = parts;
            area.innerHTML = `
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Sắp xếp các phần để tạo thành câu hoàn chỉnh:</p>
                <div style="text-align:center;margin-bottom:12px;color:var(--gray);font-size:.9rem;"> ${escapeHtml(vocab.meaning)}</div>
                <div class="sentence-answer" id="sentence-answer"></div>
                <div class="sentence-parts" id="sentence-parts">
                    ${shuffled.map(p => `<div class="sentence-part" onclick="toggleSentencePart(this)">${escapeHtml(p)}</div>`).join('')}
                </div>
            `;
        } else if (currentType === 'timed') {
            document.getElementById('quiz-progress').style.display = 'none';
            const options = generateOptions(vocab);
            answerState.correctAnswer = vocab.meaning;
            area.innerHTML = `
                <div class="timer-display" id="timer-display"> <span id="timer-value">${timedTimeLeft}</span>s</div>
                <p style="text-align:center;margin-bottom:16px;color:var(--gray);">Trả lời nhanh! (Đã trả lời: ${timedTotal})</p>
                <div class="question-box__hanzi" style="font-size:3rem;">${escapeHtml(vocab.hanzi)}</div>
                <div class="question-box__pinyin">${escapeHtml(vocab.pinyin)}</div>
                <div class="options-grid">
                    ${options.map(o => `<button class="option-btn" onclick="selectOption(this, '${escapeHtml(o)}')">${escapeHtml(o)}</button>`).join('')}
                </div>
            `;
            document.getElementById('btn-check').textContent = 'Kiểm tra';
            if (!timedTimer) startTimedTimer();
        }
    }

    function getRandomVocab(count) {
        const shuffled = [...vocabList].sort(() => Math.random() - 0.5);
        return shuffled.slice(0, count);
    }

    // Hàm xáo trộn an toàn (không mutate mảng gốc)
    function shuffleArray(arr) {
        const copy = [...arr];
        for (let i = copy.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [copy[i], copy[j]] = [copy[j], copy[i]];
        }
        return copy;
    }

    function generateOptions(correct) {
        const seen = new Set();
        const options = [correct.meaning];
        seen.add(correct.meaning);

        // Tạo bản sao và xáo trộn để tránh mutate mảng gốc
        const shuffled = [...vocabList].sort(() => Math.random() - 0.5);

        for (const v of shuffled) {
            if (options.length >= 4) break;
            if (!seen.has(v.meaning)) {
                options.push(v.meaning);
                seen.add(v.meaning);
            }
        }

        return options.sort(() => Math.random() - 0.5);
    }

    // Lấy từ gây nhiễu (khác với các ký tự trong câu đúng)
    function getWrongWord() {
        const allWrongChars = ['的', '是', '在', '有', '我', '你', '他', '她', '们', '了', '和', '就', '不', '也', '这', '那', '都', '要', '会', '能', '好', '看', '说', '请', '慢', '快', '大', '小', '多', '少', '没', '什', '么'];
        const correctChars = answerState.sentence || [];
        // Lọc bỏ các ký tự đã có trong câu đúng
        const availableChars = allWrongChars.filter(c => !correctChars.includes(c));
        // Chọn ngẫu nhiên
        return availableChars[Math.floor(Math.random() * availableChars.length)] || '的';
    }

    function toggleWord(el) {
        if (answerState && answerState.answered) return;

        const dropZone = document.getElementById('drop-zone');
        const wordContainer = document.getElementById('word-container');
        const isInZone = dropZone.contains(el);

        if (isInZone) {
            // Remove from drop zone - move back to word container
            el.style.display = 'inline-block';
            wordContainer.appendChild(el);
        } else {
            // Add to drop zone - hide from word container
            el.style.display = 'none';
            dropZone.appendChild(el);
        }
    }

    function selectOption(btn, value) {
        if (answerState.answered) return;
        // Bỏ chọn tất cả option trước đó
        document.querySelectorAll('.option-btn').forEach(b => {
            b.classList.remove('correct', 'wrong', 'selected');
        });
        // Chọn option mới
        answerState.selected = value;
        btn.classList.add('selected');
    }

    function selectMatchOption(btn, type, vocabId) {
        if (answerState.answered) return;

        document.querySelectorAll(`.match-btn[data-type="${type}"]`).forEach(b => {
            b.classList.remove('selected');
        });

        btn.classList.add('selected');

        if (type === 'hanzi') {
            answerState.selectedHanzi = vocabId;
        } else {
            answerState.selectedMeaning = vocabId;
        }
    }

    async function checkAnswer() {
        if (currentType === 'timed') {
            if (answerState.answered) return;
            const vocab = answerState.vocab;
            const isCorrect = answerState.selected === answerState.correctAnswer;
            if (isCorrect) timedScore++;
            timedTotal++;
            document.querySelectorAll('.option-btn').forEach(btn => {
                if (btn.textContent === vocab.meaning) btn.classList.add('correct');
                else if (btn.classList.contains('selected') && !isCorrect) btn.classList.add('wrong');
            });
            answerState.answered = true;
            setTimeout(() => renderTimedNext(), 800);
            return;
        }

        let isCorrect = false;
        const vocab = answerState.vocab;

        if (currentType === 'drag') {
            const dropZone = document.getElementById('drop-zone');
            const droppedWords = Array.from(dropZone.children)
                .filter(el => el.classList.contains('drag-word'))
                .map(el => el.dataset.char);

            isCorrect = droppedWords.length === vocab.hanzi.length && droppedWords.join('') === vocab.hanzi;
            if (!isCorrect && droppedWords.length > 0) {
                let matchCount = 0;
                for (let i = 0; i < Math.min(droppedWords.length, vocab.hanzi.length); i++) {
                    if (droppedWords[i] === vocab.hanzi[i]) matchCount++;
                }
            }
        } else if (currentType === 'match') {
            isCorrect = answerState.selectedHanzi === vocab.id && answerState.selectedMeaning === vocab.id;
            document.querySelectorAll('.match-btn').forEach(btn => {
                const vid = parseInt(btn.dataset.vocabId);
                if (vid === vocab.id) btn.classList.add('correct');
                else if (btn.classList.contains('selected') && !isCorrect) btn.classList.add('wrong');
            });
        } else if (currentType === 'choice' || currentType === 'listen') {
            isCorrect = answerState.selected === answerState.correctAnswer;
            document.querySelectorAll('.option-btn').forEach(btn => {
                if (btn.textContent === vocab.meaning) btn.classList.add('correct');
                else if (btn.classList.contains('selected') && !isCorrect) btn.classList.add('wrong');
            });
        } else if (currentType === 'reading') {
            isCorrect = answerState.selected === answerState.correctAnswer;
            document.querySelectorAll('.option-btn').forEach(btn => {
                if (btn.textContent === (vocab.example_vi || vocab.meaning)) btn.classList.add('correct');
                else if (btn.classList.contains('selected') && !isCorrect) btn.classList.add('wrong');
            });
        } else if (currentType === 'cloze') {
            isCorrect = answerState.selected === answerState.correctAnswer;
            document.querySelectorAll('.option-btn').forEach(btn => {
                if (btn.textContent === vocab.hanzi) btn.classList.add('correct');
                else if (btn.classList.contains('selected') && !isCorrect) btn.classList.add('wrong');
            });
        } else if (currentType === 'typing') {
            const input = document.getElementById('typing-input');
            const val = input ? input.value.trim() : '';
            isCorrect = val === vocab.hanzi;
            if (input) { input.classList.add(isCorrect ? 'correct' : 'wrong'); input.disabled = true; }
        } else if (currentType === 'sentence') {
            const answerEl = document.getElementById('sentence-answer');
            const userParts = Array.from(answerEl ? answerEl.children : []).map(el => el.textContent);
            isCorrect = userParts.length === answerState.sentenceParts.length && userParts.every((p, i) => p === answerState.sentenceParts[i]);
        }

        if (isCorrect) score++;

        answerState.answered = true;
        document.getElementById('btn-check').textContent = 'Tiếp theo →';

        setTimeout(() => nextQuestion(), 1500);
    }

    function nextQuestion() {
        currentIndex++;
        document.getElementById('btn-check').textContent = 'Kiểm tra';

        if (currentIndex >= totalQuestions) {
            showResult();
        } else {
            renderQuestion();
        }
    }

    async function showResult() {
        document.getElementById('practice-box').classList.remove('active');
        document.getElementById('result-box').classList.add('active');

        const percent = Math.round((score / totalQuestions) * 100);
        document.getElementById('result-score').textContent = percent + '%';

        let message = '';
        if (percent >= 90) message = ' Tuyệt vời! Bạn làm rất tốt!';
        else if (percent >= 70) message = ' Làm tốt lắm! Tiếp tục cố gắng nhé!';
        else if (percent >= 50) message = ' Khá lắm! Hãy ôn lại thêm nhé!';
        else message = ' Cần ôn lại bài nhiều hơn. Bạn có thể làm lại!';

        document.getElementById('result-message').textContent = message;

        // Lưu kết quả
                await fetchAPI('save_quiz_result', {
            quiz_type: currentType,
            level: currentLevel,
            score: score,
            total_questions: totalQuestions
        }, 'POST');
        showToast(' Đã lưu kết quả!', 'success', 2000);
    }

    function showMenu() {
        if (timedTimer) { clearInterval(timedTimer); timedTimer = null; }
        timedTimeLeft = 60; timedScore = 0; timedTotal = 0;
        document.getElementById('quiz-progress').style.display = '';
        document.getElementById('practice-config').style.display = '';
        document.getElementById('practice-types').style.display = 'grid';
        document.getElementById('practice-box').classList.remove('active');
        document.getElementById('result-box').classList.remove('active');
        showToast(' Đã quay lại menu', 'info', 1500);
        loadHistory();
    }

    // ===== QUIZ HISTORY =====
    async function toggleHistory() {
        const el = document.getElementById('quiz-history');
        if (el.style.display === 'block') { el.style.display = 'none'; return; }
        el.style.display = 'block';
        await loadHistory();
    }

    async function loadHistory() {
        const list = document.getElementById('history-list');
        list.innerHTML = '<p style="color:var(--gray);text-align:center;"></p>';
        const data = await fetchAPI('get_quiz_history');
        if (!data || data.length === 0) {
            list.innerHTML = '<p class="empty-state-float" style="color:var(--gray);text-align:center;">Chưa có lịch sử luyện tập.</p>';
            return;
        }
        const typeLabels = { choice: 'Trắc nghiệm', match: 'Nối từ', drag: 'Xếp chữ', listen: 'Nghe', reading: 'Đọc hiểu', cloze: 'Điền khuyết', typing: 'Gõ chữ', sentence: 'Ghép câu', timed: 'Thử thách' };
        list.innerHTML = data.map(r => `
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:rgba(255,255,255,0.1);border-radius:8px;margin-bottom:8px;font-size:.85rem;">
                <span>${typeLabels[r.quiz_type] || r.quiz_type} • HSK ${r.level || 'all'}</span>
                <span>${r.score}/${r.total_questions} (<strong>${Math.round(r.score/r.total_questions*100)}%</strong>)</span>
                <span style="color:var(--gray);font-size:.75rem;">${r.completed_at ? new Date(r.completed_at).toLocaleDateString('vi') : ''}</span>
            </div>
        `).join('');
    }

    // ===== HELPER =====
    function escapeHtml(str) {
        if (!str) return '';
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function generateReadingOptions(correct) {
        const seen = new Set();
        const correctVal = correct.example_vi || correct.meaning;
        const options = [correctVal];
        seen.add(correctVal);
        const shuffled = [...vocabList].sort(() => Math.random() - 0.5);
        for (const v of shuffled) {
            if (options.length >= 4) break;
            const val = v.example_vi || v.meaning;
            if (!seen.has(val)) { options.push(val); seen.add(val); }
        }
        return options.sort(() => Math.random() - 0.5);
    }

    function generateClozeOptions(correct) {
        const seen = new Set([correct.hanzi]);
        const options = [correct.hanzi];
        const shuffled = [...vocabList].sort(() => Math.random() - 0.5);
        for (const v of shuffled) {
            if (options.length >= 4) break;
            if (!seen.has(v.hanzi)) { options.push(v.hanzi); seen.add(v.hanzi); }
        }
        return options.sort(() => Math.random() - 0.5);
    }

    function toggleSentencePart(el) {
        if (answerState && answerState.answered) return;
        const answer = document.getElementById('sentence-answer');
        const parts = document.getElementById('sentence-parts');
        if (!answer || !parts) return;
        if (el.parentElement === answer) {
            parts.appendChild(el);
        } else {
            answer.appendChild(el);
        }
    }

    function startTimedTimer() {
        timedTimer = setInterval(() => {
            timedTimeLeft--;
            const tv = document.getElementById('timer-value');
            if (tv) tv.textContent = timedTimeLeft;
            const td = document.getElementById('timer-display');
            if (td) {
                td.className = 'timer-display' + (timedTimeLeft <= 10 ? ' danger' : timedTimeLeft <= 20 ? ' warning' : '');
            }
            if (timedTimeLeft <= 0) {
                clearInterval(timedTimer);
                timedTimer = null;
                showTimedResult();
            }
        }, 1000);
    }

    function renderTimedNext() {
        if (timedTimeLeft <= 0) { showTimedResult(); return; }
        currentIndex = (currentIndex + 1) % vocabList.length;
        renderQuestion();
    }

    function showTimedResult() {
        if (timedTimer) { clearInterval(timedTimer); timedTimer = null; }
        document.getElementById('practice-box').classList.remove('active');
        document.getElementById('result-box').classList.add('active');
        const percent = timedTotal > 0 ? Math.round((timedScore / timedTotal) * 100) : 0;
        document.getElementById('result-score').textContent = timedScore + '/' + timedTotal + ' (' + percent + '%)';
        let message = '';
        if (percent >= 90) message = ' Tuyệt vời! Phản xạ rất nhanh!';
        else if (percent >= 70) message = ' Phản xạ tốt! Luyện thêm nhé!';
        else if (percent >= 50) message = ' Khá lắm! Cố gắng nhanh hơn!';
        else message = ' Cần luyện thêm để tăng tốc độ!';
        document.getElementById('result-message').textContent = message;
        document.getElementById('quiz-progress').style.display = '';
        fetchAPI('save_quiz_result', { quiz_type: 'timed', level: currentLevel, score: timedScore, total_questions: timedTotal }, 'POST');
        showToast(' Đã lưu kết quả!', 'success', 2000);
    }

    loadVocab(1);
    loadHistory();
    </script>

    
<script src="utils.js"></script>
<script src="init.js"></script>
</body>
</html>