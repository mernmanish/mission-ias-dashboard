@extends('frontend.layout.base')
@section('title', 'Mission IAS | News & Updates')
@section('content')
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url(assets/images/page-banner.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;">News & Update List</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">News & Update</a></li>
                        <li class="active">All News & Update</li>
                    </ul>
                </div>
            </div>
        </div>
 </div>
 <div id="blog" class="blog-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">All News & Update List</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-items">

                    @foreach($news as $rows)
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{asset($rows->image_link)}}" alt="Thumb"></a>
                                <div class="date">
                                    <h4><span>{{date('d',strtotime($rows->date))}}</span> {{date('M',strtotime($rows->date))}}, {{date('Y',strtotime($rows->date))}}</h4>
                                </div>
                            </div>
                            <div class="info">
                                <h4>
                                    <a href="#" style="color:#087108;">{{$rows->news_title}}</a>
                                </h4>
                                <p>
                                    {!!$rows->description!!}
                                </p>
                                <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">Read More <i class="fas fa-angle-double-right"></i></a>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
