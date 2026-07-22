<?php $baseUrl = App\Helpers\View::baseUrl(); ?>
<div class="stats-page" style="max-width: 1000px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="font-size: 28px; margin-bottom: 24px;">Thống kê học tập</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9;">Thời gian học</div>
            <div style="font-size: 32px; font-weight: 700; margin-top: 8px;"><?= gmdate('H:i', $totalStudyTime) ?></div>
        </div>
        <div style="background: linear-gradient(135deg, #f093fb, #f5576c); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9;">Bài học đã hoàn thành</div>
            <div style="font-size: 32px; font-weight: 700; margin-top: 8px;"><?= $lessonsCompleted ?></div>
        </div>
        <div style="background: linear-gradient(135deg, #4facfe, #00f2fe); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9;">Từ vựng đã học</div>
            <div style="font-size: 32px; font-weight: 700; margin-top: 8px;"><?= $vocabLearned ?></div>
        </div>
        <div style="background: linear-gradient(135deg, #43e97b, #38f9d7); color: #fff; padding: 24px; border-radius: 12px;">
            <div style="font-size: 14px; opacity: 0.9;">Bài tập đã làm</div>
            <div style="font-size: 32px; font-weight: 700; margin-top: 8px;"><?= $exercisesDone ?></div>
        </div>
    </div>

    <?php if (!empty($activityByDay)): ?>
    <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 24px;">
        <h3 style="margin-bottom: 16px;">Hoạt động 30 ngày gần đây</h3>
        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
            <?php
            $maxCount = max(array_column($activityByDay, 'count'));
            $maxCount = max($maxCount, 1);
            foreach ($activityByDay as $day): 
                $pct = ($day['count'] / $maxCount) * 100;
                $color = $pct > 75 ? '#43e97b' : ($pct > 50 ? '#4facfe' : ($pct > 25 ? '#f093fb' : '#e0e0e0'));
            ?>
            <div style="width: 16px; height: 16px; background: <?= $color ?>; border-radius: 3px;" title="<?= $day['date'] ?>: <?= $day['count'] ?> hoạt động"></div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($examResults)): ?>
    <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <h3 style="margin-bottom: 16px;">Kết quả thi gần đây</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #f0f0f0;">
                    <th style="text-align: left; padding: 12px; font-size: 13px;">Bài thi</th>
                    <th style="text-align: center; padding: 12px; font-size: 13px;">Điểm</th>
                    <th style="text-align: center; padding: 12px; font-size: 13px;">Kết quả</th>
                    <th style="text-align: right; padding: 12px; font-size: 13px;">Ngày</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($examResults as $r): ?>
                <tr style="border-bottom: 1px solid #f0f0f0;">
                    <td style="padding: 12px;"><?= App\Helpers\View::escape($r['exam_title']) ?></td>
                    <td style="text-align: center; padding: 12px; font-weight: 600;"><?= $r['percentage'] ?>%</td>
                    <td style="text-align: center; padding: 12px;">
                        <span style="padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: <?= $r['is_passed'] ? '#d1fae5' : '#fee2e2' ?>; color: <?= $r['is_passed'] ? '#065f46' : '#dc2626' ?>;">
                            <?= $r['is_passed'] ? 'Đạt' : 'Không đạt' ?>
                        </span>
                    </td>
                    <td style="text-align: right; padding: 12px; color: #666; font-size: 13px;"><?= date('d/m/Y', strtotime($r['created_at'])) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
