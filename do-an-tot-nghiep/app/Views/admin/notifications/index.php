<div class="admin-header">
    <h1>Thông báo</h1>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Loại</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($notifications)): ?>
            <tr>
                <td colspan="7" style="text-align: center; padding: 40px; color: var(--gray);">Không có thông báo nào</td>
            </tr>
            <?php else: ?>
            <?php foreach ($notifications as $n): ?>
            <tr>
                <td><?= (int) $n['id'] ?></td>
                <td><?= escape($n['display_name'] ?? $n['username'] ?? 'N/A') ?></td>
                <td><span class="badge badge-<?= $n['type'] ?>"><?= escape($n['type']) ?></span></td>
                <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?= escape(mb_substr($n['message'], 0, 80)) ?></td>
                <td><?= $n['is_read'] ? '<span style="color: #43e97b;">Đã đọc</span>' : '<span style="color: #e94560; font-weight: 600;">Chưa đọc</span>' ?></td>
                <td style="font-size: 13px; color: var(--gray);"><?= date('d/m/Y H:i', strtotime($n['created_at'])) ?></td>
                <td class="actions">
                    <?php if (!$n['is_read']): ?>
                    <form method="POST" action="/admin/notifications/mark-read/<?= (int) $n['id'] ?>" style="display: inline;">
                        <button type="submit" class="btn btn--small btn--primary">Đã đọc</button>
                    </form>
                    <?php endif; ?>
                    <form method="POST" action="/admin/notifications/delete/<?= (int) $n['id'] ?>" style="display: inline;" onsubmit="return confirm('Xóa thông báo này?')">
                        <button type="submit" class="btn btn--small btn--danger">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if ($total > 20): ?>
    <div class="pagination">
        <?php for ($p = 1; $p <= $lastPage; $p++): ?>
        <a href="/admin/notifications?page=<?= $p ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>
