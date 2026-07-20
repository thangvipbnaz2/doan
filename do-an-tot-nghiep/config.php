<?php
// Load từ .env nếu có
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '=') !== false && strpos(trim($line), '#') !== 0) {
            putenv(trim($line));
        }
    }
}

define('GEMINI_API_KEY', getenv('GEMINI_API_KEY') ?: '');
define('AI_UPLOAD_DIR', __DIR__ . '/uploads/ai/');
define('SITE_URL', getenv('SITE_URL') ?: 'http://localhost/do-an-tot-nghiep');
define('SMTP_HOST', getenv('SMTP_HOST') ?: '');
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
define('SMTP_ENCRYPTION', getenv('SMTP_ENCRYPTION') ?: 'tls');
define('SMTP_FROM', getenv('SMTP_FROM') ?: 'noreply@hanngu.local');
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: 'HànNgữ');
// Thanh toán: chỉ điền các giá trị này trong file .env, không đưa vào Git.
define('PAYMENT_BANK_CODE', getenv('PAYMENT_BANK_CODE') ?: '');
define('PAYMENT_ACCOUNT_NO', getenv('PAYMENT_ACCOUNT_NO') ?: '');
define('PAYMENT_ACCOUNT_NAME', getenv('PAYMENT_ACCOUNT_NAME') ?: '');
define('PAYMENT_WEBHOOK_SECRET', getenv('PAYMENT_WEBHOOK_SECRET') ?: '');
