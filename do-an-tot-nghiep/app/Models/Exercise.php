<?php
namespace App\Models;

class Exercise extends Model
{
    protected static string $table = 'exercises';
    protected array $fillable = ['lesson_id', 'grammar_id', 'vocab_id', 'title', 'instruction', 'type', 'difficulty', 'points', 'sort_order', 'is_active'];
    protected bool $timestamps = true;

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }

    public function grammar(): ?Grammar
    {
        return Grammar::find($this->grammar_id);
    }

    public function vocab(): ?Vocabulary
    {
        return Vocabulary::find($this->vocab_id);
    }

    public function options(): array
    {
        return ExerciseOption::findBy('exercise_id', $this->id);
    }

    public function answers(): array
    {
        return ExerciseAnswer::findBy('exercise_id', $this->id);
    }
}
