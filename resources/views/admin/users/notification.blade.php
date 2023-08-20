@extends('admin.layouts.master')
@section('title', 'Send Notification')
@section('breadcrumb', 'Send Notification')
@section('content')
@if (session()->has('message'))
<script>
    swal({
        title: "Success !",
        text: "{{ session('message') }}",
        icon: "success",
        button: "OK",
        timer: 3000
   });
</script>
@endif
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Send Notification
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Send Notification</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('send-notification') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" >
                    {{-- <div class="form-group col-md-4">
                        <label for="gender">Course</label>
                        <select name="course_id" id="course_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course</option>
                            @foreach ($course as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('category_id') }}
                        </span>
                        @endif
                    </div> --}}
                    <div class="form-group col-md-4">
                        <label for="title">Message Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Message Title" id="title" name="title" required>
                        @if ($errors->has('title'))
                        <span class="help-block errorText">
                        {{ $errors->first('title') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-8">
                        <label for="message">Message <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Message" id="message" name="message" required>
                        @if ($errors->has('message'))
                        <span class="help-block errorText">
                        {{ $errors->first('message') }}
                        </span>
                        @endif
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-teal-400" id="btns">Submit Details <i class="icon-paperplane ml-2"></i></button>
            </div>
            </form>
	    </div>
    </div>
</div>
@endsection

@push('footscript')
<script type="text/javascript">
    $(document).ready(function(){
    $('#course_id').change(function(){
      var course_id = $('#course_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      if(course_id != '')
      {
       $.ajax({
        url:"{{ route('changeCategory') }}",
        method:"POST",
        dataType: 'json',
        data:{"course_id":course_id},
        success:function(data)
        {
            //alert($data);
         $('#category_id').html(data);
        }
       });
      }
      else
      {
       $('#category_id').html('<option value="">Select Category</option>');
      }
     });
     $('#category_id').change(function(){
      var category_id = $('#category_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      if(category_id != '')
      {
       $.ajax({
        url:"{{ route('changeSubCategory') }}",
        method:"POST",
        dataType: 'json',
        data:{"category_id":category_id},
        success:function(data)
        {
            //alert($data);
         $('#subcategory_id').html(data);
        }
       });
      }
      else
      {
       $('#subcategory_id').html('<option value="">Select Sub Category</option>');
      }
     });
    })
</script>
@endpush
