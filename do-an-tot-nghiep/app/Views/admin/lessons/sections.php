<div class="admin-header">
    <h1>Quản lý nội dung: <?= App\Helpers\View::escape($lesson['title']) ?></h1>
    <a href="/do-an-tot-nghiep/admin/lessons" class="btn" style="padding: 10px 20px; background: #636e72; color: #fff; border-radius: 8px; text-decoration: none;">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
    <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3><i class="fas fa-font" style="color: #4facfe;"></i> Từ vựng (<?= count($vocab) ?>)</h3>
            <a href="/do-an-tot-nghiep/admin/vocab/create?lesson_id=<?= $lesson['id'] ?>" class="btn btn-sm" style="padding: 6px 12px; background: #667eea; color: #fff; border-radius: 4px; text-decoration: none;">
                <i class="fas fa-plus"></i> Thêm
            </a>
        </div>
        <?php if (!empty($vocab)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($vocab as $v): ?>
            <li style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between;">
                <span><strong><?= App\Helpers\View::escape($v['hanzi']) ?></strong> - <?= App\Helpers\View::escape($v['meaning']) ?></span>
                <a href="/do-an-tot-nghiep/admin/vocab/edit/<?= $v['id'] ?>" style="color: #4facfe;"><i class="fas fa-edit"></i></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p style="color: #999; text-align: center; padding: 20px;">Chưa có từ vựng</p>
        <?php endif; ?>
    </div>

    <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3><i class="fas fa-language" style="color: #43e97b;"></i> Ngữ pháp (<?= count($grammar) ?>)</h3>
            <a href="/do-an-tot-nghiep/admin/grammar/create?lesson_id=<?= $lesson['id'] ?>" class="btn btn-sm" style="padding: 6px 12px; background: #667eea; color: #fff; border-radius: 4px; text-decoration: none;">
                <i class="fas fa-plus"></i> Thêm
            </a>
        </div>
        <?php if (!empty($grammar)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($grammar as $g): ?>
            <li style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between;">
                <span><strong><?= App\Helpers\View::escape($g['title']) ?></strong></span>
                <a href="/do-an-tot-nghiep/admin/grammar/edit/<?= $g['id'] ?>" style="color: #4facfe;"><i class="fas fa-edit"></i></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p style="color: #999; text-align: center; padding: 20px;">Chưa có ngữ pháp</p>
        <?php endif; ?>
    </div>

    <div class="card" style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3><i class="fas fa-comments" style="color: #fa709a;"></i> Hội thoại (<?= count($dialogues) ?>)</h3>
            <a href="/do-an-tot-nghiep/admin/dialogues/create?lesson_id=<?= $lesson['id'] ?>" class="btn btn-sm" style="padding: 6px 12px; background: #667eea; color: #fff; border-radius: 4px; text-decoration: none;">
                <i class="fas fa-plus"></i> Thêm
            </a>
        </div>
        <?php if (!empty($dialogues)): ?>
        <ul style="list-style: none; padding: 0;">
            <?php foreach ($dialogues as $d): ?>
            <li style="padding: 8px 0; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between;">
                <span><strong><?= App\Helpers\View::escape($d['title']) ?></strong></span>
                <a href="/do-an-tot-nghiep/admin/dialogues/edit/<?= $d['id'] ?>" style="color: #4facfe;"><i class="fas fa-edit"></i></a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p style="color: #999; text-align: center; padding: 20px;">Chưa có hội thoại</p>
        <?php endif; ?>
    </div>
</div>
