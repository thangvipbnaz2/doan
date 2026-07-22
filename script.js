// ===== CẤU HÌNH =====
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';

// ===== DỮ LIỆU TỪ VỰNG (FALLBACK NẾU API LỖI) =====
const fallbackVocab = [
    { id: 1, hanzi: '你', pinyin: 'nǐ', meaning: 'Bạn / Anh / Chị', strokes: 7, radical: '亻 (nhân)', example: '你好！(Nǐ hǎo!) - Xin chào!', level: 1, write_completed: 0 },
    { id: 2, hanzi: '好', pinyin: 'hǎo', meaning: 'Tốt / Được', strokes: 6, radical: '女 (nữ)', example: '很好 (Hěn hǎo) - Rất tốt', level: 1, write_completed: 0 },
    { id: 3, hanzi: '我', pinyin: 'wǒ', meaning: 'Tôi / Tớ', strokes: 7, radical: '戈 (qua)', example: '我是学生 (Wǒ shì xuéshēng) - Tôi là học sinh', level: 1, write_completed: 0 },
    { id: 4, hanzi: '是', pinyin: 'shì', meaning: 'Là / Đúng', strokes: 9, radical: '日 (nhật)', example: '他是老师 (Tā shì lǎoshī) - Anh ấy là giáo viên', level: 1, write_completed: 0 },
    { id: 5, hanzi: '学', pinyin: 'xué', meaning: 'Học', strokes: 8, radical: '子 (tử)', example: '学中文 (Xué zhōngwén) - Học tiếng Trung', level: 1, write_completed: 0 },
    { id: 6, hanzi: '他', pinyin: 'tā', meaning: 'Anh ấy / Ông ấy', strokes: 5, radical: '亻 (nhân)', example: '他是谁？(Tā shì shéi?) - Anh ấy là ai?', level: 1, write_completed: 0 },
    { id: 7, hanzi: '她', pinyin: 'tā', meaning: 'Cô ấy / Bà ấy', strokes: 5, radical: '女 (nữ)', example: '她是我老师 (Tā shì wǒ lǎoshī) - Cô ấy là giáo viên tôi', level: 1, write_completed: 0 },
    { id: 8, hanzi: '吃', pinyin: 'chī', meaning: 'Ăn', strokes: 6, radical: '口 (khẩu)', example: '吃饭 (Chī fàn) - Ăn cơm', level: 2, write_completed: 0 },
    { id: 9, hanzi: '喝', pinyin: 'hē', meaning: 'Uống', strokes: 12, radical: '口 (khẩu)', example: '喝茶 (Hē chá) - Uống trà', level: 2, write_completed: 0 },
    { id: 10, hanzi: '看', pinyin: 'kàn', meaning: 'Nhìn / Xem', strokes: 9, radical: '目 (mục)', example: '看书 (Kàn shū) - Đọc sách', level: 2, write_completed: 0 },
    { id: 11, hanzi: '学习', pinyin: 'xuéxí', meaning: 'Học tập', strokes: 8, radical: '子 (tử)', example: '学习中文 (Xuéxí zhōngwén) - Học tiếng Trung', level: 3, write_completed: 0 },
    { id: 12, hanzi: '工作', pinyin: 'gōngzuò', meaning: 'Làm việc', strokes: 7, radical: '工 (công)', example: '我在工作 (Wǒ zài gōngzuò) - Tôi đang làm việc', level: 3, write_completed: 0 },
];

const lessonInfo = {
    1: { title: 'Chào hỏi cơ bản', desc: 'Học cách chào hỏi và giới thiệu bản thân bằng tiếng Trung.' },
    2: { title: 'Giao tiếp thường ngày', desc: 'Học các mẫu câu giao tiếp trong cuộc sống hàng ngày.' },
    3: { title: 'Nâng cao', desc: 'Luyện tập ngữ pháp và từ vựng nâng cao.' }
};

let vocabList = [];
let currentIndex = 0;
let writer = null;
let isWriteCompleted = false; // Cờ kiểm tra đã hoàn thành viết chưa

