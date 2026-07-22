<?php
namespace App\Models;

class Role extends Model
{
    protected static string $table = 'roles';
    protected array $fillable = ['name', 'slug', 'description', 'permissions', 'is_system'];
    protected bool $timestamps = true;

    public function users(): array
    {
        return User::findBy('role_id', $this->id);
    }
}
