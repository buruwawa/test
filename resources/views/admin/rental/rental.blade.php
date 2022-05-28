@extends('layouts.app')
@section('content')
<!--begin::Body-->

<body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed">
   <div class="contentPOS">
	    <div class="container-fluid">
			<div class="row">
                @if($orders !='[]')
                <div class="col-xl-9 col-lg-8 col-md-8">
                    @else
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        @endif
				 <div class="">

                    @if($message= Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span></button>
                        <strong>Well done!</strong> {{ $message }}
                    </div>
                    @endif
                    @if($message= Session::get('delete'))
                    <div class="alert alert-danger" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span></button>
                        <strong>Attention!</strong> {{ $message }}
                    </div>
                    @endif
                    @if($message= Session::get('error'))

                    <div class="alert alert-danger" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&times;</span></button>
                        <strong>Sorry!</strong> {{ $message }}
                    </div>
                    @endif

{{-- Validation error message --}}
                    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    <div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                        <div class="card-body">
                            <div class="d-flex justify-content-between colorfull-select">
                                <div class="selectmain">
                                    <label class="text-dark d-flex" >Register New Customer
                                        <span class="badge badge-secondary white rounded-circle"  data-toggle="modal" data-target="#choosecustomer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-sm" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_122" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                                            <g>
                                            <rect x="234.362" y="128" width="43.263" height="256"></rect>
                                            <rect x="128" y="234.375" width="256" height="43.25"></rect>
                                            </g>
                                            </svg>
                                        </span>


                                </div>


                            </div>
                        </div>
                        </div>


		<div class="card card-custom gutter-b bg-white border-0 table-contentpos">

{{-- Start of datatable --}}
<div class="col-12 ">
    <div class="" >
        <div class="card-body" >
            <div >
                <div class=" table-responsive table-hover" id="printableTable">
                    <table id="productUnitTable" class="table table-hover">

                        <thead class="text-body">
                            <tr>

                                <th class="d-none d-lg-block">#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th class="d-none d-md-block">Location</th>
                                <th class=" text-right no-sort">Action</th>

                            </tr>
                        </thead>
                        <tbody class="kt-table-tbody text-dark">
                            @foreach ($customers as $customer)
                            <tr>
                                <td class="d-none d-lg-block">{{ $customer->id }}</td>
                                <td>{{ $customer->customer_name }}</td>

                                <td>{{ $customer->phone }}</td>
                                <td class="d-none d-md-block">{{ $customer->location }}</td>
                                <td>
                                    <div class="card-toolbar text-right">
                                        <form action="{{ route('createOrder') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                    <button type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-angle-right"></i></button>
                                        </form>
                                </div>
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
{{-- end of datatable --}}


						</div>
					 </div>
				 </div>
                 @if($orders !='[]')
				 <div class="col-xl-3 col-lg-4 col-md-4 d-none d-md-block">
					 <div class="card card-custom gutter-b bg-white border-0">
						<div class="card-body" >
							<div class="shop-profile">
								<div class="media">
                                    <h2>Pending Order</h2>
								</div>
							</div>
                            @foreach ($orders as $order)
							<div class="resulttable-pos">


                                    <form action="{{ route('sales.destroy',$order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="delete">
                                         <a href="{{ route('stock-rent.show',$order->id) }}"><i class="fa fa-angle-right"></i>
                                        Order:#{{ $order->id }} - Customer: {{ $order->customer_name }} </a>
                                            <button class="btn btn-danger btn-sm float-right" title="delete this order" type="submit" onclick="return confirm('Are you sure you want to delete this customer?')">
                                                <span class="fa fa-trash"><span></button>
                                                </div>
                                        </form>

                             @endforeach


						</div>
					 </div>
				 </div>
                 @endif
			</div>




		</div>
   </div>

   <div class="modal fade text-left" id="payment-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h3 class="modal-title" id="myModalLabel11">Payment</h3>
			<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
			  <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
			  </svg>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table right-table">
				<tbody>
				  <tr class="d-flex align-items-center justify-content-between">
					<th class="border-0 px-0 font-size-lg mb-0 font-size-bold text-primary">

							Total Amount to Pay :

					</th>
					<td class="border-0 justify-content-end d-flex text-primary font-size-lg font-size-bold px-0 font-size-lg mb-0 font-size-bold text-primary">

							$722

					</td>
				  </tr>
				  <tr class="d-flex align-items-center justify-content-between">
					<th class="border-0 px-0 font-size-lg mb-0 font-size-bold text-primary">

							Payment Mode :

					</th>
					<td class="border-0 justify-content-end d-flex text-primary font-size-lg font-size-bold px-0 font-size-lg mb-0 font-size-bold text-primary">

						   Cash

					</td>

				  </tr>
				</tbody>
			</table>
		  </div>
		</div>
	</div>
</div>

   <div class="modal fade text-left" id="choosecustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h3 class="modal-title" id="myModalLabel13">Add Customer</h3>
			<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
			  <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
			  </svg>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="{{ route('customers.store') }}" method="POST">
                @csrf
				<div class="form-group row">

					<div class="col-md-6">
						<label  class="text-body">Customer Name <span class="text-danger"> * </span></label>
						<fieldset class="form-group mb-3">
							<input type="text" name="customer_name"  class="form-control"  placeholder="Enter Customer Name" required>
						</fieldset>
					</div>
                    <div class="col-md-6">
						<label  class="text-body">Company Name</label>
						<fieldset class="form-group mb-3">
							<input type="text" name="company_name"  class="form-control"  placeholder="Enter Company Name">
						</fieldset>
					</div>

				</div>
				<div class="form-group row">

					<div class="col-md-6">
						<label  class="text-body">TIN Number <span class="text-danger"> * </span></label>
						<fieldset class="form-group mb-3">
							<input type="number" name="tin"  class="form-control"  placeholder="Enter TIN" required>
						</fieldset>
					</div>

					<div class="col-md-6">
						<label  class="text-body">VRN Number</label>
						<fieldset class="form-group mb-3">
							<input type="number" name="vrn"  class="form-control"  placeholder="Enter VRN">
						</fieldset>
					</div>
				</div>
				<div class="form-group row">
                    <div class="col-md-6">
						<label  class="text-body">Email</label>
						<fieldset class="form-group mb-3">
							<input type="email" name="email"  class="form-control"  placeholder="Enter Mail">
						</fieldset>
					</div>
					<div class="col-md-6">
						<label  class="text-body">Phone Number <span class="text-danger"> * </span></label>
						<fieldset class="form-group mb-3">
							<input type="number" name="phone"  class="form-control"  placeholder="Enter Phone Number" required>
						</fieldset>
					</div>


				</div>
                <div class="form-group row">
                <div class="col-md-6">
                    <label  class="text-body">Location <span class="text-danger"> * </span></label>
                    <fieldset class="form-group mb-3">
                        <input type="text" name="location"  class="form-control"  placeholder="Enter Location" required>
                    </fieldset>
                </div>
                </div>
				<div class="form-group row justify-content-end mb-0">
					<div class="col-md-6  text-right">
						<button type="submit" class="btn btn-primary">Add Customer</a>
					</div>
				</div>
			</form>
		  </div>
		</div>
	</div>
</div>
   <div class="modal fade text-left" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
          <div class="modal-body pos-ordermain">
              <div class="row">
                @foreach ($orders as $order)
                  <div class="col-lg-4">
                      <div class="pos-order">
                        <h3 class="pos-order-title" >Order # {{  $order->id  }}</h3>
                        <div class="orderdetail-pos">
                            <p>
                                <a href="{{ route('stock-rent.show',$order->id) }}">
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




<script src="../../../assets/js/plugin.bundle.min.js"></script>
<script src="../../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/js/multiple-select.min.js"></script>
<script src="../../../assets/js/jquery.datatables.min.js"></script>
<script src="../../../assets/js/sweetalert.js"></script>
<script src="../../../assets/js/sweetalert1.js"></script>
<script src="../../../assets/js/script.bundle.js"></script>





	<script>
		  jQuery(function() {
			jQuery('.arabic-select').multipleSelect({
		  filter: true,
		  filterAcceptOnEnter: true
		})
	  });
	  jQuery(function() {
			jQuery('.js-example-basic-single').multipleSelect({
		  filter: true,
		  filterAcceptOnEnter: true
		})
	  });
	  jQuery(document).ready(function() {
		jQuery('#orderTable').DataTable({

			"info":     false,
			"paging":   false,
			"searching": false,

		"columnDefs": [ {
		  "targets"  : 'no-sort',
		  "orderable": false,
		}]
		});
	} );
	</script>
    <script>
        jQuery(function() {
            jQuery('.english-select').multipleSelect({
          filter: true,
          filterAcceptOnEnter: true
        })
      });
      jQuery(function() {
            jQuery('.arabic-select').multipleSelect({
          filter: true,
          filterAcceptOnEnter: true
        })
      });
    jQuery(document).ready( function () {
        jQuery('#productUnitTable').dataTable( {
        "pagingType": "simple_numbers",

        "columnDefs": [ {
          "targets"  : 'no-sort',
          "orderable": false,
        }]
    });
    });

    jQuery(function() {

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        jQuery('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    jQuery('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    });
    </script>

</body>
<!--end::Body-->


</html>
@endsection
