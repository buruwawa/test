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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Sales Report
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
                    <div class="card card-custom gutter-b bg-white border-0" >
                        <div class="card-body">
                            <div>
                                <div class="table-responsive" id="printableTable">
                                    <table id="orderTable" class="display" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                @role('Admin')
                                                <th>Sales Person</th>
                                                @endrole
                                                <th>Customer Name</th>
                                                <th>Payment Type</th>
                                                <th>Total Tsh.</th>
                                                <th>Due Tsh.</th>
                                                <th>Date</th>
                                                @role('Admin')
                                                <th>Action</th>
                                                @endrole
                                            </tr>
                                        </thead>
                                        <tbody class="kt-table-tbody text-dark">
                                            @foreach ($sales as $sale)
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td><a href="{{ route('show-order',$sale->order_id) }}"> {{ $sale->id }}</a></td>
                                                @role('Admin')
                                                <td>{{ $sale->name }}</td>
                                                @endrole
                                                <td>{{ $sale->customer_name }}</td>
                                                <td>
                                                    @switch($sale->status)
                                                        @case('Credit')
                                                        <span class="btn-sm bg-warning text-black ">Credit</span>
                                                            @break

                                                            @case('Cash')
                                                            <span class="btn-sm bg-success text-white">Cash</span>
                                                            @break
                                                            @case('Installment')
                                                            <span class="btn-sm bg-warning ">Installment</span>
                                                            @break
                                                            @case('Pay via E-wallet')
                                                            <span class="btn-sm bg-primary text-white">Wallet</span>
                                                            @break
                                                            @case('Bank')
                                                            <span class="btn-sm bg-dark text-white">Bank</span>
                                                            @break
                                                        @default

                                                    @endswitch

                                                </td>
                                                <td>{{ number_format($sale->paid) }}</td>
                                                <td>{{ number_format($sale->balance) }}</td>
                                                <td>{{ date("d/m/Y", strtotime($sale->created_at)) }}</td>
                                                @role('Admin')
                                                <td>
                                                    <form action="{{ route('report-action.destroy',$sale->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button name="delete-sale" value="Yes" type="submit" class="btn btn-danger btn-sm" title="Delete sale" onclick="return(confirm('Are you sure you want to delete this sale?'))">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endrole
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                            <th></th>
                                            @role('Admin')
                                            <th></th>
                                            @endrole
                                            <th></th>
                                            <th></th>

                                    <th>{{ number_format($totals->total_cash) }}</th>
                                    <th>{{ number_format($totals->total_credit) }}</th>
                                    <th></th>
                                    @role('Admin')
                                    <th></th>
                                    @endrole
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

