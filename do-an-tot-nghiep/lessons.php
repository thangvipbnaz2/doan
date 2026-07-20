<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Danh sách bài học tiếng Trung HSK theo lộ trình">
    <title>Danh sách bài học - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .lessons-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafc, #eff6ff); }
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 40px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--teal-light); color: var(--teal-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); margin-bottom: 6px; }
        .page-header__desc { font-size: .95rem; color: var(--gray); }

        .level-tabs { display: flex; gap: 12px; margin-bottom: 32px; }
        .level-tab { padding: 14px 28px; border: 2px solid var(--gray-light); background: #fff; border-radius: var(--radius-sm); font-size: 1rem; font-weight: 600; color: var(--gray); cursor: pointer; transition: var(--transition); }
        .level-tab:hover { border-color: var(--teal); color: var(--teal); }
        .level-tab--active { background: var(--teal); border-color: var(--teal); color: #fff; }

        .lessons-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px; }
        .lesson-card { background: #fff; border-radius: var(--radius); padding: 24px; box-shadow: var(--shadow); transition: var(--transition); border: 2px solid transparent; cursor: pointer; position: relative; overflow: hidden; }
        .lesson-card:hover { border-color: var(--teal); transform: translateY(-4px); box-shadow: var(--shadow-lg); }
        .lesson-card__badge { position: absolute; top: 16px; right: 16px; padding: 4px 12px; border-radius: 20px; font-size: .75rem; font-weight: 700; }
        .lesson-card__badge--done { background: var(--teal-light); color: var(--teal-dark); }
        .lesson-card__badge--lock { background: var(--gray-light); color: var(--gray); }
        .lesson-card__number { font-size: .85rem; color: var(--teal); font-weight: 600; margin-bottom: 8px; }
        .lesson-card__title { font-size: 1.2rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .lesson-card__desc { font-size: .9rem; color: var(--gray); margin-bottom: 16px; line-height: 1.6; }
        .lesson-card__meta { display: flex; gap: 16px; font-size: .82rem; color: var(--gray); }
        .lesson-card__meta span { display: flex; align-items: center; gap: 4px; }

        .progress-bar { height: 6px; background: var(--gray-light); border-radius: 3px; margin-top: 16px; overflow: hidden; }
        .progress-bar__fill { height: 100%; background: var(--teal); border-radius: 3px; transition: width 0.3s ease; }

        .user-progress { background: linear-gradient(135deg, var(--teal), var(--teal-dark)); border-radius: var(--radius); padding: 24px; color: #fff; }
        .user-progress__title { font-size: 1rem; font-weight: 600; margin-bottom: 12px; }
        .user-progress__stats { display: flex; gap: 32px; }
        .user-progress__stat { text-align: center; }
        .user-progress__num { display: block; font-size: 2rem; font-weight: 800; }
        .user-progress__label { font-size: .8rem; opacity: 0.9; }

        .toast { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(20px); padding: 14px 28px; background: var(--dark); color: #fff; border-radius: var(--radius-sm); font-size: .9rem; font-weight: 500; box-shadow: var(--shadow-lg); opacity: 0; transition: all .3s ease; z-index: 9999; }
        .toast--visible { opacity: 1; transform: translateX(-50%) translateY(0); }

        @media(max-width:768px) { .page-header{flex-direction:column;text-align:center;gap:16px} .level-tabs{flex-wrap:wrap} .lessons-grid{grid-template-columns:1fr} }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="lessons-page">
        <div class="container">
            <div class="page-header reveal">
                <div>
                    <span class="page-header__badge">Lộ trình học tập</span>
                    <h1 class="page-header__title">Bài học <span class="text-gradient">theo cấp độ</span></h1>
                    <p class="page-header__desc">Chọn cấp độ HSK phù hợp với trình độ của bạn</p>
                </div>
                <div class="user-progress">
                    <div class="user-progress__title">Tiến trình của bạn</div>
                    <div class="user-progress__stats">
                        <div class="user-progress__stat">
                            <span class="user-progress__num" id="stat-completed">0</span>
                            <span class="user-progress__label">Đã hoàn thành</span>
                        </div>
                        <div class="user-progress__stat">
                            <span class="user-progress__num" id="stat-inprogress">0</span>
                            <span class="user-progress__label">Đang học</span>
                        </div>
                        <div class="user-progress__stat">
                            <span class="user-progress__num" id="stat-words">0</span>
                            <span class="user-progress__label">Từ vựng</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-tabs reveal">
                <button class="level-tab ripple" data-level="1">HSK 1</button>
                <button class="level-tab ripple" data-level="2">HSK 2</button>
                <button class="level-tab ripple" data-level="3">HSK 3</button>
                <button class="level-tab ripple" data-level="4">HSK 4</button>
                <button class="level-tab ripple" data-level="5">HSK 5</button>
                <button class="level-tab ripple" data-level="6">HSK 6</button>
            </div>

            <div class="lessons-grid reveal" id="lessons-grid"><div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;padding:20px 0;"><div class="skeleton skeleton--card"></div><div class="skeleton skeleton--card"></div><div class="skeleton skeleton--card"></div><div class="skeleton skeleton--card"></div><div class="skeleton skeleton--card"></div><div class="skeleton skeleton--card"></div></div></div>
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

    <footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Thiết kế với  cho cộng đồng học tiếng Trung.</p></div></div></footer>

    <script>
    const API_URL = 'api.php';
    const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
    const params = new URLSearchParams(window.location.search);
    let currentLevel = parseInt(params.get('level')) || 1;
    let lessonProgress = {};
    let allLessons = {};

    async function fetchAPI(action, data = null, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
            let options = { method, headers: { 'Content-Type': 'application/json' } };
            if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
            else if (data) options.body = JSON.stringify(data);
            return await (await fetch(url, options)).json();
        } catch (e) { console.error(e); showToast(' Lỗi tải bài học!', 'error'); return null; }
    }

    async function loadLessonsFromAPI() {
        for (let level = 1; level <= 6; level++) {
            const lessons = await fetchAPI('get_lessons', { level });
            if (lessons && lessons.length > 0) {
                allLessons[level] = lessons;
            }
        }
    }

    const lessonsData = {
        1: [
            { id: 1, title: 'Chào hỏi & Giới thiệu', desc: 'Học cách chào hỏi, giới thiệu bản thân, hỏi tên', words: 15, grammar: 'Là/Có/Phải', type: 'conversation' },
            { id: 2, title: 'Số đếm & Đếm số', desc: 'Số từ 0-100, cách đếm người, đồ vật', words: 20, grammar: 'Số + danh từ', type: 'vocab' },
            { id: 3, title: 'Gia đình & Quan hệ', desc: 'Tên gọi trong gia đình, giới thiệu người thân', words: 18, grammar: 'Cái/Ai/Con gì', type: 'vocab' },
            { id: 4, title: 'Thời gian & Ngày tháng', desc: 'Ngày, tháng, năm, giờ, tuần, tháng', words: 22, grammar: 'Mấy giờ/ngày nào', type: 'vocab' },
            { id: 5, title: 'Màu sắc & Hình dạng', desc: 'Tên màu, hình dạng, kích thước', words: 16, grammar: 'Tính từ + danh từ', type: 'vocab' },
            { id: 6, title: 'Địa điểm & Phương hướng', desc: 'Nơi chốn, vị trí, hướng đi', words: 18, grammar: 'Ở đâu/Đâu', type: 'vocab' },
            { id: 7, title: 'Mua sắm & Tiền tệ', desc: 'Giá tiền, mua bán, mặc cả', words: 20, grammar: 'Ba多少钱/Cho tôi', type: 'conversation' },
            { id: 8, title: 'Ẩm thực & Thức ăn', desc: 'Món ăn, đồ uống, nhà hàng', words: 25, grammar: 'Chi/Ăn/Uống', type: 'vocab' },
            { id: 9, title: 'Di chuyển & Phương tiện', desc: 'Đi bộ, xe buýt, taxi, máy bay', words: 18, grammar: 'Đi đâu/How to go', type: 'vocab' },
            { id: 10, title: 'Thời tiết & Mùa', desc: 'Nắng, mưa, nóng, lạnh, mùa', words: 15, grammar: 'Thời tiết +怎么样', type: 'vocab' },
        ],
        2: [
            { id: 1, title: 'Hội thoại hàng ngày', desc: 'Giao tiếp cơ bản trong cuộc sống', words: 30, grammar: 'Câu phức', type: 'conversation' },
            { id: 2, title: 'Mô tả sự vật & sự việc', desc: 'Dùng tính từ, trạng từ', words: 28, grammar: 'Rất/非常/特别', type: 'grammar' },
            { id: 3, title: 'So sánh trong tiếng Trung', desc: 'So sánh hơn, nhất, bằng', words: 22, grammar: '比/更/最', type: 'grammar' },
            { id: 4, title: 'Thời gian & Tần suất', desc: 'Thường xuyên, đã từng, sẽ', words: 25, grammar: '常/已经/会', type: 'grammar' },
            { id: 5, title: 'Nguyện vọng & Kế hoạch', desc: 'Muốn, dự định, hy vọng', words: 20, grammar: '想/要/打算', type: 'grammar' },
            { id: 6, title: 'Mời & Đề nghị', desc: 'Mời ăn, mời làm, đề nghị giúp đỡ', words: 22, grammar: '请/让/帮忙', type: 'conversation' },
            { id: 7, title: 'Điều kiện & Giả định', desc: 'Nếu...thì, giả sử, khi nào', words: 24, grammar: '如果/要是/当', type: 'grammar' },
            { id: 8, title: 'Nguyên nhân & Kết quả', desc: 'Bởi vì, vì thế, kết quả', words: 20, grammar: '因为...所以', type: 'grammar' },
        ],
        3: [
            { id: 1, title: 'Ngữ pháp nâng cao', desc: 'Cấu trúc câu phức tạp', words: 40, grammar: 'Câu phức', type: 'grammar' },
            { id: 2, title: 'Viết luận ngắn', desc: 'Luyện viết đoạn văn, bài luận', words: 35, grammar: 'Viết', type: 'writing' },
            { id: 3, title: 'Đọc hiểu nâng cao', desc: 'Đọc và hiểu bài viết dài', words: 50, grammar: 'Đọc hiểu', type: 'reading' },
            { id: 4, title: 'Nghe hiểu chuyên sâu', desc: 'Nghe hội thoại, bài giảng', words: 45, grammar: 'Nghe', type: 'listening' },
            { id: 5, title: 'Từ vựng chuyên ngành', desc: 'Từ vựng HSK 3', words: 60, grammar: 'Từ vựng', type: 'vocab' },
        ],
        4: [
            { id: 1, title: 'Ngữ pháp trung cấp', desc: 'Cấu trúc nâng cao', words: 50, grammar: 'Ngữ pháp', type: 'grammar' },
            { id: 2, title: 'Từ vựng HSK 4', desc: '300 từ vựng mới', words: 70, grammar: 'Từ vựng', type: 'vocab' },
        ],
        5: [
            { id: 1, title: 'Ngữ pháp cao cấp', desc: 'Cấu trúc phức tạp', words: 60, grammar: 'Ngữ pháp', type: 'grammar' },
            { id: 2, title: 'Từ vựng HSK 5', desc: '500 từ vựng nâng cao', words: 90, grammar: 'Từ vựng', type: 'vocab' },
        ],
        6: [
            { id: 1, title: 'Luyện thi HSK 6', desc: 'Ôn tập toàn diện', words: 100, grammar: 'Tổng hợp', type: 'exam' },
            { id: 2, title: 'Luyện đề mẫu', desc: 'Giải đề HSK 6', words: 100, grammar: 'Thi thử', type: 'exam' },
        ]
    };

    async function loadProgress() {
        // Load lesson progress riêng
        lessonProgress = await fetchAPI('get_lesson_progress', { user_id: USER_ID }) || {};
        const vocabList = await fetchAPI('get_vocab', { user_id: USER_ID }) || [];

        let completed = 0;
        Object.values(lessonProgress).forEach(p => {
            if (p.write_completed) completed++;
        });

        document.getElementById('stat-completed').textContent = completed;
        document.getElementById('stat-inprogress').textContent = Object.keys(lessonProgress).length - completed;
        document.getElementById('stat-words').textContent = vocabList.length;
    }

    function renderLessons() {
        const lessons = allLessons[currentLevel] && allLessons[currentLevel].length > 0
            ? allLessons[currentLevel]
            : (lessonsData[currentLevel] || []);
        const grid = document.getElementById('lessons-grid');

        grid.innerHTML = lessons.map(lesson => {
            const lessonId = lesson.id;
            const lessonNum = lesson.lesson_num || lesson.id;
            const lp = lessonProgress[lessonId];
            const isDone = lp?.write_completed == true;
            const progress = isDone ? 100 : 0;
            const title = lesson.title || lessonsData[currentLevel]?.find(l => l.id === lessonNum)?.title || `Bài ${lessonNum}`;
            const desc = lesson.description || lessonsData[currentLevel]?.find(l => l.id === lessonNum)?.desc || '';
            const words = lesson.vocab_count || lessonsData[currentLevel]?.find(l => l.id === lessonNum)?.words || 10;
            const grammar = lesson.grammar || lessonsData[currentLevel]?.find(l => l.id === lessonNum)?.grammar || '';

            return `
            <div class="lesson-card reveal" onclick="goToLesson(${lessonId}, ${currentLevel})">
                <span class="lesson-card__badge ${isDone ? 'lesson-card__badge--done' : ''}">
                    ${isDone ? ' Hoàn thành' : ' Chưa học'}
                </span>
                <div class="lesson-card__number">Bài ${lessonNum}</div>
                <h3 class="lesson-card__title">${escapeHtml(title)}</h3>
                <p class="lesson-card__desc">${escapeHtml(desc)}</p>
                <div class="lesson-card__meta">
                    <span> ${words} từ</span>
                    <span> ${escapeHtml(grammar)}</span>
                    <span> 30 phút</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-bar__fill" style="width: ${progress}%"></div>
                </div>
            </div>
            `;
        }).join('');
    }

    function escapeHtml(str) {
        if (!str) return '';
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function goToLesson(lessonId, level) {
        showToast(' Đang mở bài học...', 'info', 1000);
        window.location.href = `lesson.php?level=${level}&lesson=${lessonId}`;
    }

    // Tab switching
    document.querySelectorAll('.level-tab').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.level-tab').forEach(t => t.classList.remove('level-tab--active'));
            tab.classList.add('level-tab--active');
            currentLevel = parseInt(tab.dataset.level);
            showToast(' Đã chọn HSK ' + currentLevel, 'info', 1500);
            renderLessons();
        });
    });

    // Navbar
    
        
    // Dropdown toggle
    document.querySelector('.dropdown__trigger')?.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('dropdown__menu--open');
    });
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
        }
    });

    
    

    document.querySelectorAll('.level-tab').forEach(tab => {
        if (parseInt(tab.dataset.level) === currentLevel) tab.classList.add('level-tab--active');
    });

    (async function init() {
        await loadLessonsFromAPI();
        await loadProgress();
        renderLessons();
    })();
    </script>
        
    
<script src="utils.js"></script>
<script src="init.js"></script>
</body>
</html>