// ===== GỌI API =====
async function fetchAPI(action, data = null, method = 'GET') {
    try {
        let url = `${API_URL}?action=${action}`;
        let options = { method: method, headers: { 'Content-Type': 'application/json' } };

        if (method === 'GET' && data) {
            const params = new URLSearchParams(data).toString();
            url += '&' + params;
        } else if (data) {
            options.body = JSON.stringify(data);
        }

        const response = await fetch(url, options);
        return await response.json();
    } catch (error) {
        console.error('API Error:', error);
        return null;
    }
}

// ===== TẢI DỮ LIỆU TỪ VỰNG =====
async function loadVocabList() {
    const params = new URLSearchParams(window.location.search);
    const level = parseInt(params.get('level')) || 1; // Mặc định là level 1

    console.log('Loading vocab for level:', level);

    const data = await fetchAPI('get_vocab', { level: level, user_id: USER_ID });
    console.log('API response:', data);

    if (data && data.length > 0) {
        vocabList = data;
    } else {
        // Fallback nếu API lỗi
        console.log('Using fallback vocab');
        if (level > 0) {
            vocabList = fallbackVocab.filter(v => v.level === level);
        } else {
            vocabList = fallbackVocab;
        }
    }

    console.log('Final vocabList:', vocabList.slice(0, 3));
    return vocabList;
}

// ===== CẬP NHẬT THÔNG TIN BÀI HỌC =====
function updateLessonInfo() {
    const params = new URLSearchParams(window.location.search);
    const level = parseInt(params.get('level')) || 1;
    const info = lessonInfo[level] || lessonInfo[1];

    document.getElementById('breadcrumb-level').textContent = 'HSK ' + level;
    document.getElementById('breadcrumb-lesson').textContent = info.title;
    document.getElementById('lesson-badge').textContent = 'HSK ' + level + ' · Bài 1';
    document.getElementById('lesson-title').textContent = info.title;
    document.getElementById('lesson-desc').textContent = info.desc;
}

// ===== KHỞI TẠO TRANG =====
document.addEventListener('DOMContentLoaded', async () => {
    await loadVocabList();
    initCanvas();
    initTabs();
    initNavigation();
    initNavbar();
    initSpeech();
    initSaveWord();
    initAudioButton();
    updateLessonInfo();
    loadCharacter(0);

    // Khởi tạo quiz và grammar sau khi load dữ liệu
    setTimeout(() => {
        initQuiz();
        initGrammar();
        updateProgressIndicator();
    }, 500);
});

// ===== NÚT PHÁT ÂM =====
function initAudioButton() {
    const btn = document.getElementById('btn-audio');
    if (!btn) return;

    btn.addEventListener('click', () => {
        const vocab = vocabList[currentIndex];
        if (!vocab) return;

        window.speechSynthesis.cancel();
        const utterance = new SpeechSynthesisUtterance(vocab.hanzi);
        utterance.lang = 'zh-CN';
        utterance.rate = 0.8;

        btn.style.transform = 'scale(1.2)';
        btn.style.background = 'var(--emerald)';
        btn.style.color = '#fff';
        utterance.onend = () => {
            btn.style.transform = '';
            btn.style.background = '';
            btn.style.color = '';
        };

        window.speechSynthesis.speak(utterance);
    });
}

if ('speechSynthesis' in window) {
    window.speechSynthesis.getVoices();
    window.speechSynthesis.onvoiceschanged = () => window.speechSynthesis.getVoices();
}

