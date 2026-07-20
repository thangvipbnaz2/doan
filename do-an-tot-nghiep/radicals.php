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
        .radical-card__examples { font-size: .75rem; color: var(--gray-light); margin-top: 8px; }

        .search-box { max-width: 400px; margin: 0 auto 24px; position: relative; }
        .search-box input { width: 100%; padding: 12px 20px; border: 2px solid var(--gray-light); border-radius: var(--radius-sm); font-size: .95rem; }
        .search-box input:focus { outline: none; border-color: var(--red); }

        @media(max-width:768px) { .radicals-grid{grid-template-columns:repeat(auto-fill,minmax(100px,1fr))} }
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
    const radicalsData = {
        'Người': [
            { char: '亻', name: 'Nhân', strokes: 2, examples: ['你', '我', '他'] },
            { char: '儿', name: 'Nhi', strokes: 2, examples: ['儿', '元'] },
            { char: '入', name: 'Nhập', strokes: 2, examples: ['入', '八'] },
        ],
        'Nữ': [
            { char: '女', name: 'Nữ', strokes: 3, examples: ['好', '妈', '她'] },
            { char: '女', name: 'Nữ (biến thể)', strokes: 3, examples: ['妈', '她'] },
        ],
        'Miên': [
            { char: '宀', name: 'Miên', strokes: 3, examples: ['家', '字', '安'] },
            { char: '冖', name: 'Bị', strokes: 2, examples: ['写', '冠'] },
        ],
        'Khẩu': [
            { char: '口', name: 'Khẩu', strokes: 3, examples: ['吃', '喝', '叫'] },
            { char: '囗', name: 'Vi', strokes: 3, examples: ['国', '回'] },
        ],
        'Tâm': [
            { char: '忄', name: 'Tâm', strokes: 3, examples: ['想', '情', '怕'] },
            { char: '心', name: 'Tâm', strokes: 4, examples: ['想', '心'] },
        ],
        'Thủy': [
            { char: '氵', name: 'Thủy', strokes: 3, examples: ['江', '海', '河'] },
            { char: '氺', name: 'Thủy (đủ)', strokes: 4, examples: ['求', '泉'] },
        ],
        'Hỏa': [
            { char: '火', name: 'Hỏa', strokes: 4, examples: ['火', '灯', '热'] },
            { char: '灬', name: 'Hỏa (biến thể)', strokes: 4, examples: ['热', '照'] },
        ],
        'Mộc': [
            { char: '木', name: 'Mộc', strokes: 4, examples: ['树', '本', '林'] },
            { char: '扌', name: 'Thủ (tay)', strokes: 3, examples: ['打', '把', '提'] },
        ],
        'Kim': [
            { char: '钅', name: 'Kim (kim loại)', strokes: 5, examples: ['钱', '铁', '铜'] },
            { char: '金', name: 'Kim', strokes: 8, examples: ['金', '铁'] },
        ],
        'Hoa': [
            { char: '艹', name: 'Hoa (cỏ)', strokes: 3, examples: ['花', '菜', '苹'] },
        ],
        'Ngôn': [
            { char: '讠', name: 'Ngôn (lời nói)', strokes: 2, examples: ['说', '话', '请'] },
            { char: '言', name: 'Ngôn', strokes: 7, examples: ['说', '话'] },
        ],
        'Nhật': [
            { char: '日', name: 'Nhật (mặt trời)', strokes: 4, examples: ['明', '早', '天'] },
            { char: '月', name: 'Nguyệt (trăng)', strokes: 4, examples: ['明', '朋', '有'] },
        ],
    };

    function renderRadicals() {
        const container = document.getElementById('radicals-container');
        let html = '';

        for (const [category, radicals] of Object.entries(radicalsData)) {
            html += `
            <div class="radical-category">
                <h3 class="radical-category__title">${category}</h3>
                <div class="radicals-grid">
                    ${radicals.map(r => `
                        <div class="radical-card reveal" onclick="showRadical('${r.char}', '${r.name}', ${r.strokes}, '${r.examples.join(',')}')">
                            <span class="radical-card__char">${r.char}</span>
                            <span class="radical-card__name">${r.name}</span>
                            <span class="radical-card__strokes">${r.strokes} nét</span>
                            <span class="radical-card__examples">${r.examples.join(' ')}</span>
                        </div>
                    `).join('')}
                </div>
            </div>`;
        }

        container.innerHTML = html;
    }

    function searchRadicals(query) {
        const cards = document.querySelectorAll('.radical-card');
        query = query.toLowerCase();
        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(query) ? 'block' : 'none';
        });
    }

    function showRadical(char, name, strokes, examples) {
        showToast(' ' + char + ' - ' + name, 'info', 3000);
    }

    async function checkAuth() {
    }

    renderRadicals();
    
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