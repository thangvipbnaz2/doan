<?php
namespace App\Controllers\Api;

use App\Helpers\Database;
use App\Helpers\Session;

class AuthApiController extends BaseApiController
{
    public function login(): void
    {
        $input = $this->getJsonInput();
        $login = $input['username'] ?? $input['email'] ?? '';
        $password = $input['password'] ?? '';

        if (empty($login) || empty($password)) {
            $this->error('Username/email and password are required');
        }

        $user = Database::fetch(
            "SELECT * FROM users WHERE (username = ? OR email = ?) AND is_active = 1 LIMIT 1",
            [$login, $login]
        );

        if (!$user || !password_verify($password, $user['password'])) {
            $this->error('Invalid credentials', 401);
        }

        session_regenerate_id(true);
        Session::set('user_id', (int) $user['id']);
        Session::set('username', $user['username']);
        Session::set('display_name', $user['display_name'] ?? $user['username']);
        Session::set('role', $user['role'] ?? 'user');

        unset($user['password']);
        $this->json(['success' => true, 'user' => $user]);
    }

    public function register(): void
    {
        $input = $this->getJsonInput();
        $username = $input['username'] ?? '';
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            $this->error('Username, email and password are required');
        }

        $existing = Database::fetch(
            "SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1",
            [$username, $email]
        );
        if ($existing) {
            $this->error('Username or email already exists');
        }

        $userId = Database::insert('users', [
            'username' => $username,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'display_name' => $username,
            'role' => 'user',
            'is_active' => 1,
        ]);

        $this->json(['success' => true, 'user_id' => $userId]);
    }

    public function logout(): void
    {
        Session::destroy();
        $this->json(['success' => true]);
    }

    public function me(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            $this->error('Not authenticated', 401);
        }

        $user = Database::fetch("SELECT id, username, email, display_name, avatar, role, hsk_level, created_at FROM users WHERE id = ?", [$userId]);
        if (!$user) {
            $this->error('User not found', 404);
        }

        $this->json(['success' => true, 'user' => $user]);
    }
}
