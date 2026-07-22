<div class="admin-header">
            <h1>Người dùng</h1>
        </div>

        <div class="admin-card">
            <div class="filters">
                <form method="GET" style="display:flex;gap:10px;width:100%;flex-wrap:wrap">
                    <input type="text" name="search" value="<?= escape($search) ?>" placeholder="Tìm kiếm theo tên, email, username...">
                    <button type="submit" class="btn btn--primary btn--small">Tìm kiếm</button>
                </form>
            </div>
            <table class="admin-table">
                <thead><tr><th>ID</th><th>Tên</th><th>Email</th><th>Username</th><th>Vai trò</th><th>Ngày tạo</th><th>Hành động</th></tr></thead>
                <tbody>
                <?php if (empty($users)): ?>
                    <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--gray)">Không tìm thấy người dùng nào</td></tr>
                <?php else: ?>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= (int)$u['id'] ?></td>
                        <td><strong><?= escape($u['display_name'] ?: $u['username']) ?></strong></td>
                        <td><?= escape($u['email']) ?></td>
                        <td><?= escape($u['username']) ?></td>
                        <td>
                            <form method="POST" action="/admin/users/update/role">
                                <input type="hidden" name="id" value="<?= (int)$u['id'] ?>">
                                <select name="role" class="role-select" onchange="this.form.submit()">
                                    <option value="user" <?= $u['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= $u['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </form>
                        </td>
                        <td style="font-size:.82rem;color:var(--gray)"><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                        <td>
                            <a href="/admin/users/delete/<?= (int)$u['id'] ?>" class="btn btn--small btn--danger" onclick="return confirm('Xóa người dùng <?= escape($u['username']) ?>?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
            <?php $perPage = 20; if ($total > $perPage): ?>
            <div class="pagination">
                <?php for ($p = 1; $p <= $lastPage; $p++): ?>
                <a href="/admin/users?page=<?= $p ?>&search=<?= escape($search) ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>