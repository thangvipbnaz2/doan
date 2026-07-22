<div class="admin-header">
            <div>
                <h1><?= escape($exam['title']) ?> <span class="sub">— Quản lý câu hỏi</span></h1>
                <p style="color:var(--gray);font-size:.9rem">HSK <?= (int)$exam['level'] ?> · <?= (int)$exam['total_questions'] ?> câu · <?= (int)$exam['duration_minutes'] ?> phút</p>
            </div>
            <a href="/admin/exam" class="btn btn--primary">← Danh sách</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
        <div class="msg success"><?= $_GET['msg'] === 'added' ? 'Đã thêm câu hỏi!' : ($_GET['msg'] === 'deleted' ? 'Đã xóa câu hỏi!' : '') ?></div>
        <?php endif; ?>

        <div class="form-card">
            <h3>+ Thêm câu hỏi mới</h3>
            <form method="post" action="/admin/exam/question/add">
                <input type="hidden" name="exam_id" value="<?= (int)$exam['id'] ?>">
                <div class="fg">
                    <label>Phần</label>
                    <select name="section">
                        <option value="listening">🎧 Nghe</option>
                        <option value="reading" selected>📖 Đọc</option>
                        <option value="grammar">🔤 Ngữ pháp</option>
                        <option value="writing">✍️ Viết</option>
                    </select>
                </div>
                <div class="fg">
                    <label>Câu hỏi</label>
                    <textarea name="question" required></textarea>
                </div>
                <div class="fg">
                    <label>Đáp án (mỗi dòng một lựa chọn)</label>
                    <textarea name="options" placeholder="Nhập các lựa chọn, mỗi dòng một đáp án. Để trống nếu là câu hỏi điền vào chỗ trống."></textarea>
                    <div class="help">Để trống nếu câu hỏi dạng điền từ (fill-in-the-blank)</div>
                </div>
                <div class="fg">
                    <label>Đáp án đúng</label>
                    <input type="text" name="answer" required>
                </div>
                <div class="fg">
                    <label>Giải thích</label>
                    <textarea name="explanation"></textarea>
                </div>
                <div class="fg">
                    <label>Điểm</label>
                    <input type="number" name="points" value="1" min="1">
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn--primary">Thêm câu hỏi</button>
                </div>
            </form>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead><tr><th>#</th><th>Phần</th><th>Câu hỏi</th><th>Đáp án</th><th>Điểm</th><th></th></tr></thead>
                <tbody>
                <?php if (empty($questions)): ?>
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--gray)">Chưa có câu hỏi nào</td></tr>
                <?php else: ?>
                    <?php foreach ($questions as $q): ?>
                    <tr>
                        <td><?= (int)$q['question_number'] ?></td>
                        <td><span class="section-badge <?= $q['section'] ?>"><?= $q['section'] ?></span></td>
                        <td><?= escape(mb_truncate($q['question'], 80)) ?></td>
                        <td><?= escape(mb_truncate($q['answer'], 40)) ?></td>
                        <td><?= (int)$q['points'] ?></td>
                        <td><a href="/admin/exam/question/delete/<?= (int)$q['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa câu hỏi này?')">Xóa</a></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>