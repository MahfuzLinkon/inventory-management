<?php

use App\Http\Controllers\admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pop\CategoryController;
use App\Http\Controllers\pop\CustomerController;
use App\Http\Controllers\pop\InvoiceController;
use App\Http\Controllers\pop\ProductController;
use App\Http\Controllers\pop\PurchaseController;
use App\Http\Controllers\pop\StockController;
use App\Http\Controllers\pop\UnitController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [AdminProfileController::class, 'profile'])->name('admin.profile');
    });
    //supplier all route
    Route::resource('suppliers', SupplierController::class)->except(['store', 'update']);
    Route::post('/suppliers/update-insert/{id?}', [SupplierController::class, 'updateOrInsert'])->name('suppliers.update-insert');
    Route::get('/suppliers/status/{id}', [SupplierController::class, 'supplierStatus'])->name('suppliers.status');
    // Customer all route
    Route::resource('customers', CustomerController::class)->except(['store', 'update']);
    Route::post('/customers/update-insert/{id?}', [CustomerController::class, 'updateOrInsert'])->name('customers.update-insert');
    Route::get('/customers/status/{id}', [CustomerController::class, 'customerStatus'])->name('customers.status');
    Route::get('/customer/credit', [CustomerController::class, 'customerCredit'])->name('customer.credit');
    Route::get('/customer/paid', [CustomerController::class, 'customerPaid'])->name('customer.paid');
    Route::get('/customer/credit/pdf', [CustomerController::class, 'customerCreditPdf'])->name('customer.credit-pdf');
    Route::get('/customer/payment/{invoice_id}', [CustomerController::class, 'customerPayment'])->name('customer.payment');
    Route::post('/customer/payment/store/{invoice_id}', [CustomerController::class, 'customerPaymentStore'])->name('customer.payment-store');
    Route::get('/customer/payment/summary/{invoice_id}', [CustomerController::class, 'customerPaymentSummary'])->name('customer.payment-summary');



    // Units all route
    Route::resource('units', UnitController::class);
    Route::get('/units/status/{id}', [UnitController::class, 'unitsStatus'])->name('units.status');
    // Category all route
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/status/{id}', [CategoryController::class, 'categoriesStatus'])->name('categories.status');
    // Product all route
    Route::resource('products', ProductController::class);
    Route::get('/products/status/{id}', [ProductController::class, 'productsStatus'])->name('products.status');
    //Purchase All Route
    Route::resource('purchases', PurchaseController::class);
    Route::post('/get-supplier-wise/category', [PurchaseController::class, 'getCategory'])->name('get.category');
    Route::post('/get-category-wise/product', [PurchaseController::class, 'getProduct'])->name('get.product');
    Route::get('/purchase/pending', [PurchaseController::class, 'purchasePending'])->name('purchases.pending');
    // Route::get('/purchase/approved', [PurchaseController::class, 'purchaseApproved'])->name('purchases.approved');
    Route::get('/purchase/status/{id}', [PurchaseController::class, 'purchaseStatus'])->name('purchase.status');
    Route::get('/purchase/report', [PurchaseController::class, 'purchaseReport'])->name('purchase.report');
    Route::get('/purchase/report-generate', [PurchaseController::class, 'purchaseReportGenerate'])->name('purchase.report-generate');
    //invoice all route
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/get-product/quantity', [InvoiceController::class, 'getProductQuantity'])->name('get-product.quantity');
    Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/pending', [InvoiceController::class, 'invoicePending'])->name('invoice.pending');
    Route::delete('/invoice/destroy/{id}', [InvoiceController::class, 'invoiceDestroy'])->name('invoice.destroy');
    Route::get('/invoice/details/{id}', [InvoiceController::class, 'invoiceDetails'])->name('invoice.details');
    Route::post('/invoice/approve/{id}', [InvoiceController::class, 'invoiceApprove'])->name('invoice.approve');
    Route::get('/invoice/daily', [InvoiceController::class, 'invoiceDaily'])->name('invoice.daily');
    Route::post('/invoice/daily-search', [InvoiceController::class, 'invoiceDailySearch'])->name('invoice.daily-search');
    // Manage stock
    Route::get('/manage/stock', [StockController::class, 'manageStock'])->name('manage.stock');
    Route::get('/search/stock', [StockController::class, 'searchStock'])->name('search.stock');
    Route::get('/search/stock-supplier', [StockController::class, 'searchStockSupplier'])->name('search.stock-supplier');
    Route::get('/search/get-product-id', [StockController::class, 'getSearchProduct'])->name('search.get-product');
    Route::get('/search/stock-product', [StockController::class, 'searchStockProduct'])->name('search.stock-product');
});








// default profile route
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
