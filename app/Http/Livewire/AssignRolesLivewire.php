<?php

namespace App\Http\Livewire;


 use App\Models\orderItem;
 use App\Models\property;

use App\Models\metadata;
use App\Models\metanameDatatype;
use Spatie\Permission\Models\Role;
use App\Models\department;
use App\Models\metaname;

use App\Models\setIndicator;
use App\Models\qnsAppliedto;

use App\Models\departmentRole;
use Livewire\Component;
use Illuminate\Http\Request;

class AssignRolesLivewire extends Component
{

 public $departments = "";
       public $post;
      public $message = "";
      public $pos_id = [];
      public $metaname_id;
       public $site_id;
   public $names=[];
  public $properties;

       public $qnType;
        public $times;
        public $qnNo;
           public $qn_no;

public function store(Request $request)
    {

 $roles = request('roles');
         $departs = request('departs');
         // $names = request('names');
//dd($indicators);

// $indicator = setIndicator::UpdateOrCreate([
//         'qns'=>request('question'),
//          'status'=>'Active',
//           'user_id'=>auth()->id()
//         ]);


// /dd($names->name);
//dd(request('property_name'));


  // $tourhearfrom = property::UpdateOrCreate(
  //     ['site_id'=>request('site_id'),
  //       'metaname_id'=>request('metaname_id'),
  //    'property_name'=>request('property_name')],

  //     [
  //               'location_id'=>request('metaname_id'),
  //                'property_type'=>request('property_type'),
  //              'property_serial_no'=>request('property_serial_no'),
  //               'property_barcode'=>request('property_barcode'),
  //               'property_tag_no'=>request('property_tag_no'),
  //               'property_description'=>request('property_description'),
  //               'user_id'=>auth()->id()    
  //       ]);

//        if($metanames !=null)
//      {

 if($departs ==null)
     {
return redirect()->back()->with('error','Department not selected');
     }
        
   if($roles !=null)
     {
      // {{$indicators}}   
    foreach ($departs as $depart) { 

    foreach ($roles as $role) {
 
    $appliedto = departmentRole::UpdateOrCreate([
        'role_id'=>$role,
        'department_id'=>$depart,        
        'status'=>'Active',
        'user_id'=>auth()->id()        
        ]);

        } 
      }

     }
     else
     {
      return redirect()->back()->with('error','Roles not selected');
     }
// 
//   }
   return redirect()->back()->with('success','Roles Assigned successfly');
    }



    public function render(Request $request)
    {
     $pos_id=$this->metaname_id;
     $qnType=$this->qnType;
     $times=$this->qnNo;

    $qn_no=$this->qn_no;
  // $this->orderProducts = orderItem::where('id',$post)
    //    //  ->get();
          // $this->departments=department::get();
          // dd($this->departments);     
    // return view('livewire.department')->layout('livewire.showFrame');
    //    // return view('livewire.department');
// dd(request('metaname_id'));
   // $this->departments = department::where('id',18)
        // ->get();
        //    $orderProducts = property2::where('id',18)
        // ->get();
    //dd($this->qn_no);

                //$sites = site::get();
                $roles = role::get();
                  $departs = department::get();
               // dd($departments);
            $metadatas = metanameDatatype::where('metaname_id',$this->metaname_id)->get();
 
      return view('livewire.assign-department-roles',compact('metadatas','roles','departs'))
      ->layout('livewire.showFrame');


  }
}
