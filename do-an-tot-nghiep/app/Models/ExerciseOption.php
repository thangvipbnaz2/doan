<?php
namespace App\Models;

class ExerciseOption extends Model
{
    protected static string $table = 'exercise_options';
    protected array $fillable = ['exercise_id', 'option_text', 'option_label', 'is_correct', 'sort_order'];
    protected bool $timestamps = true;

    public function exercise(): ?Exercise
    {
        return Exercise::find($this->exercise_id);
    }
}
