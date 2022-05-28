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

use App\Models\optionalAnswer;
use Livewire\Component;
use Illuminate\Http\Request;

class AssignLivewire extends Component
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

 $metanames = request('metanames');
         $indicators = request('indicators');
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

 if($indicators ==null)
     {
return redirect()->back()->with('error','Indicators not selected');
     }
        
   if($metanames !=null)
     {
      // {{$indicators}}   
    foreach ($metanames as $metaname) { 

    foreach ($indicators as $indicator) {
 
    $appliedto = qnsAppliedto::UpdateOrCreate([
        
        'metaname_id'=>$metaname,
        'indicator_id'=>$indicator,
        'status'=>'Active',
          'user_id'=>auth()->id()        
        ]);

        } 
      }

     }
     else
     {
      return redirect()->back()->with('error','Metanames not selected');
     }
// 
//   }
   return redirect()->back()->with('success','Indicators Assigned Successfully');
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

                $sites = site::get();
                $metanames = metaname::get();
                  $indicators = setIndicator::where('qns','!=',"")
                  ->get();
                //dd($metanames);
            $metadatas = metanameDatatype::where('metaname_id',$this->metaname_id)->get();
      
           // $metadatas = metanameDatatype::where('metaname_id',5)->get();


    //     ->where('sub_stores.current_qty','>=',1)
    //     ->where('sub_stores.warehouse',$wharehouse_id)
    //     ->get();
          //dd($times);
           //  session()->flash('message', 'Users Updated Successfully.');
     // return view('livewire.department')->layout('livewire.showFrame');
      return view('livewire.assign-indicator',compact('metadatas','metanames','sites','indicators'))
      ->layout('livewire.showFrame');

    //    // return view('livewire.department');

 // return view('livewire.show',compact('customers','items','orders','orderings','pos_id','order_items','po','ewallete'))
 // ->layout('livewire.showFrame');

    // }

    // else{
    //     session()->flash('message', 'Users Deleted Successfully.');
    //     // return redirect()->back()->with('error','No such order');
    // }

  }
}
