<div class="admin-header">
            <h1>Ngữ pháp</h1>
            <a href="/admin/grammar/create" class="btn btn--primary">+ Thêm ngữ pháp</a>
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
                <thead><tr><th>ID</th><th>Tiêu đề</th><th>Công thức</th><th>Bài học</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($grammar)): ?>
                    <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--gray)">Chưa có ngữ pháp nào</td></tr>
                <?php else: ?>
                    <?php foreach ($grammar as $g): ?>
                    <tr>
                        <td><?= (int)$g['id'] ?></td>
                        <td><strong><?= escape($g['title']) ?></strong></td>
                        <td style="font-family:monospace;color:var(--teal)"><?= escape($g['formula']) ?></td>
                        <td style="font-size:.82rem"><?= escape($g['lesson_title'] ?? '-') ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/grammar/edit/<?= (int)$g['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/grammar/delete/<?= (int)$g['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa ngữ pháp này?')">Xóa</a>
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
                <a href="/admin/grammar?page=<?= $p ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>