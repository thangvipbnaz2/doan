<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử thi thử | HànNgữ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .history-page{max-width:900px;margin:auto;padding:104px 24px 64px}
        .history-page h1{font-family:var(--font-display);font-size:1.8rem;font-weight:800;color:var(--dark);margin-bottom:24px}
        .history-table{width:100%;border-collapse:collapse;background:#fff;border-radius:16px;overflow:hidden;box-shadow:var(--shadow);border:1px solid var(--gray-light)}
        .history-table th{text-align:left;padding:14px 18px;font-size:.78rem;text-transform:uppercase;letter-spacing:1px;color:var(--gray);border-bottom:2px solid var(--gray-light);font-weight:600;background:var(--teal-light)}
        .history-table td{padding:14px 18px;border-bottom:1px solid var(--gray-light);font-size:.9rem;vertical-align:middle}
        .history-table tr:hover{background:#f8fafc}
        .history-table .pass{color:var(--teal);font-weight:700}
        .history-table .fail{color:#ef4444;font-weight:700}
        .empty-state{text-align:center;padding:80px 20px;color:var(--gray)}
        .empty-state__icon{font-size:4rem;margin-bottom:16px}
        .empty-state p{font-size:1rem;margin-bottom:24px}
        [data-theme="dark"] .history-table{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .history-table th{background:var(--teal-light)}
        [data-theme="dark"] .history-table tr:hover{background:#1e2a3a}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
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
</body>
</html>
