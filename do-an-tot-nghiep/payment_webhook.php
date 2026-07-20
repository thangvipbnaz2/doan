<?php
// Endpoint cho dịch vụ báo có. Cấu hình URL: https://ten-mien/payment_webhook.php
// Dịch vụ phải gửi HMAC SHA-256 của body ở header X-Payment-Signature.
require 'db.php'; require 'config.php'; require 'commerce.php';
header('Content-Type: application/json; charset=utf-8');
$raw=file_get_contents('php://input');
$signature=$_SERVER['HTTP_X_PAYMENT_SIGNATURE'] ?? '';
if (!PAYMENT_WEBHOOK_SECRET || !$signature || !hash_equals(hash_hmac('sha256',$raw,PAYMENT_WEBHOOK_SECRET),$signature)) { http_response_code(401); echo json_encode(['success'=>false,'message'=>'Unauthorized']); exit; }
$data=json_decode($raw,true); if (!is_array($data)) $data=$_POST;
$code=trim($data['order_code'] ?? $data['content'] ?? '');
$transactionId=trim($data['transaction_id'] ?? $data['reference'] ?? '');
$amount=(int)($data['amount'] ?? 0); $status=strtolower((string)($data['status'] ?? 'paid'));
try {
    if ($status !== 'paid' || !$code || !$transactionId) throw new RuntimeException('Dữ liệu thanh toán không hợp lệ.');
    $s=$conn->prepare('SELECT id,amount FROM orders WHERE order_code=?'); $s->execute([$code]); $row=$s->fetch();
    if (!$row || (int)$row['amount']!==$amount) throw new RuntimeException('Không khớp mã đơn hoặc số tiền.');
    $order=commerceCompletePayment($conn,(int)$row['id'],$transactionId,'bank_webhook',$raw,null);
    commerceSendInvoiceEmail($conn,$order);
    echo json_encode(['success'=>true,'invoice_number'=>$order['invoice_number']]);
} catch(Throwable $e) { http_response_code(400); echo json_encode(['success'=>false,'message'=>$e->getMessage()]); }
