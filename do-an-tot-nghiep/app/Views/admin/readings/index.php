<div class="admin-header">
            <h1>Bài đọc</h1>
            <a href="/admin/reading/create" class="btn btn--primary">+ Thêm bài đọc</a>
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
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> bài đọc</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Tiêu đề</th><th>Bài học</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($readings)): ?>
                    <tr><td colspan="4" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài đọc nào</td></tr>
                <?php else: ?>
                    <?php foreach ($readings as $r): ?>
                    <tr>
                        <td><?= (int)$r['id'] ?></td>
                        <td><strong><?= escape($r['title']) ?></strong></td>
                        <td style="font-size:.82rem"><?= escape($r['lesson_title'] ?? '-') ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/reading/edit/<?= (int)$r['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/reading/delete/<?= (int)$r['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài đọc này?')">Xóa</a>
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
                <a href="/admin/reading?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>