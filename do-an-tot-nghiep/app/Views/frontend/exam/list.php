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