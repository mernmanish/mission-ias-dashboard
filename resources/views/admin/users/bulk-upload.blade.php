@extends('admin.layouts.master')
@section('title', 'Bulk Upload')
@section('breadcrumb', 'Bulk Upload')
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
    z-index: 99999;
}
</style>
<div id='loader'></div>
<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Bulk Upload</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<button class="btn btn-success btn-sm" id="excelformat">Download Sample</button>
                	</div>
            	</div>
			</div>

            <form action="{{ route('import-user-excel') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <label for="excel">Upload XLSX File <span class="text-danger">*</span></label>
                    <input type="file" name="excel" id="excel" class="form-control" required>
                    @if ($errors->has('excel'))
                        <span class="help-block errorText">
                        {{ $errors->first('excel') }}
                        </span>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-teal-400" id="btns">Bulk Upload <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
	    </div>
    </div>
</div>
@endsection

@push('footscript')
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
                    window.location.href = '{{ asset('sample/assign-course.xlsx') }}'
                }
            });
        });
    </script>
@endpush
