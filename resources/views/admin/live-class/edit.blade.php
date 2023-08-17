@extends('admin.layouts.master')
@section('title', 'Edit Live Class')
@section('breadcrumb', 'Edit Live Class')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Edit Live Class <a href="{{ route('all-live-class') }}" class="btn btn-dark pull-right">Live Class List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Live Class</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('addLiveClass') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{$video->id}}">
                    <div class="form-group col-md-4">
                        <label for="gender">Course</label>
                        <select name="course_id" id="course_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course</option>
                            @foreach ($course as $rows)
                            <option value="{{$rows->id}}" {!! $video->course_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('category_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender">Category</label>
                        <select name="category_id" id="category_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Category</option>
                            @foreach ($category as $rows)
                            @if($video->course_id==$rows->course_id)
                            <option value="{{$rows->id}}" {!! $video->category_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('category_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender">Sub Category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Sub Category</option>
                            @foreach ($subCat as $rows)
                            @if($video->category_id==$rows->category_id)
                            <option value="{{$rows->id}}" {!! $video->subcategory_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('subcategory_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="video_title">Video Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Video Title" id="video_title" name="video_title" value="{{$video->video_title}}">
                        @if ($errors->has('video_title'))
                        <span class="help-block errorText">
                        {{ $errors->first('video_title') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="name">Video Link <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Video Link" id="video_link" name="video_link" value="{{$video->video_link}}">
                        @if ($errors->has('video_link'))
                        <span class="help-block errorText">
                        {{ $errors->first('video_link') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Video Source Type <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="source_type" id="station1" value="Station 1" {!! $video->source_type=='Station 1' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="station1">Station 1</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="source_type" id="station2" value="Station 2" {!! $video->source_type=='Station 2' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="station2">Station 2</label>
                            </div>
                        @if ($errors->has('source_type'))
                        <span class="help-block video_link">
                        {{ $errors->first('source_type') }}
                        </span>
                        @endif
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label class="custom-file-label" for="image_link">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('image_link'))
                        <span class="help-block video_link">
                        {{ $errors->first('image_link') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Select Access <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" id="free" value="Free" {!! $video->access=='Free' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="free">Free</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" value="Paid" id="paid" {!! $video->access=='Paid' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="paid">Paid</label>
                            </div>
                        </div>
                        @if ($errors->has('access'))
                        <span class="help-block video_link">
                        {{ $errors->first('access') }}
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
