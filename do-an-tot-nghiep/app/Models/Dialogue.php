<?php
namespace App\Models;

class Dialogue extends Model
{
    protected static string $table = 'dialogues';
    protected array $fillable = ['lesson_id', 'title', 'context', 'context_vi', 'audio_url', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function sentences(): array
    {
        return DialogueSentence::findBy('dialogue_id', $this->id);
    }
}
