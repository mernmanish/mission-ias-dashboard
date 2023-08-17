@extends('admin.layouts.master')
@section('title', 'State Details')
@section('breadcrumb', 'State Details')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add/Update State Details
	</h4>
</div>
<div class="row">
	<div class="col-md-4">
		<form id="stateform" method="post">
		@csrf
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add State Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>
			<div class="card-body">
				<div class="alert text-center" style="display: none;"></div>
				<div class="row">
					<input type="hidden" name="id" id="id">
					<div class="form-group col-md-12">
						<label for="name">State <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter State">
						<span id="nameError" style="color: red;"></span>
					</div>
					<div class="form-group col-md-12">
						<label for="remarks">Remarks</label>
						<input type="text" class="form-control" name="remarks" id="remarks" placeholder="Enter Remarks">
						
					</div>
				</div>
	        </div>
	        <div class="card-footer">
	        	<button type="submit" class="btn bg-teal-400">Submit Details <i class="icon-paperplane ml-2"></i></button>
	        </div>
	    </div>
	    </form>
    </div>
    <div class="col-md-8">
    	<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> Add State Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-hover" id="table">
							<thead class="bg-teal-400">
								<tr>
									<th>#</th>
									<th>State</th>
									<th>IP Address</th>
									<th>Status</th>
									<th>Create Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							@php $i=1; @endphp
							@foreach($states as $rows)
								<tr>
									<th>{{ $i; }}</th>
									<td>{{ $rows['name'] }}</td>
									<td>{{ $rows['ip_address'] }}</td>
									<td>
										<select class="form-control" name="status" id="status" style="padding: 7px;" onchange="changestates('{{ $rows['id'] }}','{{ $rows['status'] }}')">
											<option value="1" {!! $rows['status']=="1" ? "selected" : "" !!}>Active</option>
											<option value="0" {!! $rows['status']=="0" ? "selected" : "" !!}>Inactive</option>
										</select>
									</td>
									<td>{{ date('d-m-Y',strtotime($rows['created_at'])) }}</td>
									<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="editstate(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="deletestate(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button>
												
											</div>
										</div>
									</div>
								    </td>
								</tr>
							@php $i++; @endphp
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
	        </div>
	       
	    </div>
    </div>
</div>
@endsection
@push('footscript')
<script type="text/javascript">
	function editstate(id)
	{
		$.ajax({
			type:"GET",
			dataType:"JSON",
			url:"/editstate/"+id,
			success:function(data)
			{
				$('#id').val(data.id);
				$('#name').val(data.name);
                $('#remarks').val(data.remarks);
			}
		});
	}
</script>
<script type="text/javascript">
	function changestates(id,status)
	{
		var abc=status;
		if(abc==0)
		{
			var d="Active";
		}
		else
		{
			var d="Inactive";
		}
		if(confirm("Are you Sure "+d+" the Status status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changestate') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
				$('.alert').show().addClass('alert-primary').text("Status Status has been "+d+" Successfully");
				$('.alert').fadeOut(6000);
		  }  
	    });
	  }
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#stateform").validate({
      	ignore: 'input[type=hidden], .select2-search__field',
        errorClass: 'validation-invalid-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },
       
        errorPlacement: function(error, element) {
            if (element.parents().hasClass('form-check')) {
                error.appendTo( element.parents('.form-check').parent() );
            }
            else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }
            else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }
            else {
                error.insertAfter(element);
            }
        },
    rules: {
        name:{
            required:true
        }
    },
    messages: {
        name:{
          required:"Please Enter State Name"
        }
    },
  
    submitHandler: function() {
       var formData = new FormData($('#stateform')[0]);
      $.ajax({
                url: '{{ url('managestate') }}',
                type: 'POST',
                dataType: 'json', 
                data: formData,
                contentType: false,
                cache: false,
                processData:false
            })
            .done(function(data) {
                //alert(data);
                if (data.success) {
                  if (data.status=="added") {
                $('.table').load(location.href + " .table");
                $('.alert').show().addClass('alert-primary').text("Data Added Successfully");
                $('.alert').fadeOut(6000);
                $('#stateform').trigger('reset');
             }
             else if (data.status=='avail') {
                 $('.alert').show().addClass('alert-warning').text("Data Already Added");
                $('.alert').fadeOut(6000); 
            }
          
             else{
                 $('.table').load(location.href + " .table");
                $('.alert').show().addClass('alert-success').text("Data Upadated Successfully");
                $('.alert').fadeOut(6000);
                $('#stateform').trigger('reset');
                 $('#stateform .btn-primary').text("Submit Details");
              } 
            }
            else{
                console.log(data);
                 // alert('hello');
                $('.alert').show().addClass('alert-danger').text("Data not Added");
                $('.alert').fadeOut(6000);
                return false;
              }  
            })
            .fail(function(data){
                $('#nameError').text(data.responseJSON.errors.name);
                return false;
            })
        }
  });
});
</script>
<script type="text/javascript">
	function deletestate(id)
	{
		if(confirm('Are you to sure delete data?')){
			$.ajax({
				url:'{{ url('statedelete') }}' + '/' + id,
				type:'GET',
				// dataType:'html',
				// data: {"id":id},
				success:function(data)
				{
					
					if(data.success)
					{
						$('.table').load(location.href + " .table");
						$('.alert').show().addClass('alert-danger').text("Data Deleted Successfully");
						$('.alert').fadeOut(3000);
					}
					else
					{
						$('.alert').show().addClass('alert-danger').text("We have faceing some issue,Plz contact to developer");
						$('.alert').fadeOut(3000);
					}
				}
			})
		}
	}
</script>
@endpush