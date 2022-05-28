<?php

namespace App\Http\Livewire;

 use App\Models\orderItem;
  use App\Models\property;

use Livewire\Component;

class Department extends Component
{
	   public $departments = "";
	   public $post;
      public $message = "";
      public $pos_id = [];



      public function storeItem($id,$item_id)
    {

     //dd($id);

   $pos_id=$this->post;
        $property = property::where('id',$item_id)->first();

        if(property::where('property_name',$property->property_name)->exists()){
            $message = "Sorry! this item already exist";
            $this->message = $message;
           //dd($item_id);
        }
        else{
            $newitemorder = property::create([
                'property_name'=>$id,
                'property_serial_no'=>$item_id,
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
           $orderProducts = orderItem::where('id',18)
        ->get();
         $items = orderItem::get();
              $properties = property::get();
    //     ->where('sub_stores.current_qty','>=',1)
    //     ->where('sub_stores.warehouse',$wharehouse_id)
    //     ->get();
          //dd($properties);
           //  session()->flash('message', 'Users Updated Successfully.');
     // return view('livewire.department')->layout('livewire.showFrame');
      return view('livewire.department',compact('orderProducts','items','properties'))
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
