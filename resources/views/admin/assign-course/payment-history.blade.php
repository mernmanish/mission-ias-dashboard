@extends('admin.layouts.master')
@section('title','Online Payment')
@section('breadcrumb','Online Payment')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Online Payment
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Online Payment</h5>
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
								<th>#</th>
								<th>User Name</th>
								<th>Mobile</th>
								<th>Course Name</th>
								<th>Amount</th>
                                <th>Payment Date</th>
                                <th>Payment Mode</th>
                                <th>Payment Status</th>
							</tr>
						</thead>

						<tbody>
							 @php $i=1; @endphp
							@foreach($payment as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
                                <td>{{$rows->user->name ?? 'N/A'}}</td>
								<td>{{$rows->user->mobile ?? 'N/A'}}</td>
								<td>{{ $rows->course->name ?? 'N/A' }}</td>
								<td>{{ $rows->amount ?? '' }}</td>
                                <td>{{ date('d-F-Y',strtotime($rows->created_at)) ?? '' }}</td>
                                <td>{{ucwords($rows->payment_mode)}}</td>
                                <td>
                                    @if($rows->payment_status=="pending")
                                    <span class="badge rounded-pill bg-warning">Pending</span>
                                    @elseif($rows->payment_status=="paid")
                                    <span class="badge rounded-pill bg-success">Paid</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Failed</span>
                                    @endif
								</td>

								{{-- <td class="text-center">
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
								</td> --}}
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


@endpush
