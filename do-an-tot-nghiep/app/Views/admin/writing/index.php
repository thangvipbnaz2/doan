<div class="admin-header">
            <h1>Bài viết chữ Hán</h1>
            <a href="/admin/writing/create" class="btn btn--primary">+ Thêm bài viết</a>
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
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> bài viết</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Chữ Hán</th><th>Số nét</th><th>Bộ thủ</th><th>Bài học</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($writing)): ?>
                    <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài viết nào</td></tr>
                <?php else: ?>
                    <?php foreach ($writing as $w): ?>
                    <tr>
                        <td><?= (int)$w['id'] ?></td>
                        <td style="font-family:var(--font-hanzi);font-size:1.4rem;font-weight:700"><?= escape($w['character_char']) ?></td>
                        <td><?= (int)$w['stroke_count'] ?></td>
                        <td><?= escape($w['radical'] ?? '-') ?></td>
                        <td style="font-size:.82rem"><?= escape($w['lesson_title'] ?? '-') ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/writing/edit/<?= (int)$w['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/writing/delete/<?= (int)$w['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài viết này?')">Xóa</a>
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
                <a href="/admin/writing?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>