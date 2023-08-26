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
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of Assign Course </h5>
                <div class="header-elements">
					<div class="list-icons">
                		<button class="btn bg-danger btn-sm" style="float: right" data-toggle="modal" data-target="#exampleModal">Search Assign Course</button>
                	</div>
            	</div>
				{{-- <div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div> --}}
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
                                <th>Payment Mode</th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-search" aria-hidden="true"></i> Search Course Assigned User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group col-md-8">
                <label for="book_title"> Search Users By Mobile No <span class="text-danger">*</span></label>
                <div class="input-group mb-1">
                    <input type="text" name="mobile" id="mobile" class="form-control mobile" placeholder="Search Users By Mobile No" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append" style="margin-left: 0rem;">
                      <button class="btn btn-danger search_mobile" type="button" style="padding: 0 10px 0 10px;">Go !</button>
                    </div>
                </div>
                <span class="errorText" style="display: none"></span>
            </div>
            <div class="search-student">
                <div class="table-responsive">
                    <table class="table  table-bordered table-hover">
                        <thead class="bg-teal-400">
                            <th>#</th>
                            <th>User Name</th>
                            <th>Mobile</th>
                            <th>Course</th>
                        </thead>
                        <tbody class="studentDataList">

                        </tbody>

                    </table>
                    <hr>
                </div>
            </div>
        </div>
        {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
      </div>
    </div>
  </div>
@endsection
@push('footscript')
<script>
    $(document).on('click','.search_mobile',function(){
        var searchUser=$('.mobile').val();
        if(searchUser =='')
        {
            $('.errorText').show().text('Please Enter Mobile No!')
        }
        else{
 		   $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	        });
		   var userData={"mobile":searchUser};

		    $.ajax({
		        type: 'POST',
		        url: '{{ route('searchAssignedCourse') }}',
		        dataType: 'json',
		        data: userData,
		        success:function(data){
                $('.studentDataList').html(data.output);
		        }
		    });
        }
    });
</script>
<script type="text/javascript">
    $(function () {

    var table = $('#tableDD').DataTable({
        // processing: true,
        "jQueryUI"   : true,
        "paging"     : true,
        "lengthMenu" : [ 10, 25, 50, 75, 100,500],
        "autoWidth"  : false,
        "stateSave"  : false,
        "order"      : [[ 0, 'asc' ]],
        "processing" : true,
        "scrollX"    : true,
        "serverSide" : true,
        "searching": false,
        //serverSide: true,
        ajax: "{{ route('all-assign-course') }}",
        columns: [
            {data: 'id', name: 'id'},
            // {data:  name: 'image', orderable: false, searchable: false},
            {data: 'user_name', name: 'user_name'},
            {data: 'mobile', name: 'mobile',sortable: true, searchable: true},
            {data: 'userCourse', name: 'userCourse'},
            {data: 'amount', name: 'amount'},
            {data: 'payment_mode', name: 'payment_mode'},
            {data: 'joinDate', name: 'joinDate'},
            {data: 'expiryDate', name: 'expiryDate'},
            {data: 'status', name: 'status',},
            {data: 'action', name: 'action', orderable: false, searchable: false},
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
