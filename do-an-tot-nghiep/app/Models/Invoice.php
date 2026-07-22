<?php
namespace App\Models;

class Invoice extends Model
{
    protected static string $table = 'invoices';
    protected array $fillable = ['invoice_number', 'order_id', 'company_name', 'tax_code', 'address', 'notes', 'email_sent_at'];
    protected bool $timestamps = true;

    public function order(): ?Order
    {
        return Order::find($this->order_id);
    }
}
