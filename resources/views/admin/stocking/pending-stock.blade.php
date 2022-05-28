@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">Issued Stocks</li>
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
														<h3 class="card-label mb-0 font-weight-bold text-body">Issued Stocks
														</h3>
													</div>
												    <div class="icons d-flex">
                                                        {{-- <button  class="btn ml-2 p-0 kt_notes_panel_toggle"
														  data-toggle="tooltip" title="" data-placement="right"
																			data-original-title="Check out more demos" >
															<span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm ">

																<svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-plus white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
																  </svg>
															</span>

														</button> --}}

														<a href="#" onclick="printDiv()" class="ml-2">
															<span class="icon h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center rounded-circle ">
																<svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-printer-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5z"/>
																	<path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
																	<path fill-rule="evenodd" d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
																  </svg>
															</span>

														</a>
														<a href="#" class="ml-2" >
															<span class="icon h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center rounded-circle ">
																<svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-file-earmark-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
																  </svg>
															</span>

														</a>

													</div>
												</div>

											</div>


										</div>
									</div>
									<div class="row">

										<div class="col-12 ">
											<div class="card card-custom gutter-b bg-white border-0" >
												<div class="card-body" >
													<div >
														<div class=" table-responsive" id="printableTable">
															<table id="orderTable" class="display" style="width:100%">

											<thead class="text-body">
																	<tr>
																	<th>Item Name</th>
																	<th>Trans_no</th>
																	<th>From store</th>
                                                                        <th>QTY Issued</th>
                                                                        <th>To Store</th>
                                                                        <th>Trans. Type</th>
																		<th>Action</th>
																	</tr>
																</thead>
																<tbody class="kt-table-tbody text-dark">
                                              @foreach ($pendingStocks as $stock)
																	<tr class="kt-table-row kt-table-row-level-0">
											<td>{{ $stock->item }}</td>
											<td>{{ $stock->trans_no }}</td>
											<td>{{ $stock->from_store }}</td>
											<td>{{ $stock->Qty_issued }}</td>
										<td>{{ $stock->to_store }}</td>
										<td>{{ $stock->trans_type }}</td>
														<td>


    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-success btn-xs" data-toggle="modal" data-target="#issue{{ $stock->pending_id }}">
    <i class="fa fa-angle-down"></i> Receive
 </button>

  <a href="{{ route('pending.destroy',$stock->pending_id) }}" role="button" onclick="return confirm('Are you sure? You want to delete Item : {{ $stock->item}}','Destroy')" class="btn btn-sm btn-danger btn-xs"  data-target="#issue{{ $stock->pending_id }}">
    <i class="fa fa-share"></i> Cancel
  </a>
   
  <!-- Modal -->
  <div class="modal fade" id="issue{{ $stock->pending_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Receive Stock::  {{ $stock->item }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                 <h5>From: {{ $stock->from_store }}</h5>
            <form action="{{ route('stocking.store') }}" method="POST">
            <!-- <form action="{{ route('pending') }}" method="POST"> -->
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" name="item_id" class="form-control" value="{{ $stock->item_id }}">
                            <input type="hidden" name="pending_id" class="form-control" value="{{ $stock->pending_id }}">
                             <input type="hidden" name="pending_qty" class="form-control" value="{{ $stock->Qty_issued }}">

                            <input type="hidden" name="from" class="form-control" value="{{ $stock->from_store }}">                              
                        </div>

                        <div class="form-group">
                            <label class="text-dark" >To:</label>
                            <select name="to" id="" class="form-control" required>
                               <option value="{{ $stock->id }}"> {{ $stock->to_store }}</option>
                                          </select>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >QTY </label>
                            <input type="number" name="qty" class="form-control" min="1" max="{{ $stock->Qty_issued }}" value="{{ $stock->Qty_issued }}">
                        </div>
                    </div>
                </div>
                <input type="submit" name="issue" class="btn btn-primary" value="Submit" >
              </form>
        </div>

      </div>
    </div>
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

									</div>
								</div>
							</div>
						</div>


					</div>

				</div>




{{-- Start of adding modal --}}
	<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
			<h4 class="font-size-h4 font-weight-bold m-0">Add free Stock
			</h4>
			<a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
				<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
				</svg>
			</a>
		</div>

		<form id="myform" action="{{ route('stocking.store') }}" method="POST">
            @csrf
			<div class="row">
				<div class="col-12">

                    <div class="form-group">
						<label class="text-dark" >Item Name </label>
                        <select name="item_id" id="" class="form-control" required >
                            <option value="" disabled> --Select Item -- </option>
                            @foreach ($stocks as $stock)
                           <option value="{{ $stock->id }}">{{ $stock->item }}</option>
                           @endforeach
                        </select>
					</div>
                    <div class="form-group">
						<label class="text-dark" >From Supplier </label>
                        <select name="from" id="" class="form-control" required>
                            <option value=""> --Select supplier -- </option>
                            @foreach ($suppliers as $supplier)
                           <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                           @endforeach
                        </select>
					</div>
                    <div class="form-group">
						<label class="text-dark" >To Warehouse</label>
                        <select name="to" id="" class="form-control" required>
                            <option value="" disabled> --Select Warehouse -- </option>
                            @foreach ($warehouses as $warehouse)
                            @if($warehouse->main_warehouse)
                             <option value="{{ $warehouse->id }}" selected>{{ $warehouse->warehouse }}</option>
                            @endif
                           @endforeach
                        </select>
					</div>
                    <div class="form-group">
						<label class="text-dark" >QTY</label>
                        <input type="number" name="qty" class="form-control" required>
					</div>

				</div>
			</div>
			<input type="submit" name="receive" class="btn btn-primary" value="Submit">
		  </form>
	</div>
    {{-- end of adding modal --}}
@endsection
