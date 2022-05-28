<?php

namespace App\Http\Controllers;

use App\Models\site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $sites = site::where('status','Active')->get();
        return view('admin.settings.sites.site',compact('sites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  $sites = site::get();
  //dd($sites);
        return view('admin.settings.sites.site',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          //See if the site is Exists    
         $site=site::where('site_name',request('site_name'))
        ->where('id',request('id'))->first();

       if($site ==null)
       {      
        $sites = site::UpdateOrCreate(
                        [   'site_name'=>request('site_name')],
        [
        // 'site_name'=>request('site_name'),
        'site_category'=>request('site_category'),
        'site_rank'=>request('site_rank'),
        'room_no'=>request('room_no'),
        'location_name'=>request('location_name'),
         'phone'=>request('phone'),
          'email'=>request('email'),
                 'site_description'=>request('site_description'),
        'user_id'=>auth()->id()
        ]);

        $idf=$sites->id;
       }
      else
       {
        return redirect()->route('sites.index')->with('info','This Site Exists');
       }
//dd(request('attachment'));

        if(request('attachment')){
            $attach = request('attachment');
            foreach($attach as $attached){

                 // Get filename with extension
                 $fileNameWithExt = $attached->getClientOriginalName();
                 // Just Filename
                 $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                 // Get just Extension
                 $extension = $attached->getClientOriginalExtension();
                 //Filename to store
                 $imageToStore = $filename.'_'.time().'.'.$extension;
                 //upload the image
                 $path = $attached->storeAs('public/sites/', $imageToStore);
            
            
           $id = site::where('id', $idf)->first();
           
             if($id !=null)
             {
             $hotelUdate = site::where('id',$idf)
             ->update([
            'photo'=>$imageToStore
        ]);
           }else
           {
         site::UpdateOrCreate(
                [
                'photo'=>$imageToStore
                ]
                );
            }
            }
        }
        return redirect()->route('sites.index')->with('success','Site created successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(site $site,$id)
    {
          $sites = site::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Site deleted successfly');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $site = site::where('id',$id)->first();
        if($site){
            $site->delete();
             return redirect()->back()->with('success','Site permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this stock');
        }
    }


      public function recoveryUpdate(site $site,$id)
    {
          $site = site::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Site recoveried successfly');
    }


   public function recovery()
    {
       $sites = site::where('status','Inactive')->get();
        return view('admin.settings.recovery.recoverySite',compact('sites'));
    }
}
