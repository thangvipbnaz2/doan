<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Luyện viết chữ Hán - Học tiếng Trung qua luyện tập nét chữ với hướng dẫn trực quan.">
    <title>Luyện viết chữ Hán - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="lesson.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<!-- ===== LESSON CONTENT ===== -->
    <main class="lesson-page">
        <div class="container">
            <!-- Breadcrumb -->
            <div class="breadcrumb" id="breadcrumb">
                <a href="index.php">Trang chủ</a>
                <span class="breadcrumb__sep">›</span>
                <a href="index.php#roadmap" id="breadcrumb-level">HSK 1</a>
                <span class="breadcrumb__sep">›</span>
                <span class="breadcrumb__current" id="breadcrumb-lesson">Bài 1</span>
            </div>

            <!-- Lesson Header -->
            <div class="lesson-header" id="lesson-header">
                <div class="lesson-header__info">
                    <span class="lesson-header__badge" id="lesson-badge">HSK 1 · Bài 1</span>
                    <h1 class="lesson-header__title" id="lesson-title">Chào hỏi cơ bản</h1>
                    <p class="lesson-header__desc" id="lesson-desc">Học cách chào hỏi và giới thiệu bản thân bằng tiếng Trung.</p>
                </div>
                <div class="lesson-header__progress">
                    <div class="progress-ring" id="progress-ring">
                        <svg viewBox="0 0 80 80">
                            <circle class="progress-ring__bg" cx="40" cy="40" r="34"></circle>
                            <circle class="progress-ring__fill" cx="40" cy="40" r="34" id="progress-circle"></circle>
                        </svg>
                        <span class="progress-ring__text" id="progress-text">1/5</span>
                    </div>
                </div>
            </div>

            <!-- Main Lesson Layout -->
            <div class="lesson-layout">
                <!-- Left: Character Display -->
                <div class="lesson-card char-display" id="char-display">
                    <div class="char-display__main">
                        <span class="char-display__hanzi" id="hanzi-display">你</span>
                    </div>
                    <div class="char-display__details">
                        <span class="char-display__pinyin" id="pinyin-display">nǐ</span>
                        <span class="char-display__meaning" id="meaning-display">Bạn / Anh / Chị</span>
                    </div>
                    <div class="char-display__audio">
                        <button class="btn-icon" id="btn-audio" aria-label="Phát âm" title="Phát âm">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path></svg>
                        </button>
                        <button class="btn btn--gold btn--sm ripple" id="btn-save-word" title="Lưu vào sổ tay">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
                            Lưu từ
                        </button>
                    </div>

                    <!-- Speech Practice -->
                    <div class="speech-practice" id="speech-practice">
                        <h3 class="speech-practice__title"> Luyện nói</h3>
                        <div class="speech-mic-wrapper">
                            <div class="mic-pulse" id="mic-pulse"></div>
                            <button class="btn-mic" id="btn-mic" aria-label="Bấm để nói" title="Bấm để nói">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                                    <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                                    <line x1="12" y1="19" x2="12" y2="23"></line>
                                    <line x1="8" y1="23" x2="16" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                        <p class="speech-status" id="speech-status">Nhấn micro để bắt đầu nói</p>
                        <div class="speech-result" id="speech-result" style="display:none;">
                            <div class="speech-score-ring" id="speech-score-ring">
                                <svg viewBox="0 0 100 100">
                                    <circle class="score-ring__bg" cx="50" cy="50" r="42"></circle>
                                    <circle class="score-ring__fill" cx="50" cy="50" r="42" id="score-circle"></circle>
                                </svg>
                                <span class="score-ring__text" id="score-text">0%</span>
                            </div>
                            <p class="speech-transcript" id="speech-transcript"></p>
                            <p class="speech-feedback" id="speech-feedback"></p>
                        </div>
                    </div>

                    <!-- Word Navigation -->
                    <div class="char-nav" id="char-nav">
                        <button class="btn btn--outline btn--sm ripple" id="btn-prev" disabled data-tooltip="Bài trước">← Trước</button>
                        <div class="char-nav__dots" id="char-dots"></div>
                        <button class="btn btn--outline btn--sm ripple" id="btn-next" data-tooltip="Bài tiếp">Tiếp →</button>
                    </div>
                </div>

                <!-- Right: Practice Area -->
                <div class="lesson-card practice-area" id="practice-area">
                    <div class="practice-area__tabs">
                        <button class="tab tab--active" id="tab-write" data-tab="write"> Luyện viết</button>
                        <button class="tab" id="tab-guide" data-tab="guide"> Hướng dẫn nét</button>
                    </div>

                    <!-- Tab: Writing Practice -->
                    <div class="tab-content tab-content--active" id="content-write">
                        <div class="canvas-wrapper" id="canvas-wrapper">
                            <canvas id="writing-canvas" width="300" height="300"></canvas>
                            <!-- Ghost character behind canvas -->
                            <span class="canvas-ghost" id="canvas-ghost">你</span>
                        </div>
                        <div class="practice-actions">
                            <button class="btn btn--outline btn--sm ripple" id="btn-clear">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M8 6V4h8v2"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path></svg>
                                Xóa
                            </button>
                            <button class="btn btn--primary btn--sm ripple" id="btn-show-hint">Hiện gợi ý</button>
                            <button class="btn btn--gold btn--sm ripple" id="btn-check-handwriting"> Kiểm tra</button>
                        </div>
                        <div id="handwriting-result" style="margin-top:12px;text-align:center;min-height:24px;font-size:.9rem;font-weight:600;"></div>
                    </div>

                    <!-- Tab: Stroke Guide (hanzi-writer) -->
                    <div class="tab-content" id="content-guide">
                        <div class="char-tabs" id="char-tabs" style="display:none;"></div>
                        <div class="guide-wrapper">
                            <div id="hanzi-writer-target" class="hanzi-writer-box"></div>
                        </div>
                        <div class="practice-actions">
                            <button class="btn btn--gold btn--sm ripple" id="btn-animate">
                                ▶ Xem hướng dẫn
                            </button>
                            <button class="btn btn--outline btn--sm ripple" id="btn-quiz">
                                 Kiểm tra nét
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Extra Info Cards -->
            <div class="info-cards" id="info-cards">
                <div class="info-card">
                    <div class="info-card__icon"></div>
                    <h3>Số nét</h3>
                    <p class="info-card__value" id="stroke-count">--</p>
                </div>
                <div class="info-card">
                    <div class="info-card__icon"></div>
                    <h3>Bộ thủ</h3>
                    <p class="info-card__value" id="radical-info">--</p>
                </div>
                <div class="info-card">
                    <div class="info-card__icon"></div>
                    <h3>Ví dụ</h3>
                    <p class="info-card__value info-card__value--example" id="example-sentence">--</p>
                    <p class="info-card__vi" id="example-vi" style="color:#64748b;font-size:0.9em;margin-top:4px;"></p>
                </div>
            </div>

            <!-- Quiz Section -->
            <div class="quiz-section" id="quiz-section" style="display:none;">
                <h3 class="quiz-section__title"> Kiểm tra kiến thức</h3>
                <div id="quiz-container"></div>
                                <button class="btn btn--primary ripple" id="btn-check-quiz" onclick="checkQuiz()" style="margin-top:16px;">Kiểm tra</button>
            </div>

            <!-- Grammar Section -->
            <div class="grammar-section" id="grammar-section" style="display:none;">
                <h3 class="grammar-section__title"> Ngữ pháp</h3>
                <div id="grammar-container"></div>
            </div>

            <!-- Progress Indicator -->
            <div class="progress-indicator" id="progress-indicator">
                <div class="progress-item">
                    <div class="progress-item__label">Viết</div>
                    <div class="progress-item__status" id="write-status"></div>
                </div>
                <div class="progress-item">
                    <div class="progress-item__label">Nói</div>
                    <div class="progress-item__status" id="speak-status"></div>
                </div>
                <div class="progress-item">
                    <div class="progress-item__label">Quiz</div>
                    <div class="progress-item__status" id="quiz-status"></div>
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

    <!-- ===== FOOTER ===== -->
    <footer class="footer" id="footer">
        <div class="footer__bottom">
            <div class="container">
                <p>&copy; 2026 HànNgữ. Thiết kế với  cho cộng đồng học tiếng Trung.</p>
            </div>
        </div>
    </footer>

    <!-- CDN: hanzi-writer -->
    <script src="https://cdn.jsdelivr.net/npm/hanzi-writer@3.5/dist/hanzi-writer.min.js"></script>
    <script>
    const API_URL = 'api.php';
    const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
    const params = new URLSearchParams(window.location.search);
    const LESSON_ID = parseInt(params.get('lesson')) || 0;

    let vocabList = [];
    let currentIndex = 0;
    let lessonData = null;

    async function fetchAPI(action, data = null, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
            let options = { method, headers: { 'Content-Type': 'application/json' } };
            if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
            else if (data) options.body = JSON.stringify(data);
            return await (await fetch(url, options)).json();
        } catch (e) { return null; }
    }

    async function loadLesson() {
        if (!LESSON_ID) {
            document.getElementById('lesson-title').textContent = 'Bài học không xác định';
            return;
        }
        const result = await fetchAPI('get_lesson_detail', { lesson_id: LESSON_ID, user_id: USER_ID });
        if (!result || result.error) {
            showToast('⚠ Không tải được bài học!', 'error');
            return;
        }
        lessonData = result.lesson;
        vocabList = result.vocab || [];

        // Cập nhật thông tin bài học
        document.getElementById('breadcrumb-level').textContent = 'HSK ' + lessonData.level;
        document.getElementById('breadcrumb-level').href = 'lessons.php?level=' + lessonData.level;
        document.getElementById('breadcrumb-lesson').textContent = lessonData.title;
        document.getElementById('lesson-badge').textContent = 'HSK ' + lessonData.level + ' · Bài ' + lessonData.lesson_num;
        document.getElementById('lesson-title').textContent = lessonData.title;
        document.getElementById('lesson-desc').textContent = lessonData.description;

        // Hiển thị grammar nếu có
        if (lessonData.grammar) {
            const grammarSection = document.getElementById('grammar-section');
            grammarSection.style.display = 'block';
            document.getElementById('grammar-container').innerHTML = `
                <div class="grammar-card">
                    <div class="grammar-card__pattern">${lessonData.grammar}</div>
                    <div class="grammar-card__example">Ví dụ: Xem trong từng từ vựng bên dưới</div>
                </div>
            `;
        }

        if (vocabList.length === 0) {
            document.getElementById('hanzi-display').textContent = '—';
            document.getElementById('pinyin-display').textContent = 'Chưa có từ vựng cho bài này';
            document.getElementById('meaning-display').textContent = 'Vui lòng quay lại sau';
            showToast('⚠ Bài học chưa có từ vựng', 'warning');
            return;
        }

        initNavigation();
        loadCharacter(0);
    }

    // ===== INIT CANVAS =====
    let writer = null;
    let isWriteCompleted = false;
    let hasDrawn = false;

    function initCanvas() {
        const canvas = document.getElementById('writing-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let isDrawing = false;
        let lastX = 0, lastY = 0;

        function drawGrid() {
            const w = canvas.width, h = canvas.height;
            ctx.clearRect(0, 0, w, h);
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, w, h);
            ctx.strokeStyle = '#cbd5e1';
            ctx.lineWidth = 2;
            ctx.strokeRect(1, 1, w - 2, h - 2);
            ctx.strokeStyle = '#e2e8f0';
            ctx.lineWidth = 1;
            ctx.setLineDash([6, 4]);
            ctx.beginPath(); ctx.moveTo(0, 0); ctx.lineTo(w, h); ctx.stroke();
            ctx.beginPath(); ctx.moveTo(w, 0); ctx.lineTo(0, h); ctx.stroke();
            ctx.beginPath(); ctx.moveTo(0, h / 2); ctx.lineTo(w, h / 2); ctx.stroke();
            ctx.beginPath(); ctx.moveTo(w / 2, 0); ctx.lineTo(w / 2, h); ctx.stroke();
            ctx.setLineDash([]);
        }

        function getPos(e) {
            const rect = canvas.getBoundingClientRect();
            const scaleX = canvas.width / rect.width;
            const scaleY = canvas.height / rect.height;
            if (e.touches && e.touches.length > 0)
                return { x: (e.touches[0].clientX - rect.left) * scaleX, y: (e.touches[0].clientY - rect.top) * scaleY };
            return { x: (e.clientX - rect.left) * scaleX, y: (e.clientY - rect.top) * scaleY };
        }

        function startDraw(e) { e.preventDefault(); isDrawing = true; const p = getPos(e); lastX = p.x; lastY = p.y; }
        function draw(e) {
            if (!isDrawing) return; e.preventDefault();
            const p = getPos(e);
            ctx.strokeStyle = '#1e293b'; ctx.lineWidth = 4; ctx.lineCap = 'round'; ctx.lineJoin = 'round';
            ctx.beginPath(); ctx.moveTo(lastX, lastY); ctx.lineTo(p.x, p.y); ctx.stroke();
            lastX = p.x; lastY = p.y;
            hasDrawn = true;
            isWriteCompleted = false;
        }
        function stopDraw(e) { if (e) e.preventDefault(); isDrawing = false; }

        canvas.addEventListener('mousedown', startDraw);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDraw);
        canvas.addEventListener('mouseleave', stopDraw);
        canvas.addEventListener('touchstart', startDraw, { passive: false });
        canvas.addEventListener('touchmove', draw, { passive: false });
        canvas.addEventListener('touchend', stopDraw);

        document.getElementById('btn-clear')?.addEventListener('click', () => { drawGrid(); isWriteCompleted = false; hasDrawn = false; });
        document.getElementById('btn-show-hint')?.addEventListener('click', () => {
            const ghost = document.getElementById('canvas-ghost');
            ghost.style.color = 'rgba(0, 0, 0, 0.12)';
            setTimeout(() => { ghost.style.color = 'rgba(0, 0, 0, 0.04)'; }, 2000);
        });

        document.getElementById('btn-check-handwriting')?.addEventListener('click', async () => {
            const resultEl = document.getElementById('handwriting-result');
            resultEl.textContent = ' Đang kiểm tra...';
            const imageData = canvas.toDataURL('image/png');
            const vocab = vocabList[currentIndex];
            try {
                const res = await fetchAPI('evaluate_handwriting', {
                    image: imageData,
                    hanzi: vocab ? vocab.hanzi : '',
                    user_id: USER_ID
                }, 'POST');
                if (res && res.success) {
                    const emoji = res.score >= 80 ? '' : res.score >= 60 ? '' : res.score >= 40 ? '' : '';
                    resultEl.textContent = `${emoji} ${res.feedback} (${res.score}/100)`;
                    resultEl.style.color = res.score >= 60 ? 'var(--teal-dark)' : 'var(--coral)';
                } else {
                    resultEl.textContent = ' Lỗi kiểm tra';
                }
            } catch (e) {
                resultEl.textContent = ' Lỗi kết nối';
            }
        });

        drawGrid();
        window.drawGrid = drawGrid;
    }

    // ===== TABS =====
    function initTabs() {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('tab--active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('tab-content--active'));
                tab.classList.add('tab--active');
                document.getElementById('content-' + tab.dataset.tab).classList.add('tab-content--active');
            });
        });
    }

    // ===== NAVIGATION =====
    function initNavigation() {
        const dotsContainer = document.getElementById('char-dots');
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        vocabList.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.className = 'char-nav__dot' + (i === 0 ? ' char-nav__dot--active' : '');
            dot.addEventListener('click', () => goToCharacter(i));
            dotsContainer.appendChild(dot);
        });
        document.getElementById('btn-prev').addEventListener('click', () => {
            if (currentIndex > 0) goToCharacter(currentIndex - 1);
        });
        document.getElementById('btn-next').addEventListener('click', () => {
            if (currentIndex < vocabList.length - 1) goToCharacter(currentIndex + 1);
        });
    }

    // ===== GO TO CHARACTER =====
    async function goToCharacter(index) {
        const vocab = vocabList[currentIndex];
        if (hasDrawn && vocab && vocab.id) {
            const result = await fetchAPI('update_progress', { vocab_id: vocab.id, user_id: USER_ID, type: 'write' }, 'POST');
            if (result && result.success) {
                vocab.write_completed = 1;
                showToast(' Đã lưu tiến độ!', 'success', 2000);
            }
        }
        loadCharacter(index);
    }

    // ===== LOAD CHARACTER =====
    let currentCharIdx = 0;

    function loadCharacter(index) {
        currentIndex = index;
        hasDrawn = false;
        const vocab = vocabList[index];
        if (!vocab) return;

        document.getElementById('hanzi-display').textContent = vocab.hanzi;
        document.getElementById('pinyin-display').textContent = vocab.pinyin;
        document.getElementById('meaning-display').textContent = vocab.meaning;
        document.getElementById('canvas-ghost').textContent = vocab.hanzi;

        let example = vocab.example || '-';
        const dashIdx = example.indexOf(' - ');
        if (dashIdx !== -1) example = example.substring(0, dashIdx);
        document.getElementById('example-sentence').textContent = example;
        document.getElementById('example-vi').textContent = vocab.example_vi || '';

        isWriteCompleted = vocab.write_completed == 1;

        fetchAPI('log_study', { user_id: USER_ID, vocab_id: vocab.id, action: 'view' }, 'POST').catch(() => {});

        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        if (btnPrev) btnPrev.disabled = index === 0;
        if (btnNext) btnNext.disabled = index === vocabList.length - 1;

        document.querySelectorAll('.char-nav__dot').forEach((dot, i) => {
            dot.classList.toggle('char-nav__dot--active', i === index);
        });

        updateProgress(index + 1, vocabList.length);
        if (window.drawGrid) window.drawGrid();

        const speechResult = document.getElementById('speech-result');
        const speechStatus = document.getElementById('speech-status');
        if (speechResult) speechResult.style.display = 'none';
        if (speechStatus) { speechStatus.textContent = 'Nhấn micro để bắt đầu nói'; speechStatus.className = 'speech-status'; }

        // Parse char_data and build character tabs
        currentCharIdx = 0;
        let chars = [];
        try { chars = JSON.parse(vocab.char_data || '[]'); } catch(e) {}
        if (!chars.length || chars.every(c => c.strokes === 0 && !c.radical)) {
            chars = [...vocab.hanzi].map(ch => ({ char: ch, strokes: 0, radical: '' }));
        }
        vocab._chars = chars;
        buildCharTabs(chars);
        selectChar(0);

        updateProgressIndicator(vocab);
    }

    function buildCharTabs(chars) {
        const container = document.getElementById('char-tabs');
        if (!container) return;
        container.innerHTML = '';
        if (chars.length <= 1) { container.style.display = 'none'; return; }
        container.style.display = 'flex';
        chars.forEach((ch, i) => {
            const btn = document.createElement('button');
            btn.className = 'char-tab' + (i === 0 ? ' char-tab--active' : '');
            btn.textContent = ch.char;
            if (ch.pinyin) btn.title = ch.pinyin;
            btn.addEventListener('click', () => selectChar(i));
            container.appendChild(btn);
        });
    }

    function selectChar(idx) {
        const vocab = vocabList[currentIndex];
        if (!vocab) return;
        const chars = vocab._chars || [];
        const ch = chars[idx] || chars[0];
        if (!ch) return;
        currentCharIdx = idx;

        document.querySelectorAll('.char-tab').forEach((t, i) => {
            t.classList.toggle('char-tab--active', i === idx);
        });

        const strokes = ch.strokes > 0 ? ch.strokes + ' nét' : '—';
        const radical = ch.radical && ch.radical !== '-' ? ch.radical : '—';
        document.getElementById('stroke-count').textContent = strokes;
        document.getElementById('radical-info').textContent = radical;

        initHanziWriter(ch.char);
    }

    // ===== PROGRESS RING =====
    function updateProgress(current, total) {
        const circle = document.getElementById('progress-circle');
        const text = document.getElementById('progress-text');
        if (!circle || !text) return;
        const circumference = 2 * Math.PI * 34;
        const offset = circumference - (current / total) * circumference;
        circle.style.strokeDasharray = circumference;
        circle.style.strokeDashoffset = offset;
        text.textContent = current + '/' + total;

        // Nếu đã học hết từ vựng, hiển thị nút hoàn thành
        if (current === total && LESSON_ID && !document.querySelector('#progress-indicator .btn--gold')) {
            document.getElementById('progress-indicator').insertAdjacentHTML('beforeend', `
                <button class="btn btn--gold" onclick="completeLesson()" style="margin-top:12px;"> Hoàn thành bài học</button>
            `);
        }
    }

    async function completeLesson() {
        const result = await fetchAPI('update_lesson_progress', { lesson_id: LESSON_ID, user_id: USER_ID }, 'POST');
        if (result && result.success) {
            showToast(' Hoàn thành bài học!', 'success');
            setTimeout(() => { window.location.href = 'lessons.php'; }, 2000);
        } else {
            showToast(' Lỗi khi lưu!', 'error');
        }
    }

    // ===== PROGRESS INDICATOR =====
    function updateProgressIndicator(vocab) {
        if (!vocab) return;
        const writeStatus = document.getElementById('write-status');
        const speakStatus = document.getElementById('speak-status');
        if (writeStatus) writeStatus.textContent = vocab.write_completed ? '' : '';
        if (speakStatus) speakStatus.textContent = vocab.speech_completed ? '' : '';
    }

    // ===== HANZI-WRITER =====
    function initHanziWriter(character) {
        const target = document.getElementById('hanzi-writer-target');
        if (!target) return;
        target.innerHTML = '';
        if (typeof HanziWriter === 'undefined') {
            target.innerHTML = '<p style="color:#64748b;text-align:center;padding:40px;">Đang tải thư viện...</p>';
            return;
        }
        writer = HanziWriter.create('hanzi-writer-target', character, {
            width: 300, height: 300, padding: 20, showOutline: true, showCharacter: false,
            strokeColor: '#fbbf24', outlineColor: '#60a5fa', drawingColor: '#3b82f6',
            radicalColor: '#f59e0b', strokeAnimationSpeed: 1, delayBetweenStrokes: 300,
        });
        document.getElementById('btn-animate').onclick = () => { if (writer) writer.animateCharacter(); };
        document.getElementById('btn-quiz').onclick = () => {
            if (writer) {
                writer.quiz({
                    onComplete: async function (summaryData) {
                        if (summaryData.totalMistakes === 0) {
                            showToast(' Viết đúng tất cả nét!', 'success');
                            const vocab = vocabList[currentIndex];
                            if (vocab && vocab.id) {
                                await fetchAPI('update_progress', { vocab_id: vocab.id, user_id: USER_ID, type: 'write' }, 'POST');
                                vocab.write_completed = 1;
                                updateProgressIndicator(vocab);
                            }
                        } else {
                            showToast(' Còn ' + summaryData.totalMistakes + ' lỗi, thử lại!', 'warning');
                        }
                    }
                });
            }
        };
    }

    // ===== SPEECH =====
    let recognition = null;
    let isRecording = false;

    function initSpeech() {
        const btnMic = document.getElementById('btn-mic');
        const speechStatus = document.getElementById('speech-status');
        if (!btnMic) return;

        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            if (speechStatus) speechStatus.textContent = '⚠ Trình duyệt không hỗ trợ';
            btnMic.disabled = true; btnMic.style.opacity = '0.4';
            return;
        }

        recognition = new SpeechRecognition();
        recognition.lang = 'zh-CN';
        recognition.interimResults = false;
        recognition.maxAlternatives = 3;
        recognition.continuous = false;

        btnMic.addEventListener('click', () => { isRecording ? stopRecording() : startRecording(); });

        let speechTimer = null;

        recognition.onresult = (event) => {
            const results = event.results[0];
            let bestMatch = '', bestScore = 0;
            const targetHanzi = vocabList[currentIndex]?.hanzi || '';
            for (let i = 0; i < results.length; i++) {
                const t = results[i].transcript.trim();
                const s = calcSimilarity(t, targetHanzi);
                if (s > bestScore) { bestScore = s; bestMatch = t; }
            }
            const pct = Math.round(bestScore * 100);
            clearTimeout(speechTimer);
            stopRecording();
            showSpeechResult(bestMatch, pct);
        };

        recognition.onerror = (event) => {
            clearTimeout(speechTimer);
            stopRecording();
            if (speechStatus) {
                if (event.error === 'no-speech') speechStatus.textContent = ' Không nghe thấy';
                else if (event.error === 'not-allowed') speechStatus.textContent = ' Cho phép micro';
                else speechStatus.textContent = ' Lỗi: ' + event.error;
            }
        };

        recognition.onspeechend = () => {
            clearTimeout(speechTimer);
            speechTimer = setTimeout(() => {
                if (isRecording) {
                    try { recognition.stop(); } catch (e) {}
                }
            }, 600);
        };

        recognition.onend = () => {
            clearTimeout(speechTimer);
            if (isRecording) stopRecording();
        };

        function startRecording() {
            isRecording = true;
            document.getElementById('speech-result').style.display = 'none';
            btnMic.classList.add('btn-mic--recording');
            document.getElementById('mic-pulse')?.classList.add('mic-pulse--active');
            if (speechStatus) { speechStatus.textContent = ' Đang nghe...'; speechStatus.className = 'speech-status speech-status--recording'; }
            clearTimeout(speechTimer);
            speechTimer = setTimeout(() => {
                if (isRecording) {
                    try { recognition.stop(); } catch (e) {}
                }
            }, 4000);
            try { recognition.start(); } catch (e) { recognition.stop(); setTimeout(() => recognition.start(), 100); }
        }

        function stopRecording() {
            isRecording = false;
            clearTimeout(speechTimer);
            btnMic.classList.remove('btn-mic--recording');
            document.getElementById('mic-pulse')?.classList.remove('mic-pulse--active');
            if (speechStatus) speechStatus.className = 'speech-status';
            try { recognition.stop(); } catch (e) {}
        }
    }

    function calcSimilarity(input, target) {
        if (!input || !target) return 0;
        const a = input.replace(/[\s.,!?，，！？]/g, '');
        const b = target.replace(/[\s.,!?，，！？]/g, '');
        if (a === b) return 1;
        if (a.length === 0 || b.length === 0) return 0;
        if (a.includes(b) || b.includes(a)) return Math.min(a.length, b.length) / Math.max(a.length, b.length) * 0.95 + 0.05;
        const matrix = [];
        for (let i = 0; i <= b.length; i++) matrix[i] = [i];
        for (let j = 0; j <= a.length; j++) matrix[0][j] = j;
        for (let i = 1; i <= b.length; i++)
            for (let j = 1; j <= a.length; j++)
                if (b[i - 1] === a[j - 1]) matrix[i][j] = matrix[i - 1][j - 1];
                else matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
        return 1 - matrix[b.length][a.length] / Math.max(a.length, b.length);
    }

    function showSpeechResult(transcript, percentage) {
        const speechResult = document.getElementById('speech-result');
        const scoreCircle = document.getElementById('score-circle');
        const scoreText = document.getElementById('score-text');
        const feedbackEl = document.getElementById('speech-feedback');
        const targetHanzi = vocabList[currentIndex]?.hanzi || '';
        speechResult.style.display = 'block';
        document.getElementById('speech-status').textContent = 'Nhấn micro để thử lại';

        if (scoreCircle && scoreText) {
            const c = 2 * Math.PI * 42;
            scoreCircle.style.strokeDasharray = c;
            scoreCircle.style.strokeDashoffset = c - (percentage / 100) * c;
            scoreText.textContent = percentage + '%';
            scoreCircle.className = 'score-ring__fill';
            if (percentage > 90) scoreCircle.classList.add('score-ring__fill--high');
            else if (percentage >= 70) scoreCircle.classList.add('score-ring__fill--mid');
            else scoreCircle.classList.add('score-ring__fill--low');
        }

        if (feedbackEl) {
            feedbackEl.className = 'speech-feedback';
            feedbackEl.textContent = percentage > 90 ? ' Xuất sắc!' : percentage >= 70 ? ' Tốt lắm!' : ' Thử lại nhé!';
            if (percentage > 90) feedbackEl.classList.add('speech-feedback--high');
            else if (percentage >= 70) feedbackEl.classList.add('speech-feedback--mid');
            else feedbackEl.classList.add('speech-feedback--low');
        }

        document.getElementById('speech-transcript').innerHTML = 'Bạn nói: <span>' + (transcript || '...') + '</span> → Cần nói: <span>' + targetHanzi + '</span>';

        // Auto save nếu điểm cao
        if (percentage > 80 && vocabList[currentIndex]) {
            fetchAPI('update_progress', { vocab_id: vocabList[currentIndex].id, user_id: USER_ID, type: 'speech' }, 'POST');
            showToast(' Đã lưu phát âm!', 'success', 2000);
            vocabList[currentIndex].speech_completed = 1;
            updateProgressIndicator(vocabList[currentIndex]);
        }

        if (percentage > 90 && currentIndex < vocabList.length - 1) {
            setTimeout(() => goToCharacter(currentIndex + 1), 3000);
        }
    }

    // ===== AUDIO =====
    function initAudio() {
        document.getElementById('btn-audio')?.addEventListener('click', () => {
            const vocab = vocabList[currentIndex];
            if (!vocab) return;
            window.speechSynthesis.cancel();
            const u = new SpeechSynthesisUtterance(vocab.hanzi);
            u.lang = 'zh-CN'; u.rate = 0.8;
            window.speechSynthesis.speak(u);
        });
    }

    // ===== QUIZ =====
    let quizQuestions = [];
    let quizAnswered = false;

    function initQuiz() {
        // Auto-generate quiz when lesson is loaded
        if (vocabList && vocabList.length >= 2) {
            generateQuiz();
            document.getElementById('quiz-section').style.display = 'block';
        }
    }

    function generateQuiz() {
        if (!vocabList || vocabList.length < 2) {
            document.getElementById('quiz-container').innerHTML = '<p style="color:var(--gray);padding:20px;text-align:center">Cần ít nhất 2 từ để làm quiz</p>';
            return;
        }

        const all = [...vocabList];
        const questions = [];
        const numQuestions = Math.min(5, all.length);

        for (let i = 0; i < numQuestions; i++) {
            const correct = all[i];
            const type = i % 3;
            const wrongOptions = all.filter((_, idx) => idx !== i).sort(() => Math.random() - 0.5).slice(0, 3);
            const options = shuffleArray([correct, ...wrongOptions]);

            let question = {};
            if (type === 0) {
                question = { prompt: `${correct.hanzi} có nghĩa là gì?`, answer: correct.meaning, options: options.map(o => o.meaning), type: 'hanzi→meaning' };
            } else if (type === 1) {
                question = { prompt: `"${correct.meaning}" là chữ Hán nào?`, answer: correct.hanzi, options: options.map(o => o.hanzi), type: 'meaning→hanzi' };
            } else {
                question = { prompt: `"${correct.pinyin}" là chữ Hán nào?`, answer: correct.hanzi, options: options.map(o => o.hanzi), type: 'pinyin→hanzi' };
            }
            questions.push(question);
        }

        quizQuestions = questions;
        quizAnswered = false;
        document.getElementById('btn-check-quiz').textContent = ' Kiểm tra';
        document.getElementById('btn-check-quiz').disabled = false;
        renderQuiz();
    }

    function shuffleArray(arr) {
        for (let i = arr.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [arr[i], arr[j]] = [arr[j], arr[i]];
        }
        return arr;
    }

    function renderQuiz() {
        const container = document.getElementById('quiz-container');
        if (!quizQuestions.length) {
            container.innerHTML = '<p style="text-align:center;color:var(--gray)">Chưa có câu hỏi nào</p>';
            return;
        }

        let html = '';
        quizQuestions.forEach((q, qi) => {
            html += `<div class="quiz-question" data-qid="${qi}">
                <p class="quiz-question__prompt"><strong>Câu ${qi + 1}:</strong> ${q.prompt}</p>
                <div class="quiz-options">`;
            q.options.forEach((opt, oi) => {
                html += `<label class="quiz-option">
                    <input type="radio" name="quiz-${qi}" value="${oi}" data-q="${qi}" data-opt="${oi}">
                    <span class="quiz-option__text">${opt}</span>
                </label>`;
            });
            html += `</div></div>`;
        });

        container.innerHTML = html;
    }

    async function checkQuiz() {
        if (quizAnswered) {
            generateQuiz();
            return;
        }

        let correct = 0;
        const total = quizQuestions.length;

        quizQuestions.forEach((q, qi) => {
            const selected = document.querySelector(`input[name="quiz-${qi}"]:checked`);
            if (selected) {
                const optIdx = parseInt(selected.value);
                const chosen = q.options[optIdx];
                const isCorrect = chosen === q.answer;
                if (isCorrect) correct++;

                const labels = document.querySelectorAll(`[name="quiz-${qi}"]`);
                labels.forEach((l, li) => {
                    const parent = l.closest('.quiz-option');
                    const text = parent.querySelector('.quiz-option__text');
                    if (q.options[li] === q.answer) {
                        parent.style.borderColor = '#059669';
                        parent.style.background = '#d1fae5';
                    } else if (li === optIdx && !isCorrect) {
                        parent.style.borderColor = 'var(--coral)';
                        parent.style.background = 'var(--coral-light)';
                    }
                    l.disabled = true;
                });
            } else {
                // Not answered - mark correct answer
                const labels = document.querySelectorAll(`[name="quiz-${qi}"]`);
                labels.forEach((l, li) => {
                    const parent = l.closest('.quiz-option');
                    const text = parent.querySelector('.quiz-option__text');
                    if (q.options[li] === q.answer) {
                        parent.style.borderColor = '#3b82f6';
                        parent.style.background = '#dbeafe';
                    }
                    l.disabled = true;
                });
            }
        });

        quizAnswered = true;
        document.getElementById('btn-check-quiz').textContent = '➡ Câu tiếp theo';
        const score = correct;
        const totalQ = total;
        const pct = Math.round((score / totalQ) * 100);

        // Save to quiz results
        await fetchAPI('save_quiz_result', {
            user_id: USER_ID,
            quiz_type: 'lesson_' + LESSON_ID,
            level: lessonData?.level || 1,
            score: score,
            total_questions: totalQ
        }, 'POST');

        // Update progress indicator
        const qStatus = document.getElementById('quiz-status');
        if (qStatus) {
            if (pct >= 80) qStatus.textContent = '';
            else if (pct >= 50) qStatus.textContent = '';
            else qStatus.textContent = '';
        }

        // Scroll to top of quiz
        document.getElementById('quiz-section').scrollIntoView({ behavior: 'smooth' });

        showToast(' Điểm: ' + score + '/' + totalQ, 'info');
    }

    // ===== SAVE WORD =====
    function initSaveWord() {
        document.getElementById('btn-save-word')?.addEventListener('click', async () => {
            const vocab = vocabList[currentIndex];
            if (!vocab) { showToast('⚠ Không có từ!', 'error'); return; }
            const vid = vocab.id;
            if (!vid) { showToast('⚠ Thiếu ID!', 'error'); return; }
            const btn = document.getElementById('btn-save-word');
            const orig = btn.innerHTML;
            btn.innerHTML = '...'; btn.disabled = true;
            const r = await fetchAPI('save_to_notebook', { vocab_id: vid, user_id: USER_ID }, 'POST');
            if (r && r.success) showToast(' Đã lưu vào sổ tay!', 'success');
            else if (r && r.message?.includes('tồn tại')) showToast(' Từ này đã có trong sổ tay!', 'info');
            else showToast(' Lỗi: ' + (r?.message || 'Lỗi'), 'error');
            btn.innerHTML = orig; btn.disabled = false;
        });
    }

    // ===== INIT =====
    (async function() {
        await loadLesson();
        initCanvas();
        initTabs();
        initAudio();
        initSaveWord();
        initSpeech();
        initQuiz();
    })();

    
    </script>

    
<script src="utils.js"></script>
<script src="init.js"></script>
</body>
</html>