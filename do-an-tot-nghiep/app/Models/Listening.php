<?php
namespace App\Models;

class Listening extends Model
{
    protected static string $table = 'listening_exercises';
    protected array $fillable = ['lesson_id', 'title', 'audio_url', 'transcript', 'transcript_pinyin', 'transcript_vi', 'image_url', 'duration_seconds', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function questions(): array
    {
        return ListeningQuestion::findBy('listening_id', $this->id);
    }
}
