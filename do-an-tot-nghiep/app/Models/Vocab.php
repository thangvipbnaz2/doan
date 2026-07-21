<?php
namespace App\Models;

class Vocab extends Model
{
    protected static string $table = 'vocab';
    protected array $fillable = ['lesson_id', 'hanzi', 'pinyin', 'meaning', 'example', 'example_pinyin', 'example_vi', 'radical', 'stroke_count', 'level', 'audio_url'];
    protected bool $timestamps = true;

    public static function search(string $query): array
    {
        $table = self::getTable();
        $like = "%{$query}%";
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM {$table} WHERE hanzi LIKE ? OR pinyin LIKE ? OR meaning LIKE ? ORDER BY level, lesson_id LIMIT 50",
            [$like, $like, $like]
        );
    }
}
