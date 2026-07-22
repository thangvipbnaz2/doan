<?php $base = App\Helpers\View::baseUrl(); ?>
<div class="goal-page">
    <div class="goal-header">
        <h1>Mục tiêu học tập</h1>
        <p class="goal-subtitle">Đặt mục tiêu và theo dõi tiến trình học tiếng Trung của bạn</p>
    </div>

    <div class="goal-stats">
        <div class="goal-stat-card">
            <div class="gsc-value"><?= $stats['streak_days'] ?></div>
            <div class="gsc-label">🔥 Streak (ngày)</div>
        </div>
        <div class="goal-stat-card">
            <div class="gsc-value"><?= $stats['lessons_completed'] ?></div>
            <div class="gsc-label">📚 Bài học</div>
        </div>
        <div class="goal-stat-card">
            <div class="gsc-value"><?= $stats['vocab_learned'] ?></div>
            <div class="gsc-label">📖 Từ vựng</div>
        </div>
    </div>

    <form method="POST" action="<?= $base ?>/goals/save" class="goal-form">
        <div class="goal-form-card">
            <h3>Mục tiêu HSK</h3>
            <p class="hint">Bạn muốn đạt trình độ HSK mấy?</p>
            <div class="hsk-picker">
                <?php for ($i = 1; $i <= 6; $i++): ?>
                <label class="hsk-option <?= ($goal && (int)$goal['target_hsk_level'] === $i) ? 'selected' : '' ?>">
                    <input type="radio" name="target_hsk_level" value="<?= $i ?>"
                        <?= ($goal && (int)$goal['target_hsk_level'] === $i) ? 'checked' : '' ?>>
                    <span class="hsk-label">HSK <?= $i ?></span>
                </label>
                <?php endfor; ?>
                <label class="hsk-option <?= (!$goal || !$goal['target_hsk_level']) ? 'selected' : '' ?>">
                    <input type="radio" name="target_hsk_level" value="0"
                        <?= (!$goal || !$goal['target_hsk_level']) ? 'checked' : '' ?>>
                    <span class="hsk-label">Chưa xác định</span>
                </label>
            </div>
        </div>

        <div class="goal-form-card">
            <h3>Mục tiêu hàng ngày</h3>
            <div class="goal-sliders">
                <div class="goal-slider-group">
                    <label>Thời gian học mỗi ngày (phút)</label>
                    <div class="slider-with-value">
                        <input type="range" name="daily_goal_minutes" min="5" max="180" step="5"
                            value="<?= $goal ? (int)$goal['daily_goal_minutes'] : 30 ?>"
                            oninput="this.nextElementSibling.textContent = this.value">
                        <span class="slider-value"><?= $goal ? (int)$goal['daily_goal_minutes'] : 30 ?></span>
                    </div>
                </div>
                <div class="goal-slider-group">
                    <label>Từ vựng mới mỗi ngày</label>
                    <div class="slider-with-value">
                        <input type="range" name="daily_vocab_goal" min="1" max="50" step="1"
                            value="<?= $goal ? (int)$goal['daily_vocab_goal'] : 10 ?>"
                            oninput="this.nextElementSibling.textContent = this.value">
                        <span class="slider-value"><?= $goal ? (int)$goal['daily_vocab_goal'] : 10 ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="goal-form-card">
            <h3>Ngày bắt đầu</h3>
            <input type="date" name="start_date" value="<?= $goal ? $goal['start_date'] : date('Y-m-d') ?>">
        </div>

        <button type="submit" class="btn btn--primary btn--lg" style="width:100%">💾 Lưu mục tiêu</button>
    </form>
</div>

<style>
.goal-page{max-width:640px;margin:auto;padding:104px 24px 64px}
.goal-header{margin-bottom:32px;text-align:center}
.goal-header h1{font-size:1.8rem;font-weight:800;color:var(--dark);margin:0 0 8px}
.goal-subtitle{color:var(--gray);font-size:.9rem;margin:0}
.goal-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:32px}
.goal-stat-card{background:#fff;border-radius:var(--radius-sm);padding:20px;text-align:center;border:1px solid var(--gray-light)}
.gsc-value{font-size:1.8rem;font-weight:800;color:var(--teal)}
.gsc-label{font-size:.82rem;color:var(--gray);margin-top:4px}
.goal-form{display:flex;flex-direction:column;gap:20px}
.goal-form-card{background:#fff;border-radius:var(--radius-sm);padding:24px;border:1px solid var(--gray-light)}
.goal-form-card h3{font-size:1.05rem;font-weight:700;color:var(--dark);margin:0 0 4px}
.hint{font-size:.82rem;color:var(--gray);margin:0 0 16px}
.hsk-picker{display:flex;flex-wrap:wrap;gap:8px}
.hsk-option{cursor:pointer}
.hsk-option input{display:none}
.hsk-label{display:block;padding:10px 20px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-weight:600;font-size:.9rem;transition:var(--transition)}
.hsk-option.selected .hsk-label{border-color:var(--teal);background:var(--teal-light);color:var(--teal-dark)}
.hsk-option:not(.selected):hover .hsk-label{border-color:var(--teal)}
.goal-sliders{display:flex;flex-direction:column;gap:20px;margin-top:12px}
.goal-slider-group label{font-size:.88rem;font-weight:600;color:var(--dark);display:block;margin-bottom:8px}
.slider-with-value{display:flex;align-items:center;gap:16px}
.slider-with-value input[type=range]{flex:1;accent-color:var(--teal)}
.slider-value{font-size:1.2rem;font-weight:700;color:var(--teal);min-width:40px;text-align:center}
.goal-form-card input[type=date]{padding:10px 16px;border:2px solid var(--gray-light);border-radius:var(--radius-sm);font-size:.95rem;width:100%;box-sizing:border-box}
</style>