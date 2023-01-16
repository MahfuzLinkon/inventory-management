<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by',
    ];


    public static function unitUpdateOrCreate($request, $id = null){
        Unit::updateOrCreate(['id'=> $id],[
            'name' => $request->name,
            'created_by' => empty($id) ? Auth::user()->id : Unit::find($id)->created_by,
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
