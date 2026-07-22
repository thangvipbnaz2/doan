<div class="admin-header">
            <h1>Đơn hàng</h1>
        </div>

        <div class="admin-card">
            <div class="filters">
                <form method="GET">
                    <select name="status" onchange="this.form.submit()">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="paid" <?= $status === 'paid' ? 'selected' : '' ?>>Đã thanh toán</option>
                        <option value="cancelled" <?= $status === 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                        <option value="expired" <?= $status === 'expired' ? 'selected' : '' ?>>Hết hạn</option>
                        <option value="refunded" <?= $status === 'refunded' ? 'selected' : '' ?>>Hoàn tiền</option>
                    </select>
                </form>
            </div>
            <table class="admin-table">
                <thead><tr><th>Mã ĐH</th><th>Khách hàng</th><th>Khóa học</th><th>Số tiền</th><th>Trạng thái</th><th>Ngày tạo</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($orders)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--gray)">Chưa có đơn hàng nào</td></tr>
                <?php else: ?>
                    <?php foreach ($orders as $o): ?>
                    <tr>
                        <td style="font-weight:600">#<?= (int)$o['id'] ?></td>
                        <td><?= escape($o['display_name'] ?: $o['username']) ?></td>
                        <td style="font-size:.82rem"><?= escape($o['course_title'] ?? '-') ?></td>
                        <td style="font-weight:600"><?= number_format($o['amount'], 0, ',', '.') ?>₫</td>
                        <td><span class="badge badge-<?= $o['status'] ?>"><?= escape($o['status']) ?></span></td>
                        <td style="font-size:.82rem;color:var(--gray)"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <?php if ($o['status'] === 'pending'): ?>
                                <a href="/admin/orders/confirm/<?= (int)$o['id'] ?>" class="btn btn--small btn--success">Xác nhận</a>
                                <a href="/admin/orders/cancel/<?= (int)$o['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Hủy đơn hàng #<?= (int)$o['id'] ?>?')">Hủy</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <?php $perPage = 20; if ($total > $perPage): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                <a href="/admin/orders?page=<?= $p ?>&status=<?= escape($status) ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>