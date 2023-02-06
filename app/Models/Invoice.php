<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id', 'invoice_id');
    }
    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
    // public function payment_details()
    // {
    //     return $this->belongsTo(PaymentDetail::class, 'id', 'invoice_id');
    // }
    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }
}
