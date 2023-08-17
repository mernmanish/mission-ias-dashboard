@extends('admin.layouts.master')
@section('title', 'Update Study Material')
@section('breadcrumb', 'Update Study Material')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Update Study Material <a href="{{ route('all-study-material') }}" class="btn btn-dark pull-right">Study Material List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Study Material</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('create-study-material') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{$sm->id}}">
                    <div class="form-group col-md-4">
                        <label for="gender">Course</label>
                        <select name="course_id" id="course_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Course</option>
                            @foreach ($course as $rows)
                            <option value="{{$rows->id}}" {!! $sm->course_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
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
                            @if($sm->course_id==$rows->course_id)
                            <option value="{{$rows->id}}" {!! $sm->category_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
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
                            @if($sm->category_id==$rows->category_id)
                            <option value="{{$rows->id}}" {!! $sm->subcategory_id==$rows->id ? "selected" : '' !!}>{{$rows->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('subcategory_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="writer_name">Writer Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Writer Name" id="writer_name" name="writer_name" value="{{$sm->writer_name}}">
                        @if ($errors->has('writer_name'))
                        <span class="help-block errorText">
                        {{ $errors->first('writer_name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pdf_title">PDF Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter PDF Title" id="pdf_title" name="pdf_title" value="{{$sm->pdf_title}}">
                        @if ($errors->has('pdf_title'))
                        <span class="help-block errorText">
                        {{ $errors->first('pdf_title') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Price" id="price" name="price" onkeypress="if(this.value.length==4) return false;" onkeydown="return event.keyCode !== 69" value="{{$sm->price}}">
                        @if ($errors->has('price'))
                        <span class="help-block errorText">
                        {{ $errors->first('price') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Select Access <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" id="free" value="Free" {!! $sm->access=='Free' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="free">Free</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" value="Paid" id="paid" {!! $sm->access=='Paid' ? "checked" : '' !!}>
                                <label class="custom-control-label" for="paid">Paid</label>
                            </div>
                        </div>
                        @if ($errors->has('access'))
                        <span class="help-block errorText">
                        {{ $errors->first('access') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="pdf_file">PDF File</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="pdf_file" name="pdf_file">
                                <label class="custom-file-label" for="pdf_file">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('pdf_file'))
                        <span class="help-block errorText">
                        {{ $errors->first('pdf_file') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description">Study Material Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control">{{$sm->description}}</textarea>
                        @if ($errors->has('description'))
                        <span class="help-block errorText">
                        {{ $errors->first('description') }}
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
                        @if ($errors->has('image_link'))
                        <span class="help-block errorText">
                        {{ $errors->first('image_link') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Download Option <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="download_option" id="public" value="Public" {!! $sm->download_option=="Public" ? "checked" : '' !!}>
                                <label class="custom-control-label" for="public">Public</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="download_option" value="Private" id="private"  {!! $sm->download_option=="Private" ? "checked" : '' !!}>
                                <label class="custom-control-label" for="private">Private</label>
                            </div>
                        </div>
                        @if ($errors->has('download_option'))
                        <span class="help-block errorText">
                        {{ $errors->first('download_option') }}
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
    CKEDITOR.replace('description');
</script>
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
