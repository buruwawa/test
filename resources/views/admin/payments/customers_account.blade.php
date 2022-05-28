@extends('layouts.app')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                    <li class="breadcrumb-item " aria-current="page">Customer Accounts</li>
                    <li class="breadcrumb-item active" aria-current="page">Accounts List</li>
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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Customer Accounts
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
                            </div>
                        </div>

                    </div>


                </div>

            </div>

                    <div class="d-flex  colorfull-select">


                        {{-- Start of items --}}
                <div class="col-md-8">
                            <div class="greeting-text">
                    </div>
                 </div>
                </div>
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="card card-custom gutter-b bg-white border-0" >
                        <div class="card-body">
                            <div >
                                <div class="table-responsive" id="printableTable">
                                    <table id="orderTable" class="display" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                        @foreach ($customers_accounts as $accounts)
                                        <tr class="kt-table-row kt-table-row-level-0">
                                            <td>{{ $accounts->id }}</td>
                                            <td>{{ $accounts->customer_name }}</td>
                                            <td><a href="{{ route('customers.show',$accounts->id) }}">
                                                <span class="@if($accounts->to<0)text-success @endif @if($accounts->to>0)text-danger @endif">{{ number_format($accounts->to) }}</span></td>
                                            </a>
                                            <td>
                                                <!-- Modal -->
<div class="modal fade" id="issue{{ $accounts->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Advanced Payment {{ $accounts->supplier_name }} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-dark" >Amount </label>
                            <input type="number" name="pay_amount" class="form-control" min=0 required>
                            <input type="hidden" name="customer_account" class="form-control" value="{{  $accounts->id }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" >Submit</button>
              </form>
        </div>

      </div>
    </div>
  </div>
  {{-- end modal --}}


                                                <button type="button" class="btn btn-sm btn-success btn-xs" data-toggle="modal" data-target="#issue{{ $accounts->id   }}">
                                                <i class="fa fa-plus"></i> Advance
                                              </button>
                                            </td>

                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>

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


{{-- Start of adding modal --}}
<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
        <h4 class="font-size-h4 font-weight-bold m-0">Receive Advanced Payment
        </h4>
        <a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
            <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
            </svg>
        </a>
    </div>
    <form id="myform" action="{{ route('expenses.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">

                <div class="form-group">
                    <label class="text-dark" >Select Customer </label>
                    <select name="expenses_category" class="form-control" id="">
                        <option value="">-- Select Customer --</option>
                        @foreach ($customers as $customer)
                        <option >{{ $customer->customer_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="text-dark" >Amount </label>
                    <input type="number" name="Amount" class="form-control" required placeholder="Advanced
                     Amount">
                </div>

                <div class="form-group">
                    <textarea class="form-control" name="descriptions" cols="30" rows="4" placeholder="Describe this Expense"></textarea>
                </div>

            </div>
        </div>
        <input type="submit" name="expenses" class="btn btn-primary" value="Submit">
      </form>
</div>
{{-- end of adding modal --}}

@endsection

