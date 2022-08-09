@extends('layouts.ui.web',['activePage'=>'showcase'])
@section('content')
<div class="card card-custom">
	<!-- <div class="card-header flex-wrap border-0 pt-6 pb-0"> -->
        <form class="form" method="post" action="{{route('quotations.send')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
      <input type="hidden" id="user_id" name="user_id" value="{{$prescription->user_id}}"/>
      <input type="hidden" id="prescription_id" name="prescription_id" value="{{$prescription->prescription_id}}"/>
        <div class="form-group row">
            <div class="col-lg-6">
            <label>Name:</label>
                <h4>{{$prescription->name}}</h4>
            </div>
            <div class="col-lg-6">
            <label>Vehicle Type:</label>
            <h4>{{$prescription->email}}</h4>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-6">
            <label>Address:</label>
                <h4>{{$prescription->delivery_address}}</h4>
            </div>
            <div class="col-lg-6">
            <label>Phone Number:</label>
            <h4>{{$prescription->phone_number}}</h4>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-12">
            <label>Note:</label>
            <h4>{{$prescription->note}}</h4>
            </div>
        </div>
        
        <div  class="form-group row">
            <div class="col-lg-12">
            <h4>Images</h4>
            </div>
        </div>
       <div  class="form-group row">
           <div class="col-lg-12">      
           @foreach($prescription->images as $img)
                <span class="d-inline-block" data-toggle="popover" data-content="Please Click Show Image ">                 
                    <a data-fancybox="gallery" data-src="{{$img}}">
                      <img src="{{$img}}" width="100" height="100" id="img_show" />
                </a>
                </span>                        
            @endforeach   
           </div>
       </div>

       <div  class="form-group row">
           <div class="col-lg-4">      
                <label>Delivery Address:</label>
                <select class="form-control" id="drug_id" name="drug">
                  @foreach($drugs as $drug)
                      <option value="{{$drug->id}}">{{$drug->name}}</option>
                  @endforeach                                        
                </select>
           </div>
           <div class="col-lg-4">      
                <label>Quantity:</label>
                <input type="text" name="qtr" id="qtr" class="form-control" placeholder="Enter name" required/>
           </div>
           <div class="col-lg-4 mt-5">
               <label></label>      
              <a href="javascript:void(0);" class="btn btn-primary mr-2" onclick="addPrice()">Submit</a>
           </div>
       </div>

       <div  class="form-group row">
           <div class="col-lg-12"> 
           @if($quotations)     
           <table class="table table-bordered" id="image_inerior">
                        <tr>
                            <th>Drug</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                        
                        <tbody id="table_tr">
                         
                           @foreach($quotations->drugs as $d)
                           <tr>
                            <td><p>{{$d->drug}}</p></td>
                            <td><p>{{$d->qtr}}</p></td>
                            <td><p>{{$d->amount}}</p></td>
                          </tr>
                            @endforeach
                         
                         
					
			                  </tbody>
                        <tr>
                            <th colspan="2"></th>
                            <th>Total : <h4 id="total">{{$quotations->amount}}</h4></th>
                        </tr>
                </table>
                @endif
           </div>
           
       </div>


          
        <div class="card-footer">
        
        <button type="submit" class="btn btn-primary mr-2">Send Quotation</button>
        <a href="{{route('prescriptions.index')}}" class="btn btn-outline-danger">Back</a>
        
        </div>
        </form>

</div>
@endsection
@section('footer')

	@include('includes.footer')

@endsection
@section('js')
<script src="{{ asset('ui/web/js/pages/crud/forms/editors/quill.js')}}"></script>

<script>
  function addPrice(){

    var drug= $("#drug_id").val();
    var qtr =$("#qtr").val();
    var user_id =$("#user_id").val();
    var prescription_id =$("#prescription_id").val();

    if(drug!="" && qtr!=""){

      var formData = new FormData();
 
			 formData.append('drug_id', drug);
			 formData.append('qtr', qtr);
       formData.append('user_id', user_id);
       formData.append('prescription_id', prescription_id);
		
			 $.ajaxSetup({
			   headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   }
			 });
 
 
			 $.ajax({
				url : '/quotations-process',
				method : 'POST',
				data : formData,
				processData: false,  
				contentType: false, 
				success : function(data) {
					
					 console.log(data.row);
           $("#table_tr").append('<tr><td><p>'+data.row.drug+'</p></td><td><p>'+data.row.qtr+'</p></td><td><p>'+data.row.amount+'</p></td></tr>');
						$("#total").text(data.amount);		
				}
					 
			 });

    }
    


  }
</script>
@endsection
@section('css')
<style>
#img_show {
  border: 5px solid #555;
}



.bubbleWrapper {
	padding: 10px 10px;
	display: flex;
	justify-content: flex-end;
	flex-direction: column;
	align-self: flex-end;
  color: #fff;
}
.inlineContainer {
  display: inline-flex;
}
.inlineContainer.own {
  flex-direction: row-reverse;
}
.inlineIcon {
  width:60px;
  object-fit: contain;
}
.ownBubble {
	min-width: 60px;
	max-width: 700px;
	padding: 14px 18px;
  margin: 6px 8px;
	background-color: #5b5377;
	border-radius: 16px 16px 0 16px;
	border: 1px solid #443f56;
 
}
.otherBubble {
	min-width: 60px;
	max-width: 700px;
	padding: 14px 18px;
  margin: 6px 8px;
	background-color: #6C8EA4;
	border-radius: 16px 16px 16px 0;
	border: 1px solid #54788e;
  
}
.own {
	align-self: flex-end;
}
.other {
	align-self: flex-start;
}
span.own,
span.other{
  font-size: 14px;
  color: grey;
}
</style>
@endsection