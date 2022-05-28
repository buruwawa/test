

<div>

            <div class="row">
                <div class="col-xl-12 col-md-12">
                        <div class="">
                            <h4 class="title font-weight-bold text-center">Set Indicator Question</h4>
                            <hr>
                            @if($message)
                            <div class="alert alert-danger">
                              <h5   class="text-center">{{ $message }}</h5>
                            </div>
                            @endif
                        </div>


                            <div class="card card-custom gutter-b bg-white border-0   table-contentpos">
                            @isset($metadatas)
                                <div class="card-body">                                                        

                                <div class="">
                               
                                      <!-- <form wire:submit.prevent="storeProperty(2,3)"> -->
                                           <form  method="post"  action="{{ route('setIndicator.store') }}" enctype="multipart/form-data">
                             @csrf
                           

                                
       <div class="form-group">
            <label class="text-dark" >Indicator Question</label>
                        <textarea type="text" name="question" id="question" class="form-control" maxlength="220" required></textarea>
        </div>


  <div class="form-group">
            <label class="text-dark" >Apply Indicator to</label>
                        <select name="applied_to" id="applied_to" class="form-control" required>
                          <option value="">--- Select location to apply ---</option>                         
                         
                         @foreach($metanames as $metaname)
                         <option value="{{$metaname->id}}">{{$metaname->metaname_name}}</option>
                            @endforeach                      
                    </select>
      </div>

                                     
      <div class="form-group">
            <label class="text-dark" >Question Type</label>
                        <select name="qns_type" id="qns_type" class="form-control" required>
                          <option value="">--- Select type of Question ---</option>                        
                         
                         <option value="text">Normal Qns</option>
                          <option value="radio">Option Qns</option>
                           <option value="checkbox">Checklist Qns</option>
                        <option value="textarea">Description Qns</option>                      
                    </select>
      </div>

  
    <div class="form-group">
           <label class="text-dark" >Number of Options Answers</label>
                        <select wire:model="metaname_id" name="metaname_id" id="metaname_id" class="form-control" required>
                          <option value="">--- Select group name ---</option>
                              <option value="2">2</option>
                           <option value="3">3</option>
                              <option value="4">4</option>
                                  <option value="5">5</option>
                                   <option value="6">6</option>
                                      <option value="7">7</option>
                                       <option value="8">8</option>

            </select>
    </div>

                                        <input type="hidden" name="_method" value="post">
                                               <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <!-- <input type="text" name="metaname_id" value="{{$metaname_id}}"> -->

                                         
                                               <table class="table table-responsive table-hover">
                                                   <thead>
                                                      
                                                   </thead>
                                                   <tbody>                                         
                                             
                                                     
                                                          
                                                           @for ($i = 0; $i <$metaname_id; $i++)
                                                             <tr>
                                                            <td>Answer{{$i}}</td>
                                                            <td> <input type="text" name="names[]" required=""></td>                                                           
                                                          @endfor
                                                            @else
                                                            <td>
                                                                   <textarea name="names[]" required=""></textarea>
                                                             <td>
                                                            @endif

                                                           </td>

                                                       </tr>
                                                    

                                                   </tbody>                                                   
                                               </table>
                                           
                                       </div>
                                   
<button  class="btn-sm btn btn-primary float-right" type="submit">Save <i class="fas fa-save"></i></button>
                                   </form>

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
</script
