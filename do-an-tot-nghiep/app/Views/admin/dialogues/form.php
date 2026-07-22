<div class="admin-header">
            <h1><?= isset($dialogue) && $dialogue ? 'Chỉnh sửa hội thoại' : 'Thêm hội thoại mới' ?></h1>
            <a href="/admin/dialogues" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($dialogue) && $dialogue ? '/admin/dialoguess/update/' . (int)$dialogue['id'] : '/admin/dialoguess/store' ?>">
                <div class="fg">
                    <label>Bài học</label>
                    <select name="lesson_id" required>
                        <option value="">Chọn bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= isset($dialogue) && (int)$dialogue['lesson_id'] === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="fg">
                    <label>Tiêu đề hội thoại</label>
                    <input type="text" name="title" value="<?= isset($dialogue) ? escape($dialogue['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Bối cảnh</label>
                    <textarea name="context" rows="3"><?= isset($dialogue) ? escape($dialogue['context'] ?? '') : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Câu hội thoại</label>
                    <button type="button" class="btn btn--small btn--success" onclick="addSentence()" style="margin-bottom:12px">+ Thêm câu</button>
                    <div id="sentences-container">
                        <?php if (isset($sentences) && !empty($sentences)): ?>
                            <?php foreach ($sentences as $i => $s): ?>
                            <div class="sentence-row">
                                <input type="text" name="sentences[<?= $i ?>][speaker]" value="<?= escape($s['speaker']) ?>" placeholder="Người nói" class="speaker">
                                <input type="text" name="sentences[<?= $i ?>][chinese]" value="<?= escape($s['chinese']) ?>" placeholder="Tiếng Trung">
                                <input type="text" name="sentences[<?= $i ?>][pinyin]" value="<?= escape($s['pinyin']) ?>" placeholder="Pinyin">
                                <input type="text" name="sentences[<?= $i ?>][vietnamese]" value="<?= escape($s['vietnamese']) ?>" placeholder="Dịch nghĩa">
                                <button type="button" class="btn btn--small btn--danger" onclick="this.parentElement.remove()">✕</button>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div style="display:flex;gap:12px;margin-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($dialogue) && $dialogue ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/dialogues" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>