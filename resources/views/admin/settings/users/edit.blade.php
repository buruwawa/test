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
                                        <a href="{{ route('roles.index') }}" class="btn btn-primary ripple my-2 btn-icon-text">
                                          Roles & Permission
                                        </a>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>
						<!-- Row -->
						@if($datas !="[]")
                        <div class="card" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h6 class="modal-title">User Account |
                                        {{ $datas->name }}</h6>
                                    </div> <div class="modal-body">

                                            {{-- form start here --}}
                                            <form method="POST" action="{{ route('users.store') }}">
                                                @csrf
                            <div class="row">

                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label ">{{ __('Assign Role') }}</label>
                                    <select class="form-control" name="roles" id="role" required>
                                       @foreach($roles as $role)
                                           <option>{{ $role->name }}</option>
                                       @endforeach

                                    </select>

                                    <input type="hidden" name="users_id" value="{{ $id }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <h6 class="modal-title">Current roles for {{ $datas->name }}</h6>
                                    {{-- @foreach($myroles as $roles)
                                    <p class="h3">  <a href="{{ route('roleremove',['id'=>$id,'role'=>$roles]) }}" class="btn btn-sm btn-primary"><i class="ti ti-close icon"></i> {{ $roles }}</a></p>
                                    @endforeach --}}

                                </div>

                                </div>

                                            {{-- form Ends here --}}

                                        </div> <div class="modal-footer">
                                            <button class="btn ripple btn-primary" type="submit">Save changes</button>
                                        </form>
                                            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                                        </div>
                                    </div>
                                </div>
						@else
						<h4 class="alert alert-danger text-center">No user registered. </h4>
						@endif
						<!-- End Row -->

                    </div>

                </div>

            </div>
        </div>
    </div>


</div>

</div>
@endsection
