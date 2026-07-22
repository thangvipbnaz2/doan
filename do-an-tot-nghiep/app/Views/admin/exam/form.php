<div class="admin-header">
            <h1><?= isset($editing) ? 'Sửa đề thi' : 'Thêm đề thi mới' ?></h1>
        </div>
        <div class="form-card">
            <form method="post" action="<?= isset($editing) ? '/admin/exam/update/' . (int)$exam['id'] : '/admin/exam/store' ?>">
                <div class="fg">
                    <label>Cấp độ HSK</label>
                    <select name="level">
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <option value="<?= $i ?>" <?= (isset($exam) && (int)$exam['level'] === $i) ? 'selected' : '' ?>>HSK <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" value="<?= isset($exam) ? escape($exam['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Thời gian (phút)</label>
                    <input type="number" name="duration_minutes" value="<?= isset($exam) ? (int)$exam['duration_minutes'] : 40 ?>" min="1" required>
                </div>
                <div class="fg">
                    <label>Tổng số câu hỏi</label>
                    <input type="number" name="total_questions" value="<?= isset($exam) ? (int)$exam['total_questions'] : 40 ?>" min="1" required>
                </div>
                <div class="fg">
                    <label>Điểm đạt (%)</label>
                    <input type="number" name="passing_score" value="<?= isset($exam) ? (int)$exam['passing_score'] : 60 ?>" min="1" max="100" required>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn--primary"><?= isset($editing) ? 'Cập nhật' : 'Tạo đề thi' ?></button>
                    <a href="/admin/exam" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>