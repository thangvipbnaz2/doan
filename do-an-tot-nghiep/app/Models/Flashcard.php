<?php
namespace App\Models;

class Flashcard extends Model
{
    protected static string $table = 'flashcards';
    protected array $fillable = ['user_id', 'vocab_id', 'lesson_id', 'ease_factor', 'interval_days', 'interval_step', 'consecutive_correct', 'next_review_at', 'review_count', 'lapse_count', 'is_active'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function vocab(): ?Vocabulary
    {
        return Vocabulary::find($this->vocab_id);
    }

    public function reviews(): array
    {
        return FlashcardReview::findBy('flashcard_id', $this->id);
    }
}
