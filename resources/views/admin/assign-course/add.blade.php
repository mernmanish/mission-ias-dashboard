@extends('admin.layouts.master')
@section('title', 'Assign Course')
@section('breadcrumb', 'Assign Course')
@section('content')
<style>
    .form-group {
    margin-bottom: 0rem;
}
</style>
@if (session('error'))
        <script>
            swal({
                title: "Oops!",
                text: "{{ session('error') }}",
                icon: "warning",
                button: "OK",
            });
        </script>

@endif
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Assign Course <a href="{{ route('all-assign-course') }}" class="btn btn-dark pull-right">Assign Course List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Assign Course</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('store-assign-course') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" >
                    <div class="form-group col-md-4">
                        <label for="book_title">Search Users By Mobile No <span class="text-danger">*</span></label>
                        <div class="input-group mb-1">
                            <input type="text" name="mobile" id="mobile" class="form-control mobile" placeholder="Search Users By Mobile No" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append" style="margin-left: 0rem;">
                              <button class="btn btn-danger search_mobile" type="button" style="padding: 0 10px 0 10px;">Go !</button>
                            </div>
                        </div>
                        <span class="errorText" style="display: none"></span>
                        @if ($errors->has('mobile'))
                        <span class="help-block errorText">
                        {{ $errors->first('mobile') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="user_name">User Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="user_name" name="user_name" readonly>
                        <input type="hidden" class="form-control" id="user_id" name="user_id">
                        @if ($errors->has('user_name'))
                        <span class="help-block errorText">
                        {{ $errors->first('user_name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="user_name">Email Id </label>
                        <input type="text" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group col-md-8">
						<label for="name">Course <span class="text-danger">*</span></label>
						<select name="course_id" id="course_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course</option>
                            @foreach ($course as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('course_id') }}
                        </span>
                        @endif
					</div>
                    <div class="form-group col-md-4">
                        <label for="course_fee">Course Fee <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Course Fee" id="course_fee" name="course_fee" onkeypress="if(this.value.length==4) return false;" onkeydown="return event.keyCode !== 69">
                        @if ($errors->has('course_fee'))
                        <span class="help-block errorText">
                        {{ $errors->first('course_fee') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12 mt-1">
                        <label for="course_fee">Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-teal-400" id="btns">Assign Course <i class="icon-paperplane ml-2"></i></button>
            </div>
            </form>
	    </div>
    </div>
</div>
@endsection

@push('footscript')
<script>
    $(document).on('change','#course_id',function(){
        var course_id=$(this).val();
 		   $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
		   var userData={"course_id":course_id};

		    $.ajax({
		        type: 'POST',
		        url: '{{ route('getAssignCourse') }}',
		        dataType: 'json',
		        data: userData,
		        success:function(data){
                console.log(data);
		        $('#course_fee').val(data.discount_fee);
		        }
		    });
    });
</script>
<script>
    $(document).on('click','.search_mobile',function(){
        var searchUser=$('.mobile').val();
        if(searchUser =='')
        {
            $('.errorText').show().text('Please Enter Mobile No!')
        }
        else{
 		   $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
		   var userData={"mobile":searchUser};

		    $.ajax({
		        type: 'POST',
		        url: '{{ route('searchUser') }}',
		        dataType: 'json',
		        data: userData,
		        success:function(data){
                console.log(data);
		        $('#user_name').val(data.name);
		        $('#email').val(data.email);
		        $('#user_id').val(data.id);
		        }
		    });
        }
    });
</script>
@endpush
