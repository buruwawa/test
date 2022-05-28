

        <div>
            <div class="row">
                <div class="col-xl-2 col-md-2  ">
                    <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body">
                            <h4 class="title font-weight-bold text-center">Items List</h4>
                            <hr>
                            @if($message)
                            <div class="alert alert-danger">
                              <h5   class="text-center">{{ $message }}</h5>
                            </div>
                            @endif
                        </div>
                            <div class="product-items">
                                <div class="row">

                @foreach ($items as $item)
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="productCard">
                <div class="productContent">
                
                <form wire:click.prevent="storeItem({{$pos_id}},{{$item->item_id}})">

                        <button type="submit" class="btn btn-primary" style="min-width: 100%">
                            {{ $item->item }} <i class="fa fa-shopping-cart float-right"></i>
                        </button>                     
                </form>

                   </div>
                    </div>
                </div>
                @endforeach
                                </div>
                            </div>

                    </div>
                </div>

                <div class="col-xl-7 col-lg-7 col-md-7">
{{-- start of product --}}
{{--  card card-custom gutter-b bg-white border-0  --}}
                            <div >
                            <div class="card card-custom gutter-b bg-white border-0   table-contentpos">


                                    <div class="card-body" style="height:700px  !important">

                            {{--  <div class="card-body">
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <label >Select Product</label>
                                        <fieldset class="form-group mb-0 d-flex barcodeselection">
                                            <select class="form-control w-25" id="exampleFormControlSelect1">
                                                <option disabled>Name</option>
                                                <option>SKU</option>
                                              </select>

                        <form action="{{ route('pos.store') }}" method="POST">
                                            @csrf
                                        <input type="hidden" name="id" id="" value="{{ $pos_id }}">

                                <select class="arabic-select select-down  border-dark" id="basicInput1" onchange="this.form.submit()" name="item_id">
                                                @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item }}</option>
                                                @endforeach
                                        </select>
                                    </form>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>  --}}

    <div class="table-datapos" style="height: 600px !important;">
       {{--  <form action="{{ route('pos.update',$pos_id) }}" method="POST">  --}}

        <form action="{{ route('pos.update',$pos_id)}}" method="POST">
            <input type="hidden" name="_method" value="PUT">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <div class="">
               <div>
                   <table class="table table-responsive table-hover">
                       <thead>
                           <tr>

                                <th>Item </th>
                                <th>Width</th>
                                <th>Height</th>
                            
                               <th>Total Square</th>
                               <th>Unit Price</th>
                               <th>Subtotal</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                       
                           @foreach ($order_items as $orderitem )
                           <tr>
                               <td>{{ $orderitem->item  }}</td>
                             <td>
    <input type="number" name="width[]" id="up_{{$orderitem->id}}" min="0" onclick="myFunction({{$orderitem->id}})" onkeyup ="myFunction({{$orderitem->id}})" class="form-control border-dark w-100px" step="0.01" value="{{$orderitem->width}}" pattern="[0-9]+([\.,][0-9]+)?">
 </td>

   <td>
       <input type="number" name="height[]" id="ur_{{$orderitem->id}}" min="0" onclick="myFunction({{$orderitem->id}})" onkeyup="myFunction({{$orderitem->id}})" class="form-control border-dark w-100px" value="{{$orderitem->height}}" step="0.01" pattern="[0-9]+([\.,][0-9]+)?">
  </td>
                                                               <td>
              @if($orderitem->stock_qty < $orderitem->qty)
            <span class="text-danger">Out of stock
               <?php
            $out_of_stock = 1;
                                                      ?>
                                                   @else
    <input name="item_id[]" type="hidden" value="{{ $orderitem->id }}">
    <input name="tqty{{$orderitem->id}}" id="tqty{{$orderitem->id}}" type="hidden" value="{{ $orderitem->stock_qty }}">

    <input name="qty[]" type="number" name="qty{{$orderitem->id}}" id="qty{{$orderitem->id}}" min="0" max="{{ $orderitem->stock_qty }}" class="form-control border-dark w-100px" placeholder="" value="{{$orderitem->qty}}" title="Available stock is: {{ $orderitem->stock_qty }}" readonly>

                                                            @endif
                                                           </span>
                                                           </td>

                                                           <td> 
            <input type="number" name="price_{{$orderitem->id}}" id="price_{{$orderitem->id}}" min="0" onclick="myFunction({{$orderitem->id}})" class="form-control border-dark w-100px" value="{{$orderitem->selling_price}}" readonly>
        </td>
         <td> 
            <input type="text" class="form-control" name="subtotal_{{$orderitem->id}}" id="subtotal_{{$orderitem->id}}" min="0.00" value="{{number_format($orderitem->qty * $orderitem->selling_price)}}"  readonly>
                  </td>
                <td>


    <div class="card-toolbar text-right">
        <input type="hidden" name="order_id" value="{{ $orderitem->id }}">
    <button wire:click.prevent="delete({{$orderitem->id}})" class="btn-sm btn btn-danger" title="Delete" type="submit" name="delete" value="delet this item"><i class="fas fa-trash-alt"></i></button>
    </div>
   </td>

                                                       </tr>
                                                       @endforeach
                                                   </tbody>
                                                   <tfoot>
                                                       <th></th>
                                                       <th></th>
                                                         <th></th>
                                                         <th></th>
                                                       <th>Total</th>
                                                       <th>
   
                                                           {{ number_format($po->subtotal) }}
                                                       </th>
                                                           
                                               </tfoot>
                                               </table>
                                           </div>

                                           @if($order_items !='[]')
                                           {{-- start of new design --}}
                                           <div class="form-group row mb-0">
                                            <div class="col-md-12 btn-submit d-flex justify-content-end">


                                                <button type="submit"
                                                    class="btn btn-success white" name="draft">

                                                    Draft Order Now
                                                </button>
                                            </div>
                                        </div>
                                           @endif
                                       </div>
                                   </form>

                                </div>
                        </div>
                        </div>
                        </div>
                 </div>
                 <div class="col-xl-3 col-lg-3 col-md-3">
                     <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body" >

                            <div class="resulttable-pos">

                       <form action="{{ route('pos.store') }}" method="POST">
                            @csrf
                        <input type="hidden" name="posFinal" value="posFinal">
                        <div class="card-body" >
                            <div class="shop-profile">
                                <div class="media">

                                    <div class="media-body ml-3">
                                        <h3 class="title font-weight-bold">
                                            <div class="greeting-text">
                                                <h3 class="card-label mb-0 ">
                                                   Order Code:#{{ $pos_id }} </h3>
                                                  <h6> Order for: @if(empty($customers->customer_name))
                                                   <script type="text/javascript">
                                                    window.location = "{{ url('/pos') }}";
                                                </script>
                                                   @else
                                                   {{ $customers->customer_name }}
                                                  @endif
                                                </h6>
                                        </div>


                                            @if($ewallete>0)
                                            <hr>
                                            <span class="btn btn-outline-success"> <span class="fa fa-wallet" style="font-size: 14px !important"> Tsh. {{ number_format($ewallete) }}</span></span> @endif</h3>

                                    </div>
                                </div>
                            </div>
                            <div class="resulttable-pos">
                                <table class="table right-table">
                                    <tbody>


                                      <tr class="d-flex align-items-center justify-content-between">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                Total Items
                                        </th>
                                        <td class="border-0 justify-content-end d-flex text-dark font-size-base">{{ $po->order_qty }}</td>

                                      </tr>
                                      <tr class="d-flex align-items-center justify-content-between">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                Subtotal <span class="text-danger">- (VAT)</span>
                                        </th>
                                        <td class="border-0 justify-content-end d-flex text-dark font-size-base">Tsh. {{ number_format($po->subtotal - $po->vat) }}</td>

                                      </tr>
                                      <tr class="d-flex align-items-center justify-content-between">
                                        <th class="border-0 ">
                                            <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
                                            DISCOUNT (@if($po->subtotal > 1)
                                            {{ round($po->discount/$po->subtotal *100,0) }}%
                                            @endif)
                                            <span class="badge badge-secondary white rounded-circle ml-2"  data-toggle="modal" data-target="#discountpop">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-sm" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_31" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                                    <g>
                                                    <rect x="234.362" y="128" width="43.263" height="256"></rect>
                                                    <rect x="128" y="234.375" width="256" height="43.25"></rect>
                                                    </g>
                                                    </svg>
                                            </span>

                                        </div>
                                        </th>
                                        <td class="border-0 justify-content-end d-flex text-danger font-size-base">- {{ number_format($po->discount) }}</td>
                                      </tr>
                                      <tr class="d-flex align-items-center justify-content-between">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
                                                VAT
                                        </th>
                                        <td class="border-0 justify-content-end d-flex text-dark font-size-base">Tsh {{ number_format($po->vat) }}</td>
                                      </tr>
                                    </tbody>
                                </table>
                                <div style="background-color: rgb(243, 243, 243); padding:6px;">
                                <table class="table">
                                    <tbody>
                                      <tr class="d-flex align-items-center justify-content-between item-price">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold ">Sub Total</th>
                                        <td class="border-0 justify-content-end d-flex  font-size-base">Tsh. {{ number_format($po->subtotal - $po->discount)}} </td>
                                      </tr>
                                      @if($ewallete && $ewallete <= $po->subtotal-$po->discount)
                                      <tr class="d-flex align-items-center justify-content-between item-price">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold text-success">Credit Note</th>
                                        <td class="border-0 justify-content-end d-flex text-success font-size-base">- {{ number_format($ewallete)}} </td>
                                      </tr>

                                      <tr class="d-flex align-items-center justify-content-between item-price">
                                        <th class="border-0 font-size-h5 mb-0 font-size-bold text-primary">Total Due</th>
                                        <input type="hidden" name="wallet" value="{{ $ewallete }}">
                                        <td class="border-0 justify-content-end d-flex text-primary font-size-base">Tsh. {{ number_format($po->subtotal - $po->discount - $ewallete)}} </td>
                                      </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                             </div>

                             @if($order_items !='[]')
                             @if($ewallete < $po->subtotal-$po->discount)
                             <label for="" class="font-size-bold"> Mode of Payment* </label>
                             <select name="status" id="pay" class="form-control" onchange="return showInstallment()" required>
                                <option value="" disabled selected> -- Select Payment mode --</option>
                                <option >Cash</option>
                                @empty($ewallete)<option>Credit</option>@endempty
                                <option>Installment</option>

                             </select>
                             <div id="installment" style="visibility:hidden" >
                             <label for="" class="font-size-bold">Enter Amount</label>
                             <input type="number" name="installment" class="form-control bg-info text-white" value="{{ $po->subtotal - $po->discount - $ewallete }}">
                            </div>
                            @else
                            <input  class="form-control bg-dark text-white text-center" name="status" type="text" value="Pay via E-wallet" readonly>
                            <input type="hidden" name="wallet" value="{{ $po->subtotal - $po->discount }}">
                             @endif
                             @if(empty($out_of_stock))
                             <div class="d-flex justify-content-end align-items-center flex-column">
                                    <input type="hidden" name="order_id"  value="{{ $pos_id }}">
                                    <input type="hidden" name="vat" value="{{ $po->vat }}">
                                    <input type="hidden" name="amount" value="{{ $po->subtotal - $po->discount }}">
                                    <input type="submit" name="shop_now" class="btn btn-primary white mb-2"  value="Submit">
                             </div>

                             @endif
                             @endif
                        </div>
                    </form>
                             </div>
                        </div>
                     </div>
                 </div>
            </div>
        </div>
   </div>
    {{-- end of a new design --}}




