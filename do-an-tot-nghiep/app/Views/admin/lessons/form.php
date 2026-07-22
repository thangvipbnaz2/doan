<div class="admin-header">
            <h1><?= isset($lesson) && $lesson ? 'Chỉnh sửa bài học' : 'Thêm bài học mới' ?></h1>
            <a href="/admin/lessons" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($lesson) && $lesson ? '/admin/lessons/update/' . (int)$lesson['id'] : '/admin/lessons/store' ?>">
                <div class="fg">
                    <label>Cấp độ HSK</label>
                    <select name="level" required>
                        <option value="">Chọn cấp độ</option>
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <option value="<?= $i ?>" <?= isset($lesson) && (int)$lesson['level'] === $i ? 'selected' : '' ?>>HSK <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Số thứ tự bài</label>
                    <input type="number" name="lesson_num" value="<?= isset($lesson) ? escape($lesson['lesson_num']) : '' ?>" required min="1">
                </div>
                <div class="fg">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" value="<?= isset($lesson) ? escape($lesson['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Mô tả</label>
                    <textarea name="description" rows="3"><?= isset($lesson) ? escape($lesson['description']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Số từ vựng</label>
                    <input type="number" name="vocab_count" value="<?= isset($lesson) ? (int)$lesson['vocab_count'] : '10' ?>" min="0">
                </div>
                <div class="fg">
                    <label>Ngữ pháp (tóm tắt)</label>
                    <input type="text" name="grammar" value="<?= isset($lesson) ? escape($lesson['grammar']) : '' ?>" placeholder="Cấu trúc ngữ pháp chính">
                </div>
                <div class="fg">
                    <label>Thể loại</label>
                    <select name="type">
                        <option value="vocab" <?= isset($lesson) && $lesson['type'] === 'vocab' ? 'selected' : '' ?>>Từ vựng</option>
                        <option value="grammar" <?= isset($lesson) && $lesson['type'] === 'grammar' ? 'selected' : '' ?>>Ngữ pháp</option>
                        <option value="mixed" <?= isset($lesson) && $lesson['type'] === 'mixed' ? 'selected' : '' ?>>Kết hợp</option>
                    </select>
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($lesson) && $lesson ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/lessons" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>