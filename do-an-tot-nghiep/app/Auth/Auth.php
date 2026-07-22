<?php
declare(strict_types=1);
namespace App\Auth;

use App\Helpers\Session;
use App\Helpers\Database;

class Auth
{
    private static ?array $user = null;
    private static bool $loaded = false;

    public static function login(array $credentials): bool
    {
        $login = $credentials['username'] ?? $credentials['email'] ?? '';
        $password = $credentials['password'] ?? '';

        if (self::rateLimit($login, 5, 10)) {
            return false;
        }

        $user = Database::fetch(
            "SELECT * FROM users WHERE (username = ? OR email = ?) AND is_active = 1 LIMIT 1",
            [$login, $login]
        );

        if (!$user || !password_verify($password, $user['password'])) {
            self::incrementRateLimit($login);
            return false;
        }

        self::loginUser($user);
        self::clearRateLimit($login);
        return true;
    }

    public static function attempt(string $username, string $password): bool
    {
        return self::login(['username' => $username, 'password' => $password]);
    }

    public static function loginById(int $userId): bool
    {
        $user = Database::fetch(
            "SELECT * FROM users WHERE id = ? AND is_active = 1 LIMIT 1",
            [$userId]
        );

        if (!$user) {
            return false;
        }

        self::loginUser($user);
        return true;
    }

    public static function logout(): void
    {
        Session::remove('user_id');
        Session::remove('username');
        Session::remove('display_name');
        Session::remove('role');
        Session::remove('avatar');
        self::$user = null;
        self::$loaded = false;
        Session::destroy();
    }

    public static function user(): ?array
    {
        if (!self::$loaded) {
            self::loadUser();
        }
        return self::$user;
    }

    public static function id(): ?int
    {
        $user = self::user();
        return $user ? (int) $user['id'] : null;
    }

    public static function check(): bool
    {
        return self::id() !== null;
    }

    public static function guest(): bool
    {
        return !self::check();
    }

    public static function hasRole(string $role): bool
    {
        $user = self::user();
        if (!$user) {
            return false;
        }
        if ($role === 'admin') {
            return ($user['role'] ?? '') === 'admin' || ($user['role_id'] ?? 0) === 1;
        }
        return ($user['role'] ?? '') === $role;
    }

    public static function can(string $permission): bool
    {
        $user = self::user();
        if (!$user) {
            return false;
        }
        if (self::hasRole('admin')) {
            return true;
        }
        $result = Database::fetch(
            "SELECT COUNT(*) as cnt FROM role_permissions rp
             JOIN user_roles ur ON ur.role_id = rp.role_id
             WHERE ur.user_id = ? AND rp.permission = ?",
            [$user['id'], $permission]
        );
        return ($result['cnt'] ?? 0) > 0;
    }

    public static function rememberMe(): void
    {
        $user = self::user();
        if (!$user) {
            return;
        }
        $token = bin2hex(random_bytes(32));
        Database::update('users', ['remember_token' => $token], 'id = :id', ['id' => $user['id']]);
        $secure = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
        setcookie('remember_token', $token, time() + 86400 * 30, '/', '', $secure, true);
        setcookie('remember_user', (string) $user['id'], time() + 86400 * 30, '/', '', $secure, true);
    }

    public static function rateLimit(string $key, int $maxAttempts, int $decayMinutes): bool
    {
        $identifier = 'login_' . $key;
        $result = Database::fetch(
            "SELECT COUNT(*) as cnt FROM login_attempts WHERE identifier = ? AND attempted_at > DATE_SUB(NOW(), INTERVAL ? MINUTE)",
            [$identifier, $decayMinutes]
        );
        return ($result['cnt'] ?? 0) >= $maxAttempts;
    }

    private static function incrementRateLimit(string $key): void
    {
        $identifier = 'login_' . $key;
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        Database::insert('login_attempts', [
            'identifier' => $identifier,
            'ip_address' => $ip,
            'attempted_at' => date('Y-m-d H:i:s'),
        ]);
    }

    private static function clearRateLimit(string $key): void
    {
        $identifier = 'login_' . $key;
        Database::delete('login_attempts', 'identifier = ?', [$identifier]);
    }

    private static function loginUser(array $user): void
    {
        session_regenerate_id(true);
        Session::set('user_id', (int) $user['id']);
        Session::set('username', $user['username']);
        Session::set('display_name', $user['display_name'] ?? $user['username']);
        Session::set('role', $user['role'] ?? 'user');
        Session::set('avatar', $user['avatar'] ?? '');
        self::$user = $user;
        self::$loaded = true;
    }

    private static function loadUser(): void
    {
        $userId = Session::get('user_id');
        if (!$userId) {
            self::tryRememberMe();
            $userId = Session::get('user_id');
        }
        if ($userId) {
            $user = Database::fetch("SELECT * FROM users WHERE id = ? AND is_active = 1 LIMIT 1", [$userId]);
            if ($user) {
                self::$user = $user;
            } else {
                self::logout();
            }
        }
        self::$loaded = true;
    }

    private static function tryRememberMe(): void
    {
        $token = $_COOKIE['remember_token'] ?? '';
        $userId = $_COOKIE['remember_user'] ?? '';
        if ($token === '' || $userId === '') {
            return;
        }
        $user = Database::fetch(
            "SELECT * FROM users WHERE id = ? AND remember_token = ? AND is_active = 1 LIMIT 1",
            [(int) $userId, $token]
        );
        if ($user) {
            self::loginUser($user);
        }
    }
}
