@extends('admin.layouts.master')
@section('title','All Assign Course')
@section('breadcrumb','All Assign Course')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of All Assign Course
	<a href="{{ route('add-assign-course') }}" class="btn btn-dark pull-right">Assign Course</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Assign Course</h5>
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
						<table class="table table-bordered table-hover" id="tableDD">
						<thead class="bg-teal-400">
							<tr>
								<th>#</th>
								<th>User Name</th>
								<th>Mobile</th>
								<th>Course Name</th>
								<th>Fee</th>
								<th>Join Date</th>
								<th>Expiry Date</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>

						<tbody>
							{{-- @php $i=1; @endphp
							@foreach($assignData as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
                                <td>{{$rows->user->name ?? 'N/A'}}</td>
								<td>{{$rows->user->mobile ?? 'N/A'}}</td>
								<td>{{ $rows->course->name ?? 'N/A' }}</td>
								<td>{{ $rows->amount ?? '' }}</td>
								<td>{{ date('d-F-Y',strtotime($rows->join_date)) ?? '' }}</td>
								<td>{{ date('d-F-Y',strtotime($rows->expire_date)) ?? '' }}</td>
								<td>
                                    @if($rows->status=="active")
                                    <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
								</td>
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">

												<a data-href="{{url("delete-assign-course/$rows->id")}}" onclick="deleteItem(this)" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</a>
                                                @if($rows['status']=="active")
                                                <a href="javascript:void(0)"  onclick="changeAssign('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Inactive</</a>
                                                @else
                                                <a href="javascript:void(0)"  onclick="changeAssign('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Active</</a>
                                                @endif
											</div>
										</div>
									</div>
								</td>
							</tr>
							@php $i++; @endphp @endforeach --}}
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
    $(function () {

    var table = $('#tableDD').DataTable({
        // processing: true,
        serverSide: true,
        ajax: "{{ route('all-assign-course') }}",
        columns: [
            {data: 'id', name: 'id'},
            // {data:  name: 'image', orderable: false, searchable: false},
            {data: 'userName', name: 'userName'},
            {data: 'userMobile', name: 'userMobile'},
            {data: 'userCourse', name: 'userCourse'},
            {data: 'amount', name: 'amount'},
            {data: 'joinDate', name: 'joinDate'},
            {data: 'expiryDate', name: 'expiryDate'},
            {data: 'status', name: 'status',},
            {data: 'actions', name: 'actions', orderable: false, searchable: false},
        ]
    });

  });
  </script>
<script type="text/javascript">
	function changeAssign(id,status)
	{
		var abc=status;
		if(abc=='inactive')
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
				url: '{{ url('changeAssign') }}',
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
