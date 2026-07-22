<?php
namespace App\Models;

class User extends Model
{
    protected static string $table = 'users';
    protected array $fillable = ['role_id', 'username', 'email', 'password', 'display_name', 'avatar', 'bio', 'phone', 'birthdate', 'gender', 'hsk_level', 'is_active', 'settings'];
    protected array $hidden = ['password', 'remember_token'];
    protected bool $timestamps = true;

    public function role(): ?Role
    {
        return Role::find($this->role_id);
    }

    public function orders(): array
    {
        return Order::findBy('user_id', $this->id);
    }

    public function enrollments(): array
    {
        return Enrollment::findBy('user_id', $this->id);
    }

    public function achievements(): array
    {
        return Achievement::findBy('user_id', $this->id);
    }

    public function flashcards(): array
    {
        return Flashcard::findBy('user_id', $this->id);
    }

    public static function authenticate(string $login, string $password): ?static
    {
        $table = self::getTable();
        $data = \App\Helpers\Database::fetch(
            "SELECT * FROM {$table} WHERE username = ? OR email = ? LIMIT 1",
            [$login, $login]
        );
        if ($data && password_verify($password, $data['password'] ?? '')) {
            $model = new static();
            foreach ($data as $key => $val) $model->$key = $val;
            return $model;
        }
        return null;
    }

    public function isAdmin(): bool
    {
        $role = $this->role();
        return $role && $role->slug === 'admin';
    }

    public function isTeacher(): bool
    {
        $role = $this->role();
        return $role && $role->slug === 'teacher';
    }

    public function hasRole(string $role): bool
    {
        $r = $this->role();
        return $r && $r->slug === $role;
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

    public function getFlashcardsDue(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM flashcards WHERE user_id = ? AND next_review_at <= NOW() AND is_active = 1 ORDER BY next_review_at ASC",
            [$this->id]
        );
    }

    public function getUnreadNotificationsCount(): int
    {
        $data = \App\Helpers\Database::fetch(
            "SELECT COUNT(*) as cnt FROM notifications WHERE user_id = ? AND is_read = 0",
            [$this->id]
        );
        return (int) ($data['cnt'] ?? 0);
    }
}
