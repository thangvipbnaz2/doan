<?php $base = App\Helpers\View::baseUrl(); $userId = App\Helpers\Session::get('user_id'); ?>
<div class="notif-page">
    <div class="notif-header">
        <div>
            <h1>Thông báo</h1>
            <p class="notif-subtitle">
                <?= $total ?> thông báo
                <?php if ($unreadCount > 0): ?>
                · <span class="unread-badge"><?= $unreadCount ?> chưa đọc</span>
                <?php endif; ?>
            </p>
        </div>
        <?php if ($unreadCount > 0): ?>
        <a href="<?= $base ?>/notifications/mark-all-read" class="btn btn--outline btn--small">Đánh dấu tất cả đã đọc</a>
        <?php endif; ?>
    </div>

    <div class="notif-list">
        <?php if (empty($notifications)): ?>
        <div class="notif-empty">
            <div class="notif-empty-icon">🔔</div>
            <h3>Chưa có thông báo</h3>
            <p>Bạn sẽ nhận được thông báo khi có hoạt động mới</p>
        </div>
        <?php else: ?>
            <?php foreach ($notifications as $n): ?>
            <div class="notif-item <?= $n['is_read'] ? 'read' : 'unread' ?>">
                <div class="notif-icon notif-<?= $n['type'] ?>">
                    <?php
                    $icons = ['streak' => '🔥', 'achievement' => '🏆', 'reminder' => '⏰', 'payment' => '💰', 'course' => '📚', 'system' => '🔔'];
                    echo $icons[$n['type']] ?? '🔔';
                    ?>
                </div>
                <div class="notif-body">
                    <div class="notif-title"><?= App\Helpers\View::escape($n['title'] ?? '') ?></div>
                    <div class="notif-message"><?= App\Helpers\View::escape($n['message']) ?></div>
                    <div class="notif-time"><?= date('d/m/Y H:i', strtotime($n['created_at'])) ?></div>
                </div>
                <div class="notif-actions">
                    <?php if (!$n['is_read']): ?>
                    <a href="<?= $base ?>/notifications/mark-read/<?= $n['id'] ?>" class="btn btn--small btn--ghost" title="Đánh dấu đã đọc">✓</a>
                    <?php endif; ?>
                    <?php if ($n['link']): ?>
                    <a href="<?= $base ?>/<?= App\Helpers\View::escape($n['link']) ?>" class="btn btn--small btn--primary">Xem</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($lastPage > 1): ?>
    <div class="pagination" style="justify-content:center;margin-top:32px">
        <?php for ($p = 1; $p <= $lastPage; $p++): ?>
        <a href="<?= $base ?>/notifications?page=<?= $p ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>

<style>
.notif-page{max-width:720px;margin:auto;padding:104px 24px 64px}
.notif-header{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:32px;flex-wrap:wrap;gap:12px}
.notif-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);margin:0 0 4px}
.notif-subtitle{color:var(--gray);font-size:.9rem;margin:0}
.unread-badge{color:var(--coral);font-weight:600}
.notif-list{display:flex;flex-direction:column;gap:8px}
.notif-item{display:flex;gap:16px;align-items:flex-start;padding:16px 20px;border-radius:var(--radius-sm);background:#fff;border:1px solid var(--gray-light);transition:var(--transition)}
.notif-item.unread{background:#f0fdfa;border-color:#99f6e4}
.notif-item:hover{box-shadow:var(--shadow)}
.notif-icon{font-size:1.5rem;width:40px;height:40px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:var(--gray-light);flex-shrink:0}
.notif-streak{background:#fef3c7}
.notif-achievement{background:#fef9c3}
.notif-reminder{background:#dbeafe}
.notif-payment{background:#d1fae5}
.notif-course{background:#ede9fe}
.notif-system{background:#f1f5f9}
.notif-body{flex:1;min-width:0}
.notif-title{font-weight:600;font-size:.95rem;color:var(--dark);margin-bottom:2px}
.notif-message{font-size:.85rem;color:var(--gray);line-height:1.5}
.notif-time{font-size:.75rem;color:#94a3b8;margin-top:6px}
.notif-actions{display:flex;gap:6px;flex-shrink:0;align-items:center}
.notif-empty{text-align:center;padding:80px 20px;color:var(--gray)}
.notif-empty-icon{font-size:4rem;margin-bottom:16px}
.notif-empty h3{font-size:1.2rem;color:var(--dark);margin:0 0 8px}
.notif-empty p{margin:0;font-size:.9rem}
</style>