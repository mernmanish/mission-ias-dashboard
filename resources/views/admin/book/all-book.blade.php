@extends('admin.layouts.master')
@section('title','All Books')
@section('breadcrumb','All Books')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Books
	<a href="{{ url('add-book') }}" class="btn btn-dark pull-right">Add Book</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Books</h5>
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
								<th>Image</th>
								<th>Book Title</th>
								<th>Book Price</th>
								<th>Book Sale Price</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>

						<tbody>
							@php $i=1; @endphp
							@foreach($book as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
								<td><img src="{{asset($rows->image_link)}}" alt="" style="height: 35px;"></td>
								<td>{{ $rows->book_title }}</td>
								<td>{{ $rows->book_price }}</td>
								<td>{{ $rows->book_sale_price }}</td>
								<td>
									{{-- <select class="form-control" name="status" id="status" style="padding: 7px;" onchange="changebook('{{ $rows['id'] }}','{{ $rows['status'] }}')">
											<option value="1" {!! $rows['status']=="1" ? "selected" : "" !!}>Active</option>
											<option value="0" {!! $rows['status']=="0" ? "selected" : "" !!}>Inactive</option>
									</select> --}}
                                    @if($rows->status==1)
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
												<a href="{{url("edit-book/$rows->id")}}" class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
												<a data-href="{{url("delete-book/$rows->id")}}" onclick="deleteItem(this)" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button>
                                                @if($rows['status']==1)
                                                <a href="javascript:void(0)"  onclick="changebook('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Inactive</</button>
                                                @else
                                                <a href="javascript:void(0)"  onclick="changebook('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Active</</button>
                                                @endif
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
	function changebook(id,status)
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
		if(confirm("Are you Sure "+d+" the Book status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ route('changeBooks') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
                swal({
                title: "Success !",
                text: "Book Status has been "+d+" Successfully",
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
