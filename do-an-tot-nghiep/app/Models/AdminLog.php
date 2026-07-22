<?php
namespace App\Models;

class AdminLog extends Model
{
    protected static string $table = 'admin_logs';
    protected array $fillable = ['admin_id', 'action', 'entity_type', 'entity_id', 'old_values', 'new_values', 'ip_address', 'user_agent'];
    protected bool $timestamps = true;

    public function admin(): ?User
    {
        return User::find($this->admin_id);
    }

    public static function log(int $adminId, string $action, string $entityType, int $entityId, ?array $oldValues = null, ?array $newValues = null): int
    {
        $model = new static();
        return $model->create([
            'admin_id' => $adminId,
            'action' => $action,
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'old_values' => $oldValues ? json_encode($oldValues) : null,
            'new_values' => $newValues ? json_encode($newValues) : null,
        ]);
    }
}
