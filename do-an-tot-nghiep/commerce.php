<?php

function commerceInput(): array
{
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);
    return is_array($data) ? $data : ($_POST ?: []);
}

function commerceRequireLogin(): int
{
    if (empty($_SESSION['user_id']))
        throw new RuntimeException('Vui lòng đăng nhập.');
    return (int) $_SESSION['user_id'];
}

function commerceRequireAdmin(PDO $conn): int
{
    $userId = commerceRequireLogin();
    $s = $conn->prepare('SELECT role FROM users WHERE id=?');
    $s->execute([$userId]);
    $role = $s->fetchColumn();
    if ($role !== 'admin')
        throw new RuntimeException('Bạn không có quyền quản trị.');
    return $userId;
}

function commerceOrderCode(): string
{
    return 'HD' . date('YmdHis') . strtoupper(bin2hex(random_bytes(4)));
}

function commerceOrderDetails(PDO $conn, int $orderId): array
{
    $s = $conn->prepare(
        'SELECT o.*, c.title course_title, c.slug course_slug,
                u.username, u.display_name, u.email,
                i.invoice_number, i.issued_at invoice_issued_at
         FROM orders o
         JOIN courses c ON c.id = o.course_id
         JOIN users u ON u.id = o.user_id
         LEFT JOIN invoices i ON i.order_id = o.id
         WHERE o.id = ?'
    );
    $s->execute([$orderId]);
    $order = $s->fetch();
    if (!$order)
        throw new RuntimeException('Đơn hàng không tồn tại.');
    return $order;
}

function commerceQrUrl(string $orderCode, float $amount): string
{
    $bankCode = defined('PAYMENT_BANK_CODE') ? PAYMENT_BANK_CODE : 'MB';
    $accountNo = defined('PAYMENT_ACCOUNT_NO') ? PAYMENT_ACCOUNT_NO : '';
    $accountName = defined('PAYMENT_ACCOUNT_NAME') ? PAYMENT_ACCOUNT_NAME : '';
    $amountInt = (int) $amount;
    $description = urlencode('TT ' . $orderCode);
    $qrUrl = "https://img.vietqr.io/image/{$bankCode}-{$accountNo}-compact2.jpg?amount={$amountInt}&addInfo={$description}&accountName=" . urlencode($accountName);
    return $qrUrl;
}

function commerceCompletePayment(PDO $conn, int $orderId, string $transactionId, string $method, ?string $rawData, ?int $adminId): array
{
    if ($orderId <= 0 || trim($transactionId) === '') {
        throw new RuntimeException('Missing payment transaction ID.');
    }

    $conn->beginTransaction();
    try {
        $s = $conn->prepare('SELECT * FROM orders WHERE id=? FOR UPDATE');
        $s->execute([$orderId]);
        $order = $s->fetch();
        // Webhook providers retry deliveries. A retry for the same bank
        // transaction must not create another payment, invoice or enrolment.
        if ($order && $order['status'] === 'paid') {
            $payment = $conn->prepare("SELECT provider_transaction_id FROM payments WHERE order_id=? AND status='paid' LIMIT 1");
            $payment->execute([$orderId]);
            $savedTransactionId = (string) $payment->fetchColumn();
            if ($savedTransactionId !== '' && !hash_equals($savedTransactionId, trim($transactionId))) {
                throw new RuntimeException('Order was paid by a different transaction.');
            }
            $conn->commit();
            return commerceOrderDetails($conn, $orderId);
        }
        if (!$order)
            throw new RuntimeException('Đơn hàng không hợp lệ hoặc đã xử lý.');

        if ($order['status'] !== 'pending') {
            throw new RuntimeException('Order is not awaiting payment.');
        }

        $now = date('Y-m-d H:i:s');
        $invNumber = 'INV-' . strtoupper(bin2hex(random_bytes(6)));

        $conn->prepare("UPDATE orders SET status='paid', paid_at=? WHERE id=?")
            ->execute([$now, $orderId]);

        $conn->prepare("INSERT INTO payments (order_id, provider, provider_transaction_id, amount, status, raw_payload, confirmed_by, confirmed_at) VALUES (?,?,?,?,?,?,?,?)")
            ->execute([$orderId, $method, $transactionId, $order['amount'], 'paid', $rawData, $adminId, $now]);

        $conn->prepare("INSERT INTO invoices (invoice_number, order_id, issued_at) VALUES (?,?,?)")
            ->execute([$invNumber, $orderId, $now]);

        $conn->prepare("INSERT IGNORE INTO enrollments (user_id, course_id, order_id) VALUES (?,?,?)")
            ->execute([$order['user_id'], $order['course_id'], $orderId]);

        $conn->commit();

        return commerceOrderDetails($conn, $orderId);
    } catch (Throwable $e) {
        if ($conn->inTransaction())
            $conn->rollBack();
        throw $e;
    }
}

