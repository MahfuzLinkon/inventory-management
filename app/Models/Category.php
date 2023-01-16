<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
    ];

    public static function categoryUpdateOrCreate($request, $id = null){
        Category::updateOrCreate(['id'=>$id], [
            'name' => $request->name,
            'created_by' => empty($id) ? Auth::user()->id : Category::find($id)->created_by,
            'updated_by' => isset($id) ? Auth::user()->id : null,
            'updated_at' => isset($id) ? Carbon::now() : null,
        ]);
    }



    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }
    
}
