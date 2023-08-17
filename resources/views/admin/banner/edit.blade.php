@extends('admin.layouts.master')
@section('title', 'Update Banner')
@section('breadcrumb', 'Update Banner')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Update Banner <a href="{{ route('all-banner') }}" class="btn btn-dark pull-right">Banners List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Banner</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('addBanner') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{$banner->id}}">
                    <div class="form-group col-md-4">
                        <label for="gender">Course</label>
                        <select name="course_id" id="course_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course</option>
                            @foreach ($course as $rows)
                            <option value="{{$rows->id}}" {!!$rows->id==$banner->course_id ? 'selected' :    '' !!}>{{$rows->name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('course_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('course_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-8">
                        <label for="banner_title">Banner Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Banner Title" id="banner_title" name="banner_title" value="{{$banner->banner_title}}">
                        @if ($errors->has('banner_title'))
                        <span class="help-block errorText">
                        {{ $errors->first('banner_title') }}
                        </span>
                        @endif
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
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-teal-400" id="btns">Update Details <i class="icon-paperplane ml-2"></i></button>
            </div>
            </form>
	    </div>
    </div>
</div>
@endsection

@push('footscript')
@endpush
