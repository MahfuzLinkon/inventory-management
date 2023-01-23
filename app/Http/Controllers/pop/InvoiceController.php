<?php

namespace App\Http\Controllers\pop;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('pop.invoice.index');
    }
    public function create()
    {
        return view('pop.invoice.create', [
            'categories' => Category::where('status', 1)->orderBy('name', 'ASC')->get(),
            'date' => date('Y-m-d'),
            'customers' => Customer::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }

    public function getProductQuantity(Request $request)
    {
        $productId = $request->product_id;
        $stock = Product::where('id', $productId)->first();
        return response()->json($stock);
    }
}
