<div>
  @if($message)
                            <div class="alert alert-danger">
                              <h5   class="text-center">{{ $message }}</h5>
                            </div>
                            @endif
            <div class="row">
                  <!-- <h4 class="title font-weight-bold text-center">List of Metaname</h4> -->
                  <div class="col-xl-12 col-md-12"><h5 class="title font-weight-bold text-center">Assign Roles to Department-(ARODE)</h5></div>



                <div class="col-xl-6 col-md-6">                       
                  <h5 class="title font-weight-bold text-center">List of Department</h5>                    <div class="card card-custom gutter-b bg-white border-0">
                                                           <div class="card-body">                                                      

    <form  method="post"  action="{{ route('assign-roles.store') }}" enctype="multipart/form-data">
                             @csrf                           
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
   
<div class="form-group">  

    @isset($departs)
          @foreach($departs as $depart)
      <div class="row">
      <div class="col-xl-9 col-md-9">{{$depart->unit_name}}</div>
     <div class="col-xl-3 col-md-3"><input type="checkbox" name="departs[]" value="{{$depart->id}}"></div>                     
   </div> 
   @endforeach  
   @endisset 
</div>
  
                                     
                                </div>
                                 </div>
                                 </div>



                       
                <div class="col-xl-6 col-md-6">                       
                  <h5 class="title font-weight-bold text-center">List of Roles</h5>                    <div class="card card-custom gutter-b bg-white border-0">
                                                           <div class="card-body">                         
<div class="form-group">

     @isset($roles)
      @foreach($roles as $role)
      <div class="row">
      <div class="col-xl-9 col-md-9">{{$role->name}}</div>
     <div class="col-xl-3 col-md-3"><input type="checkbox" name="roles[]" value="{{$role->id}}"></div>                     
   </div> 
   @endforeach 
   @endisset 
</div>
  
                                     
                                </div>
                                  <div class="wawa-bgcolor">
                                  <button  class="btn btn-dark float-right" type="submit">Appy</button>
                                 </div> 
                                 </div> 
                                 </div>                                                                                 
                                
                                   

                                   </form>

                                </div>
                                 </div>
                                 </div>
                                 </div>

  
<script type="text/javascript">
  $(document).ready(function() {
$('.qnNo').materialSelect();
});
</script>

<script>
  $("#con_people").on( "click", function() {
  
   //var price = document.getElementById('the_id_of_the_textbox').value; 
 var sum=0.00;
var p = $(this).val();
//
  // function numberWithCommas(n) {
  //   return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  //    }

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});


    var p1=3000; //1 price per person
    var p2=2604;//2-3 price per person
    var p3=2254;//4-5 price per person
    var p4=2076;//6-7 price per person
  

if(p>0)
{
    
  if(p==1)
  {
   sum=p1*p; 
 
  }
  else if(p==2 || p==3)
{
 sum=p2*p;
 }
  else if(p==4 || p==5)
{
 sum=p3*p;
 }
  else if(p==6 || p==7)
{
 sum=p4*p;
 }
  
sum=sum.toFixed(2);

//var val = parseFloat(sum);
sum= formatter.format(sum);
$('#total').val(sum);

}
else
{
    var v= $('#total').val(0.00); 
}

});
</script>
</div>
