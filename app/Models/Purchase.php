<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'product_id',
        'purchase_no',
        'date',
        'description',
        'quantity',
        'unit_price',
        'total_price',
        'status',
        'created_by',
        'approve_by',
        'updated_at',
    ];

    public static function createPurchase($request)
    {
        $countProduct = count($request->product_id);
        for ($i = 0; $i < $countProduct; $i++) {
            Purchase::create([
                'supplier_id' => $request->supplier_id[$i],
                'category_id' => $request->category_id[$i],
                'product_id' => $request->product_id[$i],
                'purchase_no' => Purchase::max('purchase_no') + 1,
                'date' => date('Y-m-d', strtotime($request->date[$i])),
                'description' => $request->description[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->unit_price[$i],
                'total_price' => $request->total_price[$i],
                'created_by' => Auth::user()->id,
            ]);
        }
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function product()
    {
        return $this->belongsTo(product::class);
    }
    
    public function supplier()
    {
        return $this->belongsTo(supplier::class);
    }
}
