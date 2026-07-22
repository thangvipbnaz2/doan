<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Luyện tập cơ bản - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
.bp-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%)}

/* ===== MENU SCREEN ===== */
.bp-menu{max-width:900px;margin:0 auto}
.bp-menu__header{text-align:center;margin-bottom:40px}
.bp-menu__badge{display:inline-flex;align-items:center;gap:6px;background:rgba(13,148,136,0.1);color:#0d9488;padding:5px 16px;border-radius:50px;font-size:.82rem;font-weight:600;margin-bottom:12px}
.bp-menu__title{font-size:2.2rem;font-weight:900;color:#0f172a;margin-bottom:8px}
.bp-menu__title span{background:linear-gradient(135deg,#0d9488,#14b8a6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.bp-menu__desc{font-size:1rem;color:#64748b;max-width:500px;margin:0 auto}
.bp-menu__level{display:flex;align-items:center;gap:10px;justify-content:center;margin-bottom:24px}
.bp-menu__level label{font-weight:700;color:#0f172a;font-size:.92rem}
.bp-menu__level select{padding:8px 16px;border:2px solid #e2e8f0;border-radius:10px;font-size:.9rem;font-weight:600;background:#fff;cursor:pointer;font-family:inherit;color:#0f172a}
.bp-cards{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}
.bp-card{background:#fff;border-radius:18px;padding:28px 24px;text-align:center;cursor:pointer;transition:all .3s cubic-bezier(.16,1,.3,1);border:2px solid transparent;position:relative;overflow:hidden}
.bp-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#0d9488,#14b8a6);opacity:0;transition:opacity .3s}
.bp-card:hover{transform:translateY(-6px);box-shadow:0 12px 40px rgba(0,0,0,0.08);border-color:rgba(13,148,136,0.15)}
.bp-card:hover::before{opacity:1}
.bp-card__icon{width:64px;height:64px;border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:1.8rem}
.bp-card__icon--quiz{background:rgba(13,148,136,0.1);color:#0d9488}
.bp-card__icon--audio{background:rgba(251,146,60,0.1);color:#fb923c}
.bp-card__icon--radical{background:rgba(139,92,246,0.1);color:#8b5cf6}
.bp-card__title{font-size:1.1rem;font-weight:800;color:#0f172a;margin-bottom:6px}
.bp-card__desc{font-size:.85rem;color:#64748b;line-height:1.5;margin-bottom:12px}
.bp-card__hint{font-size:.75rem;color:#94a3b8}
.bp-card--disabled{opacity:.45;cursor:not-allowed;filter:grayscale(.7)}
.bp-card--disabled:hover{transform:none;box-shadow:none;border-color:transparent}
.bp-card--disabled:hover::before{opacity:0}

.bp-select{display:flex;align-items:center;gap:10px;justify-content:center;padding:12px 16px;background:#fff;border-radius:14px;margin-bottom:32px;border:1px solid rgba(0,0,0,0.06)}

/* ===== MODULE SCREEN ===== */
.bp-module{max-width:720px;margin:0 auto;display:none}
.bp-module.active{display:block}
.bp-module__top{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}
.bp-module__back{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:none;background:#fff;border-radius:10px;font-size:.85rem;font-weight:600;color:#64748b;cursor:pointer;transition:all .2s;font-family:inherit;border:1px solid #e2e8f0}
.bp-module__back:hover{background:#f8fafc;color:#0f172a}
.bp-module__progress{font-size:.85rem;color:#94a3b8;font-weight:600}
.bp-module__progress strong{color:#0f172a}

.bp-progress-bar{width:100%;height:4px;background:#e2e8f0;border-radius:4px;margin-bottom:32px;overflow:hidden}
.bp-progress-bar__fill{height:100%;background:linear-gradient(90deg,#0d9488,#14b8a6);border-radius:4px;transition:width .5s cubic-bezier(.16,1,.3,1)}

/* ===== QUIZ VOCAB ===== */
.qv-card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:24px}
.qv-card__hanzi{font-family:'Noto Sans SC',sans-serif;font-size:5rem;font-weight:900;color:#0f172a;line-height:1.2;margin-bottom:12px}
.qv-card__pinyin{font-size:1.3rem;color:#0d9488;font-weight:600;font-style:italic;margin-bottom:8px;min-height:1.6rem}
.qv-card__label{font-size:.85rem;color:#94a3b8;margin-bottom:6px}
.qv-options{display:grid;grid-template-columns:1fr 1fr;gap:12px;max-width:520px;margin:0 auto}
.qv-btn{padding:16px 20px;border:2px solid #e2e8f0;border-radius:14px;font-size:.95rem;font-weight:600;cursor:pointer;transition:all .25s;background:#fff;color:#0f172a;font-family:inherit;position:relative;overflow:hidden}
.qv-btn:hover:not(:disabled){border-color:#0d9488;background:rgba(13,148,136,0.04)}
.qv-btn:disabled{cursor:not-allowed}
.qv-btn--correct{border-color:#10b981!important;background:rgba(16,185,129,0.1)!important;color:#065f46!important}
.qv-btn--correct::after{content:'✓';position:absolute;top:6px;right:10px;font-size:1.2rem}
.qv-btn--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.08)!important;color:#dc2626!important}
.qv-btn--wrong::after{content:'✗';position:absolute;top:6px;right:10px;font-size:1.2rem}
.qv-btn--dim{opacity:.4}
.qv-feedback{margin-top:16px;padding:14px 20px;border-radius:12px;font-size:.9rem;font-weight:600;display:none;text-align:center;line-height:1.6}
.qv-feedback--show{display:block}
.qv-feedback--correct{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.qv-feedback--wrong{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}
.qv-next{display:none;margin:20px auto 0;padding:12px 32px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;transition:all .25s;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25)}
.qv-next:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(13,148,136,0.35)}
.qv-next.active{display:inline-block}

/* ===== AUDIO CHOICE ===== */
.ac-card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:24px}
.ac-btn{width:100px;height:100px;border-radius:50%;border:none;background:linear-gradient(135deg,#fb923c,#f97316);color:#fff;font-size:2.8rem;cursor:pointer;transition:all .3s;margin:0 auto 16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(251,146,60,0.3);position:relative;font-family:inherit}
.ac-btn:hover{transform:scale(1.05);box-shadow:0 12px 40px rgba(251,146,60,0.4)}
.ac-btn:active{transform:scale(.95)}
.ac-btn--playing{animation:pulse-glow 1.2s ease-in-out infinite}
.ac-btn--done{background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 8px 32px rgba(16,185,129,0.3)}
@keyframes pulse-glow{0%,100%{box-shadow:0 0 0 0 rgba(251,146,60,0.5)}50%{box-shadow:0 0 0 24px rgba(251,146,60,0)}}
.ac-label{font-size:.85rem;color:#94a3b8;margin-bottom:24px;min-height:1.2rem}
.ac-options{display:grid;grid-template-columns:1fr 1fr;gap:12px;max-width:520px;margin:0 auto}
.ac-btn-opt{padding:16px 20px;border:2px solid #e2e8f0;border-radius:14px;font-size:.95rem;font-weight:600;cursor:pointer;transition:all .25s;background:#fff;color:#0f172a;font-family:inherit;position:relative}
.ac-btn-opt:hover:not(:disabled){border-color:#0d9488;background:rgba(13,148,136,0.04)}
.ac-btn-opt:disabled{cursor:not-allowed}
.ac-btn-opt--correct{border-color:#10b981!important;background:rgba(16,185,129,0.1)!important;color:#065f46!important}
.ac-btn-opt--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.08)!important;color:#dc2626!important}
.ac-btn-opt--blur{opacity:.3;filter:blur(4px);pointer-events:none}
.ac-btn-opt--show{opacity:1;filter:blur(0)}
.ac-feedback{margin-top:16px;padding:14px 20px;border-radius:12px;font-size:.9rem;font-weight:600;display:none;text-align:center;line-height:1.6}
.ac-feedback--show{display:block}
.ac-feedback--correct{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.ac-feedback--wrong{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}

/* ===== RADICAL BUILDER ===== */
.rb-card{background:#fff;border-radius:24px;padding:40px 36px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:24px}
.rb-prompt{text-align:center;margin-bottom:24px}
.rb-prompt__label{font-size:.82rem;color:#94a3b8;margin-bottom:6px}
.rb-prompt__char{font-family:'Noto Sans SC',sans-serif;font-size:4rem;font-weight:900;color:#0f172a;line-height:1.2;margin-bottom:4px}
.rb-prompt__hint{font-size:.9rem;color:#64748b}
.rb-answer{display:flex;align-items:center;justify-content:center;gap:12px;min-height:80px;padding:16px;background:#f8fafc;border:2px dashed #e2e8f0;border-radius:14px;margin-bottom:20px;transition:all .3s;position:relative}
.rb-answer--over{border-color:#0d9488;background:rgba(13,148,136,0.04)}
.rb-answer__placeholder{color:#94a3b8;font-size:.9rem}
.rb-answer__part{font-family:'Noto Sans SC',sans-serif;font-size:2.8rem;font-weight:700;color:#0f172a;padding:4px 12px;background:#fff;border-radius:10px;border:1px solid #e2e8f0;cursor:pointer;transition:all .2s;position:relative}
.rb-answer__part:hover{border-color:#ef4444;color:#ef4444;background:rgba(239,68,68,0.04)}
.rb-answer__part::after{content:'✕';position:absolute;top:-8px;right:-8px;font-size:.7rem;background:#ef4444;color:#fff;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s}
.rb-answer__part:hover::after{opacity:1}
.rb-tray{display:flex;flex-wrap:wrap;gap:12px;justify-content:center;min-height:60px;padding:20px;background:#f1f5f9;border-radius:14px}
.rb-tray__part{font-family:'Noto Sans SC',sans-serif;font-size:2.4rem;font-weight:700;color:#0f172a;padding:8px 18px;background:#fff;border-radius:10px;border:1px solid #e2e8f0;cursor:grab;transition:all .2s;user-select:none}
.rb-tray__part:hover{transform:scale(1.08);box-shadow:0 4px 16px rgba(0,0,0,0.08);border-color:#0d9488}
.rb-tray__part:active{cursor:grabbing}
.rb-tray__part--used{opacity:.25;pointer-events:none}
.rb-check{display:block;margin:20px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;transition:all .25s;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25)}
.rb-check:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 6px 24px rgba(13,148,136,0.35)}
.rb-check:disabled{opacity:.4;cursor:not-allowed}
.rb-result{text-align:center;padding:20px;margin-top:16px;border-radius:14px;display:none}
.rb-result--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);display:block}
.rb-result--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);display:block}
.rb-result__text{font-size:1.1rem;font-weight:700}
.rb-result__text--success{color:#065f46}
.rb-result__text--fail{color:#dc2626}
.rb-result__correct{font-family:'Noto Sans SC',sans-serif;font-size:2rem;color:#0f172a;margin-top:4px}

/* ===== CONFETTI ===== */
.confetti-container{position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden}

/* ===== RESULT SCREEN ===== */
.bp-result{max-width:520px;margin:0 auto;display:none}
.bp-result.active{display:block}
.bp-result__card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06)}
.bp-result__icon{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2.4rem}
.bp-result__score{font-size:3.5rem;font-weight:900;line-height:1.2;margin-bottom:4px}
.bp-result__label{font-size:.9rem;color:#64748b;margin-bottom:20px}
.bp-result__message{font-size:1.05rem;color:#0f172a;font-weight:700;margin-bottom:24px;padding:14px 20px;background:#f8fafc;border-radius:12px}
.bp-result__actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.bp-result__actions .btn{min-width:140px}

/* ===== SCORE FLOATING ===== */
.bp-score{position:fixed;top:90px;right:24px;background:#fff;padding:10px 18px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08);display:flex;align-items:center;gap:10px;font-size:.9rem;border:1px solid #e2e8f0;z-index:50}
.bp-score__num{font-weight:900;color:#0d9488;font-size:1.1rem}

/* ===== RESPONSIVE ===== */
@media(max-width:640px){
.bp-menu__title{font-size:1.6rem}
.qv-card,.ac-card,.rb-card{padding:32px 20px}
.qv-card__hanzi{font-size:3.5rem}
.qv-options,.ac-options{grid-template-columns:1fr}
.bp-result__card{padding:32px 20px}
.bp-result__score{font-size:2.5rem}
}

[data-theme="dark"] .bp-page{background:#0f172a}
[data-theme="dark"] .bp-menu__title{color:#f1f5f9}
[data-theme="dark"] .bp-card{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .bp-card__title{color:#f1f5f9}
[data-theme="dark"] .bp-card__desc{color:#94a3b8}
[data-theme="dark"] .qv-card,[data-theme="dark"] .ac-card,[data-theme="dark"] .rb-card,[data-theme="dark"] .bp-result__card{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .qv-card__hanzi,[data-theme="dark"] .rb-prompt__char{color:#f1f5f9}
[data-theme="dark"] .qv-btn,[data-theme="dark"] .ac-btn-opt{background:#1e293b;border-color:#334155;color:#f1f5f9}
[data-theme="dark"] .qv-btn:hover:not(:disabled),[data-theme="dark"] .ac-btn-opt:hover:not(:disabled){border-color:#0d9488}
[data-theme="dark"] .rb-answer{background:#334155;border-color:#475569}
[data-theme="dark"] .rb-tray{background:#334155}
[data-theme="dark"] .rb-tray__part,[data-theme="dark"] .rb-answer__part{background:#1e293b;border-color:#475569;color:#f1f5f9}
[data-theme="dark"] .bp-module__back{background:#1e293b;border-color:#334155;color:#94a3b8}
[data-theme="dark"] .bp-module__back:hover{color:#f1f5f9}
[data-theme="dark"] .bp-score{background:#1e293b;border-color:#334155}
[data-theme="dark"] .bp-progress-bar{background:#334155}
[data-theme="dark"] .bp-result__message{background:#334155;color:#f1f5f9}
[data-theme="dark"] .bp-select{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .ac-label{color:#64748b}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="bp-page">
<div class="container">

<div class="bp-score" id="scoreFloat">
<i class="bi bi-star-fill" style="color:#f59e0b"></i>
Điểm: <span class="bp-score__num" id="scoreFloatNum">0</span>
</div>

<!-- MENU -->
<div class="bp-menu" id="bpMenu">
<div class="bp-menu__header">
<div class="bp-menu__badge"><i class="bi bi-pencil-square"></i> Luyện tập cơ bản</div>
<h1 class="bp-menu__title">Chọn dạng bài <span>luyện tập</span></h1>
<p class="bp-menu__desc">Ôn luyện từ vựng, nghe hiểu và ghép bộ thủ cho trình độ cơ bản</p>
</div>

<div class="bp-select">
<label><i class="bi bi-bar-chart"></i> Cấp độ:</label>
<select id="bpLevel" onchange="onLevelChange()">
<option value="1">HSK 1</option>
<option value="2">HSK 2</option>
<option value="3">HSK 3</option>
</select>
</div>

<div class="bp-cards">
<div class="bp-card" onclick="startModule('quiz')" id="bpCardQuiz">
<div class="bp-card__icon bp-card__icon--quiz"><i class="bi bi-patch-question-fill"></i></div>
<div class="bp-card__title">Trắc nghiệm từ vựng</div>
<div class="bp-card__desc">Chọn nghĩa đúng của chữ Hán hiển thị</div>
<div class="bp-card__hint" id="bpHintQuiz">HSK 1-2: có pinyin • HSK 3: ẩn pinyin</div>
</div>

<div class="bp-card" onclick="startModule('audio')" id="bpCardAudio">
<div class="bp-card__icon bp-card__icon--audio"><i class="bi bi-headphones"></i></div>
<div class="bp-card__title">Nghe và chọn</div>
<div class="bp-card__desc">Nghe phát âm và chọn đáp án đúng</div>
<div class="bp-card__hint">Bắt buộc nghe hết mới được chọn</div>
</div>

<div class="bp-card" onclick="startModule('radical')" id="bpCardRadical">
<div class="bp-card__icon bp-card__icon--radical"><i class="bi bi-puzzle-fill"></i></div>
<div class="bp-card__title">Ghép bộ thủ</div>
<div class="bp-card__desc">Kéo các bộ thủ vào khung để tạo thành chữ</div>
<div class="bp-card__hint" id="bpHintRadical">HSK 1-2 • Kéo & thả</div>
</div>
</div>
</div>

<!-- MODULE -->
<div class="bp-module" id="bpModule">
<div class="bp-module__top">
<button class="bp-module__back" onclick="backToMenu()"><i class="bi bi-arrow-left"></i> Quay lại</button>
<span class="bp-module__progress" id="moduleProgress">Câu <strong>1</strong>/<span id="totalQ">10</span></span>
</div>
<div class="bp-progress-bar"><div class="bp-progress-bar__fill" id="progressFill" style="width:0%"></div></div>
<div id="moduleArea"></div>
</div>

<!-- RESULT -->
<div class="bp-result" id="bpResult">
<div class="bp-result__card">
<div class="bp-result__icon" id="resultIcon" style="background:rgba(16,185,129,0.1)"><i class="bi bi-trophy-fill" style="color:#10b981;font-size:2.4rem"></i></div>
<div class="bp-result__score" id="resultScore">0</div>
<div class="bp-result__label">/ <span id="resultTotal">0</span> câu đúng</div>
<div class="bp-result__message" id="resultMsg">Tuyệt vời!</div>
<div class="bp-result__actions">
<button class="btn btn--primary ripple" onclick="retryModule()"><i class="bi bi-arrow-repeat"></i> Làm lại</button>
<button class="btn btn--outline ripple" onclick="backToMenu()"><i class="bi bi-grid"></i> Chọn dạng khác</button>
</div>
</div>
</div>

</div>
</main>

<script>
const API_URL = 'api.php';
const USER_ID = localStorage.getItem('hanngu_user_id') || 'default_user';
const fallbackVocab = [
{id:1,hanzi:'你好',pinyin:'nǐ hǎo',meaning:'Xin chào',level:1},
{id:2,hanzi:'谢谢',pinyin:'xièxie',meaning:'Cảm ơn',level:1},
{id:3,hanzi:'再见',pinyin:'zàijiàn',meaning:'Tạm biệt',level:1},
{id:4,hanzi:'对不起',pinyin:'duìbuqǐ',meaning:'Xin lỗi',level:1},
{id:5,hanzi:'没关系',pinyin:'méiguānxi',meaning:'Không sao',level:1},
{id:6,hanzi:'好',pinyin:'hǎo',meaning:'Tốt',level:1},
{id:7,hanzi:'大',pinyin:'dà',meaning:'To lớn',level:1},
{id:8,hanzi:'小',pinyin:'xiǎo',meaning:'Nhỏ',level:1},
{id:9,hanzi:'人',pinyin:'rén',meaning:'Người',level:1},
{id:10,hanzi:'山',pinyin:'shān',meaning:'Núi',level:1},
{id:11,hanzi:'水',pinyin:'shuǐ',meaning:'Nước',level:1},
{id:12,hanzi:'火',pinyin:'huǒ',meaning:'Lửa',level:1},
{id:13,hanzi:'我',pinyin:'wǒ',meaning:'Tôi',level:1},
{id:14,hanzi:'是',pinyin:'shì',meaning:'Là',level:1},
{id:15,hanzi:'学',pinyin:'xué',meaning:'Học',level:1},
{id:16,hanzi:'老师',pinyin:'lǎoshī',meaning:'Giáo viên',level:2},
{id:17,hanzi:'学生',pinyin:'xuésheng',meaning:'Học sinh',level:2},
{id:18,hanzi:'朋友',pinyin:'péngyou',meaning:'Bạn bè',level:2},
{id:19,hanzi:'学校',pinyin:'xuéxiào',meaning:'Trường học',level:2},
{id:20,hanzi:'医院',pinyin:'yīyuàn',meaning:'Bệnh viện',level:2},
{id:21,hanzi:'商店',pinyin:'shāngdiàn',meaning:'Cửa hàng',level:2},
{id:22,hanzi:'多少钱',pinyin:'duōshao qián',meaning:'Bao nhiêu tiền',level:2},
{id:23,hanzi:'苹果',pinyin:'píngguǒ',meaning:'Táo',level:2},
{id:24,hanzi:'香蕉',pinyin:'xiāngjiāo',meaning:'Chuối',level:2},
{id:25,hanzi:'咖啡',pinyin:'kāfēi',meaning:'Cà phê',level:2},
{id:26,hanzi:'电视',pinyin:'diànshì',meaning:'Tivi',level:3},
{id:27,hanzi:'电脑',pinyin:'diànnǎo',meaning:'Máy tính',level:3},
{id:28,hanzi:'电影',pinyin:'diànyǐng',meaning:'Phim',level:3},
{id:29,hanzi:'天气',pinyin:'tiānqì',meaning:'Thời tiết',level:3},
{id:30,hanzi:'游泳',pinyin:'yóuyǒng',meaning:'Bơi lội',level:3},
{id:31,hanzi:'唱歌',pinyin:'chànggē',meaning:'Hát',level:3},
{id:32,hanzi:'跑步',pinyin:'pǎobù',meaning:'Chạy bộ',level:3},
{id:33,hanzi:'用',pinyin:'yòng',meaning:'Dùng',level:1},
{id:34,hanzi:'名字',pinyin:'míngzi',meaning:'Tên',level:1},
{id:35,hanzi:'中国',pinyin:'zhōngguó',meaning:'Trung Quốc',level:1},
{id:36,hanzi:'快乐',pinyin:'kuàilè',meaning:'Vui vẻ',level:2},
{id:37,hanzi:'生日',pinyin:'shēngrì',meaning:'Sinh nhật',level:2},
{id:38,hanzi:'蛋糕',pinyin:'dàngāo',meaning:'Bánh ngọt',level:3},
{id:39,hanzi:'礼物',pinyin:'lǐwù',meaning:'Quà tặng',level:3},
{id:40,hanzi:'运动',pinyin:'yùndòng',meaning:'Vận động',level:3},
];

const radicalQuestions = [
{target:'好',parts:['女','子'],hint:'Nữ + Tử'},
{target:'明',parts:['日','月'],hint:'Nhật + Nguyệt'},
{target:'林',parts:['木','木'],hint:'Mộc + Mộc'},
{target:'休',parts:['亻','木'],hint:'Nhân đứng + Mộc'},
{target:'你',parts:['亻','尔'],hint:'Nhân đứng + Nhĩ'},
{target:'他',parts:['亻','也'],hint:'Nhân đứng + Dã'},
{target:'字',parts:['宀','子'],hint:'Miên + Tử'},
{target:'早',parts:['日','十'],hint:'Nhật + Thập'},
{target:'男',parts:['田','力'],hint:'Điền + Lực'},
{target:'安',parts:['宀','女'],hint:'Miên + Nữ'},
{target:'全',parts:['人','王'],hint:'Nhân + Vương'},
{target:'音',parts:['立','日'],hint:'Lập + Nhật'},
{target:'加',parts:['力','口'],hint:'Lực + Khẩu'},
{target:'对',parts:['又','寸'],hint:'Hựu + Thốn'},
{target:'红',parts:['纟','工'],hint:'Mịch + Công'},
{target:'花',parts:['艹','化'],hint:'Thảo + Hóa'},
{target:'草',parts:['艹','早'],hint:'Thảo + Tảo'},
{target:'笔',parts:['⺮','毛'],hint:'Trúc + Mao'},
{target:'笑',parts:['⺮','夭'],hint:'Trúc + Yểu'},
];

let state = {
module:'',score:0,current:0,questions:[],total:0,level:1,answered:false
};
let audioTimer = null;
let audioCtx = null;

async function fetchAPI(action,data,method){
try{
let url=API_URL+'?action='+action;
let opts={method,headers:{'Content-Type':'application/json'}};
if(method==='GET'&&data)url+='&'+new URLSearchParams(data).toString();
else if(data)opts.body=JSON.stringify(data);
return await(await fetch(url,opts)).json();
}catch(e){showToast('Lỗi kết nối!','error');return null}
}

async function loadVocab(level){
let data=await fetchAPI('get_vocab',{level:level||0,user_id:USER_ID});
let list=data&&data.length>0?data:fallbackVocab;
if(level>0)list=list.filter(v=>v.level==level);
return list.length>0?list:fallbackVocab.filter(v=>v.level==level);
}

function shuffle(a){const c=[...a];for(let i=c.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[c[i],c[j]]=[c[j],c[i]]}return c}

function escapeHtml(t){if(!t)return'';const d=document.createElement('div');d.textContent=t;return d.innerHTML}

function onLevelChange(){
const l=parseInt(document.getElementById('bpLevel').value);
state.level=l;
const radicalCard=document.getElementById('bpCardRadical');
const hint=document.getElementById('bpHintRadical');
const quizHint=document.getElementById('bpHintQuiz');
if(l<=2){
radicalCard.classList.remove('bp-card--disabled');
radicalCard.onclick=function(){startModule('radical')};
hint.textContent='HSK 1-2 • Kéo & thả';
quizHint.textContent='HSK 1-2: có pinyin • HSK 3: ẩn pinyin';
}else{
radicalCard.classList.add('bp-card--disabled');
radicalCard.onclick=null;
hint.textContent='Chỉ dành cho HSK 1-2';
quizHint.textContent='HSK 3: ẩn pinyin';
}
}
onLevelChange();

function updateScore(){document.getElementById('scoreFloatNum').textContent=state.score}

function backToMenu(){
document.getElementById('bpMenu').style.display='block';
document.getElementById('bpModule').classList.remove('active');
document.getElementById('bpResult').classList.remove('active');
document.getElementById('scoreFloat').style.display='flex';
}

function startModule(type){
    state.module=type;
    state.score=0;
    state.current=0;
    state.answered=false;
    updateScore();
    document.getElementById('scoreFloat').style.display='flex';
    document.getElementById('bpMenu').style.display='none';
    document.getElementById('bpResult').classList.remove('active');
    document.getElementById('bpModule').classList.add('active');
    loadQuestions(type);
}

async function loadQuestions(type){
const area=document.getElementById('moduleArea');
area.innerHTML='<div style="text-align:center;padding:60px"><div class="spinner"></div><p style="margin-top:16px;color:#94a3b8">Đang chuẩn bị câu hỏi...</p></div>';

if(type==='radical'){
state.questions=shuffle(radicalQuestions).slice(0,10);
state.total=state.questions.length;
renderQuestion();
return;
}

const v=await loadVocab(state.level);
if(v.length<4){area.innerHTML='<div style="text-align:center;padding:60px;color:#94a3b8">Cần ít nhất 4 từ vựng.</div>';return}
const pool=shuffle(v);
const count=Math.min(10,pool.length);
const qs=[];
for(let i=0;i<count;i++){
const vocab=pool[i];
const opts=generateOpts(vocab,pool);
qs.push({vocab,options:opts});
}
state.questions=qs;
state.total=qs.length;
renderQuestion();
}

function generateOpts(correct,pool){
const seen=new Set([correct.meaning]);
const opts=[correct.meaning];
const sh=shuffle(pool);
for(const v of sh){
if(opts.length>=4)break;
if(!seen.has(v.meaning)){opts.push(v.meaning);seen.add(v.meaning)}
}
return shuffle(opts);
}

function updateProgress(){
const idx=state.current+1;
const total=state.total;
document.querySelector('#moduleProgress strong').textContent=idx;
document.getElementById('totalQ').textContent=total;
document.getElementById('progressFill').style.width=(idx/total*100)+'%';
}

function renderQuestion(){
state.answered=false;
updateProgress();
const area=document.getElementById('moduleArea');
if(state.module==='quiz')renderQuiz(area);
else if(state.module==='audio')renderAudio(area);
else if(state.module==='radical')renderRadical(area);
}

// ===== QUIZ VOCAB =====
function renderQuiz(area){
const q=state.questions[state.current];
const v=q.vocab;
const showPinyin=state.level<=2;
area.innerHTML=
'<div class="qv-card">'+
'<div class="qv-card__label">Chọn nghĩa đúng của chữ Hán:</div>'+
'<div class="qv-card__hanzi">'+escapeHtml(v.hanzi)+'</div>'+
'<div class="qv-card__pinyin"'+(showPinyin?'':' style="visibility:hidden"')+'>'+escapeHtml(v.pinyin)+'</div>'+
'</div>'+
'<div class="qv-options">'+
  q.options.map(o=>'<button class="qv-btn" data-val="'+escapeHtml(o)+'" onclick="quizPick(this)">'+escapeHtml(o)+'</button>').join('')+
  '</div>'+
  '<div class="qv-feedback" id="qvFeedback"></div>'+
  '<button class="qv-next" id="qvNext" onclick="nextQuestion()">Tiếp tục <i class="bi bi-arrow-right"></i></button>';
}

function quizPick(btn){
if(state.answered)return;
const q=state.questions[state.current];
const correct=q.vocab.meaning;
const picked=btn.dataset.val;
const isCorrect=picked===correct;
state.answered=true;
document.querySelectorAll('.qv-btn').forEach(b=>{
  b.disabled=true;
  if(b.dataset.val===correct)b.classList.add('qv-btn--correct');
  else if(b.dataset.val===picked&&!isCorrect)b.classList.add('qv-btn--wrong');
  else b.classList.add('qv-btn--dim');
});
if(isCorrect)state.score++;
updateScore();
const fb=document.getElementById('qvFeedback');
fb.className='qv-feedback qv-feedback--show '+(isCorrect?'qv-feedback--correct':'qv-feedback--wrong');
fb.innerHTML=isCorrect
  ?'<i class="bi bi-check-circle-fill"></i> Đúng! <strong>'+escapeHtml(q.vocab.hanzi)+'</strong> — '+escapeHtml(q.vocab.meaning)+' <span style="font-style:italic;opacity:.7">('+escapeHtml(q.vocab.pinyin)+')</span>'
  :'<i class="bi bi-x-circle-fill"></i> Sai! Đáp án đúng: <strong>'+escapeHtml(q.vocab.meaning)+'</strong> <span style="font-style:italic;opacity:.7">('+escapeHtml(q.vocab.pinyin)+')</span>';
document.getElementById('qvNext').classList.add('active');
}

// ===== AUDIO CHOICE =====
function renderAudio(area){
const q=state.questions[state.current];
const v=q.vocab;
area.innerHTML=
'<div class="ac-card">'+
'<button class="ac-btn" id="acPlayBtn" onclick="playAudio()"><i class="bi bi-volume-up-fill"></i></button>'+
'<div class="ac-label" id="acLabel">Nhấn nút để nghe phát âm</div>'+
'</div>'+
'<div class="ac-options" id="acOptions">'+
  q.options.map(o=>'<button class="ac-btn-opt ac-btn-opt--blur" data-val="'+escapeHtml(o)+'" onclick="audioPick(this)">'+escapeHtml(o)+'</button>').join('')+
  '</div>'+
  '<div class="ac-feedback" id="acFeedback"></div>'+
  '<button class="qv-next" id="acNext" onclick="nextQuestion()">Tiếp tục <i class="bi bi-arrow-right"></i></button>';
setTimeout(()=>playAudio(),400);
}

let audioUnlocked=false;
function playAudio(){
const btn=document.getElementById('acPlayBtn');
if(!btn)return;
btn.classList.add('ac-btn--playing');
document.getElementById('acLabel').textContent='Đang phát...';
const q=state.questions[state.current];
const text=q.vocab.hanzi;
if('speechSynthesis'in window){
window.speechSynthesis.cancel();
const u=new SpeechSynthesisUtterance(text);
u.lang='zh-CN';
u.rate=0.75;
u.onstart=()=>{audioUnlocked=false};
u.onend=()=>{
btn.classList.remove('ac-btn--playing');
btn.classList.add('ac-btn--done');
document.getElementById('acLabel').textContent='Đã nghe xong! Chọn đáp án.';
audioUnlocked=true;
document.querySelectorAll('.ac-btn-opt').forEach(b=>{
b.classList.remove('ac-btn-opt--blur');
b.classList.add('ac-btn-opt--show');
});
};
u.onerror=()=>{audioUnlocked=true;forceUnlock();};
speechSynthesis.speak(u);
}else{
forceUnlock();
}
}
function forceUnlock(){
audioUnlocked=true;
document.getElementById('acLabel').textContent='Chọn đáp án:';
document.querySelectorAll('.ac-btn-opt').forEach(b=>{
b.classList.remove('ac-btn-opt--blur');
b.classList.add('ac-btn-opt--show');
});
}

function audioPick(btn){
if(state.answered)return;
if(!audioUnlocked){
showToast('Hãy nghe hết audio trước!','warning',2000);
btn.blur();
return;
}
const q=state.questions[state.current];
const correct=q.vocab.meaning;
  const pickeds=btn.dataset.val;
  const isCorrect=picked===correct;
  state.answered=true;
  document.querySelectorAll('.ac-btn-opt').forEach(b=>{
    b.disabled=true;
    if(b.dataset.val===correct)b.classList.add('ac-btn-opt--correct');
    else if(b.dataset.val===picked&&!isCorrect)b.classList.add('ac-btn-opt--wrong');
  });
  if(isCorrect)state.score++;
  updateScore();
  const fb=document.getElementById('acFeedback');
  fb.className='ac-feedback ac-feedback--show '+(isCorrect?'ac-feedback--correct':'ac-feedback--wrong');
  fb.innerHTML=isCorrect
    ?'<i class="bi bi-check-circle-fill"></i> Đúng! <strong>'+escapeHtml(q.vocab.hanzi)+'</strong> — '+escapeHtml(q.vocab.meaning)+' <span style="font-style:italic;opacity:.7">('+escapeHtml(q.vocab.pinyin)+')</span>'
    :'<i class="bi bi-x-circle-fill"></i> Sai! Đáp án đúng: <strong>'+escapeHtml(q.vocab.meaning)+'</strong> <span style="font-style:italic;opacity:.7">('+escapeHtml(q.vocab.pinyin)+')</span>';
  document.getElementById('acNext').classList.add('active');
}

// ===== RADICAL BUILDER =====
function renderRadical(area){
const q=state.questions[state.current];
area.innerHTML=
'<div class="rb-card">'+
'<div class="rb-prompt">'+
'<div class="rb-prompt__label">Hãy ghép các bộ thủ để tạo thành chữ này:</div>'+
'<div class="rb-prompt__char">'+q.target+'</div>'+
'<div class="rb-prompt__hint">Gợi ý: '+q.hint+'</div>'+
'</div>'+
'<div class="rb-answer" id="rbAnswer"><span class="rb-answer__placeholder">Kéo bộ thủ vào đây</span></div>'+
'<div class="rb-tray" id="rbTray">'+
shuffle(q.parts).map(p=>'<span class="rb-tray__part" draggable="true" onclick="rbClickPart(this)">'+p+'</span>').join('')+
'</div>'+
'<button class="rb-check" id="rbCheck" onclick="rbCheck()" disabled>Kiểm tra</button>'+
'<div class="rb-result" id="rbResult"></div>'+
'</div>'+
'<button class="qv-next" id="rbNext" onclick="nextQuestion()" style="display:inline-block">Tiếp tục <i class="bi bi-arrow-right"></i></button>';
document.getElementById('rbNext').style.display='none';
setupDragDrop();
}

function rbClickPart(el){
if(state.answered)return;
const answer=document.getElementById('rbAnswer');
const tray=document.getElementById('rbTray');
const isInAnswer=answer.contains(el);
if(isInAnswer){
tray.appendChild(el);
el.classList.remove('rb-tray__part--used');
}else{
const q=state.questions[state.current];
const currentParts=answer.querySelectorAll('.rb-tray__part');
if(currentParts.length<q.parts.length){
el.classList.add('rb-tray__part--used');
answer.appendChild(el);
}
}
updateRbPlaceholder();
updateRbCheckBtn();
}

function setupDragDrop(){
document.querySelectorAll('.rb-tray__part').forEach(el=>{
el.addEventListener('dragstart',function(e){
if(state.answered){e.preventDefault();return}
e.dataTransfer.setData('text/plain','');
this.classList.add('dragging');
});
el.addEventListener('dragend',function(){this.classList.remove('dragging')});
});
const answer=document.getElementById('rbAnswer');
answer.addEventListener('dragover',function(e){e.preventDefault();this.classList.add('rb-answer--over')});
answer.addEventListener('dragleave',function(){this.classList.remove('rb-answer--over')});
answer.addEventListener('drop',function(e){
e.preventDefault();
this.classList.remove('rb-answer--over');
if(state.answered)return;
const dragged=document.querySelector('.rb-tray__part.dragging');
if(dragged&&dragged.parentElement!==this){
const q=state.questions[state.current];
const currentParts=this.querySelectorAll('.rb-tray__part');
if(currentParts.length<q.parts.length){
dragged.classList.add('rb-tray__part--used');
this.appendChild(dragged);
updateRbPlaceholder();
updateRbCheckBtn();
}
}
});
const tray=document.getElementById('rbTray');
tray.addEventListener('dragover',function(e){e.preventDefault();this.classList.add('rb-answer--over')});
tray.addEventListener('dragleave',function(){this.classList.remove('rb-answer--over')});
tray.addEventListener('drop',function(e){
e.preventDefault();
this.classList.remove('rb-answer--over');
const dragged=document.querySelector('.rb-tray__part.dragging');
if(dragged&&dragged.parentElement!==this){
this.appendChild(dragged);
dragged.classList.remove('rb-tray__part--used');
updateRbPlaceholder();
updateRbCheckBtn();
}
});
}

function updateRbPlaceholder(){
const answer=document.getElementById('rbAnswer');
const placeholder=answer.querySelector('.rb-answer__placeholder');
if(placeholder){
placeholder.style.display=answer.querySelectorAll('.rb-tray__part').length?'none':'';
}
}

function updateRbCheckBtn(){
const answer=document.getElementById('rbAnswer');
const btn=document.getElementById('rbCheck');
const parts=answer.querySelectorAll('.rb-tray__part');
btn.disabled=parts.length===0;
}

function rbCheck(){
if(state.answered)return;
const q=state.questions[state.current];
const answer=document.getElementById('rbAnswer');
const parts=Array.from(answer.querySelectorAll('.rb-tray__part')).map(el=>el.textContent);
const result=document.getElementById('rbResult');
const btn=document.getElementById('rbCheck');
const nextBtn=document.getElementById('rbNext');
const isCorrect=parts.join('')===q.target;
state.answered=true;
if(isCorrect){
state.score++;
updateScore();
result.className='rb-result rb-result--success';
result.innerHTML='<div class="rb-result__text rb-result__text--success"><i class="bi bi-check-circle-fill"></i> Chính xác! Bạn đã ghép đúng chữ <strong>'+q.target+'</strong></div>';
spawnConfetti();
nextBtn.style.display='inline-block';
btn.disabled=true;
}else{
result.className='rb-result rb-result--fail';
result.innerHTML='<div class="rb-result__text rb-result__text--fail"><i class="bi bi-x-circle-fill"></i> Chưa đúng. Hãy thử lại!</div>';
nextBtn.style.display='none';
btn.disabled=false;
state.answered=false;
document.querySelectorAll('.rb-tray__part').forEach(el=>{
if(el.parentElement===answer){
document.getElementById('rbTray').appendChild(el);
el.classList.remove('rb-tray__part--used');
}
});
updateRbPlaceholder();
}
}

function spawnConfetti(){
const c=document.createElement('div');
c.className='confetti-container';
document.body.appendChild(c);
const colors=['#0d9488','#f59e0b','#ef4444','#8b5cf6','#10b981','#fb923c','#3b82f6'];
for(let i=0;i<80;i++){
const p=document.createElement('div');
const size=6+Math.random()*8;
const color=colors[Math.floor(Math.random()*colors.length)];
const left=Math.random()*100;
const delay=Math.random()*2;
const dur=2+Math.random()*2;
const rot=Math.random()*720-360;
p.style.cssText='position:absolute;left:'+left+'%;top:-10px;width:'+size+'px;height:'+size*0.6+'px;background:'+color+';border-radius:2px;animation:confettiFall '+dur+'s ease-out '+delay+'s forwards;transform:rotate('+rot+'deg)';
c.appendChild(p);
}
const style=document.createElement('style');
style.textContent='@keyframes confettiFall{0%{transform:translateY(0) rotate(0deg);opacity:1}100%{transform:translateY(100vh) rotate(720deg);opacity:0}}';
c.appendChild(style);
setTimeout(()=>c.remove(),5000);
}

// ===== NAVIGATION =====
function nextQuestion(){
state.current++;
if(state.current>=state.total){
showResult();
}else{
renderQuestion();
}
}

function showResult(){
document.getElementById('bpModule').classList.remove('active');
document.getElementById('bpResult').classList.add('active');
document.getElementById('scoreFloat').style.display='none';
const s=state.score;
const t=state.total;
const pct=Math.round(s/t*100);
document.getElementById('resultScore').textContent=s;
document.getElementById('resultTotal').textContent=t;
let icon,color,msg;
if(pct>=90){icon='bi bi-trophy-fill';color='#f59e0b';bg='rgba(245,158,11,0.1)';msg='Tuyệt vời! Bạn làm rất tốt!';}
else if(pct>=70){icon='bi bi-emoji-smile-fill';color='#10b981';bg='rgba(16,185,129,0.1)';msg='Làm tốt lắm! Tiếp tục cố gắng nhé!';}
else if(pct>=50){icon='bi bi-emoji-neutral-fill';color='#3b82f6';bg='rgba(59,130,246,0.1)';msg='Khá lắm! Hãy ôn lại thêm nhé!';}
else{icon='bi bi-emoji-frown-fill';color='#ef4444';bg='rgba(239,68,68,0.1)';msg='Cần ôn lại bài nhiều hơn. Bạn có thể làm lại!';}
document.getElementById('resultIcon').style.background=bg;
document.getElementById('resultIcon').innerHTML='<i class="'+icon+'" style="color:'+color+';font-size:2.4rem"></i>';
document.getElementById('resultMsg').textContent=msg;
if(pct>=90)spawnConfetti();
fetchAPI('save_quiz_result',{quiz_type:'basic_'+state.module,level:state.level,score:s,total_questions:t,user_id:USER_ID},'POST');
}

function retryModule(){
const type=state.module;
state.score=0;
state.current=0;
state.answered=false;
updateScore();
document.getElementById('bpResult').classList.remove('active');
document.getElementById('bpModule').classList.add('active');
document.getElementById('scoreFloat').style.display='flex';
loadQuestions(type);
}

document.getElementById('scoreFloat').style.display='none';
</script>

<footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Luyện tập cơ bản</p></div></div></footer>
</body>
</html>
