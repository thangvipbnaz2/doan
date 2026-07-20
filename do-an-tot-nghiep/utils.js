// ===== TOAST NOTIFICATION =====
function showToast(msg, type, duration) {
    type = type || 'info';
    duration = duration || (type === 'error' || type === 'warning' ? 5000 : 3500);
    var c = document.getElementById('toast-container');
    if (!c) {
        c = document.createElement('div');
        c.id = 'toast-container';
        c.className = 'toast-container';
        document.body.appendChild(c);
    }
    var t = document.createElement('div');
    var icons = { success: '✅', error: '❌', warning: '⚠️', info: 'ℹ️' };
    t.className = 'toast-item toast-item--' + type;
    t.innerHTML = '<span class="toast-item__icon">' + (icons[type] || '') + '</span><span class="toast-item__text">' + msg + '</span><span class="toast-item__bar" style="animation-duration:' + (duration/1000) + 's"></span>';
    t.onclick = function() { removeToast(t); };
    c.appendChild(t);
    setTimeout(function() { removeToast(t); }, duration);
}
function removeToast(el) {
    if (el.classList.contains('toast-removing')) return;
    el.classList.add('toast-removing');
    setTimeout(function() { if (el.parentNode) el.parentNode.removeChild(el); }, 300);
}

// ===== CONFIRM DIALOG =====
function showConfirm(msg, title) {
    return new Promise(function(r) {
        var o = document.createElement('div');
        o.className = 'confirm-overlay active';
        o.innerHTML = '<div class="confirm-box"><div class="confirm-box__icon">⚠️</div><div class="confirm-box__title">' + (title || 'Xác nhận') + '</div><div class="confirm-box__msg">' + msg + '</div><div class="confirm-box__actions"><button class="btn btn--outline" id="confirm-cancel">Huỷ</button><button class="btn btn--primary" id="confirm-ok">Đồng ý</button></div></div>';
        document.body.appendChild(o);
        o.querySelector('#confirm-ok').onclick = function() { o.remove(); r(true); };
        o.querySelector('#confirm-cancel').onclick = function() { o.remove(); r(false); };
        o.onclick = function(e) { if (e.target === o) { o.remove(); r(false); } };
    });
}
