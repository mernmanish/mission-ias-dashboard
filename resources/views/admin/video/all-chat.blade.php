@extends('admin.layouts.master')
@section('title','All Chat')
@section('breadcrumb','All Chat')
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
		<i class="fa fa-angle-double-right" aria-hidden="true"></i> List of Video Chat
    </h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of All Video Chat</h5>
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
								<th>Video Title</th>
								<th>Sender</th>
								<th>Message</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
                        <tbody>
                            @php $i =1; @endphp
                            @foreach($chat as $rows)
                            <tr>
                                <th>{{$i++}}</th>
                                <td><img src="{{asset($rows->video->image_link ?? '')}}" alt="" style="height: 35px;"></td>
                                <td>{{$rows->video->video_title ?? ''}}</td>
                                <td>{{$rows->user->name ?? ''}}</td>
                                <td>{{$rows->message ?? ''}}</td>
                                <td><button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target="#exampleModal" id="{{$rows->id}}" onclick="openmodal(this.id,'{{$rows->user_id}}')" style="font-size:14px;"><i class="fa fa-commenting" aria-hidden="true"></i></button></td>
                            </tr>
                            @endforeach
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
          <h5 class="modal-title" id="exampleModalLabel"> Video Chat Reply</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('add-reply-chat')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
                <div class="replyChatList">

                </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
            <div class="input-group mb-3">
                <input type="hidden" name="chat_id" id="chat_id" />
                <input type="text" class="form-control" name="message" id="message" required placeholder="Type Message..." aria-label="Type Message..." aria-describedby="basic-addon2">
                <div class="input-group-append" style="margin-left: 0rem;">
                  <button class="btn btn-sm bg-teal-400"  type="submit">Send</button>
                </div>
            </div>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection
@push('footscript')

<script type="text/javascript">
    function openmodal(id)
    {
        $('#chat_id').val(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
        var chat_id={"id":id};
        $.ajax({
            type: 'POST',
            url: '{{ route('reply-chat-list') }}',
            dataType: 'json',
            data: chat_id,
            success:function(data){
            //alert(data);
            console.log(data);
             $('.replyChatList').html(data);
            }
        });
    }
	function changevideos(id,status)
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
		if(confirm("Are you Sure "+d+" the Video status ?")){
			 $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
			$.ajax({
				url: '{{ url('changeVideos') }}',
				type: 'POST',
				dataType: 'json',
				data: {'id':id,'status':status},
				success:function(data){
			    //alert(data);
				$('.table').load(window.location + ' .table');
                swal({
                title: "Success !",
                text: "Video Status has been "+d+" Successfully",
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
