<?php
namespace App\Models;

class Lesson extends Model
{
    protected static string $table = 'lessons';
    protected array $fillable = ['course_id', 'hsk_level', 'lesson_num', 'title', 'description', 'objectives', 'topic', 'duration_minutes', 'difficulty', 'thumbnail', 'is_free', 'status', 'sort_order'];
    protected bool $timestamps = true;

    public function vocab(): array
    {
        return Vocabulary::findBy('lesson_id', $this->id);
    }

    public function grammar(): array
    {
        return Grammar::findBy('lesson_id', $this->id);
    }

    public function dialogues(): array
    {
        return Dialogue::findBy('lesson_id', $this->id);
    }

    public function reading(): ?Reading
    {
        return Reading::findOneBy('lesson_id', $this->id);
    }

    public function listening(): ?Listening
    {
        return Listening::findOneBy('lesson_id', $this->id);
    }

    public function exercises(): array
    {
        return Exercise::findBy('lesson_id', $this->id);
    }

    public function course(): ?Course
    {
        return Course::find($this->course_id);
    }

    public function hskLevel(): ?HskLevel
    {
        return HskLevel::findOneBy('level', $this->hsk_level);
    }

    public function getNext(): ?static
    {
        $table = self::getTable();
        $data = \App\Helpers\Database::fetch(
            "SELECT * FROM {$table} WHERE hsk_level = ? AND lesson_num > ? ORDER BY lesson_num ASC LIMIT 1",
            [$this->hsk_level, $this->lesson_num]
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
            "SELECT * FROM {$table} WHERE hsk_level = ? AND lesson_num < ? ORDER BY lesson_num DESC LIMIT 1",
            [$this->hsk_level, $this->lesson_num]
        );
        if (!$data) return null;
        $model = new static();
        foreach ($data as $key => $val) $model->$key = $val;
        return $model;
    }

    public function progress(int $userId): ?array
    {
        return \App\Helpers\Database::fetch(
            "SELECT * FROM lesson_progress WHERE user_id = ? AND lesson_id = ?",
            [$userId, $this->id]
        );
    }
}
