<?php
namespace App\Models;

class Order extends Model
{
    protected static string $table = 'orders';
    protected array $fillable = ['user_id', 'course_id', 'amount', 'status', 'payment_method', 'transaction_id', 'fullname', 'email', 'address', 'notes'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public static function getRevenue(): float
    {
        $data = \App\Helpers\Database::fetch(
            "SELECT COALESCE(SUM(amount), 0) as total FROM orders WHERE status = 'paid'"
        );
        return (float) ($data['total'] ?? 0);
    }

    public static function getRecent(int $limit = 10): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT o.*, u.username, u.display_name FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT ?",
            [$limit]
        );
    }
}
