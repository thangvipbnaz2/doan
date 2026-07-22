<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - HànNgữ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-page{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:120px 24px 60px;background:linear-gradient(160deg,#eff6ff,#fffbeb)}
        .auth-card{background:#fff;border-radius:var(--radius);padding:40px;box-shadow:var(--shadow-lg);max-width:420px;width:100%}
        .auth-card__logo{text-align:center;margin-bottom:32px}
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
        @media(max-width:480px){.auth-card{padding:28px 20px}}
    </style>
<script src="utils.js"></script>
</head>
<body>
    
    <main class="auth-page">
        <div class="auth-card">
            <div class="auth-card__logo">
                <a href="index.php" class="sidebar__logo" style="justify-content:center;">
                    <span class="logo__icon">汉</span>
                    <span class="logo__text">HànNgữ</span>
                </a>
            </div>
            <h1 class="auth-card__title">Đăng nhập</h1>
            <p class="auth-card__desc">Chào mừng bạn trở lại! Tiếp tục hành trình học tiếng Trung.</p>



            <form id="login-form">
                <div class="fg">
                    <label for="username">Tên đăng nhập hoặc Email</label>
                    <input type="text" id="username" placeholder="Nhập tên đăng nhập hoặc email" required>
                    <span class="form-error-text">Vui lòng nhập tên đăng nhập</span>
                </div>
                <div class="fg">
                    <label for="password">Mật khẩu</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" placeholder="Nhập mật khẩu" required>
                        <button type="button" class="password-toggle" onclick="togglePassword(this)">Hiện</button>
                    </div>
                    <span class="form-error-text">Vui lòng nhập mật khẩu</span>
                </div>
                <button type="submit" class="btn btn--primary btn--block ripple" id="btn-submit">Đăng nhập</button>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;">
                    <label style="font-size:.85rem;color:var(--gray);display:flex;align-items:center;gap:6px;cursor:pointer;">
                        <input type="checkbox" id="remember" checked> Ghi nhớ đăng nhập
                    </label>
                    <a href="forgot_password.php" style="font-size:.85rem;color:var(--gray);">Quên mật khẩu?</a>
                </div>
            </form>

            <div class="auth-footer">
                Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
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


    // Nếu đã đăng nhập thì chuyển về trang chủ
    fetch('auth.php?action=check').then(r=>r.json()).then(d=>{if(d.logged_in)window.location.href='index.php'}).catch(()=>{});

    // CSRF token
    let csrfToken = '';
    fetch('auth.php?action=get_csrf_token').then(r=>r.json()).then(d=>{csrfToken=d.csrf_token}).catch(()=>{});

    function togglePassword(btn) {
        const p = document.getElementById('password');
        if (p.type === 'password') { p.type = 'text'; btn.textContent = 'Ẩn'; }
        else { p.type = 'password'; btn.textContent = 'Hiện'; }
    }

    function validateField(id) {
        var el = document.getElementById(id);
        var err = el.parentElement.querySelector('.form-error-text');
        if (!el.value.trim()) {
            el.classList.add('input-error'); el.classList.remove('input-success');
            if (err) err.classList.add('visible');
            return false;
        }
        el.classList.remove('input-error'); el.classList.add('input-success');
        if (err) err.classList.remove('visible');
        return true;
    }

    document.getElementById('login-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        var v1 = validateField('username');
        var v2 = validateField('password');
        if (!v1 || !v2) { showToast('⚠ Vui lòng điền đầy đủ thông tin!', 'warning'); return; }

        const btn = document.getElementById('btn-submit');

        const data = {
            username: document.getElementById('username').value.trim(),
            password: document.getElementById('password').value,
            remember: document.getElementById('remember').checked,
            csrf_token: csrfToken
        };

        btn.textContent = ' Đang xử lý...';
        btn.disabled = true;

        try {
            const res = await fetch('auth.php?action=login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await res.json();

            if (result.success) {
                localStorage.setItem('hanngu_user_id', 'user_' + result.user.id);
                localStorage.setItem('hanngu_username', result.user.username);
                localStorage.setItem('hanngu_display_name', result.user.display_name);
                showToast(' Đăng nhập thành công! Đang chuyển hướng...', 'success');
                const isAdmin = result.user.role === 'admin';
                setTimeout(() => { window.location.href = isAdmin ? 'admin.php' : 'index.php'; }, 1000);
            } else {
                showToast(' ' + result.message, 'error');
            }
        } catch (err) {
            showToast(' Lỗi kết nối đến server!', 'error');
        }

        btn.textContent = 'Đăng nhập';
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

<script src="init.js"></script>
<div class="loading-overlay" id="loading-overlay" style="display:none"><div class="spinner spinner--lg"></div></div>
</body>
</html>