// ===== LƯU TỪ VÀO SỔ TAY =====
function initSaveWord() {
    const btn = document.getElementById('btn-save-word');
    if (!btn) return;

    btn.addEventListener('click', async () => {
        const vocab = vocabList[currentIndex];
        console.log('Saving vocab:', vocab);
        console.log('vocab.id:', vocab ? vocab.id : 'undefined');
        console.log('All vocab:', vocabList.slice(0, 3));

        if (!vocab) {
            showToastLesson('⚠️ Không có từ vựng!', 'error');
            return;
        }

        // Debug: force sử dụng id từ fallback nếu không có
        const vocabId = vocab.id || vocab.level * 100 + currentIndex + 1;
        console.log('Using vocab_id:', vocabId);

        if (!vocabId) {
            showToastLesson('⚠️ Không thể lưu - thiếu ID từ vựng!', 'error');
            return;
        }

        // Hiển thị trạng thái loading
        const originalText = btn.innerHTML;
        btn.innerHTML = '⏳ Đang lưu...';
        btn.disabled = true;

        try {
            const result = await fetchAPI('save_to_notebook', { vocab_id: vocabId, user_id: USER_ID }, 'POST');
            console.log('Save result:', result);

            if (!result) {
                showToastLesson('❌ Lỗi kết nối server!', 'error');
            } else if (result.success) {
                showToastLesson('✅ Đã lưu "' + vocab.hanzi + '" vào sổ tay!', 'success');
            } else if (result.message && result.message.includes('tồn tại')) {
                showToastLesson('⚠️ "' + vocab.hanzi + '" đã có trong sổ tay!', 'warning');
            } else {
                showToastLesson('❌ ' + (result.message || 'Lỗi không xác định'), 'error');
            }
        } catch (e) {
            console.error('Save error:', e);
            showToastLesson('❌ Lỗi khi lưu từ!', 'error');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });
}

function showToastLesson(msg, type = 'success') {
    // Xóa popup cũ
    const existing = document.querySelector('.popup-overlay');
    if (existing) existing.remove();

    // Xác định title dựa trên nội dung
    let title = 'Thông báo';
    if (msg.includes('Đã lưu')) title = 'Lưu thành công';
    else if (msg.includes('đã có') || msg.includes('tồn tại')) title = 'Trùng lặp';
    else if (msg.includes('hoàn thành')) title = 'Hoàn thành';
    else if (msg.includes('lỗi') || msg.includes('không')) title = 'Lỗi';

    // Tạo popup
    const popup = document.createElement('div');
    popup.className = `popup-overlay popup-notification--${type}`;
    popup.innerHTML = `
        <div class="popup-notification">
            <div class="popup-notification__icon"></div>
            <div class="popup-notification__title">${title}</div>
            <div class="popup-notification__message">${msg}</div>
            <button class="popup-notification__btn" onclick="this.parentElement.parentElement.remove()">Đóng</button>
        </div>
    `;
    document.body.appendChild(popup);

    // Hiển thị ngay
    setTimeout(() => popup.classList.add('active'), 10);

    // Tự động đóng sau 3 giây
    setTimeout(() => {
        popup.classList.remove('active');
        setTimeout(() => popup.remove(), 300);
    }, 3000);
}

// ===== QUIZ SYSTEM =====
function initQuiz() {
    const quizSection = document.getElementById('quiz-section');
    if (!quizSection || !vocabList || vocabList.length === 0) return;

    quizSection.style.display = 'block';

    // Hiển thị quiz cho từ hiện tại
    showQuizQuestion();
}

function showQuizQuestion() {
    const vocab = vocabList[currentIndex];
    if (!vocab) return;

    const container = document.getElementById('quiz-container');
    const quizData = generateQuizForVocab(vocab);

    container.innerHTML = `
        <div class="quiz-question">
            <p class="quiz-question__text">Từ <strong style="font-size:1.3rem;">${vocab.hanzi}</strong> (${vocab.pinyin}) có nghĩa là gì?</p>
            <div class="quiz-options">
                ${quizData.options.map((opt, i) => `
                    <button class="quiz-option" data-answer="${opt}" onclick="selectQuizOption(this)">${opt}</button>
                `).join('')}
            </div>
        </div>
    `;

    window.currentQuizAnswer = quizData.correct;
    window.quizSelected = null;
}

function generateQuizForVocab(vocab) {
    const correct = vocab.meaning;
    const others = vocabList
        .filter(v => v.id !== vocab.id)
        .sort(() => Math.random() - 0.5)
        .slice(0, 3)
        .map(v => v.meaning);

    const options = [correct, ...others].sort(() => Math.random() - 0.5);
    return { options, correct };
}

function selectQuizOption(btn) {
    document.querySelectorAll('.quiz-option').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    window.quizSelected = btn.dataset.answer;
}

function checkQuiz() {
    const selected = window.quizSelected;
    const correct = window.currentQuizAnswer;

    if (!selected) {
        showToastLesson('⚠️ Vui lòng chọn một đáp án!', 'warning');
        return;
    }

    const isCorrect = selected === correct;
    if (isCorrect) {
        showToastLesson('✅ Đúng rồi! +10 điểm', 'success');
    } else {
        showToastLesson('❌ Sai rồi. Đáp án đúng: ' + correct, 'error');
    }

    // Đánh dấu đáp án
    document.querySelectorAll('.quiz-option').forEach(btn => {
        if (btn.dataset.answer === correct) btn.classList.add('correct');
        else if (btn.dataset.answer === selected && !isCorrect) btn.classList.add('wrong');
    });
}

// ===== GRAMMAR SECTION =====
function initGrammar() {
    const grammarSection = document.getElementById('grammar-section');
    if (!grammarSection || !vocabList || vocabList.length === 0) return;

    grammarSection.style.display = 'block';

    const container = document.getElementById('grammar-container');
    const vocab = vocabList[currentIndex];

    // Grammar patterns cho từng từ
    const grammarPatterns = getGrammarForVocab(vocab);

    if (grammarPatterns.length > 0) {
        container.innerHTML = grammarPatterns.map(g => `
            <div class="grammar-card">
                <div class="grammar-card__pattern">${g.pattern}</div>
                <div class="grammar-card__meaning">${g.meaning}</div>
                <div class="grammar-card__example">${g.example}</div>
            </div>
        `).join('');
    } else {
        container.innerHTML = '<p style="color:var(--gray);text-align:center;">Chưa có ngữ pháp cho từ này.</p>';
    }
}

function getGrammarForVocab(vocab) {
    // Database ngữ pháp mẫu
    const grammarDb = {
        '你': [{ pattern: '你好吗？', meaning: 'Bạn khỏe không?', example: 'Nǐ hǎo ma? - Cách hỏi thăm' }],
        '好': [{ pattern: '很好', meaning: 'Rất tốt', example: 'Hěn hǎo - Rất tốt' }],
        '我': [{ pattern: '我是...', meaning: 'Tôi là...', example: 'Wǒ shì... - Cấu trúc giới thiệu' }],
        '是': [{ pattern: 'X là Y', meaning: 'Cấu trúc khẳng định', example: 'Tā shì lǎoshī - Anh ấy là giáo viên' }],
        '学': [{ pattern: '学习...', meaning: 'Học...', example: 'Xuéxí zhōngwén - Học tiếng Trung' }],
        '他': [{ pattern: 'T + động từ', meaning: 'Anh ấy/Cậu ấy', example: 'Tā chī fàn - Anh ấy ăn cơm' }],
        '她': [{ pattern: 'T + động từ', meaning: 'Cô ấy/Bà ấy', example: 'Tā hē chá - Cô ấy uống trà' }],
        '吃': [{ pattern: '吃 + đối tượng', meaning: 'Ăn + đối tượng', example: 'Chī fàn - Ăn cơm' }],
        '喝': [{ pattern: '喝 + đối tượng', meaning: 'Uống + đối tượng', example: 'Hē shuǐ - Uống nước' }],
        '看': [{ pattern: '看 + đối tượng', meaning: 'Nhìn/Xem + đối tượng', example: 'Kàn shū - Đọc sách' }],
    };

    return grammarDb[vocab.hanzi] || [];
}

// ===== LƯU TIẾN TRÌNH HỌC =====
function updateProgressIndicator() {
    const vocab = vocabList[currentIndex];
    if (!vocab) return;

    const writeStatus = document.getElementById('write-status');
    const speakStatus = document.getElementById('speak-status');
    const quizStatus = document.getElementById('quiz-status');

    if (vocab.write_completed) {
        writeStatus.textContent = '✅';
        writeStatus.title = 'Đã hoàn thành viết';
    } else {
        writeStatus.textContent = '⏳';
        writeStatus.title = 'Chưa hoàn thành';
    }

    if (vocab.speech_completed) {
        speakStatus.textContent = '✅';
        speakStatus.title = 'Đã hoàn thành nói';
    } else {
        speakStatus.textContent = '⏳';
        speakStatus.title = 'Chưa hoàn thành';
    }

    quizStatus.textContent = '📝';
    quizStatus.title = 'Kiểm tra kiến thức';
}

async function saveProgress(type) {
    const vocab = vocabList[currentIndex];
    if (!vocab || !vocab.id) return;

    const result = await fetchAPI('update_progress', {
        vocab_id: vocab.id,
        user_id: USER_ID,
        type: type
    }, 'POST');

    if (result && result.success) {
        if (type === 'write') {
            vocab.write_completed = 1;
            showToastLesson('✅ Đã lưu tiến trình viết!', 'success');
        } else if (type === 'speech') {
            vocab.speech_completed = 1;
            showToastLesson('✅ Đã lưu tiến trình nói!', 'success');
        }
        updateProgressIndicator();
    }
}

// ===== NAVBAR MOBILE =====
function initNavbar() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('navbar__menu--open');
            navToggle.classList.toggle('navbar__toggle--active');
        });

        document.querySelectorAll('.navbar__link').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('navbar__menu--open');
                navToggle.classList.remove('navbar__toggle--active');
            });
        });
    }
}

