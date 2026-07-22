<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Học thuật Cao cấp - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
.aa-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%)}

/* ===== MENU ===== */
.aa-menu{max-width:700px;margin:0 auto;text-align:center}
.aa-menu__badge{display:inline-flex;align-items:center;gap:6px;background:rgba(139,92,246,0.1);color:#7c3aed;padding:5px 16px;border-radius:50px;font-size:.82rem;font-weight:600;margin-bottom:12px}
.aa-menu__title{font-size:2rem;font-weight:900;color:#0f172a;margin-bottom:8px}
.aa-menu__title span{background:linear-gradient(135deg,#7c3aed,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.aa-menu__desc{font-size:.95rem;color:#64748b;margin-bottom:28px}
.aa-cards{display:grid;grid-template-columns:1fr;gap:16px;max-width:520px;margin:0 auto}
.aa-card{background:#fff;border-radius:18px;padding:24px 28px;text-align:left;cursor:pointer;transition:all .3s cubic-bezier(.16,1,.3,1);border:2px solid transparent;display:flex;align-items:center;gap:20px}
.aa-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,0.07);border-color:rgba(139,92,246,0.15)}
.aa-card__icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0}
.aa-card__icon--grammar{background:rgba(239,68,68,0.1);color:#ef4444}
.aa-card__icon--essay{background:rgba(13,148,136,0.1);color:#0d9488}
.aa-card__icon--summary{background:rgba(139,92,246,0.1);color:#7c3aed}
.aa-card__body h3{font-size:1.05rem;font-weight:800;color:#0f172a;margin:0 0 4px}
.aa-card__body p{font-size:.82rem;color:#64748b;margin:0;line-height:1.5}
.aa-card__hint{font-size:.72rem;color:#94a3b8;margin-top:4px}
.aa-menu__level{display:flex;align-items:center;gap:12px;justify-content:center;margin-bottom:28px}
.aa-menu__level select{padding:10px 20px;border:2px solid #e2e8f0;border-radius:12px;font-size:.95rem;font-weight:600;font-family:inherit;background:#fff;color:#0f172a;cursor:pointer}

/* ===== MODULE COMMON ===== */
.aa-module{max-width:760px;margin:0 auto;display:none}
.aa-module.active{display:block}
.aa-module__top{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px}
.aa-module__back{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:none;background:#fff;border-radius:10px;font-size:.85rem;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit;border:1px solid #e2e8f0;transition:all .2s}
.aa-module__back:hover{background:#f8fafc;color:#0f172a}
.aa-progress{font-size:.85rem;color:#94a3b8}
.aa-progress strong{color:#0f172a}
.aa-progress-bar{width:100%;height:4px;background:#e2e8f0;border-radius:4px;margin-bottom:24px;overflow:hidden}
.aa-progress-bar__fill{height:100%;background:linear-gradient(90deg,#7c3aed,#a855f7);border-radius:4px;transition:width .5s cubic-bezier(.16,1,.3,1)}
.aa-score{position:fixed;top:90px;right:24px;background:#fff;padding:10px 18px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08);display:none;align-items:center;gap:10px;font-size:.9rem;border:1px solid #e2e8f0;z-index:50}
.aa-score__num{font-weight:900;color:#7c3aed;font-size:1.1rem}

/* ===== GRAMMAR ERROR HUNT ===== */
.gh-card{background:#fff;border-radius:24px;padding:32px 28px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}
.gh-card__label{font-size:.82rem;color:#94a3b8;text-align:center;margin-bottom:20px}
.gh-grid{display:grid;grid-template-columns:1fr;gap:14px}
.gh-item{padding:28px 32px;border:2px solid #e2e8f0;border-radius:16px;cursor:pointer;transition:all .3s cubic-bezier(.16,1,.3,1);font-family:'Noto Sans SC',sans-serif;font-size:1.1rem;line-height:2;color:#0f172a;background:#fff;position:relative;text-align:left;width:100%;box-shadow:0 1px 4px rgba(0,0,0,0.02)}
.gh-item:hover{border-color:#94a3b8;background:#f8fafc;transform:translateY(-2px);box-shadow:0 4px 20px rgba(0,0,0,0.04)}
.gh-item__label{position:absolute;top:-11px;left:16px;background:#fff;padding:0 10px;font-family:Inter,sans-serif;font-size:.78rem;font-weight:800;color:#94a3b8;border-radius:4px;letter-spacing:.02em}
.gh-item--selected{border-color:#ef4444!important;background:rgba(239,68,68,0.04)!important;box-shadow:0 0 0 3px rgba(239,68,68,0.12),0 4px 16px rgba(239,68,68,0.08)!important}
.gh-item--selected .gh-item__label{color:#ef4444}
.gh-item--correct{border-color:#10b981!important;background:rgba(16,185,129,0.06)!important}
.gh-item--correct .gh-item__label{color:#10b981}
.gh-item--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.06)!important;opacity:.6}
.gh-item--dim{opacity:.35;pointer-events:none}
.gh-item:disabled{cursor:default}
.gh-submit{padding:14px 40px;border:none;background:linear-gradient(135deg,#ef4444,#dc2626);color:#fff;border-radius:14px;font-size:1rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(239,68,68,0.25);transition:all .3s;display:block;margin:0 auto}
.gh-submit:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 6px 24px rgba(239,68,68,0.35)}
.gh-submit:disabled{opacity:.4;cursor:not-allowed}
.gh-note{text-align:center;padding:16px 20px;border-radius:14px;margin-top:16px;display:none;font-size:.9rem;line-height:1.6}
.gh-note--show{display:block}
.gh-note--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.gh-note--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}
.gh-note__expl{font-family:'Noto Sans SC',sans-serif;font-size:1rem;margin-top:6px;color:#0f172a;font-weight:500}
.gh-next{display:none;margin:16px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.gh-next:hover{transform:translateY(-2px)}
.gh-next.active{display:inline-block}

/* ===== KEYWORD ESSAY ===== */
.ke-card{background:#fff;border-radius:24px;padding:32px 28px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}
.ke-card__label{font-size:.82rem;color:#94a3b8;text-align:center;margin-bottom:16px}
.ke-tags{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;margin-bottom:20px}
.ke-tag{padding:8px 18px;background:#f1f5f9;border:2px solid #e2e8f0;border-radius:50px;font-family:'Noto Sans SC',sans-serif;font-size:1rem;font-weight:600;color:#94a3b8;transition:all .3s}
.ke-tag--used{background:rgba(13,148,136,0.1);border-color:#0d9488;color:#0d9488;box-shadow:0 2px 8px rgba(13,148,136,0.15)}
.ke-area{position:relative}
.ke-area textarea{width:100%;min-height:200px;padding:16px;border:2px solid #e2e8f0;border-radius:14px;font-family:'Noto Sans SC',sans-serif;font-size:1rem;line-height:1.8;color:#0f172a;resize:vertical;transition:border-color .25s;box-sizing:border-box}
.ke-area textarea:focus{outline:none;border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,0.08)}
.ke-counter{position:absolute;bottom:10px;right:14px;font-size:.78rem;color:#94a3b8;font-weight:600;background:#fff;padding:2px 10px;border-radius:6px}
.ke-counter--warn{color:#f59e0b}
.ke-counter--over{color:#ef4444}
.ke-actions{display:flex;gap:12px;justify-content:center;margin-top:16px;flex-wrap:wrap}
.ke-submit{padding:12px 32px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.ke-submit:hover:not(:disabled){transform:translateY(-2px)}
.ke-submit:disabled{opacity:.4;cursor:not-allowed}
.ke-feedback{text-align:center;padding:16px;border-radius:14px;margin-top:16px;display:none;font-size:.9rem}
.ke-feedback--show{display:block}
.ke-feedback--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.ke-feedback--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}
.ke-next{display:none;margin:16px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.ke-next:hover{transform:translateY(-2px)}
.ke-next.active{display:inline-block}

/* ===== TIME SUMMARY ===== */
.ts-card{background:#fff;border-radius:24px;padding:28px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}

/* Timer */
.ts-timer{text-align:center;margin-bottom:20px}
.ts-timer__display{font-size:2.8rem;font-weight:900;font-variant-numeric:tabular-nums;letter-spacing:2px;line-height:1.2}
.ts-timer__display--reading{color:#7c3aed}
.ts-timer__display--writing{color:#0d9488}
.ts-timer__label{font-size:.82rem;color:#94a3b8;margin-top:4px}
.ts-timer__bar{width:100%;height:4px;background:#e2e8f0;border-radius:4px;margin-top:12px;overflow:hidden}
.ts-timer__bar-fill{height:100%;background:linear-gradient(90deg,#7c3aed,#a855f7);border-radius:4px;transition:width 1s linear}

/* Phase 1 - Reading */
.ts-article{font-family:'Noto Sans SC',sans-serif;font-size:1.05rem;line-height:2;color:#0f172a;padding:20px;background:#f8fafc;border-radius:14px;border:1px solid #f1f5f9;user-select:none;-webkit-user-select:none;max-height:520px;overflow-y:auto}
.ts-article p{margin:0 0 12px;text-indent:2em}
.ts-article::-webkit-scrollbar{width:4px}
.ts-article::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:4px}

/* Phase transition */
.ts-transition{text-align:center;padding:60px 20px;display:none}
.ts-transition.active{display:block}
.ts-transition__icon{font-size:3rem;margin-bottom:12px;animation:tsPulse 1s ease-in-out infinite}
@keyframes tsPulse{0%,100%{transform:scale(1)}50%{transform:scale(1.15)}}
.ts-transition__text{font-size:1.1rem;color:#0f172a;font-weight:700}

/* Phase 3 - Writing */
.ts-writing{display:none}
.ts-writing.active{display:block}
.ts-writing textarea{width:100%;min-height:300px;padding:16px;border:2px solid #e2e8f0;border-radius:14px;font-family:'Noto Sans SC',sans-serif;font-size:1rem;line-height:1.8;color:#0f172a;resize:vertical;box-sizing:border-box;transition:border-color .25s}
.ts-writing textarea:focus{outline:none;border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,0.08)}
.ts-writing__counter{text-align:right;font-size:.78rem;color:#94a3b8;margin-top:6px;font-weight:600}
.ts-writing__counter--ok{color:#10b981}
.ts-writing__counter--short{color:#f59e0b}
.ts-submit{padding:14px 40px;border:none;background:linear-gradient(135deg,#7c3aed,#a855f7);color:#fff;border-radius:14px;font-size:1rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(124,58,237,0.25);transition:all .3s;display:block;margin:16px auto 0}
.ts-submit:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 6px 24px rgba(124,58,237,0.35)}
.ts-submit:disabled{opacity:.4;cursor:not-allowed}
.ts-skip{display:inline-flex;align-items:center;gap:6px;margin:16px auto 0;padding:10px 24px;border:none;background:rgba(100,116,139,0.12);color:#64748b;border-radius:10px;font-size:.85rem;font-weight:600;cursor:pointer;font-family:inherit;transition:all .25s}
.ts-skip:hover{background:rgba(100,116,139,0.2);color:#0f172a}
[data-theme="dark"] .ts-skip:hover{color:#f1f5f9}
.ts-done{text-align:center;padding:40px;display:none}
.ts-done.active{display:block}
.ts-done__icon{font-size:4rem;margin-bottom:12px}
.ts-done__text{font-size:1.1rem;color:#0f172a;font-weight:700;margin-bottom:4px}
.ts-done__sub{font-size:.9rem;color:#94a3b8}

/* ===== RESULT ===== */
.aa-result{max-width:520px;margin:0 auto;display:none}
.aa-result.active{display:block}
.aa-result__card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06)}
.aa-result__icon{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2.4rem}
.aa-result__score{font-size:3.5rem;font-weight:900;line-height:1.2;margin-bottom:4px}
.aa-result__label{font-size:.9rem;color:#64748b;margin-bottom:16px}
.aa-result__msg{font-size:1.05rem;color:#0f172a;font-weight:700;margin-bottom:24px;padding:14px 20px;background:#f8fafc;border-radius:12px}
.aa-result__actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}

/* ===== CONFETTI ===== */
.cf-c{position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden}

@media(max-width:640px){
.aa-menu__title{font-size:1.5rem}
.aa-card{flex-direction:column;text-align:center}
.ts-timer__display{font-size:2rem}
.ts-article{font-size:.95rem;padding:14px;max-height:360px}
}

[data-theme="dark"] .aa-page{background:#0f172a}
[data-theme="dark"] .aa-menu__title,[data-theme="dark"] .aa-card__body h3{color:#f1f5f9}
[data-theme="dark"] .aa-card,[data-theme="dark"] .gh-card,[data-theme="dark"] .ke-card,[data-theme="dark"] .ts-card,[data-theme="dark"] .aa-result__card{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .gh-item{background:#1e293b;border-color:#334155;color:#e2e8f0}
[data-theme="dark"] .gh-item:hover{background:#1e293b;border-color:#64748b}
[data-theme="dark"] .gh-item__label{background:#1e293b;color:#64748b}
[data-theme="dark"] .gh-item--selected{box-shadow:0 0 0 3px rgba(239,68,68,0.2),0 4px 16px rgba(239,68,68,0.1)!important}
[data-theme="dark"] .gh-item--correct{box-shadow:0 0 0 3px rgba(16,185,129,0.2)!important}
[data-theme="dark"] .gh-item--correct .gh-item__label{color:#34d399}
[data-theme="dark"] .cloze-popup::before{background:#1e293b}
[data-theme="dark"] .ke-tag{background:#334155;border-color:#475569;color:#94a3b8}
[data-theme="dark"] .ke-tag--used{background:rgba(13,148,136,0.15);border-color:#0d9488;color:#5eead4}
[data-theme="dark"] .ke-area textarea,[data-theme="dark"] .ts-writing textarea{background:#1e293b;border-color:#334155;color:#f1f5f9}
[data-theme="dark"] .ke-counter{background:#1e293b}
[data-theme="dark"] .ts-article{background:#334155;border-color:#475569;color:#f1f5f9}
[data-theme="dark"] .aa-module__back{background:#1e293b;border-color:#334155;color:#94a3b8}
[data-theme="dark"] .aa-module__back:hover{color:#f1f5f9}
[data-theme="dark"] .aa-progress-bar{background:#334155}
[data-theme="dark"] .aa-score{background:#1e293b;border-color:#334155}
[data-theme="dark"] .aa-result__msg{background:#334155;color:#f1f5f9}
[data-theme="dark"] .gh-note__expl{color:#e2e8f0}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="aa-page">
<div class="container">

<div class="aa-score" id="aaScore">
<i class="bi bi-star-fill" style="color:#f59e0b"></i>
Điểm: <span class="aa-score__num" id="aaScoreNum">0</span>
</div>

<!-- MENU -->
<div class="aa-menu" id="aaMenu">
<div class="aa-menu__badge"><i class="bi bi-mortarboard-fill"></i> Học thuật Cao cấp</div>
<h1 class="aa-menu__title">Luyện tập <span>trình độ cao</span></h1>
<p class="aa-menu__desc">Tìm lỗi sai ngữ pháp, viết đoạn văn và tóm tắt văn bản</p>
<div class="aa-menu__level">
<label style="font-weight:700;color:#0f172a">Cấp độ:</label>
<select id="aaLevel">
<option value="5">HSK 5</option>
<option value="6" selected>HSK 6</option>
</select>
</div>
<div class="aa-cards">
<div class="aa-card" onclick="startModule('grammar')">
<div class="aa-card__icon aa-card__icon--grammar"><i class="bi bi-exclamation-triangle"></i></div>
<div class="aa-card__body">
<h3>Tìm lỗi sai ngữ pháp</h3>
<p>Chọn câu có lỗi ngữ pháp trong 4 câu A-B-C-D</p>
<div class="aa-card__hint">HSK 6 • Ngữ pháp nâng cao</div>
</div>
</div>
<div class="aa-card" onclick="startModule('essay')">
<div class="aa-card__icon aa-card__icon--essay"><i class="bi bi-pencil-square"></i></div>
<div class="aa-card__body">
<h3>Viết đoạn văn</h3>
<p>Viết đoạn văn 80 chữ sử dụng 5 từ khoá cho trước</p>
<div class="aa-card__hint">HSK 5 • Từ khoá + viết luận</div>
</div>
</div>
<div class="aa-card" onclick="startModule('summary')">
<div class="aa-card__icon aa-card__icon--summary"><i class="bi bi-clock-history"></i></div>
<div class="aa-card__body">
<h3>Tóm tắt văn bản</h3>
<p>Đọc bài báo trong 10 phút, viết tóm tắt 400 chữ trong 35 phút</p>
<div class="aa-card__hint">HSK 6 • Đọc + Viết có thời gian</div>
</div>
</div>
</div>
</div>

<!-- MODULE -->
<div class="aa-module" id="aaModule">
<div class="aa-module__top">
<button class="aa-module__back" onclick="backToMenu()"><i class="bi bi-arrow-left"></i> Quay lại</button>
<div class="aa-progress" id="aaProg">Câu <strong id="qC">1</strong>/<span id="qT">6</span></div>
</div>
<div class="aa-progress-bar" id="aaProgBar"><div class="aa-progress-bar__fill" id="progFill" style="width:0%"></div></div>
<div id="aaArea"></div>
</div>

<!-- RESULT -->
<div class="aa-result" id="aaResult">
<div class="aa-result__card">
<div class="aa-result__icon" id="resIcon"><i class="bi bi-trophy-fill" style="color:#7c3aed;font-size:2.4rem"></i></div>
<div class="aa-result__score" id="resScore">0</div>
<div class="aa-result__label">/ <span id="resTotal">0</span></div>
<div class="aa-result__msg" id="resMsg">Hoàn thành!</div>
<div class="aa-result__actions">
<button class="btn btn--primary ripple" onclick="retryMod()"><i class="bi bi-arrow-repeat"></i> Làm lại</button>
<button class="btn btn--outline ripple" onclick="backToMenu()"><i class="bi bi-grid"></i> Chọn dạng khác</button>
</div>
</div>
</div>

</div>
</main>

<script>
const API_URL='api.php';
const USER_ID=localStorage.getItem('hanngu_user_id')||'default_user';

// ===== GRAMMAR ERROR HUNT DATA =====
const grammarData=[
{sentences:['这个问题被我们讨论了很长时间。','他把作业做完了以后就去看电视。','这本书被我看了三遍了已经。','她从来不说别人的坏话在背后。'],wrong:3,explanation:'Câu D sai trật tự từ. "在背后" (sau lưng) phải đứng trước "不说": "她从来不在背后说别人的坏话。"'},
{sentences:['只要努力，就一定能成功。','即使下雨，我也要去上学。','不管你来不来，我都会等你。','虽然他很努力，但是成绩不理想。'],wrong:0,explanation:'Câu A thiếu "再" trước "努力". Câu đúng: "只要再努力，就一定能成功。"'},
{sentences:['他把杯子打破了。','我被老师批评了一顿。','她叫我去超市买东西。','他把这件事让我做。'],wrong:3,explanation:'Câu D sai vì "把" không dùng với cấu trúc "让/叫". Câu đúng: "他让我做这件事。"'},
{sentences:['这个城市的人口在不断增长。','学习汉语的人越来越多了。','他的成绩比我差得多。','天气越来越热比昨天。'],wrong:3,explanation:'Câu D sai vị trí từ so sánh. Câu đúng: "天气比昨天越来越热。" hoặc "天气比昨天热得多。"'},
{sentences:['我连一个字也不认识。','他连看都没看我一眼。','连老师也回答不了这个问题。','我连吃饭没时间。'],wrong:3,explanation:'Câu D thiếu 都/也. Câu đúng: "我连吃饭的时间都没有。"'},
{sentences:['他把作业交给老师了。','这个问题被我们解决了。','他被大家选为班长。','把这本书我看了三遍。'],wrong:3,explanation:'Câu D sai trật tự "把". Đúng phải là: "我把这本书看了三遍。" (S + 把 + O + V).'},
{sentences:['这个问题的答案是很明显的。','对这件事我们有不同的看法。','他关于这个问题发表了意见。','随着社会的发展，人们的生活水平提高了。'],wrong:2,explanation:'Câu C sai. "关于" không dùng trực tiếp với "发表意见". Câu đúng: "他对这个问题发表了意见。"'},
{sentences:['我建议你去医院看看。','他反对这个计划。','她拒绝了我的邀请。','他从图书馆走出来一本书。'],wrong:3,explanation:'Câu D sai vì "走出来" là động từ xu hướng không thể mang tân ngữ trực tiếp. Câu đúng: "他从图书馆走出来，手里拿着一本书。"'},
{sentences:['我把作业做完了。','我把那本书还给他了。','请你把门关上。','我把汉语学会了很久。'],wrong:3,explanation:'Câu D sai vì "把" không dùng với động từ chỉ kết quả kéo dài như "学会". Câu đúng: "我学汉语学了很久。" hoặc "汉语我学了很久才学会。"'},
{sentences:['他不但会说英语，还会说法语。','这次比赛，我们不但赢了，而且赢得漂亮。','不但我认识他，而且他是我最好的朋友。','他不但学习了汉语，还学习了中国文化。'],wrong:2,explanation:'Câu C sai vị trí "不但". Khi hai chủ ngữ giống nhau, "不但" phải đứng sau chủ ngữ đầu. Câu đúng: "我不但认识他，而且他是我最好的朋友。" - vẫn sai vì chủ ngữ thay đổi. Sửa: "我不但认识他，而且他还是我最好的朋友。"'},
];

// ===== KEYWORD ESSAY DATA =====
const essayData=[
{keywords:['保护','环境','污染','措施','意识'],prompt:'Hãy viết về vấn đề bảo vệ môi trường'},
{keywords:['教育','发展','机会','平等','改革'],prompt:'Hãy viết về giáo dục và cơ hội phát triển'},
{keywords:['健康','运动','习惯','饮食','休息'],prompt:'Hãy viết về lối sống lành mạnh'},
{keywords:['科技','创新','影响','未来','改变'],prompt:'Hãy viết về tác động của công nghệ'},
{keywords:['文化','传统','交流','理解','尊重'],prompt:'Hãy viết về giao lưu văn hoá'},
{keywords:['经济','增长','挑战','合作','可持续'],prompt:'Hãy viết về phát triển kinh tế bền vững'},
{keywords:['社会','责任','贡献','志愿','社区'],prompt:'Hãy viết về trách nhiệm xã hội'},
{keywords:['工作','压力','平衡','效率','目标'],prompt:'Hãy viết về cân bằng công việc và cuộc sống'},
{keywords:['旅游','经历','文化','风景','收获'],prompt:'Hãy viết về một trải nghiệm du lịch'},
{keywords:['友谊','信任','沟通','理解','支持'],prompt:'Hãy viết về tình bạn và sự tin tưởng'},
];

// ===== TIME SUMMARY ARTICLES =====
const summaryData=[
{
title:'全球气候变化及其影响',
content:'近年来，全球气候变化问题日益严重，引起了国际社会的广泛关注。科学家们指出，由于人类活动导致的大气中温室气体浓度不断上升，全球平均气温正在逐步升高。这一现象已经对地球生态系统产生了深远的影响。\n\n首先，极地冰川的融化速度正在加快。根据最新的卫星数据显示，北极海冰的面积每年以约百分之十三的速度减少。冰川融化不仅导致海平面上升，威胁沿海地区的居民安全，还可能释放出被冰封的古老病毒和细菌。\n\n其次，极端天气事件变得越来越频繁。从欧洲的热浪到北美的飓风，从亚洲的洪水到非洲的干旱，气候变化正在以各种方式影响着世界各地的人们。据统计，过去十年间，与气候相关的自然灾害数量比上一个十年增加了近一倍。\n\n第三，生物多样性正在遭受严重威胁。许多动植物物种因为无法适应快速变化的气候条件而面临灭绝的风险。珊瑚礁的白化现象就是一个典型的例子，海洋温度的升高导致大量珊瑚死亡，进而影响整个海洋食物链。\n\n面对这些挑战，国际社会已经采取了多种应对措施。2015年通过的《巴黎协定》为全球减排设定了明确目标，各国纷纷承诺减少温室气体排放。同时，可再生能源的开发和利用也在加速推进，太阳能、风能等清洁能源在能源结构中的占比不断提高。\n\n然而，应对气候变化需要全球各国的共同努力。发达国家应当承担更多责任，向发展中国家提供资金和技术支持。个人层面，我们也可以从日常生活的点滴做起，比如减少浪费、节约能源、选择绿色出行方式等。只有全社会共同努力，我们才能为子孙后代留下一个宜居的地球。',
keywords:['气候变化','温室气体','极端天气','可再生能源','共同责任']
},
{
title:'人工智能的发展与伦理思考',
content:'人工智能技术在过去十年间取得了突飞猛进的发展，正在深刻改变着人类社会的方方面面。从智能手机上的语音助手到自动驾驶汽车，从医疗诊断系统到金融风险预测，人工智能的应用已经渗透到我们生活的各个角落。\n\n在医疗领域，人工智能展现出了巨大的潜力。深度学习算法能够通过分析大量的医学影像数据，帮助医生更准确地诊断疾病，某些情况下甚至超越了人类专家的准确率。此外，人工智能还在药物研发过程中发挥着重要作用，大大缩短了新药从研发到上市的时间周期。\n\n教育领域同样受益于人工智能技术。个性化学习系统能够根据每个学生的学习进度和理解能力，量身定制学习计划和教学内容。智能辅导系统可以24小时不间断地为学生解答疑问，极大地提高了学习效率和教育资源的可及性。\n\n然而，人工智能的快速发展也带来了一系列伦理和社会问题。其中最引人关注的是就业问题。许多传统岗位面临着被自动化取代的风险，如何安置这些失业人口，如何帮助他们获得新的技能，成为各国政府面临的重大挑战。\n\n隐私保护是另一个突出的问题。人工智能系统需要大量的数据来进行训练和优化，这不可避免地从收集个人信息开始。在享受人工智能带来便利的同时，我们如何保护自己的隐私不被侵犯？如何防止个人数据被滥用？这些都是亟待解决的问题。\n\n此外，人工智能的决策过程往往是一个"黑箱"，即使是开发者也难以完全理解算法是如何得出特定结论的。在涉及司法判决、信贷审批等重大决策时，这种不透明性可能带来公平性和问责制方面的问题。\n\n面对这些挑战，各国正在积极探索人工智能治理的新模式。欧盟率先提出了人工智能监管法案，按照风险等级对人工智能应用进行分类管理。中国也发布了新一代人工智能治理原则，强调人工智能的发展应当以人为本、可控可信。',
keywords:['人工智能','医疗诊断','就业影响','隐私保护','伦理治理']
},
{
title:'城市化进程中的挑战与机遇',
content:'随着全球经济的持续发展，城市化已成为不可逆转的趋势。目前，全球超过一半的人口居住在城市地区，预计到2050年，这一比例将达到百分之六十八。城市化在推动经济增长、促进社会进步的同时，也带来了一系列严峻的挑战。\n\n住房问题是大城市面临的共同难题。随着大量人口涌入城市，住房需求急剧增加，导致房价不断攀升。在许多国际大都市，普通工薪阶层很难在市中心购买一套属于自己的住房。住房压力不仅影响人们的生活质量，还可能导致社会分化和不稳定因素的产生。\n\n交通拥堵是另一个令城市管理者头疼的问题。每天早晚高峰期间，城市主干道上的车辆排起长龙，通勤时间不断延长。这不仅降低了工作效率，还加剧了空气污染和能源消耗。为了缓解交通压力，许多城市正在大力发展公共交通系统，鼓励市民使用地铁、公交车等公共交通工具出行。\n\n环境污染问题同样不容忽视。城市中大量的工业生产和汽车尾气排放导致空气质量下降，雾霾天气频繁出现。长期生活在污染严重的环境中，人们的健康受到严重威胁，呼吸系统疾病和心血管疾病的发病率明显上升。\n\n然而，城市化也带来了前所未有的机遇。城市是创新的摇篮，人才、资金、信息在此高度集聚，为科技创新和文化创意提供了肥沃的土壤。世界上最具创新力的企业和机构大多集中在城市，城市的发展水平往往代表着一个国家的综合实力。\n\n城市还提供了更加丰富的教育、医疗和文化资源。优质的学校和医院集中在城市，各种博物馆、剧院、图书馆等文化设施也为人们的精神生活提供了更多选择。对于年轻人来说，城市意味着更多的就业机会和更广阔的发展空间。\n\n为了实现可持续的城市发展，各国正在积极探索智慧城市的建设方案。通过运用物联网、大数据、云计算等信息技术，城市管理者可以更加高效地配置资源，优化公共服务，改善居民生活质量。未来的城市应当是人、自然、科技的和谐统一体。',
keywords:['城市化','住房压力','交通拥堵','智慧城市','可持续发展']
},
];

let state={module:'',level:6,score:0,current:0,questions:[],total:0,answered:false};
let tsTimer=null,tsSeconds=0,tsPhase='reading';

async function fetchAPI(a,d,m){if(!m)m='GET';try{let u=API_URL+'?action='+a;let o={method:m,headers:{'Content-Type':'application/json'}};if(m==='GET'&&d)u+='&'+new URLSearchParams(d).toString();else if(d)o.body=JSON.stringify(d);return await(await fetch(u,o)).json()}catch(e){showToast('Lỗi!','error');return[]}}
function shuffle(a){const c=[...a];for(let i=c.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[c[i],c[j]]=[c[j],c[i]]}return c}

function esc(t){if(!t)return'';const d=document.createElement('div');d.textContent=t;return d.innerHTML}
function updScore(){document.getElementById('aaScoreNum').textContent=state.score}

function backToMenu(){
if(tsTimer){clearInterval(tsTimer);tsTimer=null}
document.getElementById('aaMenu').style.display='';
document.getElementById('aaModule').classList.remove('active');
document.getElementById('aaResult').classList.remove('active');
document.getElementById('aaScore').style.display='none';
}

function startModule(type){
state.module=type;state.level=parseInt(document.getElementById('aaLevel').value);
state.score=0;state.current=0;state.answered=false;
updScore();
document.getElementById('aaMenu').style.display='none';
document.getElementById('aaResult').classList.remove('active');
document.getElementById('aaModule').classList.add('active');
document.getElementById('aaScore').style.display='flex';
if(type==='grammar')startGrammar();
else if(type==='essay')startEssay();
else if(type==='summary')startSummary();
}

function updProg(){
document.getElementById('qC').textContent=state.current+1;
document.getElementById('qT').textContent=state.total;
document.getElementById('progFill').style.width=((state.current+1)/state.total*100)+'%';
}

// ===== GRAMMAR ERROR HUNT =====
function startGrammar(){
state.questions=shuffle([...grammarData]).slice(0,8);
state.total=state.questions.length;
renderGrammar();
}

function renderGrammar(){
state.answered=false;updProg();
const q=state.questions[state.current];
const labels=['A','B','C','D'];
document.getElementById('aaArea').innerHTML=
'<div class="gh-card">'+
'<div class="gh-card__label">Chọn câu có lỗi ngữ pháp:</div>'+
'<div class="gh-grid">'+
q.sentences.map((s,i)=>'<button class="gh-item" data-idx="'+i+'" onclick="pickGrammar(this)"><span class="gh-item__label">'+labels[i]+'</span>'+esc(s)+'</button>').join('')+
'</div>'+
'<div class="gh-note" id="ghNote"></div>'+
'<button class="gh-submit" id="ghSubmit" onclick="checkGrammar()" disabled><i class="bi bi-check-lg"></i> Nộp bài</button>'+
'<button class="gh-next" id="ghNext" onclick="nextQ()">Tiếp tục <i class="bi bi-arrow-right"></i></button>'+
'</div>';
}

function pickGrammar(el){
if(state.answered)return;
document.querySelectorAll('.gh-item').forEach(b=>b.classList.remove('gh-item--selected'));
el.classList.add('gh-item--selected');
state.picked=parseInt(el.dataset.idx);
document.getElementById('ghSubmit').disabled=false;
}

function checkGrammar(){
if(state.answered)return;
state.answered=true;
const q=state.questions[state.current];
const correct=q.wrong;
const picked=state.picked;
const isCorrect=picked===correct;
if(isCorrect)state.score++;
updScore();
document.querySelectorAll('.gh-item').forEach(b=>{
b.disabled=true;
const idx=parseInt(b.dataset.idx);
if(idx===correct)b.classList.add('gh-item--correct');
else if(idx===picked&&!isCorrect)b.classList.add('gh-item--wrong');
else b.classList.add('gh-item--dim');
});
const note=document.getElementById('ghNote');
note.className='gh-note gh-note--show '+(isCorrect?'gh-note--success':'gh-note--fail');
note.innerHTML=(isCorrect
?'<i class="bi bi-check-circle-fill"></i> Chính xác! Đáp án là <strong>'+['A','B','C','D'][correct]+'</strong>.'
:'<i class="bi bi-x-circle-fill"></i> Sai. Đáp án đúng là <strong>'+['A','B','C','D'][correct]+'</strong>.')
+'<div class="gh-note__expl">'+esc(q.explanation)+'</div>';
document.getElementById('ghSubmit').disabled=true;
document.getElementById('ghNext').classList.add('active');
}

// ===== KEYWORD ESSAY =====
function startEssay(){
state.questions=shuffle([...essayData]).slice(0,6);
state.total=state.questions.length;
renderEssay();
}

function renderEssay(){
state.answered=false;updProg();
const q=state.questions[state.current];
const tagsHtml=q.keywords.map(k=>'<span class="ke-tag" data-word="'+esc(k)+'">'+esc(k)+'</span>').join('');
document.getElementById('aaArea').innerHTML=
'<div class="ke-card">'+
'<div class="ke-card__label">'+esc(q.prompt)+' — Sử dụng 5 từ khoá bên dưới:</div>'+
'<div class="ke-tags" id="keTags">'+tagsHtml+'</div>'+
'<div class="ke-area">'+
'<textarea id="keTextarea" rows="6" placeholder="Viết đoạn văn của bạn..." oninput="onEssayInput()"></textarea>'+
'<div class="ke-counter" id="keCounter">0 chữ</div>'+
'</div>'+
'<div class="ke-actions">'+
'<button class="ke-submit" id="keSubmit" onclick="checkEssay()" disabled><i class="bi bi-check-lg"></i> Nộp bài</button>'+
'</div>'+
'<div class="ke-feedback" id="keFb"></div>'+
'<button class="ke-next" id="keNext" onclick="nextQ()">Tiếp tục <i class="bi bi-arrow-right"></i></button>'+
'</div>';
document.getElementById('keTextarea').focus();
}

function onEssayInput(){
const ta=document.getElementById('keTextarea');
const txt=ta.value;
const chars=txt.replace(/\s/g,'').length;
const counter=document.getElementById('keCounter');
counter.textContent=chars+' chữ';
counter.className='ke-counter'+(chars>120?' ke-counter--over':chars>100?' ke-counter--warn':'');
if(chars>120)ta.value=[...txt].slice(0,120).join('').trim();

// Highlight keywords
const q=state.questions[state.current];
document.querySelectorAll('.ke-tag').forEach(tag=>{
const word=tag.dataset.word;
tag.classList.toggle('ke-tag--used',txt.indexOf(word)!==-1);
});

// Enable submit if 80+ chars
const clean=txt.replace(/[\s\n\r]+/g,'').length;
document.getElementById('keSubmit').disabled=clean<60;
}

function checkEssay(){
if(state.answered)return;
state.answered=true;
const q=state.questions[state.current];
const txt=document.getElementById('keTextarea').value;
const used=q.keywords.filter(k=>txt.indexOf(k)!==-1);
const missing=q.keywords.filter(k=>txt.indexOf(k)===-1);
const chars=txt.replace(/\s/g,'').length;
const fb=document.getElementById('keFb');
const allUsed=missing.length===0;
if(allUsed&&chars>=60){state.score++;updScore();}
let msg='';
if(allUsed)msg='<i class="bi bi-check-circle-fill"></i> Đã sử dụng đủ '+q.keywords.length+' từ khoá!';
else msg='<i class="bi bi-exclamation-triangle-fill"></i> Thiếu từ khoá: <strong>'+missing.join(', ')+'</strong>';
fb.className='ke-feedback ke-feedback--show '+(allUsed?'ke-feedback--success':'ke-feedback--fail');
fb.innerHTML=msg+'<br><span style="font-weight:400;font-size:.85rem">Số chữ: '+chars+'</span>';
document.getElementById('keTextarea').disabled=true;
document.getElementById('keSubmit').disabled=true;
document.getElementById('keNext').classList.add('active');
}

// ===== TIME SUMMARY =====
function startSummary(){
state.questions=shuffle([...summaryData]);
state.total=state.questions.length;
renderSummary();
}

function renderSummary(){
state.answered=false;updProg();
const q=state.questions[state.current];
const paras=q.content.split('\n').filter(p=>p.trim());
document.getElementById('aaArea').innerHTML=
'<div class="ts-card">'+
'<div class="ts-timer">'+
'<div class="ts-timer__display ts-timer__display--reading" id="tsDisplay">10:00</div>'+
'<div class="ts-timer__label" id="tsLabel">Đọc bài báo — Thời gian còn lại</div>'+
'<div class="ts-timer__bar"><div class="ts-timer__bar-fill" id="tsBarFill" style="width:100%"></div></div>'+
'<button class="ts-skip" id="tsSkipBtn" onclick="skipReading()"><i class="bi bi-forward-fill"></i> Bỏ qua — Viết ngay</button>'+
'</div>'+
'<div class="ts-article" id="tsArticle"><p>'+paras.map(p=>esc(p)).join('</p><p>')+'</p></div>'+
'</div>'+
'<div class="ts-transition" id="tsTransition"><div class="ts-transition__icon">✍️</div><div class="ts-transition__text">Đã hết thời gian đọc! Chuẩn bị viết tóm tắt...</div></div>'+
'<div class="ts-writing" id="tsWriting">'+
'<div class="ts-timer">'+
'<div class="ts-timer__display ts-timer__display--writing" id="tsDisplay2">35:00</div>'+
'<div class="ts-timer__label">Viết tóm tắt — Thời gian còn lại</div>'+
'<div class="ts-timer__bar"><div class="ts-timer__bar-fill" id="tsBarFill2" style="width:100%"></div></div>'+
'</div>'+
'<textarea id="tsTextarea" rows="10" placeholder="Hãy viết tóm tắt nội dung bài báo (khoảng 400 chữ)..." oninput="onSummaryInput()"></textarea>'+
'<div class="ts-writing__counter" id="tsWCounter">0 chữ</div>'+
'<button class="ts-submit" id="tsSubmit" onclick="checkSummary()" disabled><i class="bi bi-check-lg"></i> Nộp bài</button>'+
'</div>'+
'<div class="ts-done" id="tsDone">'+
'<div class="ts-done__icon">✅</div>'+
'<div class="ts-done__text">Đã hoàn thành bài tóm tắt!</div>'+
'<div class="ts-done__sub" id="tsDoneSub"></div>'+
'</div>'+
'<button class="gh-next" id="tsNext" onclick="summaryNext()">Tiếp tục <i class="bi bi-arrow-right"></i></button>';

document.getElementById('tsNext').style.display='none';
tsPhase='reading';
tsSeconds=600; // 10 min
disableCopy();
startTsTimer();
}

function disableCopy(){
const art=document.getElementById('tsArticle');
if(art){
art.addEventListener('contextmenu',e=>e.preventDefault());
art.addEventListener('copy',e=>e.preventDefault());
art.addEventListener('cut',e=>e.preventDefault());
art.addEventListener('selectstart',e=>e.preventDefault());
}
}

function startTsTimer(){
  if(tsTimer)clearInterval(tsTimer);
  tsTimer=setInterval(()=>{
    tsSeconds--;
    if(tsSeconds<0){clearInterval(tsTimer);tsTimer=null;tsPhaseEnd();return;}
    const mins=Math.floor(tsSeconds/60);
    const secs=tsSeconds%60;
    const str=(mins<10?'0':'')+mins+':'+(secs<10?'0':'')+secs;
    if(tsPhase==='reading'){
      document.getElementById('tsDisplay').textContent=str;
      const pct=tsSeconds/600*100;
      document.getElementById('tsBarFill').style.width=Math.max(0,pct)+'%';
    }else if(tsPhase==='writing'){
      document.getElementById('tsDisplay2').textContent=str;
      const pct=tsSeconds/2100*100;
      document.getElementById('tsBarFill2').style.width=Math.max(0,pct)+'%';
    }
  },1000);
}

function skipReading(){
  if(tsPhase!=='reading')return;
  if(tsTimer){clearInterval(tsTimer);tsTimer=null}
  const art=document.getElementById('tsArticle');
  if(art)art.innerHTML='';
  document.getElementById('tsDisplay').textContent='00:00';
  document.getElementById('tsTransition').classList.add('active');
  setTimeout(()=>{
    document.getElementById('tsTransition').classList.remove('active');
    tsPhase='writing';
    document.getElementById('tsWriting').classList.add('active');
    tsSeconds=2100;
    document.getElementById('tsDisplay2').textContent='35:00';
    document.getElementById('tsBarFill2').style.width='100%';
    startTsTimer();
    document.getElementById('tsTextarea').focus();
  },1500);
}

function tsPhaseEnd(){
  if(tsPhase==='reading'){
    tsPhase='transition';
    const art=document.getElementById('tsArticle');
    if(art)art.innerHTML='';
    document.getElementById('tsDisplay').textContent='00:00';
document.getElementById('tsTransition').classList.add('active');
setTimeout(()=>{
document.getElementById('tsTransition').classList.remove('active');
tsPhase='writing';
document.getElementById('tsWriting').classList.add('active');
tsSeconds=2100; // 35 min
document.getElementById('tsDisplay2').textContent='35:00';
document.getElementById('tsBarFill2').style.width='100%';
startTsTimer();
document.getElementById('tsTextarea').focus();
},3000);
}else if(tsPhase==='writing'){
document.getElementById('tsDisplay2').textContent='00:00';
document.getElementById('tsSubmit').disabled=false;
document.getElementById('tsTextarea').disabled=true;
}
}

function onSummaryInput(){
const ta=document.getElementById('tsTextarea');
const txt=ta.value;
const chars=txt.replace(/\s/g,'').length;
const counter=document.getElementById('tsWCounter');
counter.textContent=chars+' chữ';
counter.className='ts-writing__counter'+(chars>=400?' ts-writing__counter--ok':chars>=200?' ts-writing__counter--short':'');
document.getElementById('tsSubmit').disabled=chars<50;
}

function checkSummary(){
    if(state.answered)return;
    state.answered=true;
    if(tsTimer){clearInterval(tsTimer);tsTimer=null}
    const txt=document.getElementById('tsTextarea').value;
    const chars=txt.replace(/\s/g,'').length;
    if(chars>=400)state.score+=3;
    else if(chars>=250)state.score+=2;
    else if(chars>=100)state.score+=1;
    updScore();
    document.getElementById('tsTextarea').disabled=true;
    document.getElementById('tsSubmit').disabled=true;
    document.getElementById('tsDone').classList.add('active');
    document.getElementById('tsDoneSub').textContent='Đã viết '+chars+' chữ.';
    document.getElementById('tsNext').style.display='inline-block';
    const summaryScore=Math.min(3,Math.max(0,state.score));
    fetchAPI('save_quiz_result',{quiz_type:'time_summary',level:state.level,score:summaryScore,total_questions:3,user_id:USER_ID},'POST');
}

function summaryNext(){
state.current++;
if(state.current>=state.total)showResult();
else renderSummary();
}

function nextQ(){
state.current++;
if(state.current>=state.total)showResult();
else if(state.module==='grammar')renderGrammar();
else if(state.module==='essay')renderEssay();
}

function showResult(){
document.getElementById('aaModule').classList.remove('active');
document.getElementById('aaResult').classList.add('active');
document.getElementById('aaScore').style.display='none';
const s=state.score,t=state.total,pct=t>0?Math.round(s/t*100):0;
document.getElementById('resScore').textContent=s;
document.getElementById('resTotal').textContent=t;
let icon,color,bg,msg;
if(pct>=80){icon='bi bi-trophy-fill';color='#7c3aed';bg='rgba(124,58,237,0.1)';msg='Xuất sắc! Trình độ ngữ pháp và viết luận rất tốt!';}
else if(pct>=60){icon='bi bi-emoji-smile-fill';color='#0d9488';bg='rgba(13,148,136,0.1)';msg='Làm tốt! Tiếp tục rèn luyện thêm nhé!';}
else{icon='bi bi-emoji-neutral-fill';color='#f59e0b';bg='rgba(245,158,11,0.1)';msg='Cần ôn luyện thêm. Hãy tập trung vào ngữ pháp nâng cao!';}
document.getElementById('resIcon').style.background=bg;
document.getElementById('resIcon').innerHTML='<i class="'+icon+'" style="color:'+color+';font-size:2.4rem"></i>';
document.getElementById('resMsg').textContent=msg;
if(pct>=80)spawnCF();
fetchAPI('save_quiz_result',{quiz_type:'academic_'+state.module,level:state.level,score:s,total_questions:t,user_id:USER_ID},'POST');
}

function retryMod(){
const m=state.module;
state.score=0;state.current=0;state.answered=false;
updScore();
document.getElementById('aaResult').classList.remove('active');
document.getElementById('aaModule').classList.add('active');
document.getElementById('aaScore').style.display='flex';
if(m==='grammar')startGrammar();
else if(m==='essay')startEssay();
else if(m==='summary')startSummary();
}

function spawnCF(){
const c=document.createElement('div');c.className='cf-c';document.body.appendChild(c);
const colors=['#7c3aed','#a855f7','#f59e0b','#10b981','#0d9488','#ef4444'];
for(let i=0;i<70;i++){
const p=document.createElement('div');
const s=5+Math.random()*9;
const cl=colors[Math.floor(Math.random()*colors.length)];
const l=Math.random()*100;
const d=Math.random()*2;
const du=2+Math.random()*2;
p.style.cssText='position:absolute;left:'+l+'%;top:-10px;width:'+s+'px;height:'+s*0.6+'px;background:'+cl+';border-radius:2px;animation:cf '+du+'s ease-out '+d+'s forwards;transform:rotate('+(Math.random()*720-360)+'deg)';
c.appendChild(p);
}
const s=document.createElement('style');
s.textContent='@keyframes cf{0%{transform:translateY(0) rotate(0deg);opacity:1}100%{transform:translateY(100vh) rotate(720deg);opacity:0}}';
c.appendChild(s);
setTimeout(()=>c.remove(),5000);
}
</script>

<footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Học thuật Cao cấp</p></div></div></footer>
</body>
</html>
