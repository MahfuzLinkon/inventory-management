<?php

namespace App\Http\Controllers\pop;

use App\helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pop.customer.manage', [
            'customers' => Customer::latest()->get(),
            // 'customers' => DB::table('customers')->orderBy('id', 'DESC')
            // ->join('users', 'users.id', '=', 'customers.created_by')
            // ->select('customers.*', 'users.name as created_by')
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
        return view('pop.customer.create');
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
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $customer = DB::table('customers')->updateOrInsert(['id'=>$id], [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'image' => Helper::imageUploader($request->image, 'customers', isset($id) ? DB::table('customers')->find($id)->image : null, 600, 600),
            'description' => $request->description,
            'created_by' => empty($id) ? Auth::user()->id : DB::table('customers')->find($id)->created_by,
            'updated_by' => isset($id) ? Auth::user()->id : null,
            'created_at' => Carbon::now(),
            'updated_at' => isset($id) ? Carbon::now() : null,

        ]);
        if(isset($id)){
            return redirect()->route('customers.index')->with('success', 'Customer Info Updated Successfully');
        }else{
            return redirect()->back()->with('success', 'New Customer Added Successfully');
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
        return view('pop.customer.edit',[
        'customer' => DB::table('customers')->where('id', $id)->first(),
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
        DB::table('customers')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Customer Deleted Successfully');
    }

    public function customerStatus($id){
        $customer = DB::table('customers')->where('id', $id)->first();
        if($customer->status == 1){
            DB::table('customers')->where('id', $id)->update(['status' => 0]);
            $message = 'Customer Deactivate successfully';
        }elseif($customer->status == 0){
            DB::table('customers')->where('id', $id)->update(['status' => 1]);
            $message = 'Customer Activate successfully';
        }
        return redirect()->back()->with('success', $message);
    }


}
