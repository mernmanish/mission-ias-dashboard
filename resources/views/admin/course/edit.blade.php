@extends('admin.layouts.master')
@section('title','Update Course')
@section('breadcrumb','Update Course')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Update Course <a href="{{ url('course-list') }}" class="btn btn-dark pull-right">Course List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<form action="{{route('manage-course')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Course</h5>
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
					<input type="hidden" name="id" id="id" value="{{$course->id}}">
                    <div class="form-group col-md-4">
						<label for="course_type_id">Course Type <span class="text-danger">*</span></label>
						<select name="course_type_id" id="course_type_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course Type</option>
                            @foreach ($cType as $rows)
                            <option value="{{$rows->id}}">{{$rows->course_type}}</option>
                           @endforeach
                        </select>
						@if ($errors->has('course_type_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('course_type_id') }}
                        </span>
                        @endif
					</div>
					<div class="form-group col-md-4">
						<label for="name">Course Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter Course Name" value="{{$course->name}}">
						@if ($errors->has('name'))
                        <span class="help-block errorText">
                        {{ $errors->first('name') }}
                        </span>
                        @endif
					</div>

                    <div class="form-group col-md-4">
                        <label for="syllabus">Syllabus</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="syllabus" name="syllabus">
                                <label class="custom-file-label" for="syllabus">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('syllabus'))
                        <span class="help-block errorText">
                        {{ $errors->first('syllabus') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image_link">Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image_link" name="image_link">
                                <label class="custom-file-label" for="image_link">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('image'))
                        <span class="help-block errorText">
                        {{ $errors->first('image') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
						<label for="duration">Course Duration <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="duration" id="duration" placeholder="Enter Course Duration" value="{{$course->duration}}">
						@if ($errors->has('duration'))
                        <span class="help-block errorText">
                        {{ $errors->first('duration') }}
                        </span>
                        @endif
					</div>
                    <div class="form-group col-md-4">
						<label for="course_fee">Course Fee <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="course_fee" id="course_fee" placeholder="Enter Course Fee" value="{{$course->course_fee}}">
						@if ($errors->has('course_fee'))
                        <span class="help-block errorText">
                        {{ $errors->first('course_fee') }}
                        </span>
                        @endif
					</div>
                    <div class="form-group col-md-4">
						<label for="discount_fee">Discount Fee <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="discount_fee" id="discount_fee" placeholder="Enter Discount Fee" value="{{$course->discount_fee}}">
						@if ($errors->has('discount_fee'))
                        <span class="help-block errorText">
                        {{ $errors->first('discount_fee') }}
                        </span>
                        @endif
					</div>

					<div class="form-group col-md-12">
						<label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter Short Description">{{$course->description}}</textarea>
                        @if ($errors->has('description'))
                        <span class="help-block errorText">
                        {{ $errors->first('description') }}
                        </span>
                        @endif
					</div>
				</div>
	        </div>
	        <div class="card-footer">
	        	<button type="submit" class="btn bg-teal-400">Update Details <i class="icon-paperplane ml-2"></i></button>
	        </div>
	    </div>
	    </form>
    </div>

</div>
@endsection
@push('footscript')
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
@endpush
