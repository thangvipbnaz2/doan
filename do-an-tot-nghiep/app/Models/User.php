<?php
namespace App\Models;

class User extends Model
{
    protected static string $table = 'users';
    protected array $fillable = ['username', 'email', 'password', 'display_name', 'role', 'avatar', 'bio', 'hsk_level', 'is_active'];
    protected bool $timestamps = true;

    public static function findByUsername(string $username): ?static
    {
        return self::findOneBy('username', $username);
    }

    public static function findByEmail(string $email): ?static
    {
        return self::findOneBy('email', $email);
    }

    public static function findByUsernameOrEmail(string $login): ?static
    {
        $table = self::getTable();
        $data = \App\Helpers\Database::fetch("SELECT * FROM {$table} WHERE username = ? OR email = ? LIMIT 1", [$login, $login]);
        if (!$data) return null;
        $model = new static();
        foreach ($data as $key => $val) $model->$key = $val;
        return $model;
    }

    public static function authenticate(string $login, string $password): ?static
    {
        $user = self::findByUsernameOrEmail($login);
        if ($user && password_verify($password, $user->password ?? '')) {
            return $user;
        }
        return null;
    }

    public function isAdmin(): bool
    {
        return ($this->role ?? '') === 'admin';
    }

    public function getProgress(int $lessonId): ?array
    {
        return \App\Helpers\Database::fetch(
            "SELECT * FROM lesson_progress WHERE user_id = ? AND lesson_id = ?",
            [$this->id, $lessonId]
        );
    }

    public function getStreakDays(): int
    {
        $data = \App\Helpers\Database::fetch(
            "SELECT streak_days FROM user_streaks WHERE user_id = ?",
            [$this->id]
        );
        return (int) ($data['streak_days'] ?? 0);
    }
}
