@extends('admin.layouts.master')
@section('title','Course List')
@section('breadcrumb','Course List')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Courses
	<a href="{{ url('course') }}" class="btn btn-dark pull-right">Add New Course</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Course Details</h5>
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
					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-hover" id="table">
							<thead class="bg-teal-400">
								<tr>
									<th>#</th>
                                    <th>Image</th>
									<th>Course</th>
									<th>Duration</th>
                                    <th>Fee</th>
                                    <th>Discount Fee</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							 @php $i=1; @endphp
							@foreach($coursedata as $rows)
								<tr>
									<th>{{ $i; }}</th>
                                    {{-- <td><img src="{{ Storage::url($rows['image']) }}" alt="" style="height: 35px;"></td> --}}
                                    <td> <img src="{{ url('upload/img/'.$rows['image']) }}" alt="" style="height: 35px;"></td>
									<td>{{ $rows['name'] }}</td>
									<td>{{ $rows['duration'] }}</td>

									<td>{{ $rows['course_fee'] }}</td>
									<td>{{ $rows['discount_fee'] }}</td>

									<td>
										<select class="form-control" name="status" id="status" style="padding: 7px;" onchange="changecoursestatus('{{ $rows['id'] }}','{{ $rows['status'] }}')">
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
												<button id="{{ $rows['id'] }}" class="dropdown-item" onclick="editcourse(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                <a data-href="{{url("deletecourse/$rows->id")}}" onclick="deleteItem(this)" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
												{{-- <button id="{{ $rows['id'] }}" class="dropdown-item" onclick="deletecourse(this.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button> --}}

											</div>
										</div>
									</div>
								    </td>
								</tr>
							@php $i++; @endphp
							@endforeach
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

@endpush
