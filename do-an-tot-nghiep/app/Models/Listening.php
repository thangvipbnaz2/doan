<?php
namespace App\Models;

class Listening extends Model
{
    protected static string $table = 'listening_exercises';
    protected array $fillable = ['lesson_id', 'title', 'audio_url', 'transcript', 'transcript_pinyin', 'transcript_vi', 'sort_order'];
    protected bool $timestamps = true;

    public function questions(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM listening_questions WHERE listening_id = ? ORDER BY sort_order",
            [$this->id]
        );
    }
}
