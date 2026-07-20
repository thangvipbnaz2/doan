<?php
require 'config.php';
if (!PAYMENT_BANK_CODE || !PAYMENT_ACCOUNT_NO) { http_response_code(500); exit('Chưa cấu hình tài khoản nhận tiền.'); }
$qr = 'https://img.vietqr.io/image/' . rawurlencode(PAYMENT_BANK_CODE) . '-' . rawurlencode(PAYMENT_ACCOUNT_NO) . '-compact2.png?' . http_build_query(['accountName' => PAYMENT_ACCOUNT_NAME]);
?>
<!doctype html>
<html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>QR nhận tiền | HànNgữ</title>
<style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:linear-gradient(145deg,#eff6ff,#ecfeff);font-family:system-ui,sans-serif;color:#0f172a}.card{width:min(420px,calc(100vw - 40px));background:#fff;padding:28px;border-radius:24px;text-align:center;box-shadow:0 16px 45px #0f172a25}.card h1{margin:0 0 8px;font-size:1.35rem}.card p{color:#475569}.qr{display:block;width:100%;margin:22px auto;border-radius:14px}.account{background:#f0fdfa;border-radius:12px;padding:12px;font-weight:700}.hint{font-size:.86rem;color:#64748b}</style></head>
<body><main class="card"><h1>QR nhận tiền HànNgữ</h1><p>Quét mã bằng ứng dụng ngân hàng bất kỳ.</p><img class="qr" src="<?= htmlspecialchars($qr) ?>" alt="Mã QR nhận tiền MB Bank"><div class="account"><?= htmlspecialchars(PAYMENT_ACCOUNT_NAME) ?><br><?= htmlspecialchars(PAYMENT_ACCOUNT_NO) ?> · MB Bank</div><p class="hint">Khi mua khóa học, hãy dùng QR tại trang thanh toán để hệ thống gắn đúng mã đơn và số tiền.</p></main></body></html>
