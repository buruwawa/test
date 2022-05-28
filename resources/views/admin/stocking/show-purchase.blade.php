@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">Purchase Stocks</li>
								</ol>
							</nav>
						</div>
					</div>
					<!--end::Subheader-->
					<!--begin::Entry-->
					<div class="d-flex flex-column-fluid">
						<!--begin::Container-->
						<div class="container-fluid">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="col-lg-12 col-xl-12">
											<div class="card card-custom gutter-b bg-transparent shadow-none border-0" >
												<div class="card-header align-items-center  border-bottom-dark px-0">
													<div class="card-title mb-0">
														<h3 class="card-label mb-0 font-weight-bold text-body text-right">
														</h3>
													</div>

												</div>

											</div>


										</div>
									</div>


		<div class="contentPOS">
	    <div class="container-fluid">
			<div class="row">

				<div class="col-xl-9 col-lg-8 col-md-8">
				     <div class="">
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<div class="card-body">
								<div class="d-flex  colorfull-select">


                                    {{-- Start of items --}}
                                    <div class="col-md-8">
                                        <div class="greeting-text">
                                        <h3 class="card-label mb-0 ">
                                           Order Code:#{{ $id }} </h3>
                                          <h6> Purchase from: @if(empty($suppliers->supplier_name))
                                           <script type="text/javascript">
                                            window.location = "{{ url('/pos') }}";
                                        </script>
                                           @else
                                           {{ $suppliers->supplier_name }}
                                          @endif
                                        </h6>

								</div>
								</div>
                                {{-- end of items --}}
                                {{-- Start of items --}}

                                    <div class="col-md-4">
                                        <label class="text-dark d-flex" >Select items to sell</label>
                                        <div class="form-group">
                                    <form action="{{ route('stock-purchase.store') }}" method="POST">
                                         @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">

                                       <select class="arabic-select  form-control" onchange="this.form.submit()" name="item_id" required>
                                            <option value="" selected disabled>-- Select Item --</option>
                                            @foreach ($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->item }}</option>
                                                @endforeach
                                        </select>
                                    </form>
                                    </div>
								</div>
                                {{-- end of items --}}


								</div>
							</div>
						</div>
                        @if($order_items != '[]')
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                            <form action="{{ route('stock-purchase.update',$id) }}" method="POST">
                                 <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="container" style="padding-top:20px; padding-bottom:20px;">
									<div class="table-responsive" id="">
										<table id="orderTable" class="display" style="width:100%">
											<thead>
												<tr>

                                                    <th>Name</th>
                                                    <th>Width</th>
                                                    <th>Height</th>
													<th>Quantity(M2)</th>
													<th>Unit Price</th>
													<th>Subtotal</th>

												</tr>
											</thead>
											<tbody>
                                                @foreach ($order_items as $orderitem )
												<tr>

													<td>{{ $orderitem->item  }}</td>
									<td>
                                  <input name="item_id[]" type="hidden" value="{{ $orderitem->id }}">
                         <input type="number" name="width[]" id="up_{{$orderitem->id}}" min="0" onclick="myFunction({{$orderitem->id}})" onkeyup ="myFunction({{$orderitem->id}})" class="form-control border-dark w-100px" step="0.01" value="{{ $orderitem->width }}" pattern="[0-9]+([\.,][0-9]+)?">
 </td>

   <td>
       <input type="number" name="height[]" id="ur_{{$orderitem->id}}" min="0" onclick="myFunction({{$orderitem->id}})" onkeyup="myFunction({{$orderitem->id}})" class="form-control border-dark w-100px" value="{{ $orderitem->height }}" step="0.01" pattern="[0-9]+([\.,][0-9]+)?">
  </td>


													<input name="qty[]" type="hidden" id="qty_{{$orderitem->id}}" min="0" class="form-control border-dark w-100px" placeholder="" value="{{ $orderitem->qty }}" title="" readonly>

                          <td><label id="qty2_{{$orderitem->id}}">{{ number_format($orderitem->qty,3) }}</label></td>

  
  <input name="buying_price[]" type="hidden" id="price_{{$orderitem->id}}" min="0" class="form-control border-dark w-100px" placeholder="" value="{{ $orderitem->price }}" readonly>
<td><label id="price2_{{$orderitem->id}}">{{ number_format($orderitem->price,2) }}</label></td>


 <input name="cost[]" type="hidden" id="cost_{{$orderitem->id}}" min="0" class="form-control border-dark w-100px" value="{{ $orderitem->cost }}" readonly>

