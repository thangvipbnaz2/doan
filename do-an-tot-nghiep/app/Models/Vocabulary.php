<?php
namespace App\Models;

class Vocabulary extends Model
{
    protected static string $table = 'vocabulary';
    protected array $fillable = ['lesson_id', 'hsk_level', 'hanzi', 'pinyin', 'meaning', 'meaning_vi', 'example', 'example_pinyin', 'example_vi', 'radical', 'stroke_count', 'word_type', 'audio_url', 'image_url', 'mnemonic', 'frequency', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function flashcards(): array
    {
        return Flashcard::findBy('vocab_id', $this->id);
    }

    public function favorites(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM favorites WHERE favorable_type = ? AND favorable_id = ?",
            ['vocabulary', $this->id]
        );
    }

    public static function search(string $query): array
    {
        $table = self::getTable();
        $like = "%{$query}%";
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM {$table} WHERE hanzi LIKE ? OR pinyin LIKE ? OR meaning LIKE ? OR meaning_vi LIKE ? ORDER BY sort_order, lesson_id LIMIT 50",
            [$like, $like, $like, $like]
        );
    }
}
