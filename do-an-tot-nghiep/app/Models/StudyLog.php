<?php
namespace App\Models;

class StudyLog extends Model
{
    protected static string $table = 'study_logs';
    protected array $fillable = ['user_id', 'activity_type', 'reference_id', 'reference_type', 'duration_seconds', 'score', 'details'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }
}
