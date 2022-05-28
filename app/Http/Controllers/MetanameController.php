<?php

namespace App\Http\Controllers;


use App\Models\metaname;
use App\Models\metadata;
use App\Models\metanameDatatype;
use Illuminate\Http\Request;
use DB;

class MetanameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $metanames = metaname::where('status','Active')->get(); 
         $metadatas = metadata::get();
    
        return view('admin.settings.metanames.metaname',compact('metanames','metadatas'));
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
         $property='property_';
         $metadatas = request('metadata_name');


   //$myvalue = 'Test me more';
//$arr = explode(' ',trim($myvalue));
//dd($arr[0]);

//$value = "Testnn     me more";
//echo strtok($value, " "); // Test

//dd(strtok($value, " "));

        $metanames = metaname::UpdateOrCreate([
        'metaname_name'=>request('metaname_name'),
        'metaname_description'=>request('metaname_description'),
         'status'=>'Active',
          'user_id'=>auth()->id()
        ]);
        

           if($metadatas !=null)
     {
        
foreach ($metadatas as $metadata) {
  $data = metadata::where('id', $metadata)->first(); 

  $datatype=strtok($data->metadata_name, " ");
 $datatype_name=$property.$datatype;
//dd($datatype_name);

        $insetMetadata = metanameDatatype::create([
        'metaname_id'=>$metanames->id,
         'metadata_name'=>$data->metadata_name,
          'datatype'=>$data->datatype,
            'datatype'=>$data->datatype,
              'datatype_name'=>$datatype_name,
          'status'=>'Active',
          'user_id'=>auth()->id()        
        ]);
        } 
     }
     return redirect()->back()->with('success','Metaname created successfly');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(metaname $property)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(metaname $property,$id)
    {
          $metanames = metaname::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
               return redirect()->back()->with('success','Metaname deleted successfly');
            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
              $metaname = metaname::where('id',$id)->first();
        if($metaname){
           $metaname->update([
            'metaname_name'=>request('metaname_name'),
             'metaname_description'=>request('metaname_description'),
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
     * @param  \App\Models\property  $property
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
     //
        $metanameDatatype = metanameDatatype::where('metaname_id',$id)->first();
        $Metaname = metaname::where('id',$id)->first();
        if($Metaname){
            $Metaname->delete();
          
              DB::statement("delete from metaname_datatypes where metaname_id=$id");


            return redirect()->back()->with('success','Metaname permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Metaname');
        }
    }

  public function recoveryUpdate(metaname $department,$id)
    {
          $departments = metaname::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Metaname recoveried successfly');
    }


   public function recovery()
    {
       $metanames = metaname::where('status','Inactive')->get();
         // $datatypes = datatype::get();
        return view('admin.settings.recovery.recoveryMetaname',compact('metanames'));
    }
}
