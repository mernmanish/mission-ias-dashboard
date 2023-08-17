@extends('frontend.layout.base')
@section('title', 'Mission IAS | Online Fee Payment')
@section('content')
<style>
    .razorpay-payment-button{
        background-color: #000000;
        color: #ffffff;
        padding: 10px 20px 10px 20px;
    }
</style>
<div class="popular-courses circle bg-gray carousel-shadow default-padding" style="padding-bottom: 10px;padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 course-enquery-data">
                <form action="{{route('make-payment')}}" method="POST" class="white-popup-block text-center">
                    @csrf
                    @php
                    $sName = $name;
                    $sMobile = $mobile;
                    $sAmount = $amount;
                    $sEmail = $email;
                    $fAmount = $sAmount*100;
                    @endphp
                    <h4 class="text-center" style="color:#c50c03;">Online Fee Payment</h4>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                       data-key="rzp_live_GIpXa3Six1kD8e"
                       data-amount={{$fAmount}}
                       data-currency="INR"
                       data-buttontext="Pay {{$sAmount}} INR"
                       data-name="Mission IAS"
                       data-description="Rozerpay"
                       data-image="{{asset('img/mission-ias.jpg')}}"
                       data-prefill.name={{$sName}}
                       data-prefill.email={{$sEmail}}
                       data-theme.color="#c50c03"></script>
                       <input type="hidden" name="id" value="{{$id}}">
                 </form>
                 </div>
                 <div class="col-md-3"></div>
            </div>
        </div>
</div>
@endsection
