@extends('layouts.app')
@section('content')
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="tc_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-6 subheader-solid">
                        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb bg-white mb-0 px-0 py-2">
                                    <li class="breadcrumb-item " aria-current="page">Settings</li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                            <div class="card card-custom gutter-b bg-transparent shadow-none border-0" >
                                                <div class="card-header align-items-center  border-bottom-dark px-0">
                                                    <div class="card-title mb-0">
                                                        <h3 class="card-label mb-0 font-weight-bold text-body">Users
                                                        </h3>
                                                    </div>

                                                    <div class="d-flex">
                                                        @if(count($user) <= $limitation->limit_users)
                                                        <button  class="btn ml-2 p-0 kt_notes_panel_toggle"
                                                          data-toggle="tooltip" title="" data-placement="right"
                                                                            data-original-title="Check out more demos" >
                                                            <span class="bg-secondary h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center  rounded-circle shadow-sm ">
                                                                <i class="fa fa-plus"></i>
                                                            </span>

                                                        </button>
                                                        @endif
                                                        @role('SuperAdmin')
                                                        <a href="{{ route('roles.index') }}" class="btn btn-primary ripple my-2 btn-icon-text">
                                                          Roles & Permission
                                                        </a>
                                                        @endrole
                                                    </div>


                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    @if($user !="[]")
                                    <div class="row">

                                        <div class="col-12 ">
                                            <div class="card card-custom gutter-b bg-white border-0" >
                                                <div class="card-body" >
                                                    <div >
                                                        <div class=" table-responsive" id="printableTable">
                                                            {{-- <table id="orderTable" class="display" style="width:100%"> --}}
                                                                <table id="orderTable" class="display" style="width:100%">

                                                                    <thead>
                                                                        <tr>
                                                                            <th>User</th>
                                                                            <th>E-mail</th>
                                                                            <th>Role</th>
                                                                            @role('Admin|SuperAdmin') <th>Permission</th> @endrole
                                                                            <th>Created</th>
                                                                            @role('Admin') <th>Action</th> @endrole
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                @foreach($user as $value)
                                                                @if($value->email != "admin@moxa.co.tz")
                                                                <tr class="border-bottom @if(auth()->id()== $value->id)text-primary @endif" >
                                                                    <th scope="row">{{ $value->name }}</a></th>
                                                                    <td>{{ $value->email }}</a></td>
                                                                    <td>

                                                                        @forelse($user as $role)
                                                                        @if($role->model_id == $value->id)
                                                                        <form action="{{ route('users.destroy', $value->id) }}" method="POST" >
                                                                            @method('PUT')
                                                                            <input type="hidden" name="_method" value="delete">
                                                                            <input type="hidden" name="users" value="users">
                                                                            <input type="hidden" name="revoke" value="revoke">
                                                                                    {{ csrf_field() }}
                                                                            <button type="submit"  name="role" title="Remove this role" class="btn btn-outline-primary btn-sm" value="{{$role->role_name}}" onclick="return confirm(id='Are you sure you want to revoke this permission to this role?')" style="margin-bottom:3px;">
                                                                                <span class="text-white btn-sm bg-danger">-</span>
                                                                                {{$role->role_name}}
                                                                            </button>

                                                                        </form>
                                                                        @endif

                                                                    @empty
                                                                    <span class="alert alert-danger"> No Role</span>
                                                                    @endforelse

                                                                    <button type="button" class="btn btn-success btn-sm ripple my-2 btn-icon-text text-right" data-target="#role{{ $value->id }}" data-toggle="modal"> <i class="fa fa-plus"></i></button>



                                                    {{-- start of role modal --}}
                                                    <div class="modal" id="role{{ $value->id }}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content modal-content-demo">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">Assign role to {{ $value->name }} </h6>
                                                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                                        <span aria-hidden="true">×</span></button>
                                                                    </div>
                                                                    <form method="POST" action="{{ route('roles.store') }}" method="POST">
                                                                        @csrf
                                                                    <div class="modal-body">

                                                                            {{-- form start here --}}


                                                            <div class="container">
                                                            <div class="row">
                                                                    <div class="col-md-12 col-lg-12">
                                                                        <div class="form-group row">
                                                                            <label for="name" class="col-form-label ">{{ __('Roles') }}</label>
                                                                            <select name="role_name" id="" class="form-control" required>
                                                                                <option value="" selected>--Assign role --</option>
                                                                                @foreach ($roles as $role)
                                                                                <option>{{ $role->name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <input type="hidden" name="addrole" value="addrole">
                                                                            <input type="hidden" name="user_id" value="{{ $value->id}}">
                                                                    </div>
                                                                </div>
                                                                </div>

                                                                            {{-- form Ends here --}}

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn ripple btn-primary" type="submit">Save changes</button>
                                                                        </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    {{-- End of role Modal  --}}

                                                            </td>
                                                            @role('Admin|SuperAdmin')  <td>
                                                                        @forelse($permissions as $permission)
                                                                        @if($permission->model_id == $value->id)
                                                                        <form action="{{ route('users.destroy', $value->id) }}" method="POST" >
                                                                            @method('PUT')
                                                                            <input type="hidden" name="_method" value="delete">
                                                                            <input type="hidden" name="users" value="users">
                                                                            <input type="hidden" name="revoke" value="revoke">
                                                                                    {{ csrf_field() }}
                                                                            <button type="submit"  name="permission" class="btn btn-sm  btn-outline-primary" value="{{$permission->permission_name}}" onclick="return confirm(id='Are you sure you want to revoke this permission to this role?')" style="margin-bottom:3px;"><span class="text-white btn-sm bg-danger">-</span> {{$permission->permission_name}}</button>

                                                                        </form>
                                                                        @endif
                                                                    @empty
                                                                        <span class="alert alert-danger">No separate permission</span>
                                                                    @endforelse

                                                                    <button type="button" class="btn btn-success btn-sm ripple my-2 btn-icon-text text-right" data-target="#permission{{ $value->id }}" data-toggle="modal"> <i class="fa fa-plus"></i></button>


                                                    {{-- start of role modal --}}
                                                    <div class="modal" id="permission{{ $value->id }}" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-md" role="document">
                                                            <div class="modal-content modal-content-demo">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title">Assign permission to {{ $value->name }} </h6>
                                                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                                        <span aria-hidden="true">×</span></button>
                                                                    </div>
                                                                    <form method="POST" action="{{ route('roles.store') }}">
                                                                        @csrf
                                                                    <div class="modal-body">

                                                                            {{-- form start here --}}


                                                            <div class="container">
                                                            <div class="row">
                                                                    <div class="col-md-12 col-lg-12">
                                                                        <div class="form-group row">
                                                                            <label for="name" class="col-form-label ">{{ __('Permission') }}</label>
                                                                            <select name="permission_to_assign" id="" class="form-control" required>
                                                                                <option value="" selected>--Assign permission --</option>
                                                                                @foreach ($permit as $permitted)
                                                                                <option>{{ $permitted->name }}</option>
                                                                                @endforeach

                                                                            </select>
                                                                            <input type="hidden" name="user_id" value="{{ $value->id}}">
                                                                    </div>
                                                                </div>
                                                                </div>

                                                                            {{-- form Ends here --}}

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn ripple btn-primary" type="submit">Save changes</button>
                                                                        </form>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    {{-- End of role Modal  --}}
                                                                    </td>
                                                                    @endrole
                                                                    <td>{{ date('d/m/y',strtotime($value->created_at)) }}</td>
                                                               @role('Admin')     <td>
                                                                        <div class="button-list">

                                                                            <form action="{{ route('users.destroy', $value->id) }}" method="POST" >
                                                                            @method('PUT')
                                                                            @if(auth()->id()== $value->id)  @else
                                                                            <input type="hidden" name="_method" value="delete">
                                                                            <input type="hidden" name="users" value="users">
                                                                                    {{ csrf_field() }}
                                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(id='Are you sure you want to delete this user?')"><i class="fa fa-trash"></i></button>
                                                                            @endif
                                                                        </form>
                                                                        </div>
                                                                    </td>
                                                                    @endrole
                                                                </tr>

                                                                {{-- District End here --}}
                                                                @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>






                        {{--    --}}

    <div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
            <h4 class="font-size-h4 font-weight-bold m-0">Add New user
            </h4>
            <a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
                <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg>
            </a>
        </div>
        <form id="myform" action="{{ route('custom-users.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-dark" >Full Name </label>
                        <input class="form-control block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" >
                        <small  class="form-text text-muted">please enter your user name</small>
                    </div>
                    <div class="form-group">
                        <label class="text-dark" >Email </label>
                        <input class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required>
                        <small  class="form-text text-muted">please enter Email valid address</small>
                    </div>
                    <div class="form-group">
                        <label class="text-dark" >Password </label>
                        <input class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="new-password" >
                        <small  class="form-text text-muted">please enter Password</small>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" value="{{ __('Confirm Password') }}" />Confirm Password  </label>
                        <input  id="password_confirmation" class="form-control block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password"  >
                        <small  class="form-text text-muted">please enter Password</small>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

                        {{--    --}}




                    </div>

                </div>
@endsection
