<?php

namespace App\Http\Controllers;

use App\Models\department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $departments = department::where('status','Active')->get();
        return view('admin.settings.departments.department',compact('departments'));
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
           $stock = department::create(
            [
                'department_name'=>request('department_name'),
                'unit_name'=>request('unit_name'),
                 'status'=>'Active',
                'user_id'=>auth()->id()
            ]
            );
            return redirect()->back()->with('success','stock created successfly');
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
    public function edit(department $department,$id)
    {
          $departments = department::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Department deleted successfly');
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
            $department = department::where('id',$id)->first();
        if($department){
           $department->update([
            'department_name'=>request('department_name'),
             'unit_name'=>request('unit_name'),
             'user_id'=>auth()->id()
           ]);
           return redirect()->back()->with('success','Department updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Department');
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
        $department = department::where('id',$id)->first();
        if($department){
            $department->delete();
            return redirect()->back()->with('success','Department permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this Department');
        }
    }

  public function recoveryUpdate(department $department,$id)
    {
          $departments = department::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','Department recoveried successfly');
    }


   public function recovery()
    {
       $departments = department::where('status','Inactive')->get();
        return view('admin.settings.recovery.recoveryDepartment',compact('departments'));
    }
}
