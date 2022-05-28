@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">My Stocks</li>
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
														<h3 class="card-label mb-0 font-weight-bold text-body text-right"> @foreach ($permissions as $permission)
                                                        {{ $permission }}@endforeach Warehouse
														</h3>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-12 ">
											<div class="card card-custom gutter-b bg-white border-0" >
												<div class="card-body" >
													<div>
														<div class=" table-responsive" id="printableTable">
															<table id="orderTable" class="display" style="width:100%">

																<thead class="text-body">
																	<tr>
																		<th>Item</th>
                                                                        <th>QTY</th>
																		<th>Price</th>
																		<th class="no-sort ">Action</th>
																	</tr>
																</thead>
																<tbody class="kt-table-tbody text-dark">
                                           @foreach ($stockings as $stock)
					<tr class="kt-table-row kt-table-row-level-0">																		<td>{{ $stock->item }}</td>
										<td>{{  number_format($stock->current_qty) }}</td>									<td>{{ number_format($stock->selling_price) }}</td>									
										<td>    <!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-info btn-xs" data-toggle="modal" data-target="#issue{{ $stock->id }}">
  <i class="fa fa-reply"></i> Return
  </button>
  <!-- Modal -->
  <div class="modal fade" id="issue{{ $stock->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Return stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <!-- <form action="{{ route('stocking.store') }}" method="POST"> -->
          	 <form action="{{ route('pending') }}" method="POST">

                @csrf
                <div class="row">

                    <div class="col-12">

                        <div class="form-group">
                            <input type="hidden" name="item_id" class="form-control" value="{{ $stock->item_id }}">
                            <input type="hidden" name="warehouse_id" class="form-control" value="{{ $stock->wID }}">
                            <input type="hidden" name="from" class="form-control" value="{{ $from_wherehouse->warehouse }}">
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >To Warehouse</label>
                            <select name="to" id="" class="form-control" required>
                                <option value="" disabled> --Select Warehouse -- </option>
                                @foreach ($warehouses as $warehouse)
                                @if($warehouse->warehouse !== $stock->wname)
                               <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse }}</option>
                               @endif
                               @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >QTY </label>
                            <input type="number" name="qty" class="form-control" max="{{ $stock->current_qty }}">
                        </div>
                    </div>
                </div>
                <input type="submit" name="return_stock" class="btn btn-primary" value="Submit" >
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





</body>
<!--end::Body-->

</html>
@endsection
