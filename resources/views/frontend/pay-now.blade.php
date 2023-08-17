@extends('frontend.layout.base')
@section('title', 'Mission IAS | Online Fee Payment')
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
@if (session()->has('error'))
<script>
    swal({
        title: "OOPS !",
        text: "{{ session('error') }}",
        icon: "warning",
        button: "OK",
        timer: 3000
   });
</script>
@endif
<div class="popular-courses circle bg-gray carousel-shadow default-padding" style="padding-bottom: 10px;padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="popular-courses default-padding bottom-less without-carousel">
                        <div class="container">
                            <div class="row">

                                <form action="{{route('send-payment')}}" method="post" id="course-enquiry" class="white-popup-block">
                                    @csrf
                                    <div class="course-enquery-data">
                                        <h4 class="text-center" style="color:#c50c03;">Pay Fee Payment</h4>
                                        <div class="col-md-5 login-social text-center" style="margin-top: 10px;">
                                            <img src="{{asset('img/pay-now.jpg')}}" style="max-width: 100%; height:250px;">
                                        </div>
                                        <div class="col-md-7 login-custom">
                                            <div class="col-md-12" style="margin-top: 10px;">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" name="name" placeholder="Name*" type="text">
                                                        @if ($errors->has('name'))
                                                            <span class="help-block errorText">
                                                            {{ $errors->first('name') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" name="mobile" placeholder="Mobile*" type="number">
                                                        @if ($errors->has('mobile'))
                                                            <span class="help-block errorText">
                                                            {{ $errors->first('mobile') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" name="email" placeholder="Email*" type="email">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block errorText">
                                                            {{ $errors->first('email') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" name="amount" placeholder="Amount*" type="number">
                                                        @if ($errors->has('amount'))
                                                            <span class="help-block errorText">
                                                            {{ $errors->first('amount') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="message" placeholder="Message*"></textarea>
                                                        @if ($errors->has('message'))
                                                            <span class="help-block errorText">
                                                            {{ $errors->first('message') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <button type="submit">
                                                        Pay Now
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
