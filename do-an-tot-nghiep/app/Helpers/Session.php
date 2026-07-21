<?php
namespace App\Helpers;

class Session
{
    private static bool $started = false;

    public static function start(): void
    {
        if (self::$started) {
            return;
        }

        $config = require __DIR__ . '/../../config/app.php';
        $sessionConfig = $config['session'];

        if (session_status() === PHP_SESSION_NONE) {
            ini_set('session.cookie_lifetime', $sessionConfig['lifetime']);
            ini_set('session.gc_maxlifetime', $sessionConfig['lifetime']);
            session_name($sessionConfig['name']);
            session_start();
        }

        self::$started = true;
    }

    public static function set(string $key, $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, $default = null)
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        self::start();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        self::$started = false;
    }

    public static function flash(string $key, $value = null)
    {
        self::start();
        if ($value !== null) {
            $_SESSION['_flash'][$key] = $value;
            return;
        }
        $val = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $val;
    }

    public static function hasFlash(string $key): bool
    {
        self::start();
        return isset($_SESSION['_flash'][$key]);
    }

    public static function getFlashMessages(): array
    {
        self::start();
        $messages = $_SESSION['_flash'] ?? [];
        unset($_SESSION['_flash']);
        return $messages;
    }
}
