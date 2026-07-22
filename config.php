<?php
$env = [];
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) continue;
        $parts = explode('=', $line, 2);
        $env[trim($parts[0])] = trim($parts[1]);
    }
}

define('GEMINI_API_KEY', $env['GEMINI_API_KEY'] ?? '');
define('AI_UPLOAD_DIR', __DIR__ . '/uploads/ai/');
define('SITE_URL', $env['SITE_URL'] ?? 'http://localhost/do-an-tot-nghiep');
define('SMTP_HOST', $env['SMTP_HOST'] ?? '');
define('SMTP_USER', $env['SMTP_USER'] ?? '');
define('SMTP_PASS', $env['SMTP_PASS'] ?? '');
define('SMTP_PORT', $env['SMTP_PORT'] ?? 587);
define('SMTP_ENCRYPTION', $env['SMTP_ENCRYPTION'] ?? 'tls');
define('SMTP_FROM', $env['SMTP_FROM'] ?? 'noreply@hanngu.local');
define('SMTP_FROM_NAME', $env['SMTP_FROM_NAME'] ?? 'HànNgữ');
