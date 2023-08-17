@extends('frontend.layout.base')
@section('title', 'Mission IAS | Our Courses')
@section('content')
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('assets/images/page-banner.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;">Our Courses</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Course</a></li>
                        <li class="active">Our Courses</li>
                    </ul>
                </div>
            </div>
        </div>
 </div>
<div class="popular-courses circle bg-gray carousel-shadow default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">Popular Courses</h2>
                       <!--  <p>
                            Discourse assurance estimable applauded to so. Him everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating excellence an to impression.
                        </p> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="popular-courses default-padding bottom-less without-carousel">
                        <div class="container">
                            <div class="row">
                                <div class="popular-courses-items">
                                    @foreach($course as $rows)
                                    <div class="col-md-4 col-sm-6 equal-height">
                                        <div class="item">
                                            <div class="thumb">
                                                <a href="course-details.html">
                                                    <img src="{{asset($rows->image)}}" alt="Thumb">
                                                </a>
                                                <div class="price"><del class="text-danger">Price: ₹{{$rows->course_fee}}</del> <b style="font-size: 15px; color:#0a9e15">Offer Price: ₹{{$rows->discount_fee}}</b></div>
                                            </div>
                                            <div class="info">
                                                <h4 style="color:#0a9e15; font-size:15px;"><a href="course-details.html">{{$rows->name}}</a></h4>
                                                <p>
                                                    {!!$rows->description!!}
                                                </p>
                                                <div class="bottom-info">
                                                    <!-- <ul>
                                                        <li>
                                                            <i class="fas fa-clock"></i> Online/Offline Class
                                                        </li>
                                                    </ul> -->
                                                    <!-- <a href="#" class="btn btn-dark effect btn-sm">
                                                        <i class="fas fa-chart-bar"></i> Book Now
                                                    </a> -->
                                                    <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK" class="btn  text-white btn-sm pull-left" style="background-color: #c50c03; color: #ffffff;">
                                                        <i class="fas fa-ticket-alt"></i> Show More
                                                    </a>
                                                    <a class="pull-right" href="{{url('course-enquiry')}}/{{$rows->id}}" style="color: #ffffff;"><i class="fas fa-edit"></i> Enroll Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
