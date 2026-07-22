<?php
namespace App\Models;

class FlashcardReview extends Model
{
    protected static string $table = 'flashcard_reviews';
    protected array $fillable = ['flashcard_id', 'quality', 'response_time_ms'];
    protected bool $timestamps = true;

    public function flashcard(): ?Flashcard
    {
        return Flashcard::find($this->flashcard_id);
    }
}
