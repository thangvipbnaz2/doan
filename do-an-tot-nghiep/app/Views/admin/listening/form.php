<div class="admin-header">
            <h1><?= isset($exercise) && $exercise ? 'Chỉnh sửa bài nghe' : 'Thêm bài nghe mới' ?></h1>
            <a href="/admin/listening" class="btn btn--outline">← Quay lại</a>
        </div>

        <div class="form-card">
            <form method="POST" action="<?= isset($exercise) && $exercise ? '/admin/listening/update/' . (int)$exercise['id'] : '/admin/listening/store' ?>">
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
                    <label>Tiêu đề</label>
                    <input type="text" name="title" value="<?= isset($exercise) ? escape($exercise['title']) : '' ?>" required>
                </div>
                <div class="fg">
                    <label>Audio URL</label>
                    <input type="url" name="audio_url" value="<?= isset($exercise) ? escape($exercise['audio_url']) : '' ?>" placeholder="https://example.com/audio.mp3">
                </div>
                <div class="fg">
                    <label>Transcript (chữ Hán)</label>
                    <textarea name="transcript" rows="6"><?= isset($exercise) ? escape($exercise['transcript']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Transcript Pinyin</label>
                    <textarea name="transcript_pinyin" rows="4"><?= isset($exercise) ? escape($exercise['transcript_pinyin']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Transcript Tiếng Việt</label>
                    <textarea name="transcript_vi" rows="4"><?= isset($exercise) ? escape($exercise['transcript_vi']) : '' ?></textarea>
                </div>
                <div class="fg">
                    <label>Thứ tự</label>
                    <input type="number" name="sort_order" value="<?= isset($exercise) ? (int)$exercise['sort_order'] : 0 ?>" min="0">
                </div>

                <h3 style="margin:28px 0 16px;font-size:1.2rem;color:var(--dark-3)">Câu hỏi</h3>
                <div id="questions-container">
                    <?php if (isset($questions) && !empty($questions)): ?>
                        <?php foreach ($questions as $qi => $q): ?>
                        <div class="q-box">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px">
                                <h4>Câu hỏi <?= $qi + 1 ?></h4>
                                <button type="button" class="btn btn--small btn--danger" onclick="this.closest('.q-box').remove()">Xóa</button>
                            </div>
                            <div class="q-grid">
                                <div class="fg">
                                    <label>Loại</label>
                                    <select name="questions[<?= $qi ?>][type]">
                                        <option value="multiple_choice" <?= $q['type'] === 'multiple_choice' ? 'selected' : '' ?>>Trắc nghiệm</option>
                                        <option value="fill_blank" <?= $q['type'] === 'fill_blank' ? 'selected' : '' ?>>Điền vào chỗ trống</option>
                                        <option value="true_false" <?= $q['type'] === 'true_false' ? 'selected' : '' ?>>Đúng/Sai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="fg">
                                <label>Câu hỏi</label>
                                <textarea name="questions[<?= $qi ?>][question]" rows="2"><?= escape($q['question']) ?></textarea>
                            </div>
                            <div class="fg">
                                <label>Lựa chọn (mỗi dòng 1 đáp án)</label>
                                <textarea name="questions[<?= $qi ?>][options]" rows="3" placeholder="A. ...&#10;B. ...&#10;C. ..."><?php
                                    $opts = $q['options'];
                                    if (is_string($opts)) $opts = json_decode($opts, true);
                                    echo is_array($opts) ? escape(implode("\n", $opts)) : '';
                                ?></textarea>
                            </div>
                            <div class="q-grid">
                                <div class="fg">
                                    <label>Đáp án</label>
                                    <input type="text" name="questions[<?= $qi ?>][answer]" value="<?= escape($q['answer']) ?>">
                                </div>
                                <div class="fg">
                                    <label>Giải thích</label>
                                    <input type="text" name="questions[<?= $qi ?>][explanation]" value="<?= escape($q['explanation'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button type="button" class="btn btn--outline" onclick="addQuestion()" style="margin-bottom:20px">+ Thêm câu hỏi</button>

                <div style="display:flex;gap:12px;margin-top:24px;border-top:2px solid var(--gray-light);padding-top:24px">
                    <button type="submit" class="btn btn--primary" style="flex:1">💾 <?= isset($exercise) && $exercise ? 'Cập nhật' : 'Tạo mới' ?></button>
                    <a href="/admin/listening" class="btn btn--outline">Hủy</a>
                </div>
            </form>
        </div>