// ===== CANVAS - LUYỆN VIẾT =====
function initCanvas() {
    const canvas = document.getElementById('writing-canvas');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    function drawGrid() {
        const w = canvas.width;
        const h = canvas.height;
        ctx.clearRect(0, 0, w, h);
        ctx.fillStyle = '#ffffff';
        ctx.fillRect(0, 0, w, h);
        ctx.strokeStyle = '#cbd5e1';
        ctx.lineWidth = 2;
        ctx.strokeRect(1, 1, w - 2, h - 2);
        ctx.strokeStyle = '#e2e8f0';
        ctx.lineWidth = 1;
        ctx.setLineDash([6, 4]);
        ctx.beginPath();
        ctx.moveTo(0, 0);
        ctx.lineTo(w, h);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(w, 0);
        ctx.lineTo(0, h);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(0, h / 2);
        ctx.lineTo(w, h / 2);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(w / 2, 0);
        ctx.lineTo(w / 2, h);
        ctx.stroke();
        ctx.setLineDash([]);
    }

    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        if (e.touches && e.touches.length > 0) {
            return {
                x: (e.touches[0].clientX - rect.left) * scaleX,
                y: (e.touches[0].clientY - rect.top) * scaleY
            };
        }
        return {
            x: (e.clientX - rect.left) * scaleX,
            y: (e.clientY - rect.top) * scaleY
        };
    }

    function startDraw(e) {
        e.preventDefault();
        isDrawing = true;
        const pos = getPos(e);
        lastX = pos.x;
        lastY = pos.y;
    }

    function draw(e) {
        if (!isDrawing) return;
        e.preventDefault();
        const pos = getPos(e);
        ctx.strokeStyle = '#1e293b';
        ctx.lineWidth = 4;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        lastX = pos.x;
        lastY = pos.y;

        // Đánh dấu đã bắt đầu vẽ
        isWriteCompleted = false;
    }

    function stopDraw(e) {
        if (e) e.preventDefault();
        isDrawing = false;
    }

    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDraw);
    canvas.addEventListener('mouseleave', stopDraw);
    canvas.addEventListener('touchstart', startDraw, { passive: false });
    canvas.addEventListener('touchmove', draw, { passive: false });
    canvas.addEventListener('touchend', stopDraw);

    document.getElementById('btn-clear').addEventListener('click', () => {
        drawGrid();
        isWriteCompleted = false;
    });

    document.getElementById('btn-show-hint').addEventListener('click', () => {
        const ghost = document.getElementById('canvas-ghost');
        ghost.style.color = 'rgba(0, 0, 0, 0.12)';
        setTimeout(() => { ghost.style.color = 'rgba(0, 0, 0, 0.04)'; }, 2000);
    });

    drawGrid();
    window.drawGrid = drawGrid;
}

