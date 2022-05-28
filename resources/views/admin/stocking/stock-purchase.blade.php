@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">Suppliers List</li>
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
									<div class="row">

										<div class="col-12 ">
											<div class="card card-custom gutter-b bg-white border-0" >
												<div class="card-body" >
													<div >
														<div class=" table-responsive" id="printableTable">

                                                            <table id="orderTable" class="display" style="width:100%">

                                                                <thead class="text-body">
                                                                    <tr>


                                                                        <th>Supplier Name</th>
                                                                        <th>Phone Number</th>
                                                                        <th>Location</th>
                                                                        <th class=" text-right no-sort">Action</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody class="kt-table-tbody text-dark">
                                                                    @foreach ($suppliers as $supplier)
                                                                    <tr>

                                                                        <td>{{ $supplier->supplier_name }}</td>

                                                                        <td>{{ $supplier->phone }}</td>
                                                                        <td>{{ $supplier->address }}</td>
                                                                        <td>
 <!-- Modal -->
  <div class="modal fade" id="issue{{ $supplier->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Warehouse</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('stock-purchase.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >To warehouse </label>
                            <select name="warehouse_id"  class="form-control" required>
                                @foreach ($warehouses as  $warehouse )
                                <option value="{{ $warehouse->id }}">{{ $warehouse->warehouse }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
              </form>
        </div>

      </div>
    </div>
  </div>
  {{-- end of modal --}}

<div class="card-toolbar text-right">
                                                                                <form action="{{ route('stock-purchase.store') }}" method="POST">
                                                                                    @csrf

                                                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#issue{{ $supplier->id }}">
                                                                                Order <i class="fa fa-angle-right"></i></button>
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
