<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thi | HànNgữ</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        .result-page{max-width:900px;margin:auto;padding:104px 24px 64px}
        .result-hero{text-align:center;padding:40px;border-radius:20px;margin-bottom:32px;background:linear-gradient(135deg,#f0fdfa,#fff)}
        .result-hero.passed{background:linear-gradient(135deg,#d1fae5,#ecfdf5)}
        .result-hero.failed{background:linear-gradient(135deg,#fef2f2,#fef2f2)}
        .result-hero__icon{font-size:4rem;margin-bottom:12px}
        .result-hero__score{font-size:4.5rem;font-weight:900;font-family:var(--font-display);line-height:1;margin-bottom:4px}
        .result-hero__score.pass{background:linear-gradient(135deg,var(--teal),var(--coral));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .result-hero__score.fail{color:#ef4444}
        .result-hero__label{font-size:1rem;color:var(--gray);margin-bottom:4px}
        .result-hero__status{padding:8px 28px;border-radius:50px;display:inline-block;font-weight:700;font-size:1rem;margin-top:8px}
        .result-hero__status.passed{background:var(--teal);color:#fff}
        .result-hero__status.failed{background:#ef4444;color:#fff}
        .result-stats{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:32px}
        .result-stat{padding:20px;background:#fff;border-radius:14px;border:1px solid var(--gray-light);text-align:center;box-shadow:var(--shadow)}
        .result-stat__num{display:block;font-size:1.8rem;font-weight:800;color:var(--dark);font-family:var(--font-display)}
        .result-stat__num.green{color:var(--teal)}
        .result-stat__num.red{color:#ef4444}
        .result-stat__label{font-size:.82rem;color:var(--gray);margin-top:4px}
        .section-breakdown{margin-bottom:32px}
        .section-breakdown h3{font-size:1.1rem;font-weight:700;color:var(--dark);margin-bottom:16px;font-family:var(--font-display)}
        .breakdown-item{display:flex;align-items:center;gap:16px;padding:14px 20px;background:#fff;border-radius:12px;border:1px solid var(--gray-light);margin-bottom:8px}
        .breakdown-item__label{font-weight:600;font-size:.92rem;color:var(--dark);min-width:90px}
        .breakdown-item__bar{flex:1;height:10px;background:var(--gray-light);border-radius:5px;overflow:hidden}
        .breakdown-item__fill{height:100%;border-radius:5px;transition:width 1s ease}
        .breakdown-item__fill.green{background:linear-gradient(90deg,var(--teal),var(--teal-dark))}
        .breakdown-item__fill.red{background:linear-gradient(90deg,#ef4444,#dc2626)}
        .breakdown-item__score{font-size:.88rem;font-weight:600;color:var(--gray);min-width:60px;text-align:right}
        .detail-card{background:#fff;border:1px solid var(--gray-light);border-radius:16px;padding:24px;margin-bottom:16px}
        .detail-card.correct{border-left:4px solid #10b981}
        .detail-card.wrong{border-left:4px solid #ef4444}
        .detail-card__header{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;flex-wrap:wrap;gap:8px}
        .detail-card__section{font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;padding:3px 10px;border-radius:6px;background:var(--teal-light);color:var(--teal-dark)}
        .detail-card__status{font-size:.8rem;font-weight:600;padding:3px 10px;border-radius:6px}
        .detail-card__status.right{background:#d1fae5;color:#065f46}
        .detail-card__status.wrong{background:#fef2f2;color:#dc2626}
        .detail-card__question{font-size:.95rem;color:var(--dark);margin-bottom:12px;line-height:1.6}
        .detail-card__answer{font-size:.88rem;margin-bottom:4px;display:flex;gap:12px;flex-wrap:wrap}
        .detail-card__answer strong{color:var(--gray)}
        .detail-card__answer .user{color:#ef4444}
        .detail-card__answer .correct{color:#10b981;font-weight:600}
        .detail-card__explanation{padding:12px 16px;background:var(--teal-light);border-radius:10px;margin-top:10px;font-size:.88rem;color:var(--dark-3);line-height:1.6}
        .result-actions{display:flex;gap:12px;justify-content:center;margin-top:32px;flex-wrap:wrap}
        [data-theme="dark"] .result-stat{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .detail-card{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .breakdown-item{background:#1a2332;border-color:var(--gray-light)}
        [data-theme="dark"] .result-hero{background:linear-gradient(135deg,#0b1f1a,#1a2332)}
        [data-theme="dark"] .result-hero.passed{background:linear-gradient(135deg,#064e3b,#0b1f1a)}
        [data-theme="dark"] .result-hero.failed{background:linear-gradient(135deg,#450a0a,#1a2332)}
        [data-theme="dark"] .detail-card__explanation{background:rgba(13,148,136,0.15)}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="page-wrapper">
    <div class="result-page">
        <div class="result-hero <?= $passed ? 'passed' : 'failed' ?>">
            <div class="result-hero__icon"><?= $passed ? '🎉' : '😅' ?></div>
            <div class="result-hero__label">Kết quả thi</div>
            <div class="result-hero__score <?= $passed ? 'pass' : 'fail' ?>"><?= (int)$percentage ?>%</div>
            <div style="font-size:1rem;color:var(--gray);margin-bottom:8px">
                <?= (int)$result['score'] ?> / <?= (int)$result['total_points'] ?> câu đúng
            </div>
            <div class="result-hero__status <?= $passed ? 'passed' : 'failed' ?>">
                <?= $passed ? '✅ ĐẠT' : '❌ CHƯA ĐẠT' ?>
            </div>
        </div>

        <div class="result-stats">
            <div class="result-stat">
                <span class="result-stat__num green"><?= (int)$result['score'] ?></span>
                <span class="result-stat__label">Đúng</span>
            </div>
            <div class="result-stat">
                <span class="result-stat__num red"><?= (int)$result['total_points'] - (int)$result['score'] ?></span>
                <span class="result-stat__label">Sai</span>
            </div>
            <div class="result-stat">
                <span class="result-stat__num"><?= (int)$result['total_points'] ?></span>
                <span class="result-stat__label">Tổng số câu</span>
            </div>
            <div class="result-stat">
                <span class="result-stat__num"><?= $passed ? 'Đạt' : 'Không' ?></span>
                <span class="result-stat__label">Yêu cầu ≥ <?= (int)$result['passing_score'] ?>%</span>
            </div>
        </div>

        <div class="section-breakdown">
            <h3>📊 Chi tiết theo phần</h3>
            <?php $sectionLabels = ['listening' => '🎧 Nghe', 'reading' => '📖 Đọc', 'grammar' => '🔤 Ngữ pháp', 'writing' => '✍️ Viết']; ?>
            <?php foreach ($sectionBreakdown as $sec => $data): if ($data['total'] === 0) continue; ?>
                <div class="breakdown-item">
                    <span class="breakdown-item__label"><?= $sectionLabels[$sec] ?? $sec ?></span>
                    <div class="breakdown-item__bar">
                        <div class="breakdown-item__fill <?= $data['correct'] >= $data['total'] / 2 ? 'green' : 'red' ?>"
                             style="width:<?= $data['total'] > 0 ? round(($data['correct'] / $data['total']) * 100) : 0 ?>%"></div>
                    </div>
                    <span class="breakdown-item__score"><?= (int)$data['correct'] ?>/<?= (int)$data['total'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <h3 style="margin-bottom:16px;font-family:var(--font-display);font-weight:700;color:var(--dark)">📝 Chi tiết câu hỏi</h3>

        <?php foreach ($details as $i => $d): ?>
            <div class="detail-card <?= $d['correct'] ? 'correct' : 'wrong' ?>">
                <div class="detail-card__header">
                    <span class="detail-card__section"><?= $sectionLabels[$d['section']] ?? $d['section'] ?> - Câu <?= $i + 1 ?></span>
                    <span class="detail-card__status <?= $d['correct'] ? 'right' : 'wrong' ?>">
                        <?= $d['correct'] ? '✅ Đúng' : '❌ Sai' ?>
                    </span>
                </div>
                <div class="detail-card__question"><?= escape($d['question']) ?></div>
                <?php if (!empty($d['options'])): $opts = json_decode($d['options'], true); ?>
                    <div style="display:flex;flex-direction:column;gap:4px;margin-bottom:8px">
                        <?php foreach ($opts as $opt): ?>
                            <div style="padding:6px 12px;border-radius:6px;font-size:.88rem;background:<?= $opt === $d['correct_answer'] ? '#d1fae5' : ($opt === $d['user_answer'] && !$d['correct'] ? '#fef2f2' : 'transparent') ?>;border:1px solid <?= $opt === $d['correct_answer'] ? '#10b981' : ($opt === $d['user_answer'] && !$d['correct'] ? '#ef4444' : 'transparent') ?>">
                                <?= escape($opt) ?>
                                <?php if ($opt === $d['correct_answer']): ?> ✅<?php endif; ?>
                                <?php if ($opt === $d['user_answer'] && $opt !== $d['correct_answer']): ?> ❌ (bạn chọn)<?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="detail-card__answer">
                        <span><strong>Đáp án của bạn:</strong> <span class="user"><?= escape($d['user_answer'] ?: '(Chưa trả lời)') ?></span></span>
                        <span><strong>Đáp án đúng:</strong> <span class="correct"><?= escape($d['correct_answer']) ?></span></span>
                    </div>
                <?php endif; ?>
                <?php if ($d['explanation']): ?>
                    <div class="detail-card__explanation">💡 <?= escape($d['explanation']) ?></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="result-actions">
            <a href="exam_mvc.php?action=list" class="btn btn--outline">← Danh sách đề thi</a>
            <a href="exam_mvc.php?action=start&id=<?= (int)$result['exam_id'] ?>" class="btn btn--primary">🔄 Làm lại</a>
            <a href="exam_mvc.php?action=history" class="btn btn--outline">📋 Lịch sử</a>
        </div>
    </div>
</div>
</body>
</html>
