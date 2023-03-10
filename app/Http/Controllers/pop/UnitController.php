<?php

namespace App\Http\Controllers\pop;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pop.unit.index', [
            'units' => Unit::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pop.unit.create');
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
            'name' => 'required'
        ]);
        Unit::unitUpdateOrCreate($request);
        return redirect()->back()->with('success', 'New Unit Created');
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
        return view('pop.unit.edit', [
            'unit' => Unit::where('id', $id)->first(),
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
        $this->validate($request, [
            'name' => 'required'
        ]);
        Unit::unitUpdateOrCreate($request, $id);
        return redirect()->route('units.index')->with('success', 'Unit Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unit::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Unit Deleted Successfully');
    }

    public function unitsStatus($id){
        $unit = Unit::where('id', $id)->first();
        if($unit->status == 1){
            $unit->status = 0;
            $message = 'Unit Status Deactivate Successfully';
        }else{
            $unit->status = 1;
            $message = 'Unit Status Activate Successfully'; 
        }
        $unit->save();
        return redirect()->back()->with('success', $message);
    }

}
