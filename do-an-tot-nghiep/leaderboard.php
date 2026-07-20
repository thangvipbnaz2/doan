<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BXH - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .bxh-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafb,#eff6ff)}
        .bxh-header{text-align:center;margin-bottom:40px;padding:32px;background:#fff;border-radius:var(--radius);box-shadow:var(--shadow)}
        .bxh-header h1{font-size:2rem;font-weight:900;color:var(--dark)}
        .bxh-header p{color:var(--gray);margin-top:8px;font-size:.95rem}
        .bxh-table{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow-x:auto;overflow-y:hidden}
        .bxh-row{display:grid;grid-template-columns:60px 1fr 120px 120px 120px;align-items:center;padding:16px 24px;border-bottom:1px solid var(--gray-light);transition:var(--transition)}
        .bxh-row:hover{background:var(--teal-light)}
        .bxh-row:last-child{border-bottom:none}
        .bxh-row.header{background:var(--teal);color:#fff;font-weight:600;font-size:.85rem}
        .bxh-rank{font-size:1.2rem;font-weight:900;text-align:center}
        .bxh-rank--1{color:#f59e0b}
        .bxh-rank--2{color:#94a3b8}
        .bxh-rank--3{color:#cd7f32}
        .bxh-name{font-weight:600;color:var(--dark)}
        .bxh-stat{text-align:center;font-weight:600;color:var(--teal-dark)}
        .bxh-stat span{display:block;font-size:.75rem;font-weight:400;color:var(--gray)}
        .bxh-empty{text-align:center;padding:60px;color:var(--gray)}
        .podium{display:flex;justify-content:center;align-items:flex-end;gap:24px;margin-bottom:40px;padding:24px}
        .podium-item{text-align:center;width:160px}
        .podium-item__place{font-size:2.5rem;font-weight:900;margin-bottom:8px}
        .podium-item__name{font-weight:700;font-size:1rem;color:var(--dark)}
        .podium-item__score{font-size:1.2rem;font-weight:700;color:var(--teal-dark);margin-top:4px}
        .podium-item__bar{height:80px;border-radius:12px 12px 0 0;margin-top:12px}
        .podium-item__bar--1{height:120px;background:linear-gradient(180deg,#fbbf24,#f59e0b)}
        .podium-item__bar--2{height:90px;background:linear-gradient(180deg,#cbd5e1,#94a3b8)}
        .podium-item__bar--3{height:60px;background:linear-gradient(180deg,#fca5a5,#cd7f32)}
        @media(max-width:768px){.bxh-row{grid-template-columns:40px 1fr 80px 80px;font-size:.85rem}.bxh-stat:nth-child(5){display:none}.podium{gap:12px}.podium-item{width:100px}}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="bxh-page">
        <div class="container">
            <div class="bxh-header reveal">
                <h1> Bảng xếp hạng</h1>
                <p>Top người dùng học tập chăm chỉ nhất</p>
                <div style="margin-top:12px;display:flex;gap:8px;justify-content:center;flex-wrap:wrap;">
                    <button class="btn btn--sm btn--primary ripple" onclick="loadBXH()"> Làm mới</button>
                </div>
            </div>

            <div id="podium" class="podium reveal" style="display:none;"></div>

            <div class="bxh-table reveal">
                <div class="bxh-row header">
                    <span>#</span>
                    <span>Người dùng</span>
                    <span style="text-align:center;">Từ đã học</span>
                    <span style="text-align:center;">Quiz</span>
                    <span style="text-align:center;">Điểm</span>
                </div>
                <div id="bxh-list"><div class="bxh-empty empty-state-float"></div></div>
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

    async function fetchAPI(action, data) {
        try {
            let url = `${API_URL}?action=${action}`;
            if (data) url += '&' + new URLSearchParams(data).toString();
            return await (await fetch(url)).json();
        } catch (e) { showToast(' Lỗi tải bảng xếp hạng!', 'error'); return null; }
    }

    async function loadBXH() {
        showToast(' Đang làm mới...', 'info', 1500);
        const list = document.getElementById('bxh-list');
        const podium = document.getElementById('podium');
        list.innerHTML = '<div class="loading-pulse">Đang tải...</div>';
        const data = await fetchAPI('get_leaderboard', { limit: 20 });
        if (!data || data.length === 0) {
            list.innerHTML = '<div class="bxh-empty"> Chưa có dữ liệu. Hãy đăng ký và học tập để lên BXH!</div>';
            return;
        }

        // Podium top 3
        const top3 = data.slice(0, 3);
        if (top3.length >= 2) {
            podium.style.display = 'flex';
            const medals = ['', '', ''];
            const bars = ['podium-item__bar--1', 'podium-item__bar--2', 'podium-item__bar--3'];
            podium.innerHTML = top3.map((u, i) => `
                <div class="podium-item">
                    <div class="podium-item__place">${medals[i]}</div>
                    <div class="podium-item__name">${esc(u.display_name)}</div>
                    <div class="podium-item__score">${u.total_score}</div>
                    <div class="podium-item__bar ${bars[i]}"></div>
                </div>
            `).join('');
        }

        // Full list
        list.innerHTML = data.map(u => `
            <div class="bxh-row">
                <span class="bxh-rank ${u.rank <= 3 ? 'bxh-rank--' + u.rank : ''}">${u.rank <= 3 ? ['','',''][u.rank-1] : u.rank}</span>
                <span class="bxh-name">${esc(u.display_name)}</span>
                <span class="bxh-stat">${u.vocab_learned}<span>từ</span></span>
                <span class="bxh-stat">${u.quiz_avg}%<span>${u.quiz_count} lượt</span></span>
                <span class="bxh-stat">${u.total_score}</span>
            </div>
        `).join('');
        showToast(' Đã cập nhật!', 'success', 1500);
    }

    function esc(s) { const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }

    
        

    loadBXH();
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
        }
    });
</script>

    

    
<script src="init.js"></script>
</body>
</html>
