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
      public $pos_id = [];
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
    $desc = request('desc');
        
        $attachment = request('attachment');

   $prop = request('prop');  
    $pd = request('pd');   
//$prop = request('prop8');
       // $EmptyTestArray = array_filter($attachment);
       
// foreach ($pd as $pdx=>$value) {
//dd(request('pd'));

// }

//dd($ids);

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
  if(isset($desc[$idy]) !=null)
        {

     //Find if Item Exists
 // $insetqns = answerUpdatePhoto::Create([
 //          'index_id'=>$idy,
 //          'index_count'=>$idx,
 //          'answer_id'=>$aid,
 //          'description'=>$desc[$idy],
 //          'status'=>'Active',        
 //        ]);

    $item = answerUpdatePhoto::where('answer_id',$aid)
    ->first();     

if($item == null)
{
 $insetqns = answerUpdatePhoto::Create([
          'answer_id'=>$aid,
          'description'=>$desc[$idy + $idx],
          'status'=>'Active',        
        ]);
}

  }
} 

       //  if($attachment !=null){
       //    if(isset($attachment) !=null)
       //    { 
       //      $attached=[];
       //      // $attachment=new $attached;
       //               // Get filename with extension
       //               $fileNameWithExt = $attachment->getClientOriginalName();
       //               // Just Filename
       //               $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
       //               // Get just Extension
       //               $extension = $attachment->getClientOriginalExtension();
       //               //Filename to store
       //               $imageToStore = $filename.'_'.time().'.'.$extension;
       //               //upload the image
       //               $path = $attachment->storeAs('public/img/', $imageToStore);

       //      $insetqnsx = answerUpdatePhoto::Create([
       //    'answer_id'=>$aid,
       //    'description'=>$desc[$idy + $idx],
       //    'status'=>'Active',        
       //  ]);

       //  }
       // }


   if(request('attachment')){
                $attach = request('attachment');             
                foreach($attach as $key=>$attached){
                  //dd($attach);
 // if($attached !=null){
                    if(isset($attach[$key + $idx]) !=null)
        {

                     // Get filename with extension
                     $fileNameWithExt =$attach[$key + $idx]->getClientOriginalName();
              
                     // Just Filename
                     $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                     // Get just Extension
                     $extension = $attach[$key + $idx]->getClientOriginalExtension();
                     //Filename to store
                     $imageToStore = $filename.'_'.time().'.'.$extension;
                     //upload the image
                     $path =$attach[$key + $idx]->storeAs('public/img/', $imageToStore);

 $photo = answerUpdatePhoto::where('answer_id',$aid)
 //->where('image','==',Null)
    ->first();
    //dd($photo);
   // dd($photo->image);

if($photo->image == null)
{
    // $insetqnsx = answerUpdatePhoto::UpdateOrCreate([
    //       'answer_id'=>$aid,
    //        ],
    //       [ 
    //       'image'=>$imageToStore,
    //       'status'=>'Active',        
    //     ]);
  $insetqnsx = answerUpdatePhoto::where('answer_id',$aid)             
             ->update([
           'image'=>$imageToStore,
            ]);

  }

}
    }
     }
      } 
     }

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
$pp = property::where('property_name','!=',"")
      ->orderBy('id')->get();
//$properties= DB::select('select property_name from properties');
       // $properties = DB::select('select distinct(p.metaname_id),p.property_name,q.indicator_id,s.qns from properties p,qns_appliedtos q,set_indicators s where p.metaname_id=q.metaname_id and q.indicator_id=s.id');
//dd($pp);

$qnsx = DB::select('select * from set_indicators s,qns_appliedtos q,metanames m where s.id=q.indicator_id and m.id=q.metaname_id and q.metaname_id in(13,1)');
   
 $metadatasx = DB::select('select * from optional_answers where indicator_id in(select q.indicator_id from set_indicators s,qns_appliedtos q,metanames m where s.id=q.indicator_id and q.metaname_id in(13,1))');
    //dd($metadatasx);
      return view('livewire.checklist',compact('metadatas','metanames','pp','qns'))
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
