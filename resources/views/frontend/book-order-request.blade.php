@extends('frontend.layout.base')
@section('title', 'Mission IAS | Book Order Request')
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
                                        <h4 class="text-center">Enquery for {{$book->book_title;}}</h4>
                                        <div class="col-md-5 login-social text-center" style="margin-top: 10px;">
                                            <img src="{{asset($book->image_link)}}" style="max-width: 100%; height:250px;">
                                            <h4 class="text-center mt-4">{{$book->book_title;}}</h4>
                                            <div class="price"><del class="text-danger">Price: ₹{{$book->book_price}}</del> <b style="font-size: 15px; color:#0a9e15">Offer Price: ₹{{$book->book_sale_price}}</b></div>
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
