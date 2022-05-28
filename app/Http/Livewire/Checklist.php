<?php

namespace App\Http\Livewire;


 use App\Models\orderItem;
 use App\Models\property;

use App\Models\metadata;
use App\Models\metanameDatatype;
use App\Models\site;
use App\Models\metaname;

use App\Models\setIndicator;
use App\Models\qnsAppliedto;

use App\Models\answer;
use App\Models\userActivity;
use App\Models\activityRole;
use App\Models\userRole;

use App\Models\departmentRole;
use App\Models\user;

use App\Models\answerUpdatePhoto;
use App\Models\optionalAnswer;
use Livewire\Component;
use DB;
use Illuminate\Http\Request;

class Checklist extends Component
{

 public $departments = "";
       public $post;
      public $message = "";
      public $act = [];
      public $indicator_id;

  public $metaname_id;
   public $site_id;
   public $names=[];
    public $ids=[];
  public $desc=[];
   public $prop=[];
   public $attachment=[];

  public $properties;

       public $qnType;
        public $times;
        public $qnNo;
           public $qn_no;

public function store(Request $request)
    {
    $indexs = request('index');
    $ids = request('ids');
          
        $attachment = request('attachment');

   $prop = request('prop');  
    $pd = request("pd");   


$descf='desc'.$pd;
$desc = request($descf);

//dd($desc);

       if($ids !=null)
     {
        
foreach ($ids as $idx=>$key) {
  $optionalData = optionalAnswer::where('id', $key)->first();

        $insetqns = answer::Create([
        'indicator_id'=>$optionalData->indicator_id,
         'answer'=>$optionalData->answer,
        'property_id'=>$pd,
         
          'status'=>'Active',
           'action'=>1,
          'user_id'=>auth()->id()        
        ]);
$aid=$insetqns->id;

foreach ($desc as $idy=>$value) {

  if($desc[$idy] ==null)
  {
$desc[$idy]='Nill';
  }

  if(isset($desc[$idy]) !=null)
        {

    $item = answerUpdatePhoto::where('answer_id',$aid)
    ->first();     

if($item == null)
{

 $insetqns = answerUpdatePhoto::Create([
          'index_id'=>$idy+ $idx,
          'answer_id'=>$aid,
          'description'=>$desc[$idy],
          'status'=>'Active',        
        ]);
}

  }
} 
// Clear answerupdatephoto db2_tables(connection)

$attachmentf='attachment'.$pd;
$attach = request($attachmentf);

   if(request($attachmentf)){
   
                //$attach = request('attachment'); 
              //  dd($attach);

                foreach($attach as $key=>$attached){


              if(isset($attach[$key + $idx]) !=null)
        {

                     // // Get filename with extension
                     // $fileNameWithExt =$attach[$key + $idx]->getClientOriginalName();
              
                     // // Just Filename
                     // $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     // // Get just Extension
                     // $extension = $attach[$key + $idx]->getClientOriginalExtension();
                     // //Filename to store
                     // $imageToStore = $filename.'_'.time().'.'.$extension;
                     // //upload the image
                     // $path =$attach[$key + $idx]->storeAs('public/img/', $imageToStore);

}
    }
     }
      } 
     }

$descDatas = answerUpdatePhoto::get(); 
//sdd($descDatas);

foreach ($descDatas as $key) {
foreach ($desc as $idy=>$value) {

  if($key->index_id ==$idy)
  {
  $insetqnsy = answerUpdatePhoto::where('index_id',$key->index_id)         
             ->update([
           'description'=>$value,
            ]);

         }    

  }


// Update the Image table


$attachmentf='attachment'.$pd;
$attach = request($attachmentf);

   if(request($attachmentf)){

// foreach ($descDatas as $key) {
   foreach($attach as $imgkey=>$attached){

  if($key->index_id ==$imgkey)
  {


  // Get filename with extension
                     $fileNameWithExt =$attach[$imgkey]->getClientOriginalName();
              
                     // Just Filename
                     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     // Get just Extension
                     $extension = $attach[$imgkey]->getClientOriginalExtension();
                     //Filename to store
                     $imageToStore = $filename.'_'.time().'.'.$extension;
                     //upload the image
                     $path =$attach[$imgkey]->storeAs('public/img/', $imageToStore);


  $insetqnsy = answerUpdatePhoto::where('index_id',$key->index_id)         
             ->update([
           'image'=>$imageToStore,
            ]);

         }    

  }
}
}

//Update answer table
$answerTableUpdate=DB::statement('update answers a,answer_update_photos ap set a.description=ap.description,a.image=ap.image where a.id=ap.answer_id and a.action=1');


$flashanswerTable=DB::statement('truncate table answer_update_photos');

$updateqnsF = answer::where('action',1) 
             ->where('description','Nill')            
             ->update([
            'description'=>""
            ]);

$updateqnsF = answer::where('action',1)             
             ->update([
            'action'=>0
            ]);


   return redirect()->back()->with('success','Submitted Successfully');
    }


