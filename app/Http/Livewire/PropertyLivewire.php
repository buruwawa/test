<?php

namespace App\Http\Livewire;

 use App\Models\orderItem;
 use App\Models\property;

use App\Models\metadata;
use App\Models\metanameDatatype;
use App\Models\site;

use App\Models\metaname;
use Livewire\Component;
use Illuminate\Http\Request;

class PropertyLivewire extends Component
{
   public $departments = "";
	   public $post;
      public $message = "";
      public $pos_id = [];
      public $metaname_id;
       public $site_id;
   public $names=[];
  public $properties;

    // public $metaname_name;

      public function storeItem(request $request, $id)
    {
//dd($id);
    //dd($this->metaname_id);

   $id=$this->metaname_id;
        $metaname = metaname::where('id',$id)->first();
       
//dd($metaname->metaname_name);

        if(metaname::where('metaname_name',$metaname->metaname_name)->exists()){
            $message = "Sorry! this item already exist";
            $this->message = $message;
        //  dd($id);
       
 $newitemorder = property::create([
                'property_name'=>$id,
                'property_serial_no'=>$id,
                'property_barcode'=>0.00,
                'property_tag_no'=>'tag_no',
                'user_id'=>auth()->id()
                ]);
        }
        else{
            $newitemorder = property::create([
                'property_name'=>$id,
                'property_serial_no'=>$id,
                'property_barcode'=>0.00,
                'property_tag_no'=>'tag_no',
                'user_id'=>auth()->id()
                ]);

            $message = "succes!,Record updated successfuly";
            $this->message = $message;
        }
    }




   public function storeProperty(request $request, $id)
    {
 // $id=$this->metaname_id;
  $v=$this->names;
 //dd($v);

 $newitemorder = property::create([
 	            'metaname_id'=>1,
                'property_name'=>$name,
                'property_serial_no'=>$id,
                'property_barcode'=>0.00,
                'property_tag_no'=>'tag_no',
                'user_id'=>auth()->id()
                ]);
    }


   public function store(Request $request)
    {
          $hear_from = request('names');  
         //dd($hear_from);
     $g='property_serial_no';
     //dd($g);
     // if($hear_from !=null)
     // {
     //    foreach ($hear_from as $hears) {
     //    	  //dd($key);
     //    $tourhearfrom = property::UpdateOrCreate(
     //  ['metaname_id'=>1,
     // 'property_name'=>2],

     //  [
             
     //           'property_serial_no'=>$hears,
     //            'property_barcode'=>$hears,
     //            'property_tag_no'=>$hears,
     //            'user_id'=>auth()->id()    
     //    ]);
     //    } 
     // }
//dd($this->metaname_id);
//dd(request('property_name'));


  $tourhearfrom = property::UpdateOrCreate(
      ['site_id'=>request('site_id'),
      	'metaname_id'=>request('metaname_id'),
     'property_name'=>request('property_name')],

      [
                'location_id'=>request('metaname_id'),
                 'property_type'=>request('property_type'),
               'property_serial_no'=>request('property_serial_no'),
                'property_barcode'=>request('property_barcode'),
                'property_tag_no'=>request('property_tag_no'),
                'property_description'=>request('property_description'),
                'user_id'=>auth()->id()    
        ]);

// foreach($request->get('names') as $name) {
//         $bio =  new property;
//         $bio->metaname_id = $name;
//        // dd($request->get('names'));
//         $bio->save();
//         return "Success";
//     }
   return redirect()->back()->with('success','Property created successfly');
    }

  public function groupMetaNameFilter(request $request, $id)
    {
 // $id=$this->metaname_id;
  //$v=$this->names;
 // dd(request('metaname_id'));

  //dd($this->metaname_id);
 // $newitemorder = property::create([
 // 	            'metaname_id'=>$this->metaname_id,
 //                'property_name'=>$name,
 //                'property_serial_no'=>$id,
 //                'property_barcode'=>0.00,
 //                'property_tag_no'=>'tag_no',
 //                'user_id'=>auth()->id()
 //                ]);

  $metadatas = metadata::get();
    }



    public function render()
    {
   $pos_id=$this->metaname_id;
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
  //dd($this->metaname_id);
                $sites = site::get();
                 $metanames = metaname::get();
            $metadatas = metanameDatatype::where('metaname_id',$this->metaname_id)->get();
             
    //     ->where('sub_stores.current_qty','>=',1)
    //     ->where('sub_stores.warehouse',$wharehouse_id)
    //     ->get();
         // dd($metadatas);
           //  session()->flash('message', 'Users Updated Successfully.');
     // return view('livewire.department')->layout('livewire.showFrame');
      return view('livewire.property-livewire',compact('metadatas','metanames','sites'))
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
