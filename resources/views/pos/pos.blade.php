<!DOCTYPE html>
<!--
Template Name: Kundol Admin - Bootstrap 4 HTML Admin Dashboard Theme
Author: Themescoder
Website: http://www.themescoder.net/
Contact: support@themescoder.net

<html lang="en">
begin::Head-->

<head>

	<meta charset="utf-8" />
	<title>POS | Point of Sale </title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!--begin::Fonts-->
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> -->
	<!--end::Fonts-->

		<!--begin::Global Theme Styles(used by all pages)-->
        <link href="../../../assets/css/style.css?v=1.0" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->

        <link href="../../../assets/api/pace/pace-theme-flat-top.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/api/mcustomscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/api/datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/css/multiple-select.min.css" rel="stylesheet">
        <link href="../../../assets/css/daterangepicker.css" rel="stylesheet">



		<link rel="shortcut icon" href="../../assets/images/misc/logo.svg" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed">


   <header class="pos-header bg-white">
	   <div class="container-fluid">
		   <div class="row align-items-center">
			   <div class="col-xl-4 col-lg-4 col-md-6">
				   <div class="greeting-text">
                       <a href="/admin">
					<h3 class="card-label mb-0 font-weight-bold text-primary">Dashboard
					</h3></a>
					<h3 class="card-label mb-0 ">
                        {{ Auth::user()->name }}
					</h3>
				   </div>

			   </div>
			   <div class="col-xl-4 col-lg-5 col-md-6  clock-main">
				<div class="clock">
				  <div class="datetime-content">
					<ul>
						<li id="hours"></li>
						<li id="point1">:</li>
						<li id="min"></li>
						<li id="point">:</li>
						<li id="sec"></li>
					</ul>
				  </div>
				 <div class="datetime-content">
					<div id="Date"  class=""></div>
				 </div>

				</div>

			   </div>
			   <div class="col-xl-4 col-lg-3 col-md-12  order-lg-last order-second">

				<div class="topbar justify-content-end">
				 <div class="dropdown mega-dropdown">
					 <div id="id2" class="topbar-item "  data-toggle="dropdown" data-display="static">
						 <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3">

							 <span class="symbol symbol-35 symbol-light-success">
								 <span class="symbol-label bg-primary  font-size-h5 ">

									 <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#fff" class="bi bi-calculator-fill" viewBox="0 0 16 16">
										 <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
									   </svg>
								 </span>
							 </span>
						 </div>
					 </div>

					 <div class="dropdown-menu dropdown-menu-right calu" style="min-width: 248px;">
						 <div class="calculator">
							 <div class="input" id="input"></div>
							 <div class="buttons">
							   <div class="operators">
								 <div>+</div>
								 <div>-</div>
								 <div>&times;</div>
								 <div>&divide;</div>
							   </div>
								<div class="d-flex justify-content-between">
								 <div class="leftPanel">
									 <div class="numbers">
									   <div>7</div>
									   <div>8</div>
									   <div>9</div>
									 </div>
									 <div class="numbers">
									   <div>4</div>
									   <div>5</div>
									   <div>6</div>
									 </div>
									 <div class="numbers">
									   <div>1</div>
									   <div>2</div>
									   <div>3</div>
									 </div>
									 <div class="numbers">
									   <div>0</div>
									   <div>.</div>
									   <div id="clear">C</div>
									 </div>
								   </div>
								   <div class="equal" id="result">=</div>
								</div>
							 </div>
						   </div>
					 </div>

				 </div>

					<div class="topbar-item folder-data">
					 <div class="btn btn-icon  w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3"  data-toggle="modal" data-target="#folderpop"
					 >
						 <span class="badge badge-pill badge-primary">
                             {{ count($orders)}}
                         </span>
						 <span class="symbol symbol-35  symbol-light-success">
							 <span class="symbol-label bg-warning font-size-h5 ">
								 <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#ffff"  viewBox="0 0 16 16">
									 <path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"></path>
								   </svg>
							 </span>
						 </span>
					 </div>

					</div>

				 <div class="dropdown">
					 <div class="topbar-item" data-toggle="dropdown" data-display="static">
						 <div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0">

							 <span class="symbol symbol-35 symbol-light-success">
								 <span class="symbol-label font-size-h5 ">
									 <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										 <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
									 </svg>
								 </span>
							 </span>
						 </div>
					 </div>

					 <div class="dropdown-menu dropdown-menu-right" style="min-width: 150px;">


						 <a href="#" class="dropdown-item">
							 <span class="svg-icon svg-icon-xl svg-icon-primary mr-2">
								 <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power">
									 <path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
									 <line x1="12" y1="2" x2="12" y2="12"></line>
								 </svg>
							 </span>
							 Logout
						 </a>
					 </div>

				 </div>
				</div>

				</div>
		   </div>
	   </div>
   </header>



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
                                    <label class="text-dark d-flex" >Create New Customer
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
                                        <form action="{{ route('pos.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                    <button type="submit" class="btn btn-primary"> Sell <i class="fa fa-angle-right"></i></button>
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
                                         <a href="{{ route('possale',$order->id) }}"><i class="fa fa-angle-right"></i>
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
</html>
