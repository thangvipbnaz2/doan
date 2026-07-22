<?php
namespace App\Models;

class Payment extends Model
{
    protected static string $table = 'payments';
    protected array $fillable = ['order_id', 'provider', 'provider_transaction_id', 'amount', 'fee', 'status', 'payment_details', 'confirmed_by', 'confirmed_at'];
    protected bool $timestamps = true;

    public function order(): ?Order
    {
        return Order::find($this->order_id);
    }

    public function confirmedBy(): ?User
    {
        return User::find($this->confirmed_by);
    }
}
