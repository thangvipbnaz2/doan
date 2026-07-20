<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sổ tay từ vựng tiếng Trung - Lưu và ôn tập các từ đã học.">
    <title>Sổ tay từ vựng - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="notebook.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="notebook-page">
        <div class="container">
            <div class="page-header">
                <div class="page-header__text">
                    <span class="page-header__badge"> Sổ tay cá nhân</span>
                    <h1 class="page-header__title">Từ vựng <span class="text-gradient">đã lưu</span></h1>
                    <p class="page-header__desc">Ôn tập lại các từ bạn đã đánh dấu trong quá trình học.</p>
                </div>
                <div class="page-header__stats">
                    <div class="stat-box"><span class="stat-box__number" id="total-words">0</span><span class="stat-box__label">Từ đã lưu</span></div>
                </div>
            </div>

            <div class="notebook-toolbar">
                <div class="search-box">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    <input type="text" id="search-input" placeholder="Tìm theo Hán tự, Pinyin hoặc nghĩa...">
                </div>
                <div class="toolbar-actions">
                    <button class="btn btn--outline btn--sm ripple" id="btn-export-txt"> TXT</button>
                    <button class="btn btn--outline btn--sm ripple" id="btn-export-pdf"> PDF</button>
                    <button class="btn btn--outline btn--sm btn--danger ripple" id="btn-clear-all"> Xóa tất cả</button>
                </div>
            </div>

            <div class="notebook-empty empty-state-float" id="notebook-empty" style="display:none;">
                <div class="notebook-empty__icon"></div>
                <h3>Chưa có từ vựng nào</h3>
                <p>Vào <a href="lesson.php">trang học</a> và nhấn <strong>"Lưu từ"</strong> để thêm.</p>
            </div>

            <div class="vocab-grid" id="vocab-grid"></div>
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

    async function fetchAPI(action, data = null, method = 'GET') {
        try {
            let url = `${API_URL}?action=${action}`;
            let options = { method, headers: { 'Content-Type': 'application/json' } };
            if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
            else if (data) options.body = JSON.stringify(data);
            return await (await fetch(url, options)).json();
        } catch (e) { return null; }
    }

    async function loadWords() {
        const grid = document.getElementById('vocab-grid');
        if (!grid) return;
        grid.innerHTML = '<div class="loading-pulse">Đang tải...</div>';
        const words = await fetchAPI('get_notebook');
        if (!words || words.length === 0) {
            grid.innerHTML = '<p class="no-results">Chưa có từ vựng nào. Hãy học và lưu từ nhé!</p>';
            return;
        }
        grid.innerHTML = words.map(w => `
            <div class="vocab-card reveal">
                <button class="vocab-card__delete" data-id="${w.id}" title="Xóa" aria-label="Xoá">×</button>
                ${!w.vocab_id ? '<span class="vocab-card__badge">AI</span>' : ''}
                <div class="vocab-card__hanzi">${w.hanzi}</div>
                <div class="vocab-card__pinyin">${w.pinyin}</div>
                <div class="vocab-card__meaning">${w.meaning}</div>
                <div class="vocab-card__meta"><span> ${w.strokes||'?'} nét</span><span>${w.saved_at||''}</span></div>
            </div>`).join('');
        document.querySelectorAll('.vocab-card__delete').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                await fetchAPI('delete_notebook', { id, user_id: USER_ID });
                loadWords();
                showToast(' Đã xóa khỏi sổ tay!', 'success');
            });
        });
    }

    // Search với debounce
    let searchTimeout;
    document.getElementById('search-input').addEventListener('input', async (e) => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(async () => {
            const filter = e.target.value.trim().toLowerCase();
            const words = await fetchAPI('get_notebook');
            const grid = document.getElementById('vocab-grid');

            if (!filter) { loadWords(); return; }

            const filtered = words.filter(w =>
                w.hanzi.includes(filter) || w.pinyin.toLowerCase().includes(filter) || w.meaning.toLowerCase().includes(filter)
            );

            if (filtered.length === 0) {
                grid.innerHTML = '<p class="no-results">Không tìm thấy "' + filter + '"</p>';
            } else {
                grid.innerHTML = filtered.map(w => `
                    <div class="vocab-card reveal">
                        <button class="vocab-card__delete" data-id="${w.id}" title="Xóa" aria-label="Xoá">×</button>
                        ${!w.vocab_id ? '<span class="vocab-card__badge">AI</span>' : ''}
                        <div class="vocab-card__hanzi">${w.hanzi}</div>
                        <div class="vocab-card__pinyin">${w.pinyin}</div>
                        <div class="vocab-card__meaning">${w.meaning}</div>
                        <div class="vocab-card__meta"><span> ${w.strokes||'?'} nét</span><span>${w.saved_at||''}</span></div>
                    </div>`).join('');
            }
        }, 300);
    });

    // Clear all
    document.getElementById('btn-clear-all').addEventListener('click', async () => {
        showConfirm('Bạn có chắc muốn xóa TẤT CẢ từ vựng đã lưu?', 'Xóa tất cả').then(async function(r){
            if (r) {
                await fetchAPI('clear_notebook', { user_id: USER_ID });
                loadWords();
                showToast(' Đã xóa tất cả!', 'success');
            }
        });
    });

    // Export TXT
    document.getElementById('btn-export-txt').addEventListener('click', () => {
        showToast(' Đang tải xuống...', 'info', 2000);
        window.location.href = 'api.php?action=export_notebook&user_id=' + USER_ID;
    });

    // Export PDF
    document.getElementById('btn-export-pdf').addEventListener('click', () => {
        showToast(' Đang tải xuống...', 'info', 2000);
        window.location.href = 'api.php?action=export_notebook_pdf&user_id=' + USER_ID;
    });

    loadWords();
    
    document.querySelector('.dropdown__trigger')?.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('dropdown__menu--open');
    });
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
        }
    });
</script>

    

    
<script src="init.js"></script>
</body>
</html>