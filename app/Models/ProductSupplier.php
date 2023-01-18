<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'supplier_id',
    ];

    public static function productSupplierUpdateOrCreate($request, $productId, $id =null){
        $suppliers = $request->supplier_id;
        foreach($suppliers as $supplier){
            ProductSupplier::updateOrCreate(['id'=> $id], [
                'supplier_id' => $supplier,
                'product_id' => $productId,
            ]);
        }
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }




}