    public function render(Request $request)
    {
     $pos_id=$this->metaname_id;
     $qnType=$this->qnType;
     $times=$this->qnNo;

    $qn_no=$this->qn_no;


          //  $indicators = setIndicator::get();
      $metanames = metaname::get();
      $qns = setIndicator::where('qns','!=',"")
      ->orderBy('id')->get();
      $metadatas = optionalAnswer::get();

//$pp = property::get();

//$properties= DB::select('select property_name from properties');
       // $properties = DB::select('select distinct(p.metaname_id),p.property_name,q.indicator_id,s.qns from properties p,qns_appliedtos q,set_indicators s where p.metaname_id=q.metaname_id and q.indicator_id=s.id');

//$userActitivities=userActivity::get();
//$uid=auth()->id();
//dd($uid);

 $userActitivities = userActivity::join('metanames','metanames.id','user_activities.activity_id')
 ->where('user_activities.sys_user_id',auth()->id())
 ->where('user_activities.status','Active')
 //->join('users','sales.user_id','users.id')
 ->select('metanames.id','metanames.metaname_name')
 ->get();


$departments=user::where('id',auth()->id())->first();
 $userActitivitiesf = userRole::join('activity_roles','activity_roles.role_id','user_roles.role_id')
 ->join('metanames','metanames.id','activity_roles.activity_id')
 ->where('user_roles.sys_user_id',auth()->id())
->where('activity_roles.status','Active')
 //->join('users','sales.user_id','users.id')
->select('metanames.id','metanames.metaname_name')
 ->get();

//dd($departments);
 $userActitivitiesff = departmentRole::join('activity_roles','activity_roles.role_id','department_roles.role_id')
 ->join('metanames','metanames.id','activity_roles.activity_id')
 ->where('department_roles.department_id',$departments->department)
->where('activity_roles.status','Active')
 //->join('users','sales.user_id','users.id')
->select('metanames.id','metanames.metaname_name')
 ->get();

//dd($userActitivities);
//$acts =new $userActitivities;

    $first = collect($userActitivities);
    $second = collect($userActitivitiesf);   
    $third = collect($userActitivitiesff);
    //$acts[2]=$userActitivitiesf;  
   //$acts->push($userActitivitiesf);  
    //$acts->all();   
//     $array1 = array("color" => "red", 2, 4);
// $array2 = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
// $acts = array_merge($userActitivities, $userActitivitiesf);
// //print_r($result); 

$acts = $first->merge($second);
$acts = $acts->merge($third);
$acts = $acts->unique('metaname_name');
 //$acts = $acts->groupBy('metaname_name');
  //dd($unique);
$pp = property::where('property_name','!=',"")
      ->orderBy('id')->get();

$qnsx = DB::select('select * from set_indicators s,qns_appliedtos q,metanames m where s.id=q.indicator_id and m.id=q.metaname_id and q.metaname_id in(13,1)');
   
 $metadatasx = DB::select('select * from optional_answers where indicator_id in(select q.indicator_id from set_indicators s,qns_appliedtos q,metanames m where s.id=q.indicator_id and q.metaname_id in(13,1))');
    //dd($metadatasx);
     
      return view('livewire.checklist',compact('metadatas','metanames','pp','qns','userActitivities','acts'))
      ->layout('livewire.showFrame');

    //    // return view('livewire.department');

 // return view('livewire.show',compact('customers','items','orders','orderings','pos_id','order_items','po','ewallete'))w
 // ->layout('livewire.showFrame');

    // }

    // else{
    //     session()->flash('message', 'Users Deleted Successfully.');
    //     // return redirect()->back()->with('error','No such order');
    // }

  }
}