<!-- start of price change Modal -->
{{-- <div class="modal fade" id="editprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change price for this Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

        <table id="orderTable" class="display" style="width:100%">
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Price</th>
                    <th class=" text-right no-sort"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_items as $orderitem )
                <form action="{{ route('pos.update',$orderitem->id) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                           <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <tr>

                    <td>{{ $orderitem->item  }}</td>
                    <td>  <input  class="form-control" name="new_price" type="number" required placeholder="New Price" value="{{ $orderitem->selling_price }}">
                    </td>
                   <td>
                        <div class="card-toolbar text-right">
                        <button type="submit" class="btn btn-primary btn-sm" title="Change price" name="edit_price" value="{{ $orderitem->id }}">Change</button>
                        </div>
                    </td>
                </tr>
            </form>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
  end of price modal
            </div>
        </div> --}}
   </div>


<div class="modal fade text-left" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel14">Draft Orders</h3>
        <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
          <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
          </svg>
        </button>
      </div>
      <div class="modal-body pos-ordermain">
          <div class="row">
            @foreach ($orderings as $order)
              <div class="col-lg-4">
                  <div class="pos-order">
                    <h3 class="pos-order-title" >Order #{{  $order->id  }}</h3>
                    <div class="orderdetail-pos">
                        <p>
                            <a href="{{ route('pos.show',$order->id) }}">
                                <strong>Customer</strong>
                              {{ $order->customer_name }}</a>
                        </p>
                    </div>
                  </div>
              </div>
              @endforeach
            </div>
            </div>

          </div>
      </div>
    </div>


