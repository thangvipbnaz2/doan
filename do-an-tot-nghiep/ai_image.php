<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhận diện hình ảnh - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .ai-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(135deg,#f0f4ff 0%,#fdf2f8 50%,#fef2f2 100%);position:relative;overflow:hidden}
        .ai-page::before{content:'';position:absolute;top:-50%;right:-20%;width:600px;height:600px;background:radial-gradient(circle,rgba(99,102,241,.08) 0%,transparent 70%);pointer-events:none}
        .ai-page::after{content:'';position:absolute;bottom:-30%;left:-10%;width:500px;height:500px;background:radial-gradient(circle,rgba(236,72,153,.06) 0%,transparent 70%);pointer-events:none}
        .ai-hero{text-align:center;margin-bottom:40px;position:relative;z-index:1}
        .ai-hero__icon{display:inline-flex;width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,#6366f1,#a855f7);align-items:center;justify-content:center;margin-bottom:16px;box-shadow:0 8px 32px rgba(99,102,241,.3);position:relative}
        .ai-hero__icon svg{width:36px;height:36px;fill:none;stroke:#fff;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .ai-hero__icon::after{content:'';position:absolute;inset:-3px;border-radius:23px;border:2px solid rgba(99,102,241,.2);animation:pulse-ring 2s ease-in-out infinite}
        @keyframes pulse-ring{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0;transform:scale(1.12)}}
        .ai-hero h1{font-size:2rem;font-weight:900;color:#1e293b;margin-bottom:8px;letter-spacing:-.5px}
        .ai-hero h1 span{background:linear-gradient(135deg,#6366f1,#a855f7,#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .ai-hero p{font-size:.95rem;color:#64748b;max-width:480px;margin:0 auto;line-height:1.6}
        .ai-grid{display:grid;grid-template-columns:1fr 1fr;gap:32px;align-items:start;position:relative;z-index:1}
        @media(max-width:960px){.ai-grid{grid-template-columns:1fr;max-width:560px;margin:0 auto}}
        .ai-card{background:rgba(255,255,255,.85);backdrop-filter:blur(12px);border-radius:20px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.04),0 8px 32px rgba(0,0,0,.06);border:1px solid rgba(255,255,255,.7);transition:transform .2s,box-shadow .2s}
        .ai-card:hover{box-shadow:0 1px 3px rgba(0,0,0,.04),0 12px 48px rgba(0,0,0,.1)}
        .ai-card__header{display:flex;align-items:center;gap:12px;margin-bottom:20px}
        .ai-card__header .card-icon{width:40px;height:40px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .ai-card__header .card-icon svg{width:20px;height:20px;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .ai-card__title{font-size:1.05rem;font-weight:700;color:#1e293b}
        .ai-card__sub{font-size:.78rem;color:#94a3b8;font-weight:500;margin-top:1px}

        .upload-zone{position:relative;border:2.5px dashed #cbd5e1;border-radius:16px;padding:48px 24px;text-align:center;cursor:pointer;transition:all .3s;background:linear-gradient(135deg,#f8fafc,#fff)}
        .upload-zone:hover,.upload-zone--active{border-color:#6366f1;background:linear-gradient(135deg,#eef2ff,#f5f3ff)}
        .upload-zone--active{transform:scale(1.01)}
        .upload-zone__graphic{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,#eef2ff,#f5f3ff);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;transition:all .3s}
        .upload-zone:hover .upload-zone__graphic{background:linear-gradient(135deg,#6366f1,#a855f7);transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,.25)}
        .upload-zone__graphic svg{width:28px;height:28px;fill:none;stroke:#6366f1;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;transition:stroke .3s}
        .upload-zone:hover .upload-zone__graphic svg{stroke:#fff}
        .upload-zone__text{font-size:1rem;font-weight:600;color:#1e293b;margin-bottom:4px}
        .upload-zone__hint{font-size:.82rem;color:#94a3b8}
        .upload-zone input{display:none}

        .preview-card{display:none}
        .preview-frame{position:relative;border-radius:14px;overflow:hidden;margin-bottom:16px;background:#f8fafc;box-shadow:0 2px 12px rgba(0,0,0,.06)}
        .preview-frame img{display:block;width:100%;max-height:320px;object-fit:contain}
        .preview-actions{display:flex;gap:8px;flex-wrap:wrap}
        .preview-actions .btn{flex:1;justify-content:center;padding:12px;font-size:.88rem;font-weight:600;border-radius:12px}
        .scan-btn{background:linear-gradient(135deg,#6366f1,#a855f7);color:#fff;border:none;cursor:pointer;transition:all .25s;font-family:inherit;position:relative;overflow:hidden;border-radius:12px}
        .scan-btn:hover{transform:translateY(-1px);box-shadow:0 8px 24px rgba(99,102,241,.3)}
        .scan-btn:disabled{opacity:.5;cursor:not-allowed;transform:none;box-shadow:none}
        .scan-btn .btn-icon{display:inline-flex;align-items:center;gap:6px}
        .scan-btn .btn-icon svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}
        .change-btn{background:#fff;border:1.5px solid #e2e8f0;color:#64748b;cursor:pointer;transition:all .2s;font-family:inherit}
        .change-btn:hover{background:#f8fafc;border-color:#cbd5e1;color:#334155}

        .result-placeholder{text-align:center;padding:48px 20px;color:#94a3b8}
        .result-placeholder__graphic{width:72px;height:72px;border-radius:20px;background:linear-gradient(135deg,#f1f5f9,#f8fafc);display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
        .result-placeholder__graphic svg{width:32px;height:32px;fill:none;stroke:#94a3b8;stroke-width:1.5;stroke-linecap:round;stroke-linejoin:round}
        .result-placeholder h3{font-size:1rem;font-weight:600;color:#64748b;margin-bottom:6px}
        .result-placeholder p{font-size:.85rem;color:#94a3b8;max-width:300px;margin:0 auto}
        .result-success{border-radius:12px;padding:12px 18px;margin-bottom:20px;display:flex;align-items:center;gap:10px;font-size:.85rem;font-weight:600}
        .result-success svg{width:18px;height:18px;flex-shrink:0}
        .result-chip{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:8px;font-size:.75rem;font-weight:600}
        .result-item{margin-bottom:16px;padding:20px;border-radius:16px;background:linear-gradient(135deg,#f8fafc,#fff);border:1px solid #f1f5f9;transition:all .2s;position:relative;overflow:hidden}
        .result-item:hover{border-color:#e2e8f0;box-shadow:0 4px 16px rgba(0,0,0,.04)}
        .result-item::before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;background:linear-gradient(180deg,#6366f1,#a855f7);border-radius:0 4px 4px 0}
        .result-item__object{font-size:.78rem;color:#6366f1;font-weight:600;margin-bottom:8px;display:flex;align-items:center;gap:6px}
        .result-item__object svg{width:14px;height:14px;fill:none;stroke:currentColor;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round}
        .result-item__main{display:flex;align-items:center;gap:16px}
        .result-item__char{flex-shrink:0;width:60px;height:60px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#eef2ff,#f5f3ff);border-radius:14px;font-family:'Noto Sans SC',sans-serif;font-size:1.8rem;font-weight:900;color:#4338ca;box-shadow:0 2px 8px rgba(99,102,241,.12)}
        .result-item__info{flex:1;min-width:0}
        .result-item__pinyin{font-size:.85rem;color:#6366f1;font-weight:600;font-style:italic}
        .result-item__meaning{font-size:.9rem;color:#475569;margin-top:2px;line-height:1.4}
        .result-item__confidence{font-size:.75rem;color:#94a3b8;margin-top:2px}
        .result-item__actions{display:flex;gap:6px;margin-top:12px;flex-wrap:wrap}
        .result-item__actions button{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:8px;font-size:.78rem;font-weight:600;border:none;cursor:pointer;transition:all .2s;font-family:inherit}
        .result-item__actions .speak-btn{background:#eef2ff;color:#6366f1}
        .result-item__actions .speak-btn:hover{background:#6366f1;color:#fff}
        .result-item__actions .save-btn{background:var(--teal-light);color:var(--teal-dark)}
        .result-item__actions .save-btn:hover{background:var(--teal-dark);color:#fff}
        .hist-section{margin-top:32px}
        .hist-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
        .hist-header h3{font-size:1rem;font-weight:700;color:#1e293b;display:flex;align-items:center;gap:8px}
        .hist-header h3 svg{width:18px;height:18px;fill:none;stroke:#6366f1;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .hist-count{font-size:.78rem;color:#94a3b8;font-weight:500}
        .hist-list{display:flex;flex-direction:column;gap:8px}
        .hist-item{display:flex;align-items:center;gap:14px;padding:14px 16px;background:#fff;border-radius:14px;border:1px solid #f1f5f9;cursor:pointer;transition:all .2s}
        .hist-item:hover{background:#f8fafc;border-color:#e2e8f0;box-shadow:0 2px 8px rgba(0,0,0,.04)}
        .hist-item__thumb{width:48px;height:48px;border-radius:10px;object-fit:cover;background:#f1f5f9;flex-shrink:0;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:1.2rem}
        .hist-item__info{flex:1;min-width:0}
        .hist-item__label{font-size:.85rem;font-weight:600;color:#1e293b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .hist-item__date{font-size:.75rem;color:#94a3b8;margin-top:1px}
        .hist-item__del{width:32px;height:32px;border-radius:8px;border:none;background:transparent;color:#cbd5e1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
        .hist-item__del:hover{background:var(--coral-light);color:var(--coral)}
        .hist-item__del svg{width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
        .hist-toggle{display:flex;align-items:center;justify-content:center;gap:6px;width:100%;padding:12px;margin-top:8px;border:1.5px dashed #e2e8f0;border-radius:12px;background:transparent;color:#6366f1;font-size:.85rem;font-weight:600;cursor:pointer;transition:all .2s;font-family:inherit}
        .hist-toggle:hover{background:#f8fafc;border-color:#6366f1}
        .hist-toggle svg{width:18px;height:18px;fill:none;stroke:currentColor;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round;transition:transform .3s}
        .hist-toggle.expanded svg{transform:rotate(180deg)}
        .hist-item--hidden{display:none}
        [data-theme="dark"] .hist-toggle{border-color:#334155;color:#818cf8}
        [data-theme="dark"] .hist-toggle:hover{background:rgba(30,41,59,.5);border-color:#6366f1}

        .scan-progress{display:none;text-align:center;padding:40px 20px}
        .scan-progress.active{display:block}
        .scan-progress__spinner{width:48px;height:48px;border-radius:50%;border:4px solid #e2e8f0;border-top-color:#6366f1;animation:spinner .8s linear infinite;margin:0 auto 16px}
        @keyframes spinner{to{transform:rotate(360deg)}}
        .scan-progress__text{font-size:.9rem;color:#64748b;font-weight:500}
        .scan-progress__sub{font-size:.78rem;color:#94a3b8;margin-top:4px}

        [data-theme="dark"] .ai-page{background:linear-gradient(135deg,#0f172a 0%,#1e1b4b 50%,#0c0a2d 100%)}
        [data-theme="dark"] .ai-page::before{background:radial-gradient(circle,rgba(99,102,241,.12) 0%,transparent 70%)}
        [data-theme="dark"] .ai-page::after{background:radial-gradient(circle,rgba(236,72,153,.08) 0%,transparent 70%)}
        [data-theme="dark"] .ai-hero h1{color:#f1f5f9}
        [data-theme="dark"] .ai-card{background:rgba(30,41,59,.85);backdrop-filter:blur(12px);border-color:rgba(51,65,85,.7)}
        [data-theme="dark"] .ai-card__title{color:#f1f5f9}
        [data-theme="dark"] .ai-card__sub{color:#64748b}
        [data-theme="dark"] .upload-zone{background:rgba(30,41,59,.5);border-color:#334155}
        [data-theme="dark"] .upload-zone:hover,.upload-zone--active{background:rgba(30,41,59,.8);border-color:#6366f1}
        [data-theme="dark"] .upload-zone__graphic{background:rgba(99,102,241,.15)}
        [data-theme="dark"] .upload-zone:hover .upload-zone__graphic{background:linear-gradient(135deg,#6366f1,#a855f7)}
        [data-theme="dark"] .upload-zone__text{color:#f1f5f9}
        [data-theme="dark"] .upload-zone__hint{color:#64748b}
        [data-theme="dark"] .preview-frame{background:#1e293b}
        [data-theme="dark"] .change-btn{background:transparent;border-color:#334155;color:#94a3b8}
        [data-theme="dark"] .change-btn:hover{background:rgba(51,65,85,.5);color:#e2e8f0}
        [data-theme="dark"] .result-item{background:rgba(30,41,59,.6);border-color:#1e293b}
        [data-theme="dark"] .result-item__meaning{color:#94a3b8}
        [data-theme="dark"] .result-item__char{background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(168,85,247,.15))}
        [data-theme="dark"] .hist-item{background:rgba(30,41,59,.5);border-color:#1e293b}
        [data-theme="dark"] .hist-item:hover{background:rgba(30,41,59,.8)}
        [data-theme="dark"] .hist-item__label{color:#e2e8f0}
        [data-theme="dark"] .result-placeholder__graphic{background:rgba(30,41,59,.6)}
        [data-theme="dark"] .result-placeholder h3{color:#94a3b8}
        @media(max-width:768px){.ai-page{padding:80px 12px 40px}.ai-hero h1{font-size:1.5rem}.ai-card{padding:20px}.upload-zone{padding:32px 16px}}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="ai-page">
    <div class="container">
        <div class="ai-hero">
            <div class="ai-hero__icon">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            </div>
            <h1>Nhận diện vật thể bằng <span>AI</span></h1>
            <p>Tải ảnh lên, AI sẽ nhận diện vật thể và tra từ vựng tiếng Trung tương ứng cho bạn</p>
        </div>

        <div class="ai-grid">
            <div>
                <div class="ai-card" id="upload-card">
                    <div class="ai-card__header">
                        <div class="card-icon" style="background:linear-gradient(135deg,#eef2ff,#f5f3ff)">
                            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div>
                            <div class="ai-card__title">Tải ảnh lên</div>
                            <div class="ai-card__sub">Chọn ảnh từ thiết bị của bạn</div>
                        </div>
                    </div>
                    <div class="upload-zone ripple" id="upload-zone">
                        <div class="upload-zone__graphic">
                            <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        </div>
                        <div class="upload-zone__text">Chọn ảnh hoặc kéo thả</div>
                        <div class="upload-zone__hint">Hỗ trợ JPG, PNG, WEBP (tối đa 5MB)</div>
                        <input type="file" id="file-input" accept="image/*">
                    </div>
                </div>

                <div class="ai-card preview-card" id="preview-card">
                    <div class="ai-card__header">
                        <div class="card-icon" style="background:linear-gradient(135deg,#fce7f3,#fdf2f8)">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                        <div>
                            <div class="ai-card__title">Ảnh đã chọn</div>
                            <div class="ai-card__sub">Xem trước ảnh trước khi nhận diện</div>
                        </div>
                    </div>
                    <div class="preview-frame">
                        <img id="preview-img" alt="Preview">
                    </div>
                    <div class="preview-actions">
                        <button class="scan-btn ripple" id="scan-btn" disabled>
                            <span class="btn-icon">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                Nhận diện vật thể
                            </span>
                        </button>
                        <button class="change-btn btn ripple" id="change-btn">Chọn ảnh khác</button>
                    </div>
                </div>

                <div class="ai-card hist-section" id="history-section">
                    <div class="hist-header">
                        <h3>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Lịch sử nhận diện
                        </h3>
                        <span class="hist-count" id="hist-count">0 mục</span>
                    </div>
                    <div id="history-list">
                        <div class="result-placeholder" id="history-empty">
                            <div class="result-placeholder__graphic">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <h3>Chưa có lịch sử</h3>
                            <p>Những ảnh bạn đã nhận diện sẽ xuất hiện ở đây</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="ai-card">
                    <div class="ai-card__header">
                        <div class="card-icon" style="background:linear-gradient(135deg,#fef2f2,#fee2e2)">
                            <svg viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/><path d="M9 14l2 2 4-4"/></svg>
                        </div>
                        <div>
                            <div class="ai-card__title">Kết quả nhận diện</div>
                            <div class="ai-card__sub">AI sẽ phân tích và hiển thị kết quả tại đây</div>
                        </div>
                    </div>
                    <div id="result-area">
                        <div class="result-placeholder">
                            <div class="result-placeholder__graphic">
                                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            </div>
                            <h3>Chờ ảnh đầu vào</h3>
                            <p>Tải lên một ảnh để AI nhận diện vật thể và tra từ vựng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function speakChinese(text) {
    if (!text) return;
    var u = new SpeechSynthesisUtterance(text);
    u.lang = 'zh-CN';
    u.rate = 0.9;
    speechSynthesis.speak(u);
}

var userId = localStorage.getItem('hanngu_user_id') || 'default_user';
var uploadZone = document.getElementById('upload-zone');
var fileInput = document.getElementById('file-input');
var previewImg = document.getElementById('preview-img');
var scanBtn = document.getElementById('scan-btn');
var changeBtn = document.getElementById('change-btn');
var uploadCard = document.getElementById('upload-card');
var previewCard = document.getElementById('preview-card');
var currentImageData = '';
var currentHistoryId = null;

if (uploadZone) {
    uploadZone.addEventListener('dragover', function(e) { e.preventDefault(); uploadZone.classList.add('upload-zone--active'); });
    uploadZone.addEventListener('dragleave', function() { uploadZone.classList.remove('upload-zone--active'); });
    uploadZone.addEventListener('drop', function(e) { e.preventDefault(); uploadZone.classList.remove('upload-zone--active'); if(e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]); });
    uploadZone.addEventListener('click', function() { fileInput.click(); });
}

if (fileInput) {
    fileInput.addEventListener('change', function() { if(fileInput.files.length) handleFile(fileInput.files[0]); });
}

if (changeBtn) {
    changeBtn.addEventListener('click', function() {
        uploadCard.style.display = 'block';
        previewCard.style.display = 'none';
        currentImageData = '';
        previewImg.src = '';
        scanBtn.disabled = true;
        currentHistoryId = null;
    });
}

function handleFile(file) {
    if (!file.type.startsWith('image/')) { showToast('Chấp nhận file ảnh!', 'warning'); return; }
    if (file.size > 5 * 1024 * 1024) { showToast('File quá lớn! (tối đa 5MB)', 'warning'); return; }
    var reader = new FileReader();
    reader.onload = function(e) {
        currentImageData = e.target.result;
        previewImg.src = currentImageData;
        uploadCard.style.display = 'none';
        previewCard.style.display = 'block';
        scanBtn.disabled = false;
    };
    reader.readAsDataURL(file);
}

function renderResults(results, historyId) {
    currentHistoryId = historyId || null;
    var resultArea = document.getElementById('result-area');
    var html = '<div class="result-success" style="background:linear-gradient(135deg,#fef2f2,#fecaca);color:#dc2626"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Nhận diện thành công</div>';
    if (results.length === 0) {
        html += '<div class="result-placeholder"><div class="result-placeholder__graphic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg></div><h3>Không nhận diện được vật thể</h3><p>Không tìm thấy vật thể nào trong ảnh. Hãy thử với ảnh khác.</p></div>';
    } else {
        results.forEach(function(r) {
            var objectLabel = r.object ? '<div class="result-item__object"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4"/><path d="M12 16h.01"/></svg>' + r.object + '</div>' : '';
            var chineseHtml = r.char ? '<div class="result-item__char">' + r.char + '</div>' : '';
            var pinyinHtml = r.pinyin ? '<div class="result-item__pinyin">' + r.pinyin + '</div>' : '';
            var meaningHtml = r.meaning ? '<div class="result-item__meaning">' + r.meaning + '</div>' : '';
            var audioBtn = r.char ? '<button class="speak-btn" onclick="speakChinese(\'' + r.char.replace(/'/g, "\\'") + '\')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/></svg> Nghe</button>' : '';
            var saveBtn = r.char ? '<button class="save-btn" onclick="addToNotebook(\'' + r.char.replace(/'/g, "\\'") + '\',\'' + (r.pinyin||"").replace(/'/g, "\\'") + '\',\'' + (r.meaning||"").replace(/'/g, "\\'") + '\',' + (r.strokes || 0) + ',\'' + (r.radical||"").replace(/'/g, "\\'") + '\',\'' + (r.example||"").replace(/'/g, "\\'") + '\',\'' + (r.example_vi||"").replace(/'/g, "\\'") + '\')"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> Lưu sổ tay</button>' : '';
            var confidenceHtml = r.confidence ? '<div class="result-item__confidence">Độ tin cậy: ' + r.confidence.toFixed(1) + '%</div>' : '';
            html += '<div class="result-item">' + objectLabel +
                '<div class="result-item__main">' + chineseHtml +
                    '<div class="result-item__info">' + pinyinHtml + meaningHtml + confidenceHtml + '</div>' +
                '</div>' +
                (audioBtn || saveBtn ? '<div class="result-item__actions">' + audioBtn + saveBtn + '</div>' : '') +
            '</div>';
        });
    }
    resultArea.innerHTML = html;
}

if (scanBtn) scanBtn.addEventListener('click', function() {
    if (currentHistoryId) { currentHistoryId = null; }
    scanBtn.disabled = true;
    scanBtn.innerHTML = '<span class="btn-icon"><span class="scan-progress__spinner" style="width:18px;height:18px;border-width:2px;margin:0"></span> Đang xử lý...</span>';

    fetch('api.php?action=ai_recognize', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ image: currentImageData, user_id: userId })
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success && data.data && data.data.results) {
            renderResults(data.data.results, data.data.history_id);
            loadHistory();
            showToast(' Nhận diện thành công!', 'success');
        } else {
            showToast('Lỗi: ' + (data.message || 'Không nhận diện được'), 'error');
        }
    })
    .catch(function(err) {
        showToast('Lỗi kết nối!', 'error');
    })
    .finally(function() {
        scanBtn.innerHTML = '<span class="btn-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg> Nhận diện vật thể</span>';
        scanBtn.disabled = false;
    });
});

function addToNotebook(hanzi, pinyin, meaning, strokes, radical, example, exampleVi) {
    var data = {
        action: 'add_notebook',
        user_id: userId,
        hanzi: hanzi,
        pinyin: pinyin,
        meaning: meaning,
        strokes: strokes || 0,
        radical: radical || '',
        example: example || exampleVi || '',
        example_vi: exampleVi || example || ''
    };
    fetch('api.php?action=add_notebook', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(function(r) { return r.json(); }).then(function(d) {
        if (d && d.success) showToast(' Đã lưu vào sổ tay!', 'success', 2000);
        else showToast(d && d.message ? d.message : 'Lỗi lưu!', 'error');
    }).catch(function() { showToast('Lỗi lưu!', 'error'); });
}

function loadHistory() {
    fetch('api.php?action=get_ai_history&user_id=' + encodeURIComponent(userId))
    .then(function(r) { return r.json(); })
    .then(function(data) {
        var list = document.getElementById('history-list');
        var countEl = document.getElementById('hist-count');
        if (!data.success || !data.data || !data.data.length) {
            list.innerHTML = '<div class="result-placeholder" id="history-empty"><div class="result-placeholder__graphic"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg></div><h3>Chưa có lịch sử</h3><p>Những ảnh bạn đã nhận diện sẽ xuất hiện ở đây</p></div>';
            if (countEl) countEl.textContent = '0 mục';
            return;
        }
        if (countEl) countEl.textContent = data.data.length + ' mục';
        var allItems = data.data;
        var showCount = Math.min(3, allItems.length);
        var hasMore = allItems.length > 3;
        var html = '';
        for (var idx = 0; idx < allItems.length; idx++) {
            var h = allItems[idx];
            var isHidden = idx >= 3;
            var imgSrc = h.image_path && h.image_path.indexOf('uploads/') === 0 ? h.image_path : '';
            var label = h.detected_text || '';
            try { var j = JSON.parse(label); if (j && j.results) { label = j.results.map(function(r){return r.object || r.char}).filter(Boolean).join(', '); } } catch(e) {}
            html += '<div class="hist-item' + (isHidden ? ' hist-item--hidden' : '') + '" data-id="' + h.id + '" data-results=\'' + (h.detected_text || '') + '\'>' +
                (imgSrc ? '<img class="hist-item__thumb" src="' + imgSrc + '" alt="">' : '<div class="hist-item__thumb"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>') +
                '<div class="hist-item__info">' +
                    '<div class="hist-item__label">' + (label || 'Không xác định') + '</div>' +
                    '<div class="hist-item__date">' + h.created_at + '</div>' +
                '</div>' +
                '<button class="hist-item__del" onclick="event.stopPropagation();deleteHistory(' + h.id + ')" aria-label="Xoá"><svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg></button>' +
            '</div>';
        }
        if (hasMore) {
            html += '<button class="hist-toggle" id="hist-toggle"><svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg> Xem thêm</button>';
        }
        list.innerHTML = html;
        var toggleBtn = document.getElementById('hist-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                var hidden = list.querySelectorAll('.hist-item--hidden');
                var isExpanded = this.classList.contains('expanded');
                hidden.forEach(function(el) { el.style.display = isExpanded ? 'none' : 'flex'; });
                this.classList.toggle('expanded');
                this.innerHTML = isExpanded ? '<svg viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg> Xem thêm' : '<svg viewBox="0 0 24 24"><polyline points="6 15 12 9 18 15"/></svg> Thu gọn';
            });
        }
        list.querySelectorAll('.hist-item').forEach(function(el) {
            el.addEventListener('click', function() {
                var resultsRaw = el.getAttribute('data-results');
                if (!resultsRaw) return;
                try {
                    var j = JSON.parse(resultsRaw);
                    if (j && j.results) {
                        renderResults(j.results, el.getAttribute('data-id'));
                        var img = el.querySelector('img');
                        if (img && img.src) {
                            currentImageData = '';
                            previewImg.src = img.src;
                            uploadCard.style.display = 'none';
                            previewCard.style.display = 'block';
                            scanBtn.disabled = true;
                        }
                        showToast(' Đã tải lại kết quả!', 'info');
                    }
                } catch(e) {}
            });
        });
    })
    .catch(function() {});
}

function deleteHistory(id) {
    fetch('api.php?action=delete_ai_history&id=' + id + '&user_id=' + encodeURIComponent(userId))
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) { loadHistory(); showToast(' Đã xóa!', 'success', 2000); }
        else showToast('Lỗi xóa!', 'error');
    }).catch(function() { showToast('Lỗi xóa!', 'error'); });
}

document.addEventListener('DOMContentLoaded', loadHistory);
</script>

<script src="init.js"></script>
</body>
</html>
