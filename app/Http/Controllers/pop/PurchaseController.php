<?php

namespace App\Http\Controllers\pop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pop.purchase.index', [
            'purchases' => Purchase::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pop.purchase.create', [
            'suppliers' => Supplier::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }

    // Ajax action
    public function getCategory(Request $request)
    {
        $supplierId = $request->supplier_id;
        // dd($supplierId);
        // $productId = ProductSupplier::select('product_id')->where('supplier_id', $supplierId)->groupBy('product_id')->get();
        // $categories = Product::with(['category'])->select('category_id')->where('id', $productId)->get();
        // dd($categories);
        $categories = DB::table('products')
            ->join('product_suppliers', 'products.id', '=', 'product_suppliers.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.*')
            ->where('supplier_id', '=', $supplierId)
            ->get();
        return response()->json($categories);
    }

    public function getProduct(Request $request)
    {
        $categoryId = $request->category_id;
        $products = DB::table('products')
            ->where('category_id', '=', $categoryId)
            ->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}