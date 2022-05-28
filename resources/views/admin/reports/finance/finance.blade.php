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
                    <li class="breadcrumb-item active" aria-current="page">Finance Report</li>
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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Finance Report
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
            <div class="col-12">
                <div class="card card-custom gutter-b bg-white border-0" >

                    <div class="card-body">
                        <div class="table-responsive" id="">
                            <table id="" class="table table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Total Assets</th>
                                    <th>Total Liabilities</th>
                                    <th>Total Equity</th>
                                    <th>Available Stock Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ number_format(-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total + $stock_value->total_value ?? 0)}}</td>
                                    <td>{{ number_format($customer_wallet->total_wallet + $expenses->total_expenses + - $supplier_credits->total_supplier_credits) }}</td>
                                    <td>{{ number_format((-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total + $stock_value->total_value ?? 0) - ($customer_wallet->total_wallet + $expenses->total_expenses + - $supplier_credits->total_supplier_credits)) }}</td>
                                    <td>{{number_format($stock_value->total_value - $stock_cost->total_cost) }}</td>

                                </tr>
                            </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>


                <div class="col-12">
                    <div class="card card-custom gutter-b bg-white border-0" >

                        <div class="card-body">
                            <form method="GET" action="{{ route('filter-finance') }}">
                                <div class="form-group row justify-content-center mb-0">

                                    <div class="col-md-3">
                                        <label class="text-dark" >Choose Your Date</label>
                                        <input type="text" name="date" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                        {{-- <div>
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span> <i class="fa fa-caret-down"></i>
                                        </div> --}}
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-0" >
                                            <label class="text-dark" >Sales person</label>
                                                <select class="arabic-select w-100 mb-3 h-30px" name="sales_person" >

                                                    <option value="All" selected>All</option>
                                                    @foreach ($salespeople as $salesperson)
                                                    <option value="{{ $salesperson->id }}">{{ $salesperson->name }}</option>
                                                    @endforeach

                                                </select>
                                          </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-0" >
                                            <label class="text-dark" >Customer</label>
                                                <select class="arabic-select w-100 mb-3 h-30px" name="customer" >
                                                    <option value="All" selected>All</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                                    @endforeach
                                                </select>
                                          </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group mb-0" >
                                            <label class="text-dark" ></label>
                                            <button class="btn btn-primary ">Filter </button>
                                          </div>
                                    </div>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
                <div class="col-lg-12 col-xl-12">
                    <div class="card card-custom gutter-b bg-white border-0" >
                        <div class="card-body">
                            <div>
                                <div class="table-responsive" id="printableTable">
                                    <h3 class="text-center text-white bg-success">Assets</h3>
                                    <table  class="display table table-hover table-bordered" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Currently ({{ \Carbon\Carbon::now()->format('F') }})</th>
                                                <th>Previous ({{ \Carbon\Carbon::now()->submonth()->format('F') }})</th>
                                                <th>Change</th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-table-tbody text-dark">

                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Cash in Hand</td>
                                                <td>{{ number_format($cash_in_hand->total) ?? 0 }}</td>
                                                @isset($cash_previous)
                                                <td>
                                                     {{number_format($cash_previous->amount_to) ?? 0 }}
                                                   </td>
                                                <td>
                                                    @if(($cash_in_hand->total-$cash_previous->amount_to)/$cash_previous->amount_to*100 < 0)
                                                    <span class="fa fa-angle-down text-danger"></span>
                                                    @else
                                                    <span class="fa fa-angle-up text-success"></span>
                                                    @endif
                                                    {{ round(($cash_in_hand->total-$cash_previous->amount_to)/$cash_previous->amount_to*100,0) ?? 0}}%
                                                </td>
                                                @else
                                                <td>0</td>
                                                <td>-</td>

                                                @endisset
                                            </tr>
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Cash due from credit Customer</td>
                                                <td>{{ number_format(-$credit_customer->total_credit) }}</td>
                                                @if($credit_previous->total_credit_previous <> null)
                                                    <td>{{ number_format(-$credit_previous->total_credit_previous ?? 0) }}</td>
                                                    <td>
                                                        @if((($credit_customer->total_credit - $credit_previous->total_credit_previous)/$credit_previous->total_credit_previous*100) < 0)
                                                        <span class="fa fa-angle-down text-danger"></span>
                                                        @else
                                                        <span class="fa fa-angle-up text-success"></span>
                                                        @endif
                                                        {{ round(($credit_customer->total_credit - $credit_previous->total_credit_previous)/$credit_previous->total_credit_previous*100,0)}}%

                                                    </td>
                                                    @else
                                                    <td>0</td>
                                                    <td>0</td>
                                                @endif

                                            </tr>
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Advances paid to Suppliers</td>
                                                <td>{{ number_format($advance_supplier->total_supplier_advance ?? 0) }}</td>
                                                @isset($advance_supplier_previous)
                                                <td>{{ number_format(-$advance_supplier_previous->total_previous_advance) }}</td>

                                                @if($advance_supplier_previous->total_previous_advance <> null )
                                                 <td>
                                                    @if(($advance_supplier->total_supplier_advance - $advance_supplier_previous->total_previous_advance) / $advance_supplier_previous->total_previous_advance * 100 < 0)
                                                    <span class="fa fa-angle-down text-danger"></span>
                                                    @else
                                                    <span class="fa fa-angle-up text-success"></span>
                                                    @endif
                                                    {{ round(($advance_supplier->total_supplier_advance - $advance_supplier_previous->total_previous_advance)/$advance_supplier_previous->total_previous_advance*100,0)}}%
                                                </td>
                                                @else
                                                <td>0</td>
                                            @endisset
                                            @endisset
                                            </tr>
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Reserved for expenses</td>
                                                <td>{{ number_format($expenses->total_expenses) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Stock Value</td>
                                                <td>{{ number_format($stock_value->total_value) }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Total</th>
                                            <th>
                                                {{ number_format(-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total + $stock_value->total_value +$expenses->total_expenses?? 0)}}
                                            </th>
                                            @if($cash_previous)
                                            <th>
                                                {{ number_format(-$credit_previous->total_credit_previous + $cash_previous->amount_to + $advance_supplier->total_supplier_advance  ?? 0)}} </th>
                                                <th>
                                                @if(((-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total) -
                                                (-$credit_previous->total_credit_previous + $cash_previous->amount_to + $advance_supplier->total_supplier_advance)) /
                                                (-$credit_previous->total_credit_previous + $cash_previous->amount_to + $advance_supplier->total_supplier_advance)*100 < 0)
                                                        <span class="fa fa-angle-down text-danger"></span>
                                                        @else
                                                        <span class="fa fa-angle-up text-success"></span>
                                                        @endif
                                                {{round(((-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total) -
                                                (-$credit_previous->total_credit_previous + $cash_previous->amount_to + $advance_supplier->total_supplier_advance)) /
                                                (-$credit_previous->total_credit_previous + $cash_previous->amount_to + $advance_supplier->total_supplier_advance)*100,2)}}

                                            </th>
                                            @else
                                            <th>{{number_format( -$credit_previous->total_credit_previous + $advance_supplier->total_supplier_advance) }}</th>
                                            <th>-</th>
                                            @endif
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <h3 class="text-center text-white bg-dark">Liabilities</h3>
                                        {{-- Liabilities table --}}
                                        <table  class="display table table-hover table-bordered" style="width:100%">

                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Currently</th>
                                                    <th>Previous</th>
                                                    <th>Change</th>
                                                </tr>
                                            </thead>
                                            <tbody class="kt-table-tbody text-dark">
                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Cash payable to suppliers</td>
                                                <td>{{number_format(- $supplier_credits->total_supplier_credits) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            <tr class="kt-table-row kt-table-row-level-0">
                                                <td>Advances paid by customers</td>
                                                <td>{{ number_format($customer_wallet->total_wallet) }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Total</th>
                                            <th>{{ number_format($customer_wallet->total_wallet + - $supplier_credits->total_supplier_credits) }}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                </table>

                                <h3 class="text-center text-white bg-primary">Equity</h3>
                                {{-- Liabilities table --}}
                                <table  class="display table table-hover table-bordered" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Currently</th>
                                            <th>Previous</th>
                                            <th>Change</th>
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                    <tr class="kt-table-row kt-table-row-level-0">
                                        <td>Net value of business</td>
                                        <td>{{ number_format((-$credit_customer->total_credit + $advance_supplier->total_supplier_advance + $cash_in_hand->total + $stock_value->total_value +$expenses->total_expenses ?? 0) - ($customer_wallet->total_wallet + - $supplier_credits->total_supplier_credits)) }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>


                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>Total</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
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