// ===== TABS =====
function initTabs() {
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = tab.dataset.tab;
            tabs.forEach(t => t.classList.remove('tab--active'));
            contents.forEach(c => c.classList.remove('tab-content--active'));
            tab.classList.add('tab--active');
            document.getElementById('content-' + target).classList.add('tab-content--active');
        });
    });
}

// ===== ĐIỀU HƯỚNG TỪ VỰNG =====
function initNavigation() {
    const dotsContainer = document.getElementById('char-dots');
    if (!dotsContainer) return;

    // Tạo dots
    vocabList.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.className = 'char-nav__dot' + (i === 0 ? ' char-nav__dot--active' : '');
        dot.setAttribute('aria-label', 'Từ ' + (i + 1));
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

// ===== CHUYỂN TỪ VỰNG (CÓ KIỂM TRA HOÀN THÀNH) =====
async function goToCharacter(index) {
    const vocab = vocabList[currentIndex];

    // Nếu chưa hoàn thành viết và đang sang từ mới, kiểm tra
    if (!isWriteCompleted && vocab && vocab.id) {
        const confirmed = confirm('⚠️ Bạn chưa hoàn thành bài viết cho chữ "' + vocab.hanzi + '".\n\nBạn có muốn đánh dấu hoàn thành không?');
        if (confirmed) {
            await markWriteCompleted(vocab.id);
        }
    }

    loadCharacter(index);
}

// ===== ĐÁNH DẤU ĐÃ HOÀN THÀNH VIẾT =====
async function markWriteCompleted(vocabId) {
    const result = await fetchAPI('update_progress', { vocab_id: vocabId, user_id: USER_ID, type: 'write' });
    if (result && result.success) {
        isWriteCompleted = true;
        const vocab = vocabList.find(v => v.id === vocabId);
        if (vocab) vocab.write_completed = 1;
        showToastLesson('✅ Đã hoàn thành chữ "' + vocab.hanzi + '"!');
    }
}

// ===== TẢI HIỂN THỊ CHỮ HÁN =====
function loadCharacter(index) {
    currentIndex = index;
    const vocab = vocabList[index];

    if (!vocab) return;

    document.getElementById('hanzi-display').textContent = vocab.hanzi;
    document.getElementById('pinyin-display').textContent = vocab.pinyin;
    document.getElementById('meaning-display').textContent = vocab.meaning;
    document.getElementById('canvas-ghost').textContent = vocab.hanzi;

    document.getElementById('stroke-count').textContent = (vocab.strokes || 0) + ' nét';
    document.getElementById('radical-info').textContent = vocab.radical || '-';
    document.getElementById('example-sentence').textContent = vocab.example || '-';

    // Cập nhật trạng thái hoàn thành
    isWriteCompleted = vocab.write_completed == 1;

    // Cập nhật nút điều hướng
    const btnPrev = document.getElementById('btn-prev');
    const btnNext = document.getElementById('btn-next');
    if (btnPrev) btnPrev.disabled = index === 0;
    if (btnNext) btnNext.disabled = index === vocabList.length - 1;

    // Cập nhật dots
    document.querySelectorAll('.char-nav__dot').forEach((dot, i) => {
        dot.classList.toggle('char-nav__dot--active', i === index);
    });

    updateProgress(index + 1, vocabList.length);

    if (window.drawGrid) window.drawGrid();

    const speechResult = document.getElementById('speech-result');
    const speechStatus = document.getElementById('speech-status');
    if (speechResult) speechResult.style.display = 'none';
    if (speechStatus) {
        speechStatus.textContent = 'Nhấn micro để bắt đầu nói';
        speechStatus.className = 'speech-status';
    }

    initHanziWriter(vocab.hanzi);
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
        width: 300,
        height: 300,
        padding: 20,
        showOutline: true,
        showCharacter: false,
        strokeColor: '#fbbf24',
        outlineColor: '#60a5fa',
        drawingColor: '#3b82f6',
        radicalColor: '#f59e0b',
        strokeAnimationSpeed: 1,
        delayBetweenStrokes: 300,
    });

    const btnAnimate = document.getElementById('btn-animate');
    if (btnAnimate) {
        btnAnimate.onclick = () => {
            if (writer) writer.animateCharacter();
        };
    }

    const btnQuiz = document.getElementById('btn-quiz');
    if (btnQuiz) {
        btnQuiz.onclick = () => {
            if (writer) {
                writer.quiz({
                    onComplete: async function (summaryData) {
                        const mistakes = summaryData.totalMistakes;
                        if (mistakes === 0) {
                            alert('🎉 Tuyệt vời! Bạn viết đúng tất cả các nét!');
                            // Đánh dấu hoàn thành khi đúng hoàn toàn
                            const vocab = vocabList[currentIndex];
                            if (vocab && vocab.id) {
                                await markWriteCompleted(vocab.id);
                            }
                        } else {
                            alert('Bạn đã hoàn thành với ' + mistakes + ' lỗi. Hãy thử lại nhé! 💪');
                        }
                    }
                });
            }
        };
    }
}

