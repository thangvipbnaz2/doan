<?php
namespace App\Models;

class Speaking extends Model
{
    protected static string $table = 'speaking_exercises';
    protected array $fillable = ['lesson_id', 'instruction', 'target_text', 'target_pinyin', 'sort_order'];
    protected bool $timestamps = true;
}
