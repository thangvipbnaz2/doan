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