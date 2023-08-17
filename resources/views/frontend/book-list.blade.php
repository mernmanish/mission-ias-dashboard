@extends('frontend.layout.base')
@section('title', 'Mission IAS | Our Book ')
@section('content')
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/images/page-banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;">Book List</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Course</a></li>
                        <li class="active">All Book</li>
                    </ul>
                </div>
            </div>
        </div>
 </div>
<section id="event" class="event-area default-padding">
    <div class="container">
        <div class="row">
            <div class="site-heading text-center">
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-transform: uppercase">Mission IAS Book List</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="event-items">
            @foreach($book as $rows)
                <div class="item vertical col-md-4">
                    <div class="thumb">
                        <img src="{{asset($rows->image_link)}}" alt="Thumb" style="width: 100%;">
                    </div>
                    <div class="info">
                        <h4>
                            <a href="#">{{$rows->book_title}}</a>
                        </h4>
                        <div class="meta">
                            <ul>
                                <li style="color: red; font-weight: bold"><del>Price ₹ {{$rows->book_price}}</del></li>
                                <li style="color: green; font-weight: bold">Offer Price ₹ {{$rows->book_sale_price}}</li>

                            </ul>
                        </div>
                        <p>
                            {!!$rows->description!!}
                        </p>
                        <a href="{{url('book-order-request')}}/{{$rows->id}}" class="btn  effect btn-sm" style="background-color: #c50c03; color: #ffffff;">
                            <i class="fas fa-chart-bar"></i> Order Request
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK" class="btn btn-gray btn-sm">
                            <i class="fas fa-ticket-alt"></i> View More
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
