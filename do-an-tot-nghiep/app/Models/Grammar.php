<?php
namespace App\Models;

class Grammar extends Model
{
    protected static string $table = 'grammar';
    protected array $fillable = ['lesson_id', 'title', 'formula', 'meaning', 'meaning_vi', 'usage', 'notes', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function examples(): array
    {
        return GrammarExample::findBy('grammar_id', $this->id);
    }

    public function exercises(): array
    {
        return Exercise::findBy('grammar_id', $this->id);
    }
}
