@extends('admin.layouts.master')
@section('title', 'Add Question')
@section('breadcrumb', 'Add Question')
@section('content')
<style>
    .form-group {
    margin-bottom: 0rem;
   }
   #loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background:url({{ asset('img/loader.gif') }}) no-repeat center center rgba(0,0,0,0.50);
    /* z-index: 99999; */
}
</style>
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add Question
        <a href="{{ url('view-test-series-question') }}/{{$test_id}}" class="btn btn-dark pull-right">All Question</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Question </h5>
				<div class="header-elements">
					<div class="list-icons">
                        @php
                        $total= explode(",",$test->no_of_question);
                        $totalS = array_sum($total);
                        @endphp
                        <a>Total Question {{$addedQuestion}}/{{$total_question}}</a>
                        <a id="excelformat" class="btn btn-info btn-sm pull-right"><i class="fa fa-download" aria-hidden="true"></i> Download Sample</a>
                        <a  class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#importtestseries"><i class="fa fa-upload" aria-hidden="true"></i> Bulk Upload</a>
                		{{-- Question No: {{$total_question}} /{{$total_question}} --}}
                	</div>
            	</div>
			</div>

            <form action="{{ route('addTestSeriesQuestion') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="id" id="id" >
                    <input type="hidden" name="test_id" id="test_id" value="{{$test->id}}">
                    <div class="form-group col-md-12">
                        <label for="test_category">Test Category</label>
                        <select name="test_category" id="test_category" class="form-control" style="padding: 7px;">
                            @foreach ($test_category as $rows => $vals)
                            <option value="{{$vals}}">{{$vals}}</option>
                           @endforeach
                        </select>
                        @if ($errors->has('test_category'))
                        <span class="help-block errorText">
                        {{ $errors->first('test_category') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="question"> Question <span class="text-danger">*</span></label>
                        <textarea name="question" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="question_image">Question Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="question_image" name="question_image">
                                <label class="custom-file-label" for="question_image">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('question_image'))
                        <span class="help-block errorText">
                        {{ $errors->first('question_image') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered btn-sm table-hover text-center">
                                <thead class="bg-dark">
                                    <tr>
                                        <th style="width: 15%">Option Group</th>
                                        <th style="width: 55%">Option</th>
                                        <th style="width: 30%">Option Image</th>
                                    </tr>
                                </thead>
                                <tbody id="appendCategory">
                                    <tr>
                                        <th>Option A</th>
                                        <td><input type="text" class="form-control" placeholder="Option A" id="option_a" name="option_a"></td>
                                        <td><input type="file" class="form-control" id="option_a_image" name="option_a_image">
                                            @if ($errors->has('option_a_image'))
                                            <span class="help-block errorText">
                                            {{ $errors->first('option_a_image') }}
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Option B</th>
                                        <td><input type="text" class="form-control" placeholder="Option B" id="option_b" name="option_b"></td>
                                        <td><input type="file" class="form-control" id="option_b_image" name="option_b_image">
                                            @if ($errors->has('option_b_image'))
                                            <span class="help-block errorText">
                                            {{ $errors->first('option_b_image') }}
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Option C</th>
                                        <td><input type="text" class="form-control" placeholder="Option C" id="option_c" name="option_c"></td>
                                        <td><input type="file" class="form-control" id="option_c_image" name="option_c_image">
                                            @if ($errors->has('option_c_image'))
                                            <span class="help-block errorText">
                                            {{ $errors->first('option_c_image') }}
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Option D</th>
                                        <td><input type="text" class="form-control" placeholder="Option D" id="option_d" name="option_d"></td>
                                        <td><input type="file" class="form-control" id="option_d_image" name="option_d_image">
                                            @if ($errors->has('option_d_image'))
                                            <span class="help-block errorText">
                                            {{ $errors->first('option_d_image') }}
                                            </span>
                                            @endif</td>
                                    </tr>
                                    @if($test->is_advance_mode=="yes")
                                    <tr>
                                        <th>Option E</th>
                                        <td><input type="text" class="form-control" placeholder="Option E" id="option_e" name="option_e"></td>
                                        <td><input type="file" class="form-control" id="option_e_image" name="option_e_image"></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mt-1">
                        <label for="answer"> Answer <span class="text-danger">*</span></label>
                        <select name="answer" id="answer" class="form-control" style="padding: 7px;">
                            <option value="">Select Answer</option>
                            <option value="A">Option A</option>
                            <option value="B">Option B</option>
                            <option value="C">Option C</option>
                            <option value="D">Option D</option>
                            @if($test->is_advance_mode=="yes")
                            <option value="E">Option E</option>
                            @endif
                        </select>
                        @if ($errors->has('answer'))
                        <span class="help-block errorText">
                        {{ $errors->first('answer') }}
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="solution"> Solution <span class="text-danger">*</span></label>
                        <textarea name="solution" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="solution_image">Solution Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="solution_image" name="solution_image">
                                <label class="custom-file-label" for="solution_image">Choose file</label>
                            </div>
                        </div>
                        @if ($errors->has('solution_image'))
                        <span class="help-block errorText">
                        {{ $errors->first('solution_image') }}
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
<div class="modal fade" id="importtestseries" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #d2242a;">
          <h5 class="modal-title text-white" id="exampleModalLabel">Import Test Series</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('importTestSeriesQuestion') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
        <div class="modal-body">
            <input type="hidden" name="test_id" id="test_id" value="{{$test_id}}">
            <label for="excel">Upload XLSX File <span class="text-danger">*</span></label>
            <input type="file" name="excel" id="excel" class="form-control" required>
            @if ($errors->has('excel'))
                <span class="help-block errorText">
                {{ $errors->first('excel') }}
                </span>
            @endif
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Import Excel</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('footscript')
<script>
        CKEDITOR.replace('question');
        CKEDITOR.replace('solution');
</script>
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

<script>
        $(function() {
            $( "form" ).submit(function() {
                $('#loader').show();
            });
        });
</script>
<script>
        $(document).ready(function(){
            $('#excelformat').on('click',function(e){
                e.preventDefault();
                if(confirm("Are you Want sure Download Sample"))
                {
                    window.location.href = '{{ asset('sample/question-bulk-upload.xlsx') }}'
                }
            });
        });
    </script>
@endpush
