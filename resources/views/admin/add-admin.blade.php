@extends('admin.layouts.master')
@section('title', 'Add New Admin')
@section('breadcrumb', 'Add Admin Details')
@section('content')
<div class="mb-3">
	<h4 class="mb-0 font-weight-semibold">
		Add/Update Add New Admin <a href="{{ url('admin-list') }}" class="btn btn-dark pull-right">Admin List</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header header-elements-inline bg-dark">
				<h5 class="card-title"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Admin Details</h5>
				<div class="header-elements">
					<div class="list-icons">
                		<a class="list-icons-item" data-action="collapse"></a>
                		<a class="list-icons-item" data-action="reload"></a>
                		<a class="list-icons-item" data-action="remove"></a>
                	</div>
            	</div>
			</div>
            @php
            if(! empty($row)){
            @endphp
			<form id="adminform" method="post" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
				<div class="row">
					<input type="hidden" name="aid" id="aid" value="{{ $row['id'] }}">
					<div class="form-group col-md-3">
						<label for="name">Full Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="Enter Full Name" id="name" name="name" value="{{ $row['name'] }}">
                        <span id="nameError" style="color: red;"></span>
					</div>
					<div class="form-group col-md-3">
						<label for="">Mobile No <span class="text-danger">*</span></label>
						<input type="text" class="form-control" placeholder="Enter Mobile No" id="mobile" name="mobile" value="{{ $row['mobile'] }}">
                        <span id="mobileError" style="color: red;"></span>
					</div>
					<div class="form-group col-md-3">
						<label for="email">Email Id <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="email" name="email" placeholder="Enter Remarks" value="{{ $row['email'] }}">
                        <span id="emailError" style="color: red;"></span>
					</div>
					<div class="form-group col-md-3">
						<label for="gender">Gender</label>
						<select name="gender" id="gender" class="form-control" style="padding: 7px;">
							<option value="">Select Gender</option>
							<option value="Male" {!! $row['gender']=="Male" ? "selected" : '' !!}>Male</option>
							<option value="Female" {!! $row['gender']=="Female" ? "selected" : '' !!}>Female</option>
							<option value="Others" {!! $row['gender']=="Others" ? "selected" : '' !!}>Others</option>
						</select>
					</div>
					<div class="form-group col-md-3">
						<label for="state_id">State</label>
						<select name="state_id" id="state_id" class="form-control" style="padding: 7px;">
							<option value="">Select State</option>
                            @foreach (App\Models\State::where('status','1')->orderBy('name','asc')->get() as $rows)
							<option value="{{ $rows['id'] }}" {!! $row['state_id']==$rows['id'] ? "selected" : '' !!}>{{ $rows['name'] }}</option>
                           @endforeach
						</select>
					</div>
					<div class="form-group col-md-3">
                        <label for="dist_id">District</label>
                        <select name="dist_id" id="dist_id" class="form-control" style="padding: 7px;">
                            <option value="">Select District</option>
                            @foreach (App\Models\District::where(['status'=>'1','state_id'=>$row['state_id']])->orderBy('name','asc')->get() as $rows)
                               <option value="{{ $rows['id'] }}" {!! $row['dist_id']==$rows['id'] ? "selected" : '' !!}>{{ $rows['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
					<div class="form-group col-md-3">
						<label for="city_id">City</label>
						<select name="city_id" id="city_id" class="form-control" style="padding: 7px;">
                            <option value="">Select City</option>
                            @foreach(App\Models\City::where(['status'=>'1','dist_id'=>$row['dist_id']])->orderBy('name','asc')->get() as $rows)
                            <option value="{{ $rows['id'] }}" {!! $row['city_id']==$rows['id'] ? "selected" : '' !!}>{{ $rows['name'] }}</option>
                            @endforeach
                        </select>
					</div>
					<div class="form-group col-md-3">
						<label for="pin_code">Pin Code</label>
						<input type="text" class="form-control" id="pin_code" name="pin_code" placeholder="Enter Pin Code" value="{{ $row['pin_code'] }}">
					</div>
					<div class="form-group col-md-3">
						<label for="full_address">Full Address</label>
						<input type="text" name="full_address" id="full_address" class="form-control" placeholder="Enter Full Address" value="{{ $row['full_address'] }}">
					</div>
					<div class="form-group col-md-3">
						<label for="image">Image</label>
						<div class="input-group mb-3">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="image" name="image">
								<label class="custom-file-label" for="image">Choose file</label>
							</div>
						</div>
                        <span id="imageError" style="color: red;"></span>
					</div>
				</div>
	        </div>
	        <div class="card-footer">
	        	<button type="submit" class="btn bg-teal-400" id="btns">Submit Details <i class="icon-paperplane ml-2"></i></button>
	        </div>
	        </form>
            @php
            } else {
            @endphp
            <form id="adminform" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="alert text-center" style="display: none;"></div>
                <div class="row">
                    <input type="hidden" name="aid" id="aid" >
                    <div class="form-group col-md-3">
                        <label for="name">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Full Name" id="name" name="name">
                        <span id="nameError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">Mobile No <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Mobile No" id="mobile" name="mobile">
                        <span id="mobileError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="email">Email Id <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Remarks">
                        <span id="emailError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control" style="padding: 7px;">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="state_id">State</label>
                        <select name="state_id" id="state_id" class="form-control" style="padding: 7px;">
                            <option value="">Select State</option>
                            @foreach (App\Models\State::where('status','1')->orderBy('name','asc')->get() as $rows)
                            <option value="{{ $rows['id'] }}">{{ $rows['name'] }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="dist_id">District</label>
                        <select name="dist_id" id="dist_id" class="form-control" style="padding: 7px;">
                            <option value="">Select District</option>

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="city_id">City</label>
                        <select name="city_id" id="city_id" class="form-control" style="padding: 7px;">
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pin_code">Pin Code</label>
                        <input type="text" class="form-control" id="pin_code" name="pin_code" placeholder="Enter Pin Code">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="full_address">Full Address</label>
                        <input type="text" name="full_address" id="full_address" class="form-control" placeholder="Enter Full Address">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="image">Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                        <span id="imageError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                        <span id="passwordError" style="color: red;"></span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="con_password">Confirm Password</label>
                        <input type="text" class="form-control" id="con_password" name="con_password" placeholder="Enter Confirm Password">
                        <span id="con_passwordError" style="color: red;"></span>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-teal-400" id="btns">Submit Details <i class="icon-paperplane ml-2"></i></button>
            </div>
            </form>
            @php
            }
            @endphp
	    </div>
    </div>
</div>
@endsection

@push('footscript')
<script type="text/javascript">
    $(document).ready(function(){
    $('#state_id').change(function(){
      var state_id = $('#state_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      if(state_id != '')
      {
       $.ajax({
        url:"{{ url('changestates') }}",
        method:"POST",
        dataType: 'json',
        data:{"state_id":state_id},
        success:function(data)
        {
            //alert($data);
         $('#dist_id').html(data);
        }
       });
      }
      else
      {
       $('#dist_id').html('<option value="">Select District</option>');
      }
     });
     $('#dist_id').change(function(){
      var dist_id = $('#dist_id').val();
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
      if(dist_id != '')
      {
       $.ajax({
        url:"{{ url('changesdistricts') }}",
        method:"POST",
        dataType: 'json',
        data:{"dist_id":dist_id},
        success:function(data)
        {
            //alert($data);
         $('#city_id').html(data);
        }
       });
      }
      else
      {
       $('#city_id').html('<option value="">Select City</option>');
      }
     });
    })
</script>
<script type="text/javascript">
	$(document).ready(function(){
      $("#adminform").validate({
      	ignore: 'input[type=hidden], .select2-search__field',
        errorClass: 'validation-invalid-label',
        successClass: 'validation-valid-label',
        validClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
        },

        errorPlacement: function(error, element) {
            if (element.parents().hasClass('form-check')) {
                error.appendTo( element.parents('.form-check').parent() );
            }
            else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }
            else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }
            else {
                error.insertAfter(element);
            }
        },
    rules: {
        name:{
            required:true
        },
        mobile:{
        	required:true
        },
         password: {
         	required:true,
            minlength: 5
        },
        email:{
        	required:true,
        	email:true
        },
        con_password:{
        	equalTo: '#password'
        }
    },
    messages: {
        name:{
          required:"Please Enter Admin Name"
        },
        mobile:{
        	required:"Please Enter Mobile No"
        },
        password: {
            required: "Enter your password",
            minlength: jQuery.validator.format("At least {0} characters required")
        },
        email:{
        	required:"Please Enter Your Email id",
        	email:"Please Enter Valid Email Id"
        },
        con_password:{
        	equalTo:"Password Not Matched"
        }
    },

    submitHandler: function() {
       var formData = new FormData($('#adminform')[0]);
      $.ajax({
                url: '{{ url('manageadmin') }}',
                type: 'POST',
                dataType: 'json',
                data: formData,
                contentType: false,
                cache: false,
                processData:false
            })
            .done(function(data) {
                //alert(data);
                if (data.success) {
                  if (data.status=="added") {
                  $('.table').load(location.href + " .table");
               $('.alert').show().addClass('alert-primary').text("Data Added Successfully");
                $('.alert').fadeOut(6000);
                $('#adminform').trigger('reset');
             }
             else if (data.status=='avail') {
                 $('.alert').show().addClass('alert-warning').text("Data Already Added");
                $('.alert').fadeOut(6000);
            }

             else{
                 $('.table').load(location.href + " .table");
                $('.alert').show().addClass('alert-success').text("Data Upadated Successfully");
                $('.alert').fadeOut(6000);
                $('#adminform').trigger('reset');
                 $('#adminform .btn-primary').text("Submit Details");
              }
            }
            else{
                console.log(data);
                 // alert('hello');
                $('.alert').show().addClass('alert-danger').text("Data not Added");
                $('.alert').fadeOut(6000);
                return false;
              }
            })
            .fail(function(data){
                $('#nameError').text(data.responseJSON.errors.name);
                $('#mobileError').text(data.responseJSON.errors.mobile);
                $('#emailError').text(data.responseJSON.errors.email);
                $('#passwordError').text(data.responseJSON.errors.password);
                $('#con_passwordError').text(data.responseJSON.errors.con_password);
                $('#imageError').text(data.responseJSON.errors.image);
                return false;
                // alert(data);
              // alert('Failed');
            return false;
            })
        }
  });
});
</script>

@endpush
