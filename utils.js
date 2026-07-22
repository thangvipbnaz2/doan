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

// ===== PAGE TRANSITION =====
(function(){
function initPageTransition(){
  var t=document.getElementById('page-transition');
  if(!t){t=document.createElement('div');t.id='page-transition';t.className='page-transition';document.body.appendChild(t)}
  setTimeout(function(){t.classList.remove('active')},50);
  document.addEventListener('click',function(e){
    var l=e.target.closest('a:not([target="_blank"]):not([href^="#"]):not([href^="javascript"]):not([href^="mailto"]):not([download])');
    if(l&&l.href&&l.href.indexOf(window.location.host)!==-1){t.classList.add('active')}
  })
}
function initLoadingBar(){
  var b=document.getElementById('loading-bar');
  if(!b){b=document.createElement('div');b.id='loading-bar';b.className='loading-bar active';b.innerHTML='<div class="loading-bar__fill" id="loading-bar-fill"></div>';document.body.appendChild(b)}
  var f=document.getElementById('loading-bar-fill');
  if(f){f.style.width='30%';setTimeout(function(){f.style.width='70%'},200);setTimeout(function(){f.style.width='100%'},600);setTimeout(function(){b.classList.remove('active')},1200)}
}
function initScrollReveal(){
  if('IntersectionObserver'in window){
    var o=new IntersectionObserver(function(e){e.forEach(function(e){if(e.isIntersecting){e.target.classList.add('visible');o.unobserve(e.target)}})},{threshold:.1});
    function obs(){document.querySelectorAll('.reveal:not(.reveal--watched)').forEach(function(e){e.classList.add('reveal--watched');o.observe(e)})}
    obs();
    if(window.RevealObserver)return;
    window.RevealObserver=new MutationObserver(obs);
    window.RevealObserver.observe(document.body,{childList:true,subtree:true})
  }else{document.querySelectorAll('.reveal').forEach(function(e){e.classList.add('visible')})}
}
function initRipple(){
  document.addEventListener('click',function(e){
    var b=e.target.closest('.ripple');
    if(!b)return;
    var r=b.getBoundingClientRect();
    var s=document.createElement('span');
    var sz=Math.max(r.width,r.height);
    s.style.width=s.style.height=sz+'px';
    s.style.left=(e.clientX-r.left-sz/2)+'px';
    s.style.top=(e.clientY-r.top-sz/2)+'px';
    s.className='ripple-effect';
    b.appendChild(s);
    s.addEventListener('animationend',function(){s.remove()})
  })
}
function initCounters(){
  var els=document.querySelectorAll('[data-count]');
  if(!els.length||!'IntersectionObserver'in window)return;
  var o=new IntersectionObserver(function(e){
    e.forEach(function(e){
      if(!e.isIntersecting)return;
      var el=e.target;
      var t=parseInt(el.getAttribute('data-count'));
      if(isNaN(t)){o.unobserve(el);return}
      var s=parseInt(el.textContent)||0;
      var d=t-s;
      var st=performance.now();
      var dur=parseInt(el.getAttribute('data-duration'))||1000;
      function u(now){var p=Math.min((now-st)/dur,1);var e=1-Math.pow(1-p,3);el.textContent=Math.round(s+d*e);if(p<1)requestAnimationFrame(u)}
      requestAnimationFrame(u);
      o.unobserve(el)
    })
  },{threshold:.5});
  els.forEach(function(e){o.observe(e)})
}
document.addEventListener('DOMContentLoaded',function(){initPageTransition();initLoadingBar();initScrollReveal();initRipple();initCounters()});
})();
