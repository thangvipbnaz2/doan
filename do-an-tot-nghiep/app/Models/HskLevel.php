<?php
namespace App\Models;

class HskLevel extends Model
{
    protected static string $table = 'hsk_levels';
    protected array $fillable = ['level', 'name', 'name_vi', 'description', 'total_vocab', 'total_lessons', 'icon', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lessons(): array
    {
        return Lesson::findBy('hsk_level', $this->level);
    }

    public function courses(): array
    {
        return Course::findBy('hsk_level_id', $this->id);
    }

    public function vocabulary(): array
    {
        return Vocabulary::findBy('hsk_level', $this->level);
    }
}
