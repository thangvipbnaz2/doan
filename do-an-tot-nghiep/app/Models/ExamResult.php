<?php
namespace App\Models;

class ExamResult extends Model
{
    protected static string $table = 'exam_results';
    protected array $fillable = ['user_id', 'exam_id', 'score', 'total_points', 'percentage', 'is_passed', 'answers', 'section_scores', 'time_spent_seconds', 'attempt_number', 'started_at', 'completed_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function exam(): ?Exam
    {
        return Exam::find($this->exam_id);
    }
}
