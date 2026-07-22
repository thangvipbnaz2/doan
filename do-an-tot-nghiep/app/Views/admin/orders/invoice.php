<div class="admin-header">
    <h1>Hóa đơn #<?= App\Helpers\View::escape($order['id']) ?></h1>
    <a href="/admin/orders" class="btn" style="padding: 10px 20px; background: #636e72; color: #fff; border-radius: 8px; text-decoration: none;">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
    <button onclick="window.print()" class="btn" style="padding: 10px 20px; background: #4facfe; color: #fff; border-radius: 8px; border: none; cursor: pointer;">
        <i class="fas fa-print"></i> In hóa đơn
    </button>
</div>

<div class="card" style="background: #fff; border-radius: 12px; padding: 40px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); max-width: 800px; margin: 0 auto;">
    <div style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px dashed #eee;">
        <h2 style="font-size: 28px; color: #e94560;">HànNgữ</h2>
        <p style="color: #666;">Học tiếng Trung Online</p>
        <h3 style="margin-top: 16px; color: #2d3436;">HÓA ĐƠN THANH TOÁN</h3>
    </div>

    <div style="display: flex; justify-content: space-between; margin-bottom: 30px;">
        <div>
            <p><strong>Mã đơn hàng:</strong> #<?= App\Helpers\View::escape($order['id']) ?></p>
            <p><strong>Ngày tạo:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
            <p><strong>Trạng thái:</strong>
                <span style="color: <?= $order['status'] === 'completed' ? '#43e97b' : ($order['status'] === 'pending' ? '#ffc107' : '#f5576c') ?>;">
                    <?= $order['status'] === 'completed' ? 'Đã thanh toán' : ($order['status'] === 'pending' ? 'Chờ thanh toán' : 'Đã hủy') ?>
                </span>
            </p>
        </div>
        <div style="text-align: right;">
            <p><strong>Khách hàng:</strong> <?= App\Helpers\View::escape($order['fullname']) ?></p>
            <p><strong>Email:</strong> <?= App\Helpers\View::escape($order['email']) ?></p>
            <p><strong>Địa chỉ:</strong> <?= App\Helpers\View::escape($order['address'] ?? '') ?></p>
        </div>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #eee;">STT</th>
                <th style="padding: 12px; text-align: left; border-bottom: 2px solid #eee;">Sản phẩm</th>
                <th style="padding: 12px; text-align: right; border-bottom: 2px solid #eee;">Đơn giá</th>
                <th style="padding: 12px; text-align: center; border-bottom: 2px solid #eee;">Số lượng</th>
                <th style="padding: 12px; text-align: right; border-bottom: 2px solid #eee;">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $i => $item): ?>
            <tr>
                <td style="padding: 12px; border-bottom: 1px solid #eee;"><?= $i + 1 ?></td>
                <td style="padding: 12px; border-bottom: 1px solid #eee;"><?= App\Helpers\View::escape($item['name'] ?? 'Khóa học') ?></td>
                <td style="padding: 12px; text-align: right; border-bottom: 1px solid #eee;"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                <td style="padding: 12px; text-align: center; border-bottom: 1px solid #eee;"><?= (int)($item['quantity'] ?? 1) ?></td>
                <td style="padding: 12px; text-align: right; border-bottom: 1px solid #eee;"><?= number_format($item['price'] * ($item['quantity'] ?? 1), 0, ',', '.') ?>đ</td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($items)): ?>
            <tr><td colspan="5" style="padding: 20px; text-align: center; color: #999;">Không có chi tiết đơn hàng</td></tr>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="padding: 12px; text-align: right; font-weight: 600;">Tổng cộng:</td>
                <td style="padding: 12px; text-align: right; font-weight: 600; font-size: 18px; color: #e94560;">
                    <?= number_format($order['amount'], 0, ',', '.') ?>đ
                </td>
            </tr>
        </tfoot>
    </table>

    <?php if ($order['status'] === 'completed' && !empty($order['paid_at'])): ?>
    <div style="text-align: center; margin-top: 20px; padding: 16px; background: #f0fff4; border-radius: 8px; color: #43e97b;">
        <i class="fas fa-check-circle"></i> Đã thanh toán ngày <?= date('d/m/Y H:i', strtotime($order['paid_at'])) ?>
    </div>
    <?php endif; ?>

    <div style="text-align: center; margin-top: 40px; color: #999; font-size: 13px; border-top: 1px solid #eee; padding-top: 20px;">
        <p>Cảm ơn bạn đã sử dụng dịch vụ của HànNgữ!</p>
        <p>Mọi thắc mắc vui lòng liên hệ: support@hanngu.vn</p>
    </div>
</div>

<style>
@media print {
    .admin-header, .admin-sidebar, .btn { display: none !important; }
    .admin-content { margin-left: 0 !important; padding: 20px !important; }
}
</style>