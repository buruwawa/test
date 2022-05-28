@extends('layouts.app')
@section('content')
  <script src="../../img_library/scripts.js" type="text/javascript"></script>
				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="tc_content">
					<!--begin::Subheader-->
					<div class="subheader py-2 py-lg-6 subheader-solid">
						<div class="container-fluid">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb bg-white mb-0 px-0 py-2">
									<li class="breadcrumb-item active" aria-current="page">sites</li>
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
														<h3 class="card-label mb-0 font-weight-bold text-body">List of Deleted Sites
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
														<a href="#" class="ml-2" >
															<span class="icon h-30px font-size-h5 w-30px d-flex align-items-center justify-content-center rounded-circle ">
																<svg width="15px" height="15px" viewBox="0 0 16 16" class="bi bi-file-earmark-text-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																	<path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm7 2l.5-2.5 3 3L10 5a1 1 0 0 1-1-1zM4.5 8a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5z"/>
																  </svg>
															</span>

														</a>

													</div>
												</div>

											</div>


										</div>
									</div>
									<div class="row">

										<div class="col-12 ">
											<div class="card card-custom gutter-b bg-white border-0" >
												<div class="card-body" >
													<div >
														<div class=" table-responsive" id="printableTable">
                                                            <table id="orderTable" class="display" style="width:100%">

																<thead class="text-body">
																	<tr>
																		<th>ID</th>
																		<th >Site Name</th>
																		<th>Category</th>
																		<th>Rank</th>
																		<th>Total Room</th>
																		<th>Location Name</th>
																			<th>Phone</th>
																		<th>Email</th>
																		<th>Photo</th>

																	<th class="d-none d-lg-block">Descriptions</th>
																		<th>Status</th>

																		<th class="no-sort text-right">Action</th>
																	</tr>
																</thead>
																<tbody class="kt-table-tbody text-dark">
                                                                    @foreach ($sites as $site)
																	<tr class="kt-table-row kt-table-row-level-0">
																		<td >{{ $site->id }}</td>
																		<td>{{ $site->site_name }}</td>
																		<td>{{ $site->site_category }}</td>
																		<td>{{ number_format($site->site_rank) }}</td>
																		<td>{{ $site->room_no }}</td>
																		<td>{{ $site->location_name }}</td>
																		<td>{{ $site->phone }}</td>
																		<td>{{ $site->email }}</td>
																		 <td><div class="logo mr-auto"><img src="{{ URL::asset('/storage/sites/'.$site->photo) }}" width="60" height="40"></div></td>
																	
																		<td>{{ $site->site_description }}</td>
																		<td>{{ $site->status }}</td>
																		<td>
 <!-- start Modal -->
  <div class="modal fade" id="issue{{ $site->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit {{ $site->item }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           	<form id="myform" action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="row">

				<div class="col-12">
					<div class="form-group">
						<label class="text-dark" >Site Name </label>
						<input type="text" name="site_name" class="form-control" value="{{$site->site_name}}">
						<small  class="form-text text-muted">please enter site name</small>
					</div>

                    <div class="form-group">
						<label class="text-dark" >Category</label>
                        <select name="site_category" id="" class="form-control">
                          <option>{{$site->site_name}}</option>
                                        <option>Hotel</option>
                                          <option>Lodge</option>
                                      <option>Camp Site</option>
                                      <option>Other</option>
                        </select>
					</div>

                 <div class="form-group">
						<label class="text-dark" >Rank</label>
                        <select name="site_rank" id="" class="form-control">
                   
                                        <option>{{$site->site_rank}}</option>
                                          <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                            <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                        </select>
					</div>

             

                         <div class="form-group">
                        <label class="text-dark" >Number of Rooms</label>
                        <input type="number" name="room_no" class="form-control" name="room_no" min="0" required="" value="{{$site->room_no}}">
                        </div>

 	<div class="form-group">
						<label class="text-dark" >Location Name </label>
						<input type="text" name="location_name" class="form-control" value="{{$site->location_name}}">
						<small  class="form-text text-muted">please enter location name</small>
					</div>


                           <div class="form-group">
                        <label class="text-dark" >Phone</label>
                        <input type="number" name="phone" class="form-control" name="phone" min="0" value="{{$site->phone}}">
                        </div>

                       <div class="form-group">
                        <label class="text-dark" >Email</label>
                        <input type="mail" name="email" class="form-control" name="email" value="{{$site->email}}">
                        </div>

                <div class="form-group">
                        <label class="text-dark" >Description</label>
                        <textarea class="form-control" rows="3" id="site_description" name="site_description">{{$site->site_description}}</textarea>
                        </div>

				</div>

				     <div class="form-group">
                        <label class="text-dark" >Photo</label>
                        <input type="file" name="attachment[]" onChange="displayImage(this)" id="attachment" accept="image/*" class="" style="display:block;"> 
                        </div>


   <div class="form-group">
                      <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <!-- <h4>Update image</h4> -->
              </div>
              <img src="images/no.png" onClick="triggerClick()" id="profileDisplay" width="100px">
            </span>
  </div>



			</div>
			<button type="submit" class="btn btn-primary">Update</button>
		  </form>
        </div>

      </div>
    </div>
  </div>
  {{-- end of modal --}}


																			<div class="card-toolbar text-right">
																				<button class="btn p-0 shadow-none" type="button" id="dropdowneditButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																					<span class="svg-icon">
																						<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-three-dots text-body" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
																							<path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
																						</svg>
																					</span>
																				</button>
																				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdowneditButton2"  style="position: absolute; transform: translate3d(1001px, 111px, 0px); top: 0px; left: 0px; will-change: transform;">


                                                                                    <a href="{{ route('update-site',$site->id) }}" class="btn-success dropdown-item click-delete" id="click-edit1" onclick="return confirm(id='Are you sure you want to Recovery this  {{$site->site_name}}')">Recovery</a>
                                                                                

                                                                                <form action="{{ route('sites.destroy',$site->id) }}" method="POST">
                                                                                    @csrf
                                                                                    <input type="hidden" name="_method" value="delete">
																					<input type="submit" class="dropdown-item" value="Permanent delete" onclick="return confirm(id='Are you sure you want to delete Permanently this site?')">
                                                                                </form>
																				</div>
																				</div>
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


					</div>

				</div>




	<div  class="offcanvas offcanvas-right kt-color-panel p-5 kt_notes_panel">
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
			<h4 class="font-size-h4 font-weight-bold m-0">Add Site
			</h4>
			<a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary kt_notes_panel_close" >
				<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
				</svg>
			</a>
		</div>
		<form id="myform" action="{{ route('sites.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
			<div class="row">

				<div class="col-12">
					<div class="form-group">
						<label class="text-dark" >Site Name </label>
						<input type="text" name="site_name" class="form-control" placeholder="site name">
						<small  class="form-text text-muted">please enter site name</small>
					</div>

                    <div class="form-group">
						<label class="text-dark" >Category</label>
                        <select name="site_category" id="" class="form-control">
                          <option value="">--Select Category--</option>
                                        <option>Hotel</option>
                                          <option>Lodge</option>
                                      <option>Camp Site</option>
                                      <option>Other</option>
                        </select>
					</div>

                 <div class="form-group">
						<label class="text-dark" >Rank</label>
                        <select name="site_rank" id="" class="form-control">
                   
                                       <option value="">--Select rank--</option>
                                          <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                            <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                        </select>
					</div>

             

                           <div class="form-group">
                        <label class="text-dark" >Number of Rooms</label>
                        <input type="number" name="room_no" class="form-control" name="room_no" min="0" required="">
                        </div>

 	<div class="form-group">
						<label class="text-dark" >Location Name </label>
						<input type="text" name="location_name" class="form-control" placeholder="location name">
						<small  class="form-text text-muted">please enter location name</small>
					</div>


                           <div class="form-group">
                        <label class="text-dark" >Phone</label>
                        <input type="number" name="phone" class="form-control" name="phgone" min="0">
                        </div>

                       <div class="form-group">
                        <label class="text-dark" >Email</label>
                        <input type="mail" name="email" class="form-control" name="email">
                        </div>

<div class="form-group">
                        <label class="text-dark">Description</label>
                        <textarea class="form-control" rows="3" id="site_description" name="site_description"></textarea>
                        </div>

				</div>

				     <div class="form-group">
                        <label class="text-dark" >Photo</label>
                        <input type="file" name="attachment[]" onChange="displayImage(this)" id="attachment" accept="image/*" class="" style="display:block;"> 
                        </div>


   <div class="form-group">
                      <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <!-- <h4>Update image</h4> -->
              </div>
              <img src="images/no.png" onClick="triggerClick()" id="profileDisplay" width="100px">
            </span>
  </div>



			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		  </form>
	</div>

	<iframe name="print_frame" width="0" height="0"  src="about:blank"></iframe>

</body>
<!--end::Body-->

</html>
@endsection
