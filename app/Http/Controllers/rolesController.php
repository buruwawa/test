<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;

class rolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = role::where('status','Active')->get();
        return view('admin.settings.roles.roles',compact('roles'));
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
           $stock = role::create(
            [
                'name'=>request('role'),
                'guard_name'=>'web',
                 'status'=>'Active',
                  'user_id'=>auth()->id()
            ]);          
            return redirect()->back()->with('success','Role Registered successfly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(role $role,$id)
    {
          $roles = role::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Role deleted successfly');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
            $role = role::where('id',$id)->first();
        if($role){
           $role->update([
            'name'=>request('role')
           ]);
           return redirect()->back()->with('success','Role updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Role');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */



    public function destroy($id)
    {
     //
        $role = role::where('id',$id)->first();
        if($role){
            $role->delete();
            return redirect()->back()->with('success','Role permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Role');
        }
    }

  public function recoveryUpdate(role $role,$id)
    {
          $roles = role::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Role recoveried successfly');
    }


   public function recovery()
    {
       $roles = role::where('status','Inactive')->get();
        return view('admin.settings.recovery.recoveryRole',compact('roles'));
    }
}
