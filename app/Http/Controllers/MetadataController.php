<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use App\Models\datatype;
use Illuminate\Http\Request;

class MetadataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $metadatas = metadata::where('status','Active')
          ->orWhere('status','Stop')
          ->get();
          $datatypes = datatype::get();
    
        return view('admin.settings.metadata.metadata',compact('metadatas','datatypes'));
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
              $stock = metadata::create(
            [
                'metadata_name'=>request('metadata_name'),
                'datatype'=>request('datatype'),
                'status'=>'Active',
                'user_id'=>auth()->id()
            ]
            );
            return redirect()->back()->with('success','Metadata created successfly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function show(metadata $metadata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function edit(metadata $metadata,$id)
    {
         $metadatas = metadata::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Metadata deleted successfly');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    $metadata = metadata::where('id',$id)->first();
        if($metadata){
           $metadata->update([
            'metadata_name'=>request('metadata_name'),
             'datatype'=>request('datatype'),
             'user_id'=>auth()->id()
           ]);
           return redirect()->back()->with('success','Metadata updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Metadata');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\metadata  $metadata
     * @return \Illuminate\Http\Response
     */
   
    public function destroy($id)
    {
     //
        $metadata = metadata::where('id',$id)->first();
        if($metadata){
            $metadata->delete();
            return redirect()->back()->with('success','Metadata permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Metadata');
        }
    }

  public function recoveryUpdate(metadata $department,$id)
    {
          $departments = metadata::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Metadata recoveried successfly');
    }


   public function recovery()
    {
       $metadatas = metadata::where('status','Inactive')->get();
          $datatypes = datatype::get();
        return view('admin.settings.recovery.recoveryMetadata',compact('metadatas','datatypes'));
    }
}
