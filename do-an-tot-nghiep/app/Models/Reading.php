<?php
namespace App\Models;

class Reading extends Model
{
    protected static string $table = 'readings';
    protected array $fillable = ['lesson_id', 'title', 'content', 'pinyin', 'translation', 'vocabulary_notes', 'sort_order'];
    protected bool $timestamps = true;
}
