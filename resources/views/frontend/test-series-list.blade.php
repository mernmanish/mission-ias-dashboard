@extends('frontend.layout.base')
@section('title', 'Mission IAS | Test Series')
@section('content')
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/images/page-banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;">Test Series List</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">Test Series</a></li>
                        <li class="active">All Test Series</li>
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
                        <h2 style="text-transform: uppercase;">Mission IAS Test Series Lists</h2>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="event-items">
            @foreach($testSeries as $rows)
                <div class="item vertical col-md-4">
                    <div class="thumb">
                        <img src="{{$rows->image_link}}" alt="Thumb" style="width: 100%;">
                    </div>
                    <div class="info">
                        <h4>
                            <a href="#">{{$rows->test_series_name}}</a>
                        </h4>
                        <div class="meta">
                            <ul>
                                <li style="color: green; font-weight: bold">Offer Price ₹ {{$rows->price}}</li>

                            </ul>
                        </div>
                        <ul>
                            @php
                            $total = explode(",",$rows->no_of_question);;
                            $no_of_question = array_sum($total);
                            @endphp
                            <li><i class="fa fa-file-text" aria-hidden="true"></i> {{$no_of_question}} Q</li>
                            <li><i class="fas fa-clock"></i>  {{$rows->time}} Minutes</li>
                            <li><i class="fas fa-map"></i> {{$rows->subcategory->name ?? ''}} </li>
                        </ul>
                        <p>
                            {!!$rows->description!!}
                        </p>
                        <a href="{{url('test-series-request')}}/{{$rows->id}}" class="btn  effect btn-sm" style="background-color: #c50c03; color: #ffffff;">
                            <i class="fas fa-chart-bar"></i> Send Request
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
