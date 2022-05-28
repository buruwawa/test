<?php

namespace App\Http\Controllers;

use App\Models\setIndicator;
use Illuminate\Http\Request;

class SetIndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $metanames = setIndicator::UpdateOrCreate([
        // 'qns'=>request('question'),
        //   'user_id'=>auth()->id()
        // ]);





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setIndicator  $setIndicator
     * @return \Illuminate\Http\Response
     */
    public function show(setIndicator $setIndicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setIndicator  $setIndicator
     * @return \Illuminate\Http\Response
     */
    public function edit(setIndicator $setIndicator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setIndicator  $setIndicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, setIndicator $setIndicator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setIndicator  $setIndicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(setIndicator $setIndicator)
    {
        //
    }
}
