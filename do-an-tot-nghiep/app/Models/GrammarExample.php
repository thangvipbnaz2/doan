<?php
namespace App\Models;

class GrammarExample extends Model
{
    protected static string $table = 'grammar_examples';
    protected array $fillable = ['grammar_id', 'example_cn', 'example_pinyin', 'example_vi', 'audio_url', 'sort_order'];
    protected bool $timestamps = true;

    public function grammar(): ?Grammar
    {
        return Grammar::find($this->grammar_id);
    }
}