{{-- Start of Discount
<div class="modal fade text-left" id="discountpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel122" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel122">Add Discount</h3>
            <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
              <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
              </svg>
            </button>
          </div>
          <form action="{{ route('pos.update',$id) }}" method="POST">
              @csrf
              <input type="hidden" name="_method" value="PUT">
          <div class="modal-body">
              <div class="row">
                  <div class="col-12">
                    <label  class="text-body">Discount</label>
                    <fieldset class="form-group mb-3 d-flex">
                        <input type="hidden" name="order_id" value="{{ $id }}">
                        <input type="number" name="discount" min="0" max="{{ $po->subtotal*0.3 }}" class="form-control bg-white"  placeholder="Enter Discount">
                        <button type="submit" class="btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center">Apply</button>
                    </fieldset>
                    <input type="submit" name="discountoff" value="Reset Discount" class="btn btn-danger white pt-1 pb-1 justify-content-center">
                    <div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">

                        <h5 class="font-size-bold mb-0">Discount Applied of:</h5>
                        <h5 class="font-size-bold mb-0">Tsh. {{ $po->discount }}</h5>
                    </div>
                  </div>
              </div>
          </div>
        </form>
        </div>
    </div>
</div> --}}
</div>

<script type="text/javascript" src="../../js/jquery.js"></script>

