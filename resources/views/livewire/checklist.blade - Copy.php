<div>
  @if($message)
                            <div class="alert alert-danger">
                              <h5   class="text-center">{{ $message }}</h5>
                            </div>
                            @endif

<div class="row">
</div>


            <div class="row">
                  <!-- <h4 class="title font-weight-bold text-center">List of Metaname</h4> -->
                  <div class="col-xl-12 col-md-12"><h5 class="title font-weight-bold text-center" >Checklist Master</h5></div>


            <div class="col-xl-12 col-md-12">                       
            @isset($metadatas)
                                  <div class="card card-custom gutter-b bg-white border-0">
                                    <div class="card-body">                                                      

    <form  method="post"  action="{{ route('checklist.store') }}" enctype="multipart/form-data">
                             @csrf                           
    <input type="hidden" name="_method" value="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="pd" id="pd">
            <!-- <input type="text" name="index[]" id="index">   -->

     <div class="form-group">
                        <select wire:model="indicator_id" name="indicator_id" id="indicator_id" class="form-control">
                           <option value="">--- Select Metaname ---</option>
                            @foreach ($metanames as $metaname)
                          <option value="{{$metaname->id}}">{{$metaname->metaname_name}}</option>

                            @endforeach
                        </select>
    </div>

     <label class="text-dark" ><b>Indicator Question</b></label>
      
 <div class="panel-group"  style="background-color:#fff !important">
  <div class="panel panel-default">
  @foreach ($pp as $p )
 
    
      <div class="panel-heading">
        <h4 class="panel-title">
         <div class="card">   
         <a data-toggle="collapse" href="#collapse{{$p->id}}" id="pid{{$p->id}}" class="panel-group btn-sm" onclick="myFunction({{$p->id}})" onkeyup ="myFunction({{$p->id}})" style="background-color:#6d802b !important">{{ $p->property_name  }}</a>
        <!-- <input type="text" name="prop[]" value="{{$p->id}}"> -->

       </div>
      </div>
      <div id="collapse{{$p->id}}" class="panel-collapse collapse">
               

      @foreach ($qns as $qn )    
       <div class="panel-group btn-sm" style="background-color:#f49d2a !important">{{ $qn->qns  }}</div>
            <div class="form-group">
       @foreach ($metadatas as $metadata)                                           
                                                                                                                                                                    
           @if($metadata->indicator_id ==$qn->id) 
           <div class="row">
             <div class="col-xl-6 col-md-6">
          <label>{{$metadata->answer}}</label>
          <input type="{{$metadata->datatype}}" name="ids[]" value="{{$metadata->id}}">
         </div> 
         </div>            
           @endif
    @endforeach 
              </div>
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"> <div class="card"><a data-toggle="collapse" href="#collaps{{$p->id}}">Description if any</a>
       </div>
      </div>
      <div id="collaps{{$p->id}}" class="panel-collapse collapse">
        <textarea id="desc" name="desc[]" placeholder="---enter description if any---" class="form-control"></textarea>
              </div>
    </div>
  </div>

 <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title"> <div class="card">    <a data-toggle="collapse" href="#collap{{$p->id}}">Photo if any</a>
       </div>
      </div>
      <div id="collap{{$p->id}}" class="panel-collapse collapse">
        
<div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                    <input type="file" name="attachment[]" onChange="displayImage(this)" id="attachment" accept="image/*" class="" style="display:block;"> 
                                   
                                </div>
                                </div>
        <div class="col-lg-8 col-md-6 col-sm-12">

            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
              </div>
              <img src="images/no.png" onClick="triggerClick()" id="profileDisplay">
            </span>
            </div>
      </div>

      </div>
    </div>
  </div>
   <!-- <button  class="btn-sm btn btn-primary float-right" type="submit">Savex <i class="fas fa-save"></i></button>  -->
               @endforeach

               <hr>
 <div class="col-md-12 col-sm-12">
 <button  class="btn-sm btn btn-primary float-right" type="submit">Save<i class="fas fa-save"></i></button> 
</div>
<hr>
   </div>   
   
   @endforeach
             </div>   
           </div>                       
                                </div>
                                 </div>
                                 <button  class="btn-sm btn btn-primary float-right" type="submit">Finish<i class="fas fa-save"></i></button> 

                                  @endisset 
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
const ages = [3, 10, 18,42, 20];

document.getElementById("demo").innerHTML = ages.findIndex(checkAge);

function checkAge(age) {
  return age >18;
}
</script>


<script>
     function numberWithCommas(n) {
    return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
     }

function myFunction(id) {
  //  alert(id);
    var pid="pd"+(id);
    $('#pd').val(id);


// const ages = [3, 10, 18, 20];
// ages.findIndex(checkAge);
// function checkAge(age) {
//   return age > 18;
// }
 //$('#index').val(id);
//alert(pid);
    // var upv="up_"+(id);
    // var anQty="qty"+(id);
    //   var antQty="tqty"+(id);
    // var aprice="price_"+(id);
    //   var asubtotal="subtotal_"+(id);
 //$('#'+pid+'').val(id);

    var descs=document.getElementById(desc).value;
     // var up=document.getElementById(upv).value;
     // var unitPrice=document.getElementById(aprice).value;      
     //    var StoreQty=document.getElementById(antQty).value;
      alert(descs);

 
//  var soldQty=numberWithCommas((ur*up).toFixed(2));
// if(ur>=0 && up>=0)
// { 
// //var soldQty=numberWithCommas((ur*up));
// //var subtotal=(unitPrice*soldQty).toFixed(2);   
//    //totalCost +=subtotal;

// //  if(Number(soldQty)<=Number(StoreQty))
// //  {
// //   $('#'+anQty+'').val(soldQty);
// //   $('#'+asubtotal+'').val(subtotal);
 //alert('kk');
const arr = [{id: 'a'}, {id: 'b'}, {id: 'c'}];
const index = arr.map(object => object.id).indexOf('c');
// alert(desc);
}


const fruits = ["apple", "banana", "cantaloupe", "blueberries", "grapefruit"];

const index = fruits.findIndex(fruit => fruit === "grapefruit");
 //alert(index);
// function numberWithCommas(n) {
//     return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//      }

 //     function sum()
 //     {
 //        $('.amount').each(function(){
 //            alert('df');
 //    //if statement here 
 //    // use $(this) to reference the current div in the loop
 //    //you can try something like...
 //    // if(condition){
 //    // }
 // });
 //     }
</script>
</div>
