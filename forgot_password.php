<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu - HànNgữ</title>
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
    </style>
<script src="utils.js"></script>
</head>
<body>
    
    <main class="auth-page">
        <div class="auth-card">
            <h1 class="auth-card__title">Quên mật khẩu</h1>
            <p class="auth-card__desc" id="step-desc">Nhập email đã đăng ký để nhận mã OTP đặt lại mật khẩu.</p>

            <!-- Bước 1: Nhập email -->
            <form id="step-email">
                <div class="fg">
                    <label for="email"><i class="bi bi-envelope"></i> Email</label>
                    <input type="email" id="email" placeholder="Nhập email của bạn" required>
                </div>
                <button type="submit" class="btn btn--primary btn--block ripple" id="btn-email">Gửi yêu cầu</button>
            </form>

            <!-- Bước 2: Nhập OTP (ẩn ban đầu) -->
            <form id="step-otp" style="display:none">
                <div class="fg">
                    <label for="otp"><i class="bi bi-shield-check"></i> Mã OTP</label>
                    <input type="text" id="otp" placeholder="Nhập mã OTP 6 số" maxlength="6" inputmode="numeric" pattern="[0-9]*" required>
                </div>
                <button type="submit" class="btn btn--primary btn--block ripple" id="btn-otp">Xác thực OTP</button>
                <p style="text-align:center;margin-top:12px;font-size:.82rem;color:var(--gray)">
                    <a href="#" id="resend-otp" style="color:var(--teal)">Gửi lại mã</a>
                </p>
            </form>

            <div class="auth-footer">
                <a href="login.php">← Quay lại đăng nhập</a>
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
    let currentEmail = '';

    // Bước 1: Gửi yêu cầu -> nhận OTP qua email
    document.getElementById('step-email').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-email');
        const email = document.getElementById('email').value.trim();
        if (!email) { showToast(' Vui lòng nhập email', 'error'); return; }

        btn.textContent = ' Đang xử lý...';
        btn.disabled = true;

        try {
            const res = await fetch('api.php?action=forgot_password', {
                method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ email })
            });
            const r = await res.json();
            if (r.success) {
                currentEmail = email;
                document.getElementById('step-email').style.display = 'none';
                document.getElementById('step-otp').style.display = 'block';
                document.getElementById('step-desc').textContent = 'Nhập mã OTP đã được gửi đến email của bạn.';
                showToast(' ' + r.message, 'success');
            } else {
                showToast(' ' + r.message, 'error');
            }
        } catch (err) {
            showToast(' Lỗi kết nối!', 'error');
        }

        btn.textContent = 'Gửi yêu cầu';
        btn.disabled = false;
    });

    // Bước 2: Xác thực OTP
    document.getElementById('step-otp').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = document.getElementById('btn-otp');
        const otp = document.getElementById('otp').value.trim();
        if (!otp || otp.length !== 6) { showToast(' Nhập mã OTP 6 số', 'error'); return; }

        btn.textContent = ' Đang xác thực...';
        btn.disabled = true;

        try {
            const res = await fetch('api.php?action=verify_otp', {
                method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ email: currentEmail, otp })
            });
            const r = await res.json();
            if (r.success) {
                showToast(' ' + r.message, 'success');
                setTimeout(() => { window.location.href = 'reset_password.php?token=' + r.token; }, 1000);
            } else {
                showToast(' ' + r.message, 'error');
            }
        } catch (err) {
            showToast(' Lỗi kết nối!', 'error');
        }

        btn.textContent = 'Xác thực OTP';
        btn.disabled = false;
    });

    // Gửi lại OTP
    document.getElementById('resend-otp').addEventListener('click', async (e) => {
        e.preventDefault();
        if (!currentEmail) return;
        const link = document.getElementById('resend-otp');
        link.textContent = 'Đang gửi...';
        try {
            const res = await fetch('api.php?action=forgot_password', {
                method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ email: currentEmail })
            });
            const r = await res.json();
            showToast(r.success ? ' Đã gửi lại mã OTP' : ' ' + r.message, r.success ? 'success' : 'error');
        } catch (err) {
            showToast(' Lỗi kết nối!', 'error');
        }
        link.textContent = 'Gửi lại mã';
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
