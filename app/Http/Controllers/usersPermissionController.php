<?php

namespace App\Http\Controllers;

use App\Models\myCompany;
use App\Models\myPayment;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class usersPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datas= User::get();
     // dd($datas);

        $user = User::join('model_has_roles','users.id','model_has_roles.model_id')
        ->join('roles','model_has_roles.role_id','roles.id')
        ->select('roles.name as role_name','model_has_roles.model_id as model_id','users.*')
        ->get();



        $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->get();
        $permit = Permission::get();
        $roles = Role::get();
        $limitation = myPayment::latest()->first();

        return view('admin.settings.users.users',compact('datas','user','permissions','permit','roles','limitation'));
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

        $user_id = User::where('id',request('users_id'))->first();
        $user_id->assignRole(request('roles'));
        return redirect()->back()->with('success','Role added successfly');

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

        $datas = User::where('id',$id)->first();
        $roles= Role::get();
        // $myroles = $datas->getRoleNames();
        return view('admin.settings.users.edit',compact('datas','id','roles'));
    }
/**
 * Remove roles to the user
 */

        public function roleremove($id,$role)
        {
            $user = User::where('id',$id)->first();
            $user->removeRole($role);
            return redirect()->back()->with('success','Role removed successfly');
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
        if(request('role')){
            $user = User::findorfail($id);
            if($user->removeRole(request('role'))){
                return redirect()->back()->with('success','role has been revoked successefuly');
            }
            else{
                return redirect()->back()->with('error','role can not be revoked');
            }
        }
         if(request('permission')){
            $user = User::findorfail($id);
            if($user->revokePermissionTo(request('permission'))){
                return redirect()->back()->with('success','role has been revoked successefuly');
            }
            else{
                return redirect()->back()->with('error','role can not be revoked');
            }
        }

        if(request('users')){
       $delete_user = User::findorfail($id);
       if($delete_user->delete()){
           return redirect()->back()->with('success','User Deleted Successfuly');
       }
    }



    }
}