// ===== LUYỆN NÓI - WEB SPEECH API =====
let recognition = null;
let isRecording = false;

function initSpeech() {
    const btnMic = document.getElementById('btn-mic');
    const micPulse = document.getElementById('mic-pulse');
    const speechStatus = document.getElementById('speech-status');

    if (!btnMic) return;

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    if (!SpeechRecognition) {
        if (speechStatus) speechStatus.textContent = '⚠️ Trình duyệt không hỗ trợ. Hãy dùng Chrome/Edge!';
        btnMic.disabled = true;
        btnMic.style.opacity = '0.4';
        return;
    }

    recognition = new SpeechRecognition();
    recognition.lang = 'zh-CN';
    recognition.interimResults = false;
    recognition.maxAlternatives = 3;
    recognition.continuous = false;

    btnMic.addEventListener('click', () => {
        if (isRecording) stopRecording();
        else startRecording();
    });

    recognition.onresult = (event) => {
        const results = event.results[0];
        let bestMatch = '';
        let bestScore = 0;
        const targetHanzi = vocabList[currentIndex].hanzi;

        for (let i = 0; i < results.length; i++) {
            const transcript = results[i].transcript.trim();
            const score = calculateSimilarity(transcript, targetHanzi);
            if (score > bestScore) {
                bestScore = score;
                bestMatch = transcript;
            }
        }

        const percentage = Math.round(bestScore * 100);
        stopRecording();
        showSpeechResult(bestMatch, percentage);
    };

    recognition.onerror = (event) => {
        stopRecording();
        if (speechStatus) {
            if (event.error === 'no-speech') speechStatus.textContent = '🔇 Không nghe thấy giọng nói. Hãy thử lại!';
            else if (event.error === 'not-allowed') speechStatus.textContent = '🚫 Vui lòng cho phép truy cập microphone';
            else speechStatus.textContent = '❌ Lỗi: ' + event.error;
        }
    };

    recognition.onend = () => { if (isRecording) stopRecording(); };

    function startRecording() {
        isRecording = true;
        const speechResult = document.getElementById('speech-result');
        if (speechResult) speechResult.style.display = 'none';

        btnMic.classList.add('btn-mic--recording');
        if (micPulse) micPulse.classList.add('mic-pulse--active');
        if (speechStatus) {
            speechStatus.textContent = '🔴 Đang nghe... Hãy nói tiếng Trung!';
            speechStatus.className = 'speech-status speech-status--recording';
        }

        try { recognition.start(); }
        catch (e) { recognition.stop(); setTimeout(() => recognition.start(), 100); }
    }

    function stopRecording() {
        isRecording = false;
        btnMic.classList.remove('btn-mic--recording');
        if (micPulse) micPulse.classList.remove('mic-pulse--active');
        if (speechStatus) speechStatus.className = 'speech-status';
        try { recognition.stop(); } catch (e) {}
    }
}