function commerceSendInvoiceEmail(PDO $conn, array $order): bool
{
    if (!defined('SMTP_HOST') || !SMTP_HOST || !defined('SMTP_USER') || !SMTP_USER || !defined('SMTP_PASS') || !SMTP_PASS)
        return false;

    try {
        require_once __DIR__ . '/phpmailer/PHPMailer.php';
        require_once __DIR__ . '/phpmailer/SMTP.php';
        require_once __DIR__ . '/phpmailer/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER;
        $mail->Password = SMTP_PASS;
        $mail->SMTPSecure = defined('SMTP_ENCRYPTION') ? SMTP_ENCRYPTION : 'tls';
        $mail->Port = defined('SMTP_PORT') ? SMTP_PORT : 587;
        $mail->CharSet = 'UTF-8';

        $fromEmail = defined('SMTP_FROM') ? SMTP_FROM : 'noreply@hanngu.local';
        $fromName = defined('SMTP_FROM_NAME') ? SMTP_FROM_NAME : 'HànNgữ';
        $mail->setFrom($fromEmail, $fromName);

        $userEmail = trim((string) ($order['email'] ?? ''));
        $userName = ($order['display_name'] ?? $order['username'] ?? '');
        $adminEmail = trim((string) (defined('ADMIN_NOTIFICATION_EMAIL') ? ADMIN_NOTIFICATION_EMAIL : ''));
        if (!$userEmail && !$adminEmail) return false;
        if ($userEmail) $mail->addAddress($userEmail, $userName);
        if ($adminEmail && strcasecmp($adminEmail, $userEmail) !== 0)
            $mail->addAddress($adminEmail, 'HanNgu admin');

        $invoiceLink = SITE_URL . '/invoice.php?order=' . $order['id'];
        $mail->isHTML(true);
        $mail->Subject = 'Xác nhận đăng ký khóa học - ' . $fromName;
        $mail->Body = '
            <h2>Xác nhận đăng ký thành công</h2>
            <p>Xin chào <strong>' . htmlspecialchars($userName) . '</strong>,</p>
            <p>Bạn đã đăng ký khóa học <strong>' . htmlspecialchars($order['course_title'] ?? '') . '</strong>.</p>
            <p><b>Mã hóa đơn:</b> ' . htmlspecialchars($order['invoice_number'] ?? '') . '</p>
            <p><b>Học phí:</b> ' . ((float)($order['amount'] ?? 0) <= 0 ? 'Miễn phí' : number_format((float)($order['amount'] ?? 0)) . ' đ') . '</p>
            <p>Bạn có thể xem thông tin tại: <a href="' . $invoiceLink . '">' . $invoiceLink . '</a></p>
            <p>Chúc bạn học tập tốt!</p>';

        $mail->send();

        $conn->prepare("UPDATE invoices SET email_sent_at=NOW() WHERE order_id=?")
            ->execute([$order['id']]);

        return true;
    } catch (Throwable $e) {
        return false;
    }
}
