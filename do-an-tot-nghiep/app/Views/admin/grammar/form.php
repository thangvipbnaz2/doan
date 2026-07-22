<div class="admin-header">
            <h1><?= isset($grammar) && $grammar ? 'Chỉnh sửa ngữ pháp' : 'Thêm ngữ pháp mới' ?></h1>
            <a href="/admin/grammar" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($grammar) && $grammar ? '/admin/grammar/update/' . (int)$grammar['id'] : '/admin/grammar/store' ?>">
                <div class="fg">
                    <label>Bài học</label>
                    <select name="lesson_id" required>
                        <option value="">Chọn bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= isset($grammar) && (int)$grammar['lesson_id'] === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Tiêu đề ngữ pháp</label>
                    <input type="text" name="title" value="<?= isset($grammar) ? escape($grammar['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Công thức</label>
                    <input type="text" name="formula" value="<?= isset($grammar) ? escape($grammar['formula']) : '' ?>" placeholder="S + 是 + O" style="font-family:monospace">
                </div>
                <div class="fg">
                    <label>Giải thích (meaning)</label>
                    <textarea name="meaning" rows="4"><?= isset($grammar) ? escape($grammar['meaning']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Cách dùng (usage)</label>
                    <textarea name="usage" rows="3"><?= isset($grammar) ? escape($grammar['usage']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Ghi chú</label>
                    <textarea name="notes" rows="3"><?= isset($grammar) ? escape($grammar['notes']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Thứ tự</label>
                    <input type="number" name="sort_order" value="<?= isset($grammar) ? (int)$grammar['sort_order'] : 0 ?>" min="0">
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($grammar) && $grammar ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/grammar" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>