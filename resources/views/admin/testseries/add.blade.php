@extends('admin.layouts.master')
@section('title', 'Add Test Series')
@section('breadcrumb', 'Add Test Series')
@section('content')

<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add Test Series <a href="{{ route('all-test-series') }}" class="btn btn-dark pull-right">Test Series List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Test Series Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>

            <form action="{{ route('addTestSeries') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" >
                    <div class="form-group col-md-4">
                        <label for="gender">Course</label>
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
                        <label for="gender">Sub Category</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control" style="padding: 7px;">
                            <option value="">Select Sub Category</option>
                            @foreach ($subCat as $rows)
                            <option value="{{$rows->id}}">{{$rows->name}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('subcategory_id'))
                        <span class="help-block errorText">
                        {{ $errors->first('subcategory_id') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="test_series_name">Test Series Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Test Series Name" id="test_series_name" name="test_series_name">
                        @if ($errors->has('test_series_name'))
                        <span class="help-block errorText">
                        {{ $errors->first('test_series_name') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price">Price <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Price" id="price" name="price" onkeypress="if(this.value.length==4) return false;" onkeydown="return event.keyCode !== 69">
                        @if ($errors->has('price'))
                        <span class="help-block errorText">
                        {{ $errors->first('price') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="time">Time <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" placeholder="Enter Test Time in Minutes" id="time" name="time" onkeypress="if(this.value.length==3) return false;" onkeydown="return event.keyCode !== 69">
                        @if ($errors->has('time'))
                        <span class="help-block errorText">
                        {{ $errors->first('time') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="post_by">Post By <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Post By" id="post_by" name="post_by">
                        @if ($errors->has('post_by'))
                        <span class="help-block errorText">
                        {{ $errors->first('post_by') }}
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
                        <span class="help-block errorText">
                        {{ $errors->first('image_link') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered btn-sm table-hover text-center">
                                <thead class="bg-dark">
                                    <tr>
                                        <th style="width: 60%">Category</th>
                                        <th style="width: 30%">No of Question</th>
                                        <th style="width: 10%"><button type="button" class="btn btn-sm btn-primary" id="add">+ Add</button></th>
                                    </tr>
                                </thead>
                                <tbody id="appendCategory">
                                    <tr>
                                        <td> <input type="text" class="form-control" placeholder="Enter Test Category" id="test_category" name="test_category[]"></td>
                                        <td><input type="text" class="form-control" placeholder="Enter No of Question" id="no_of_question" name="no_of_question[]"></td>
                                        <td><button type="button" class="btn btn-danger" id="remove"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="description"> Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control"></textarea>
                        @if ($errors->has('description'))
                        <span class="help-block errorText">
                        {{ $errors->first('description') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="is_advance_mode" id="is_advance_mode" value="yes">
                                <label class="custom-control-label" for="is_advance_mode">Advance Mode</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" name="is_support_negative" id="is_support_negative" value="Yes">
                                <label class="custom-control-label" for="is_support_negative">Support Negative Marking</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-12 neg_marks" style="display: none;">
                        <label for="negative_marks">Negative Marks <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Negative Marks" id="negative_marks" name="negative_marks">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Select Access <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" id="free" value="Free" checked="">
                                <label class="custom-control-label" for="free">Free</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="access" value="Paid" id="paid">
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
                        <label for="">Test Type <span class="text-danger">*</span></label>
                        <div class="form-group mb-3 mb-md-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="test_type" id="live" value="Live" checked="">
                                <label class="custom-control-label" for="live">Live</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" name="test_type" value="Coming Soon" id="coming">
                                <label class="custom-control-label" for="coming">Coming Soon</label>
                            </div>
                        </div>
                        @if ($errors->has('test_type'))
                        <span class="help-block errorText">
                        {{ $errors->first('test_type') }}
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
       $(document).delegate('#add', 'click', function(event) {
        var html='<tr><td> <input type="text" class="form-control" placeholder="Enter Test Category" id="test_category" name="test_category[]"></td><td><input type="text" class="form-control" placeholder="Enter No of Question" id="no_of_question" name="no_of_question[]"></td><td><button type="button" class="btn btn-danger" id="remove"><i class="fa fa-trash"></i></button></td></tr>';
        $('#appendCategory').append(html);
        return false;
        });
       </script>
       <script type="text/javascript">
       $(document).ready(function(){

         $("#appendCategory").on('click','#remove',function(e){
            if(confirm("Are You want to sure Remove this instruction ?"))
            {
         $(this).parent('td').parent('tr').remove();
         return false;
            }
         });
       });
    </script>
<script type="text/javascript">
    CKEDITOR.replace('description');
    $(document).ready(function(){
        $('#is_support_negative').on('click',function(){
            if($(this).is(':checked'))
            {
                $('.neg_marks').show();
            }
            else{
                $('.neg_marks').hide();
            }
        });
    });
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
        url:"{{ route('changeSubCategoryData') }}",
        method:"POST",
        dataType: 'json',
        data:{"course_id":course_id},
        success:function(data)
        {
            //alert($data);
         $('#subcategory_id').html(data);
        }
       });
      }
      else
      {
       $('#subcategory_id').html('<option value="">Select SubCategory</option>');
      }
     });
    })
</script>
@endpush
