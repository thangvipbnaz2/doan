<div class="admin-header">
            <h1>Hội thoại</h1>
            <a href="/admin/dialogues/create" class="btn btn--primary">+ Thêm hội thoại</a>
        </div>

        <div class="admin-card">
            <div class="filters">
                <form method="GET">
                    <select name="lesson_id" onchange="this.form.submit()">
                        <option value="">Tất cả bài học</option>
                        <?php foreach ($lessons as $ls): ?>
                        <option value="<?= (int)$ls['id'] ?>" <?= (int)$lessonId === (int)$ls['id'] ? 'selected' : '' ?>>
                            HSK<?= (int)$ls['level'] ?> - Bài <?= (int)$ls['lesson_num'] ?>: <?= escape($ls['title']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Tiêu đề</th><th>Bối cảnh</th><th>Bài học</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($dialogues)): ?>
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có hội thoại nào</td></tr>
                <?php else: ?>
                    <?php foreach ($dialogues as $d): ?>
                    <tr>
                        <td><?= (int)$d['id'] ?></td>
                        <td><strong><?= escape($d['title']) ?></strong></td>
                        <td style="font-size:.82rem;color:var(--gray);max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?= escape($d['context'] ?? '') ?></td>
                        <td style="font-size:.82rem"><?= escape($d['lesson_title'] ?? '-') ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/dialogues/edit/<?= (int)$d['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/dialogues/delete/<?= (int)$d['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa hội thoại này?')">Xóa</a>
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
                <a href="/admin/dialogue?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>