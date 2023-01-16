<?php

use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('admin')->group(function(){
        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
    });
    //supplier all route
    Route::resource('suppliers', SupplierController::class)->except(['store', 'update']);
    Route::post('/suppliers/update-insert/{id?}', [SupplierController::class, 'updateOrInsert'])->name('suppliers.update-insert');
    Route::get('/suppliers/status/{id}', [SupplierController::class, 'supplierStatus'])->name('suppliers.status');
});


 // default profile route 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
