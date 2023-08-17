@extends('frontend.layout.base')
@section('title', 'About us | Mission IAS')
@section('content')
<div class="breadcrumb-area shadow dark text-center bg-fixed text-light" style="background-image: url({{asset('assets/images/page-banner.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="text-transform: uppercase;">About Us</h1>
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li><a href="#">About</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
 </div>
<div class="about-area default-padding">
        <div class="container">
            <div class="row">
                <div class="about-info">
                    <div class="col-md-5 thumb">
                       <img src="{{asset('assets/images/mission-ias-director.jpg')}}" alt="Thumb" style="width: 100%; height: 400px;">
                    </div>
                    <div class="col-md-7 info">
                        <h5>Introduction</h5>
                        <h2>Welcome to Mission IAS</h2>
                        <p style="font-weight:bold; text-align:justify;">
                            All aspirants are welcome in Mission IAS. This institute is the dream destination for aspirants of BPSC other PCS and IAS Examination. We in Mission IAS teamed up with the renowned subject experts to give you the best possible coaching facilities. The course modules of General Studies and Optional have been meticulously designed to cater to the changing analytical patterns of BPSC UPSC question papers. We conduct regular class, weekly mock tests, discussion, and periodic seminars, provide printed notes which will prepare you to face the BPSC/UPSC examination in a successful manner. Each and every one of you will be given individual attention and guidance in accordance with your strong and weak areas.
                        </p>
                        <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK" class="btn btn-dark border btn-md">Read More</a>
                    </div>
                    <div class="col-md-4 thumb">

                       <!--  <img src="assets/images/mission-ias-director.jpg" alt="Thumb" style="width: 100%; height: 500px;"> -->
                    </div>
                </div>
                <div class="seperator col-md-12">
                    <span class="border"></span>
                </div>
                <div class="our-features">
                    <div class="col-md-4 col-sm-4">
                        <div class="item mariner">
                            <div class="icon">
                                <i class="flaticon-faculty-shield"></i>
                            </div>
                            <div class="info">
                                <h4>Expert faculty</h4>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <div class="item java">
                            <div class="icon">
                                <i class="flaticon-book-2"></i>
                            </div>
                            <div class="info">
                                <h4>Online/ Offline Class</h4>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="item malachite">
                            <div class="icon">
                                <i class="flaticon-education"></i>
                            </div>
                            <div class="info">
                                <h4>Scholarship</h4>
                                <a href="#">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
