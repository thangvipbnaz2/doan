<div class="admin-header">
            <h1>Bài nghe</h1>
            <a href="/admin/listening/create" class="btn btn--primary">+ Thêm bài nghe</a>
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
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> bài nghe</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Tiêu đề</th><th>Bài học</th><th>Câu hỏi</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($listening)): ?>
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài nghe nào</td></tr>
                <?php else: ?>
                    <?php foreach ($listening as $ex): ?>
                    <tr>
                        <td><?= (int)$ex['id'] ?></td>
                        <td><strong><?= escape($ex['title']) ?></strong></td>
                        <td style="font-size:.82rem"><?= escape($ex['lesson_title'] ?? '-') ?></td>
                        <td class="q-count"><?= count($ex['questions']) ?> câu</td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/listening/edit/<?= (int)$ex['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/listening/delete/<?= (int)$ex['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài nghe này?')">Xóa</a>
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
                <a href="/admin/listening?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>