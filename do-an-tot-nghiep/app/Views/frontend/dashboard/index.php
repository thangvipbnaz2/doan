<?php $baseUrl = App\Helpers\View::baseUrl(); ?>
<div class="dashboard-container" style="max-width: 1200px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="font-size: 28px; margin-bottom: 8px;">Bảng điều khiển</h1>
    <p style="color: #666; margin-bottom: 30px;">Chào mừng trở lại! Hãy tiếp tục hành trình học tiếng Trung của bạn.</p>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Bài học đã hoàn thành</div>
            <div style="font-size: 36px; font-weight: 700;"><?= App\Helpers\View::escape($stats['lessons_completed']) ?><small style="font-size: 16px; opacity: 0.7;">/<?= App\Helpers\View::escape($stats['total_lessons']) ?></small></div>
        </div>
        <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Từ vựng đã học</div>
            <div style="font-size: 36px; font-weight: 700;"><?= App\Helpers\View::escape($stats['vocab_learned']) ?></div>
        </div>
        <div class="stat-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Streak ngày</div>
            <div style="font-size: 36px; font-weight: 700;"><?= App\Helpers\View::escape($stats['streak_days']) ?><small style="font-size: 16px; opacity: 0.7;"> ngày</small></div>
        </div>
        <div class="stat-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Điểm trung bình</div>
            <div style="font-size: 36px; font-weight: 700;"><?= round($stats['average_score'], 1) ?><small style="font-size: 16px; opacity: 0.7;">%</small></div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
        <div>
            <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 24px;">
                <h3 style="margin-bottom: 16px;">Tiến độ HSK</h3>
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                            <span><?= App\Helpers\View::escape($currentLevel) ?></span>
                            <span><?= min(100, round(($stats['lessons_completed'] / max(1, $stats['total_lessons'])) * 100)) ?>%</span>
                        </div>
                        <div style="width: 100%; height: 12px; background: #f0f0f0; border-radius: 6px; overflow: hidden;">
                            <div style="height: 100%; background: linear-gradient(90deg, #667eea, #764ba2); border-radius: 6px; width: <?= min(100, round(($stats['lessons_completed'] / max(1, $stats['total_lessons'])) * 100)) ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <h3 style="margin-bottom: 16px;">Hoạt động gần đây</h3>
                <?php if (!empty($recentActivity)): ?>
                <div class="activity-list">
                    <?php foreach ($recentActivity as $activity): ?>
                    <div class="activity-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f0f0f0;">
                        <div style="width: 40px; height: 40px; background: #f0f0f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #667eea;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div style="flex: 1;">
                            <div style="font-weight: 500;"><?= App\Helpers\View::escape($activity['lesson_title']) ?></div>
                            <div style="color: #999; font-size: 13px;">
                                <?= ($activity['is_completed'] ?? 0) ? 'Đã hoàn thành' : 'Đang học' ?> - <?= date('d/m/Y', strtotime($activity['updated_at'])) ?>
                            </div>
                        </div>
                        <span style="color: <?= ($activity['is_completed'] ?? 0) ? '#43e97b' : '#ffc107' ?>;">
                            <i class="fas fa-<?= ($activity['is_completed'] ?? 0) ? 'check-circle' : 'clock' ?>"></i>
                        </span>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p style="color: #999; text-align: center; padding: 30px;">Chưa có hoạt động nào. Hãy bắt đầu học ngay!</p>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 24px;">
                <h3 style="margin-bottom: 16px;">Tiếp tục học</h3>
                <a href="<?= $baseUrl ?>/lessons" class="btn" style="display: block; padding: 14px; background: #e94560; color: #fff; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-play"></i> Học bài tiếp theo
                </a>
                <a href="<?= $baseUrl ?>/dashboard" class="btn" style="display: block; padding: 14px; background: #f0f0f0; color: #333; text-align: center; border-radius: 8px; text-decoration: none; margin-top: 10px;">
                    <i class="fas fa-sync"></i> Ôn tập từ vựng
                </a>
            </div>

            <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
                <h3 style="margin-bottom: 16px;">Thành tích</h3>
                <?php if (!empty($achievements)): ?>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <?php foreach ($achievements as $badge): ?>
                    <div class="badge-item" style="text-align: center; padding: 16px; background: #f8f9fa; border-radius: 8px;">
                        <div style="font-size: 32px; margin-bottom: 8px;"><?= App\Helpers\View::escape($badge['icon'] ?? '🏆') ?></div>
                        <div style="font-weight: 500; font-size: 13px;"><?= App\Helpers\View::escape($badge['title'] ?? $badge['name'] ?? '') ?></div>
                        <div style="color: #999; font-size: 11px;"><?= date('d/m/Y', strtotime($badge['unlocked_at'] ?? $badge['created_at'] ?? 'now')) ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div style="text-align: center; padding: 20px;">
                    <div style="font-size: 48px; margin-bottom: 12px;">🌟</div>
                    <p style="color: #999;">Hoàn thành bài học để nhận huy hiệu!</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
