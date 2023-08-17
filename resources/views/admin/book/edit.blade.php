@extends('admin.layouts.master')
@section('title', 'Update Book')
@section('breadcrumb', 'Update Book')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Update Book <a href="{{ route('all-books') }}" class="btn btn-dark pull-right">Books List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update Book Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('store-book') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{$book->id}}">
                    <div class="form-group col-md-4">
                        <label for="book_title">Book Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Book Title" id="book_title" name="book_title" value="{{$book->book_title}}">
                        @if ($errors->has('book_title'))
                        <span class="help-block errorText">
                        {{ $errors->first('book_title') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="book_price">Book Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Book Price" id="book_price" name="book_price" onkeypress="if(this.value.length==4) return false;" onkeydown="return event.keyCode !== 69" value="{{$book->book_price}}">
                        @if ($errors->has('book_price'))
                        <span class="help-block errorText">
                        {{ $errors->first('book_price') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="book_sale_price">Book Sale Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Sale Book Price" id="book_sale_price" name="book_sale_price" onkeypress="if(this.value.length==4) return false;" onkeydown="return event.keyCode !== 69"  value="{{$book->book_sale_price}}">
                        @if ($errors->has('book_sale_price'))
                        <span class="help-block errorText">
                        {{ $errors->first('book_sale_price') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="book_link">Book Link <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Book Link" id="book_link" name="book_link" value="{{$book->book_link}}">
                        @if ($errors->has('book_link'))
                        <span class="help-block errorText">
                        {{ $errors->first('book_link') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="image">Image <span class="text-danger">*</span></label>
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
                        <label for="description">Book Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control">{{$book->description}}</textarea>
                        @if ($errors->has('description'))
                        <span class="help-block errorText">
                        {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="book_pdf">Book PDF</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="book_pdf" name="book_pdf">
                                <label class="custom-file-label" for="image_link">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('book_pdf'))
                            <span class="help-block errorText">
                            {{ $errors->first('book_pdf') }}
                            </span>
                        @endif

                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-teal-400" id="btns">Book Details <i class="icon-paperplane ml-2"></i></button>
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
@endpush
