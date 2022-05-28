@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">Warehouse</li>
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
														<h3 class="card-label mb-0 font-weight-bold text-body">Warehouse
														</h3>
													</div>
												    <div class="icons d-flex">

														<button  class="btn ml-2 p-0 kt_notes_panel_toggle"
														  data-toggle="tooltip" title="" data-placement="right"
																			data-original-title="Check out more demos" >
															<span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm ">

																<svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-plus white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
																  </svg>
															</span>

														</button>
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
																		<th>ID</th>
																		<th >Warehouse</th>
																		<th>Location</th>
																		<th class="no-sort text-right">Action</th>
																	</tr>
																</thead>
																<tbody class="kt-table-tbody text-dark">

                                                                    @foreach ($warehouses as $warehouse)

																	<tr class=" @if($warehouse->main_warehouse == 1) alert-warning @endif">
																		<td  >{{ $warehouse->id }}</td>
																		<td>
																		{{ $warehouse->warehouse }}
																		</td>
																		<td>{{ $warehouse->location }}</td>



                                                                        {{-- <td>
                                                                            @if($warehouse->main_warehouse == 1)
                                                                            <form action="{{ route('warehouse.update',$warehouse->id) }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="_method" value="PUT">
                                                                                <input type="hidden" name="remove_id" value="{{ $warehouse->id }}">


                                                                            <div class="col-12 col-sm-6 col-xl-4">
                                                                                <div class="switch-h d-flex justify-content-between mb-2">
                                                                                    <div class="custom-control switch custom-switch-success custom-switch custom-control-inline mr-0">
                                                                                        <input type="checkbox" class="custom-control-input" name="remove_warehouse" value="remove main"  @if($warehouse->main_warehouse == 1) }} checked @endif id="active{{ $warehouse->id }}" onchange="this.form.submit()">
                                                                                        <label class="custom-control-label mr-1" for="active{{ $warehouse->id }}">
                                                                                        </label>
                                                                                      </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                            @endif

                                                                            @if($warehouse->main_warehouse != 1)
                                                                            <form action="{{ route('warehouse.update',$warehouse->id) }}" method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="_method" value="PUT">
                                                                                <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">
                                                                            <div class="col-12 col-sm-6 col-xl-4">
                                                                                <div class="switch-h d-flex justify-content-between mb-2">
                                                                                    <div class="custom-control switch custom-switch-success custom-switch custom-control-inline mr-0">
                                                                                        <input type="checkbox" class="custom-control-input" name="asign_warehouse" value="make main"  id="innactive{{ $warehouse->id }}" onchange="this.form.submit()">
                                                                                        <label class="custom-control-label mr-1" for="innactive{{ $warehouse->id }}">
                                                                                        </label>
                                                                                      </div>
                                                                                </div>
                                                                            </div>

                                                                        </form>
                                                                            @endif
                                                                        </td> --}}





                                <td>
                                    <!-- start Modal -->
                                    <div class="modal fade" id="issue{{ $warehouse->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{ $warehouse->warehouse }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('warehouse.update',$warehouse->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" >Name </label>
                                                            <input type="text" name="warehouse" class="form-control" required value="{{ $warehouse->warehouse }}">
                                                            <small  class="form-text text-muted">please enter your Warehouse name</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" >Location </label>
                                                            <input type="text" name="location" class="form-control" required value="{{ $warehouse->location }}">
                                                            <small  class="form-text text-muted">please enter warehouse location</small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="text-dark" >Descriptions </label>
                                                            <textarea class="form-control"  rows="3" placeholder="Describe this warehouse" name="descriptions">{{ $warehouse->descriptions }}</textarea>
                                                            </div>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-success" >Submit</button>
                                                </form>
                                        </div>

                                        </div>
                                    </div>
                                    </div>
                                    {{-- end of modal --}}

                                    <div class="card-toolbar text-right">

                                        <a href="javascript:void(0)" class="dropdown-item click-edit btn btn-primary btn-sm text-center text-white" data-toggle="modal" data-target="#issue{{ $warehouse->id }}">Edit</a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdowneditButton2"  style="position: absolute; transform: translate3d(1001px, 111px, 0px); top: 0px; left: 0px; will-change: transform;">


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





	<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
			<h4 class="font-size-h4 font-weight-bold m-0">Add New Warehouse
			</h4>
			<a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
				<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
				</svg>
			</a>
		</div>
		<form id="myform" action="{{ route('warehouse.store') }}" method="POST">
            @csrf

			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<label class="text-dark" >Name </label>
						<input type="text" name="warehouse" class="form-control" required>
						<small  class="form-text text-muted">please enter your Warehouse name</small>
					</div>
					<div class="form-group">
						<label class="text-dark" >Location </label>
						<input type="text" name="location" class="form-control" required>
                        <small  class="form-text text-muted">please enter warehouse location</small>
					</div>

						<input type="hidden" name="is_warehouse" class="form-control" value="1">


					<div class="form-group">
						<label class="text-dark" >Descriptions </label>
						<textarea class="form-control"  rows="3" placeholder="Describe this warehouse" name="descriptions"></textarea>
					  </div>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		  </form>
	</div>



</body>
<!--end::Body-->

</html>
@endsection
