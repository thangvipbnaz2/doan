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
        .practice-card { background: #fff; border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow); text-align: center; cursor: pointer; transition: var(--transition); border: 2px solid transparent; }
        .practice-card:hover { border-color: var(--red); transform: translateY(-6px); box-shadow: var(--shadow-lg); }

        .practice-card__icon { font-size: 3rem; margin-bottom: 16px; display:flex; align-items:center; justify-content:center; }
        .practice-card__icon .bi { font-size: 3rem; }
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
        .option-btn.correct { background: #d1fae5; border-color: #059669; color: #065f46; }
        .option-btn.wrong { background: #fef2f2; border-color: #dc2626; color: #dc2626; }

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

        [data-theme="dark"] .practice-page { background: linear-gradient(180deg, #0f172a, #1e293b); }
        [data-theme="dark"] .page-header { background: #1e293b; }
        [data-theme="dark"] .page-header__title { color: #f1f5f9; }
        [data-theme="dark"] .page-header__desc { color: #94a3b8; }
        [data-theme="dark"] .practice-card { background: #1e293b; }
        [data-theme="dark"] .practice-card__title { color: #f1f5f9; }
        [data-theme="dark"] .practice-card__desc { color: #94a3b8; }
        [data-theme="dark"] .practice-box { background: #1e293b; }
        [data-theme="dark"] .question-box__hanzi { color: #f1f5f9; }
        [data-theme="dark"] .question-box__meaning { color: #94a3b8; }
        [data-theme="dark"] .drag-area { background: rgba(13,148,136,.08); border-color: rgba(13,148,136,.3); }
        [data-theme="dark"] .drag-word { background: #1e293b; color: #f1f5f9; }
        [data-theme="dark"] .option-btn { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .option-btn:hover { border-color: var(--red); }
        [data-theme="dark"] .option-btn.selected { background: var(--red); color: #fff; }
        [data-theme="dark"] .option-btn.correct { background: rgba(16,185,129,.15); border-color: #10b981; color: #6ee7b7; }
        [data-theme="dark"] .option-btn.wrong { background: rgba(239,68,68,.15); border-color: #ef4444; color: #fca5a5; }
        [data-theme="dark"] .passage-box { background: rgba(13,148,136,.08); }
        [data-theme="dark"] .passage-box__text { color: #f1f5f9; }
        [data-theme="dark"] .passage-box__note { color: #94a3b8; }
        [data-theme="dark"] .quiz-nav { border-top-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .quiz-progress { color: #64748b; }
        [data-theme="dark"] .result-box__message { color: #f1f5f9; }
        [data-theme="dark"] .result-detail__row { border-bottom-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .result-detail__label { color: #64748b; }
        [data-theme="dark"] .result-detail__value { color: #f1f5f9; }
        [data-theme="dark"] .timer-display { color: #f1f5f9; }
        [data-theme="dark"] .typing-input { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .sentence-parts { background: rgba(255,255,255,.04); border-color: rgba(255,255,255,.08); }
        [data-theme="dark"] .sentence-part { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .sentence-answer { background: rgba(13,148,136,.08); border-color: rgba(13,148,136,.3); }
        [data-theme="dark"] .sentence-slot { border-bottom-color: var(--red); }
        [data-theme="dark"] #practice-config label[style*="color"] { color: #f1f5f9 !important; }
        [data-theme="dark"] #level-select { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .timer-bar { background: rgba(255,255,255,.08); }


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
                    <label style="font-weight:600;color:var(--dark);"><i class="bi bi-bar-chart"></i> Chọn cấp độ:</label>
                    <select id="level-select" style="padding:10px 18px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;font-weight:600;background:#fff;cursor:pointer;">
                        <option value="1" selected>HSK 1</option>
                        <option value="2">HSK 2</option>
                        <option value="3">HSK 3</option>
                        <option value="4">HSK 4</option>
                        <option value="5">HSK 5</option>
                        <option value="6">HSK 6</option>
                    </select>
                </div>
                <button class="btn btn--outline btn--sm ripple" onclick="toggleHistory()"><i class="bi bi-clock-history"></i> Lịch sử</button>
            </div>

            <!-- Quiz History -->
            <div id="quiz-history" style="display:none;margin-bottom:24px;">
                <div class="user-progress">
                    <div class="user-progress__title"> Lịch sử luyện tập</div>
                    <div id="history-list" style="margin-top:12px;max-height:300px;overflow-y:auto;"></div>
                </div>
            </div>

            <div class="practice-types" id="practice-types">
                <a href="basic-practice.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="1" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-patch-question-fill" style="color:#0d9488"></i></div>
                    <h3 class="practice-card__title">Trắc nghiệm từ vựng</h3>
                    <p class="practice-card__desc">Chọn nghĩa đúng của chữ Hán hiển thị</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="basic-practice.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="1" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-headphones" style="color:#fb923c"></i></div>
                    <h3 class="practice-card__title">Nghe và chọn</h3>
                    <p class="practice-card__desc">Nghe phát âm và chọn đáp án đúng</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="basic-practice.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="1" data-hsk-max="2">
                    <div class="practice-card__icon"><i class="bi bi-puzzle-fill" style="color:#8b5cf6"></i></div>
                    <h3 class="practice-card__title">Ghép bộ thủ</h3>
                    <p class="practice-card__desc">Kéo các bộ thủ vào khung để tạo thành chữ</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="sentence-builder.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="3" data-hsk-max="4">
                    <div class="practice-card__icon"><i class="bi bi-columns-gap" style="color:#6366f1"></i></div>
                    <h3 class="practice-card__title">Ghép câu</h3>
                    <p class="practice-card__desc">Sắp xếp từ thành câu hoàn chỉnh (HSK 3-4)</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="reading-context.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="4" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-pencil-square" style="color:#d97706"></i></div>
                    <h3 class="practice-card__title">Điền khuyết</h3>
                    <p class="practice-card__desc">Điền từ thích hợp vào chỗ trống trong đoạn văn</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="reading-context.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="4" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-shuffle" style="color:#0d9488"></i></div>
                    <h3 class="practice-card__title">Chọn từ đồng nghĩa</h3>
                    <p class="practice-card__desc">Chọn từ thay thế phù hợp nhất với ngữ cảnh</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="advanced-academic.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="6" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-exclamation-triangle" style="color:#ef4444"></i></div>
                    <h3 class="practice-card__title">Tìm lỗi ngữ pháp</h3>
                    <p class="practice-card__desc">Xác định và sửa lỗi sai trong câu (HSK 6)</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="advanced-academic.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="5" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-pencil-square" style="color:#0d9488"></i></div>
                    <h3 class="practice-card__title">Viết đoạn văn</h3>
                    <p class="practice-card__desc">Viết đoạn văn dựa trên từ khoá cho sẵn (HSK 5+)</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
                <a href="advanced-academic.php" class="practice-card reveal" style="text-decoration:none" data-hsk-min="6" data-hsk-max="6">
                    <div class="practice-card__icon"><i class="bi bi-clock-history" style="color:#7c3aed"></i></div>
                    <h3 class="practice-card__title">Tóm tắt văn bản</h3>
                    <p class="practice-card__desc">Đọc và viết tóm tắt văn bản tiếng Trung (HSK 6)</p>
                    <span class="practice-card__btn"><i class="bi bi-play-fill"></i> Luyện tập</span>
                </a>
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

    // ===== QUIZ HISTORY =====
    async function toggleHistory() {
        const el = document.getElementById('quiz-history');
        if (el.style.display === 'block') { el.style.display = 'none'; return; }
        el.style.display = 'block';
        await loadHistory();
    }

    async function loadHistory() {
        const list = document.getElementById('history-list');
        list.innerHTML = '';
        const data = await fetchAPI('get_quiz_history');
        if (!data || data.length === 0) {
            list.innerHTML = '<p class="empty-state-float" style="color:var(--gray);text-align:center;">Chưa có lịch sử luyện tập.</p>';
            return;
        }
        list.innerHTML = data.map(r => {
            const label = r.quiz_type === 'choice' ? 'Trắc nghiệm' : r.quiz_type === 'basic' ? 'Cơ bản' : r.quiz_type === 'sentence' ? 'Ghép câu' : r.quiz_type === 'reading' ? 'Đọc hiểu' : r.quiz_type === 'advanced' ? 'Cao cấp' : r.quiz_type;
            return `<div style="display:flex;justify-content:space-between;align-items:center;padding:10px 14px;background:rgba(255,255,255,0.1);border-radius:8px;margin-bottom:8px;font-size:.85rem;">
                <span>${label} • HSK ${r.level || 'all'}</span>
                <span>${r.score}/${r.total_questions} (<strong>${Math.round(r.score/r.total_questions*100)}%</strong>)</span>
                <span style="color:var(--gray);font-size:.75rem;">${r.completed_at ? new Date(r.completed_at).toLocaleDateString('vi') : ''}</span>
            </div>`;
        }).join('');
    }

    // ===== HSK FILTER =====
    function filterByLevel(level) {
        document.querySelectorAll('#practice-types .practice-card').forEach(card => {
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

    document.getElementById('level-select').addEventListener('change', function() {
        filterByLevel(parseInt(this.value));
    });

    filterByLevel(parseInt(document.getElementById('level-select').value));
    </script>

    
</body>
</html>