<?php

namespace App\Http\Controllers;

use App\Models\user;
//use App\Actions\Fortify\PasswordValidationRules;
use Dotenv\Validator;
use App\Models\department;
use App\Models\metadata;
use App\Models\datatype;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
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
 //   $users = user::join('departments','users.department','departments.id')
    //$users=DB::select('select u.id,u.name,d.department_name,u.email from users u,departments d where u.department=d.id');
   // ->get();
   // dd($users);
        //return view('admin.settings.metadata.metadata',compact('metadatas','datatypes'));

 $users = DB::select('select u.id,u.name,u.department,d.department_name,u.email,u.status from users u,departments d where u.department=d.id and u.status="Active"');
//dd($users);

$departments=department::get();

 return view('auth.register',compact('departments','users','datatypes'));
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

  validator([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' =>['required', 'string', 'max:64'],
            //'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        
        if(request('password') != request('password_confirmation'))
        {
            //dd('Not equal');
           return redirect()->back()->with('error',"Password doesn't match");
        }

else
{
       $indicator = user::UpdateOrCreate([
        'name'=>request('name'),
        'department'=>request('department'),
         'email'=>request('email'),
         'password'=>Hash::make(request('password')),
         'status'=>'Active',
          'user_id'=>auth()->id()
        ]);
}
      return redirect()->back()->with('success','User Registered successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function show(userRegister $userRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request,$id)
    {  
        $user = user::where('id',$id)
               ->update([
                'status'=>"Inactive",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','User deleted successfly');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\userRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //dd($id);
       $user = user::where('id',$id)->first();
        if($user){
           $user->update([
            'name'=>request('full_name'),
             'department'=>request('department'),
              'email'=>request('email'),
             'user_id'=>auth()->id()
           ]);
           return redirect()->back()->with('success','User updated successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this User');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userRegister  $userRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user,$id)
    {
        $user = user::where('id',$id)->first();
        if($user){
            $user->delete();
            return redirect()->back()->with('success','User permanent deleted successfully');
        }
        else{
            return redirect()->back()->with('error','Something went wrong with this User');
        }
    }


    public function recoveryUpdate(user $user,$id)
    {
          $user = user::where('id',$id)
               ->update([
                'status'=>"Active",
                 'user_id'=>auth()->id()

              ]);
       return redirect()->back()->with('success','User recovered successfly');
    }


   public function recovery()
    {
       //$user = user::where('status','Inactive')->get();
         // $datatypes = datatype::get();
         $users = DB::select('select u.id,u.name,u.department,d.department_name,u.email,u.status from users u,departments d where u.department=d.id and u.status="Inactive"');
//dd($users);

$departments=department::get();
        return view('admin.settings.recovery.recoveryUser',compact('users','departments'));
    }
}
