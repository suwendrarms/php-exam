@extends('layouts.ui.web',['activePage'=>'prescriptions'])
@section('content')
<div class="card card-custom" style="min-height: 700px;">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
	@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
		<div class="card-title">
			<h3 class="card-label">Prescriptions
			<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
		</div>
		<div class="card-toolbar">
			<!--begin::Dropdown-->
			<div class="dropdown dropdown-inline mr-2">
			</div>
											
			<a href="{{route('prescriptions.add')}}" class="btn btn-primary font-weight-bolder" >
				<span class="svg-icon svg-icon-md">
					
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<circle fill="#000000" cx="9" cy="15" r="6" />
					<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
					</g>
					</svg>
				
					</span>New Record
			</a>			
		</div>
	</div>
	<div class="card-body">
										
		<div class="mb-7">
			<div class="row align-items-center">
				<div class="col-lg-3 col-xl-4">
													<!-- <div class="row align-items-center">
														<div class="col-md-12 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>				
													</div> -->
				</div>
				<div class="col-lg-9 col-xl-8 mt-5 mt-lg-0">
					<div class="row align-items-center">
						<div class="col-md-10 my-2 my-md-0">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
								<span>
								<i class="flaticon2-search-1 text-muted"></i>
								</span>
							</div>
						</div>
						<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>				
					</div>
													
				</div>
			</div>
		</div>
									
		<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
			<thead>
			    <tr class="datatable-row">
					<th title="Field #1">No</th>
					<th title="Field #2">Name</th>
					<th title="Field #3">Email</th>
					<th title="Field #4">Phone Number</th>
					<th title="Field #5">Delivery Address</th>
					<th title="Field #6">note</th>
                    <th title="Field #6">status</th>
                    <th title="Field #6">images</th>					
					<th title="Field #7">Action</th>
				</tr>
			</thead>
		<tbody>
        @if($prescriptions)
		@foreach($prescriptions as $as=>$val)
		<tr>
			<td>{{$as+1}}</td>
			<td>{{$val->name}}</td>
			<td>{{$val->email}}</td>
            <td>{{$val->phone_number}}</td>
            <td>{{$val->delivery_address}}</td>
            <td>{{$val->note}}</td>
            <td>
               @if($val->pStatus==0)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">Pending</span></span>
				@endif
				@if($val->pStatus==1)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">quotations Send</span></span>
				@endif
				@if($val->pStatus==2)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">Accept</span></span>
				@endif
				@if($val->pStatus==3)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">Reject</span></span>
				@endif
                @if($val->pStatus==4)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">Dispatch</span></span>
				@endif
				@if($val->pStatus==5)
				<span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">Please Contact</span></span>
				@endif
				
            </td>
            <td>
                @if(count($val->images)>0)
                <span class="d-inline-block" data-toggle="popover" data-content="Please Click Show Images">                 
                    <a data-fancybox="gallery" data-src="{{$val->images[0]}}">
                      <img src="{{$val->images[0]}}" width="50" height="50" id="img_show" />
                    </a>
                </span>
                @else
                <span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">N/A</span></span>
                @endif
            </td>
<td>
            <a href="{{route('prescriptions.view',$val->prescription_id)}}" class="btn btn-sm btn-clean btn-icon"  aria-expanded="true"><i class="la la-edit"></i></a>
													
</td>										
			

		</tr>
		@endforeach
		@endif	
           			
	    </tbody>
	    </table>
		<!--end: Datatable-->
	</div>						
</div>

@endsection

@section('footer')

	@include('includes.footer')

@endsection

@section('js')

<script src="{{ asset('ui/web/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<script>
$(document).on('click', '.show-m', function() {
  
	var id = $(this).attr('data-id');
	var name = $(this).attr('data-name');
	var phone = $(this).attr('data-phone');
	var vehicle = $(this).attr('data-vhi');

	$('#name').text(name);
	$('#phone').text(phone);
	$('#vhi').text(vehicle);
	$('#cus_id').val(id);

	var t=$('#form').attr('action','/update-customer-erp/'+id);

});

var i = 0;
    $("#dynamic-ar1").click(function () {
        ++i;
        $("#dynamicAddRemove1").append('<tr><td><input type="text" name="addShowroomSupervisors[' + i +
            '][vehi_name]" placeholder="Enter vehicle number" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field1">Delete</button></td></tr>'
            );
    });
    $(document).on('click', '.remove-input-field1', function () {
        $(this).parents('tr').remove();
    });

	$('#showroom').click(function(){
        if(this.checked==true){
            $('#sup1').removeClass('d-none'); 
        }else{
            $('#sup1').addClass('d-none');
        }
    });

	$(document).on('click', '.edit-erp', function() {
  
		var id = $(this).attr('data-id');
		var ve = $(this).attr('data-erp');

		$('#u_id').val(id);
		$('#erp_id').val(ve);

	});

$(document).on('click', '.add-trash', function() {
  
  var content_id = $(this).attr('data-id');
  var v_id = $(this).attr('data-ve');
  var row = $(this).closest("tr");
  console.log(content_id);
 
   $.confirm({
	 title: 'Are you sure?',
	 content: 'you want to delete this',
	 buttons: {
		confirm: function () {

		   var formData = new FormData();

		   formData.append('id', content_id);
		   formData.append('v_id', v_id);
	  
		   $.ajaxSetup({
			 headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 }
		   });


		   $.ajax({
			  url : '/remove/customer',
			  method : 'POST',
			  data : formData,
			  processData: false,  
			  contentType: false, 
			  success : function(data) {
				  
				   if(data == 'success'){
					   $.alert({
						   title: 'Success',
						   content: 'Successfully deleted',
						   type: '',
					   });
					   row.hide();
				   }
								  
			  }
				   
		   });
	   
		},
		cancel: function () {

		},
	 }
 }); 

});
</script>
@endsection