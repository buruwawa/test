@extends('layouts.app')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                    <li class="breadcrumb-item " aria-current="page">Account</li>
                    <li class="breadcrumb-item active" aria-current="page">Account List</li>
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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Account List
                                </h3>

                            </div>
                                     <!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Payment Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('account.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-dark" >Category </label>
                            <input type="text" name="payment_category" class="form-control"  required placeholder="Category name">
                        </div>
                        <div class="form-group">
                            @foreach ($categories as $category)
                                <p class="form-control">
                                 <span class="fa fa-check"></span>  {{ $category->payment_category }}
                            </p>
                            @endforeach
                           </li>
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
 <button type="button" class="btn btn-sm btn-secondary text-white btn-xs" data-toggle="modal" data-target="#category">
                                                <i class="fa fa-plus"></i> Payment Category
                                              </button>
                                              {{-- end --}}
                            <div class="icons d-flex">

                                @if($accounts =='[]')
                                <button  class="btn ml-2 p-0 kt_notes_panel_toggle"
                                  data-toggle="tooltip" title="" data-placement="right"
                                                    data-original-title="Check out more demos" >
                                    <span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm ">

                                        <svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-plus white" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                          </svg>
                                    </span>

                                </button>
                                @endif



                            </div>
                        </div>

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
                                            <th>Account Id</th>
                                            <th>Account Name</th>
                                            <th>Account Main</th>
                                            <th>Total </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                        @foreach ($accounts as $account)
                                        <tr>
                                            <td>{{ $account->id }}</td>
                                            <td>{{$account->account_name }}</td>
                                            <td>
                                                @if($account->main_account == 1)
                                                <form action="{{ route('account.update',$account->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="remove_id" value="{{ $account->id }}">


                                                {{-- Start of switcher --}}
                                                <div class="col-12 col-sm-6 col-xl-4">
                                                    <div class="switch-h d-flex justify-content-between mb-2">
                                                        <div class="custom-control switch custom-switch-success custom-switch custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" name="remove_account" value="remove main"  @if($account->main_account == 1) }} checked @endif id="active{{ $account->id }}" onchange="this.form.submit()">
                                                            <label class="custom-control-label mr-1" for="active{{ $account->id }}">
                                                            </label>
                                                          </div>
                                                    </div>
                                                </div>
                                            {{-- End of switcher --}}
                                            </form>
                                                @endif

                                                @if($account->main_account != 1)
                                                <form action="{{ route('account.update',$account->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="account_id" value="{{ $account->id }}">
                                                      {{-- Start of switcher --}}
                                                <div class="col-12 col-sm-6 col-xl-4">
                                                    <div class="switch-h d-flex justify-content-between mb-2">
                                                        <div class="custom-control switch custom-switch-success custom-switch custom-control-inline mr-0">
                                                            <input type="checkbox" class="custom-control-input" name="asign_account" value="make main"  id="innactive{{ $account->id }}" onchange="this.form.submit()">
                                                            <label class="custom-control-label mr-1" for="innactive{{ $account->id }}">
                                                            </label>
                                                          </div>
                                                    </div>
                                                </div>
                                            {{-- End of switcher --}}

                                            </form>
                                                @endif
                                            </td>
                                            <td><a href="{{ route('account.show',$account->id) }}"> {{ number_format($account->total) }}</a></td>
                                            <td>
                             <!-- Modal -->
                                <div class="modal fade" id="issue{{ $account->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Cash</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('account.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label class="text-dark" >Amount </label>
                                                            <input type="number" name="amount_received" class="form-control"  required placeholder="Enter Amount">
                                                            <input type="hidden" name="accountid" class="form-control"  value="{{ $account->id }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" >Cash in Type </label>
                                                            <select name="cash_category" id="" class="form-control">
                                                                <option value="" selected>-- Select cash in type --</option>
                                                                @foreach ($categories as $category)
                                                                <option> {{ $category->payment_category }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="text-dark" >Descriptions </label>
                                                            <textarea name="cash_descriptions" id=""  class="form-control" cols="5" rows="2" placeholder="Payment descriptions" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" name="account_id" class="btn btn-success" value="Submit">
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                {{-- end modal --}}


                                                <button type="button" class="btn btn-sm btn-success btn-xs" data-toggle="modal" data-target="#issue{{ $account->id   }}">
                                                <i class="fa fa-plus"></i> Cash In
                                              </button>
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

{{-- Start of adding modal --}}
<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
        <h4 class="font-size-h4 font-weight-bold m-0">Register Account
        </h4>
        <a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
            <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
            </svg>
        </a>
    </div>
    <form id="myform" action="{{ route('account.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">


                <div class="form-group">
                    <label class="text-dark" >Account Name </label>
                    <input type="text" name="account_name" class="form-control" required placeholder="Account Name">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="descriptions" cols="30" rows="4" placeholder="Describe this account"></textarea>
                </div>

            </div>
        </div>
        <input type="submit" name="receive" class="btn btn-primary" value="Submit">
      </form>
</div>
{{-- end of adding modal --}}



@endsection