<script>
     function numberWithCommas(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     }

function myFunction(id) {
     //alert(id);
    var urv="ur_"+(id);
    var upv="up_"+(id);
    var anQty="qty"+(id);
      var antQty="tqty"+(id);
    var aprice="price_"+(id);
      var asubtotal="subtotal_"+(id);

    var ur=document.getElementById(urv).value;
     var up=document.getElementById(upv).value;
     var unitPrice=document.getElementById(aprice).value;      
        var StoreQty=document.getElementById(antQty).value;
       

 var soldQty=numberWithCommas((ur*up).toFixed(2));
if(ur>=0 && up>=0)
{ 
//var soldQty=numberWithCommas((ur*up));
var subtotal=(unitPrice*soldQty).toFixed(2);   
   //totalCost +=subtotal;

 if(Number(soldQty)<=Number(StoreQty))
 {
  $('#'+anQty+'').val(soldQty);
  $('#'+asubtotal+'').val(subtotal);
 
}
else
{
    alert('Sold Quantity exceed the available Stock:'+ StoreQty);
    $('#'+urv+'').val(0);
    $('#'+upv+'').val(0);
     $('#'+anQty+'').val(0.00);
     $('#'+asubtotal+'').val(0.00);
     
  }
}

  var sum_amount = 0;
  $('#'+urv+'').each(function(){   
    sum_amount +=$(this).val();
    
  })  
}

function numberWithCommas(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     }

 //     function sum()
 //     {
 //        $('.amount').each(function(){
 //            alert('df');
 //    //if statement here 
 //    // use $(this) to reference the current div in the loop
 //    //you can try something like...
 //    // if(condition){
 //    // }
 // });
 //     }
</script>

