<?php

namespace App\Http\Livewire;
use App\Models\account;
use App\Models\cashIn;
use App\Models\customer;
use App\Models\customerAccountSummary;
use App\Models\customerWallet;
use App\Models\customerWalletSummury;
use App\Models\order;
use App\Models\orderItem;
use App\Models\payment;
use App\Models\sale;
use App\Models\stock;
use App\Models\stocking;
use App\Models\store;
use App\Models\subStore;
use App\Models\User;
use App\Models\warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Expr\PostDec;

class Showfinal extends Component
{

    public $name, $email, $user_id;
    public $updateMode = false;
    public $post;
    public $show_id;
    public $order_qty;
    public $item_id = [];
    public $qty = [];
    public $message = "";

    protected $rules = [
        'orderProducts.*.qty' => 'required'
    ];

     public function storeItem($id,$item_id)
    {
            $selling_price = stock::where('id',$item_id)->first();
        // if(orderItem::where('order_id',$id)->where('item_id',$item_id)->exists()){
        //     $message = "Sorry! this item already exist";
        //     $this->message = $message;
        // }
        // else{
            $newitemorder = orderItem::create([
                'order_id'=>$id,
                'item_id'=>$item_id,
                'qty'=>0.00,
                'selling_price'=> $selling_price->selling_price,
                'user_id'=>auth()->id()
                ]);
                $this->message = "";
        // }

    }

    public function mount($post){
        $this->post = $post;
        // $this->allProducts = Product::all();
        $this->orderProducts = orderItem::where('id',$post)
        ->get();

    }

    public function addProduct($post)
    {
        $this->validate();
       dd( $this->orderProducts[] = orderItem::where('id',$post)->first());
    }

    public function draftorder($post,$item_id,$qty){
      
            $oders = orderItem::where('order_id',$post)->first();
            $item_id = $item_id;
             $qty = $qty;
            
             for ($i=0; $i < count($item_id); $i++) {
                $update = orderItem::where('id',$item_id[$i])->update([
                    'qty'=>$qty[$i],
                   // 'width'=>request('width[]')
                ]);
             }
             return redirect()->back()->with('success','Record updated successfuly');

    }
    
    public function show(){
       $show_id =  $this->post;
         }

    public function render()
    {

        $pos_id=$this->post;
       
        $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->where('model_has_permissions.model_id',auth()->id())
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->pluck('permissions.permission_name');

        $whareh = warehouse::where('warehouse',$permissions)->first();
        if($whareh){
        $wharehouse_id = $whareh->id;

        $orders = order::where('id',$pos_id)
        ->where('status','Pending')
        ->where('user_id',auth()->id())
        ->first();


        $orderings = order::join('customers','orders.customer_id','customers.id')
        ->select('orders.id','customers.customer_name')
        ->where('orders.status','Pending')
        ->where('orders.user_id',auth()->id())
        ->get();
   //dd($orders);
    // if($orders ==null){
    //     dd('wawuu null');
        if(!empty($orders)){
        $customers = customer::join('orders','orders.customer_id','customers.id')
        ->where('orders.status','Pending')
        ->where('customers.id',$orders->customer_id)
        ->first();
        $wallet = customerWallet::where('customer_id', $orders->customer_id)->first();
        if($wallet){
            $ewallete = $wallet->balance;
        }
        else{
            $ewallete = 0;
        }
        $items = subStore::join('stocks','stocks.id','sub_stores.item_id')
        ->where('sub_stores.current_qty','>=',1)
        ->where('sub_stores.warehouse',$wharehouse_id)
        ->get();

        $order_items = orderItem::join('stocks','order_items.item_id','stocks.id')
        ->join('sub_stores','sub_stores.item_id','order_items.item_id')
        ->select('order_items.*','stocks.item','sub_stores.current_qty as stock_qty')
        ->where('order_items.order_id',$pos_id)
        ->where('sub_stores.warehouse',$wharehouse_id)
        ->get();

        $po = orderItem::join('orders','order_items.order_id','orders.id')
        ->join('stocks','order_items.item_id','stocks.id')
        ->select('*',
        DB::raw("sum(order_items.qty) as order_qty"),
        DB::raw("SUM(order_items.selling_price * order_items.qty) as subtotal"),
        DB::raw("SUM(stocks.selling_price * order_items.qty * stocks.vat) as vat")
        )
        ->where('order_items.order_id',$pos_id)
        ->where('orders.status','Pending')
        ->first();

        // return view('livewire.showFrame',);
 return view('livewire.showfinal',compact('customers','items','orders','orderings','pos_id','order_items','po','ewallete'))
 ->layout('livewire.showFrame');

    }

    else{
        session()->flash('message', 'Users Deleted Successfully.');
        // return redirect()->back()->with('error','No such order');
    }

}}


