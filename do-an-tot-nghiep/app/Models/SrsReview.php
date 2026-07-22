<?php
namespace App\Models;

class SrsReview extends Model
{
    protected static string $table = 'srs_reviews';
    protected array $fillable = ['user_id', 'vocab_id', 'review_type', 'quality', 'ease_factor', 'interval_days', 'response_time_ms'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function vocab(): ?Vocabulary
    {
        return Vocabulary::find($this->vocab_id);
    }
}
