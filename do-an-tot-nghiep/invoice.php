<?php
session_start(); require 'db.php'; require 'config.php'; require 'commerce.php';
try {
    $order=commerceOrderDetails($conn,(int)($_GET['order']??0)); $userId=commerceRequireLogin();
    if ((int)$order['user_id']!==$userId) commerceRequireAdmin($conn);
    if ($order['status']!=='paid' || !$order['invoice_number']) throw new RuntimeException('Hóa đơn chưa sẵn sàng.');
    require_once __DIR__ . '/tcpdf/tcpdf.php';
    $pdf=new TCPDF(); $pdf->SetCreator('HànNgữ'); $pdf->SetTitle($order['invoice_number']); $pdf->SetMargins(18,18,18); $pdf->AddPage(); $pdf->SetFont('dejavusans','',11);
    $amountText = ((int)$order['amount'] <= 0) ? 'Miễn phí' : number_format($order['amount']) . ' đ';
    $html='<h1>XÁC NHẬN ĐĂNG KÝ KHÓA HỌC</h1><p><b>Mã hóa đơn:</b> '.htmlspecialchars($order['invoice_number']).'<br><b>Ngày phát hành:</b> '.htmlspecialchars($order['invoice_issued_at']).'</p><hr><p><b>Khách hàng:</b> '.htmlspecialchars($order['display_name']?:$order['username']).'<br><b>Email:</b> '.htmlspecialchars($order['email']).'</p><table border="1" cellpadding="7"><tr style="font-weight:bold"><th>Khóa học</th><th>Học phí</th></tr><tr><td>'.htmlspecialchars($order['course_title']).'</td><td align="right">'.$amountText.'</td></tr><tr><td align="right"><b>Tổng cộng</b></td><td align="right"><b>'.$amountText.'</b></td></tr></table><p><b>Trạng thái: Đã đăng ký</b><br>Mã đơn hàng: '.htmlspecialchars($order['order_code']).'</p>';
    $pdf->writeHTML($html,true,false,true,false,''); $pdf->Output($order['invoice_number'].'.pdf','I');
} catch(Throwable $e) { http_response_code(403); echo htmlspecialchars($e->getMessage()); }
