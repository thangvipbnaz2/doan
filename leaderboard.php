<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BXH - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&family=JetBrains+Mono:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .bxh-page { padding: 100px 0 60px; min-height: 100vh; position: relative; overflow: hidden;
            background: linear-gradient(180deg, #0f172a 0%, #0c1a1a 30%, #0f172a 70%, #0f172a 100%); }
        .bxh-page::before { content: ''; position: fixed; inset: 0;
            background: radial-gradient(ellipse at 20% 30%, rgba(13,148,136,0.06) 0%, transparent 50%),
                        radial-gradient(ellipse at 80% 70%, rgba(13,148,136,0.04) 0%, transparent 50%);
            pointer-events: none; z-index: 0; }

        .bxh-canvas { position: fixed; inset: 0; z-index: 1; pointer-events: none; }

        .bxh-page .container { position: relative; z-index: 2; }

        .bxh-header { text-align: center; padding: 48px 32px 40px;
            background: linear-gradient(135deg, rgba(15,23,42,0.8), rgba(30,41,59,0.6));
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 20px; margin-bottom: 40px; position: relative; overflow: hidden;
            -webkit-backdrop-filter: blur(20px); backdrop-filter: blur(20px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.2), inset 0 1px 0 rgba(255,255,255,0.05); }
        .bxh-header::before { content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 20% 30%, rgba(13,148,136,0.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 70%, rgba(251,191,36,0.06) 0%, transparent 50%);
            pointer-events: none; }
        .bxh-header::after { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08), transparent); }

        .bxh-header__badge { display: inline-flex; align-items: center; gap: 8px; padding: 8px 20px;
            background: rgba(13,148,136,0.12); border: 1px solid rgba(13,148,136,0.25);
            border-radius: 50px; color: #5eead4; font-size: .8rem; font-weight: 600;
            letter-spacing: .5px; margin-bottom: 16px; position: relative; z-index: 1; }
        .bxh-header h1 { font-size: 2.8rem; font-weight: 900; color: #fff; position: relative; z-index: 1;
            line-height: 1.15; }
        .bxh-header h1 span { background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .bxh-header p { color: #94a3b8; font-size: 1rem; margin-top: 8px; position: relative; z-index: 1; }

        .bxh-header__actions { position: relative; z-index: 1; margin-top: 20px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .bxh-header__actions button { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8; padding: 10px 24px; border-radius: 50px; font-size: .85rem; font-weight: 600;
            cursor: pointer; transition: all .25s; font-family: inherit; display: inline-flex; align-items: center; gap: 8px; }
        .bxh-header__actions button:hover { background: rgba(13,148,136,0.15); border-color: rgba(13,148,136,0.3);
            color: #5eead4; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(13,148,136,0.1); }

        .bxh-header__stats { display: flex; justify-content: center; gap: 48px; margin-top: 28px; position: relative; z-index: 1; }
        .bxh-header__stat { text-align: center; }
        .bxh-header__stat-num { font-family: 'JetBrains Mono', monospace; font-size: 2rem; font-weight: 800;
            background: linear-gradient(135deg, #5eead4, #0d9488);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            line-height: 1; }
        .bxh-header__stat-label { font-size: .78rem; color: #64748b; margin-top: 4px; font-weight: 500; }

        .bxh-content { display: grid; grid-template-columns: 1fr; gap: 28px; }

        .bxh-glass { background: rgba(30,41,59,0.5); -webkit-backdrop-filter: blur(16px); backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.06); border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08), inset 0 1px 0 rgba(255,255,255,0.03); }

        .podium { padding: 32px 24px 28px; }
        .podium-inner { display: flex; justify-content: center; align-items: flex-end; gap: 24px;
            perspective: 1000px; }
        .podium-item { text-align: center; flex: 1; max-width: 200px; position: relative;
            animation: podiumIn .6s cubic-bezier(.34,1.56,.64,1) backwards; }
        .podium-item:nth-child(1) { animation-delay: .1s; }
        .podium-item:nth-child(2) { animation-delay: .25s; }
        .podium-item:nth-child(3) { animation-delay: .4s; }
        @keyframes podiumIn { from { opacity:0; transform:translateY(40px) scale(.9); } to { opacity:1; transform:translateY(0) scale(1); } }

        .podium-item__medal { font-size: 3rem; margin-bottom: 4px; display: block;
            animation: medalFloat 3s ease-in-out infinite; }
        .podium-item:nth-child(1) .podium-item__medal { animation-duration: 3s; filter: drop-shadow(0 0 12px rgba(251,191,36,0.4)); }
        .podium-item:nth-child(2) .podium-item__medal { animation-duration: 3.5s; animation-delay: .5s; }
        .podium-item:nth-child(3) .podium-item__medal { animation-duration: 4s; animation-delay: 1s; }
        @keyframes medalFloat { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-6px)} }

        .podium-item__avatar { width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 10px;
            display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700;
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.03));
            border: 2px solid rgba(255,255,255,0.1); }
        .podium-item__avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
        .podium-item--1 .podium-item__avatar { border-color: rgba(251,191,36,0.5);
            box-shadow: 0 0 20px rgba(251,191,36,0.2), inset 0 0 20px rgba(251,191,36,0.05); }
        .podium-item--2 .podium-item__avatar { border-color: rgba(148,163,184,0.4); }
        .podium-item--3 .podium-item__avatar { border-color: rgba(205,127,50,0.4); }

        .podium-item__rank { font-family: 'JetBrains Mono', monospace; font-size: 2.5rem; font-weight: 800;
            position: absolute; top: -8px; right: -4px; opacity: .12;
            background: linear-gradient(135deg, #fff, #64748b);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .podium-item__name { font-weight: 700; font-size: .95rem; color: #f1f5f9; }
        .podium-item__score { font-size: .82rem; color: #94a3b8; font-weight: 500; margin-top: 2px; }
        .podium-item__bar { width: 100%; border-radius: 8px 8px 4px 4px; margin-top: 12px;
            transition: height .8s cubic-bezier(.34,1.56,.64,1); min-height: 20px; position: relative;
            overflow: hidden; }
        .podium-item__bar-inner { position: absolute; inset: 0; border-radius: inherit;
            background: linear-gradient(180deg, rgba(255,255,255,0.15), transparent); }
        .podium-item__bar--1 { background: linear-gradient(180deg, #fbbf24, #f59e0b); height: 120px;
            box-shadow: 0 4px 20px rgba(245,158,11,0.15), inset 0 1px 0 rgba(255,255,255,0.2); }
        .podium-item__bar--2 { background: linear-gradient(180deg, #94a3b8, #64748b); height: 90px; }
        .podium-item__bar--3 { background: linear-gradient(180deg, #fca5a5, #cd7f32); height: 60px; }

        .bxh-table { padding: 0; overflow: hidden; }
        .bxh-table__scroll { overflow-x: auto; }

        .bxh-row { display: grid; grid-template-columns: 56px 1fr 110px 110px 110px; align-items: center;
            padding: 14px 24px; border-bottom: 1px solid rgba(255,255,255,0.04);
            transition: all .25s; animation: rowIn .4s ease backwards; }
        .bxh-row:nth-child(2) { animation-delay: .05s; }
        .bxh-row:nth-child(3) { animation-delay: .1s; }
        .bxh-row:nth-child(4) { animation-delay: .15s; }
        .bxh-row:nth-child(5) { animation-delay: .2s; }
        .bxh-row:nth-child(6) { animation-delay: .25s; }
        .bxh-row:nth-child(7) { animation-delay: .3s; }
        .bxh-row:nth-child(8) { animation-delay: .35s; }
        .bxh-row:nth-child(9) { animation-delay: .4s; }
        .bxh-row:nth-child(10) { animation-delay: .45s; }
        .bxh-row:nth-child(11) { animation-delay: .5s; }
        .bxh-row:nth-child(12) { animation-delay: .55s; }
        .bxh-row:nth-child(13) { animation-delay: .6s; }
        .bxh-row:nth-child(14) { animation-delay: .65s; }
        .bxh-row:nth-child(15) { animation-delay: .7s; }
        .bxh-row:nth-child(16) { animation-delay: .75s; }
        .bxh-row:nth-child(17) { animation-delay: .8s; }
        .bxh-row:nth-child(18) { animation-delay: .85s; }
        .bxh-row:nth-child(19) { animation-delay: .9s; }
        .bxh-row:nth-child(20) { animation-delay: .95s; }
        @keyframes rowIn { from { opacity:0; transform:translateX(-12px); } to { opacity:1; transform:translateX(0); } }
        .bxh-row:last-child { border-bottom: none; }
        .bxh-row:hover { background: rgba(255,255,255,0.03); }

        .bxh-row.header { background: rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.08);
            font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .8px;
            color: #64748b; padding: 12px 24px; animation: none; }

        .bxh-rank { font-size: 1.1rem; font-weight: 800; text-align: center;
            font-variant-numeric: tabular-nums; font-family: 'JetBrains Mono', monospace; }
        .bxh-rank--1 { color: #fbbf24; text-shadow: 0 0 20px rgba(251,191,36,0.3); }
        .bxh-rank--2 { color: #94a3b8; }
        .bxh-rank--3 { color: #cd7f32; }
        .bxh-rank--default { color: #64748b; font-size: .9rem; }

        .bxh-user { display: flex; align-items: center; gap: 12px; }
        .bxh-user__avatar { width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; font-weight: 700; color: #94a3b8; flex-shrink: 0;
            border: 1px solid rgba(255,255,255,0.06); overflow: hidden; }
        .bxh-user__avatar img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
        .bxh-user__name { font-weight: 600; color: #f1f5f9; font-size: .92rem; }
        .bxh-user__name small { display: block; font-weight: 400; font-size: .72rem; color: #64748b; margin-top: 1px; }

        .bxh-stat { text-align: center; font-weight: 600; color: #f1f5f9; font-size: .9rem; }
        .bxh-stat span { display: block; font-size: .68rem; font-weight: 500; color: #64748b;
            text-transform: uppercase; letter-spacing: .3px; margin-top: 2px; }
        .bxh-stat-bar { height: 3px; background: rgba(255,255,255,0.06); border-radius: 4px;
            margin-top: 6px; overflow: hidden; max-width: 80px; margin-left: auto; margin-right: auto; }
        .bxh-stat-bar__fill { height: 100%; border-radius: 4px;
            background: linear-gradient(90deg, #0d9488, #14b8a6); transition: width .8s cubic-bezier(.34,1.56,.64,1);
            width: 0%; }
        .bxh-stat-bar__fill--quiz { background: linear-gradient(90deg, #6366f1, #8b5cf6); }

        .bxh-empty { text-align: center; padding: 80px 20px; color: #64748b; }
        .bxh-empty__icon { font-size: 4rem; margin-bottom: 16px; }
        .bxh-empty h3 { font-size: 1.2rem; font-weight: 700; color: #94a3b8; margin-bottom: 8px; }
        .bxh-empty p { font-size: .9rem; }

        .bxh-row--me { background: rgba(13,148,136,0.08) !important; border-left: 2px solid #0d9488; }
        .bxh-row--me .bxh-user__name { color: #5eead4; }

        @media(max-width:900px) {
            .bxh-header { padding: 36px 20px 32px; }
            .bxh-header h1 { font-size: 1.8rem; }
            .bxh-header__stats { gap: 24px; }
            .podium-inner { gap: 12px; }
            .podium-item { max-width: 140px; }
            .podium-item__bar--1 { height: 90px; }
            .podium-item__bar--2 { height: 68px; }
            .podium-item__bar--3 { height: 45px; }
        }
        @media(max-width:640px) {
            .bxh-row { grid-template-columns: 40px 1fr 70px 70px; padding: 12px 16px; font-size: .82rem; }
            .bxh-row.header { grid-template-columns: 40px 1fr 70px 70px; }
            .bxh-stat:nth-child(5) { display: none; }
            .bxh-header__stat-num { font-size: 1.3rem; }
            .bxh-header__stats { gap: 16px; }
            .podium-item { max-width: 100px; }
            .podium-item__avatar { width: 44px; height: 44px; font-size: 1.1rem; }
            .podium-item__medal { font-size: 2rem; }
            .podium-item__bar--1 { height: 70px; }
            .podium-item__bar--2 { height: 52px; }
            .podium-item__bar--3 { height: 35px; }
            .podium { padding: 20px 12px; }
            .bxh-header__badge { font-size: .72rem; padding: 6px 14px; }
        }

        [data-theme="light"] .bxh-page { background: linear-gradient(180deg, #f0fdfa 0%, #f8fafc 40%, #eff6ff 100%); }
        [data-theme="light"] .bxh-header { background: rgba(255,255,255,0.7); border-color: rgba(13,148,136,0.1);
            box-shadow: 0 8px 32px rgba(13,148,136,0.06); }
        [data-theme="light"] .bxh-header h1 { color: #1e293b; }
        [data-theme="light"] .bxh-glass { background: rgba(255,255,255,0.6); border-color: rgba(255,255,255,0.5); }
        [data-theme="light"] .bxh-row { border-bottom-color: #f1f5f9; }
        [data-theme="light"] .bxh-row:hover { background: #f8fafc; }
        [data-theme="light"] .bxh-row.header { background: #f1f5f9; border-bottom-color: #e2e8f0; color: #64748b; }
        [data-theme="light"] .podium-item__name { color: #1e293b; }
        [data-theme="light"] .bxh-user__name { color: #1e293b; }
        [data-theme="light"] .bxh-stat { color: #0f172a; }
        [data-theme="light"] .bxh-stat-bar { background: #e2e8f0; }
        [data-theme="light"] .bxh-select { background: #fff; border-color: #e2e8f0; color: #1e293b; }
        [data-theme="light"] .bxh-row--me { background: #f0fdfa !important; }
        [data-theme="light"] .bxh-row--me .bxh-user__name { color: #0d9488; }
        [data-theme="light"] .bxh-empty { color: #94a3b8; }
        [data-theme="light"] .bxh-empty h3 { color: #475569; }
        [data-theme="light"] .bxh-header__actions button { background: rgba(0,0,0,0.04); border-color: rgba(0,0,0,0.08); color: #64748b; }
        [data-theme="light"] .bxh-header__actions button:hover { background: rgba(13,148,136,0.08); border-color: #0d9488; color: #0d9488; }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="bxh-page">
    <canvas class="bxh-canvas" id="bxh-canvas"></canvas>
    <div class="container">
        <div class="bxh-header">
            <div class="bxh-header__badge">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                Bảng xếp hạng
            </div>
            <h1>Bảng xếp hạng <span>HànNgữ</span></h1>
            <p>Top người dùng học tập chăm chỉ nhất</p>
            <div class="bxh-header__actions">
                <button onclick="loadBXH()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0 1 15-6.7L21 8"/><path d="M3 12a9 9 0 0 0 15 6.7L21 16"/></svg>
                    Làm mới
                </button>
            </div>
            <div class="bxh-header__stats" id="header-stats"></div>
        </div>

        <div class="bxh-content">
            <div id="podium" class="bxh-glass podium" style="display:none;"></div>

            <div class="bxh-glass bxh-table">
                <div class="bxh-row header">
                    <span style="text-align:center;">#</span>
                    <span>Người dùng</span>
                    <span style="text-align:center;">Bài học</span>
                    <span style="text-align:center;">Quiz</span>
                    <span style="text-align:center;">Điểm</span>
                </div>
                <div class="bxh-table__scroll" id="bxh-list"><div class="bxh-empty"></div></div>
            </div>
        </div>
    </div>
</main>

<script>
const canvas = document.getElementById('bxh-canvas');
const ctx = canvas.getContext('2d');
let particles = [];
let animId = null;

function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = document.querySelector('.bxh-page').offsetHeight;
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas);

class Particle {
    constructor() { this.reset(); }
    reset() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 2 + .5;
        this.speedX = (Math.random() - .5) * .3;
        this.speedY = (Math.random() - .5) * .3 - .1;
        this.opacity = Math.random() * .4 + .1;
        this.hue = Math.random() > .7 ? 45 : 175;
        this.life = Math.random() * 200 + 100;
        this.maxLife = this.life;
    }
    update() {
        this.x += this.speedX;
        this.y += this.speedY;
        this.life--;
        this.opacity = (this.life / this.maxLife) * .4;
        if (this.life <= 0 || this.x < 0 || this.x > canvas.width || this.y < 0 || this.y > canvas.height) this.reset();
    }
    draw() {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fillStyle = `hsla(${this.hue}, 70%, ${this.hue === 45 ? '60%' : '50%'}, ${this.opacity})`;
        ctx.fill();
        if (this.size > 1.5) {
            ctx.shadowBlur = 6;
            ctx.shadowColor = this.hue === 45 ? 'rgba(251,191,36,0.2)' : 'rgba(13,148,136,0.2)';
            ctx.fill();
            ctx.shadowBlur = 0;
        }
    }
}

for (let i = 0; i < 60; i++) particles.push(new Particle());

function animateParticles() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    particles.forEach(p => { p.update(); p.draw(); });
    animId = requestAnimationFrame(animateParticles);
}
animateParticles();

document.addEventListener('visibilitychange', () => {
    if (document.hidden && animId) { cancelAnimationFrame(animId); animId = null; }
    else if (!document.hidden && !animId) animateParticles();
});

async function fetchAPI(action, data) {
    try {
        let url = 'api.php?action=' + action;
        if (data) url += '&' + new URLSearchParams(data).toString();
        return await (await fetch(url)).json();
    } catch (e) { showToast('❌ Lỗi tải bảng xếp hạng!', 'error'); return null; }
}

function animateNumber(el, target, suffix) {
    if (!el) return;
    const duration = 800;
    const start = 0;
    const startTime = performance.now();
    function tick(now) {
        const elapsed = now - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(start + (target - start) * eased);
        el.textContent = current + (suffix || '');
        if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
}

async function loadBXH() {
    showToast('🔄 Đang làm mới...', 'info');
    const list = document.getElementById('bxh-list');
    const podium = document.getElementById('podium');
    const stats = document.getElementById('header-stats');
    list.innerHTML = '<div style="text-align:center;padding:40px;color:#64748b;">⏳</div>';
    const data = await fetchAPI('get_leaderboard', { limit: 20 });
    if (!data || data.length === 0) {
        list.innerHTML = '<div class="bxh-empty"><div class="bxh-empty__icon">🏆</div><h3>Chưa có dữ liệu</h3><p>Hãy đăng ký và học bài để lên BXH!</p></div>';
        showToast('✅ Đã cập nhật!', 'success');
        return;
    }

    const total = data.length;
    const avgLessons = Math.round(data.reduce((s,u) => s + u.lessons_completed, 0) / total);
    const avgQuiz = data.reduce((s,u) => s + parseFloat(u.quiz_avg), 0) / total;

    stats.innerHTML = `
        <div class="bxh-header__stat"><div class="bxh-header__stat-num" id="stat-total">0</div><div class="bxh-header__stat-label">người xếp hạng</div></div>
        <div class="bxh-header__stat"><div class="bxh-header__stat-num" id="stat-lessons">0</div><div class="bxh-header__stat-label">bài trung bình</div></div>
        <div class="bxh-header__stat"><div class="bxh-header__stat-num" id="stat-quiz">0%</div><div class="bxh-header__stat-label">quiz trung bình</div></div>
    `;
    requestAnimationFrame(() => {
        animateNumber(document.getElementById('stat-total'), total);
        animateNumber(document.getElementById('stat-lessons'), avgLessons);
        animateNumber(document.getElementById('stat-quiz'), avgQuiz.toFixed(0), '%');
    });

    const top3 = data.slice(0, 3);
    if (top3.length >= 2) {
        podium.style.display = 'block';
        const medals = ['🥇', '🥈', '🥉'];
        const bars = ['podium-item__bar--1', 'podium-item__bar--2', 'podium-item__bar--3'];
        const medalsMap = { '🥇': '1st', '🥈': '2nd', '🥉': '3rd' };
        const maxLessonsPodium = Math.max(...top3.map(u => u.lessons_completed), 1);
        podium.innerHTML = '<div class="podium-inner">' + top3.map((u, i) => {
            const barPct = Math.max(20, Math.round(u.lessons_completed / maxLessonsPodium * 100));
            const avatarHtml = u.avatar
                ? `<img src="${esc(u.avatar)}" alt="">`
                : (u.display_name || '?')[0].toUpperCase();
            return `
            <div class="podium-item podium-item--${i + 1}">
                <span class="podium-item__rank">${medalsMap[medals[i]]}</span>
                <span class="podium-item__medal">${medals[i]}</span>
                <div class="podium-item__avatar">${avatarHtml}</div>
                <div class="podium-item__name">${esc(u.display_name)}</div>
                <div class="podium-item__score">${u.lessons_completed} bài học · ${parseFloat(u.quiz_avg || 0).toFixed(0)}%</div>
                <div class="podium-item__bar ${bars[i]}" style="height:${barPct}px">
                    <div class="podium-item__bar-inner"></div>
                </div>
            </div>`;
        }).join('') + '</div>';
    }

    const rankEmojis = ['🥇', '🥈', '🥉'];
    const maxLessons = Math.max(...data.map(u => u.lessons_completed), 1);
    const maxScore = Math.max(...data.map(u => u.total_score), 1);
    const currentUser = <?php echo json_encode($_SESSION['user_id'] ?? ''); ?>;

    list.innerHTML = data.map(u => {
        const isMe = u.id && currentUser && u.id == currentUser;
        const lessonsPct = Math.min(100, Math.round(u.lessons_completed / maxLessons * 100));
        const scorePct = Math.min(100, Math.round(u.total_score / maxScore * 100));
        const avatarHtml = u.avatar
            ? `<img src="${esc(u.avatar)}" alt="">`
            : (u.display_name || '?')[0].toUpperCase();
        return '<div class="bxh-row' + (isMe ? ' bxh-row--me' : '') + '">' +
            '<span class="bxh-rank ' + (u.rank <= 3 ? 'bxh-rank--' + u.rank : 'bxh-rank--default') + '">' +
            (u.rank <= 3 ? rankEmojis[u.rank - 1] : u.rank) + '</span>' +
            '<div class="bxh-user"><div class="bxh-user__avatar">' + avatarHtml + '</div>' +
            '<div class="bxh-user__name">' + esc(u.display_name) + (isMe ? '<small>Bạn</small>' : '') + '</div></div>' +
            '<div class="bxh-stat">' + u.lessons_completed + '<span>bài</span><div class="bxh-stat-bar"><div class="bxh-stat-bar__fill" style="width:' + lessonsPct + '%"></div></div></div>' +
            '<div class="bxh-stat">' + u.quiz_avg + '<span>' + u.quiz_count + ' lượt</span><div class="bxh-stat-bar"><div class="bxh-stat-bar__fill bxh-stat-bar__fill--quiz" style="width:' + (parseFloat(u.quiz_avg) || 0) + '%"></div></div></div>' +
            '<div class="bxh-stat">' + u.total_score + '<span>điểm</span><div class="bxh-stat-bar"><div class="bxh-stat-bar__fill" style="width:' + scorePct + '%"></div></div></div>' +
            '</div>';
    }).join('');

    requestAnimationFrame(() => {
        document.querySelectorAll('.bxh-row:not(.header)').forEach((row, i) => {
            row.style.animationDelay = (i * 0.04) + 's';
            row.style.animation = 'rowIn .4s ease backwards';
        });
    });

    showToast('✅ Đã cập nhật!', 'success');
}

function esc(s) { const d = document.createElement('div'); d.textContent = s || ''; return d.innerHTML; }

loadBXH();
</script>
</body>
</html>