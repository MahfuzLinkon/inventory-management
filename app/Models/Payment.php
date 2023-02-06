<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'invoice_id');
    }
    public function payment_details()
    {
        return $this->hasMany(PaymentDetail::class, 'invoice_id', 'invoice_id');
    }
}
