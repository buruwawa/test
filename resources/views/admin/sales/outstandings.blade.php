@extends('layouts.app')
@section('content')

				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">Outstandings</li>
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
                                <div class="card card-custom gutter-b bg-white border-0" >
                                    <div class="card-header align-items-center  border-0">
                                        <div class="card-title mb-0">
                                            <h3 class="card-label mb-0 font-weight-bold text-body">Outstandings Table
                                            </h3>
                                        </div>

                                    </div>
                    <div class="card-body" >
                        <div>
                            <div class="kt-table-content table-responsive">
                                <table id="orderTable" class="display" style="width:100%">

                                    <thead class="text-body">
                                        <tr>
                                            <th class="kt-table-cell">ID</th>
                                            <th class="kt-table-cell">Customer Name</th>
                                            <th class="kt-table-cell">Amount</th>
                                            <th class="kt-table-cell">Paid</th>
                                            <th class="kt-table-cell">Balance</th>
                                            <th class="kt-table-cell">
                                                <div class="">Days Ago</div>
                                            </th>
                                            <th><div class="">Date</div></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                        @foreach ($outstandings as $outstands)
                                        <?php $now = Carbon\Carbon::now();
                                            $days_count = Carbon\Carbon::parse($outstands->created_at)->diffInDays($now); ?>
                                        <tr class="kt-table-row kt-table-row-level-0
                                        @if($outstands->amount !=  $outstands->paid + $outstands->balance)
                                        text-danger
                                        @endif
                                        ">
                                            <td class="kt-table-cell"> <a href="{{ route('show-order',$outstands->order_id) }}">{{ $outstands->order_id }}</a></td>
                                            <td class="kt-table-cell">
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="ml-2">{{ $outstands->customer_name }}</span></div>
                                            </td>

                                            <td class="kt-table-cell">Tsh. {{ number_format($outstands->amount) }}</td>
                                            <td class="kt-table-cell">Tsh. {{ number_format($outstands->paid) }}</td>
                                            <td class="kt-table-cell">Tsh. {{ number_format($outstands->balance) }}</td>
                                            <td class="kt-table-cell">
                                                <div class="">
                                                    <span
                                                        class="mr-0 text-danger">
                                                        {{  $days_count }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td>{{date('d/m/Y g:i:s a',  strtotime($outstands->created_at)) }}</td>
                                            <td>
                                <button type="button" class="btn btn-sm btn-success btn-xs" data-toggle="modal" data-target="#issue{{ $outstands->id }}"> <i class="fa fa-credit-card"></i> Pay </button>
  <!-- Modal -->
  <div class="modal fade" id="issue{{ $outstands->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Receive payment from {{ $outstands->customer_name }} <br><span class="btn btn-outline-dark">Balance E-wallet {{ number_format($outstands->wallet_balance) }} </span> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12">
                        <div class="form-group">

                            <label class="text-dark" >Amount</label>
                            @if($outstands->wallet_balance > $outstands->balance)
                            <span class="form-control text-center" readonly value="Pay via E-wallet"><strong> Tsh. {{ number_format($outstands->balance) }}</strong></span>

                            <input type="hidden"  name="amount" class="form-control" value="{{ $outstands->balance }}">
                            <input type="hidden" name="sale_id" class="form-control" value="{{ $outstands->id }}" >
                            <input type="hidden" name="customer_id" class="form-control" value="{{ $outstands->cid }}">
                            <input type="submit"  name="pay_wallet" class="form-control bg-dark text-white text-center" readonly value="Pay via E-wallet">
                           @else
                           <input type="number" name="amount" class="form-control" max="{{ $outstands->balance - $outstands->wallet_balance }}" value="{{ $outstands->balance - $outstands->wallet_balance }}">
                            <input type="hidden" name="sale_id" class="form-control" value="{{ $outstands->id }}">
                            <input type="hidden" name="customer_id" class="form-control" value="{{ $outstands->cid }}">
                            <input type="hidden" name="wallet" class="form-control" value="{{ $outstands->wallet_balance }}">
                            <button type="submit" class="btn btn-success" >Submit</button>
                            @endif
                        </div>
                    </div>
                </div>

              </form>
        </div>

      </div>
    </div>
  </div>
                                                                        </td>
																	</tr>
                                                                    @endforeach

																</tbody>
                                                                <tfoot>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Tsh. {{ number_format($sales_total->totalamount) }}</th>
                                                                    <th>Tsh. {{ number_format($sales_total->totalpaid) }}</th>
                                                                    <th>Tsh. {{ number_format($sales_total->totalbalance) }}</th>
                                                                    <th></th>
                                                                    <th></th>
                                                                </tfoot>
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



    @endsection


