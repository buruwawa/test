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
                    <li class="breadcrumb-item active" aria-current="page">Item Report</li>
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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Items Report
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
                            <form method="GET" action="{{ route('filter-item') }}">
                                <div class="form-group row justify-content-center mb-0">

                                    <div class="col-md-5">
                                        <label class="text-dark" >Choose Your Date</label>
                                        <input type="text" name="date" id="reportrange"
                                        style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%" required>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mb-0" >
                                            <label class="text-dark" >Items</label>
                                                <select class="arabic-select w-100 mb-3 h-30px" name="items" >

                                                    <option value="All">All</option>
                                                    @foreach ($items as $item)
                                                    <option value="{{ $item->id }}" @if(app('request')->input('items')==$item->id) selected @endif>{{ $item->item }}</option>
                                                    @endforeach

                                                </select>
                                          </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mb-0" >
                                            <label class="text-dark" >Warehouse</label>
                                                <select class="arabic-select w-100 mb-3 h-30px" name="warehouse">
                                                    <option value="All">All</option>
                                                    @foreach ($warehouses as $warehouse)
                                                    <option value="{{ $warehouse->id }}" @if(app('request')->input('warehouse')==$warehouse->id) selected @endif>{{ $warehouse->warehouse }}</option>
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
                                    <table id="orderTable" class="display" style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Qty</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody class="kt-table-tbody text-dark">
                                            @foreach ($sales as $sale)
                                            <tr class="kt-table-row kt-table-row-level-0">
                                               <td>{{ $sale->item }}</td>
                                                <td>{{ number_format($sale->total_qty) }}</td>
                                                <td>{{ date("d/m/Y", strtotime($sale->created_at)) }}</td>

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

