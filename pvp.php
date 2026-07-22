<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PvP - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&family=JetBrains+Mono:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .pvp-page { padding: 100px 0 60px; min-height: 100vh; position: relative; overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #0f1a1a 30%, #0f172a 70%, #0f172a 100%); }
        .pvp-page::before { content: ''; position: fixed; inset: 0;
            background: radial-gradient(ellipse at 30% 20%, rgba(13,148,136,0.08) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(13,148,136,0.05) 0%, transparent 50%);
            pointer-events: none; z-index: 0; }
        .pvp-grid { position: fixed; inset: 0; z-index: 0; opacity: 0.03;
            background-image: linear-gradient(rgba(13,148,136,0.3) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(13,148,136,0.3) 1px, transparent 1px);
            background-size: 60px 60px; }

        .pvp-page .container { position: relative; z-index: 1; }

        .pvp-header { text-align: center; margin-bottom: 40px; }
        .pvp-header__badge { display: inline-flex; align-items:center; gap:6px; padding:6px 18px;
            background: rgba(13,148,136,0.12); border: 1px solid rgba(13,148,136,0.25);
            border-radius: 50px; color: #5eead4; font-size: .8rem; font-weight: 600;
            letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px; }
        .pvp-header h1 { font-size: 3.2rem; font-weight: 900; line-height: 1.1; margin-bottom: 10px;
            background: linear-gradient(135deg, #5eead4 0%, #0d9488 40%, #0f766e 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: pvpTitleGlow 3s ease-in-out infinite; }
        @keyframes pvpTitleGlow { 0%,100%{filter:drop-shadow(0 0 20px rgba(13,148,136,0.15))} 50%{filter:drop-shadow(0 0 40px rgba(13,148,136,0.35))} }
        .pvp-header p { color: #94a3b8; font-size: 1.05rem; font-weight: 500; }

        .pvp-card { background: rgba(30,41,59,0.6); -webkit-backdrop-filter: blur(20px); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.06); border-radius: 20px; padding: 36px;
            max-width: 560px; margin: 0 auto 32px; display: none;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.05);
            animation: pvpCardIn .35s ease; }
        @keyframes pvpCardIn { from { opacity:0; transform:translateY(20px) scale(0.97); } to { opacity:1; transform:translateY(0) scale(1); } }
        .pvp-card.active { display: block; }
        .pvp-card__title { display: flex; align-items: center; gap: 10px; font-size: 1.15rem; font-weight: 700;
            color: #f1f5f9; margin-bottom: 20px; }
        .pvp-card__title .icon { font-size: 1.3rem; }

        .pvp-card label { display: block; font-size: .82rem; font-weight: 600; color: #94a3b8;
            text-transform: uppercase; letter-spacing: .5px; margin-bottom: 6px; }
        .pvp-card select, .pvp-card input { width: 100%; padding: 12px 16px;
            background: rgba(15,23,42,0.6); border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px; font-size: .95rem; color: #f1f5f9; margin-bottom: 16px;
            outline: none; transition: all .2s; }
        .pvp-card select:focus, .pvp-card input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(13,148,136,0.15); }
        .pvp-card select option { background: #1e293b; color: #f1f5f9; }

        .pvp-menu-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 8px; }
        .pvp-menu-btn { display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 10px; padding: 28px 20px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06);
            background: rgba(255,255,255,0.03); cursor: pointer; transition: all .25s;
            font-weight: 600; font-size: .95rem; color: #f1f5f9; }
        .pvp-menu-btn:hover { background: rgba(13,148,136,0.1); border-color: rgba(13,148,136,0.3);
            transform: translateY(-2px); box-shadow: 0 8px 24px rgba(13,148,136,0.1); }
        .pvp-menu-btn .icon { font-size: 2.2rem; }
        .pvp-menu-btn .sub { font-size: .78rem; color: #64748b; font-weight: 400; }

        .pvp-actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .pvp-actions .btn { flex: 1; border-radius: 12px; font-weight: 600; height: 46px; }

        .room-code-box { text-align: center; padding: 24px; background: rgba(0,0,0,0.2);
            border-radius: 16px; border: 1px solid rgba(13,148,136,0.15); margin: 16px 0; }
        .room-code-label { font-size: .8rem; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 12px; }
        .room-code { font-family: 'JetBrains Mono', monospace; font-size: 3rem; font-weight: 800;
            letter-spacing: 14px; color: #5eead4; text-align: center;
            text-shadow: 0 0 30px rgba(13,148,136,0.3); }
        .room-code-copy { display: inline-flex; align-items: center; gap: 6px; margin-top: 12px;
            padding: 8px 18px; border-radius: 8px; border: none; background: rgba(13,148,136,0.1);
            color: #5eead4; font-size: .82rem; font-weight: 500; cursor: pointer; transition: all .2s; }
        .room-code-copy:hover { background: rgba(13,148,136,0.2); }

        .pvp-players { display: grid; grid-template-columns: 1fr auto 1fr; gap: 16px; align-items: center; margin: 16px 0; }
        .pvp-player-avatar { text-align: center; }
        .pvp-player-avatar__img { width: 72px; height: 72px; border-radius: 50%; object-fit: cover;
            border: 3px solid rgba(13,148,136,0.2); background: rgba(13,148,136,0.1);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.8rem; font-weight: 700; color: #5eead4; margin: 0 auto 8px; }
        .pvp-player-avatar__img img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; }
        .pvp-player-avatar__name { font-size: .82rem; font-weight: 600; color: #94a3b8; }
        .pvp-player-avatar--me .pvp-player-avatar__img { border-color: var(--teal); }
        .pvp-player-avatar--opponent .pvp-player-avatar__img { border-color: rgba(148,163,184,0.3); }
        .pvp-player-avatar--empty .pvp-player-avatar__img { border-style: dashed; opacity: .4; }
        .pvp-vs-badge { font-size: 1.2rem; font-weight: 900; color: #64748b;
            font-family: 'JetBrains Mono', monospace; letter-spacing: 2px; }

        .pvp-waiting-status { display: flex; align-items: center; justify-content: center; gap: 10px;
            padding: 14px; border-radius: 12px; background: rgba(251,191,36,0.08);
            border: 1px solid rgba(251,191,36,0.15); color: #fcd34d; font-size: .9rem; margin-top: 12px; }
        .pvp-waiting-status .spinner { width: 16px; height: 16px; border: 2px solid rgba(251,191,36,0.2);
            border-top-color: #fcd34d; border-radius: 50%; animation: spin .8s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .pvp-game-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 12px; }
        .pvp-round-badge { padding: 6px 16px; border-radius: 50px; background: rgba(13,148,136,0.1);
            border: 1px solid rgba(13,148,136,0.2); color: #5eead4; font-size: .85rem; font-weight: 600; }
        .pvp-score-display { display: flex; align-items: center; gap: 8px;
            padding: 6px 16px; border-radius: 50px; background: rgba(13,148,136,0.1);
            border: 1px solid rgba(13,148,136,0.2); color: #5eead4; font-size: .9rem; font-weight: 700; }
        .pvp-progress { width: 100%; height: 4px; background: rgba(255,255,255,0.06);
            border-radius: 4px; margin-bottom: 24px; overflow: hidden; }
        .pvp-progress__bar { height: 100%; background: linear-gradient(90deg, var(--teal), #5eead4);
            border-radius: 4px; transition: width .4s ease; width: 0%; }

        .quiz-question { text-align: center; padding: 24px; border-radius: 16px;
            background: rgba(0,0,0,0.15); border: 1px solid rgba(255,255,255,0.04); margin-bottom: 20px; }
        .quiz-question__hanzi { font-family: 'Noto Sans SC', sans-serif; font-size: 4rem;
            font-weight: 900; color: #f1f5f9; margin-bottom: 8px; line-height: 1.2; }
        .quiz-question__pinyin { font-size: 1.1rem; color: #5eead4; font-style: italic; margin-bottom: 4px; }
        .quiz-question__hint { font-size: .82rem; color: #64748b; margin-top: 8px; }

        .options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .option-btn { padding: 16px; border: 1px solid rgba(255,255,255,0.06);
            border-radius: 14px; font-size: .95rem; cursor: pointer; transition: all .2s;
            background: rgba(255,255,255,0.03); color: #f1f5f9; font-weight: 500;
            position: relative; overflow: hidden; }
        .option-btn:hover { border-color: rgba(13,148,136,0.3); background: rgba(13,148,136,0.05); }
        .option-btn:active { transform: scale(0.98); }
        .option-btn .key-hint { position: absolute; top: 8px; left: 10px; font-size: .65rem;
            color: rgba(255,255,255,0.15); font-weight: 700; font-family: 'JetBrains Mono', monospace; }
        .option-btn.selected { background: rgba(13,148,136,0.15); border-color: var(--teal);
            color: #5eead4; box-shadow: 0 0 20px rgba(13,148,136,0.1); }
        .option-btn.correct { background: rgba(16,185,129,0.15); border-color: #10b981;
            color: #6ee7b7; box-shadow: 0 0 20px rgba(16,185,129,0.1); }
        .option-btn.wrong { background: rgba(239,68,68,0.15); border-color: #ef4444;
            color: #fca5a5; animation: shake .4s ease; }
        @keyframes shake { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-6px)} 75%{transform:translateX(6px)} }

        .pvp-check-btn { width: 100%; padding: 16px; border: none; border-radius: 14px;
            font-size: 1rem; font-weight: 700; cursor: pointer; transition: all .25s;
            background: linear-gradient(135deg, var(--teal), var(--teal-dark));
            color: #fff; margin-top: 16px; box-shadow: 0 4px 16px rgba(13,148,136,0.2); }
        .pvp-check-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 24px rgba(13,148,136,0.3); }
        .pvp-check-btn:disabled { opacity: .5; cursor: not-allowed; transform: none; }

        .pvp-countdown-overlay { position: fixed; inset: 0; z-index: 99999;
            background: rgba(0,0,0,0.85); -webkit-backdrop-filter: blur(12px); backdrop-filter: blur(12px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; visibility: hidden; transition: all .3s; }
        .pvp-countdown-overlay.active { opacity: 1; visibility: visible; }
        .pvp-countdown-number { font-family: 'JetBrains Mono', monospace; font-size: 8rem;
            font-weight: 900; background: linear-gradient(135deg, #5eead4, var(--teal));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: countPulse .8s ease; }
        @keyframes countPulse { 0%{transform:scale(2);opacity:0} 50%{transform:scale(1);opacity:1} 100%{transform:scale(0.95);opacity:0.8} }
        .pvp-countdown-label { text-align: center; color: #94a3b8; font-size: 1rem;
            text-transform: uppercase; letter-spacing: 4px; margin-top: 8px; }

        .pvp-result { text-align: center; }
        .pvp-result__title { font-size: 1.3rem; font-weight: 700; color: #f1f5f9; margin-bottom: 24px; }
        .pvp-result__battle { display: grid; grid-template-columns: 1fr auto 1fr; gap: 20px;
            align-items: center; margin-bottom: 24px; }
        .pvp-player-card { padding: 20px; border-radius: 16px;
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); }
        .pvp-player-card--winner { background: rgba(13,148,136,0.08); border-color: rgba(13,148,136,0.2); }
        .pvp-player-card__name { font-weight: 600; color: #94a3b8; font-size: .85rem; margin-bottom: 8px; }
        .pvp-player-card__score { font-family: 'JetBrains Mono', monospace; font-size: 2.5rem;
            font-weight: 900; color: #f1f5f9; }
        .pvp-player-card__score .num { font-size: 3rem; }
        .pvp-player-card__score .sep { color: #64748b; font-size: 1.5rem; margin: 0 4px; }
        .pvp-player-card__bar { width: 100%; height: 4px; background: rgba(255,255,255,0.06);
            border-radius: 4px; margin-top: 10px; overflow: hidden; }
        .pvp-player-card__bar-fill { height: 100%; border-radius: 4px; transition: width 1s ease;
            background: linear-gradient(90deg, var(--teal), #5eead4); width: 0%; }
        .pvp-player-card--winner .pvp-player-card__bar-fill { background: linear-gradient(90deg, #fbbf24, #f59e0b); }

        .pvp-winner-banner { padding: 16px 24px; border-radius: 14px; font-weight: 700; font-size: 1.1rem;
            margin-bottom: 20px; background: linear-gradient(135deg, rgba(13,148,136,0.12), rgba(15,118,110,0.08));
            border: 1px solid rgba(13,148,136,0.2); color: #5eead4; }
        .pvp-winner-banner--lose { background: linear-gradient(135deg, rgba(148,163,184,0.1), rgba(100,116,139,0.05));
            border-color: rgba(148,163,184,0.15); color: #94a3b8; }
        .pvp-winner-banner--tie { background: linear-gradient(135deg, rgba(251,191,36,0.1), rgba(245,158,11,0.05));
            border-color: rgba(251,191,36,0.15); color: #fcd34d; }

        .pvp-result-actions { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .pvp-result-actions .btn { border-radius: 12px; font-weight: 600; min-width: 140px; }

        @media(max-width:600px) {
            .pvp-header h1 { font-size: 2rem; }
            .pvp-menu-grid { grid-template-columns: 1fr; }
            .options-grid { grid-template-columns: 1fr; }
            .pvp-result__battle { grid-template-columns: 1fr; gap: 12px; }
            .pvp-vs-badge { display: none; }
            .room-code { font-size: 2rem; letter-spacing: 8px; }
            .pvp-card { padding: 24px; }
            .pvp-countdown-number { font-size: 5rem; }
            .pvp-players { grid-template-columns: 1fr; gap: 8px; }
            .pvp-players .pvp-vs-badge { display: none; }
        }

        [data-theme="light"] .pvp-page { background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 30%, #f0fdfa 70%, #f0fdfa 100%); }
        [data-theme="light"] .pvp-page::before {
            background: radial-gradient(ellipse at 30% 20%, rgba(13,148,136,0.06) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(13,148,136,0.04) 0%, transparent 50%); }
        [data-theme="light"] .pvp-grid { opacity: 0.05; }
        [data-theme="light"] .pvp-card { background: rgba(255,255,255,0.7); border-color: rgba(13,148,136,0.1);
            box-shadow: 0 8px 32px rgba(13,148,136,0.08); }
        [data-theme="light"] .pvp-card__title { color: #1e293b; }
        [data-theme="light"] .pvp-card label { color: #64748b; }
        [data-theme="light"] .pvp-card select, [data-theme="light"] .pvp-card input { background: #fff; border-color: #e2e8f0; color: #1e293b; }
        [data-theme="light"] .pvp-card select:focus, [data-theme="light"] .pvp-card input:focus { border-color: var(--teal); }
        [data-theme="light"] .pvp-menu-btn { background: #fff; border-color: #e2e8f0; color: #1e293b; }
        [data-theme="light"] .pvp-menu-btn:hover { background: #f0fdfa; border-color: var(--teal); }
        [data-theme="light"] .pvp-menu-btn .sub { color: #94a3b8; }
        [data-theme="light"] .room-code-box { background: #fff; border-color: rgba(13,148,136,0.15); }
        [data-theme="light"] .room-code { color: #0d9488; }
        [data-theme="light"] .quiz-question { background: #fff; border-color: #e2e8f0; }
        [data-theme="light"] .quiz-question__hanzi { color: #1e293b; }
        [data-theme="light"] .quiz-question__pinyin { color: #0d9488; }
        [data-theme="light"] .option-btn { background: #fff; border-color: #e2e8f0; color: #1e293b; }
        [data-theme="light"] .option-btn:hover { border-color: var(--teal); }
        [data-theme="light"] .option-btn .key-hint { color: rgba(0,0,0,0.1); }
        [data-theme="light"] .option-btn.selected { background: #f0fdfa; border-color: var(--teal); color: #0d9488; }
        [data-theme="light"] .pvp-player-card { background: #fff; border-color: #e2e8f0; }
        [data-theme="light"] .pvp-player-card__name { color: #64748b; }
        [data-theme="light"] .pvp-player-card__score { color: #1e293b; }
        [data-theme="light"] .pvp-waiting-status { background: rgba(245,158,11,0.08); border-color: rgba(245,158,11,0.2); color: #d97706; }
        [data-theme="light"] .pvp-score-display { background: rgba(13,148,136,0.08); border-color: rgba(13,148,136,0.2); color: #0d9488; }
        [data-theme="light"] .pvp-round-badge { background: rgba(13,148,136,0.08); border-color: rgba(13,148,136,0.15); color: #0d9488; }
        [data-theme="light"] .pvp-player-avatar__img { background: #f0fdfa; }
        [data-theme="light"] .pvp-winner-banner { color: #0d9488; }
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="pvp-page">
    <div class="pvp-grid"></div>
    <div class="container">
        <div class="pvp-header">
            <div class="pvp-header__badge">⚔ PvP Arena</div>
            <h1>Đấu trường Hán Ngữ</h1>
            <p>Thách đấu bạn bè — ai mới là cao thủ?</p>
        </div>

        <div class="pvp-card active" id="step-menu">
            <div class="pvp-card__title"><span class="icon">🎮</span> Chọn chế độ</div>
            <div class="pvp-menu-grid">
                <div class="pvp-menu-btn" onclick="showCreate()">
                    <span class="icon">🏠</span>
                    <span>Tạo phòng mới</span>
                    <span class="sub">Tạo phòng và mời bạn bè</span>
                </div>
                <div class="pvp-menu-btn" onclick="showJoin()">
                    <span class="icon">🔑</span>
                    <span>Nhập mã phòng</span>
                    <span class="sub">Tham gia phòng có sẵn</span>
                </div>
            </div>
        </div>

        <div class="pvp-card" id="step-create">
            <div class="pvp-card__title"><span class="icon">⚙️</span> Tạo phòng thi đấu</div>
            <label>Cấp độ</label>
            <select id="create-level">
                <option value="1">HSK 1</option>
                <option value="2">HSK 2</option>
                <option value="3">HSK 3</option>
                <option value="4">HSK 4</option>
                <option value="5">HSK 5</option>
                <option value="6">HSK 6</option>
                <option value="0">Tất cả</option>
            </select>
            <label>Loại câu hỏi</label>
            <select id="create-type">
                <option value="choice">Trắc nghiệm (Hán Việt → Nghĩa)</option>
            </select>
            <label>Số câu</label>
            <select id="create-count">
                <option value="5">5 câu</option>
                <option value="10" selected>10 câu</option>
                <option value="15">15 câu</option>
                <option value="20">20 câu</option>
            </select>
            <div class="pvp-actions">
                <button class="btn btn--outline ripple" onclick="backMenu()">← Quay lại</button>
                <button class="btn btn--primary ripple" onclick="createRoom()">⚡ Tạo phòng</button>
            </div>
        </div>

        <div class="pvp-card" id="step-join">
            <div class="pvp-card__title"><span class="icon">🔑</span> Nhập mã phòng</div>
            <p style="color:#64748b;font-size:.85rem;margin-bottom:16px;">Nhập mã 6 ký tự từ bạn bè của bạn</p>
            <input type="text" id="join-code" placeholder="●●●●●●" maxlength="6"
                style="text-transform:uppercase;text-align:center;font-size:2rem;letter-spacing:12px;font-weight:800;font-family:'JetBrains Mono',monospace;">
            <div class="pvp-actions">
                <button class="btn btn--outline ripple" onclick="backMenu()">← Quay lại</button>
                <button class="btn btn--primary ripple" onclick="joinRoom()">🚀 Vào phòng</button>
            </div>
        </div>

        <div class="pvp-card" id="step-waiting">
            <div class="pvp-card__title"><span class="icon">⏳</span> Phòng chờ</div>
            <div class="room-code-box">
                <div class="room-code-label">Mã phòng</div>
                <div class="room-code" id="room-code-display">------</div>
                <button class="room-code-copy" onclick="copyRoomCode()">📋 Sao chép mã</button>
            </div>

            <div class="pvp-players" id="pvp-players-area">
                <div class="pvp-player-avatar pvp-player-avatar--me" id="player1-avatar-box">
                    <div class="pvp-player-avatar__img" id="player1-avatar"></div>
                    <div class="pvp-player-avatar__name" id="player1-name">Bạn</div>
                </div>
                <div class="pvp-vs-badge">VS</div>
                <div class="pvp-player-avatar pvp-player-avatar--empty" id="player2-avatar-box">
                    <div class="pvp-player-avatar__img" id="player2-avatar">?</div>
                    <div class="pvp-player-avatar__name" id="player2-name">Đang chờ...</div>
                </div>
            </div>

            <div class="pvp-waiting-status" id="waiting-status">
                <div class="spinner"></div>
                <span>Đang chờ người chơi tham gia...</span>
            </div>

            <div style="display:flex;gap:10px;margin-top:20px;justify-content:center;">
                <button class="btn btn--outline ripple" onclick="cancelRoom()" id="btn-cancel-room">Huỷ phòng</button>
                <button class="btn btn--primary ripple" onclick="startCountdown()" id="btn-start-game" style="display:none;">⚔ Bắt đầu</button>
            </div>
        </div>

        <div class="pvp-card" id="step-game">
            <div class="pvp-game-top">
                <span class="pvp-round-badge" id="pvp-round">1/10</span>
                <span class="pvp-score-display">⭐ <span id="pvp-score">0</span></span>
            </div>
            <div class="pvp-progress"><div class="pvp-progress__bar" id="pvp-progress-bar"></div></div>
            <div id="pvp-question-area"></div>
            <button class="pvp-check-btn" id="pvp-check-btn" onclick="checkPvPAnswer()">✓ Kiểm tra</button>
        </div>

        <div class="pvp-card" id="step-result">
            <div class="pvp-result">
                <div class="pvp-result__title">🏆 Kết quả trận đấu</div>
                <div class="pvp-result__battle">
                    <div class="pvp-player-card" id="result-p1">
                        <div class="pvp-player-card__name" id="r-p1-name">Bạn</div>
                        <div class="pvp-player-card__score">
                            <span class="num" id="r-p1-score">0</span>
                            <span class="sep">/</span>
                            <span id="r-p1-total">0</span>
                        </div>
                        <div class="pvp-player-card__bar"><div class="pvp-player-card__bar-fill" id="r-p1-bar"></div></div>
                    </div>
                    <div class="pvp-vs-badge">VS</div>
                    <div class="pvp-player-card" id="result-p2">
                        <div class="pvp-player-card__name" id="r-p2-name">Đối thủ</div>
                        <div class="pvp-player-card__score">
                            <span class="num" id="r-p2-score">0</span>
                            <span class="sep">/</span>
                            <span id="r-p2-total">0</span>
                        </div>
                        <div class="pvp-player-card__bar"><div class="pvp-player-card__bar-fill" id="r-p2-bar"></div></div>
                    </div>
                </div>
                <div class="pvp-winner-banner" id="result-winner">🎉 Bạn thắng!</div>
                <div class="pvp-result-actions">
                    <a href="pvp.php" class="btn btn--primary ripple">⚔ Đấu tiếp</a>
                    <a href="leaderboard.php" class="btn btn--outline ripple">🏆 Bảng xếp hạng</a>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="pvp-countdown-overlay" id="countdown-overlay">
    <div style="text-align:center;">
        <div class="pvp-countdown-number" id="countdown-number">3</div>
        <div class="pvp-countdown-label">Chuẩn bị</div>
    </div>
</div>

<script>
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
const USER_NAME = localStorage.getItem('hanngu_display_name') || localStorage.getItem('hanngu_username') || USER_ID;
const USER_AVATAR = localStorage.getItem('hanngu_avatar') || '';

let roomCode = '';
let roomId = null;
let isCreator = false;
let vocabList = [];
let currentQ = 0;
let score = 0;
let totalQ = 10;
let answerState = null;
let questionIndices = [];
let waitingInterval = null;
let opponentName = '';

async function fetchAPI(action, data, method = 'GET') {
    try {
        let url = `${API_URL}?action=${action}`;
        const opts = { method, headers: { 'Content-Type': 'application/json' } };
        if (method === 'GET' && data) url += '&' + new URLSearchParams(data).toString();
        else if (data) opts.body = JSON.stringify(data);
        return await (await fetch(url, opts)).json();
    } catch (e) { return null; }
}

function show(el) {
    document.querySelectorAll('.pvp-card').forEach(b => b.classList.remove('active'));
    const target = document.getElementById(el);
    target.classList.add('active');
    target.style.animation = 'none';
    target.offsetHeight;
    target.style.animation = 'pvpCardIn .35s ease';
}
function backMenu() { stopWaiting(); show('step-menu'); }

function showCreate() { show('step-create'); }
function showJoin() { show('step-join'); }

function stopWaiting() {
    if (waitingInterval) { clearInterval(waitingInterval); waitingInterval = null; }
}

function setAvatar(el, avatarUrl, name) {
    if (avatarUrl) {
        el.innerHTML = '<img src="' + avatarUrl + '" alt="">';
    } else {
        el.textContent = name ? name.charAt(0).toUpperCase() : '?';
    }
}

function copyRoomCode() {
    if (!roomCode) return;
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(roomCode).then(() => {
            showToast('📋 Đã sao chép mã: ' + roomCode, 'success');
        }).catch(() => fallbackCopy());
    } else { fallbackCopy(); }
    function fallbackCopy() {
        const ta = document.createElement('textarea');
        ta.value = roomCode; ta.style.position = 'fixed'; ta.style.opacity = '0';
        document.body.appendChild(ta); ta.select();
        document.execCommand('copy'); document.body.removeChild(ta);
        showToast('📋 Đã sao chép mã: ' + roomCode, 'success');
    }
}

async function createRoom() {
    const level = document.getElementById('create-level').value;
    const count = document.getElementById('create-count').value;
    const r = await fetchAPI('create_room', {
        user_id: USER_ID, user_name: USER_NAME,
        level: parseInt(level), quiz_type: 'choice', total_questions: parseInt(count)
    }, 'POST');
    if (r && r.success) {
        roomCode = r.room_code;
        roomId = r.room_id;
        isCreator = true;
        totalQ = parseInt(count);
        document.getElementById('room-code-display').textContent = roomCode;
        setAvatar(document.getElementById('player1-avatar'), USER_AVATAR, USER_NAME);
        document.getElementById('player1-name').textContent = USER_NAME;
        show('step-waiting');
        showToast('⚔ Đã tạo phòng! Mã: ' + roomCode, 'success');
        await loadVocab(parseInt(level));
        startWaitingForOpponent();
    } else {
        showToast('❌ ' + (r?.message || 'Lỗi tạo phòng'), 'error');
    }
}

async function fetchOpponentAvatar(opponentId) {
    if (!opponentId || opponentId === 'default_user') return;
    const r = await fetchAPI('get_user_info', { user_id: opponentId });
    if (r && r.success && r.user) {
        const box = document.getElementById('player2-avatar-box');
        box.className = 'pvp-player-avatar pvp-player-avatar--opponent';
        setAvatar(document.getElementById('player2-avatar'), r.user.avatar, r.user.display_name || r.user.username);
        document.getElementById('player2-name').textContent = r.user.display_name || r.user.username;
        opponentName = r.user.display_name || r.user.username;
    }
}

function startWaitingForOpponent() {
    stopWaiting();
    waitingInterval = setInterval(async () => {
        const r = await fetchAPI('get_room', { room_code: roomCode, user_id: USER_ID });
        if (r && r.room) {
            if (r.room.player2_id && r.room.player2_name) {
                stopWaiting();
                opponentName = r.room.player2_name;
                fetchOpponentAvatar(r.room.player2_id);
                document.getElementById('waiting-status').innerHTML = '✅ ' + esc(opponentName) + ' đã tham gia!';
                document.getElementById('waiting-status').className = 'pvp-waiting-status';
                document.getElementById('waiting-status').style.borderColor = 'rgba(13,148,136,0.2)';
                document.getElementById('waiting-status').style.background = 'rgba(13,148,136,0.08)';
                document.getElementById('waiting-status').style.color = '#5eead4';
                showToast('🎮 ' + opponentName + ' đã vào phòng!', 'success');
                document.getElementById('btn-start-game').style.display = 'inline-flex';
                document.getElementById('btn-start-game').onclick = startGameAsCreator;
            }
        }
    }, 1500);
}

async function startGameAsCreator() {
    const r = await fetchAPI('start_room', { room_code: roomCode, user_id: USER_ID }, 'POST');
    if (r && r.success) {
        startCountdown();
    } else {
        showToast('❌ ' + (r?.message || 'Không thể bắt đầu'), 'error');
    }
}

function waitForGameStart() {
    waitingInterval = setInterval(async () => {
        const r = await fetchAPI('get_room', { room_code: roomCode, user_id: USER_ID });
        if (r && r.room && r.room.status === 'playing') {
            stopWaiting();
            startCountdown();
        }
    }, 1500);
}

async function joinRoom() {
    const code = document.getElementById('join-code').value.trim().toUpperCase();
    if (code.length < 4) { showToast('⚠ Nhập mã phòng!', 'warning'); return; }
    const r = await fetchAPI('join_room', {
        room_code: code, user_id: USER_ID, user_name: USER_NAME
    }, 'POST');
    if (r && r.success) {
        roomCode = code;
        roomId = r.room.id;
        isCreator = false;
        totalQ = r.room.total_questions;
        opponentName = r.room.player1_name || 'Đối thủ';
        showToast('🎮 Đã vào phòng!', 'success');
        await loadVocab(r.room.level);
        show('step-waiting');
        document.getElementById('room-code-display').textContent = roomCode;
        setAvatar(document.getElementById('player1-avatar'), USER_AVATAR, USER_NAME);
        document.getElementById('player1-name').textContent = USER_NAME;
        document.getElementById('player2-name').textContent = opponentName;
        fetchOpponentAvatar(r.room.player1_id);
        document.getElementById('btn-start-game').style.display = 'none';
        document.getElementById('btn-cancel-room').style.display = 'none';
        document.getElementById('waiting-status').innerHTML = '⏳ Đang chờ chủ phòng bắt đầu...';
        waitForGameStart();
    } else {
        showToast('❌ ' + (r?.message || 'Không vào được phòng'), 'error');
    }
}

async function loadVocab(level) {
    document.getElementById('pvp-question-area').innerHTML = '<div style="text-align:center;padding:20px;color:#64748b;">⏳ Đang tải dữ liệu...</div>';
    const data = await fetchAPI('get_vocab', { level });
    if (data && data.length > 0) {
        vocabList = level > 0 ? data.filter(v => v.level == level) : data;
    }
    if (vocabList.length < 4) {
        vocabList = [
            { hanzi: '你好', pinyin: 'nǐ hǎo', meaning: 'Xin chào' },
            { hanzi: '谢谢', pinyin: 'xièxie', meaning: 'Cảm ơn' },
            { hanzi: '再见', pinyin: 'zàijiàn', meaning: 'Tạm biệt' },
            { hanzi: '对不起', pinyin: 'duìbuqǐ', meaning: 'Xin lỗi' },
            { hanzi: '没关系', pinyin: 'méiguānxi', meaning: 'Không sao' },
            { hanzi: '你好吗', pinyin: 'nǐ hǎo ma', meaning: 'Bạn khoẻ không' },
        ];
    }
}

function startCountdown() {
    const overlay = document.getElementById('countdown-overlay');
    const numEl = document.getElementById('countdown-number');
    const labelEl = document.querySelector('.pvp-countdown-label');
    let count = 3;
    overlay.classList.add('active');
    numEl.textContent = count;
    numEl.style.fontSize = '';
    labelEl.textContent = 'Chuẩn bị';

    const interval = setInterval(() => {
        count--;
        if (count > 0) {
            numEl.textContent = count;
            numEl.style.animation = 'none';
            numEl.offsetHeight;
            numEl.style.animation = 'countPulse .8s ease';
            if (count === 1) labelEl.textContent = 'Chiến đấu!';
        } else if (count === 0) {
            numEl.textContent = 'GO!';
            numEl.style.fontSize = '6rem';
            numEl.style.animation = 'none';
            numEl.offsetHeight;
            numEl.style.animation = 'countPulse .8s ease';
            labelEl.textContent = '⚔';
        } else {
            clearInterval(interval);
            overlay.classList.remove('active');
            currentQ = 0; score = 0;
            show('step-game');
            renderPvPQuestion();
        }
    }, 900);
}

async function cancelRoom() {
    stopWaiting();
    show('step-menu');
}

function shuffleArray(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
}

function renderPvPQuestion() {
    if (currentQ >= totalQ || !vocabList.length) {
        submitPvPResult();
        return;
    }

    if (questionIndices.length === 0) {
        questionIndices = shuffleArray([...Array(vocabList.length).keys()]);
    }
    const idx = questionIndices.pop();
    const v = vocabList[idx];

    document.getElementById('pvp-round').textContent = `${currentQ + 1}/${totalQ}`;
    document.getElementById('pvp-score').textContent = score;
    document.getElementById('pvp-progress-bar').style.width = `${(currentQ / totalQ) * 100}%`;

    const area = document.getElementById('pvp-question-area');
    answerState = { vocab: v, answered: false, selected: null };

    const seen = new Set([v.meaning]);
    const opts = [v.meaning];
    const shuffled = shuffleArray([...vocabList]);
    for (const w of shuffled) {
        if (opts.length >= 4) break;
        if (!seen.has(w.meaning)) { opts.push(w.meaning); seen.add(w.meaning); }
    }
    shuffleArray(opts);

    const keyLabels = ['1', '2', '3', '4'];
    area.innerHTML = `
        <div class="quiz-question">
            <div class="quiz-question__hanzi">${esc(v.hanzi)}</div>
            <div class="quiz-question__pinyin">${esc(v.pinyin)}</div>
            <div class="quiz-question__hint">Chọn nghĩa đúng</div>
        </div>
        <div class="options-grid">
            ${opts.map((o, i) => `
                <button class="option-btn" onclick="selectPvPOption(this, '${esc(o)}')" data-key="${i}">
                    <span class="key-hint">${keyLabels[i]}</span>
                    ${esc(o)}
                </button>
            `).join('')}
        </div>
    `;

    document.getElementById('pvp-check-btn').textContent = '✓ Kiểm tra';
    document.getElementById('pvp-check-btn').disabled = true;
}

function selectPvPOption(btn, value) {
    if (answerState.answered) return;
    document.querySelectorAll('.option-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    answerState.selected = value;
    document.getElementById('pvp-check-btn').disabled = false;
}

function checkPvPAnswer() {
    if (answerState.answered) return;
    const v = answerState.vocab;
    const correct = answerState.selected === v.meaning;
    if (correct) score++;

    document.querySelectorAll('.option-btn').forEach(b => {
        if (b.textContent.trim() === v.meaning) b.classList.add('correct');
        else if (b.classList.contains('selected') && !correct) b.classList.add('wrong');
    });

    answerState.answered = true;
    document.getElementById('pvp-check-btn').textContent = correct ? '✅ Đúng! Tiếp →' : '❌ Tiếp →';
    document.getElementById('pvp-score').textContent = score;
    document.getElementById('pvp-check-btn').disabled = false;

    setTimeout(() => { currentQ++; renderPvPQuestion(); }, correct ? 800 : 1400);
}

async function submitPvPResult() {
    document.getElementById('pvp-progress-bar').style.width = '100%';
    const r = await fetchAPI('submit_pvp_score', { room_code: roomCode, user_id: USER_ID, score, total: totalQ }, 'POST');
    if (r && r.success && r.winner === null) {
        show('step-waiting');
        document.getElementById('room-code-display').textContent = roomCode;
        document.getElementById('waiting-status').innerHTML = '⏳ Đã hoàn thành! Đang chờ đối thủ...';
        showToast('⏳ Đã nộp bài! Chờ đối thủ...', 'info');
        document.querySelector('#step-waiting .btn--outline').textContent = 'Đang chờ...';
        document.querySelector('#step-waiting .btn--outline').disabled = true;
        waitForResult();
    } else {
        showPvPResult(r);
    }
}

async function waitForResult() {
    const interval = setInterval(async () => {
        const r = await fetchAPI('get_room', { room_code: roomCode, user_id: USER_ID });
        if (r && r.room && r.room.status === 'finished') {
            clearInterval(interval);
            showPvPResult(r.room);
        }
    }, 2000);
}

function showPvPResult(data) {
    show('step-result');
    const room = data.room || data;

    const p1s = parseInt(room.player1_score) || 0;
    const p1t = parseInt(room.player1_total) || totalQ;
    const p2s = parseInt(room.player2_score) || 0;
    const p2t = parseInt(room.player2_total) || totalQ;
    const p1n = room.player1_name || 'Bạn';
    const p2n = room.player2_name || 'Đối thủ';
    const myId = room.player1_id === USER_ID ? '1' : '2';
    const myScore = myId === '1' ? p1s : p2s;
    const myTotal = myId === '1' ? p1t : p2t;
    const opScore = myId === '1' ? p2s : p1s;
    const opTotal = myId === '1' ? p2t : p1t;
    const opName = myId === '1' ? p2n : p1n;
    const myPct = myTotal > 0 ? (myScore / myTotal * 100) : 0;
    const opPct = opTotal > 0 ? (opScore / opTotal * 100) : 0;

    document.getElementById('r-p1-name').textContent = 'Bạn (' + (myId === '1' ? p1n : p2n) + ')';
    document.getElementById('r-p1-score').textContent = myScore;
    document.getElementById('r-p1-total').textContent = myTotal;
    document.getElementById('r-p2-name').textContent = opName;
    document.getElementById('r-p2-score').textContent = opScore;
    document.getElementById('r-p2-total').textContent = opTotal;

    const winnerEl = document.getElementById('result-winner');
    const p1Card = document.getElementById('result-p1');
    const p2Card = document.getElementById('result-p2');
    p1Card.classList.remove('pvp-player-card--winner');
    p2Card.classList.remove('pvp-player-card--winner');
    winnerEl.className = 'pvp-winner-banner';

    if (data.winner === 'Hòa' || myPct === opPct) {
        winnerEl.textContent = '🤝 Hoà nhau! Cả hai đều giỏi!';
        winnerEl.classList.add('pvp-winner-banner--tie');
    } else if (myPct > opPct) {
        winnerEl.textContent = '🎉 Bạn đã thắng! Xuất sắc!';
        p1Card.classList.add('pvp-player-card--winner');
    } else {
        winnerEl.textContent = '😤 Đối thủ thắng! Hãy cố gắng lần sau!';
        p2Card.classList.add('pvp-player-card--winner');
        winnerEl.classList.add('pvp-winner-banner--lose');
    }

    setTimeout(() => {
        document.getElementById('r-p1-bar').style.width = myPct + '%';
        document.getElementById('r-p2-bar').style.width = opPct + '%';
    }, 300);

    showToast('📊 ' + winnerEl.textContent, 'info');
}

document.addEventListener('keydown', function(e) {
    const gameCard = document.getElementById('step-game');
    if (!gameCard.classList.contains('active')) return;
    if (e.key >= '1' && e.key <= '4') {
        const btns = document.querySelectorAll('.option-btn');
        const idx = parseInt(e.key) - 1;
        if (btns[idx] && !answerState.answered) btns[idx].click();
    }
    if (e.key === 'Enter') {
        const checkBtn = document.getElementById('pvp-check-btn');
        if (!checkBtn.disabled) checkBtn.click();
    }
});

document.getElementById('join-code').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') joinRoom();
});

document.addEventListener('click', function(e) {
    document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
});

function esc(s) { const d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
</script>
</body>
</html>