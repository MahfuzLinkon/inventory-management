<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile(){
        return view('admin.profile.profile', [
            'profile' => DB::table('users')->where('id', '=', Auth::user()->id)->first(),
        ]);
    }
}
