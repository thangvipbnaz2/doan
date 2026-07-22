<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-page{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:120px 24px 60px;background:linear-gradient(160deg,#eff6ff,#fffbeb)}
        .auth-card{background:#fff;border-radius:var(--radius);padding:40px;box-shadow:var(--shadow-lg);max-width:420px;width:100%}
        .auth-card__title{font-size:1.5rem;font-weight:800;color:var(--dark);text-align:center;margin-bottom:8px}
        .auth-card__desc{font-size:.9rem;color:var(--gray);text-align:center;margin-bottom:32px}
        .fg{margin-bottom:20px}
        .fg label{display:block;font-size:.85rem;font-weight:600;color:var(--dark-3);margin-bottom:6px}
        .fg input{width:100%;padding:14px 18px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;transition:var(--transition);font-family:inherit}
        .fg input:focus{outline:none;border-color:var(--teal);box-shadow:0 0 0 3px rgba(13,148,136,.1)}
        .btn--block{width:100%;text-align:center}
        .auth-footer{text-align:center;margin-top:24px;font-size:.9rem;color:var(--gray)}
        .auth-footer a{color:var(--teal);font-weight:600}
    </style>
<script src="utils.js"></script>
</head>
<body>
    
    <main class="auth-page">
        <div class="auth-card">
            <h1 class="auth-card__title">Đặt lại mật khẩu</h1>
            <p class="auth-card__desc">Nhập mật khẩu mới cho tài khoản của bạn.</p>



            <form id="reset-form">
                <div class="fg">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" id="password" placeholder="Tối thiểu 6 ký tự" required minlength="6">
                </div>
                <div class="fg">
                    <label for="password-confirm">Xác nhận mật khẩu</label>
                    <input type="password" id="password-confirm" placeholder="Nhập lại mật khẩu" required minlength="6">
                </div>
                <button type="submit" class="btn btn--primary btn--block ripple" id="btn-submit">Đặt lại mật khẩu</button>
            </form>

            <div class="auth-footer">
                <a href="login.php">← Quay lại đăng nhập</a>
            </div>
        </div>
    </main>
    
    <script>
    // Loading spinner
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    // Auto-hide on load
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

    <script>


    const token = new URLSearchParams(window.location.search).get('token');
    if (!token) {
        showToast(' Token không hợp lệ!', 'error');
        document.getElementById('btn-submit').disabled = true;
    }

    document.getElementById('reset-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-submit');

        const password = document.getElementById('password').value;
        if (password.length < 6) { showToast(' Mật khẩu tối thiểu 6 ký tự!', 'error'); return; }
        const confirm = document.getElementById('password-confirm').value;
        if (password !== confirm) { showToast(' Mật khẩu xác nhận không khớp!', 'error'); return; }

        btn.textContent = ' Đang xử lý...';
        btn.disabled = true;

        try {
            const res = await fetch('api.php?action=reset_password', {
                method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ token, password })
            });
            const r = await res.json();
            if (r.success) {
                showToast(' ' + r.message, 'success');
                setTimeout(() => { window.location.href = 'login.php'; }, 1500);
            } else {
                showToast(' ' + r.message, 'error');
            }
        } catch (err) {
            showToast(' Lỗi kết nối!', 'error');
        }

        btn.textContent = 'Đặt lại mật khẩu';
        btn.disabled = false;
    });
    
    document.querySelector('.dropdown__trigger')?.addEventListener('click', function(e) {
        e.preventDefault();
        this.nextElementSibling.classList.toggle('dropdown__menu--open');
    });
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown__menu--open').forEach(function(m) { m.classList.remove('dropdown__menu--open'); });
        }
    });
</script>

    <script>
    
    document.addEventListener('DOMContentLoaded',()=>{
        const btn=document.getElementById('theme-toggle');
        if(!btn)return;
        btn.textContent=document.documentElement.getAttribute('data-theme')==='dark'?'☀':'🌙';
        btn.addEventListener('click',()=>{
            const isDark=document.documentElement.getAttribute('data-theme')==='dark';
            if(isDark){document.documentElement.removeAttribute('data-theme');localStorage.setItem('hanngu_theme','light');btn.textContent='🌙';}
            else{document.documentElement.setAttribute('data-theme','dark');localStorage.setItem('hanngu_theme','dark');btn.textContent='☀';}
        });
    });
    </script>
<script src="init.js"></script>
<div class="loading-overlay" id="loading-overlay" style="display:none"><div class="spinner spinner--lg"></div></div>
</body>
</html>
