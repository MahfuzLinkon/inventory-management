<?php

namespace App\Models;

use App\helper\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'category_id',
        'name',
        'description',
        'image',
        'status',
        'created_by',
        'updated_by',
        'updated_at',
    ];

    public static function productUpdateOrCreate($request, $id = null){
        $product = Product::updateOrCreate(['id'=>$id], [
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => Helper::imageUploader($request->image, 'products', isset($id) ? Product::find($id)->image : null , 600, 600),
            'description' => $request->description,
            'created_by' => empty($id) ? Auth::user()->id : Product::find($id)->created_by,
            'updated_by' => isset($id) ? Auth::user()->id : null,
            'updated_at' => isset($id) ? Carbon::now() : null,
        ]);
        $productId = $product->id;
        return $productId;
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    // public function productSupplier(){
    //     return $this->belongsTo(ProductSupplier::class, 'product_id', 'id');
    // }


}
