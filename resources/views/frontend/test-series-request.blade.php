@extends('frontend.layout.base')
@section('title', 'Mission IAS | Test Series Request')
@section('content')
<div class="popular-courses circle bg-gray carousel-shadow default-padding" style="padding-bottom: 10px;padding-top: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="popular-courses default-padding bottom-less without-carousel">
                        <div class="container">
                            <div class="row">

                                <form action="#" id="course-enquiry" class="white-popup-block">
                                    <div class="course-enquery-data">
                                        <h4 class="text-center">Enquery for ({{$test->test_series_name;}})</h4>
                                        <div class="col-md-5 login-social" style="margin-top: 10px;">
                                            <img src="{{asset($test->image_link)}}" style="max-width: 100%; height:250px;">
                                            <h4 class="mt-4">{{$test->test_series_name;}}</h4>
                                            <div class="price"><b style="font-size: 15px; color:#0a9e15">Price: ₹{{$test->price}}</b></div>
                                            {{-- <div class="meta">
                                                <ul>
                                                    <li style="color: green; font-weight: bold">Offer Price ₹ {{$test->price}}</li>

                                                </ul>
                                            </div> --}}
                                        <div class="met">
                                            <ul>
                                                @php
                                                $total = explode(",",$test->no_of_question);;
                                                $no_of_question = array_sum($total);
                                                @endphp
                                                <li><i class="fa fa-file-text" aria-hidden="true"></i> {{$no_of_question}} Q</li>
                                                <li><i class="fas fa-clock"></i>  {{$test->time}} Minutes</li>
                                                <li><i class="fas fa-map"></i> {{$test->subcategory->name ?? ''}} </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="col-md-7 login-custom">

                                            <div class="col-md-12" style="margin-top: 10px;">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Name*" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Mobile*" type="number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="Email*" type="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input class="form-control" placeholder="City*" type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <textarea class="form-control" placeholder="Message*"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <button type="submit">
                                                        Send Enquery
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
