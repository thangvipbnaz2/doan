<?php
namespace App\Models;

class Exam extends Model
{
    protected static string $table = 'exams';
    protected array $fillable = ['title', 'description', 'hsk_level', 'lesson_id', 'duration_minutes', 'total_questions', 'total_points', 'passing_score', 'type', 'is_random', 'is_active', 'attempts_allowed', 'sort_order'];
    protected bool $timestamps = true;

    public function questions(): array
    {
        return ExamQuestion::findBy('exam_id', $this->id);
    }

    public function results(): array
    {
        return ExamResult::findBy('exam_id', $this->id);
    }

    public function hskLevel(): ?HskLevel
    {
        return HskLevel::findOneBy('level', $this->hsk_level);
    }

    public function lesson(): ?Lesson
    {
        return Lesson::find($this->lesson_id);
    }
}
