<?php
namespace App\Models;

class ExerciseAnswer extends Model
{
    protected static string $table = 'exercise_answers';
    protected array $fillable = ['user_id', 'exercise_id', 'selected_option_id', 'answer_text', 'is_correct', 'score', 'time_spent_seconds'];
    protected bool $timestamps = true;

    public function exercise(): ?Exercise
    {
        return Exercise::find($this->exercise_id);
    }

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function selectedOption(): ?ExerciseOption
    {
        return ExerciseOption::find($this->selected_option_id);
    }
}
