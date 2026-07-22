<?php
namespace App\Models;

class UserGoal extends Model
{
    protected static string $table = 'user_goals';
    protected array $fillable = ['user_id', 'target_hsk_level', 'daily_goal_minutes', 'daily_vocab_goal', 'daily_exercise_goal', 'start_date', 'target_date', 'is_active'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }
}
