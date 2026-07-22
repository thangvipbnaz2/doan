<div class="admin-header">
            <h1>Bài học</h1>
            <a href="/admin/lessons/create" class="btn btn--primary">+ Thêm bài học</a>
        </div>

        <div class="filter-tabs">
            <a href="/admin/lessons" class="filter-tab <?= !$level ? 'active' : '' ?>">Tất cả</a>
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <a href="/admin/lessons?level=<?= $i ?>" class="filter-tab <?= $level === $i ? 'active' : '' ?>">HSK <?= $i ?></a>
            <?php endfor; ?>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Cấp độ</th><th>Bài</th><th>Tiêu đề</th><th>Loại</th><th>Từ vựng</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($lessons)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--gray)">Chưa có bài học nào</td></tr>
                <?php else: ?>
                    <?php foreach ($lessons as $l): ?>
                    <tr>
                        <td><?= (int)$l['id'] ?></td>
                        <td><span class="badge badge-hsk<?= (int)$l['level'] ?>">HSK <?= (int)$l['level'] ?></span></td>
                        <td><?= (int)$l['lesson_num'] ?></td>
                        <td><strong><?= escape($l['title']) ?></strong></td>
                        <td><?= escape($l['type']) ?></td>
                        <td><?= (int)$l['vocab_count'] ?></td>
                        <td class="actions">
                            <a href="/admin/lessons/edit/<?= (int)$l['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                            <a href="/admin/lessons/delete/<?= (int)$l['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa bài học này?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <?php $perPage = 20; if ($total > $perPage): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                <a href="/admin/lessons?page=<?= $p ?>&level=<?= $level ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>