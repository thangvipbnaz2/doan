<?php
namespace App\Models;

class Exam extends Model
{
    protected static string $table = 'exam_templates';
    protected array $fillable = ['title', 'level', 'duration_minutes', 'total_questions', 'passing_score', 'description', 'is_active'];
    protected bool $timestamps = true;

    public function questions(): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM exam_questions WHERE exam_template_id = ? ORDER BY section, sort_order",
            [$this->id]
        );
    }

    public function getResults(int $userId): array
    {
        return \App\Helpers\Database::fetchAll(
            "SELECT * FROM exam_results WHERE exam_template_id = ? AND user_id = ? ORDER BY completed_at DESC",
            [$this->id, $userId]
        );
    }
}
