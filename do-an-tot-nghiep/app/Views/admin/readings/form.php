<div class="admin-header">
            <h1><?= isset($reading) && $reading ? 'Chỉnh sửa bài đọc' : 'Thêm bài đọc mới' ?></h1>
            <a href="/admin/reading" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($reading) && $reading ? '/admin/reading/update/' . (int)$reading['id'] : '/admin/reading/store' ?>">
                <div class="fg">
                    <label>Bài học</label>
                    <select name="lesson_id" required>
                        <option value="">Chọn bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= isset($reading) && (int)$reading['lesson_id'] === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" value="<?= isset($reading) ? escape($reading['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Nội dung (chữ Hán)</label>
                    <textarea name="content" rows="10" style="font-family:var(--font-hanzi);font-size:1.1rem"><?= isset($reading) ? escape($reading['content']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Pinyin</label>
                    <textarea name="pinyin" rows="6" placeholder="pinyin của nội dung"><?= isset($reading) ? escape($reading['pinyin']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Dịch nghĩa (Tiếng Việt)</label>
                    <textarea name="translation" rows="8"><?= isset($reading) ? escape($reading['translation']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Ghi chú từ vựng</label>
                    <textarea name="vocabulary_notes" rows="4" placeholder="Từ mới trong bài đọc"><?= isset($reading) ? escape($reading['vocabulary_notes']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Audio URL</label>
                    <input type="url" name="audio_url" value="<?= isset($reading) ? escape($reading['audio_url']) : '' ?>" placeholder="https://example.com/audio.mp3">
                </div>
                <div class="fg">
                    <label>Thứ tự</label>
                    <input type="number" name="sort_order" value="<?= isset($reading) ? (int)$reading['sort_order'] : 0 ?>" min="0">
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($reading) && $reading ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/reading" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>