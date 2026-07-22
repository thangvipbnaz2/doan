(function(){
var mediaRecorder = null;
var stream = null;
var audioChunks = [];
var recording = false;
var timerInterval = null;
var seconds = 0;

var recordBtn = document.getElementById('record-btn');
var recordStatus = document.getElementById('record-status');
var recordTimer = document.getElementById('record-timer');
var feedbackArea = document.getElementById('feedback-area');
var historyWrap = document.getElementById('history-wrap');

if (!recordBtn) return;

function speak(text, lang) {
    if (!text || !window.speechSynthesis) return;
    var u = new SpeechSynthesisUtterance(text);
    u.lang = lang || 'vi-VN';
    u.rate = 0.9;
    u.onerror = function(){};
    speechSynthesis.speak(u);
}

function speakMixed(html) {
    if (!window.speechSynthesis) return;
    speechSynthesis.cancel();
    var div = document.createElement('div');
    div.innerHTML = html;
    var blocks = [];
    function walkNode(n, inheritLang) {
        if (n.nodeType === 3) {
            var t = n.textContent.trim();
            if (t) blocks.push({text: t, lang: inheritLang});
        } else if (n.nodeType === 1) {
            var lang = n.classList.contains('vi') ? 'vi-VN' : (n.classList.contains('cn') || n.classList.contains('py')) ? 'zh-CN' : inheritLang;
            n.childNodes.forEach(function(c){ walkNode(c, lang); });
        }
    }
    div.childNodes.forEach(function(c){ walkNode(c, 'vi-VN'); });
    var i = 0;
    function next() {
        if (i >= blocks.length) return;
        var b = blocks[i++];
        var u = new SpeechSynthesisUtterance(b.text);
        u.lang = b.lang;
        u.rate = 0.9;
        u.onend = next;
        u.onerror = next;
        speechSynthesis.speak(u);
    }
    next();
}

window.spk = speak;
window.spkM = speakMixed;

function escapeHtml(t) {
    var d = document.createElement('div');
    d.textContent = t;
    return d.innerHTML;
}

function renderFeedback(text) {
    var sections = text.match(/【([^】]+)】([\s\S]*?)(?=【|$)/g);
    if (!sections) {
        feedbackArea.innerHTML = '<div class="feedback-card"><div class="feedback-actions"><button class="speak-btn speak-all-btn" onclick="spkM(decodeURIComponent(\'' + encodeURIComponent(escapeHtml(text)) + '\'))"> \uD83D\uDD0A \u0110\u1ECDc</button></div><div class="feedback-content">' + escapeHtml(text) + '</div></div>';
        return;
    }
    var html = '<div class="feedback-card">';
    var allHtml = '';
    sections.forEach(function(s){
        var m = s.match(/【([^】]+)】([\s\S]*?)$/);
        if (!m) return;
        var label = m[1].trim();
        var content = m[2].trim();
        var processed = escapeHtml(content).replace(/([\u4e00-\u9fff\uff00-\uffef]+)/g, '<span class="cn">$1</span>');
        html += '<div class="feedback-section"><div class="feedback-label">' + escapeHtml(label) + '</div><div class="feedback-content">' + processed + '</div></div>';
        allHtml += processed;
    });
    html += '<div class="feedback-actions"><button class="speak-btn speak-all-btn" onclick="spkM(decodeURIComponent(\'' + encodeURIComponent(allHtml) + '\'))"> \uD83D\uDD0A \u0110\u1ECDc to\u00e0n b\u1ED9</button></div></div>';
    feedbackArea.innerHTML = html;
}

function formatTime(s) {
    return String(Math.floor(s / 60)).padStart(2, '0') + ':' + String(s % 60).padStart(2, '0');
}

function addHistory(type, text) {
    var d = document.createElement('div');
    d.className = 'history-item ' + type;
    d.innerHTML = '<div class="h-label">' + (type === 'user' ? ' \uD83D\uDC4A B\u1EA1n \u0111\xE3 n\xF3i' : ' \uD83D\uDC68\u200D\uD83C\uDFEB Gi\xE1o vi\xEAn') + '</div><div class="h-text">' + escapeHtml(text).replace(/\n/g, '<br>') + '</div>';
    historyWrap.prepend(d);
}

async function startRecording() {
    try {
        stream = await navigator.mediaDevices.getUserMedia({ audio: true });
        var opts = MediaRecorder.isTypeSupported('audio/webm;codecs=opus') ? {mimeType: 'audio/webm;codecs=opus'} :
                   MediaRecorder.isTypeSupported('audio/webm') ? {mimeType: 'audio/webm'} : {};
        mediaRecorder = new MediaRecorder(stream, opts);
        audioChunks = [];
        recording = true;
        seconds = 0;
        recordBtn.classList.add('recording');
        recordStatus.textContent = ' \u0110ang ghi \u00E2m...';
        recordStatus.className = 'record-status active';
        recordTimer.textContent = '00:00';
        timerInterval = setInterval(function(){
            seconds++;
            recordTimer.textContent = formatTime(seconds);
        }, 1000);
        mediaRecorder.ondataavailable = function(e) {
            if (e.data.size > 0) audioChunks.push(e.data);
        };
        mediaRecorder.onstop = function() { processAudio(); };
        mediaRecorder.start();
    } catch (e) {
        if (typeof showToast === 'function') showToast('L\u1ED7i micro: ' + e.message, 'error');
    }
}

function stopRecording() {
    if (mediaRecorder && mediaRecorder.state !== 'inactive') {
        mediaRecorder.stop();
    }
    if (stream) {
        stream.getTracks().forEach(function(t){ t.stop(); });
        stream = null;
    }
    clearInterval(timerInterval);
    recording = false;
    recordBtn.classList.remove('recording');
    recordBtn.classList.add('loading');
    recordStatus.textContent = ' \u0110ang x\u1EED l\xFD...';
}

async function processAudio() {
    if (audioChunks.length === 0) {
        recordBtn.classList.remove('loading');
        recordStatus.textContent = 'Nh\u1EA5n \u0111\u1EC3 b\u1EAFt \u0111\u1EA7u ghi \u00E2m';
        recordStatus.className = 'record-status';
        return;
    }
    var blob = new Blob(audioChunks, { type: mediaRecorder ? mediaRecorder.mimeType : 'audio/webm' });
    var reader = new FileReader();
    reader.onload = async function() {
        var dataUrl = reader.result;
        var comma = dataUrl.indexOf(',');
        var b64 = dataUrl.substring(comma + 1);
        var mime = dataUrl.substring(5, comma).split(';')[0];
        try {
            var res = await fetch('api.php?action=voice_chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ audio: b64, mime: mime })
            });
            var data = await res.json();
            recordBtn.classList.remove('loading');
            if (data.reply) {
                renderFeedback(data.reply);
                var fc = document.querySelector('.feedback-card');
                if (fc) fc.scrollIntoView({ behavior: 'smooth', block: 'start' });
            } else {
                if (typeof showToast === 'function') showToast('L\u1ED7i ph\u1EA3n h\u1ED3i', 'error');
            }
        } catch (e) {
            if (typeof showToast === 'function') showToast('L\u1ED7i k\u1EBFt n\u1ED1i', 'error');
            recordBtn.classList.remove('loading');
        }
        recordStatus.textContent = 'Nh\u1EA5n \u0111\u1EC3 b\u1EAFt \u0111\u1EA7u ghi \u00E2m';
        recordStatus.className = 'record-status';
    };
    reader.readAsDataURL(blob);
}

recordBtn.addEventListener('click', function(){
    if (recording) stopRecording();
    else startRecording();
});

if (!document.getElementById('sidebar')) {
    fetch('sidebar.php').then(function(r){ return r.text(); }).then(function(html){
        var c = document.getElementById('sidebar-container');
        if (!c) return;
        c.innerHTML = html;
        c.querySelectorAll('script').forEach(function(s){
            var ns = document.createElement('script');
            if (s.src) ns.src = s.src;
            else ns.textContent = s.textContent;
            s.replaceWith(ns);
        });
        var links = c.querySelectorAll('.sidebar__link');
        for (var i = 0; i < links.length; i++) {
            var h = links[i].getAttribute('href');
            if (h === 'live_chat.php' || h === 'voice_ai.php') {
                links[i].classList.add('sidebar__link--active');
            }
        }
    }).catch(function(){});
}
})();
