<?php $baseUrl = App\Helpers\View::baseUrl(); ?>
<div class="profile-page" style="max-width: 800px; margin: 0 auto; padding: 40px 20px;">
    <h1 style="font-size: 28px; margin-bottom: 24px;">Hồ sơ của tôi</h1>

    <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); margin-bottom: 24px;">
        <form method="POST" action="<?= $baseUrl ?>/profile/update">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="fg">
                    <label>Tên đăng nhập</label>
                    <input type="text" value="<?= App\Helpers\View::escape($user['username']) ?>" disabled>
                </div>
                <div class="fg">
                    <label>Email</label>
                    <input type="email" value="<?= App\Helpers\View::escape($user['email']) ?>" disabled>
                </div>
                <div class="fg">
                    <label>Tên hiển thị</label>
                    <input type="text" name="display_name" value="<?= App\Helpers\View::escape($user['display_name'] ?? $user['username']) ?>">
                </div>
                <div class="fg">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="<?= App\Helpers\View::escape($user['phone'] ?? '') ?>">
                </div>
                <div class="fg" style="grid-column: 1/-1;">
                    <label>Giới thiệu</label>
                    <textarea name="bio" rows="3"><?= App\Helpers\View::escape($user['bio'] ?? '') ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn" style="margin-top: 16px; padding: 12px 32px; background: #e94560; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Lưu thay đổi</button>
        </form>
    </div>

    <div style="background: #fff; border-radius: 12px; padding: 24px; box-shadow: 0 2px 10px rgba(0,0,0,0.08);">
        <h2 style="font-size: 20px; margin-bottom: 16px;">Đổi mật khẩu</h2>
        <form method="POST" action="<?= $baseUrl ?>/profile/update-password">
            <div class="fg">
                <label>Mật khẩu hiện tại</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="fg">
                <label>Mật khẩu mới</label>
                <input type="password" name="new_password" required minlength="6">
            </div>
            <div class="fg">
                <label>Xác nhận mật khẩu mới</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn" style="margin-top: 16px; padding: 12px 32px; background: #e94560; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Đổi mật khẩu</button>
        </form>
    </div>
</div>
