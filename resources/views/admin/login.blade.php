@extends('admin.layouts.authmaster')
@section('title', 'Login')
@section('content')
<style>
 .form-control{
    background-clip: border-box;
    border-width: 1px 0;
    border-top-color: transparent!important;
 }
</style>
	<div class="content d-flex justify-content-center align-items-center">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<!-- <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i> -->
								<img src="{{ asset('img/mission-ias.jpg'); }}" class="text-slate-300  p-3 mb-3 mt-1" style="height: 120px; width: 100%;">
								<h5 class="mb-0">Login to your account</h5>
							</div>
							<div class="alert"></div>
							<form class="login-form form-validate" method="post" enctype="multipart/form-data">
                            @csrf
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control" name="loginname" placeholder="Enter Registred Mobile No" required>
								<div class="form-control-feedback">
									<i class="icon-phone text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="loginpassword" placeholder="Enter Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							{{-- <div class="form-group d-flex align-items-center">
								<a href="" class="ml-auto">Forgot password?</a>
							</div> --}}

							<div class="form-group">
								<button type="submit" class="btn btn-danger btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>
						</form>
						<div class="login-form">
							<div class="form-group text-center text-muted content-divider">
								<span class="form-text text-center text-muted">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
							</div>

						</div>
						</div>
					</div>
			</div>
@endsection
@push('footscript')
<script type="text/javascript">
		var LoginValidation = function() {
        var _componentValidation = function() {
        if (!$().validate) {
            console.warn('Warning - validate.min.js is not loaded.');
            return;
        }
        var validator = $('.form-validate').validate({
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
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.'); // remove to hide Success message
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
                loginpassword: {
                    minlength: 5
                }
            },
            messages: {
                loginname: "Enter your Registered Mobile No",
                loginpassword: {
                    required: "Enter your password",
                    minlength: jQuery.validator.format("At least {0} characters required")
                }
            },
            submitHandler:function(){
                   $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                  });
                  $.ajax({
                            url: '{{ url('manageadminlogin') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: $('.login-form').serialize()
                        })
                        .done(function(data) {
                            // alert(data);
                            if (data.success) {
                              window.location.href="{{ url('dashboard') }}";
                            }
                            else{
                            $('.alert').show().removeClass('alert-success').addClass('alert-danger').text("Invalid Username or Password");
                            setTimeout(function(){
                                $('.alert').hide();
                            },6000);
                            return false;
                            }
                        })
                        .fail(function(data){
                            $('.alert').show().removeClass('alert-success').addClass('alert-danger').text("Failed To login");
                            setTimeout(function(){
                                $('.alert').hide();
                            },6000);
                            return false;
                        })
                return false;
            }
        });
    };

    return {
        init: function() {
            _componentValidation();
        }
    }
}();
document.addEventListener('DOMContentLoaded', function() {
    LoginValidation.init();
    $('.alert').hide();
});

	</script>
@endpush
