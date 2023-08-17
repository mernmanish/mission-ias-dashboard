@extends('admin.layouts.master')
@section('title','User List')
@section('breadcrumb','User List')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Users</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Users</h5>
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
								<th>Image</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
                                <th>City</th>
								<th>Joined Date</th>
								<th>Status</th>
                                <th>Action</th>
							</tr>
						</thead>

						<tbody>
							{{-- @php $i=1; @endphp
							@foreach($user as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
								<td><img src="{{asset($rows->image_link)}}" alt="" style="height: 35px;"></td>
								<td>{{$rows->name}}</td>
								<td>{{$rows->mobile}}</td>
								<td>{{$rows->email}}</td>
								<td>{{date('d-F-Y',strtotime($rows->created_at))}}</td>

								<td>
                                    @if($rows->status=='active')
                                    <span class="badge rounded-pill bg-success">Active</span>
                                    @elseif($rows->status=='inactive')
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @else
                                    <span class="badge rounded-pill bg-warning">Block</span>
                                    @endif
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
        ajax: "{{ route('all-users') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'image', name: 'image', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'mobile', name: 'mobile'},
            {data: 'email', name: 'email'},
            {data: 'city', name: 'city'},
            {data: 'joinDate', name: 'joinDate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},
        ]
    });

  });
  </script>

<script type="text/javascript">
	function changeNews(id,status)
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
				url: '{{ url('changeNews') }}',
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
