<?php
namespace App\Models;

class Reading extends Model
{
    protected static string $table = 'reading';
    protected array $fillable = ['lesson_id', 'title', 'content', 'pinyin', 'translation', 'vocabulary_notes', 'audio_url', 'image_url', 'difficulty', 'word_count', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }
}
