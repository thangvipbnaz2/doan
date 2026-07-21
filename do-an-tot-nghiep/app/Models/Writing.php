<?php
namespace App\Models;

class Writing extends Model
{
    protected static string $table = 'writing_exercises';
    protected array $fillable = ['lesson_id', 'character_char', 'stroke_count', 'radical', 'meaning', 'sort_order'];
    protected bool $timestamps = true;
}
