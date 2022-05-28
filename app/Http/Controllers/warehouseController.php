<?php

namespace App\Http\Controllers;

use App\Models\myPayment;
use App\Models\stocking;
use App\Models\subStore;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class warehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $warehouses = warehouse::where('main_warehouse',1)->get();
        return view('admin.settings.warehouse.warehouse',compact('warehouses'));
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shops()
    {
        //
        $limitation = myPayment::latest()->first();
        $warehouses = warehouse::where('main_warehouse','!=',1)->get();
        return view('admin.settings.warehouse.shops',compact('warehouses','limitation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
        'warehouse'=>'required',
        'location'=>'required',
        'descriptions'=>'nullable|string'
        ]);

        $store = warehouse::create(
            [
        'warehouse'=>$request->input('warehouse'),
        'location'=>$request->input('location'),
        'descriptions'=>empty($request->input('descriptions')) ? 'null': $request->input('descriptions'),
        'user_id'=>auth()->id() ] );
            // Create permission
        $permission = Permission::create(['name' => request('warehouse')]);


        return redirect()->back()->with('success','Warehouse created successfuly');
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
        if(request('asign_warehouse')){
        $warehouses = warehouse::where('id',request('warehouse_id'))->update([
            'main_warehouse'=>1
        ]);
        return redirect()->back()->with('success','Assigned successfully');
    }
    if(request('remove_id')){
        $warehouses = warehouse::where('id',request('remove_id'))->update([
            'main_warehouse'=>0
        ]);
        return redirect()->back()->with('success','Unsigned  successfully');
    }
    if(request('warehouse')){
        $update = warehouse::where('id',$id)->update([
            'location'=>request('location'),
            'descriptions'=>request('descriptions'),
            'main_warehouse'=>request('main_warehouse')
        ]);
        return redirect()->back()->with('success','Warehouse edited successfully');
    }
    return redirect()->back()->with('error','Can not Assign ');
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
        $destory = warehouse::where('id',$id)->first();
        $stocking = subStore::where('warehouse',$id)->latest()->first();
        if($stocking){
        if($destory->main_warehouse == 0 && $stocking->current_qty == 0){
            $destory->delete();
            return redirect()->back()->with('success','Warehouse deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Can not delete this warehouse, Its either the warehouse is a main warehouse or has stock');
        }
    }
    else{
        $destory->delete();
        return redirect()->back()->with('success','Warehouse deleted successfully');
    }
    }
}
