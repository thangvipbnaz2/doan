<?php
namespace App\Models;

class ListeningQuestion extends Model
{
    protected static string $table = 'listening_questions';
    protected array $fillable = ['listening_id', 'question', 'options', 'correct_answer', 'explanation', 'type', 'points', 'sort_order'];
    protected bool $timestamps = true;

    public function listening(): ?Listening
    {
        return Listening::find($this->listening_id);
    }
}
