<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        return view('admin.supplier.manage', [
            'suppliers' => Supplier::latest()->get(),

            // 'suppliers' => DB::table('suppliers')->orderBy('id', 'DESC')
            // ->join('users', 'suppliers.created_by', '=', 'users.id')
            // ->select('suppliers.*', 'users.name as created_by')
            // ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    public function updateOrInsert(Request $request, $id = null){
        DB::table('suppliers')
            ->updateOrInsert(['id' => $id], [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'created_by' => empty($id) ? Auth::user()->id : DB::table('suppliers')->find($id)->created_by,
                'updated_by' => isset($id) ? Auth::user()->id : null,
                "created_at" =>  Carbon::now(), 
                "updated_at" => isset($id) ? Carbon::now() : null,  
            ]);
            if(empty($id)){
                return redirect()->back()->with('success', 'Supplier Added Successfully');
                
            }else{
                return redirect()->route('suppliers.index')->with('success', 'Supplier Updated Successfully');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.supplier.edit', [
            'supplier' => DB::table('suppliers')->where('id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Supplier Deleted Successfully');
    }

    public function supplierStatus($id){
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        if($supplier->status == 1){
            DB::table('suppliers')->where('id', $id)->update(['status' => 0]);
            $message = 'Supplier Deactivate successfully';
        }elseif($supplier->status == 0){
            DB::table('suppliers')->where('id', $id)->update(['status' => 1]);
            $message = 'Supplier Activate successfully';
        }
        return redirect()->back()->with('success', $message);
    }


}
