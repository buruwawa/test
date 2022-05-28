<?php

namespace App\Http\Controllers;

use App\Models\stock;
use Illuminate\Http\Request;

class stockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = stock::get();
        return view('admin.settings.stocks.stock',compact('stocks'));
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
        $stock = stock::create(
            [
                'item'=>request('item'),
                'unit'=>request('unit'),
                'material_code'=>request('material_code'),
                'price'=>request('price'),
                'selling_price'=>request('selling_price'),
                'stock_alert'=>request('stock_alert'),
                'vat'=>request('vat'),
                'descriptions'=>request('descriptions'),
                'user_id'=>auth()->id()
            ]
            );
            return redirect()->back()->with('success','stock created successfly');
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
        $stock = stock::where('id',$id)->first();
        if($stock){
           $stock->update([
            'item'=>request('item'),
            'unit'=>request('unit'),
            'material_code'=>request('material_code'),
            'price'=>request('price'),
            'selling_price'=>request('selling_price'),
            'vat'=>request('vat'),
            'stock_alert'=>request('stock_alert'),
            'descriptions'=>request('descriptions')
           ]);
           return redirect()->back()->with('success','Stock updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this stock');
        }
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
        $stock = stock::where('id',$id)->first();
        if($stock){
            $stock->delete();
            return redirect()->back()->with('success','Stock updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this stock');
        }
    }
}
