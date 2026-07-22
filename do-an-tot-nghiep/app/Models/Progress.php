<?php
namespace App\Models;

class Progress extends Model
{
    protected static string $table = 'progress';
    protected array $fillable = ['user_id', 'lesson_id', 'vocab_id', 'exercise_id', 'is_completed', 'score', 'time_spent_seconds', 'attempts', 'completed_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function vocab(): ?Vocabulary
    {
        return Vocabulary::find($this->vocab_id);
    }
}
