@extends('layouts.app')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                    <li class="breadcrumb-item " aria-current="page">Report</li>
                    <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
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
                    <div class="card card-custom gutter-b bg-transparent shadow-none border-0" >
                        <div class="card-header align-items-center   border-bottom-dark px-0">
                            <div class="card-title mb-0">
                                <h3 class="card-label mb-0 font-weight-bold text-body">Invoice
                                </h3>
                            </div>
                            <div class="icons d-flex">

                                <a href="#" onclick="printDiv()" class="ml-2">
                                    <span class="icon h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center rounded-circle ">
                                        <svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-printer-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5z"/>
                                            <path fill-rule="evenodd" d="M11 9H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                            <path fill-rule="evenodd" d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                          </svg>
                                    </span>

                                </a>


                            </div>
                        </div>

                    </div>


                </div>
            </div>


            <div class="row">


                <div class="col-lg-12 col-xl-12">
                    <div class=" card-custom gutter-b bg-white border-0" >
                        <div class="">


{{-- Start of modal --}}
@foreach ($customers as $payment)

<div class="" id="printableTable" role="tabpanel" aria-labelledby="invoice-tab">
        <div class="card card-custom gutter-b bg-white border-0 " >
            <div class="card-header d-flex align-items-start justify-content-between  border-0 pb-5">
                <div class="card-title mb-0 d-flex inovice-main">
                    <div class="bg-primary pb-3 h-150px  w-150px d-flex flex-column justify-content-end align-items-center">
                        <h3 class="font-size-h3 text-white">Invoice</h3>
                        <h4 class="font-size-h4 text-white">#{{ $payment->id }}</h4>
                    </div>
                    <div class="card-user-detail padding-top pl-3 w-250px">
                        <h5 class="font-size-h5 font-size-bold text-body">{{ $payment->customer_name }}</h5>
                        <h5 class="font-size-h5 text-dark">Address: {{ $payment->location }}</h5>
                        <h5 class="font-size-h5 text-dark">Phone: {{ $payment->phone }}</h5>
                        <h5 class="font-size-h5 text-dark">TIN: {{ $payment->tin }}</h5>
                    </div>
                </div>

															<div class="padding-top">

																<a href="index.html">
																	<img src="../../../assets/images/misc/logo.svg" alt="logo" style="max-width:100px;">
																</a>
                                                                <br>
                                                                <br>
                                                                <hr>
                                                                <h5 class="font-size-h5 text-black-50">
																<strong> Date: </strong><span>{{ date_format($payment->created_at,'d/m/Y') }}</span>
																</h5>
															</div>

														</div>


														<div class="">
															<div class="container">
															<div class="row">
																<div class="col-12 table-padding">
                                                                    <hr>
																	<table class="table table-striped text-body">
																		<thead>
																		  <tr class="row">
																			<th class="border-0 col-lg-6 col-4 header-heading" scope="col">Product</th>
																			<th class="border-0 col-lg-2 col-2 header-heading" scope="col">Price</th>
																			<th class="border-0 col-lg-2 col-3 text-center header-heading" scope="col">Quantity</th>
																			<th class="border-0 col-lg-2 col-3 text-right header-heading" scope="col">Total</th>
																		  </tr>
																		</thead>
																		<tbody>
                                                                            @foreach ($sales as $item)
																		  <tr class="row">

																			<td class="col-lg-6 col-4">{{ $item->item }}</td>
																			<td class="col-lg-2 col-2">{{ number_format($item->selling_price )}}</td>
																			<td class="col-lg-2 col-3 text-center">{{ $item->qty }}</td>
																			<td class="col-lg-2 col-3 text-right">Tsh. {{  number_format($item->selling_price * $item->qty) }}</td>

																		  </tr>
                                                                          @endforeach

																		</tbody>
																	  </table>

																	  <div class="row justify-content-end">
																		  <div class="col-12 col-md-3">
																			<div>
																				<table class="table right-table table-bordered">

																					<tbody>
																					  <tr class="d-flex align-items-center justify-content-between">
																						<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
																								TOTAL
																						</th>
																						<td class="border-0 justify-content-end d-flex text-black-50 font-size-base">Tsh. {{ number_format($totals->amount) }}</td>
																					  </tr>
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
                         @endforeach
{{-- End of modal --}}





                    </div>
                </div>


            </div>
        </div>

    </div>

</div>

</div>

<iframe name="print_frame" width="0" height="0"  src="about:blank"></iframe>

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
</script>
@endsection

