<?php
namespace App\Models;

class Lesson extends Model
{
    protected static string $table = 'lessons';
    protected array $fillable = ['level', 'lesson_num', 'title', 'description', 'objectives', 'is_free', 'status'];
    protected bool $timestamps = true;

    public function vocab(): array
    {
        return Vocab::findBy('lesson_id', $this->id);
    }

    public function grammar(): array
    {
        return Grammar::findBy('lesson_id', $this->id);
    }

    public function dialogues(): array
    {
        return Dialogue::findBy('lesson_id', $this->id);
    }

    public function reading(): ?\App\Models\Reading
    {
        return Reading::findOneBy('lesson_id', $this->id);
    }

    public function listening(): ?\App\Models\Listening
    {
        return Listening::findOneBy('lesson_id', $this->id);
    }

    public function speaking(): array
    {
        return Speaking::findBy('lesson_id', $this->id);
    }

    public function writing(): array
    {
        return Writing::findBy('lesson_id', $this->id);
    }

    public static function findByLevel(int $level): array
    {
        return self::findBy('level', $level);
    }

    public function getNext(): ?static
    {
        $table = self::getTable();
        $data = \App\Helpers\Database::fetch(
            "SELECT * FROM {$table} WHERE level = ? AND lesson_num > ? ORDER BY lesson_num ASC LIMIT 1",
            [$this->level, $this->lesson_num]
        );
        if (!$data) return null;
        $model = new static();
        foreach ($data as $key => $val) $model->$key = $val;
        return $model;
    }

    public function getPrev(): ?static
    {
        $table = self::getTable();
        $data = \App\Helpers\Database::fetch(
            "SELECT * FROM {$table} WHERE level = ? AND lesson_num < ? ORDER BY lesson_num DESC LIMIT 1",
            [$this->level, $this->lesson_num]
        );
        if (!$data) return null;
        $model = new static();
        foreach ($data as $key => $val) $model->$key = $val;
        return $model;
    }
}