      private function resetInputFields(){
        $this->name = '';
        $this->email = '';
    }

    public function store()
    {

        // $validatedDate = $this->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        // ]);

        // User::create($validatedDate);

        // session()->flash('message', 'Users Created Successfully.');

        // $this->resetInputFields();
  // Create Customer order

        if(request('customer_id')){
            if(order::where('customer_id',request('customer_id'))->where('status','Pending')->where('user_id',auth()->id())->exists()){
                $order = order::where('customer_id',request('customer_id'))
                ->where('user_id',auth()->id())
                ->where('status','Pending')
                ->first();
                dd('cust');
                return redirect()->route('pos.show',$order->id);
            }
            else{

        // find warehouse using permission
        $user = User::where('id',auth()->id())->first();
      $permissions = User::join('model_has_permissions','users.id','model_has_permissions.model_id')
        ->join('permissions','model_has_permissions.permission_id','permissions.id')
        ->select('permissions.name as permission_name','model_has_permissions.model_id as model_id','users.*')
        ->where('model_has_permissions.model_id',auth()->id())->limit(1)
        ->pluck('permissions.permission_name');
     $whareh = warehouse::where('warehouse',$permissions)->first();
        if($whareh){
        $wareshouse_id = $whareh->id;

        // create order
        $newOrder = order::create([
            'customer_id'=>request('customer_id'),
            'status'=>'Pending',
            'warehouse_id'=>$wareshouse_id,
            'user_id'=>auth()->id()
            ]);
            return redirect()->route('pos.show',$newOrder->id);
        }
        else{
            return redirect()->back()->with('error','You do not have any warehouse permission, kindly contact your supervisor');
        }
        }
    }

    // Collect Order
        if(request('item_id')){
            dd(request('item_id'));
            $selling_price = stock::where('id',request('item_id'))->first();
            $newitemorder = orderItem::create([
            'order_id'=>request('id'),
            'item_id'=>request('item_id'),
            'qty'=>1,
            'selling_price'=> $selling_price->selling_price,
            'user_id'=>auth()->id()
            ]);
            return redirect()->back();
        }
        // sell
        if(request('shop_now')){
            $passedMinutes = Carbon::now()->addMinutes(-5);
            $acc_id = account::where('main_account',1)->first();
            if($acc_id){
                // check for duplicate
              $ordered = order::where('id',request('order_id'))->first();
              $stockings = stocking::latest()->first();
              if(sale::where('order_id',$ordered->id)->where('customer_id',$ordered->customer_id)->where('user_id',auth()->id())->exists()){
                return redirect()->route('pos.index')->with('error','This sales seems to be a duplicate, please review your orders and try again');
              }
              else{
                $duplicate_order = order::where('user_id',auth()->id())->where('id',request('order_id'))->where('status','Sold')->first();
                if($duplicate_order){
                 return redirect()->route('pos.index')->with('error','The sale performed is a duplicate');
                }
                else{
            // Create sale record
            $ordered = order::where('id',request('order_id'))->first();
            if($ordered){
                if(request('wallet')){
                    $wallet = request('wallet');
                }else{
                    $wallet = 0;
                }
                if(request('status')=="Installment"){
                    $paid = request('installment') + $wallet;
                    $balance = request('amount') - $paid;

                }
                elseif(request('status')=="Credit"){
                    $paid = 0;
                    $balance = request('amount');

                }
                elseif(request('status')=="Cash"){
                    $paid = request('amount');
                    $balance = 0;
                }
                elseif(request('status')=="Pay via E-wallet"){
                    $paid = request('amount');
                    $balance = 0;
                }
           $sell = sale::create([
                'order_id'=>$ordered->id,
                'customer_id'=>$ordered->customer_id,
                'discount'=>$ordered->discount,
                'vat'=>request('vat'),
                'amount'=>request('amount'),
                'paid'=>$paid,
                'wallet'=>$wallet,
                'balance'=>$balance,
                'status'=>request('status'),
                'user_id'=>auth()->id(),
            ]);



            //   start order item
            $the_stocked = orderItem::
            join('sub_stores','sub_stores.item_id','order_items.item_id')
            ->join('orders','order_items.order_id','orders.id')
            ->select('sub_stores.current_qty as currentqty','orders.warehouse_id','orders.customer_id',
            'order_items.qty','order_items.item_id')
            ->where('order_items.order_id',$ordered->id)
            ->where('sub_stores.warehouse',$ordered->warehouse_id)
            ->get();


           foreach($the_stocked as $order){
              $store_sub = subStore::
             where('item_id',$order->item_id)
             ->where('warehouse',$order->warehouse_id)
             ->first();

            $store_sub_total=$store_sub->current_qty;
            $qty = -$order->qty;
             $store_sub->current_qty.' - '.$order->qty;
            if($store_sub->current_qty >= $order->qty){
                 $stocking = stocking::create([
                'item_id'=>$order->item_id,
                'qty'=>$order->qty,
                'current_qty'=>$store_sub_total + $qty,
                'from'=>$order->warehouse_id,
                'to'=>$order->customer_id,
                'status'=>'Sold',
                'user_id'=>auth()->id()
               ]);
               // Add stock to  sub store
                $store = subStore::where('item_id',$order->item_id)->where('warehouse',$order->warehouse_id)->update([
                    'current_qty'=>$store_sub_total + $qty
                ]);
            }
            else{
                return redirect()->back()->with('error','No enough stock for stock_id '.$store_sub->item_id.' to sale, review your order and try again');
            }
           }
            // Add record to payment table
            $payment = payment::create(
                [
                    'sale_id'=>$sell->id,
                    'account_id'=> $acc_id->id,
                    'amount'=>request('amount'),
                    'paid'=>$paid,
                    'wallet'=>$wallet,
                    'balance'=>$balance,
                    'receipt'=>'Sale',
                    'status'=>'Sale',
                    'user_id'=>auth()->id()
                ]);
                // Check if payment is from wallet, if is true skip adding more money to main account as amount already added
                if(request('status')!="Pay via E-wallet"){
                    //Create Cashin record,
                $cashin = cashIn::create(
                    [
                        'account_id'=>$acc_id->id,
                        'amount_received'=>$paid,
                        'amount_to'=> $acc_id->total + $paid - $wallet,
                        'cash_category'=>'Sale',
                        'cash_descriptions'=>request('status'),
                        'user_id'=>auth()->id(),
                    ]
                    );
            // Deduct amount from e-wallet
            $e_wallet  = customerWallet::where('customer_id',$ordered->customer_id)->first();
            $customer_wallet = customerWallet::where('customer_id',$ordered->customer_id)->update([
                'amount'=>- $wallet,
                'balance'=>$e_wallet->balance - $wallet,
                ]);
               // Create records for e-wallet transactions
               $wallet_report = customerWalletSummury::create([
                'customer_id'=>$ordered->customer_id,
                'wallet_id'=> $e_wallet->id,
                'order_id'=> $ordered->id,
                'wallet_amount'=>- $wallet,
                'wallet_balance'=>$e_wallet->balance - $wallet,
                'status'=>'Pay via E-Wallet',
                'user_id'=>auth()->id()
            ]);
                    // Add payment to main account
            $account = account::wheremain_account(1)->first();
            $accounts = $account->update([
                'total'=>$account->total + $paid - $wallet
            ]);
        // Add amount to customer account
        if(request('status')!="Cash" || request('status')!="Pay via E-wallet"){
        $customer_account = customer::where('id',$ordered->customer_id)->first();
        $current_balance = $customer_account->to;
        if($customer_account){
        $updatenow = customer::where('id',$ordered->customer_id)->update([
            'from'=> $current_balance,
            'to'=> $current_balance - $balance
        ]);
    }
        // Customer account records
            $customeraccount = customerAccountSummary::create(
                [
                    'customer_id'=>$ordered->customer_id,
                    'sale_id'=>$sell->id,
                    'from'=>$current_balance,
                    'to'=>$current_balance - $balance,
                    'status'=>request('status'),
                    'user_id'=>auth()->id()
                ]);
        }
    }
        if(request('status')=="Pay via E-wallet"){
            // Here we wont add new cash because this amount already collected and added to the main account
            $cashin = cashIn::create(
                [
                    'account_id'=>$acc_id->id,
                    'amount_received'=>$paid - $wallet,
                    'amount_to'=> $acc_id->total,
                    'cash_category'=>'Sale',
                    'cash_descriptions'=>request('status'),
                    'user_id'=>auth()->id(),
                ]);
                // Customer account records
                $customer_account = customer::where('id',$ordered->customer_id)->first();
                $current_balance = $customer_account->to;
                $customeraccount = customerAccountSummary::create(
                    [
                        'customer_id'=>$ordered->customer_id,
                        'from'=>  $current_balance,
                        'sale_id'=>  $sell->id,
                        'to'=>   $current_balance,
                        'status'=>request('status'),
                        'user_id'=>auth()->id()
                    ]);
                    // Deduct amount from e-wallet
                    $e_wallet  = customerWallet::where('customer_id',$ordered->customer_id)->first();
                    $customer_wallet = customerWallet::where('customer_id',$ordered->customer_id)->update([
                        'amount'=>- $paid,
                        'balance'=>$e_wallet->balance - $paid,
                        ]);

                    // Create records for e-wallet transactions
                    $wallet_report = customerWalletSummury::create([
                        'customer_id'=>$ordered->customer_id,
                        'wallet_id'=> $e_wallet->id,
                        'order_id'=> $ordered->id,
                        'wallet_amount'=>- $paid,
                        'wallet_balance'=>$e_wallet->balance - $paid,
                        'status'=>'Pay via E-Wallet',
                        'user_id'=>auth()->id()
                    ]);
            }

            // Update order status
            $update_order_status = order::where('id',request('order_id'))->update([
                'status'=>'Sold'
            ]);


    }
        else{
            return redirect()->back()->with('error','This order not exist');
        }
    }
}
            }
    // end if if($acc_id)
    else{
        return redirect()->back()->with('error','Main account not exist or is off');
    }
        }
        //dd('dd');
       // return redirect()->route('render')->with('success','Sale xxdone successfully');
       session()->flash('success', 'Sale done successfully');
          //dd('dd');
    }

    public function edit($id)
    {
        $this->updateMode = true;
        $user = User::where('id',$id)->first();
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;

    }

  public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();

    }

   public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Users Updated Successfully.');
            $this->resetInputFields();

        }
    }

 public function delete($id)
    {

        $to_delete = orderItem::where('id',$id)->first();
        if($to_delete){
            $to_delete->delete();
            $this->message = "";
        }
    }

}
