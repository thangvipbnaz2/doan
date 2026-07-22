<div class="admin-header">
            <h1>Đề thi</h1>
            <a href="/admin/exam/create" class="btn btn--primary">+ Thêm đề thi</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
        <div style="padding:12px 20px;background:#d1fae5;color:#065f46;border-radius:10px;margin-bottom:20px;font-weight:500">
            <?= escape($_GET['msg'] === 'created' ? 'Đã tạo đề thi!' : ($_GET['msg'] === 'updated' ? 'Đã cập nhật!' : ($_GET['msg'] === 'deleted' ? 'Đã xóa!' : ''))) ?>
        </div>
        <?php endif; ?>

        <div class="filter-tabs">
            <a href="/admin/exam" class="filter-tab <?= !$level ? 'active' : '' ?>">Tất cả</a>
            <?php for ($i = 1; $i <= 6; $i++): ?>
            <a href="/admin/exam?level=<?= $i ?>" class="filter-tab <?= $level === $i ? 'active' : '' ?>">HSK <?= $i ?></a>
            <?php endfor; ?>
        </div>

        <div class="admin-card">
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Cấp độ</th><th>Tiêu đề</th><th>Thời gian</th><th>Số câu</th><th>Điểm đạt</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($templates)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--gray)">Chưa có đề thi nào</td></tr>
                <?php else: ?>
                    <?php foreach ($templates as $e): ?>
                    <tr>
                        <td><?= (int)$e['id'] ?></td>
                        <td><span class="badge badge-hsk<?= (int)$e['level'] ?>">HSK <?= (int)$e['level'] ?></span></td>
                        <td><strong><?= escape($e['title']) ?></strong></td>
                        <td><?= (int)$e['duration_minutes'] ?> phút</td>
                        <td><?= (int)$e['total_questions'] ?></td>
                        <td>≥ <?= (int)$e['passing_score'] ?>%</td>
                        <td class="actions">
                            <a href="/admin/exam/edit/<?= (int)$e['id'] ?>" class="btn btn--small btn--primary">Sửa</a>
                            <a href="/admin/exam/questions/<?= (int)$e['id'] ?>" class="btn btn--small btn--primary" style="background:var(--coral)">Câu hỏi</a>
                            <a href="/admin/exam/delete/<?= (int)$e['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa đề thi này? Các câu hỏi liên quan cũng sẽ bị xóa.')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>