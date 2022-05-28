<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<head>

	<meta charset="utf-8" />
	<title>Admin | Dashboard</title>
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


	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed">
   <!-- Paste this code after body tag -->
   <div class="se-pre-con">
	<div class="pre-loader">
	  <img class="img-fluid" src="../assets/images/loadergif.gif" alt="loading">
	</div>
  </div>
   <!-- pos header -->

   <header class="pos-header bg-white">
	   <div class="container-fluid">
		   <div class="row align-items-center">
			   <div class="col-xl-4 col-lg-4 col-md-6">
				   <div class="greeting-text">
                    <a href="/pos">
                        <h3 class="card-label mb-0 font-weight-bold text-primary">POS
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
						 <span class="badge badge-pill badge-primary">{{ count($orderings) }}</span>
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
   <div class="contentPOS">




    {{-- start of a new design --}}
    <div class="contentPOS">
	    <div class="container-fluid">
			<div class="row">
				<div class="col-xl-4 order-xl-first order-last">
					<div class="card card-custom gutter-b bg-white border-0">
						<div class="card-body">
							<div class="d-flex justify-content-between colorfull-select">


								<div>


								</div>

							</div>
                            <h4 class="title font-weight-bold text-center">Items List</h4>
                            <hr>
						</div>




							<div class="product-items">
								<div class="row">

                                    @foreach ($items as $item)
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
										<div class="productCard">
											<div class="productContent">
                                                <form action="{{ route('stock-rent.store') }}" method="POST">
                                                    @csrf
                                            <input type="hidden" name="id" id="" value="{{ $id }}">
                                            <input type="hidden" name="item_id" id="" value="{{ $item->item_id }}">
                                            <button type="submit" name="item_name" value="" class="btn btn-primary" style="min-width: 100%">
                                                {{ $item->item }} <i class="fa fa-shopping-cart float-right"></i></button>
											</div>
                                    </form>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>



					</div>
				</div>
				<div class="col-xl-5 col-lg-8 col-md-8">
				     <div class="">



						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<div class="card-body">
								<div class="d-flex justify-content-between colorfull-select">
									<div class="selectmain">

                                            <div class="greeting-text">
                                            <h3 class="card-label mb-0 ">
                                               Order Code:#{{ $id }} </h3>
                                              <h6> Order for: @if(empty($customers->customer_name))
                                               <script type="text/javascript">
                                                window.location = "{{ url('/pos') }}";
                                            </script>
                                               @else
                                               {{ $customers->customer_name }}
                                              @endif
                                            </h6>
                                    </div>
									</div>

								<div class="d-flex flex-column selectmain">
                                    <label for="">
                                        Select items to sell
                                    </label>

                                    <form action="{{ route('pos.store') }}" method="POST">
                                        @csrf
                                <input type="hidden" name="id" id="" value="{{ $id }}">
                                <select class="arabic-select select-down" onchange="this.form.submit()" name="item_id">
                                    @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->item }}</option>
                                        @endforeach
                                </select>
                            </form>
								</div>
								</div>
							</div>
						</div>


						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<div class="card-body" >
								<div class="form-group row mb-0">
									<div class="col-md-12">
										<label >Select Product</label>
										<fieldset class="form-group mb-0 d-flex barcodeselection">
											<select class="form-control w-25" id="exampleFormControlSelect1">
												<option>Name</option>
												<option>SKU</option>
											  </select>
											<input type="text" class="form-control border-dark" id="basicInput1" placeholder="">
										</fieldset>
									</div>
								</div>
							</div>
								<div class="table-datapos">

									<div class="table-responsive" id="printableTable">
										<table id="orderTable" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Name</th>
													<th>Fee</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Total</th>
													<th class=" text-right no-sort">Action</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach ($order_items as $orderitem )
												<tr>
													<td>{{ $orderitem->item  }}</td>
													<td>

                                                        @if($orderitem->stock_qty < $orderitem->qty)
                                                        <p class="text-danger">Out of stock
                                                            <?php
                                                            $out_of_stock = 1;
                                                            ?>
                                                        @else
                                                        <input name="item_id[]" type="hidden" value="{{ $orderitem->id }}">
														<input name="qty[]" type="number" min="1" max="{{ $orderitem->stock_qty }}" class="form-control border-dark w-100px" id="basicInput2" placeholder="" value="{{ $orderitem->fee }}" title="Available stock is {{ $orderitem->stock_qty }}">
                                                        @endif
                                                    </p>
													</td>
													<td><input type="date" name="start_date" id="" required></td>
													<td><input type="date" name="end_date" id=""  onselect="this.form.submit()"></td>
													<td>{{number_format($orderitem->selling_price * $orderitem->qty) }}</td>
													<td>
                                                        <form action="{{ route('pos.destroy',$orderitem->id) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete">
                                                        <div class="card-toolbar text-right">
                                                            <input type="hidden" name="order_id" value="{{ $orderitem->id }}">
                                                        <button class="btn-sm btn btn-danger " title="Delete" type="submit" onclick="confirm('Are you sure you want to delete this item')" name="delete" value="delete this item"><i class="fas fa-trash-alt"></i></button>
                                                        </div>
                                                    </form>
													</td>
												</tr>
                                                @endforeach


											</tbody>
										</table>
									</div>

								</div>
								<div class="card-body" >
                                    <form action="{{ route('pos.update',$id) }}" method="POST">
                                        <input type="hidden" name="_method" value="PUT">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="form-group row mb-0">
										<div class="col-md-12 btn-submit d-flex justify-content-end">
											<button type="submit" class="btn btn-danger mr-2 confirm-delete" title="Delete">
												<i class="fas fa-trash-alt mr-2"></i>
												Suspand/Cancel
											</button>
											<button type="submit" class="btn btn-secondary white">
												<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
													<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
												  </svg>
												Draft Order
											</button>
										</div>
									</div>
                                </form>
								</div>


						</div>
					 </div>
				 </div>
				 <div class="col-xl-3 col-lg-4 col-md-4">
					 <div class="card card-custom gutter-b bg-white border-0">
						<div class="card-body" >
							<div class="shop-profile">
								<div class="media">
									<div class="bg-primary w-100px h-100px d-flex justify-content-center align-items-center">
										<h2 class="mb-0 white">K</h2>
									</div>
									<div class="media-body ml-3">
										<h3 class="title font-weight-bold">The Kundol Shop</h3>
										<p class="phoonenumber">
											02199+(070)234-4569
										</p>
										<p class="adddress">
											Russel st 50,Bostron,MA
										</p>
										<p class="countryname">USA</p>
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
                                        @endforeach
									</tbody>
								  </table>
							 </div>


						</div>
                        {{-- @if($order_items !='[]')
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
                                    <input type="hidden" name="order_id"  value="{{ $id }}">
                                    <input type="hidden" name="vat" value="{{ $po->vat }}">
                                    <input type="hidden" name="amount" value="{{ $po->subtotal - $po->discount }}">
									<button type="submit" name="shop_now" class="btn btn-primary white mb-2"  value="Submit"> <i class="fas fa-money-bill-wave mr-2"></i> Submit</button>
							 </div>

                             @endif
                             @endif --}}

					 </div>
				 </div>
			</div>
		</div>
   </div>
    {{-- end of a new design --}}


	    <div class="container-fluid">
			<div class="row">

                <div class="col-xl-2 col-lg-2 col-md-2">
                    <div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                        <div class="card-body">
                            <div class="greeting-text">
                                <h3 class="card-label mb-0 ">
                            <h6> Items list </h6>
                                </h3>
                            </div>
                            <div class="d-flex  colorfull-select">
                    <table class="table ">
                        <thead>
                            <tr>
                            <td>Item Name</td>

                        </tr>
                        </thead>
                        <tbody>@foreach ($items as $item)
                            <tr>
                                <td>
                                    <form action="{{ route('pos.store') }}" method="POST">
                                        @csrf
                                <input type="hidden" name="id" id="" value="{{ $id }}">
                                <input type="hidden" name="item_id" id="" value="{{ $item->id }}">
                                <button type="submit" name="item_name" value="" class="btn btn-sm btn-outline-success" style="min-width: 100%">
                                    {{ $item->item }} <i class="fa fa-angle-right float-right"></i></button>

                            </form>



                                    {{-- {{ $item->item }} --}}
                               </td>


                            </tr> @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>
				<div class="col-xl-6 col-lg-6 col-md-6">
				     <div class="">
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<div class="card-body">
								<div class="d-flex  colorfull-select">

                                    {{-- Start of items --}}
                                    <div class="col-md-5">
                                        <div class="greeting-text">
                                        <h3 class="card-label mb-0 ">
                                           Order Code:#{{ $id }} </h3>
                                          <h6> Order for: @if(empty($customers->customer_name))
                                           <script type="text/javascript">
                                            window.location = "{{ url('/pos') }}";
                                        </script>
                                           @else
                                           {{ $customers->customer_name }}
                                          @endif
                                        </h6>

								</div>
								</div>
                                {{-- end of items --}}
                                {{-- Start of items --}}
                                    <div class="col-md-4">

                                        <label class="text-dark d-flex" >Select items to sell</label>
                                        <div class="form-group">
                                    <form action="{{ route('pos.store') }}" method="POST">
                                                @csrf
                                        <input type="hidden" name="id" id="" value="{{ $id }}">
                                        <select class="arabic-select  form-control" onchange="this.form.submit()" name="item_id">
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
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
                            <form action="{{ route('pos.update',$id) }}" method="POST">
                                 <input type="hidden" name="_method" value="PUT">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="">
									<div class="table-responsive" id="printableTable">
										<table id="orderTable" class="display" style="width:100%">
											<thead>
												<tr>
                                                    <th>Name</th>
													<th>Quantity</th>
													<th>Unit Price</th>
													<th>Subtotal</th>
												</tr>
											</thead>
											<tbody>
                                                @foreach ($order_items as $orderitem )
												<tr>
													<td>{{ $orderitem->item  }}</td>
													<td>
                                                        @if($orderitem->stock_qty < $orderitem->qty)
                                                        <p class="text-danger">Out of stock
                                                            <?php
                                                            $out_of_stock = 1;
                                                            ?>
                                                        @else
                                                        <input name="item_id[]" type="hidden" value="{{ $orderitem->id }}">
														<input name="qty[]" type="number" min="1" max="{{ $orderitem->stock_qty }}" class="form-control border-dark w-100px" id="basicInput2" placeholder="" value="{{ $orderitem->qty }}" title="Available stock is {{ $orderitem->stock_qty }}">
                                                        @endif
                                                    </p>
                                                    </td>
													<td> {{ $orderitem->selling_price }}</td>
													<td>{{number_format($orderitem->selling_price * $orderitem->qty) }}</td>

												</tr>
                                                @endforeach


											</tbody>
                                            <tfoot>
                                                <th></th>
                                                <th></th>
                                                <th>Total</th>
                                                <th> @foreach ($pos as $por){{ number_format($por->subtotal) }}@endforeach</th>
                                        </tfoot>
										</table>
									</div>


                                    @if($order_items !='[]')
                                    <div class="form-group row mb-0">
										<div class="col-sm-6 col-md-6 col-xs-6 btn-submit d-flex ">
                                            <div class="card-toolbar text-right">
                                                <button class="btn btn-outline-primary  p-0 shadow-none float-left"  style="margin:0px 0px 40px 10px; padding: 0 10px 0 10px !important;" type="button" id="dropdowneditButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 Action <span class="svg-icon">
                                                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-three-dots text-body" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                                        </svg>
                                                    </span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdowneditButton2"  style="position: absolute; transform: translate3d(1001px, 111px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                    <a href="javascript:void(0)" class="dropdown-item btn btn-success" data-toggle="modal"  data-target="#editprice" > <i class="fa fa-edit"></i>  Edit Prices</a>
                                                        <button type="button" class="dropdown-item " data-toggle="modal" data-target="#edit">
                                                            <i class="fa fa-trash"></i>   Delete Items
                                                           </button>
                                                </div>
                                                </div>
                                             </div>
                                        <div class="col-sm-6 col-md-6 col-xs-6 btn-submit d-flex justify-content-end">

											<button type="submit" class="btn btn-success white " name="draft" value="save draft">
												<svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
													<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"/>
												  </svg>
												Draft Order
											</button>
										</div>
									</div>
                                    @endif
								</div>
                            </form>
						</div>
					 </div>
				 </div>
<!-- start of price change Modal -->
<div class="modal fade" id="editprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    </div>
  </div>
  {{-- end of price modal --}}


				 <div class="col-xl-4 col-lg-4 col-md-4">
					 <div class="card card-custom gutter-b bg-white border-0">
                         <form action="{{ route('pos.store') }}" method="POST">
                            @csrf
						<div class="card-body" >
							<div class="shop-profile">
								<div class="media">

									<div class="media-body ml-3">
										<h3 class="title font-weight-bold">Shop Order @if($ewallete>0) <span class="btn btn-outline-success"> <span class="fa fa-wallet" style="font-size: 14px !important"> Tsh. {{ number_format($ewallete) }}</span></span> @endif</h3>

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
                                      @endforeach
									</tbody>
								  </table>
                                </div>
							 </div>

                             {{-- @if($order_items !='[]')
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
                                    <input type="hidden" name="order_id"  value="{{ $id }}">
                                    <input type="hidden" name="vat" value="{{ $po->vat }}">
                                    <input type="hidden" name="amount" value="{{ $po->subtotal - $po->discount }}">
									<input type="submit" name="shop_now" class="btn btn-primary white mb-2"  value="Submit">
							 </div>

                             @endif
                             @endif --}}
						</div>
                    </form>
					 </div>
				 </div>
			</div>
		</div>
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
                        <form action="{{ route('pos.destroy',$orderitem->id) }}" method="POST">
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
						{{-- <input type="number" name="discount" min="0" max="{{ $po->subtotal*0.3 }}" class="form-control bg-white"  placeholder="Enter Discount"> --}}
						<button type="submit" class="btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center">Apply</button>
					</fieldset>
                    <input type="submit" name="discountoff" value="Reset Discount" class="btn btn-danger white pt-1 pb-1 justify-content-center">
					<div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">

						<h5 class="font-size-bold mb-0">Discount Applied of:</h5>
						{{-- <h5 class="font-size-bold mb-0">Tsh. {{ $po->discount }}</h5> --}}
					</div>
				  </div>
			  </div>
		  </div>
        </form>
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

</body>
<!--end::Body-->


</html>
