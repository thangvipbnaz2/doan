<div class="admin-header">
            <h1><?= isset($vocab) && $vocab ? 'Chỉnh sửa từ vựng' : 'Thêm từ vựng mới' ?></h1>
            <a href="/admin/vocab" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($vocab) && $vocab ? '/admin/vocab/update/' . (int)$vocab['id'] : '/admin/vocab/store' ?>">
                <div class="grid-2">
                    <div class="fg">
                        <label>Chữ Hán</label>
                        <input type="text" name="hanzi" value="<?= isset($vocab) ? escape($vocab['hanzi']) : '' ?>" required style="font-size:1.2rem;font-family:var(--font-hanzi)">
                    </div>
                    <div class="fg">
                        <label>Pinyin</label>
                        <input type="text" name="pinyin" value="<?= isset($vocab) ? escape($vocab['pinyin']) : '' ?>" required>
                    </div>
                    <div class="fg">
                        <label>Nghĩa tiếng Việt</label>
                        <input type="text" name="meaning" value="<?= isset($vocab) ? escape($vocab['meaning']) : '' ?>" required>
                    </div>
                    <div class="fg">
                        <label>Cấp độ HSK</label>
                        <select name="level" required>
                            <option value="">Chọn</option>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                            <option value="<?= $i ?>" <?= isset($vocab) && (int)$vocab['level'] === $i ? 'selected' : '' ?>>HSK <?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="fg">
                        <label>Bài học</label>
                        <select name="lesson_id">
                            <option value="">Không</option>
                            <?php foreach ($lessons as $ls): ?>
                            <option value="<?= (int)$ls['id'] ?>" <?= isset($vocab) && (int)$vocab['lesson_id'] === (int)$ls['id'] ? 'selected' : '' ?>>
                                HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="fg">
                        <label>Số nét</label>
                        <input type="number" name="strokes" value="<?= isset($vocab) ? (int)$vocab['strokes'] : 0 ?>" min="0">
                    </div>
                    <div class="fg">
                        <label>Bộ thủ</label>
                        <input type="text" name="radical" value="<?= isset($vocab) ? escape($vocab['radical']) : '' ?>" placeholder="亻">
                    </div>
                    <div class="fg">
                        <label>Ví dụ (Tiếng Trung)</label>
                        <input type="text" name="example" value="<?= isset($vocab) ? escape($vocab['example']) : '' ?>" placeholder="你好！">
                    </div>
                </div>
                <div class="fg">
                    <label>Ví dụ (Tiếng Việt)</label>
                    <textarea name="example_vi" rows="2"><?= isset($vocab) ? escape($vocab['example_vi']) : '' ?></textarea>
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($vocab) && $vocab ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/vocab" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>