<td><label id="cost2_{{$orderitem->id}}">{{ number_format($orderitem->cost,2) }}</label></td>
												</tr>
                                                @endforeach
											</tbody>
                                            <tfoot>

                                                <th></th>
                                                <th></th>
                                                <th>Total Tsh.</th>
                                                <th> @foreach ($pos as $por){{ number_format($por->subtotal) }}@endforeach</th>
                                        </tfoot>
										</table>
									</div>
                                    <hr>


                                    <div class="form-group row mb-0">

										<div class="col-md-6 btn-submit d-flex ">

                                            <button type="button" class="btn btn-secondary white" data-toggle="modal" data-target="#edit">
                                             <i class="fa fa-trash"></i>   Delete Items
                                            </button>
                                        </div>
                                        <div class="col-md-6 btn-submit d-flex justify-content-end">

											<button type="submit" class="btn btn-success white " name="draft" value="save draft">
												<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
													<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
												  </svg>
												Draft Order
											</button>
										</div>
									</div>



								</div>
                            </form>
						</div>
                        @endif
					 </div>
				 </div>
                 @if($order_items != '[]')
				 <div class="col-xl-3 col-lg-4 col-md-4">
					 <div class="card card-custom gutter-b bg-white border-0">
                         <form action="{{ route('stock-purchase.store') }}" method="POST">
                            @csrf
						<div class="card-body" >
							<div class="shop-profile">
								<div class="media">

									<div class="media-body ml-3">
										<h3 class="title font-weight-bold">Purchase Order </h3>

									</div>
								</div>
							</div>
							<div class="resulttable-pos">
								<table class="table right-table">

									<tbody>
                                        @foreach ($pos as $po)


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
										<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
												VAT

										</th>
										<td class="border-0 justify-content-end d-flex text-dark font-size-base">Tsh {{ number_format($po->vat) }}</td>

									  </tr>


									  <tr class="d-flex align-items-center justify-content-between item-price">
										<th class="border-0 font-size-h5 mb-0 font-size-bold text-primary">

												TOTAL
										</th>
										<td class="border-0 justify-content-end d-flex text-primary font-size-base">Tsh. {{ number_format($po->subtotal - $po->discount)}} </td>

									  </tr>
                                      @endforeach
									</tbody>
								  </table>
							 </div>
                             <label for="" class="font-size-bold"> Mode of Payment* </label>
                             <select name="status" id="pay" class="form-control" onchange="return showInstallment()" required>
                                <option value="" disabled selected> -- Select Payment mode --</option>
                                <option>Cash</option>
                                <option>Credit</option>
                                <option>Installment</option>

                             </select>
                             <div id="installment" style="visibility:hidden" >
                                <label for="" class="font-size-bold">Enter Amount</label>
                                <input type="number" name="installment" class="form-control bg-info text-white" value="{{ $po->subtotal - $po->discount }}">
                            </div>
                             <hr>
							 <div class="d-flex justify-content-end align-items-center flex-column">
                                    <input type="hidden" name="warehouse_id"  value="{{ $suppliers->warehouse_id }}">
                                    <input type="hidden" name="order_id"  value="{{ $id }}">
                                    <input type="hidden" name="vat" value="{{ $po->vat }}">
                                    <input type="hidden" name="amount" value="{{ $po->subtotal - $po->discount }}">
									<input type="submit" class="btn btn-primary white mb-2" name="purchase_now"  value="Submit">
							 </div>
						</div>
                    </form>
					 </div>
				 </div>
                 @endif
			</div>
		</div>
   </div>
{{-- End of show --}}
<!-- start of delete Modal -->
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete items from this order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="resulttable-pos">
            <table id="orderTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th class=" text-right no-sort"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_items as $orderitem )
                    <tr>
                        <td>{{ $orderitem->id }}</td>
                        <td>{{ $orderitem->item  }}</td>

                        <td>
                        <form action="{{ route('stock-purchase.destroy',$orderitem->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                            <div class="card-toolbar text-right">
                                <input type="hidden" name="order_id" value="{{ $orderitem->id }}">
                            <button class="btn-sm btn btn-danger" title="Delete" type="submit" name="delete" value="delet this item"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </form>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        </div>

      </div>
    </div>
  </div>
  {{-- end of delete modal --}}


								</div>
							</div>
						</div>


					</div>

				</div>

<script>
       // installment calc.
       function showInstallment(){
        var selectBox = document.getElementById('pay');
        var userInput = selectBox.options[selectBox.selectedIndex].value;
        if(userInput =='Installment'){
            document.getElementById('installment').style.visibility='visible';
        }
        else{
            document.getElementById('installment').style.visibility='hidden';
        }
    }
</script>



<script type="text/javascript" src="../../js/jquery.js"></script>

<script>
     function numberWithCommas(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     }

function myFunction(id) {
  //alert(id);
    var urv="ur_"+(id);
    var upv="up_"+(id);
    var anQty="qty_"+(id);
     var anQty2="qty2_"+(id);
      //var antQty="tqty"+(id);
    var aprice="price_"+(id);
    var aprice2="price2_"+(id);

      var subtotal="cost_"+(id);
      var subtotal2="cost2_"+(id);

    var ur=document.getElementById(urv).value;
 var up=document.getElementById(upv).value;
//alert(subtotal);
    
     var unitPrice=document.getElementById(aprice).value;      
    //var StoreQty=document.getElementById(subtotal).value;
   
 // document.getElementById(subtotal).innerHTML=344;  
if(ur>=0 && up>=0)
{
 var totalQty=(ur*up);
  var costs=(ur*up*unitPrice);
//var soldQty=numberWithCommas((ur*up));
//var subtotal=(unitPrice*soldQty).toFixed(2);   
   //totalCost +=subtotal;

  //alert(costs);
//  $('#'+subtotal+'').val(costs);
  $('#'+anQty+'').val(totalQty);
   $('#'+subtotal+'').val(costs);
document.getElementById(subtotal2).innerHTML=numberWithCommas((ur*up*unitPrice).toFixed(2));
document.getElementById(anQty2).innerHTML=numberWithCommas((ur*up).toFixed(3));
 //alert(costs);

//  if(Number(soldQty)<=Number(StoreQty))
//  {
//   $('#'+anQty+'').val(soldQty);
//   $('#'+asubtotal+'').val(subtotal);
 
// }
// else
// {
//     alert('Sold Quantity exceed the available Stock:'+ StoreQty);
//     $('#'+urv+'').val(0);
//     $('#'+upv+'').val(0);
//      $('#'+anQty+'').val(0.00);
//      $('#'+asubtotal+'').val(0.00);
     
//   }
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


</body>
<!--end::Body-->

</html>
@endsection
