<div class="admin-header">
            <h1>Từ vựng</h1>
            <div style="display:flex;gap:8px">
                <a href="/admin/vocab/create" class="btn btn--primary">+ Thêm từ vựng</a>
            </div>
        </div>

        <div class="admin-card">
            <div class="card-header">
                <form method="GET" class="filters">
                    <select name="level">
                        <option value="">Tất cả cấp độ</option>
                        <?php for ($i = 1; $i <= 6; $i++): ?>
                        <option value="<?= $i ?>" <?= (string)$level === (string)$i ? 'selected' : '' ?>>HSK <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
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
                <span style="font-size:.85rem;color:var(--gray)"><?= number_format($total) ?> từ</span>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Chữ Hán</th><th>Pinyin</th><th>Nghĩa</th><th>HSK</th><th>Bài</th><th>Số nét</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($vocab)): ?>
                    <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--gray)">Không tìm thấy từ vựng nào</td></tr>
                <?php else: ?>
                    <?php foreach ($vocab as $v): ?>
                    <tr>
                        <td><?= (int)$v['id'] ?></td>
                        <td class="td-hanzi"><?= escape($v['hanzi']) ?></td>
                        <td style="color:var(--teal);font-style:italic;font-weight:600"><?= escape($v['pinyin']) ?></td>
                        <td><?= escape($v['meaning']) ?></td>
                        <td><span class="badge badge-hsk<?= (int)$v['level'] ?>">HSK <?= (int)$v['level'] ?></span></td>
                        <td style="font-size:.82rem"><?= escape($v['lesson_title'] ?? '-') ?></td>
                        <td><?= (int)$v['strokes'] ?></td>
                        <td>
                            <div style="display:flex;gap:4px">
                                <a href="/admin/vocab/edit/<?= (int)$v['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                                <a href="/admin/vocab/delete/<?= (int)$v['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa từ <?= escape($v['hanzi']) ?>?')">Xóa</a>
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
                <a href="/admin/vocab?page=<?= $p ?>&level=<?= escape($level) ?>&lesson_id=<?= $lessonId ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>