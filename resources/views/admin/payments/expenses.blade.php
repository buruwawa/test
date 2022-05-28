@extends('layouts.app')
@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                    <li class="breadcrumb-item " aria-current="page">Expenses</li>
                    <li class="breadcrumb-item active" aria-current="page">Expenses List</li>
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
                                <h3 class="card-label mb-0 font-weight-bold text-body">Expenses List
                                </h3>

                            </div>
                                     <!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Expense Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf

                <div class="row">

                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-dark" >Category </label>
                            <input type="text" name="expenses_category" class="form-control"  required placeholder="Category name">

                        </div>
                        <div class="form-group">
                            @foreach ($categories as $category)
                                <p class="form-control">
                                 <span class="fa fa-check"></span>  {{ $category->expenses_category }}
                            </p>
                            @endforeach
                           </li>
                        </div>
                    </div>
                </div>
                <button type="submit" name="category" class="btn btn-success" value="submit">Submit</button>
              </form>
        </div>

      </div>
    </div>
  </div>
  {{-- end modal --}}


                                                <button type="button" class="btn btn-sm btn-secondary text-white btn-xs" data-toggle="modal" data-target="#category">
                                                <i class="fa fa-plus"></i> Expenses Category
                                              </button>
                                              {{-- end --}}
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
                                            <th>Date</th>
                                            <th>Expense Name</th>
                                            <th>Amount</th>
                                            <th>Category </th>
                                            <th>Expense Descriptions</th>
                                            <th>Status </th>
                                            @role('Admin') <th>Action </th>
                                            <th></th>
                                            @endrole
                                        </tr>
                                    </thead>
                                    <tbody class="kt-table-tbody text-dark">
                                        @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{  $expense->id}}</td>
                                            <td>{{ date('d/m/Y',strtotime( $expense->created_at)) }}</td>
                                            <td>{{$expense->expenses_name }}</td>
                                            <td>{{number_format($expense->amount) }}</td>
                                            <td>{{$expense->category }}</td>
                                            <td>{{$expense->descriptions }}</td>
                                            <td>
                                                @if($expense->status =="Pending")
                                                <span class="text-danger">
                                                {{ $expense->status }}
                                                @else
                                                -
                                                @endif
                                            </span>

                                            </td>

                                            @role('Admin')
                                             <td>
                                                @if($expense->status == 'Pending')
                                                <form action="{{ route('expenses.update',$expense->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="status" value="Paid">

                                                    <input type="hidden" name="pay_this_amount" value="{{$expense->amount }}">
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm(id='Are you sure you want to approve this expense?')" name="pay" value="pay">Pay</button>
                                            </form>
                                           <td>
                                            <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="delete">
                                                <input type="hidden" name="status" value="Paid">
                                            <button type="submit" onclick="return confirm(id='Are you sure you want to delete this expense?')" class="btn btn-sm btn-danger" ><span class="fa fa-trash "></span></button>
                                        </form>
                                           </td>
                                            @else
                                            -
                                            @endif
                                            </td>
                                            @endrole


                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Tsh. {{ number_format($totals->total_request) }}</th>
                                        <th></th>
                                        <th></th>
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

{{-- Start of adding modal --}}
<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
        <h4 class="font-size-h4 font-weight-bold m-0">Create Expense
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
                    <label class="text-dark" >Expense Name </label>
                    <input type="text" name="expenses_name" class="form-control" required placeholder="Expense Name">
                </div>
                <div class="form-group">
                    <label class="text-dark" >Amount </label>
                    <input type="number" name="expense_amount" class="form-control" required placeholder="Expense Amount">
                </div>
                <div class="form-group">
                    <label class="text-dark" >Expense Category </label>
                    <select name="expenses_category" class="form-control" id="">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                        <option >{{ $category->expenses_category }}</option>
                        @endforeach
                    </select>
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

