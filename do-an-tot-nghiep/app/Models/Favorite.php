<?php
namespace App\Models;

class Favorite extends Model
{
    protected static string $table = 'favorites';
    protected array $fillable = ['user_id', 'favorable_type', 'favorable_id'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }
}
