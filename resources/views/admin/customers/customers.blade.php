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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Customer List
                                </h3>
                            </div>
                            <div class="icons d-flex">

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
                                            <th>Location</th>
                                            <th>Phone Number</th>
                                            <th>Account</th>
                                            <th>E-wallet</th>
                                            <th>Cash In</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                        @foreach ($customers as $accounts)
                                        <tr class="kt-table-row kt-table-row-level-0">
                                            <td>{{ $accounts->id }}</td>
                                            <td><a href="{{ route('customershow',$accounts->id) }}">{{ $accounts->customer_name }}<a></td>
                                            <td>{{ $accounts->location }}</td>
                                            <td>{{ $accounts->phone }}</td>
                                            <td><a href="{{ route('customers.show',$accounts->id) }}">
                                                <span class="
                                                @if($accounts->to<0)text-danger @endif
                                                @if($accounts->to>0)text-warning @endif">Tsh {{ number_format($accounts->to) }}</span></a>
                                            </td>
                                            <td><span class="@if($accounts->balance > 0) text-success  @endif"> Tsh. {{ number_format($accounts->balance ?? 0 )}} </span></td>
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
                                                <td>

                                                   <!-- start Modal -->
  <div class="modal fade" id="edit{{ $accounts->id }}" tabindex="-1" role="dialog " aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit {{ $accounts->custoemer_name }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('customers.update',$accounts->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-dark" >Company Name <span class="text-danger"> * </span></label>
                            <input type="text" name="company_name" class="form-control" required value="{{ $accounts->company_name}}">
                            <small  class="form-text text-muted">please enter supplier name</small>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >Customer Name <span class="text-danger"> * </span></label>
                            <input type="text" name="customer_name" class="form-control" required value="{{ $accounts->customer_name}}">
                            <small  class="form-text text-muted">please enter contact person name</small>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >location <span class="text-danger"> * </span></label>
                            <input type="text" name="location" class="form-control" required value="{{ $accounts->location}}">
                            <small  class="form-text text-muted">please enter contact person postion</small>
                        </div>

                        <div class="form-group">
                            <label class="text-dark" >Phone <span class="text-danger"> * </span></label>
                            <input type="number" name="phone" class="form-control" required value="{{ $accounts->phone}}">
                            <small  class="form-text text-muted">please enter phone number</small>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >TIN <span class="text-danger"> * </span></label>
                            <input type="number" name="tin" class="form-control" required value="{{ $accounts->tin}}">
                            <small  class="form-text text-muted">please enter TIN number</small>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >VRN </label>
                            <input type="number" name="vrn" class="form-control" value="{{ $accounts->vrn}}">
                            <small  class="form-text text-muted">please enter VRN number</small>
                        </div>
                        <div class="form-group">
                            <label class="text-dark" >Email Address <span class="text-danger"> </span></label>
                            <input type="text" name="email" class="form-control"  value="{{ $accounts->email}}">
                            <small  class="form-text text-muted">please enter email address</small>
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
                                    <button class="btn p-0 shadow-none" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="svg-icon">
                                            <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-three-dots text-body" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdowneditButton2"  style="position: absolute; transform: translate3d(1001px, 111px, 0px); top: 0px; left: 0px; will-change: transform;">

                                        <a href="javascript:void(0)" class="dropdown-item click-edit" data-toggle="modal" data-target="#edit{{ $accounts->id }}">Edit</a>
                                        <form action="{{ route('customers.destroy',$accounts->id) }}" method="POST">
                                            @csrf
                                        <input type="hidden" name="_method" value="delete">
                                            <input type="submit" class="dropdown-item" value="Delete" onclick="return confirm(id='Are you sure you want to delete this suplier?')">
                                        </form>
                                    </div>
                                    </div>
                                    </td>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total</th>
                                        <th>{{ number_format($customer_total->total_debts) }}</th>
                                        <th>{{ number_format($customer_wallet->total_balance) }}</th>
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


@endsection

