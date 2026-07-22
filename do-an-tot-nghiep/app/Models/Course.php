<?php
namespace App\Models;

class Course extends Model
{
    protected static string $table = 'courses';
    protected array $fillable = ['title', 'slug', 'short_description', 'description', 'price', 'sale_price', 'thumbnail', 'hsk_level_id', 'duration_hours', 'difficulty', 'is_published', 'is_free', 'is_featured', 'total_lessons', 'total_vocab', 'total_students', 'average_rating', 'sort_order', 'meta_title', 'meta_description'];
    protected bool $timestamps = true;

    public function lessons(): array
    {
        return Lesson::findBy('course_id', $this->id);
    }

    public function enrollments(): array
    {
        return Enrollment::findBy('course_id', $this->id);
    }

    public function orders(): array
    {
        return Order::findBy('course_id', $this->id);
    }

    public function hskLevel(): ?HskLevel
    {
        return HskLevel::find($this->hsk_level_id);
    }
}
