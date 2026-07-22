<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ thủ - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .radicals-page { padding: 100px 0 60px; min-height: 100vh; background: linear-gradient(180deg, #f8fafc, #eff6ff); }
        .page-header { text-align: center; margin-bottom: 32px; padding: 32px; background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); }
        .page-header__badge { display: inline-block; padding: 5px 16px; background: var(--gold-light); color: var(--gold-dark); border-radius: 50px; font-size: .82rem; font-weight: 600; margin-bottom: 10px; }
        .page-header__title { font-size: 2rem; font-weight: 800; color: var(--dark); }
        .page-header__desc { font-size: .95rem; color: var(--gray); margin-top: 8px; }

        .radical-category { margin-bottom: 32px; }
        .radical-category__title { font-size: 1.2rem; font-weight: 700; color: var(--dark); margin-bottom: 16px; padding-left: 12px; border-left: 4px solid var(--red); }
        .radicals-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 12px; }

        .radical-card { background: #fff; border-radius: var(--radius-sm); padding: 16px; text-align: center; box-shadow: var(--shadow); transition: var(--transition); cursor: pointer; }
        .radical-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); border: 2px solid var(--red); }
        .radical-card__char { font-family: 'Noto Sans SC', sans-serif; font-size: 2.5rem; font-weight: 900; color: var(--dark); display: block; margin-bottom: 8px; }
        .radical-card__name { font-size: .85rem; color: var(--red); font-weight: 600; display: block; margin-bottom: 4px; }
        .radical-card__strokes { font-size: .75rem; color: var(--gray); display: block; }

        .search-box { max-width: 400px; margin: 0 auto 24px; position: relative; }
        .search-box input { width: 100%; padding: 12px 20px; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); font-size: .95rem; }
        .search-box input:focus { outline: none; border-color: var(--red); }

        @media(max-width:768px) { .radicals-grid{grid-template-columns:repeat(auto-fill,minmax(100px,1fr))} }

        [data-theme="dark"] .radicals-page { background: linear-gradient(180deg, #0f172a, #1e293b); }
        [data-theme="dark"] .page-header { background: #1e293b; }
        [data-theme="dark"] .page-header__title { color: #f1f5f9; }
        [data-theme="dark"] .page-header__desc { color: #94a3b8; }
        [data-theme="dark"] .radical-category__title { color: #f1f5f9; }
        [data-theme="dark"] .radical-card { background: #1e293b; }
        [data-theme="dark"] .radical-card__char { color: #f1f5f9; }
        [data-theme="dark"] .radical-card__name { color: #fca5a5; }
        [data-theme="dark"] .radical-card__strokes { color: #64748b; }

        [data-theme="dark"] .search-box input { background: #1e293b; border-color: rgba(255,255,255,.08); color: #f1f5f9; }
        [data-theme="dark"] .search-box input:focus { border-color: var(--red); }

        .radical-modal__char { font-family:'Noto Sans SC',sans-serif; font-size:4rem; font-weight:900; color:var(--dark); display:block; text-align:center; margin-bottom:4px; }
        .radical-modal__name { display:block; text-align:center; font-size:1.1rem; font-weight:700; color:var(--red); margin-bottom:4px; }
        .radical-modal__strokes { display:block; text-align:center; font-size:.85rem; color:var(--gray); margin-bottom:20px; }
        .radical-modal__examples-title { font-size:.95rem; font-weight:700; color:var(--dark); margin-bottom:12px; padding-bottom:8px; border-bottom:2px solid var(--teal-light); }
        .radical-modal__example { background:#f8fafc; border-radius:12px; padding:16px; margin-bottom:12px; }
        .radical-modal__example:last-child { margin-bottom:0; }
        .radical-modal__example-phrase { font-family:'Noto Sans SC',sans-serif; font-size:1.3rem; font-weight:700; color:var(--dark); display:block; margin-bottom:6px; letter-spacing:2px; }
        .radical-modal__example-pinyin { font-size:.85rem; color:#94a3b8; display:block; margin-bottom:4px; }
        .radical-modal__example-meaning { font-size:.9rem; color:var(--gray); display:block; }
        [data-theme="dark"] .radical-modal__char { color:#f1f5f9; }
        [data-theme="dark"] .radical-modal__name { color:#fca5a5; }
        [data-theme="dark"] .radical-modal__strokes { color:#64748b; }
        [data-theme="dark"] .radical-modal__examples-title { color:#f1f5f9; }
        [data-theme="dark"] .radical-modal__example { background:#1e293b; }
        [data-theme="dark"] .radical-modal__example-phrase { color:#f1f5f9; }
        [data-theme="dark"] .radical-modal__example-pinyin { color:#64748b; }
        [data-theme="dark"] .radical-modal__example-meaning { color:#94a3b8; }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="radicals-page">
        <div class="container">
            <div class="page-header reveal">
                <span class="page-header__badge"> Bộ thủ</span>
                <h1 class="page-header__title">214 <span class="text-gradient">Bộ thủ</span> cơ bản</h1>
                <p class="page-header__desc">Nền tảng quan trọng để học chữ Hán</p>
            </div>

            <div class="search-box">
                <input type="text" placeholder="Tìm bộ thủ..." oninput="searchRadicals(this.value)">
            </div>

            <div id="radicals-container"></div>
        </div>
    </main>
    
    <div class="modal-overlay" id="radical-modal">
        <div class="modal-content" style="max-width:500px;">
            <button class="modal-close" onclick="closeRadicalModal()">&times;</button>
            <div class="modal-body">
                <span class="radical-modal__char" id="modal-char"></span>
                <span class="radical-modal__name" id="modal-name"></span>
                <span class="radical-modal__strokes" id="modal-strokes"></span>
                <div class="radical-modal__examples-title">Ví dụ</div>
                <div id="modal-examples"></div>
            </div>
        </div>
    </div>
    <script>
    const API_URL = 'api.php';

    async function loadRadicals() {
        const container = document.getElementById('radicals-container');
        container.innerHTML = '<p style="text-align:center;padding:40px;color:#64748b;">⏳ Đang tải...</p>';
        try {
            const r = await fetch(API_URL + '?action=get_radicals');
            const data = await r.json();
            if (!data || !data.length) { container.innerHTML = '<p style="text-align:center;padding:40px;color:#64748b;">Không có dữ liệu.</p>'; return; }

            const groups = {};
            data.forEach(rad => {
                const cat = rad.category || 'Khác';
                if (!groups[cat]) groups[cat] = [];
                groups[cat].push(rad);
            });

            let html = '';
            const catOrder = Object.keys(groups).sort((a, b) => {
                const order = ['Nét cơ bản', 'Con số', 'Người', 'Đồ vật'];
                const ia = order.indexOf(a), ib = order.indexOf(b);
                if (ia !== -1 && ib !== -1) return ia - ib;
                if (ia !== -1) return -1; if (ib !== -1) return 1;
                return a.localeCompare(b, 'vi');
            });
            catOrder.forEach(cat => {
                const rads = groups[cat];
                html += `
                <div class="radical-category">
                    <h3 class="radical-category__title">${escapeHtml(cat)} <span style="font-weight:400;color:#94a3b8;font-size:.85rem;">(${rads.length})</span></h3>
                    <div class="radicals-grid">
                        ${rads.map(r => `
                            <div class="radical-card" data-radical='${encodeURIComponent(JSON.stringify(r))}' onclick="showRadical(this)">
                                <span class="radical-card__char">${escapeHtml(r.char)}</span>
                                <span class="radical-card__name">${escapeHtml(r.name_vietnamese)}</span>
                                <span class="radical-card__strokes">${r.strokes} nét</span>
                            </div>
                        `).join('')}
                    </div>
                </div>`;
            });
            container.innerHTML = html;
        } catch (e) {
            container.innerHTML = '<p style="text-align:center;padding:40px;color:#ef4444;">❌ Lỗi tải dữ liệu.</p>';
            console.error('loadRadicals error:', e);
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    function searchRadicals(query) {
        const cards = document.querySelectorAll('.radical-card');
        query = query.toLowerCase();
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(query) ? 'block' : 'none';
        });
    }

    function showRadical(el) {
        const data = JSON.parse(decodeURIComponent(el.dataset.radical));
        document.getElementById('modal-char').textContent = data.char;
        document.getElementById('modal-name').textContent = data.name_vietnamese;
        document.getElementById('modal-strokes').textContent = data.strokes + ' nét';
        const container = document.getElementById('modal-examples');
        if (data.examples && data.examples.length) {
            container.innerHTML = data.examples.map(ex => `
                <div class="radical-modal__example">
                    <span class="radical-modal__example-phrase">${escapeHtml(ex.phrase)}</span>
                    <span class="radical-modal__example-pinyin">${escapeHtml(ex.pinyin)}</span>
                    <span class="radical-modal__example-meaning">${escapeHtml(ex.meaning)}</span>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<p style="color:var(--gray);text-align:center;padding:12px;">Chưa có ví dụ.</p>';
        }
        document.getElementById('radical-modal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeRadicalModal() {
        document.getElementById('radical-modal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.getElementById('radical-modal').addEventListener('click', function(e) {
        if (e.target === this) closeRadicalModal();
    });

    loadRadicals();
</script>
</body>
</html>