// ===== TÍNH ĐỘ TƯƠNG ĐỒNG =====
function calculateSimilarity(input, target) {
    if (!input || !target) return 0;
    const a = input.replace(/[\s.,!?，，！？]/g, '');
    const b = target.replace(/[\s.,!?，，！？]/g, '');
    if (a === b) return 1;
    if (a.length === 0 || b.length === 0) return 0;
    if (a.includes(b) || b.includes(a)) {
        return Math.min(a.length, b.length) / Math.max(a.length, b.length) * 0.95 + 0.05;
    }

    const matrix = [];
    for (let i = 0; i <= b.length; i++) matrix[i] = [i];
    for (let j = 0; j <= a.length; j++) matrix[0][j] = j;
    for (let i = 1; i <= b.length; i++) {
        for (let j = 1; j <= a.length; j++) {
            if (b[i - 1] === a[j - 1]) matrix[i][j] = matrix[i - 1][j - 1];
            else matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
        }
    }
    return 1 - matrix[b.length][a.length] / Math.max(a.length, b.length);
}

// ===== HIỂN THỊ KẾT QUẢ NÓI =====
function showSpeechResult(transcript, percentage) {
    const speechStatus = document.getElementById('speech-status');
    const speechResult = document.getElementById('speech-result');
    const scoreCircle = document.getElementById('score-circle');
    const scoreText = document.getElementById('score-text');
    const transcriptEl = document.getElementById('speech-transcript');
    const feedbackEl = document.getElementById('speech-feedback');
    const targetHanzi = vocabList[currentIndex].hanzi;

    if (speechResult) speechResult.style.display = 'block';
    if (speechStatus) speechStatus.textContent = 'Nhấn micro để thử lại';

    if (scoreCircle && scoreText) {
        const circumference = 2 * Math.PI * 42;
        const offset = circumference - (percentage / 100) * circumference;
        scoreCircle.style.strokeDasharray = circumference;
        scoreCircle.style.strokeDashoffset = offset;
        scoreText.textContent = percentage + '%';

        scoreCircle.className = 'score-ring__fill';
        if (percentage > 90) scoreCircle.classList.add('score-ring__fill--high');
        else if (percentage >= 70) scoreCircle.classList.add('score-ring__fill--mid');
        else scoreCircle.classList.add('score-ring__fill--low');
    }

    if (feedbackEl) {
        feedbackEl.className = 'speech-feedback';
        let feedbackText = '';
        if (percentage > 90) {
            feedbackEl.classList.add('speech-feedback--high');
            feedbackText = '🎉 Xuất sắc!';
        } else if (percentage >= 70) {
            feedbackEl.classList.add('speech-feedback--mid');
            feedbackText = '👍 Tốt lắm!';
        } else {
            feedbackEl.classList.add('speech-feedback--low');
            feedbackText = '💪 Thử lại nhé!';
        }
        feedbackEl.textContent = feedbackText;
    }

    if (transcriptEl) {
        transcriptEl.innerHTML = 'Bạn nói: <span>' + (transcript || '...') + '</span> → Cần nói: <span>' + targetHanzi + '</span>';
    }

    // Tự động chuyển từ tiếp theo nếu đúng > 90%
    if (percentage > 90 && currentIndex < vocabList.length - 1) {
        setTimeout(() => { goToCharacter(currentIndex + 1); }, 3500);
    }
}

