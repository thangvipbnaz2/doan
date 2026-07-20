# Cấu hình thanh toán khóa học

Sao chép `.env.example` thành `.env`, rồi điền thông tin thật. Không đưa `.env` lên Git.

```env
SITE_URL=https://ten-mien-cua-ban.vn
SMTP_HOST=smtp.gmail.com
SMTP_USER=dia-chi-gui@gmail.com
SMTP_PASS=mat-khau-ung-dung-gmail
SMTP_PORT=587
SMTP_ENCRYPTION=tls
SMTP_FROM=dia-chi-gui@gmail.com
SMTP_FROM_NAME=HanNgu
ADMIN_NOTIFICATION_EMAIL=tn8018074@gmail.com

PAYMENT_BANK_CODE=MB
PAYMENT_ACCOUNT_NO=so-tai-khoan
PAYMENT_ACCOUNT_NAME=TEN CHU TAI KHOAN
PAYMENT_WEBHOOK_SECRET=mot-chuoi-ngau-nhien-dai-kho-doan
```

Với Gmail, `SMTP_PASS` phải là **App Password** của tài khoản gửi, không phải mật khẩu đăng nhập Gmail.

## Tự động mở khóa

Cấu hình dịch vụ báo có/chuyển khoản của ngân hàng gọi `https://ten-mien-cua-ban.vn/payment_webhook.php` sau khi nhận tiền. Endpoint chỉ chấp nhận yêu cầu có header sau:

```text
X-Payment-Signature: HMAC-SHA256(raw request body, PAYMENT_WEBHOOK_SECRET)
```

Payload JSON tối thiểu:

```json
{
  "order_code": "HD20260720ABCD1234",
  "transaction_id": "MA_GIAO_DICH_NGAN_HANG",
  "amount": 1490000,
  "status": "paid"
}
```

`order_code` chính là nội dung chuyển khoản hiển thị dưới mã QR. Khi mã đơn và số tiền khớp, hệ thống tự đánh dấu đơn đã thanh toán, tạo hóa đơn, cấp quyền vào khóa học, rồi gửi email cho học viên và `tn8018074@gmail.com`. Webhook gửi lại cùng giao dịch sẽ được xử lý an toàn, không tạo hóa đơn trùng.

Cuối cùng, chạy `php run_commerce_migration.php` một lần để tạo bảng bán khóa học và đồng bộ toàn bộ 6 khóa HSK cùng chương trình học chi tiết.
