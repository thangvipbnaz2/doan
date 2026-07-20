<?php
// Các hàm dùng chung cho module khóa học trả phí.
function commerceInput(): array {
    $data = json_decode(file_get_contents('php://input'), true);
    return is_array($data) ? $data : $_POST;
}

function commerceRequireLogin(): int {
    if (empty($_SESSION['user_id'])) {
        throw new RuntimeException('Vui lòng đăng nhập để tiếp tục.');
    }
    return (int) $_SESSION['user_id'];
}

function commerceRequireAdmin(PDO $conn): int {
    $userId = commerceRequireLogin();
    $stmt = $conn->prepare('SELECT role FROM users WHERE id = ?');
    $stmt->execute([$userId]);
    if ($stmt->fetchColumn() !== 'admin') throw new RuntimeException('Bạn không có quyền quản trị.');
    return $userId;
}

function commerceOrderCode(): string {
    return 'HN' . date('ymd') . strtoupper(bin2hex(random_bytes(4)));
}

function commerceInvoiceNumber(int $orderId): string {
    return 'HD-HN-' . date('Ymd') . '-' . str_pad((string)$orderId, 6, '0', STR_PAD_LEFT);
}

function commerceQrUrl(string $orderCode, float $amount): string {
    if (!PAYMENT_BANK_CODE || !PAYMENT_ACCOUNT_NO) return '';
    $base = 'https://img.vietqr.io/image/' . rawurlencode(PAYMENT_BANK_CODE) . '-' . rawurlencode(PAYMENT_ACCOUNT_NO) . '-compact2.png';
    return $base . '?' . http_build_query([
        'amount' => (int)$amount,
        'addInfo' => $orderCode,
        'accountName' => PAYMENT_ACCOUNT_NAME,
    ]);
}

function commerceOrderDetails(PDO $conn, int $orderId): array {
    $stmt = $conn->prepare("SELECT o.*, c.title AS course_title, c.slug AS course_slug, u.username, u.display_name, u.email,
        i.invoice_number, i.issued_at AS invoice_issued_at
        FROM orders o JOIN courses c ON c.id=o.course_id JOIN users u ON u.id=o.user_id
        LEFT JOIN invoices i ON i.order_id=o.id WHERE o.id=?");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch();
    if (!$order) throw new RuntimeException('Không tìm thấy đơn hàng.');
    return $order;
}

function commerceCompletePayment(PDO $conn, int $orderId, string $transactionId, string $provider, string $payload, ?int $adminId = null): array {
    $conn->beginTransaction();
    try {
        $stmt = $conn->prepare('SELECT * FROM orders WHERE id=? FOR UPDATE');
        $stmt->execute([$orderId]);
        $order = $stmt->fetch();
        if (!$order) throw new RuntimeException('Đơn hàng không tồn tại.');
        if ($order['status'] === 'paid') { $conn->commit(); return commerceOrderDetails($conn, $orderId); }
        if ($order['status'] !== 'pending') throw new RuntimeException('Đơn hàng không còn ở trạng thái chờ thanh toán.');

        $existing = $conn->prepare('SELECT id FROM payments WHERE provider_transaction_id=?');
        $existing->execute([$transactionId]);
        if ($transactionId !== '' && $existing->fetchColumn()) throw new RuntimeException('Mã giao dịch đã được sử dụng.');

        $payment = $conn->prepare("INSERT INTO payments (order_id,provider,provider_transaction_id,amount,status,raw_payload,confirmed_by,confirmed_at)
            VALUES (?,?,?,?, 'paid',?,?,NOW())");
        $payment->execute([$orderId, $provider, $transactionId ?: null, $order['amount'], $payload, $adminId]);
        $conn->prepare("UPDATE orders SET status='paid', paid_at=NOW() WHERE id=?")->execute([$orderId]);
        $conn->prepare('INSERT IGNORE INTO enrollments (user_id,course_id,order_id) VALUES (?,?,?)')->execute([$order['user_id'], $order['course_id'], $orderId]);
        $invoice = commerceInvoiceNumber($orderId);
        $conn->prepare('INSERT INTO invoices (invoice_number,order_id) VALUES (?,?)')->execute([$invoice, $orderId]);
        $conn->commit();
        return commerceOrderDetails($conn, $orderId);
    } catch (Throwable $e) {
        if ($conn->inTransaction()) $conn->rollBack();
        throw $e;
    }
}

function commerceSendInvoiceEmail(PDO $conn, array $order): bool {
    if (!$order['email'] || !SMTP_HOST || !SMTP_USER || !SMTP_PASS) return false;
    try {
        require_once __DIR__ . '/phpmailer/PHPMailer.php';
        require_once __DIR__ . '/phpmailer/SMTP.php';
        require_once __DIR__ . '/phpmailer/Exception.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        $mail->isSMTP(); $mail->Host = SMTP_HOST; $mail->SMTPAuth = true;
        $mail->Username = SMTP_USER; $mail->Password = SMTP_PASS; $mail->Port = SMTP_PORT;
        $mail->SMTPSecure = SMTP_ENCRYPTION; $mail->CharSet = 'UTF-8';
        $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME); $mail->addAddress($order['email'], $order['display_name'] ?: $order['username']);
        $mail->isHTML(true); $mail->Subject = 'Hóa đơn ' . $order['invoice_number'] . ' - ' . SMTP_FROM_NAME;
        $invoiceUrl = SITE_URL . '/invoice.php?order=' . $order['id'];
        $mail->Body = '<h2>Cảm ơn bạn đã mua khóa học!</h2><p>Khóa học: <strong>' . htmlspecialchars($order['course_title']) . '</strong></p>'
            . '<p>Thanh toán: <strong>' . number_format($order['amount']) . ' đ</strong></p><p>Mã hóa đơn: <strong>' . htmlspecialchars($order['invoice_number']) . '</strong></p>'
            . '<p><a href="' . htmlspecialchars($invoiceUrl) . '">Tải hóa đơn PDF</a> · <a href="' . htmlspecialchars(SITE_URL . '/course.php?slug=' . $order['course_slug']) . '">Vào học ngay</a></p>';
        $mail->AltBody = "Hóa đơn {$order['invoice_number']} - {$order['course_title']}. Tải PDF: $invoiceUrl";
        $mail->send();
        $conn->prepare('UPDATE invoices SET email_sent_at=NOW() WHERE order_id=?')->execute([$order['id']]);
        return true;
    } catch (Throwable $e) { return false; }
}
