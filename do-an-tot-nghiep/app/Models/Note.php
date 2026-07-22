<?php
namespace App\Models;

class Note extends Model
{
    protected static string $table = 'notes';
    protected array $fillable = ['user_id', 'lesson_id', 'vocab_id', 'title', 'content', 'color', 'is_public'];
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
