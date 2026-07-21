<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi thử HSK | HànNgữ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .exam-page{padding:104px 24px 64px;min-height:100vh}
        .exam-hero{text-align:center;margin-bottom:48px}
        .exam-hero h1{font-family:var(--font-display);font-size:2.6rem;font-weight:900;color:var(--dark);margin-bottom:12px}
        .exam-hero p{font-size:1.05rem;color:var(--gray);max-width:560px;margin:0 auto;line-height:1.7}
        .exam-levels{display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin-bottom:36px}
        .exam-level-btn{padding:8px 22px;border:2px solid var(--gray-light);border-radius:8px;background:#fff;font-size:.88rem;font-weight:600;color:var(--gray);text-decoration:none;transition:var(--transition);font-family:var(--font-sans)}
        .exam-level-btn:hover{border-color:var(--teal);color:var(--teal)}
        .exam-level-btn.active{background:var(--teal);border-color:var(--teal);color:#fff;box-shadow:0 4px 16px rgba(13,148,136,0.3)}
        .exam-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;max-width:1100px;margin:0 auto}
        .exam-card{background:#fff;border-radius:var(--radius);padding:28px;box-shadow:var(--shadow);border:1px solid var(--gray-light);transition:var(--transition);position:relative;overflow:hidden}
        .exam-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--teal),var(--coral));transform:scaleX(0);transform-origin:left;transition:transform .4s ease}
        .exam-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-lg)}
        .exam-card:hover::before{transform:scaleX(1)}
        .exam-card__level{display:inline-block;padding:4px 12px;border-radius:6px;font-size:.75rem;font-weight:700;margin-bottom:12px;background:var(--teal-light);color:var(--teal-dark)}
        .exam-card__title{font-size:1.2rem;font-weight:700;color:var(--dark);margin-bottom:8px;font-family:var(--font-display)}
        .exam-card__meta{display:flex;gap:20px;font-size:.85rem;color:var(--gray);margin-bottom:16px;flex-wrap:wrap}
        .exam-card__meta span{display:flex;align-items:center;gap:6px}
        .exam-card__actions{display:flex;gap:10px;flex-wrap:wrap}
        .exam-card__best{font-size:.82rem;color:var(--teal);font-weight:600;margin-top:8px}
        .badge-hsk1{background:#dbeafe;color:#2563eb}
        .badge-hsk2{background:#fef3c7;color:#d97706}
        .badge-hsk3{background:#dbeafe;color:#2563eb}
        .badge-hsk4{background:#f3e8ff;color:#9333ea}
        .badge-hsk5{background:#fce7f3;color:#db2777}
        .badge-hsk6{background:#e0e7ff;color:#4338ca}
        [data-theme="dark"] .exam-card{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .exam-level-btn{background:#1a2332;border-color:var(--gray-light);color:var(--dark-3)}
        [data-theme="dark"] .exam-level-btn.active{background:var(--teal);color:#fff}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="exam-page">
        <div class="exam-hero">
            <h1>Thi thử HSK</h1>
            <p>Kiểm tra trình độ tiếng Trung của bạn với các đề thi thử từ HSK 1 đến HSK 6. Mỗi đề thi gồm 4 phần: Nghe, Đọc, Ngữ pháp và Viết.</p>
        </div>

        <div class="exam-levels">
            <a href="exam_mvc.php" class="exam-level-btn <?= !$levelFilter ? 'active' : '' ?>">Tất cả</a>
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <a href="exam_mvc.php?level=<?= $i ?>" class="exam-level-btn <?= $levelFilter === $i ? 'active' : '' ?>">HSK <?= $i ?></a>
            <?php endfor; ?>
        </div>

        <div class="exam-grid">
            <?php if (empty($exams)): ?>
            <div style="text-align:center;padding:60px 20px;color:var(--gray);grid-column:1/-1">
                <p>Chưa có đề thi nào cho cấp độ này.</p>
            </div>
            <?php else: ?>
                <?php foreach ($exams as $exam): ?>
                <div class="exam-card">
                    <span class="exam-card__level badge-hsk<?= (int)$exam['level'] ?>">HSK <?= (int)$exam['level'] ?></span>
                    <h3 class="exam-card__title"><?= escape($exam['title']) ?></h3>
                    <div class="exam-card__meta">
                        <span>⏱ <?= (int)$exam['duration_minutes'] ?> phút</span>
                        <span>📝 <?= (int)$exam['total_questions'] ?> câu</span>
                        <span>🎯 Đạt ≥ <?= (int)$exam['passing_score'] ?>%</span>
                    </div>
                    <div class="exam-card__actions">
                        <a href="exam_mvc.php?action=start&id=<?= (int)$exam['id'] ?>" class="btn btn--primary btn--sm">Làm bài</a>
                        <?php if (isset($userResults[$exam['id']])): ?>
                            <a href="exam_mvc.php?action=history" class="btn btn--outline btn--sm">Lịch sử</a>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($userResults[$exam['id']])): ?>
                        <div class="exam-card__best">
                            🏆 Điểm cao nhất: <?= (int)$userResults[$exam['id']]['best_score'] ?>/<?= (int)$exam['total_questions'] ?>
                            (<?= (int)$userResults[$exam['id']]['attempts'] ?> lần)
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
