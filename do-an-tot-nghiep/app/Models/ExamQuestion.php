<?php
namespace App\Models;

class ExamQuestion extends Model
{
    protected static string $table = 'exam_questions';
    protected array $fillable = ['exam_id', 'section', 'question_number', 'question', 'question_type', 'options', 'correct_answer', 'explanation', 'audio_url', 'image_url', 'points', 'sort_order'];
    protected bool $timestamps = true;

    public function exam(): ?Exam
    {
        return Exam::find($this->exam_id);
    }
}
