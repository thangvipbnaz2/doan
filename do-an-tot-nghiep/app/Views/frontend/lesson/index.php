<div class="container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="font-size: 32px; margin-bottom: 8px;">Danh sách bài học</h1>
    <p style="color: #666; margin-bottom: 30px;">Chọn cấp độ và bài học để bắt đầu học</p>

    <div class="level-tabs" style="display: flex; gap: 10px; margin-bottom: 30px; flex-wrap: wrap; border-bottom: 2px solid #eee; padding-bottom: 16px;">
        <a href="<?= App\Helpers\View::baseUrl() ?>/lessons" class="level-tab" style="padding: 8px 20px; background: <?= $currentLevel === '' ? '#e94560' : '#f0f0f0' ?>; color: <?= $currentLevel === '' ? '#fff' : '#333' ?>; border-radius: 20px; text-decoration: none; font-weight: 500;">
            Tất cả
        </a>
        <?php foreach ($levels as $lv): ?>
        <a href="<?= App\Helpers\View::baseUrl() ?>/lessons?level=<?= App\Helpers\View::escape($lv['level']) ?>" class="level-tab" style="padding: 8px 20px; background: <?= $currentLevel === $lv['level'] ? '#e94560' : '#f0f0f0' ?>; color: <?= $currentLevel === $lv['level'] ? '#fff' : '#333' ?>; border-radius: 20px; text-decoration: none; font-weight: 500;">
            <?= App\Helpers\View::escape($lv['level']) ?>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="lesson-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
        <?php foreach ($lessons as $lesson): ?>
        <a href="<?= App\Helpers\View::baseUrl() ?>/lesson/<?= $lesson['id'] ?>" class="lesson-card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; display: block;" 
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.12)'" 
           onmouseout="this.style.transform='';this.style.boxShadow='0 2px 10px rgba(0,0,0,0.08)'">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                <span class="badge" style="background: #e94560; color: #fff; padding: 4px 10px; border-radius: 4px; font-size: 12px;">
                    <?= App\Helpers\View::escape($lesson['level']) ?>
                </span>
                <span style="color: #999; font-size: 13px;">Bài <?= $lesson['lesson_num'] ?></span>
            </div>
            <h3 style="font-size: 18px; margin-bottom: 8px;"><?= App\Helpers\View::escape($lesson['title']) ?></h3>
            <p style="color: #666; font-size: 14px; margin-bottom: 16px; line-height: 1.5;">
                <?= App\Helpers\View::escape(mb_substr($lesson['description'] ?? '', 0, 120)) ?>
            </p>
            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f0f0f0; padding-top: 12px;">
                <span style="color: #999; font-size: 13px;">
                    <i class="fas fa-book"></i> <?= (int)$lesson['vocab_count'] ?> từ vựng
                </span>
                <span style="color: #e94560; font-size: 14px;">
                    Học ngay <i class="fas fa-arrow-right"></i>
                </span>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($lessons)): ?>
    <div style="text-align: center; padding: 60px 20px; color: #999;">
        <i class="fas fa-book-open" style="font-size: 48px; margin-bottom: 16px;"></i>
        <p>Không có bài học nào cho cấp độ này</p>
    </div>
    <?php endif; ?>
</div>
