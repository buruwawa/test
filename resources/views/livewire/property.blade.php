

<div>

            <div class="row">
                <div class="col-xl-4 col-md-4  ">
                    <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body">
                            <h4 class="title font-weight-bold text-center">Items List</h4>
                            <hr>
                            @if($message)
                            <div class="alert alert-danger">
                              <h5   class="text-center">{{ $message }}</h5>
                            </div>
                            @endif
                        </div>


                    <div class="product-items">
                       <form wire:submit.prevent="storeItem(2,3)">
    
                  <div class="form-group">
						<label class="text-dark" >Select Group Metaname</label>
                        <select wire:model="metaname_id" id="" class="form-control">
                        	<option value="">----------------</option>
                        	  @foreach ($metanames as $metaname)
                          <option value="{{$metaname->id}}">{{$metaname->metaname_name}}</option>

                            @endforeach
                        </select>
					</div>
			<button  class="btn-sm btn btn-primary" title="Delete" type="submit">Next <i class="fas fa-angle-right"></i></button>
					  </form>
                     
                            </div>
                    </div>
                </div>


                <div class="col-xl-5 col-lg-8 col-md-8">
{{-- start of product --}}
{{--  card card-custom gutter-b bg-white border-0  --}}
                            <div >
                            <div class="card card-custom gutter-b bg-white border-0   table-contentpos">


                                    <div class="card-body" style="height:700px  !important">

                        

                                <div class="table-datapos" style="height: 600px !important;">
                               
                                      <form wire:submit.prevent="storeProperty(2,3)">
                                        <input type="hidden" name="_method" value="PUT">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <div class="">
                                           <div>
                                               <table class="table table-responsive table-hover">
                                                   <thead>
                                                      
                                                   </thead>
                                                   <tbody>
                                               
                                                @foreach ($metadatas as $metadata )
                                                       <tr>

                                                           <td>{{ $metadata->metadata_name  }}</td>
                                                            <td>{{ $metadata->datatype  }}</td>

                                                           @if($metadata->datatype !='textarea')
                                                            <td> <input type="{{$metadata->datatype}}" wire:model="id{{$metadata->id }}" value="{{ $metadata->id }}"></td>
                                                            @else
                                                            <td>
                                                                   <textarea wire:model="id{{$metadata->id }}">{{ $metadata->id }}</textarea>
                                                                   @endif
                                                           <td>


                                                            <div class="card-toolbar text-right">
                                                                <input type="hidden" name="order_id" value="{{ $metadata->id }}">
                                                            <button wire:click.prevent="delete({{$metadata->id}})" class="btn-sm btn btn-danger" title="Delete" type="submit" name="delete" value="delet this item"><i class="fas fa-trash-alt"></i></button>
                                                            </div>



                                                           </td>

                                                       </tr>
                                                       @endforeach

                                                   </tbody>
                                                   <tfoot>
                                                       <th></th>
                                                       <th></th>
                                                       <th>Total</th>
                                                       <th>
                                                           </th>
                                                           <th></th>
                                               </tfoot>
                                               </table>
                                           
                                       </div></div>

<button  class="btn-sm btn btn-primary" title="Delete" type="submit">Submit <i class="fas fa-save"></i></button>
                                   </form>

                                </div>
                        </div>
                        </div>
                        </div>
                 </div>
                 <div class="col-xl-3 col-lg-4 col-md-4">
                     <div class="card card-custom gutter-b bg-white border-0">
                        <div class="card-body" >

                            <div class="resulttable-pos">

                                                      </div>
                        </div>
                     </div>
                 </div>
            </div>
        </div>
   </div>
    {{-- end of a new design --}}




<!-- start of price change Modal -->
{{-- <div class="modal fade" id="editprice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change price for this Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

        <table id="orderTable" class="display" style="width:100%">
            <thead>
                <tr>

                    <th>Name</th>
                    <th>Price</th>
                    <th class=" text-right no-sort"></th>
                </tr>
            </thead>
            <tbody>
              
            </tbody>
        </table>
    </div>
  </div>
  end of price modal

            </div>
        </div> --}}
   </div>


<div class="modal fade text-left" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14" style="display: none;" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="myModalLabel14">Draft Orders</h3>
        <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
          <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
          </svg>
        </button>
      </div>
      <div class="modal-body pos-ordermain">
          <div class="row">
           

            </div>
            </div>

          </div>
      </div>

    </div>


{{-- Start of Discount
<div class="modal fade text-left" id="discountpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel122" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="myModalLabel122">Add Discount</h3>
            <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
              <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
              </svg>
            </button>
          </div>
          <form action="{{ route('pos.update',$id) }}" method="POST">
              @csrf
              <input type="hidden" name="_method" value="PUT">
          <div class="modal-body">
              <div class="row">
                  <div class="col-12">
                    <label  class="text-body">Discount</label>
                    <fieldset class="form-group mb-3 d-flex">
                        <input type="hidden" name="order_id" value="{{ $id }}">
                        <input type="number" name="discount" min="0" max="{{ $po->subtotal*0.3 }}" class="form-control bg-white"  placeholder="Enter Discount">
                        <button type="submit" class="btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center">Apply</button>
                    </fieldset>
                    <input type="submit" name="discountoff" value="Reset Discount" class="btn btn-danger white pt-1 pb-1 justify-content-center">
                    <div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">

                        <h5 class="font-size-bold mb-0">Discount Applied of:</h5>
                        <h5 class="font-size-bold mb-0">Tsh. {{ $po->discount }}</h5>
                    </div>
                  </div>
              </div>
          </div>
        </form>
        </div>
    </div>
</div> --}}


</div>

