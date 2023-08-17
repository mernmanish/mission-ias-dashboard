@extends('admin.layouts.master')
@section('title','Course Type')
@section('breadcrumb','Course Type')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add/Update Course Type
	</h4>
</div>
<div class="row">
	<div class="col-md-4">
		<form id="categoryform" method="post">
		@csrf
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add  Course Type</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>
			<div class="card-body">
				{{-- <div class="alert text-center" style="display: none;"></div> --}}
				<div class="row">
					<input type="hidden" name="id" id="id">
					<div class="form-group col-md-12">
						<label for="course_type">Course Type <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="course_type" id="course_type" placeholder="Enter Course Type">
						<span id="course_typeError" style="color: red;"></span>
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
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Course Type</h5>
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
									<th>Course Type</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							 @php $i=1; @endphp
							@foreach($cType as $rows)
								<tr>
									<th>{{ $i; }}</th>
									<td>{{ $rows->course_type ?? '' }}</td>
									<td>
                                        @if($rows->status==1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                        @endif
									</td>
									<td class="">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="javascript:void(0)" id="{{ $rows['id'] }}" class="dropdown-item" onclick="editCourseType(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
												<a href="javascript:void(0)" id="{{ $rows['id'] }}" class="dropdown-item" onclick="deleteCourseType(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</a>
                                                @if($rows['status']==1)
                                                <a href="javascript:void(0)"  onclick="changesCourseType('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Inactive</</a>
                                                @else
                                                <a href="javascript:void(0)"  onclick="changesCourseType('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Active</</a>
                                                @endif
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
	function changesCourseType(id,status)
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
		if(confirm("Are you Sure "+d+" the Course Type status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changesCourseType') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
                swal({
                title: "Success !",
                text: "Course Type has been "+d+" Successfully",
                icon: "success",
                button: "OK",
                timer: 3000
           });
				// $('.alert').show().addClass('alert-primary').text("Category Status has been "+d+" Successfully");
				// $('.alert').fadeOut(6000);
		  }
	    });
	  }
	}
</script>
<script type="text/javascript">
	function deleteCourseType(id)
	{
		if(confirm('Are you to sure delete data?')){
			$.ajax({
				url:'{{ url('deleteCourseType') }}' + '/' + id,
				type:'GET',
				// dataType:'html',
				// data: {"id":id},
				success:function(data)
				{
					if(data.success)
					{
						$('.table').load(location.href + " .table");
						swal({
                            title: "Success !",
                            text: "Course Type Deleted Successfully",
                            icon: "success",
                            button: "OK",
                            timer: 3000
                    });
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
	function editCourseType(id)
	{
		$.ajax({
			type:"GET",
			dataType:"JSON",
			url:"/editCourseType/"+id,
			success:function(data)
			{
                console.log(data);
				$('#id').val(data.id);
				$('#course_type').val(data.course_type);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#categoryform").validate({
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
        course_type:{
            required:true
        }
    },
    messages: {
        course_type:{
          required:"Please Enter Course Type"
        }
    },

    submitHandler: function() {
       var formData = new FormData($('#categoryform')[0]);
      $.ajax({
                url: '{{ route('store-course-type') }}',
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
                swal({
                title: "Success !",
                text: "Course Type added Successfully",
                icon: "success",
                button: "OK",
                timer: 3000
           });
                $('#categoryform').trigger('reset');
             }
             else if (data.status=='avail') {
                swal({
                title: "Success !",
                text: "Course Type Already added",
                icon: "success",
                button: "OK",
                timer: 3000
           });
            }

             else{
                 $('.table').load(location.href + " .table");
                 swal({
                title: "Success !",
                text: "Course Type Updated Successfully",
                icon: "success",
                button: "OK",
                timer: 3000
              });
                $('#categoryform').trigger('reset');
                 $('#categoryform .btn-primary').text("Submit Details");
              }
            }
            else{
                console.log(data);
                 // alert('hello');
                 swal({
                title: "Error !",
                text: "Please Try Again",
                icon: "error",
                button: "OK",
                timer: 3000
           });
                return false;
              }
            })
            .fail(function(data){
                $('#course_typeError').text(data.responseJSON.errors.course_type);
                return false;
            })
        }
  });
});
</script>
@endpush
