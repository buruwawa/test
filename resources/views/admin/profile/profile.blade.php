@extends('layouts.app')
@section('content')
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
								<div class="col-lg-12 col-xl-12">
									<div class="card card-custom gutter-b bg-white border-0" >
										<div class="card-header border-0 align-items-center">
											<h3 class="card-label mb-0 font-weight-bold text-body">Bussiness Setting
											</h3>
                                            <div class="float-right">
                                                @foreach ($profile as $status) Active
                                             <div class="custom-control switch custom-switch-success custom-switch custom-switch-glow custom-control-inline mr-0">
                                                 <input type="checkbox" class="custom-control-input" checked="" id="customSwitchcglow2" disabled>
                                                 <label class="custom-control-label mr-1" for="customSwitchcglow2">
                                                 </label>
                                               </div>
                                             @endforeach
                                         </div>
										</div>
										<div class="card-body">

											<div class="row">
                                                <div class="col-md-3">
													<ul class="nav flex-column nav-pills mb-3" id="v-pills-tab1" role="tablist" aria-orientation="vertical">
														<li class="nav-item" >
															<a class="nav-link active" id="general-tab2" data-toggle="pill" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
														</li>
														<li class="nav-item" >
															<a class="nav-link" id="pos-tab" data-toggle="pill" href="#pos" role="tab" aria-controls="pos" aria-selected="false">Package</a>
														</li>

														<li class="nav-item">
															<a class="nav-link" id="invoice-tab1" data-toggle="pill" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoices</a>
														</li>

													</ul>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="tab-content" id="v-pills-tabContent1">
                                                        <div class="tab-pane fade show active" id="general" role="tabpanel" >
                                                            @foreach ($profile as $company)
															<div class="form-group row">
																<div class="col-md-6">
																	<label >Business Name</label>
																	<fieldset class="form-group mb-3">
																		<input type="text" class="form-control border-dark"  placeholder="" value="{{ $company->company_name }}">
																	</fieldset>
																</div>
																<div class="col-md-6">
																	<label >Expire Date</label>
																	<fieldset class="form-group mb-3">
																		<input type="text" name="birthday" class="form-control w-100" value="{{ $company->renew_at }}" />
																	</fieldset>
																</div>

																<div class="col-md-6">
																	<label >Phone Number</label>
																	<input class="form-control" type="number" name="phone_number" value="{{ $company->phone_number }}">
																</div>
                                                                <div class="col-md-6">
																	<label >Address</label>
																	<input class="form-control" type="text" name="address" value="{{ $company->address }}">
																</div>

																<div class="col-md-6">
																	<label >Upload Logo</label>
																	<fieldset class="form-group mb-3 border-dark rounded p-1">
																		<input type="file" class="d-block w-100" id="img1" name="img" accept="image/*">
																	</fieldset>
																</div>

																<div class="col-md-12">
																	<button type="submit" class="btn btn-primary">Update</button>
																</div>

															</div>
                                                            @endforeach
                                                        </div>
                                                        <div class="tab-pane fade" id="pos" role="tabpanel" aria-labelledby="pos-tab">
                                                                <div class="row">
                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                        <h2>Awali</h2>
                                                                        <h4>Tsh 30,000/ Month</h4>
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                        <h2>Uwezo</h2>
                                                                        <h4>Tsh 50,000/ Month</h4>
                                                                    </div>
                                                                    </div>
                                                                    </div>

                                                                    <div class="col-md-4 col-lg-4">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                        <h2>Nguvu</h2>
                                                                        <h4>Tsh 120,000/ Month</h4>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                </div>
														</div>



														<div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
															<div class="form-group row">
                                                                <div class=" table-responsive" id="printableTable">
                                    <table id="orderTable" class="display" style="width:100%">

                                        <thead class="text-body">
                                            <tr>
                                                <th>ID</th>
                                                <th>Invoice Date</th>
                                                <th>Package</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-table-tbody text-dark">
                                            @foreach ($invoices as $stock)
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td >{{ $stock->id }}</td>
                                                <td>{{ $stock->created_at }}</td>
                                                <td class="d-none d-lg-block">{{ $stock->package_name }}</td>
                                                <td>{{ number_format($stock->amount_paid) }}</td>
                                                <td>
                                                    @switch($stock->status)
                                                        @case("Active")
                                                           <span class="btn btn-sm btn-success">{{ "Paid" }}</span>
                                                            @break

                                                        @default
                                                        {{ "Pendin" }}
                                                    @endswitch
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

				</div>



	<iframe name="print_frame" width="0" height="0"  src="about:blank"></iframe>



</body>
<!--end::Body-->

@endsection
