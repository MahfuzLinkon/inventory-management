<?php

namespace App\Http\Controllers\pop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function manageStock()
    {
        // $products = Product::with('product_supplier')->where('status', 1)->orderBy('name', 'ASC')->get();
        // return $products;
        return view('pop.stock.manage-stock', [
            'products' => Product::with('product_supplier')->where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }
    public function searchStock()
    {
        return view('pop.stock.search-stock', [
            'suppliers' => Supplier::where('status', 1)->orderBy('name', 'ASC')->get(),
            'products' => Product::where('status', 1)->orderBy('name', 'ASC')->get(),
            'categories' => Category::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }
    public function searchStockSupplier(Request $request)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
        ]);
        $supplierId = $request->supplier_id;
        return view('pop.pdf.supplier-wise-product', [
            'suppliers' => ProductSupplier::with('products')->where('supplier_id', $supplierId)->get(),
        ]);
    }
    public function getSearchProduct(Request $request)
    {
        $categoryId = $request->category_id;
        $products = Product::where('status', 1)->where('category_id', $categoryId)->orderBy('name', 'ASC')->get();
        return response()->json($products);
    }
    public function searchStockProduct(Request $request)
    {
        $productId = $request->product_id;

        return view('pop.pdf.product-stock-report', [
            'product' => Product::where('id', $productId)->first(),
        ]);
    }
}
