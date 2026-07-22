<div class="admin-header">
            <h1><?= isset($exercise) && $exercise ? 'Chỉnh sửa bài viết' : 'Thêm bài viết mới' ?></h1>
            <a href="/admin/writing" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($exercise) && $exercise ? '/admin/writing/update/' . (int)$exercise['id'] : '/admin/writing/store' ?>">
                <div class="fg">
                    <label>Bài học</label>
                    <select name="lesson_id" required>
                        <option value="">Chọn bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= isset($exercise) && (int)$exercise['lesson_id'] === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Chữ Hán</label>
                    <input type="text" name="character_char" value="<?= isset($exercise) ? escape($exercise['character_char']) : '' ?>" required style="font-family:var(--font-hanzi);font-size:1.4rem">
                </div>
                <div class="fg">
                    <label>Số nét</label>
                    <input type="number" name="stroke_count" value="<?= isset($exercise) ? (int)$exercise['stroke_count'] : 0 ?>" min="1">
                </div>
                <div class="fg">
                    <label>Bộ thủ</label>
                    <input type="text" name="radical" value="<?= isset($exercise) ? escape($exercise['radical']) : '' ?>" placeholder="亻">
                </div>
                <div class="fg">
                    <label>SVG hoạt họa nét chữ</label>
                    <textarea name="stroke_animation_svg" rows="6" placeholder="<svg>...</svg>"><?= isset($exercise) ? escape($exercise['stroke_animation_svg']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Hình ảnh thứ tự nét (URL)</label>
                    <input type="url" name="stroke_order_image" value="<?= isset($exercise) ? escape($exercise['stroke_order_image']) : '' ?>" placeholder="https://example.com/strokes.png">
                </div>
                <div class="fg">
                    <label>Thứ tự</label>
                    <input type="number" name="sort_order" value="<?= isset($exercise) ? (int)$exercise['sort_order'] : 0 ?>" min="0">
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($exercise) && $exercise ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/writing" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>