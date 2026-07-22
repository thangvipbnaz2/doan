<div class="page-wrapper">
    <div class="history-page">
        <h1>📋 Lịch sử thi thử</h1>

        <?php if (empty($history)): ?>
        <div class="empty-state">
            <div class="empty-state__icon">📝</div>
            <p>Bạn chưa làm bài thi thử nào. Hãy bắt đầu ngay!</p>
            <a href="exam_mvc.php" class="btn btn--primary">Xem đề thi</a>
        </div>
        <?php else: ?>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Đề thi</th>
                    <th>Cấp độ</th>
                    <th>Điểm</th>
                    <th>Kết quả</th>
                    <th>Ngày thi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($history as $h): ?>
                <?php $pct = $h['total_points'] > 0 ? round(($h['score'] / $h['total_points']) * 100) : 0; ?>
                <tr>
                    <td><strong><?= escape($h['title']) ?></strong></td>
                    <td><span class="badge badge-hsk<?= (int)$h['level'] ?>">HSK <?= (int)$h['level'] ?></span></td>
                    <td><?= (int)$h['score'] ?>/<?= (int)$h['total_points'] ?> (<?= $pct ?>%)</td>
                    <td class="<?= $pct >= (int)$h['passing_score'] ? 'pass' : 'fail' ?>">
                        <?= $pct >= (int)$h['passing_score'] ? '✅ Đạt' : '❌ Chưa đạt' ?>
                    </td>
                    <td style="color:var(--gray);font-size:.85rem"><?= date('d/m/Y H:i', strtotime($h['created_at'])) ?></td>
                    <td><a href="exam_mvc.php?action=result&id=<?= (int)$h['id'] ?>" class="btn btn--sm btn--primary">Xem</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>