<?php
namespace App\Models;

class Order extends Model
{
    protected static string $table = 'orders';
    protected array $fillable = ['order_code', 'user_id', 'course_id', 'amount', 'discount', 'total', 'status', 'payment_method', 'transaction_id', 'fullname', 'email', 'phone', 'address', 'notes', 'expires_at', 'paid_at'];
    protected bool $timestamps = true;

    public function user(): ?User
    {
        return User::find($this->user_id);
    }

    public function course(): ?Course
    {
        return Course::find($this->course_id);
    }

    public function payment(): ?Payment
    {
        return Payment::findOneBy('order_id', $this->id);
    }

    public function invoice(): ?Invoice
    {
        return Invoice::findOneBy('order_id', $this->id);
    }
}
