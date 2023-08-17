@extends('admin.layouts.master')
@section('title','All Study Materials')
@section('breadcrumb','All Study Materials')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Study Materials
	<a href="{{ route('add-study-material') }}" class="btn btn-dark pull-right">Add Study Materials</a></h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Study Materials</h5>
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
								<th>Course</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th>Writer Name</th>
								<th>Pdf</th>
								<th>Price</th>
								<th>Access</th>
								<th>Option</th>
								<th>Status</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>

						<tbody>
							@php $i=1; @endphp
							@foreach($sm as $rows)
							<tr>
								<th>@php echo $i; @endphp</th>
								<td><img src="{{asset($rows->image_link)}}" alt="" style="height: 35px;"></td>
								<td>{{ $rows->course->name }}</td>
								<td>{{ $rows->category->name }}</td>
								<td>{{ $rows->subcategory->name }}</td>
								<td>{{$rows->writer_name}}</td>
								<td><a href="{{asset($rows->pdf_file)}}" download><img src="{{asset('img/pdf.png')}}" alt="" style="height:35px;"></a></td>
								<td>{{$rows->price}}</td>
                                <td>{{$rows->access}}</td>
                                <td>{{$rows->download_option}}</td>
								<td>
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
												<a href="{{url("edit-study-material/$rows->id")}}" class="dropdown-item"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
												<a data-href="{{url("delete-study-material/$rows->id")}}" onclick="deleteItem(this)" class="dropdown-item"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</</button>
                                                @if($rows['status']==1)
                                                <a href="javascript:void(0)"  onclick="changematerials('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-down" aria-hidden="true"></i> Inactive</</button>
                                                @else
                                                <a href="javascript:void(0)"  onclick="changematerials('{{ $rows['id'] }}','{{ $rows['status'] }}')" class="dropdown-item"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Active</</button>
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
	function changematerials(id,status)
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
		if(confirm("Are you Sure "+d+" the  status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changeMaterials') }}',
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
