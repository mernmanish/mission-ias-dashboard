@extends('admin.layouts.master')
@section('title','Topics Details')
@section('breadcrumb','Topics Details')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add/Update Topics Details
	</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<form id="topicform" method="post">
		@csrf
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Topics Details</h5>
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
						<label for="sub_id">Subject <span class="text-danger">*</span></label>
						<select name="sub_id" id="sub_id" class="form-control" style="padding:7px;">
                            <option value="">Select Subject</option>
                            @foreach(App\Models\Admin\Subject::where('status','1')->get() as $rows)
                            <option value="{{ $rows['id'] }}">{{ $rows['name'] }}</option>
                            @endforeach
                        </select>
					</div>
					<div class="form-group col-md-12">
						<label for="name">Topic <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter Topics">
						<span id="nameError" style="color: red;"></span>
					</div>
					<div class="form-group col-md-12">
                        <label for="image">Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <span id="imageError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="file">File</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <span id="fileError" style="color: red;"></span>
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
    <div class="col-md-9">
    	<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Topics Details</h5>
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
									<th>Subject</th>
                                    <th>Topic</th>
									<th>Image</th>
									<th>IP Address</th>
									<th>Status</th>
									<th>Create Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							 @php $i=1; @endphp
							@foreach($topiclist as $rows)
								<tr>
									<th>{{ $i; }}</th>
                                    <td>{{ empty($rows->sub->name) ? "" : $rows->sub->name }}</td>
									<td>{{ $rows['name'] }}</td>
									<td> <img src="{{ url('upload/img/'.$rows['image']) }}" alt="" style="height: 35px;"></td>
									<td>{{ $rows['ip_address'] }}</td>
									<td>
										<select class="form-control" name="status" id="status" style="padding: 7px;" onchange="changetopics('{{ $rows['id'] }}','{{ $rows['status'] }}')">
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
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="edittopics(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="deletetopics(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button>
												
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
	function changetopics(id,status)
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
		if(confirm("Are you Sure "+d+" the status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changetopics') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
				$('.alert').show().addClass('alert-primary').text("Status has been "+d+" Successfully");
				$('.alert').fadeOut(6000);
		  }  
	    });
	  }
	}
</script>
<script type="text/javascript">
	function deletetopics(id)
	{
		if(confirm('Are you to sure delete data?')){
			$.ajax({
				url:'{{ url('deletetopics') }}' + '/' + id,
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
<script type="text/javascript">
	function edittopics(id)
	{
		$.ajax({
			type:"GET",
			dataType:"json",
			url:"/edittopics/"+id,
			success:function(data)
			{
				//alert(data);
				$('#id').val(data.id);
				$('#name').val(data.name);
				$('#sub_id').val(data.sub_id);
                $('#remarks').val(data.remarks);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#topicform").validate({
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
        },
        sub_id:{
            required:true
        }
    },
    messages: {
        name:{
          required:"Please Enter Subject Topics"
        },
        sub_id:{
            required:"Please Select Subject"
        }
    },
  
    submitHandler: function() {
       var formData = new FormData($('#topicform')[0]);
      $.ajax({
                url: '{{ url('managetopics') }}',
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
                $('#topicform').trigger('reset');
             }
             else if (data.status=='avail') {
                 $('.alert').show().addClass('alert-warning').text("Data Already Added");
                $('.alert').fadeOut(6000); 
            }
          
             else{
                 $('.table').load(location.href + " .table");
                $('.alert').show().addClass('alert-success').text("Data Upadated Successfully");
                $('.alert').fadeOut(6000);
                $('#topicform').trigger('reset');
                 $('#topicform .btn-primary').text("Submit Details");
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
				$('#imageError').text(data.responseJSON.errors.image);
				$('#fileError').text(data.responseJSON.errors.file);
                return false;
            })
        }
  });
});
</script>
@endpush