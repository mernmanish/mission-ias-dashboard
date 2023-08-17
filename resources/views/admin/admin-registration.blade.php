@extends('admin.layouts.master')
@section('title','Admin Details')
@section('breadcrumb','Admin Details')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Admin
	<a href="{{ url('Add-Admin') }}" class="btn btn-dark pull-right">Add New Admin</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Admin Details</h5>
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
						<table class="table table-bordered table-hover datatable-highlight" id="table">
						<thead class="bg-teal-400">
							<tr>
								<th>#</th>
								<th>Image</th>
								<th>Full Name</th>
								<th>Mobile No</th>
								<th>State</th>
								<th>District</th>
								<th>City</th>
								<th>Pin Code</th>
								<th>Status</th>
								<th>Change Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							@php $i=1; @endphp
							@foreach($admins as $rows)
						    {{-- $state = App\Models\Admin\State::where('id',$rows['state_id'])->orderBy('name','asc')->get(); --}}
							<tr>
								<th>@php echo $i; @endphp</th>
								<td><img src="{{ Storage::url($rows['image']) }}" alt="" style="height: 35px;"></td>
								<td>{{ $rows['name'] }}</td>
								<td>{{ $rows['mobile'] }}</td>
								<td>{{ empty($rows->state->name) ? " " :$rows->state->name }}</td>
								<td>{{ empty($rows->dist->name) ? " " : $rows->dist->name }}</td>
								<td>{{ empty($rows->city->name) ? " " : $rows->city->name }}</td>
								<td>{{ $rows['pin_code'] }}</td>
								<td>@php if ($rows['status']=="1"){ echo '<span class="badge badge-success">Active</span>'; } else { echo '<span class="badge badge-danger">Inactive</span>'; } @endphp </td>
								<td>
									<select class="form-control" name="status" id="status" style="padding: 7px;" onchange="changeadmindata('{{ $rows['id'] }}','{{ $rows['status'] }}')">
											<option value="1" {!! $rows['status']=="1" ? "selected" : "" !!}>Active</option>
											<option value="0" {!! $rows['status']=="0" ? "selected" : "" !!}>Inactive</option>
									</select>
								</td>
								<td class="text-center">
									<div class="list-icons">
										<div class="dropdown">
											<a href="#" class="list-icons-item" data-toggle="dropdown">
												<i class="icon-menu9"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a href="{!! url('edit-admin').'/'.$rows['id'] !!}" class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="deleteadmin(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button>
												
											</div>
										</div>
									</div>
								</td>
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
	function changeadmindata(id,status)
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
		if(confirm("Are you Sure "+d+" the City status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changeadmindata') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
				$('.alert').show().addClass('alert-primary').text("City Status has been "+d+" Successfully");
				$('.alert').fadeOut(6000);
		  }  
	    });
	  }
	}
</script>
<script type="text/javascript">
	function deleteadmin(id)
	{
		if(confirm('Are you to sure delete data?')){
			$.ajax({
				url:'{{ url('admindelete') }}' + '/' + id,
				type:'GET',
				// dataType:'html',
				// data: {"id":id},
				success:function(data)
				{
					
					if(data.success)
					{
						$('.table').load(location.href + " .table");
						$('.alert').show().addClass('alert-danger').text("Data Deleted Successfully");
						$('.alert').fadeOut(3000);
					}
					else
					{
						$('.alert').show().addClass('alert-danger').text("We have faceing some issue,Plz contact to developer");
						$('.alert').fadeOut(3000);
					}
				}
			})
		}
	}
</script>
@endpush