@extends('admin.layouts.master')
@section('title','Test Score')
@section('breadcrumb','Test Score')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Test Score
	<a href="javascript:void(0)" onclick="history.back()" class="btn btn-dark pull-right"><i class="fa fa-backward" aria-hidden="true"></i> Back</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Test Series</h5>
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
					<div class="table-responsive">
						<table class="table table-bordered table-hover" id="table">
						<thead class="bg-teal-400">
							<tr>
								<th>Rank</th>
								<th>Name</th>
								<th>Mobile No</th>
								<th>TQ</th>
                                <th>TA</th>
                                <th>NA</th>
								<th>CA</th>
                                <th>WA</th>
                                <th>Negative</th>
                                <th>Test Score</th>
								<th>Accuracy</th>
							</tr>
						</thead>

						 <tbody>
							@php $i=1; @endphp
							@foreach($score as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
								{{-- <td>{{ $rows->course->name }}</td>
								<td>{{ $rows->subcategory->name }}</td> --}}
								<td>{{$rows->user->name ?? ''}}</td>
								<td>{{$rows->user->mobile ?? ''}}</td>
								<td>{{$rows->total_question}}</td>
								<td>{{$rows->total_attempt}}</td>
								<td>{{$rows->not_attempt}}</td>
								<td>{{$rows->correct_answer}}</td>
								<td>{{$rows->wrong_answer}}</td>
								<td>{{$rows->negative_marks}}</td>
								<td>{{$rows->overall_score}} %</td>
								<td>{{$rows->accuracy}} %</td>
							</tr>

							@php $i++; @endphp @endforeach
						</tbody>
					  </table>
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
