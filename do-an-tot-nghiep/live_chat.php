<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Luyện nói - HànNgữ</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<style>
.live-page{padding:90px 0 60px;min-height:100vh;background:linear-gradient(180deg,#f8fafc,#eff6ff)}
.live-header{text-align:center;margin-bottom:32px}
.live-header h1{font-size:2rem;font-weight:800;color:var(--dark);margin-bottom:6px}
.live-header p{font-size:.95rem;color:var(--gray)}
.live-container{max-width:640px;margin:0 auto}
.record-wrap{text-align:center;margin-bottom:24px}
.record-btn{width:80px;height:80px;border-radius:50%;border:4px solid var(--red);background:#fff;color:var(--red);font-size:2rem;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;position:relative}
.record-btn:hover{transform:scale(1.06);box-shadow:0 0 30px rgba(13,148,136,.25)}
.record-btn.recording{box-shadow:0 0 24px rgba(13,148,136,.18)}
.record-btn.recording{border-color:var(--red);color:var(--red);animation:pulse-btn 1s ease-in-out infinite}
.record-btn.recording::after{content:'';position:absolute;inset:-8px;border-radius:50%;border:3px solid var(--red);animation:pulse-ring 1.2s ease-out infinite}
.record-btn.loading{pointer-events:none;opacity:.6}
@keyframes pulse-btn{0%,100%{transform:scale(1)}50%{transform:scale(.95)}}
@keyframes pulse-ring{0%{opacity:1;transform:scale(1)}100%{opacity:0;transform:scale(1.4)}}
.record-status{font-size:.85rem;color:var(--gray);margin-top:10px;font-weight:500}
.record-status.active{color:var(--red)}
.record-timer{font-size:2.5rem;font-weight:800;color:var(--dark);margin-top:8px;font-variant-numeric:tabular-nums}
.eval-card{background:#fff;border-radius:var(--radius);padding:24px;box-shadow:var(--shadow);margin-bottom:20px;animation:fadeUp .4s ease}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
.eval-section{margin-bottom:16px;padding-bottom:16px;border-bottom:1px solid var(--gray-light)}
.eval-section:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
.eval-label{font-size:.75rem;font-weight:700;color:var(--gray);text-transform:uppercase;letter-spacing:.5px;margin-bottom:6px}
.eval-content{font-size:.95rem;color:var(--dark-3);line-height:1.7}
.eval-content .cn{font-family:'Noto Sans SC',sans-serif;font-size:1.05rem;font-weight:700;color:var(--red-dark)}
.eval-content .py{color:var(--red);font-weight:600;font-style:italic}
.eval-content .vi{color:var(--dark-3)}
.speak-btn{display:inline-flex;align-items:center;gap:4px;padding:4px 10px;border:none;border-radius:6px;background:var(--red-light);color:var(--red-dark);font-size:.78rem;font-weight:600;cursor:pointer;transition:all .2s;margin-left:8px;font-family:inherit}
.speak-btn:hover{background:var(--red);color:#fff}
.speak-all-btn{margin:0;padding:8px 18px;font-size:.85rem;gap:6px}.eval-actions{text-align:center;padding-top:6px}
.history-wrap{margin-top:28px}
.history-item{padding:16px 20px;background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);margin-bottom:12px;border-left:4px solid var(--red);animation:fadeUp .3s ease}
.history-item.user{border-left-color:#3b82f6}
.history-item .h-label{font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--gray);margin-bottom:4px}
.history-item .h-text{font-size:.9rem;color:var(--dark-3)}
.empty-state{text-align:center;padding:40px 20px;color:var(--gray)}
.empty-state__icon{font-size:3rem;margin-bottom:12px}
[data-theme="dark"] .record-btn:hover{box-shadow:0 0 30px rgba(96,165,250,.25)}
[data-theme="dark"] .record-btn.recording{box-shadow:0 0 24px rgba(96,165,250,.18)}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<main class="live-page">
<div class="container live-container">
<div class="live-header">
<h1> Luyện nói với AI</h1>
<p>Nói tiếng Trung, AI sẽ đánh giá và sửa lỗi cho bạn</p>
</div>

<div class="record-wrap">
<button class="record-btn" id="record-btn" aria-label="Ghi âm"></button>
<div class="record-status" id="record-status">Nhấn để bắt đầu ghi âm</div>
<div class="record-timer" id="record-timer">00:00</div>
</div>

<div id="eval-area"></div>
<div id="history-wrap" class="history-wrap"></div>
</div>
</main>

<script>
let mediaRecorder = null;
let stream = null;
let audioChunks = [];
let recording = false;
let timerInterval = null;
let seconds = 0;
const recordBtn = document.getElementById('record-btn');
const recordStatus = document.getElementById('record-status');
const recordTimer = document.getElementById('record-timer');
const evalArea = document.getElementById('eval-area');
const historyWrap = document.getElementById('history-wrap');
const userId = localStorage.getItem('hanngu_user_id') || 'default_user';

function speak(text, lang) {
    if (!text || !window.speechSynthesis) return;
    const u = new SpeechSynthesisUtterance(text);
    u.lang = lang || 'vi-VN';
    u.rate = 0.9;
    u.onerror = function(){};
    speechSynthesis.speak(u);
}

function speakMixed(html) {
    if (!window.speechSynthesis) return;
    speechSynthesis.cancel();
    const div = document.createElement('div');
    div.innerHTML = html;
    const blocks = [];
    function walkNode(n, inheritLang) {
        if (n.nodeType === 3) {
            const t = n.textContent.trim();
            if (t) blocks.push({text: t, lang: inheritLang});
        } else if (n.nodeType === 1) {
            const lang = n.classList.contains('vi') ? 'vi-VN' : (n.classList.contains('cn') || n.classList.contains('py')) ? 'zh-CN' : inheritLang;
            n.childNodes.forEach(c => walkNode(c, lang));
        }
    }
    div.childNodes.forEach(c => walkNode(c, 'vi-VN'));
    let i = 0;
    function next() {
        if (i >= blocks.length) return;
        const b = blocks[i++];
        const u = new SpeechSynthesisUtterance(b.text);
        u.lang = b.lang;
        u.rate = 0.9;
        u.onend = next;
        u.onerror = next;
        speechSynthesis.speak(u);
    }
    next();
}

function renderEval(text) {
    const sections = text.match(/【([^】]+)】([\s\S]*?)(?=【|$)/g);
    if (!sections) {
        evalArea.innerHTML = '<div class="eval-card">' +
            '<div class="eval-actions"><button class="speak-btn speak-all-btn" onclick="speakMixed(decodeURIComponent(\'' +
            encodeURIComponent(escapeHtml(text)) + '\'))"> Đọc</button></div>' +
            '<div class="eval-content">' + escapeHtml(text) + '</div></div>';
        return;
    }

    let html = '<div class="eval-card">';
    let allHtml = '';
    sections.forEach(s => {
        const m = s.match(/【([^】]+)】([\s\S]*?)$/);
        if (!m) return;
        const label = m[1].trim();
        const content = m[2].trim();

        let processed = escapeHtml(content)
            .replace(/([\u4e00-\u9fff\uff00-\uffef]+)/g, '<span class="cn">$1</span>');

        html += '<div class="eval-section">' +
            '<div class="eval-label">' + escapeHtml(label) + '</div>' +
            '<div class="eval-content">' + processed + '</div></div>';

        allHtml += processed;
    });

    html += '<div class="eval-actions"><button class="speak-btn speak-all-btn" onclick="speakMixed(decodeURIComponent(\'' +
        encodeURIComponent(allHtml) + '\'))"> Đọc toàn bộ</button></div>';
    html += '</div>';
    evalArea.innerHTML = html;
}

function escapeHtml(t) {
    const d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML;
}

function formatTime(s) {
    const m = String(Math.floor(s / 60)).padStart(2, '0');
    const sec = String(s % 60).padStart(2, '0');
    return m + ':' + sec;
}

function addHistory(type, text) {
    const d = document.createElement('div');
    d.className = 'history-item ' + type;
    d.innerHTML = '<div class="h-label">' + (type === 'user' ? ' Bạn đã nói' : ' Giáo viên') + '</div>' +
        '<div class="h-text">' + escapeHtml(text).replace(/\n/g, '<br>') + '</div>';
    historyWrap.prepend(d);
}

async function startRecording() {
    try {
        stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        const opts = MediaRecorder.isTypeSupported('audio/webm;codecs=opus') ? {mimeType: 'audio/webm;codecs=opus'} :
                    MediaRecorder.isTypeSupported('audio/webm') ? {mimeType: 'audio/webm'} : {};
        mediaRecorder = new MediaRecorder(stream, opts);
        audioChunks = [];
        recording = true;
        seconds = 0;
        recordBtn.classList.add('recording');
        recordStatus.textContent = ' Đang ghi âm...';
        recordStatus.className = 'record-status active';
        recordTimer.textContent = '00:00';
        timerInterval = setInterval(() => {
            seconds++;
            recordTimer.textContent = formatTime(seconds);
        }, 1000);

        mediaRecorder.ondataavailable = (e) => {
            if (e.data.size > 0) audioChunks.push(e.data);
        };

        mediaRecorder.onstop = () => processAudio();
        mediaRecorder.start();
    } catch (e) {
        showToast(' Lỗi micro: ' + e.message, 'error');
    }
}

function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();
    }
    if (stream) { stream.getTracks().forEach(t => t.stop()); stream = null; }
    clearInterval(timerInterval);
    recording = false;
    recordBtn.classList.remove('recording');
    recordBtn.classList.add('loading');
    recordStatus.textContent = ' Đang xử lý...';
}

async function processAudio() {
    if (audioChunks.length === 0) {
        recordBtn.classList.remove('loading');
        recordStatus.textContent = 'Nhấn để bắt đầu ghi âm';
        recordStatus.className = 'record-status';
        return;
    }

    const blob = new Blob(audioChunks, { type: mediaRecorder?.mimeType || 'audio/webm' });
    const reader = new FileReader();
    reader.onload = async () => {
        const dataUrl = reader.result;
        const comma = dataUrl.indexOf(',');
        const b64 = dataUrl.substring(comma + 1);
        const mime = dataUrl.substring(5, comma).split(';')[0];

        try {
            const res = await fetch('api.php?action=voice_chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ audio: b64, mime: mime })
            });
            const data = await res.json();
            recordBtn.classList.remove('loading');
            if (data.reply) {
                renderEval(data.reply);
                const evalCard = document.querySelector('.eval-card');
                if (evalCard) evalCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                showToast(' Lỗi phản hồi', 'error');
            }
        } catch (e) {
            showToast(' Lỗi kết nối', 'error');
            recordBtn.classList.remove('loading');
        }
        recordStatus.textContent = 'Nhấn để bắt đầu ghi âm';
        recordStatus.className = 'record-status';
    };
    reader.readAsDataURL(blob);
}

recordBtn.addEventListener('click', () => {
    if (recording) stopRecording();
    else startRecording();
});

</script>
<script src="init.js"></script>
</body>
</html>
