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

<div class="row">
	<div class="col-md-8 offset-md-2">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-list" aria-hidden="true"></i> List of All Video Chat </h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a>Total Live Student: <span class="totalCountLive">0</span></a>
                	</div>
            	</div>
			</div>
			<div class="card-body" style="height: 600px; width: 100%;overflow-y: scroll;">
				<div class="row" id="refreshedContent">
                    {{-- @foreach($videoChat as $rows)
                    <div class="col-md-12">
                        <p style="font-size: 20px; font-weight:bold;"><i class="fa fa-user-circle-o"></i> {{$rows->user->name ?? 'Mission (Admin)'}}</p>
                        <p style="font-size: 16px;">{{$rows->message;}}</p>
                    </div>
                    @endforeach --}}
				</div>
			</div>
            <div class="card-footer">
                <form action="{{route('add-reply-chat')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="hidden" name="video_id" id="video_id" value="{{$id}}" />
                        <input type="text" class="form-control" name="message" id="message" required placeholder="Type Message..." aria-label="Type Message..." aria-describedby="basic-addon2">
                        <div class="input-group-append" style="margin-left: 0rem;">
                        <button class="btn btn-sm bg-teal-400"  type="submit">Send</button>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>
</div>
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> --}}
@endsection
@push('footscript')
<script>
    function refreshCountContent() {
        $.ajax({
            url:'{{ url('liveStudentCount') }}' + '/' + {{$id}}, // Replace with the URL of your data source
            success: function(data) {
                $('.totalCountLive').html(data); // Replace #refreshedContent with the ID of the element you want to refresh
            }
        });
    }

    $(document).ready(function() {
        setInterval(refreshCountContent, 2000); // Refresh every 2 seconds (2000 milliseconds)
    });
</script>
<script>
    function refreshContent() {
        $.ajax({
            url:'{{ url('liveChatView') }}' + '/' + {{$id}}, // Replace with the URL of your data source
            success: function(data) {
                $('#refreshedContent').html(data); // Replace #refreshedContent with the ID of the element you want to refresh
            }
        });
    }

    $(document).ready(function() {
        setInterval(refreshContent, 2000); // Refresh every 5 seconds (5000 milliseconds)
    });
</script>
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
