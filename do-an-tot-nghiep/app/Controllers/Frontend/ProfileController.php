<?php
namespace App\Controllers\Frontend;

use App\Controllers\Controller;
use App\Helpers\Database;
use App\Helpers\Session;
use App\Helpers\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            Session::flash('error', 'Vui lòng đăng nhập để xem trang này.');
            header('Location: ' . View::baseUrl() . '/login.php');
            exit;
        }
    }

    public function show(): void
    {
        $userId = Session::get('user_id');
        $user = Database::fetch("SELECT * FROM users WHERE id = ?", [$userId]);

        $stats = [
            'lessons_completed' => Database::fetch("SELECT COUNT(*) as cnt FROM lesson_progress WHERE user_id = ? AND is_completed = 1", [$userId])['cnt'] ?? 0,
            'vocab_learned' => Database::fetch("SELECT COUNT(*) as cnt FROM progress WHERE user_id = ? AND is_completed = 1", [$userId])['cnt'] ?? 0,
            'streak_days' => 0,
            'achievements' => Database::fetch("SELECT COUNT(*) as cnt FROM achievements WHERE user_id = ?", [$userId])['cnt'] ?? 0,
        ];

        $this->view('frontend/profile/show', [
            'user' => $user,
            'stats' => $stats,
        ]);
    }

    public function update(): void
    {
        $userId = Session::get('user_id');
        $data = [
            'display_name' => $_POST['display_name'] ?? '',
            'bio' => $_POST['bio'] ?? '',
            'phone' => $_POST['phone'] ?? '',
        ];

        Database::update('users', $data, 'id = :id', ['id' => $userId]);
        Session::set('display_name', $data['display_name']);
        Session::flash('success', 'Thông tin đã được cập nhật.');
        $this->redirect('profile');
    }

    public function updatePassword(): void
    {
        $userId = Session::get('user_id');
        $current = $_POST['current_password'] ?? '';
        $newPass = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($newPass !== $confirm) {
            Session::flash('error', 'Mật khẩu mới không khớp.');
            $this->redirect('profile');
        }

        $user = Database::fetch("SELECT * FROM users WHERE id = ?", [$userId]);
        if (!$user || !password_verify($current, $user['password'])) {
            Session::flash('error', 'Mật khẩu hiện tại không đúng.');
            $this->redirect('profile');
        }

        Database::update('users', ['password' => password_hash($newPass, PASSWORD_DEFAULT)], 'id = :id', ['id' => $userId]);
        Session::flash('success', 'Mật khẩu đã được thay đổi.');
        $this->redirect('profile');
    }
}
