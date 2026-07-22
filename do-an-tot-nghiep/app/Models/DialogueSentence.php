<?php
namespace App\Models;

class DialogueSentence extends Model
{
    protected static string $table = 'dialogue_sentences';
    protected array $fillable = ['dialogue_id', 'speaker', 'speaker_avatar', 'chinese', 'pinyin', 'vietnamese', 'audio_url', 'sort_order'];
    protected bool $timestamps = true;

    public function dialogue(): ?Dialogue
    {
        return Dialogue::find($this->dialogue_id);
    }
}
