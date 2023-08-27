@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('breadcrumb', 'Change Password')
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
				<h5 class="card-title"><i class="icon-lock4"></i> Change Password</h5>
			</div>

            <form action="{{ route('change-admin-password') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="excel">Mobile <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ session('sessionadmin')['mobile'] }}" readonly>
                            @if ($errors->has('mobile'))
                                <span class="help-block errorText">
                                {{ $errors->first('mobile') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="excel">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password">
                            @if ($errors->has('password'))
                                <span class="help-block errorText">
                                {{ $errors->first('password') }}
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="excel">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter Confirm Password">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block errorText">
                                {{ $errors->first('password_confirmation') }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn bg-teal-400" id="btns">Change Password <i class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
	    </div>
    </div>
</div>
@endsection
