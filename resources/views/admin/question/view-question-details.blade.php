@extends('admin.layouts.master')
@section('title','View Question Details')
@section('breadcrumb','View Question Details')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> View Question Details
        <a href="javascript:void(0)" class="btn btn-dark pull-right" onclick="history.back()"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> View Question Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>
			<div class="card-body">
				<div class="row">
                    <div class="col-md-12" >
                        <h4 style="display: flex;flex-direction:row">Q. &nbsp; {!! html_entity_decode($question->question) !!}</h4>
                    </div>
                    <div class="ml-3">
                        <div class="col-md-12">
                            <h4 @if($question->answer=="A") style="font-size: bold; color:#06cd0e;" @endif> A. {{$question->option_a}}</h4>
                        </div>
                        <div class="col-md-12">
                            <h4 @if($question->answer=="B") style="font-size: bold; color:#06cd0e;" @endif> B. {{$question->option_b}} </h4>
                        </div>
                        <div class="col-md-12">
                            <h4 @if($question->answer=="C") style="font-size: bold; color:#06cd0e;" @endif> C. {{$question->option_c}} </h4>
                        </div>
                        <div class="col-md-12">
                            <h4 @if($question->answer=="D") style="font-size: bold; color:#06cd0e;" @endif> D. {{$question->option_d}} </h4>
                        </div>
                        @if(!empty($question->option_e))
                        <div class="col-md-12">
                            <h4 @if($question->answer=="E") style="font-size: bold; color:#06cd0e;" @endif> E. {{$question->option_e}} </h4>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-12" >
                        <h4 style="display: flex;flex-direction:row">S. &nbsp; {!! html_entity_decode($question->solution) !!}</h4>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('footscript')
<script type="text/javascript">
	function ChangeTestSeries(id,status)
	{
		var abc=status;
		if(abc==0)
		{
			var d="Active";
		}
		else
		{
			var d="Inactive";
		}
		if(confirm("Are you Sure "+d+" the status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('ChangeTestSeries') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
                swal({
                title: "Success !",
                text: "Status has been "+d+" Successfully",
                icon: "success",
                button: "OK",
                timer: 3000
           });
		  }
	    });
	  }
	}
</script>

@endpush
