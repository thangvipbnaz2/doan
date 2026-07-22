<div class="admin-header">
            <h1><?= isset($exercise) && $exercise ? 'Chỉnh sửa bài nói' : 'Thêm bài nói mới' ?></h1>
            <a href="/admin/speaking" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($exercise) && $exercise ? '/admin/speaking/update/' . (int)$exercise['id'] : '/admin/speaking/store' ?>">
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
                    <label>Hướng dẫn (instruction)</label>
                    <textarea name="instruction" rows="3" placeholder="Hãy đọc to đoạn văn sau..."><?= isset($exercise) ? escape($exercise['instruction']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Văn bản mục tiêu (chữ Hán)</label>
                    <textarea name="target_text" rows="4" style="font-family:var(--font-hanzi);font-size:1.1rem"><?= isset($exercise) ? escape($exercise['target_text']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Pinyin mục tiêu</label>
                    <input type="text" name="target_pinyin" value="<?= isset($exercise) ? escape($exercise['target_pinyin']) : '' ?>" placeholder="wǒ shì xuésheng">
                </div>
                <div class="fg">
                    <label>Audio tham chiếu (URL)</label>
                    <input type="url" name="audio_reference" value="<?= isset($exercise) ? escape($exercise['audio_reference']) : '' ?>" placeholder="https://example.com/reference.mp3">
                </div>
                <div class="fg">
                    <label>Thứ tự</label>
                    <input type="number" name="sort_order" value="<?= isset($exercise) ? (int)$exercise['sort_order'] : 0 ?>" min="0">
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($exercise) && $exercise ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/speaking" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>