@extends('admin.layouts.master')
@section('title','Course Details')
@section('breadcrumb','Course Details')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add/Update Course Details <a href="{{ url('course-list') }}" class="btn btn-dark pull-right">Course List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<form id="courseform" method="post">
		@csrf
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Course</h5>
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
					<div class="form-group col-md-4">
						<label for="name">Course Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter Course Name">
						<span id="nameError" style="color: red;"></span>
					</div>
                    <div class="form-group col-md-4">
                        <label for="image">Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <span id="imageError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="syllabus">Syllabus</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="syllabus" name="syllabus">
                                <label class="custom-file-label" for="syllabus">Choose file</label>
                            </div>
                        </div>
                        <span id="syllabusError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-4">
						<label for="duration">Course Duration <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="duration" id="duration" placeholder="Enter Course Duration">
						<span id="durationError" style="color: red;"></span>
					</div>
                    <div class="form-group col-md-4">
						<label for="course_fee">Course Fee <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="course_fee" id="course_fee" placeholder="Enter Course Fee">
						<span id="durationError" style="color: red;"></span>
					</div>
                    <div class="form-group col-md-4">
						<label for="discount_fee">Discount Fee <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="discount_fee" id="discount_fee" placeholder="Enter Discount Fee">
						<span id="durationError" style="color: red;"></span>
					</div>

					<div class="form-group col-md-12">
						<label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Short Description"></textarea>
					</div>
				</div>
	        </div>
	        <div class="card-footer">
	        	<button type="submit" class="btn bg-teal-400">Submit Details <i class="icon-paperplane ml-2"></i></button>
	        </div>
	    </div>
	    </form>
    </div>

</div>
@endsection
@push('footscript')
<script type="text/javascript">
	function changecoursestatus(id,status)
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
		if(confirm("Are you Sure "+d+" the  status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changecoursestatus') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
				$('.alert').show().addClass('alert-primary').text(" Status has been "+d+" Successfully");
				$('.alert').fadeOut(6000);
		  }
	    });
	  }
	}
</script>

<script type="text/javascript">
	function editcourse(id)
	{

		$.ajax({
			type:"GET",
			dataType:"json",
			url:"/editcourse/"+id,
			success:function(data)
			{
                //alert(data);
				$('#id').val(data.id);
				$('#name').val(data.name);
                $('#code').val(data.code);
                $('#duration').val(data.duration);
                $('#remarks').val(data.remarks);
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
        CKEDITOR.replace('description');
      $("#courseform").validate({
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
          required:"Please Enter Course Category"
        }
    },

    submitHandler: function() {
       var formData = new FormData($('#courseform')[0]);
      $.ajax({
                url: '{{ url('managecourse') }}',
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
                text: "Course added Successfully",
                icon: "success",
                button: "OK",
                timer: 3000
           });
                $('#courseform').trigger('reset');
             }
             else if (data.status=='avail') {
                 $('.alert').show().addClass('alert-warning').text("Data Already Added");
                $('.alert').fadeOut(6000);
            }

             else{
                 $('.table').load(location.href + " .table");
                $('.alert').show().addClass('alert-success').text("Data Upadated Successfully");
                $('.alert').fadeOut(6000);
                $('#id').val('');
                $('#courseform').trigger('reset');
                 $('#courseform .btn-primary').text("Submit Details");
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
                return false;
            })
        }
  });
});
</script>
@endpush
