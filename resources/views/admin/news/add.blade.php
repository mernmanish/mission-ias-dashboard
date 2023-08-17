@extends('admin.layouts.master')
@section('title', 'Add News')
@section('breadcrumb', 'Add News')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add News <a href="{{ route('all-news') }}" class="btn btn-dark pull-right">News List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add News Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('addNews') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" >
                    <div class="form-group col-md-4">
                        <label for="news_title">News Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter News Title" id="news_title" name="news_title">
                        @if ($errors->has('news_title'))
                        <span class="help-block errorText">
                        {{ $errors->first('news_title') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="date"> Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" placeholder="Enter Date" id="date" name="date">
                        @if ($errors->has('date'))
                        <span class="help-block errorText">
                        {{ $errors->first('date') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="time"> Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control" placeholder="Enter Time" id="time" name="time">
                        @if ($errors->has('time'))
                        <span class="help-block errorText">
                        {{ $errors->first('time') }}
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
                    <div class="form-group col-md-12">
                        <label for="description">News Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control"></textarea>
                        @if ($errors->has('description'))
                        <span class="help-block errorText">
                        {{ $errors->first('description') }}
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
<script>
    $(document).ready(function() {
        $(function() {
            $( "#date" ).datepicker();
        });
    })
</script>
<script type="text/javascript">
    CKEDITOR.replace('description');
</script>
@endpush
