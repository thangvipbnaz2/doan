<?php
namespace App\Models;

class Grammar extends Model
{
    protected static string $table = 'grammar';
    protected array $fillable = ['lesson_id', 'title', 'formula', 'meaning', 'usage', 'notes', 'sort_order'];
    protected bool $timestamps = true;

    public function examples(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM grammar_examples WHERE grammar_id = ? ORDER BY id",
            [$this->id]
        );
    }

    public function exercises(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM grammar_exercises WHERE grammar_id = ? ORDER BY sort_order",
            [$this->id]
        );
    }
}
