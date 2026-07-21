<?php
namespace App\Models;

class Dialogue extends Model
{
    protected static string $table = 'dialogues';
    protected array $fillable = ['lesson_id', 'title', 'context', 'sort_order'];
    protected bool $timestamps = true;

    public function sentences(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM dialogue_sentences WHERE dialogue_id = ? ORDER BY sort_order",
            [$this->id]
        );
    }
}
