<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đọc hiểu & Ngữ cảnh - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
.rc-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%)}

/* ===== MENU ===== */
.rc-menu{max-width:700px;margin:0 auto;text-align:center}
.rc-menu__badge{display:inline-flex;align-items:center;gap:6px;background:rgba(245,158,11,0.1);color:#d97706;padding:5px 16px;border-radius:50px;font-size:.82rem;font-weight:600;margin-bottom:12px}
.rc-menu__title{font-size:2rem;font-weight:900;color:#0f172a;margin-bottom:8px}
.rc-menu__title span{background:linear-gradient(135deg,#d97706,#f59e0b);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.rc-menu__desc{font-size:.95rem;color:#64748b;margin-bottom:28px}
.rc-menu__level{display:flex;align-items:center;gap:12px;justify-content:center;margin-bottom:32px}
.rc-menu__level select{padding:10px 20px;border:2px solid #e2e8f0;border-radius:12px;font-size:.95rem;font-weight:600;font-family:inherit;background:#fff;color:#0f172a;cursor:pointer}
.rc-cards{display:grid;grid-template-columns:1fr 1fr;gap:16px;max-width:560px;margin:0 auto}
.rc-card{background:#fff;border-radius:18px;padding:28px 20px;text-align:center;cursor:pointer;transition:all .3s cubic-bezier(.16,1,.3,1);border:2px solid transparent;position:relative;overflow:hidden}
.rc-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;opacity:0;transition:opacity .3s}
.rc-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,0.07)}
.rc-card--cloze::before{background:linear-gradient(90deg,#d97706,#f59e0b)}
.rc-card--cloze:hover{border-color:rgba(217,119,6,0.15)}
.rc-card--cloze:hover::before{opacity:1}
.rc-card--syn::before{background:linear-gradient(90deg,#0d9488,#14b8a6)}
.rc-card--syn:hover{border-color:rgba(13,148,136,0.15)}
.rc-card--syn:hover::before{opacity:1}
.rc-card__icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:1.5rem}
.rc-card__icon--cloze{background:rgba(217,119,6,0.1);color:#d97706}
.rc-card__icon--syn{background:rgba(13,148,136,0.1);color:#0d9488}
.rc-card__title{font-size:1rem;font-weight:800;color:#0f172a;margin-bottom:4px}
.rc-card__desc{font-size:.8rem;color:#64748b;line-height:1.5}
@media(max-width:560px){.rc-cards{grid-template-columns:1fr}}

/* ===== MODULE ===== */
.rc-module{max-width:720px;margin:0 auto;display:none}
.rc-module.active{display:block}
.rc-module__top{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;flex-wrap:wrap;gap:10px}
.rc-module__back{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:none;background:#fff;border-radius:10px;font-size:.85rem;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit;border:1px solid #e2e8f0;transition:all .2s}
.rc-module__back:hover{background:#f8fafc;color:#0f172a}
.rc-module__info{font-size:.85rem;color:#94a3b8;font-weight:600}
.rc-progress{font-size:.85rem;color:#94a3b8;font-weight:600;text-align:right}
.rc-progress strong{color:#0f172a}
.rc-progress-bar{width:100%;height:4px;background:#e2e8f0;border-radius:4px;margin-bottom:24px;overflow:hidden}
.rc-progress-bar__fill{height:100%;background:linear-gradient(90deg,#d97706,#f59e0b);border-radius:4px;transition:width .5s cubic-bezier(.16,1,.3,1)}

/* ===== SCORE ===== */
.rc-score{position:fixed;top:90px;right:24px;background:#fff;padding:10px 18px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08);display:flex;align-items:center;gap:10px;font-size:.9rem;border:1px solid #e2e8f0;z-index:50}
.rc-score__num{font-weight:900;font-size:1.1rem}
.rc-score--cloze .rc-score__num{color:#d97706}
.rc-score--syn .rc-score__num{color:#0d9488}

/* ===== CLOZE ===== */
.cloze-card{background:#fff;border-radius:24px;padding:40px 36px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}
.cloze-card__label{font-size:.82rem;color:#94a3b8;margin-bottom:16px;text-align:center}
.cloze-card__passage{font-family:'Noto Sans SC',sans-serif;font-size:1.2rem;font-weight:500;color:#0f172a;line-height:2.2;padding:20px;background:#f8fafc;border-radius:14px;border:1px solid #f1f5f9;margin-bottom:20px}
.cloze-blank{display:inline-block;min-width:100px;padding:2px 8px;border-bottom:2.5px dashed #d97706;margin:0 2px;cursor:pointer;text-align:center;font-weight:700;font-size:1.1rem;color:#d97706;transition:all .2s;position:relative;border-radius:4px 4px 0 0}
.cloze-blank:hover{background:rgba(217,119,6,0.06);border-bottom-color:#f59e0b}
.cloze-blank--filled{background:rgba(217,119,6,0.08);border-bottom-style:solid;border-bottom-color:#d97706;color:#92400e}
.cloze-blank--correct{border-bottom-color:#10b981!important;color:#065f46!important;background:rgba(16,185,129,0.08)!important}
.cloze-blank--wrong{border-bottom-color:#ef4444!important;color:#dc2626!important;background:rgba(239,68,68,0.06)!important}

/* Blank popup */
.cloze-popup{position:absolute;top:calc(100% + 8px);left:50%;transform:translateX(-50%);background:#fff;border-radius:14px;box-shadow:0 8px 32px rgba(0,0,0,0.15);padding:10px;z-index:100;min-width:200px;border:1px solid #f1f5f9;display:none}
.cloze-popup--open{display:block}
.cloze-popup::before{content:'';position:absolute;top:-6px;left:50%;transform:translateX(-50%);width:12px;height:12px;background:#fff;border-left:1px solid #f1f5f9;border-top:1px solid #f1f5f9;transform:translateX(-50%) rotate(45deg)}
.cloze-popup__item{display:block;width:100%;padding:8px 14px;border:none;background:transparent;cursor:pointer;font-family:'Noto Sans SC',sans-serif;font-size:1rem;font-weight:500;color:#0f172a;border-radius:8px;transition:all .15s;text-align:left}
.cloze-popup__item:hover{background:#f8fafc;color:#d97706}
.cloze-popup__item:not(:last-child){margin-bottom:2px}

.cloze-actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}
.cloze-submit{padding:14px 40px;border:none;background:linear-gradient(135deg,#d97706,#f59e0b);color:#fff;border-radius:14px;font-size:1rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(217,119,6,0.25);transition:all .3s}
.cloze-submit:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 6px 24px rgba(217,119,6,0.35)}
.cloze-submit:disabled{opacity:.4;cursor:not-allowed}
.cloze-submit--retry{background:linear-gradient(135deg,#0d9488,#14b8a6);box-shadow:0 4px 16px rgba(13,148,136,0.25)}

.cloze-feedback{text-align:center;padding:16px 20px;border-radius:14px;margin-top:16px;display:none;font-weight:700;font-size:.95rem}
.cloze-feedback--show{display:block}
.cloze-feedback--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.cloze-feedback--partial{background:rgba(245,158,11,0.1);border:1px solid rgba(245,158,11,0.2);color:#92400e}
.cloze-feedback--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}

.cloze-next{display:none;margin:16px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.cloze-next:hover{transform:translateY(-2px)}
.cloze-next.active{display:inline-block}

/* ===== SYNONYM ===== */
.syn-card{background:#fff;border-radius:24px;padding:40px 36px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}
.syn-card__label{font-size:.82rem;color:#94a3b8;margin-bottom:16px;text-align:center}
.syn-sentence{font-family:'Noto Sans SC',sans-serif;font-size:1.2rem;font-weight:500;color:#0f172a;line-height:2;padding:24px;background:#f8fafc;border-radius:14px;border:1px solid #f1f5f9;margin-bottom:24px;text-align:center}
.syn-sentence__underline{text-decoration:underline;text-decoration-color:#0d9488;text-decoration-thickness:3px;text-underline-offset:4px;font-weight:800;color:#0d9488}
.syn-context{font-size:.85rem;color:#94a3b8;text-align:center;margin-bottom:20px}
.syn-options{display:grid;grid-template-columns:1fr 1fr;gap:12px;max-width:480px;margin:0 auto}
.syn-btn{padding:14px 20px;border:2px solid #e2e8f0;border-radius:14px;font-family:'Noto Sans SC',sans-serif;font-size:1rem;font-weight:600;cursor:pointer;transition:all .25s;background:#fff;color:#0f172a;position:relative}
.syn-btn:hover:not(:disabled){border-color:#0d9488;background:rgba(13,148,136,0.04)}
.syn-btn:disabled{cursor:not-allowed}
.syn-btn--correct{border-color:#10b981!important;background:rgba(16,185,129,0.1)!important;color:#065f46!important}
.syn-btn--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.08)!important;color:#dc2626!important}
.syn-btn--dim{opacity:.4}

.syn-feedback{text-align:center;padding:14px 20px;border-radius:14px;margin-top:16px;display:none;font-weight:700;font-size:.95rem}
.syn-feedback--show{display:block}
.syn-feedback--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.syn-feedback--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}

.syn-next{display:none;margin:16px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.syn-next:hover{transform:translateY(-2px)}
.syn-next.active{display:inline-block}

/* ===== RESULT ===== */
.rc-result{max-width:520px;margin:0 auto;display:none}
.rc-result.active{display:block}
.rc-result__card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06)}
.rc-result__icon{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2.4rem}
.rc-result__score{font-size:3.5rem;font-weight:900;line-height:1.2;margin-bottom:4px}
.rc-result__label{font-size:.9rem;color:#64748b;margin-bottom:16px}
.rc-result__msg{font-size:1.05rem;color:#0f172a;font-weight:700;margin-bottom:24px;padding:14px 20px;background:#f8fafc;border-radius:12px}
.rc-result__actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}

/* ===== CONFETTI ===== */
.cf-c{position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden}

/* ===== RESPONSIVE ===== */
@media(max-width:640px){
.rc-menu__title{font-size:1.5rem}
.cloze-card,.syn-card{padding:24px 16px}
.cloze-card__passage{font-size:1.05rem;padding:14px}
.syn-sentence{font-size:1.05rem;padding:16px}
.syn-options{grid-template-columns:1fr}
.rc-result__card{padding:32px 20px}
.rc-result__score{font-size:2.5rem}
}

[data-theme="dark"] .rc-page{background:#0f172a}
[data-theme="dark"] .rc-menu__title{color:#f1f5f9}
[data-theme="dark"] .rc-card,[data-theme="dark"] .cloze-card,[data-theme="dark"] .syn-card,[data-theme="dark"] .rc-result__card{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .rc-card__title{color:#f1f5f9}
[data-theme="dark"] .cloze-card__passage{background:#334155;border-color:#475569;color:#f1f5f9}
[data-theme="dark"] .cloze-blank{color:#f59e0b;border-color:#f59e0b}
[data-theme="dark"] .cloze-blank--filled{color:#fcd34d;background:rgba(217,119,6,0.12)}
[data-theme="dark"] .cloze-popup{background:#1e293b;border-color:#334155}
[data-theme="dark"] .cloze-popup::before{background:#1e293b;border-color:#334155}
[data-theme="dark"] .cloze-popup__item{color:#f1f5f9}
[data-theme="dark"] .cloze-popup__item:hover{background:#334155}
[data-theme="dark"] .syn-sentence{background:#334155;border-color:#475569;color:#f1f5f9}
[data-theme="dark"] .syn-btn{background:#1e293b;border-color:#334155;color:#f1f5f9}
[data-theme="dark"] .syn-btn:hover:not(:disabled){border-color:#0d9488}
[data-theme="dark"] .rc-module__back{background:#1e293b;border-color:#334155;color:#94a3b8}
[data-theme="dark"] .rc-module__back:hover{color:#f1f5f9}
[data-theme="dark"] .rc-progress-bar{background:#334155}
[data-theme="dark"] .rc-score{background:#1e293b;border-color:#334155}
[data-theme="dark"] .rc-result__msg{background:#334155;color:#f1f5f9}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="rc-page">
<div class="container">

<div class="rc-score" id="rcScore">
<i class="bi bi-star-fill" style="color:#f59e0b"></i>
Điểm: <span class="rc-score__num" id="rcScoreNum">0</span>
</div>

<!-- MENU -->
<div class="rc-menu" id="rcMenu">
<div class="rc-menu__badge"><i class="bi bi-book"></i> Đọc hiểu & Ngữ cảnh</div>
<h1 class="rc-menu__title">Chọn dạng bài <span>luyện tập</span></h1>
<p class="rc-menu__desc">Điền từ vào đoạn văn và chọn từ đồng nghĩa theo ngữ cảnh</p>
<div class="rc-menu__level">
<label style="font-weight:700;color:#0f172a">Cấp độ:</label>
<select id="rcLevel">
<option value="4">HSK 4</option>
<option value="5" selected>HSK 5</option>
<option value="6">HSK 6</option>
</select>
</div>
<div class="rc-cards">
<div class="rc-card rc-card--cloze" onclick="startModule('cloze')">
<div class="rc-card__icon rc-card__icon--cloze"><i class="bi bi-pencil-square"></i></div>
<div class="rc-card__title">Điền khuyết</div>
<div class="rc-card__desc">Điền từ thích hợp vào chỗ trống trong đoạn văn</div>
</div>
<div class="rc-card rc-card--syn" onclick="startModule('synonym')">
<div class="rc-card__icon rc-card__icon--syn"><i class="bi bi-shuffle"></i></div>
<div class="rc-card__title">Chọn từ đồng nghĩa</div>
<div class="rc-card__desc">Chọn từ thay thế phù hợp nhất với ngữ cảnh</div>
</div>
</div>
</div>

<!-- MODULE -->
<div class="rc-module" id="rcModule">
<div class="rc-module__top">
<button class="rc-module__back" onclick="backToMenu()"><i class="bi bi-arrow-left"></i> Quay lại</button>
<div class="rc-progress">Câu <strong id="qC">1</strong>/<span id="qT">6</span></div>
</div>
<div class="rc-progress-bar"><div class="rc-progress-bar__fill" id="progFill" style="width:0%"></div></div>
<div id="rcArea"></div>
</div>

<!-- RESULT -->
<div class="rc-result" id="rcResult">
<div class="rc-result__card">
<div class="rc-result__icon" id="resIcon"><i class="bi bi-trophy-fill" style="color:#f59e0b;font-size:2.4rem"></i></div>
<div class="rc-result__score" id="resScore">0</div>
<div class="rc-result__label">/ <span id="resTotal">0</span> câu đúng</div>
<div class="rc-result__msg" id="resMsg">Hoàn thành!</div>
<div class="rc-result__actions">
<button class="btn btn--primary ripple" onclick="retryModule()"><i class="bi bi-arrow-repeat"></i> Làm lại</button>
<button class="btn btn--outline ripple" onclick="backToMenu()"><i class="bi bi-grid"></i> Chọn dạng khác</button>
</div>
</div>
</div>

</div>
</main>

<script>
const API_URL='api.php';
const USER_ID=localStorage.getItem('hanngu_user_id')||'default_user';

const synonymData={
4:[
{sentence:'这个问题很<b>简单</b>，我会做。',underline:'简单',options:['容易','困难','有趣','无聊'],correct:0,meaning:'đơn giản'},
{sentence:'今天天气很<b>暖和</b>。',underline:'暖和',options:['温暖','寒冷','炎热','凉爽'],correct:0,meaning:'ấm áp'},
{sentence:'他学习很<b>认真</b>。',underline:'认真',options:['努力','马虎','聪明','懒惰'],correct:0,meaning:'nghiêm túc'},
{sentence:'这个城市很<b>干净</b>。',underline:'干净',options:['清洁','肮脏','美丽','热闹'],correct:0,meaning:'sạch sẽ'},
{sentence:'他<b>经常</b>去图书馆。',underline:'经常',options:['常常','偶尔','很少','从未'],correct:0,meaning:'thường xuyên'},
{sentence:'这本书很<b>有用</b>。',underline:'有用',options:['实用','无聊','有趣','重要'],correct:0,meaning:'hữu ích'},
{sentence:'她<b>喜欢</b>音乐。',underline:'喜欢',options:['喜爱','讨厌','害怕','担心'],correct:0,meaning:'thích'},
{sentence:'这个房间很<b>安静</b>。',underline:'安静',options:['宁静','吵闹','明亮','宽敞'],correct:0,meaning:'yên tĩnh'},
],
5:[
{sentence:'政府采取了一系列措施来<b>保护</b>环境。',underline:'保护',options:['维护','破坏','改变','忽略'],correct:0,meaning:'bảo vệ'},
{sentence:'这项研究对医学发展具有重要的<b>意义</b>。',underline:'意义',options:['价值','价格','问题','困难'],correct:0,meaning:'ý nghĩa'},
{sentence:'他从小就<b>培养</b>了良好的学习习惯。',underline:'培养',options:['养成','放弃','改变','保持'],correct:0,meaning:'bồi dưỡng'},
{sentence:'这次会议主要<b>讨论</b>了明年的工作计划。',underline:'讨论',options:['探讨','忽视','拒绝','回忆'],correct:0,meaning:'thảo luận'},
{sentence:'这个城市的人口正在快速<b>增长</b>。',underline:'增长',options:['增加','减少','停止','变化'],correct:0,meaning:'tăng trưởng'},
{sentence:'他<b>坚持</b>每天跑步已经三年了。',underline:'坚持',options:['保持','放弃','开始','忘记'],correct:0,meaning:'kiên trì'},
{sentence:'这部小说深刻地<b>反映</b>了社会现实。',underline:'反映',options:['体现','隐藏','改变','创造'],correct:0,meaning:'phản ánh'},
{sentence:'我们需要<b>提高</b>服务质量来吸引更多客户。',underline:'提高',options:['提升','降低','保持','改变'],correct:0,meaning:'nâng cao'},
{sentence:'两国领导人<b>签署</b>了合作协议。',underline:'签署',options:['签订','取消','讨论','修改'],correct:0,meaning:'ký kết'},
{sentence:'这种新型材料被广泛<b>应用</b>于各个领域。',underline:'应用',options:['使用','生产','研究','发明'],correct:0,meaning:'ứng dụng'},
{sentence:'他<b>克服</b>了重重困难才取得成功。',underline:'克服',options:['战胜','遇到','放弃','开始'],correct:0,meaning:'khắc phục'},
{sentence:'这篇文章主要<b>阐述</b>了经济发展的新趋势。',underline:'阐述',options:['论述','否定','回忆','隐瞒'],correct:0,meaning:'trình bày'},
],
6:[
{sentence:'这项政策的<b>实施</b>有效地促进了社会公平。',underline:'实施',options:['执行','制定','取消','研究'],correct:0,meaning:'thực thi'},
{sentence:'科学家们正在<b>探索</b>宇宙的奥秘。',underline:'探索',options:['探求','忽略','破坏','限制'],correct:0,meaning:'thám hiểm'},
{sentence:'这部作品充分<b>展现</b>了作者的创作才华。',underline:'展现',options:['展示','隐藏','批评','修改'],correct:0,meaning:'triển hiện'},
{sentence:'双方就合作事宜进行了<b>深入</b>的交流。',underline:'深入',options:['深刻','表面','广泛','快速'],correct:0,meaning:'thâm nhập'},
{sentence:'法律的<b>权威</b>必须得到全社会的尊重。',underline:'权威',options:['尊严','权力','利益','地位'],correct:0,meaning:'quyền uy'},
{sentence:'这种传统工艺正在逐渐<b>消失</b>。',underline:'消失',options:['消亡','发展','改变','兴起'],correct:0,meaning:'tiêu thất'},
{sentence:'环保问题引起了公众的广泛<b>关注</b>。',underline:'关注',options:['重视','忽视','讨论','反对'],correct:0,meaning:'quan chú'},
{sentence:'新技术的<b>推广</b>大大提高了生产效率。',underline:'推广',options:['普及','限制','取消','研究'],correct:0,meaning:'phổ cập'},
{sentence:'两国之间的友好关系不断<b>巩固</b>。',underline:'巩固',options:['加强','削弱','改变','建立'],correct:0,meaning:'củng cố'},
{sentence:'这个结论是经过反复<b>验证</b>的。',underline:'验证',options:['检验','猜测','否定','提出'],correct:0,meaning:'nghiệm chứng'},
]
};

let state={module:'',level:5,score:0,current:0,questions:[],total:0,answered:false};

async function fetchAPI(action,data,method){
if(!method)method='GET';
try{
let url=API_URL+'?action='+action;
let opts={method,headers:{'Content-Type':'application/json'}};
if(method==='GET'&&data)url+='&'+new URLSearchParams(data).toString();
else if(data)opts.body=JSON.stringify(data);
return await(await fetch(url,opts)).json();
}catch(e){showToast('Lỗi kết nối!','error');return[]}
}
function shuffle(a){const c=[...a];for(let i=c.length-1;i>0;i--){const j=Math.floor(Math.random()*(i+1));[c[i],c[j]]=[c[j],c[i]]}return c}
function esc(t){if(!t)return'';const d=document.createElement('div');d.textContent=t;return d.innerHTML}

function updScore(){document.getElementById('rcScoreNum').textContent=state.score}

function backToMenu(){
    var l = document.getElementById('rcLevel').value;
    window.location.href = 'practice.php?level=' + l;
}

async function startModule(type){
state.module=type;
state.level=parseInt(document.getElementById('rcLevel').value);
state.score=0;state.current=0;state.answered=false;
updScore();
const sc=document.getElementById('rcScore');
sc.className='rc-score rc-score--'+(type==='cloze'?'cloze':'syn');
document.getElementById('rcMenu').style.display='none';
document.getElementById('rcResult').classList.remove('active');
document.getElementById('rcModule').classList.add('active');
document.getElementById('rcScore').style.display='flex';

if(type==='synonym'){
const synKeys=Object.keys(synonymData).map(Number).sort((a,b)=>a-b);
const synLevel=synKeys.filter(k=>k<=state.level).pop()||synKeys[0]||5;
const data=synonymData[synLevel];
state.questions=shuffle([...data]).slice(0,10);
state.total=state.questions.length;
renderSynQ();
return;
}
// Cloze
const data=await fetchAPI('get_practice_questions',{module_id:'doc_hieu_dien_khuyet',level:state.level,count:6});
if(!data||data.length===0){
document.getElementById('rcArea').innerHTML='<div style="text-align:center;padding:60px;color:#94a3b8">Chưa có câu hỏi cho cấp độ này.</div>';
return;
}
state.questions=shuffle(data);
state.total=state.questions.length;
renderClozeQ();
}

function updProg(){
document.getElementById('qC').textContent=state.current+1;
document.getElementById('qT').textContent=state.total;
document.getElementById('progFill').style.width=((state.current+1)/state.total*100)+'%';
}

// ===== CLOZE =====
function renderClozeQ(){
state.answered=false;
updProg();
const q=state.questions[state.current];
const para=q.data.paragraph;
const blanks=q.data.blanks;

// Split paragraph by ___ markers
const parts=para.split('___');
const html=[];
let blankIdx=0;
parts.forEach((part,i)=>{
if(part)html.push(esc(part));
if(blankIdx<blanks.length){
const b=blanks[blankIdx];
html.push('<span class="cloze-blank" data-idx="'+blankIdx+'" data-correct="'+b.correct_index+'" onclick="openBlank(this)">?</span>');
html.push('<div class="cloze-popup" id="popup-'+blankIdx+'">');
b.options.forEach((opt,oi)=>{
html.push('<button class="cloze-popup__item" data-idx="'+blankIdx+'" data-opt="'+oi+'" data-val="'+esc(opt)+'" onclick="pickBlank(this)">'+esc(opt)+'</button>');
});
html.push('</div>');
blankIdx++;
}
});

document.getElementById('rcArea').innerHTML=
'<div class="cloze-card">'+
'<div class="cloze-card__label">Click vào chỗ trống để chọn đáp án:</div>'+
'<div class="cloze-card__passage">'+html.join('')+'</div>'+
'<div class="cloze-actions">'+
'<button class="cloze-submit" id="clozeSubmit" onclick="checkCloze()" disabled><i class="bi bi-check-lg"></i> Nộp bài</button>'+
'</div>'+
'<div class="cloze-feedback" id="clozeFb"></div>'+
'<button class="cloze-next" id="clozeNext" onclick="nextQ()">Tiếp tục <i class="bi bi-arrow-right"></i></button>'+
'</div>';

}

function openBlank(el){
if(state.answered)return;
document.querySelectorAll('.cloze-popup--open').forEach(p=>p.classList.remove('cloze-popup--open'));
const idx=el.dataset.idx;
const pop=document.getElementById('popup-'+idx);
pop.classList.add('cloze-popup--open');
// Position the popup
const rect=el.getBoundingClientRect();
const card=document.querySelector('.cloze-card__passage').getBoundingClientRect();
const relTop=rect.top-card.top+rect.height;
pop.style.position='absolute';
pop.style.top=relTop+'px';
pop.style.left='50%';
}

function pickBlank(btn){
const idx=parseInt(btn.dataset.idx);
const optIdx=parseInt(btn.dataset.opt);
const val=btn.dataset.val;
const blank=document.querySelector('.cloze-blank[data-idx="'+idx+'"]');
if(!blank)return;
blank.textContent=val;
blank.dataset.chosen=optIdx;
blank.classList.add('cloze-blank--filled');
document.getElementById('popup-'+idx).classList.remove('cloze-popup--open');
// Enable submit if all blanks filled
const all=document.querySelectorAll('.cloze-blank');
const filled=document.querySelectorAll('.cloze-blank--filled');
document.getElementById('clozeSubmit').disabled=filled.length!==all.length;
document.getElementById('clozeFb').className='cloze-feedback';
}

function checkCloze(){
if(state.answered)return;
state.answered=true;
const blanks=document.querySelectorAll('.cloze-blank');
const q=state.questions[state.current];
const expected=q.data.blanks;
let correct=0;
let wrongList=[];
blanks.forEach((b,i)=>{
  const chosen=parseInt(b.dataset.chosen);
  const isCorrect=chosen===expected[i].correct_index;
  if(isCorrect){correct++;b.classList.add('cloze-blank--correct');}
  else{b.classList.add('cloze-blank--wrong');wrongList.push(i+1);}
  b.onclick=null;
});
const allCorrect=correct===blanks.length;
if(allCorrect){
  state.score++;
  updScore();
  document.getElementById('clozeFb').className='cloze-feedback cloze-feedback--show cloze-feedback--success';
  document.getElementById('clozeFb').innerHTML='<i class="bi bi-check-circle-fill"></i> Chính xác! Bạn đã điền đúng tất cả các chỗ trống.';
  document.getElementById('clozeNext').classList.add('active');
  document.getElementById('clozeSubmit').disabled=true;
  spawnCF();
}else{
  const details=wrongList.map(i=>{
    const b=expected[i-1];
    return '#'+i+': <strong>'+esc(b.options[b.correct_index])+'</strong>';
  }).join(', ');
  document.getElementById('clozeFb').className='cloze-feedback cloze-feedback--show '+(correct>0?'cloze-feedback--partial':'cloze-feedback--fail');
  document.getElementById('clozeFb').innerHTML='<i class="bi bi-'+(correct>0?'exclamation-triangle-fill':'x-circle-fill')+'"></i> '+correct+'/'+blanks.length+' đúng.<br>Đáp án đúng: '+details;
  document.getElementById('clozeSubmit').textContent='🔄 Thử lại';
  document.getElementById('clozeSubmit').classList.add('cloze-submit--retry');
  document.getElementById('clozeSubmit').disabled=false;
  document.getElementById('clozeSubmit').onclick=function(){retryCloze();};
}
}

function retryCloze(){
state.answered=false;
document.querySelectorAll('.cloze-blank').forEach(b=>{
b.classList.remove('cloze-blank--correct','cloze-blank--wrong','cloze-blank--filled');
b.textContent='?';
delete b.dataset.chosen;
b.onclick=function(){openBlank(this);};
});
document.getElementById('clozeFb').className='cloze-feedback';
document.getElementById('clozeNext').classList.remove('active');
document.getElementById('clozeSubmit').textContent='Nộp bài';
document.getElementById('clozeSubmit').classList.remove('cloze-submit--retry');
document.getElementById('clozeSubmit').disabled=true;
document.getElementById('clozeSubmit').onclick=function(){checkCloze();};
}

// ===== SYNONYM =====
function renderSynQ(){
state.answered=false;
updProg();
const q=state.questions[state.current];
document.getElementById('rcArea').innerHTML=
'<div class="syn-card">'+
'<div class="syn-card__label">Chọn từ phù hợp nhất để thay thế từ được gạch chân:</div>'+
'<div class="syn-sentence">'+q.sentence+'</div>'+
'<div class="syn-context">Từ thay thế: <strong>'+esc(q.underline)+'</strong> ('+q.meaning+')</div>'+
'<div class="syn-options">'+
q.options.map((o,i)=>'<button class="syn-btn" data-idx="'+i+'" onclick="pickSyn(this)">'+esc(o)+'</button>').join('')+
'</div>'+
'<div class="syn-feedback" id="synFb"></div>'+
'<button class="syn-next" id="synNext" onclick="nextQ()">Tiếp tục <i class="bi bi-arrow-right"></i></button>'+
'</div>';
}

function pickSyn(btn){
if(state.answered)return;
const q=state.questions[state.current];
const idx=parseInt(btn.dataset.idx);
const correct=q.correct;
const isCorrect=idx===correct;
state.answered=true;
document.querySelectorAll('.syn-btn').forEach(b=>{
b.disabled=true;
const bi=parseInt(b.dataset.idx);
if(bi===correct)b.classList.add('syn-btn--correct');
else if(bi===idx&&!isCorrect)b.classList.add('syn-btn--wrong');
else b.classList.add('syn-btn--dim');
});
if(isCorrect){state.score++;updScore();}
const fb=document.getElementById('synFb');
fb.className='syn-feedback syn-feedback--show '+(isCorrect?'syn-feedback--success':'syn-feedback--fail');
  fb.innerHTML=isCorrect
  ?'<i class="bi bi-check-circle-fill"></i> Chính xác! <strong>'+esc(q.options[correct])+'</strong> — '+esc(q.meaning)
  :'<i class="bi bi-x-circle-fill"></i> Sai. Đáp án đúng: <strong>'+esc(q.options[correct])+'</strong> <span style="font-weight:400">('+esc(q.meaning)+')</span>';
document.getElementById('synNext').classList.add('active');
}

// ===== NAV =====
function nextQ(){
state.current++;
if(state.current>=state.total)showResult();
else state.module==='cloze'?renderClozeQ():renderSynQ();
}

function showResult(){
document.getElementById('rcModule').classList.remove('active');
document.getElementById('rcResult').classList.add('active');
document.getElementById('rcScore').style.display='none';
const s=state.score,t=state.total,pct=Math.round(s/t*100);
document.getElementById('resScore').textContent=s;
document.getElementById('resTotal').textContent=t;
let icon,color,bg,msg;
if(pct>=90){icon='bi bi-trophy-fill';color='#f59e0b';bg='rgba(245,158,11,0.1)';msg='Tuyệt vời! Bạn làm rất tốt!';}
else if(pct>=70){icon='bi bi-emoji-smile-fill';color='#10b981';bg='rgba(16,185,129,0.1)';msg='Làm tốt lắm! Tiếp tục cố gắng nhé!';}
else if(pct>=50){icon='bi bi-emoji-neutral-fill';color='#3b82f6';bg='rgba(59,130,246,0.1)';msg='Khá lắm! Hãy ôn lại thêm nhé!';}
else{icon='bi bi-emoji-frown-fill';color='#ef4444';bg='rgba(239,68,68,0.1)';msg='Cần ôn lại nhiều hơn. Bạn có thể làm lại!';}
document.getElementById('resIcon').style.background=bg;
document.getElementById('resIcon').innerHTML='<i class="'+icon+'" style="color:'+color+';font-size:2.4rem"></i>';
document.getElementById('resMsg').textContent=msg;
if(pct>=90)spawnCF();
fetchAPI('save_quiz_result',{quiz_type:'reading_'+state.module,level:state.level,score:s,total_questions:t,user_id:USER_ID},'POST');
}

function retryModule(){
const type=state.module;
state.score=0;state.current=0;state.answered=false;
updScore();
document.getElementById('rcResult').classList.remove('active');
document.getElementById('rcModule').classList.add('active');
document.getElementById('rcScore').style.display='flex';
if(type==='cloze')renderClozeQ();else renderSynQ();
}

function spawnCF(){
const c=document.createElement('div');c.className='cf-c';document.body.appendChild(c);
const colors=['#f59e0b','#d97706','#10b981','#0d9488','#6366f1','#ef4444'];
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

// Close cloze popups on outside click
document.addEventListener('click',function(e){
  document.querySelectorAll('.cloze-popup--open').forEach(p=>{
    if(!p.contains(e.target)&&!e.target.classList.contains('cloze-blank')){
      p.classList.remove('cloze-popup--open');
    }
  });
});

document.getElementById('rcScore').style.display='none';

window.addEventListener('pageshow', function(e) {
    if (e.persisted) location.reload();
});
(function(){
    const p=new URLSearchParams(location.search);
    const m=p.get('module'),l=p.get('level');
    if(l){var sel=document.getElementById('rcLevel');if(sel)sel.value=l;}
    if(m==='cloze'||m==='synonym')startModule(m);
})();
</script>

<footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Đọc hiểu & Ngữ cảnh</p></div></div></footer>
</body>
</html>