// Auth check for lesson.php
async function checkAuth() {
    const sidebarUser = document.getElementById('sidebar-user');
    const sidebarAuth = document.getElementById('sidebar-auth');
    const usernameText = document.getElementById('sidebar-username-text');
    try {
        const res = await fetch('auth.php?action=check');
        const data = await res.json();
        if (data.logged_in && data.user_id) {
            localStorage.setItem('hanngu_user_id', data.user_id);
            localStorage.setItem('hanngu_username', data.user.username);
            localStorage.setItem('hanngu_display_name', data.user.display_name);
            if (sidebarUser) sidebarUser.style.display = 'block';
            if (sidebarAuth) sidebarAuth.style.display = 'none';
            if (usernameText) usernameText.textContent = data.user.display_name || data.user.username;
            if (data.user.role === 'admin') {
                const na = document.getElementById('sidebar-admin');
                if (na) na.style.display = 'flex';
            }
        }
    } catch (e) {}
    const userId = localStorage.getItem('hanngu_user_id');
    const displayName = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username');
    if (userId && userId !== 'default_user') {
        if (sidebarUser) sidebarUser.style.display = 'block';
        if (sidebarAuth) sidebarAuth.style.display = 'none';
        if (usernameText) usernameText.textContent = displayName;
    }
}
document.addEventListener('DOMContentLoaded', checkAuth);
document.getElementById('sidebar-logout')?.addEventListener('click', async (e) => {
    e.preventDefault();
    await fetch('auth.php?action=logout');
    localStorage.removeItem('hanngu_user_id');
    localStorage.removeItem('hanngu_username');
    localStorage.removeItem('hanngu_display_name');
    window.location.reload();
});