<?php

namespace App\Http\Controllers\pop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductSupplier;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pop.product.index', [
            'products' => Product::latest()->get(),
            'suppliers' => ProductSupplier::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pop.product.create', [
            'categories' => Category::where('status', 1)->orderBy('name', 'ASC')->get(),
            'units' => Unit::where('status', 1)->orderBy('name', 'ASC')->get(),
            'suppliers' => Supplier::where('status', 1)->orderBy('name', 'ASC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ], [
            'unit_id.required' => 'Product unit is required.',
            'category_id.required' => 'Product category is required.',
            'supplier_id.required' => 'Product Supplier is required.',
        ]);

        $productId = Product::productUpdateOrCreate($request);
        ProductSupplier::productSupplierUpdateOrCreate($request, $productId);
        return redirect()->back()->with('success', 'Product added successfully');
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
        return view('pop.product.edit', [
            'product' => Product::where('id', $id)->first(),
            'categories' => Category::where('status', 1)->orderBy('name', 'ASC')->get(),
            'units' => Unit::where('status', 1)->orderBy('name', 'ASC')->get(),
            'suppliers' => Supplier::where('status', 1)->orderBy('name', 'ASC')->get(),
            'productSuppliers' => ProductSupplier::where('product_id', $id)->get(),
        ]);
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
        Product::productUpdateOrCreate($request, $id);

        ProductSupplier::where('product_id', $id)->delete();
        ProductSupplier::productSupplierUpdateOrCreate($request, $id);
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id', $id)->delete();
        ProductSupplier::where('product_id', $id)->delete();
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function productsStatus($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product->status == 1) {
            $product->status = 0;
            $message = 'Product Deactivate Successfully';
        } else {
            $product->status = 1;
            $message = 'Product Activate Successfully';
        }
        $product->save();
        return redirect()->back()->with('success', $message);
    }
}
