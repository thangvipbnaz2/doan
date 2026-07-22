<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        .password-wrapper{position:relative}
        .password-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--gray);cursor:pointer;font-size:.85rem;padding:4px}
    </style>
<script src="utils.js"></script>
</head>
<body>
    
    <main class="auth-page">
        <div class="auth-card">
            <h1 class="auth-card__title">Đổi mật khẩu</h1>
            <p class="auth-card__desc">Nhập mật khẩu hiện tại và mật khẩu mới.</p>

            <form id="change-password-form">
                <div class="fg">
                    <label for="current_password"><i class="bi bi-lock"></i> Mật khẩu hiện tại</label>
                    <div class="password-wrapper">
                        <input type="password" id="current_password" placeholder="Nhập mật khẩu hiện tại" required>
                        <button type="button" class="password-toggle" onclick="togglePassword('current_password', this)">Hiện</button>
                    </div>
                </div>
                <div class="fg">
                    <label for="new_password"><i class="bi bi-key"></i> Mật khẩu mới</label>
                    <div class="password-wrapper">
                        <input type="password" id="new_password" placeholder="Tối thiểu 6 ký tự" required minlength="6">
                        <button type="button" class="password-toggle" onclick="togglePassword('new_password', this)">Hiện</button>
                    </div>
                </div>
                <div class="fg">
                    <label for="confirm_password"><i class="bi bi-check-circle"></i> Xác nhận mật khẩu mới</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirm_password" placeholder="Nhập lại mật khẩu mới" required minlength="6">
                        <button type="button" class="password-toggle" onclick="togglePassword('confirm_password', this)">Hiện</button>
                    </div>
                </div>
                <button type="submit" class="btn btn--primary btn--block ripple" id="btn-submit">Đổi mật khẩu</button>
            </form>

            <div class="auth-footer">
                <a href="javascript:history.back()">← Quay lại</a>
            </div>
        </div>
    </main>
    
    <script>
    const LO = document.getElementById('loading-overlay');
    function showLoading(){if(LO)LO.style.display='flex';}
    function hideLoading(){if(LO)LO.style.display='none';}
    document.addEventListener('DOMContentLoaded',hideLoading);
    window.addEventListener('load',hideLoading);
    </script>

    <script>
    function togglePassword(id, btn) {
        const p = document.getElementById(id);
        if (p.type === 'password') { p.type = 'text'; btn.textContent = 'Ẩn'; }
        else { p.type = 'password'; btn.textContent = 'Hiện'; }
    }

    let csrfToken = '';
    fetch('auth.php?action=get_csrf_token').then(r=>r.json()).then(d=>{csrfToken=d.csrf_token}).catch(()=>{});

    document.getElementById('change-password-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-submit');

        const currentPassword = document.getElementById('current_password').value;
        if (!currentPassword) { showToast(' Vui lòng nhập mật khẩu hiện tại', 'error'); return; }

        const newPassword = document.getElementById('new_password').value;
        if (newPassword.length < 6) { showToast(' Mật khẩu mới tối thiểu 6 ký tự', 'error'); return; }

        const confirm = document.getElementById('confirm_password').value;
        if (newPassword !== confirm) { showToast(' Mật khẩu xác nhận không khớp', 'error'); return; }

        btn.textContent = ' Đang xử lý...';
        btn.disabled = true;

        try {
            const res = await fetch('auth.php?action=change_password', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ current_password: currentPassword, new_password: newPassword, csrf_token: csrfToken })
            });
            const r = await res.json();
            if (r.success) {
                showToast(' ' + r.message, 'success');
                document.getElementById('change-password-form').reset();
                setTimeout(() => { window.location.href = 'index.php'; }, 1500);
            } else {
                showToast(' ' + r.message, 'error');
            }
        } catch (err) {
            showToast(' Lỗi kết nối!', 'error');
        }

        btn.textContent = 'Đổi mật khẩu';
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

<div class="loading-overlay" id="loading-overlay" style="display:none"><div class="spinner spinner--lg"></div></div>
</body>
</html>
