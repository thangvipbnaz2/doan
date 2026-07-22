<?php
namespace App\Models;

class LessonProgress extends Model
{
    protected static string $table = 'lesson_progress';
    protected array $fillable = ['user_id', 'lesson_id', 'vocab_completed', 'vocab_total', 'grammar_completed', 'dialogue_completed', 'reading_completed', 'listening_completed', 'exercise_score', 'is_completed', 'completed_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }
}
