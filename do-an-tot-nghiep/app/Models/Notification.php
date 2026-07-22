<?php
namespace App\Models;

class Notification extends Model
{
    protected static string $table = 'notifications';
    protected array $fillable = ['user_id', 'type', 'title', 'message', 'link', 'icon', 'is_read', 'read_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function markAsRead(): bool
    {
        $this->is_read = 1;
        $this->read_at = date('Y-m-d H:i:s');
        return $this->update($this->id, ['is_read' => 1, 'read_at' => $this->read_at]);
    }

    public static function getAllForUser(int $userId): array
    {
        return self::findBy('user_id', $userId);
    }

    public static function getUnreadForUser(int $userId): array
    {
        $table = self::getTable();
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM {$table} WHERE user_id = ? AND is_read = 0 ORDER BY created_at DESC",
            [$userId]
        );
    }

    public static function create(int $userId, string $type, string $title, string $message, ?string $link = null): int
    {
        $model = new static();
        return $model->create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'link' => $link,
        ]);
    }
}
