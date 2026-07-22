<?php
namespace App\Models;

class Enrollment extends Model
{
    protected static string $table = 'enrollments';
    protected array $fillable = ['user_id', 'course_id', 'order_id', 'progress', 'completed_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function course(): ?Course
    {
        return Course::find($this->course_id);
    }

    public function order(): ?Order
    {
        return Order::find($this->order_id);
    }
}
