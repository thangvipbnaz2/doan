<div class="admin-header">
            <h1>Bài nói</h1>
            <a href="/admin/speaking/create" class="btn btn--primary">+ Thêm bài nói</a>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <form method="GET" class="filters">
                    <select name="lesson_id">
                        <option value="">Tất cả bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= (int)$lessonId === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn--primary btn--small">Lọc</button>
                </form>
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> bài nói</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Hướng dẫn</th><th>Văn bản mục tiêu</th><th>Bài học</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($speaking)): ?>
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài nói nào</td></tr>
                <?php else: ?>
                    <?php foreach ($speaking as $s): ?>
                    <tr>
                        <td><?= (int)$s['id'] ?></td>
                        <td><?= escape(mb_truncate($s['instruction'], 50)) ?></td>
                        <td style="font-family:var(--font-hanzi);font-size:1.1rem"><?= escape(mb_truncate($s['target_text'], 30)) ?></td>
                        <td style="font-size:.82rem"><?= escape($s['lesson_title'] ?? '-') ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/speaking/edit/<?= (int)$s['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/speaking/delete/<?= (int)$s['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài nói này?')">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <?php $perPage = 20; if ($total > $perPage): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                <a href="/admin/speaking?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>