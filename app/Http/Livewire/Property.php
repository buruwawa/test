<?php

namespace App\Http\Livewire;

 use App\Models\orderItem;
  use App\Models\property2;

   use App\Models\metaname;
use Livewire\Component;
use Illuminate\Http\Request;

class Property extends Component
{
      public $departments = "";
	   public $post;
      public $message = "";
      public $pos_id = [];
      public $metaname_id;
   public $name;
    // public $metaname_name;

      public function storeItem(request $request, $id)
    {

   $id=$this->metaname_id;
        $metaname = metaname::where('id',$id)->first();
       
//dd($metaname->metaname_name);

        if(metaname::where('metaname_name',$metaname->metaname_name)->exists()){
            $message = "Sorry! this item already exist";
            $this->message = $message;
        //  dd($id);
       
 $newitemorder = orderItem::create([
                'property_name'=>$id,
                'property_serial_no'=>$id,
                'property_barcode'=>0.00,
                'property_tag_no'=>'tag_no',
                'user_id'=>auth()->id()
                ]);
        }
        else{
            $newitemorder = orderItem::create([
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





    public function render()
    {
   $pos_id=$this->post;
  // $this->orderProducts = orderItem::where('id',$post)
    //    //  ->get();
    	  // $this->departments=department::get();
    	  // dd($this->departments);     
    // return view('livewire.department')->layout('livewire.showFrame');
    //    // return view('livewire.department');
//dd($pos_id);
 //           //
   // $this->departments = department::where('id',18)
        // ->get();
        //    $orderProducts = property2::where('id',18)
        // ->get();
         $items = property2::get();
         $metanames = metaname::get();
    //     ->where('sub_stores.current_qty','>=',1)
    //     ->where('sub_stores.warehouse',$wharehouse_id)
    //     ->get();
          //dd($properties);
           //  session()->flash('message', 'Users Updated Successfully.');
     // return view('livewire.department')->layout('livewire.showFrame');
      return view('livewire.property-livewire',compact('items','metanames'))
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
