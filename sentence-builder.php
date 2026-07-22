<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ghép câu - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
.sb-page{padding:100px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc 0%,#f1f5f9 100%)}

/* ===== MENU ===== */
.sb-menu{max-width:640px;margin:0 auto;text-align:center}
.sb-menu__badge{display:inline-flex;align-items:center;gap:6px;background:rgba(99,102,241,0.1);color:#6366f1;padding:5px 16px;border-radius:50px;font-size:.82rem;font-weight:600;margin-bottom:12px}
.sb-menu__title{font-size:2rem;font-weight:900;color:#0f172a;margin-bottom:8px}
.sb-menu__title span{background:linear-gradient(135deg,#6366f1,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
.sb-menu__desc{font-size:.95rem;color:#64748b;margin-bottom:28px}
.sb-menu__level{display:flex;align-items:center;gap:12px;justify-content:center;margin-bottom:32px}
.sb-menu__level select{padding:10px 20px;border:2px solid #e2e8f0;border-radius:12px;font-size:.95rem;font-weight:600;font-family:inherit;background:#fff;color:#0f172a;cursor:pointer}
.sb-menu__start{padding:14px 48px;border:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:14px;font-size:1.05rem;font-weight:700;cursor:pointer;transition:all .3s;font-family:inherit;box-shadow:0 4px 20px rgba(99,102,241,0.3)}
.sb-menu__start:hover{transform:translateY(-2px);box-shadow:0 8px 32px rgba(99,102,241,0.4)}

/* ===== MODULE ===== */
.sb-module{max-width:720px;margin:0 auto;display:none}
.sb-module.active{display:block}
.sb-module__top{display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:10px}
.sb-module__back{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border:none;background:#fff;border-radius:10px;font-size:.85rem;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit;border:1px solid #e2e8f0;transition:all .2s}
.sb-module__back:hover{background:#f8fafc;color:#0f172a}
.sb-progress{font-size:.85rem;color:#94a3b8;font-weight:600;text-align:right}
.sb-progress strong{color:#0f172a}
.sb-progress-bar{width:100%;height:4px;background:#e2e8f0;border-radius:4px;margin-bottom:28px;overflow:hidden}
.sb-progress-bar__fill{height:100%;background:linear-gradient(90deg,#6366f1,#8b5cf6);border-radius:4px;transition:width .5s cubic-bezier(.16,1,.3,1)}

.sb-card{background:#fff;border-radius:24px;padding:36px 32px;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06);margin-bottom:20px}
.sb-card__prompt{text-align:center;margin-bottom:24px}
.sb-card__label{font-size:.82rem;color:#94a3b8;margin-bottom:4px}
.sb-card__hint{font-size:.9rem;color:#64748b;font-weight:500}

/* ===== DROPZONE ===== */
.sb-dropzone{display:flex;flex-wrap:wrap;gap:10px;min-height:72px;padding:18px;background:#f8fafc;border:2.5px dashed #cbd5e1;border-radius:16px;margin-bottom:24px;transition:all .3s;align-items:center;align-content:center;position:relative}
.sb-dropzone--over{border-color:#6366f1;background:rgba(99,102,241,0.04)}
.sb-dropzone--correct{border-color:#10b981!important;background:rgba(16,185,129,0.06)!important}
.sb-dropzone--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.04)!important}
.sb-dropzone__placeholder{color:#94a3b8;font-size:.9rem;width:100%;text-align:center;pointer-events:none;user-select:none}

.sb-word{font-family:'Noto Sans SC',sans-serif;padding:10px 20px;background:#fff;border:2px solid #e2e8f0;border-radius:10px;font-size:1.2rem;font-weight:700;color:#0f172a;cursor:grab;transition:all .2s;user-select:none;position:relative;white-space:nowrap}
.sb-word:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,0.06)}
.sb-word:active{cursor:grabbing}
.sb-word.dragging{opacity:.4;transform:scale(.95)}
.sb-word--placed{background:rgba(99,102,241,0.08);border-color:#6366f1;color:#6366f1}
.sb-word--placed:hover{background:rgba(99,102,241,0.12)}
.sb-word--wrong{border-color:#ef4444!important;background:rgba(239,68,68,0.08)!important;color:#dc2626!important}
.sb-word--correct{border-color:#10b981!important;background:rgba(16,185,129,0.08)!important;color:#065f46!important}
.sb-word--dim{opacity:.25;pointer-events:none}
.sb-word--dragover{border-color:#6366f1;background:rgba(99,102,241,0.1);transform:translateY(-4px)}

/* ===== TRAY ===== */
.sb-tray{display:flex;flex-wrap:wrap;gap:10px;justify-content:center;min-height:48px;padding:16px;background:#f1f5f9;border-radius:14px;margin-bottom:24px}
.sb-tray--over{border:2px dashed #6366f1;background:rgba(99,102,241,0.04)}

/* ===== CHECK BUTTON ===== */
.sb-check{display:flex;gap:12px;justify-content:center}
.sb-check__btn{padding:14px 40px;border:none;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:14px;font-size:1rem;font-weight:700;cursor:pointer;transition:all .3s;font-family:inherit;box-shadow:0 4px 16px rgba(99,102,241,0.25)}
.sb-check__btn:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 6px 24px rgba(99,102,241,0.35)}
.sb-check__btn:disabled{opacity:.4;cursor:not-allowed}

.sb-feedback{text-align:center;padding:14px 20px;border-radius:14px;margin-top:16px;display:none;font-weight:700;font-size:.95rem}
.sb-feedback--show{display:block}
.sb-feedback--success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#065f46}
.sb-feedback--fail{background:rgba(239,68,68,0.08);border:1px solid rgba(239,68,68,0.15);color:#dc2626}
.sb-feedback__answer{font-family:'Noto Sans SC',sans-serif;font-size:1.3rem;margin-top:4px;color:#0f172a;font-weight:700}

.sb-next{display:none;margin:16px auto 0;padding:12px 36px;border:none;background:linear-gradient(135deg,#0d9488,#14b8a6);color:#fff;border-radius:12px;font-size:.95rem;font-weight:700;cursor:pointer;font-family:inherit;box-shadow:0 4px 16px rgba(13,148,136,0.25);transition:all .3s}
.sb-next:hover{transform:translateY(-2px);box-shadow:0 6px 24px rgba(13,148,136,0.35)}
.sb-next.active{display:inline-block}

/* ===== SCORE FLOAT ===== */
.sb-score{position:fixed;top:90px;right:24px;background:#fff;padding:10px 18px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,0.08);display:flex;align-items:center;gap:10px;font-size:.9rem;border:1px solid #e2e8f0;z-index:50}
.sb-score__num{font-weight:900;color:#6366f1;font-size:1.1rem}

/* ===== RESULT ===== */
.sb-result{max-width:520px;margin:0 auto;display:none}
.sb-result.active{display:block}
.sb-result__card{background:#fff;border-radius:24px;padding:48px 40px;text-align:center;box-shadow:0 4px 24px rgba(0,0,0,0.05);border:1px solid rgba(0,0,0,0.06)}
.sb-result__icon{width:80px;height:80px;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2.4rem}
.sb-result__score{font-size:3.5rem;font-weight:900;line-height:1.2;margin-bottom:4px}
.sb-result__label{font-size:.9rem;color:#64748b;margin-bottom:16px}
.sb-result__msg{font-size:1.05rem;color:#0f172a;font-weight:700;margin-bottom:24px;padding:14px 20px;background:#f8fafc;border-radius:12px}
.sb-result__actions{display:flex;gap:12px;justify-content:center;flex-wrap:wrap}

/* ===== CONFETTI ===== */
.confetti-c{position:fixed;inset:0;pointer-events:none;z-index:99999;overflow:hidden}

/* ===== RESPONSIVE ===== */
@media(max-width:640px){
.sb-menu__title{font-size:1.5rem}
.sb-card{padding:24px 16px}
.sb-word{font-size:1rem;padding:8px 14px}
.sb-dropzone{padding:12px;gap:8px}
.sb-result__card{padding:32px 20px}
.sb-result__score{font-size:2.5rem}
}

[data-theme="dark"] .sb-page{background:#0f172a}
[data-theme="dark"] .sb-menu__title{color:#f1f5f9}
[data-theme="dark"] .sb-card,[data-theme="dark"] .sb-result__card{background:#1e293b;border-color:rgba(255,255,255,0.06)}
[data-theme="dark"] .sb-word{background:#1e293b;border-color:#334155;color:#f1f5f9}
[data-theme="dark"] .sb-word--placed{background:rgba(99,102,241,0.15);border-color:#6366f1;color:#a5b4fc}
[data-theme="dark"] .sb-dropzone{background:#334155;border-color:#475569}
[data-theme="dark"] .sb-tray{background:#334155}
[data-theme="dark"] .sb-module__back{background:#1e293b;border-color:#334155;color:#94a3b8}
[data-theme="dark"] .sb-module__back:hover{color:#f1f5f9}
[data-theme="dark"] .sb-progress-bar{background:#334155}
[data-theme="dark"] .sb-score{background:#1e293b;border-color:#334155}
[data-theme="dark"] .sb-result__msg{background:#334155;color:#f1f5f9}
[data-theme="dark"] .sb-feedback__answer{color:#f1f5f9}
[data-theme="dark"] .sb-card__hint{color:#94a3b8}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="sb-page">
<div class="container">

<div class="sb-score" id="sbScore">
<i class="bi bi-star-fill" style="color:#f59e0b"></i>
Điểm: <span class="sb-score__num" id="sbScoreNum">0</span>
</div>

<!-- MENU -->
<div class="sb-menu" id="sbMenu">
<div class="sb-menu__badge"><i class="bi bi-columns-gap"></i> Ghép câu</div>
<h1 class="sb-menu__title">Sắp xếp <span>thành câu</span></h1>
<p class="sb-menu__desc">Kéo và thả các từ vào đúng thứ tự để tạo thành câu hoàn chỉnh</p>
<div class="sb-menu__level">
<label style="font-weight:700;color:#0f172a">Cấp độ:</label>
<select id="sbLevel">
<option value="3">HSK 3</option>
<option value="4" selected>HSK 4</option>
</select>
</div>
<button class="sb-menu__start" onclick="startGame()"><i class="bi bi-play-fill"></i> Bắt đầu</button>
</div>

<!-- MODULE -->
<div class="sb-module" id="sbModule">
<div class="sb-module__top">
<button class="sb-module__back" onclick="backToMenu()"><i class="bi bi-arrow-left"></i> Quay lại</button>
<div class="sb-progress">Câu <strong id="qCurrent">1</strong>/<span id="qTotal">6</span></div>
</div>
<div class="sb-progress-bar"><div class="sb-progress-bar__fill" id="progressFill" style="width:0%"></div></div>

<div class="sb-card" id="sbCard">
<div class="sb-card__prompt">
<div class="sb-card__label">Hãy sắp xếp các từ sau thành câu đúng:</div>
<div class="sb-card__hint" id="qHint"></div>
</div>

<div class="sb-dropzone" id="sbDropzone">
<span class="sb-dropzone__placeholder" id="dzPlaceholder">Kéo thả từ vào đây</span>
</div>

<div class="sb-tray" id="sbTray"></div>

<div class="sb-check">
<button class="sb-check__btn" id="sbCheckBtn" onclick="checkAnswer()" disabled><i class="bi bi-check-lg"></i> Kiểm tra</button>
</div>

<div class="sb-feedback" id="sbFeedback"></div>
<button class="sb-next" id="sbNext" onclick="nextQuestion()">Tiếp tục <i class="bi bi-arrow-right"></i></button>
</div>
</div>

<!-- RESULT -->
<div class="sb-result" id="sbResult">
<div class="sb-result__card">
<div class="sb-result__icon" id="resIcon" style="background:rgba(99,102,241,0.1)"><i class="bi bi-trophy-fill" style="color:#6366f1;font-size:2.4rem"></i></div>
<div class="sb-result__score" id="resScore">0</div>
<div class="sb-result__label">/ <span id="resTotal">0</span> câu đúng</div>
<div class="sb-result__msg" id="resMsg">Hoàn thành!</div>
<div class="sb-result__actions">
<button class="btn btn--primary ripple" onclick="retryGame()"><i class="bi bi-arrow-repeat"></i> Làm lại</button>
<button class="btn btn--outline ripple" onclick="backToMenu()"><i class="bi bi-grid"></i> Chọn cấp độ khác</button>
</div>
</div>
</div>

</div>
</main>

<script>
const API_URL='api.php';
const USER_ID=localStorage.getItem('hanngu_user_id')||'default_user';

let state={
level:4,score:0,current:0,questions:[],total:0,answered:false
};

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

function escapeHtml(t){if(!t)return'';const d=document.createElement('div');d.textContent=t;return d.innerHTML}

function updateScore(){document.getElementById('sbScoreNum').textContent=state.score}

function backToMenu(){
    var l = document.getElementById('sbLevel').value;
    window.location.href = 'practice.php?level=' + l;
}

async function startGame(){
state.level=parseInt(document.getElementById('sbLevel').value);
state.score=0;state.current=0;state.answered=false;
updateScore();
document.getElementById('sbMenu').style.display='none';
document.getElementById('sbResult').classList.remove('active');
document.getElementById('sbModule').classList.add('active');
document.getElementById('sbScore').style.display='flex';

const data=await fetchAPI('get_practice_questions',{module_id:'ghep_cau',level:state.level,count:6});
if(!data||data.length===0){
document.getElementById('sbCard').innerHTML='<div style="text-align:center;padding:40px;color:#94a3b8">Chưa có câu hỏi cho cấp độ này.</div>';
return;
}
state.questions=shuffle(data);
state.total=state.questions.length;
renderQuestion();
}

function updateProgress(){
document.getElementById('qCurrent').textContent=state.current+1;
document.getElementById('qTotal').textContent=state.total;
document.getElementById('progressFill').style.width=((state.current+1)/state.total*100)+'%';
}

function renderQuestion(){
state.answered=false;
updateProgress();
const q=state.questions[state.current];
const words=q.data.scrambled_words.slice();
const shuffled=shuffle(words);

document.getElementById('qHint').textContent='Gồm '+shuffled.length+' từ';

const dz=document.getElementById('sbDropzone');
dz.className='sb-dropzone';
dz.innerHTML='<span class="sb-dropzone__placeholder" id="dzPlaceholder">Kéo thả từ vào đây</span>';

const tray=document.getElementById('sbTray');
tray.className='sb-tray';
tray.innerHTML=shuffled.map((w,i)=>'<span class="sb-word" draggable="true" data-idx="'+i+'" data-word="'+escapeHtml(w)+'">'+escapeHtml(w)+'</span>').join('');

document.getElementById('sbCheckBtn').disabled=true;
document.getElementById('sbFeedback').className='sb-feedback';
document.getElementById('sbNext').classList.remove('active');

setupDragDrop();
}

function setupDragDrop(){
document.querySelectorAll('.sb-word').forEach(el=>{
el.addEventListener('dragstart',function(e){
if(state.answered){e.preventDefault();return}
// If in dropzone, store the source zone
this.classList.add('dragging');
e.dataTransfer.effectAllowed='move';
});
el.addEventListener('dragend',function(){this.classList.remove('dragging')});
});

const dz=document.getElementById('sbDropzone');
const tray=document.getElementById('sbTray');

dz.addEventListener('dragover',function(e){
e.preventDefault();
this.classList.add('sb-dropzone--over');
const dragged=document.querySelector('.sb-word.dragging');
if(dragged&&dragged.parentElement===this){
// Reordering within dropzone - show insert indicator
const afterEl=getInsertPosition(this,e);
document.querySelectorAll('.sb-word--dragover').forEach(el=>el.classList.remove('sb-word--dragover'));
if(afterEl)afterEl.classList.add('sb-word--dragover');
}
});
dz.addEventListener('dragleave',function(e){
if(!this.contains(e.relatedTarget))this.classList.remove('sb-dropzone--over');
document.querySelectorAll('.sb-word--dragover').forEach(el=>el.classList.remove('sb-word--dragover'));
});
dz.addEventListener('drop',function(e){
e.preventDefault();
this.classList.remove('sb-dropzone--over');
document.querySelectorAll('.sb-word--dragover').forEach(el=>el.classList.remove('sb-word--dragover'));
if(state.answered)return;
const dragged=document.querySelector('.sb-word.dragging');
if(!dragged)return;
const fromTray=dragged.parentElement===tray;
if(fromTray){
dragged.classList.remove('dragging');
dragged.classList.add('sb-word--placed');
const placeholder=document.getElementById('dzPlaceholder');
if(placeholder)placeholder.style.display='none';
const afterEl=getInsertPosition(this,e);
if(afterEl&&afterEl!==dragged){
this.insertBefore(dragged,afterEl.nextSibling);
}else{
this.appendChild(dragged);
}
}else if(dragged.parentElement===this){
// Reorder within dropzone
const afterEl=getInsertPosition(this,e);
if(afterEl&&afterEl!==dragged){
this.insertBefore(dragged,afterEl.nextSibling);
}else{
this.appendChild(dragged);
}
}
tray.className='sb-tray';
updateCheckBtn();
});

tray.addEventListener('dragover',function(e){
e.preventDefault();
this.classList.add('sb-tray--over');
});
tray.addEventListener('dragleave',function(){
this.classList.remove('sb-tray--over');
});
tray.addEventListener('drop',function(e){
e.preventDefault();
this.classList.remove('sb-tray--over');
if(state.answered)return;
const dragged=document.querySelector('.sb-word.dragging');
if(dragged&&dragged.parentElement!==this){
dragged.classList.remove('dragging','sb-word--placed');
this.appendChild(dragged);
const dzWords=dz.querySelectorAll('.sb-word');
if(dzWords.length===0){
const p=document.getElementById('dzPlaceholder');
if(p)p.style.display='';
}
updateCheckBtn();
}
});

// Click to move between tray and dropzone
document.querySelectorAll('.sb-word').forEach(el=>{
el.addEventListener('click',function(){
if(state.answered)return;
if(this.parentElement===tray){
// Click in tray -> move to dropzone
this.classList.add('sb-word--placed');
const p=document.getElementById('dzPlaceholder');
if(p)p.style.display='none';
dz.appendChild(this);
}else{
// Click in dropzone -> return to tray
this.classList.remove('sb-word--placed');
tray.appendChild(this);
const dzWords=dz.querySelectorAll('.sb-word');
if(dzWords.length===0){
const p=document.getElementById('dzPlaceholder');
if(p)p.style.display='';
}
}
updateCheckBtn();
});
});
}

function getInsertPosition(container,e){
const rect=container.getBoundingClientRect();
const x=e.clientX;
const words=container.querySelectorAll('.sb-word:not(.dragging)');
for(const w of words){
const r=w.getBoundingClientRect();
if(x<r.left+r.width/2)return w;
}
return null;
}

function updateCheckBtn(){
const dz=document.getElementById('sbDropzone');
const placed=dz.querySelectorAll('.sb-word').length;
const btn=document.getElementById('sbCheckBtn');
btn.disabled=placed===0;
}

// ===== CHECK =====
function checkAnswer(){
if(state.answered)return;
const q=state.questions[state.current];
const dz=document.getElementById('sbDropzone');
const placed=Array.from(dz.querySelectorAll('.sb-word')).map(el=>el.dataset.word);
const stripPunct=s=>s.replace(/[。，、！？：；""''（）【】《》—…·～\s]/g,'');
const userAnswer=stripPunct(placed.join(''));
const correctAnswer=stripPunct(q.data.correct_answer);
const isCorrect=userAnswer===correctAnswer;

state.answered=true;
document.getElementById('sbCheckBtn').disabled=true;

  // Stop drag during feedback
  document.querySelectorAll('.sb-word[draggable]').forEach(el=>el.draggable=false);

  // Remove drop events on dropzone & tray to prevent listener leaks
  const dzClone=dz.cloneNode(true);
  dz.parentNode.replaceChild(dzClone,dz);
  const trayClone=document.getElementById('sbTray').cloneNode(true);
  document.getElementById('sbTray').parentNode.replaceChild(trayClone,document.getElementById('sbTray'));
  const newDz=document.getElementById('sbDropzone');

if(isCorrect){
state.score++;
updateScore();
newDz.classList.add('sb-dropzone--correct');
newDz.querySelectorAll('.sb-word').forEach(el=>el.classList.add('sb-word--correct'));
showFeedback(true,'Chính xác! Bạn đã sắp xếp đúng.',correctAnswer);
spawnConfetti();
document.getElementById('sbNext').classList.add('active');
}else{
newDz.classList.add('sb-dropzone--wrong');
const expected=q.data.correct_answer;
const expectedChars=expected.split('');
const dzWords=newDz.querySelectorAll('.sb-word');
let charIdx=0;
let allCorrect=true;
dzWords.forEach(el=>{
const word=el.dataset.word;
const wordLen=word.length;
const wordCorrect=expected.substring(charIdx,charIdx+wordLen)===word;
if(!wordCorrect){el.classList.add('sb-word--wrong');allCorrect=false;}
else el.classList.add('sb-word--correct');
charIdx+=wordLen;
});
showFeedback(false,'Chưa đúng! Các từ sai được đánh dấu đỏ. Hãy thử lại!',correctAnswer);
// Allow retry
setTimeout(()=>{
state.answered=false;
document.getElementById('sbCheckBtn').disabled=false;
document.querySelectorAll('.sb-word[draggable]').forEach(el=>el.draggable=true);
newDz.classList.remove('sb-dropzone--wrong');
newDz.querySelectorAll('.sb-word').forEach(el=>{
el.classList.remove('sb-word--wrong','sb-word--correct');
el.classList.add('sb-word--placed');
});
          // Re-setup drop + click on words
          setupDragDrop();
          document.getElementById('sbNext').classList.remove('active');
},2000);
}
}

function showFeedback(isCorrect,msg,answer){
const el=document.getElementById('sbFeedback');
el.className='sb-feedback sb-feedback--show '+(isCorrect?'sb-feedback--success':'sb-feedback--fail');
el.innerHTML='<div>'+msg+'</div>'+(answer?'<div class="sb-feedback__answer">'+escapeHtml(answer)+'</div>':'');
}

function spawnConfetti(){
const c=document.createElement('div');c.className='confetti-c';document.body.appendChild(c);
const colors=['#6366f1','#8b5cf6','#f59e0b','#10b981','#ef4444','#0d9488'];
for(let i=0;i<80;i++){
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

// ===== NAVIGATION =====
function nextQuestion(){
state.current++;
if(state.current>=state.total)showResult();
else renderQuestion();
}

function showResult(){
document.getElementById('sbModule').classList.remove('active');
document.getElementById('sbResult').classList.add('active');
document.getElementById('sbScore').style.display='none';
const s=state.score,t=state.total;
const pct=Math.round(s/t*100);
document.getElementById('resScore').textContent=s;
document.getElementById('resTotal').textContent=t;
let icon,color,bg,msg;
if(pct>=90){icon='bi bi-trophy-fill';color='#f59e0b';bg='rgba(245,158,11,0.1)';msg='Tuyệt vời! Bạn sắp xếp câu rất chính xác!';}
else if(pct>=70){icon='bi bi-emoji-smile-fill';color='#10b981';bg='rgba(16,185,129,0.1)';msg='Làm tốt lắm! Cố gắng thêm nhé!';}
else if(pct>=50){icon='bi bi-emoji-neutral-fill';color='#6366f1';bg='rgba(99,102,241,0.1)';msg='Khá lắm! Hãy ôn lại thêm nhé!';}
else{icon='bi bi-emoji-frown-fill';color='#ef4444';bg='rgba(239,68,68,0.1)';msg='Cần ôn lại nhiều hơn!';}
document.getElementById('resIcon').style.background=bg;
document.getElementById('resIcon').innerHTML='<i class="'+icon+'" style="color:'+color+';font-size:2.4rem"></i>';
document.getElementById('resMsg').textContent=msg;
if(pct>=90)spawnConfetti();
fetchAPI('save_quiz_result',{quiz_type:'ghep_cau',level:state.level,score:s,total_questions:t,user_id:USER_ID},'POST');
}

function retryGame(){
state.score=0;state.current=0;state.answered=false;
updateScore();
document.getElementById('sbResult').classList.remove('active');
document.getElementById('sbModule').classList.add('active');
document.getElementById('sbScore').style.display='flex';
renderQuestion();
}

document.getElementById('sbScore').style.display='none';

window.addEventListener('pageshow', function(e) {
    if (e.persisted) location.reload();
});
(function(){var l=new URLSearchParams(location.search).get('level');if(l){var sel=document.getElementById('sbLevel');if(sel)sel.value=l;}startGame();})();
</script>

<footer class="footer"><div class="footer__bottom"><div class="container"><p>&copy; 2026 HànNgữ. Ghép câu - Luyện thi HSK</p></div></div></footer>
</body>
</html>
