@extends('frontend.layout.base')
@section('title', 'Welcome to Mission IAS')
@section('content')
<div class="banner-area content-top-heading less-paragraph text-normal">
    <div id="bootcarousel" class="carousel slide animate_text carousel-fade" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner text-light carousel-zoom">
            <div class="item active">
                <div class="slider-thumb bg-fixed" style="background-image: url({{asset('assets/images/slider.jpg')}});"></div>
                <div class="box-table">
                    <div class="box-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="content">
                                        <h3 data-animation="animated slideInLeft"></h3>
                                        <h1 data-animation="animated slideInUp"></h1>
                                        <!-- <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">Learn more</a>
                                        <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="#">View Courses</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="item">
                <div class="slider-thumb bg-fixed" style="background-image: url(assets/img/banner/2.jpg);"></div>
                <div class="box-table shadow dark">
                    <div class="box-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="content">
                                        <h3 data-animation="animated slideInLeft">We're glade to see you</h3>
                                        <h1 data-animation="animated slideInUp">explore our brilliant graduates</h1>
                                        <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">Learn more</a>
                                        <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="#">View Courses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- <div class="item">
                <div class="slider-thumb bg-fixed" style="background-image: url(assets/img/banner/3.jpg);"></div>
                <div class="box-table shadow dark">
                    <div class="box-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="content">
                                        <h3 data-animation="animated slideInLeft">The goal of education</h3>
                                        <h1 data-animation="animated slideInUp">Join the bigest comunity of eduka</h1>
                                        <a data-animation="animated slideInUp" class="btn btn-light border btn-md" href="#">Learn more</a>
                                        <a data-animation="animated slideInUp" class="btn btn-theme effect btn-md" href="#">View Courses</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        <!-- End Wrapper for slides -->

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#bootcarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#bootcarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>
    <div class="about-area default-padding">
        <div class="container">
            <div class="row">
                <div class="about-info">

                    <div class="col-md-8 info">
                        <h5>Introduction</h5>
                        <h2>Welcome to Mission IAS</h2>
                        <p style="font-weight:bold; text-align:justify;">
                            All aspirants are welcome in Mission IAS. This institute is the dream destination for aspirants of BPSC other PCS and IAS Examination. We in Mission IAS teamed up with the renowned subject experts to give you the best possible coaching facilities. The course modules of General Studies and Optional have been meticulously designed to cater to the changing analytical patterns of BPSC UPSC question papers. We conduct regular class, weekly mock tests, discussion, and periodic seminars, provide printed notes which will prepare you to face the BPSC/UPSC examination in a successful manner. Each and every one of you will be given individual attention and guidance in accordance with your strong and weak areas.
                        </p>
                        <a href="{{route('about-us')}}" class="btn btn-dark border btn-md">Read More</a>
                    </div>
                    <div class="col-md-4 thumb">
                        <div class="form-sec">
                                <div class="EnHead">
                                    <h3 class="mt-2">New Updates</h3>
                                </div>
                                <div class="Enqury">
                                <marquee width="100%" direction="up" height="300px" scrollamount="5" onmouseover="this.stop()" onmouseout="this.start()">
                                    <p style="font-weight:bold; text-align:justify;">New Batches For BPSC Hindi Medium Starting From 05th July 2023.</p>
                                    <p style="font-weight:bold; text-align:justify;">New Batches For BPSC English Medium Starting From 12th July 2023.</p>
                                </marquee>
                                </div>
                        </div>
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
                                <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">Read More</a>
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
                                <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">Read More</a>
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
                                <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start Why Chose Us
    ============================================= -->
    <div class="wcs-area bg-dark text-light">
        <div class="container-full">
            <div class="row">
                <div class="col-md-6 thumb bg-cover" style="background-image: url({{asset('assets/img/banner/16.jpg')}});"></div>
                <div class="col-md-6 content">
                    <div class="site-heading text-left">
                        <h2>Why chose us</h2>
                        {{-- <p>
                            Discourse assurance estimable applauded to so. Him everything melancholy uncommonly but solicitude inhabiting projection off. Connection stimulated estimating excellence an to impression.
                        </p> --}}
                    </div>

                    <!-- item -->
                    <div class="item">
                        <div class="icon">
                            <i class="flaticon-trending"></i>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="#">Trending Courses</a>
                            </h4>
                            <p>
                                We offer the best courses for all competitive examinations, such as UPSC, BPSC, STET, and other government examinations, at affordable prices with the highest quality.
                            </p>
                        </div>
                    </div>
                    <!-- item -->

                    <!-- item -->
                    <div class="item">
                        <div class="icon">
                            <i class="flaticon-books"></i>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="#">Books & Library</a>
                            </h4>
                            <p>
                                We provide daily practice papers and question sets to students to enhance their performance in the actual examinations. We assist in all-around development.
                            </p>
                        </div>
                    </div>
                    <!-- item -->

                    <!-- item -->
                    <div class="item">
                        <div class="icon">
                            <i class="flaticon-professor"></i>
                        </div>
                        <div class="info">
                            <h4>
                                <a href="#">Certified Teachers</a>
                            </h4>
                            <p>
                                We have the best faculty, and our teachers are well-educated and qualified. They will provide you with quality education, better understanding, and overall personal development.
                            </p>
                        </div>
                    </div>
                    <!-- item -->

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

                                    <!-- Single Item -->

                                    @foreach(App\Models\Course::where('status','1')->get() as $rows)
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
                                    <!-- End Single Item -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="advisor" class="advisor-area bg-gray carousel-shadow default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">Our Faculty</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="advisor-items advisor-carousel-solid owl-carousel owl-theme text-center text-light">
                        <!-- Single Item -->
                        <div class="advisor-item">
                            <div class="info-box">
                                <img src="{{asset('assets/images/rajnish-sir.jpg')}}" alt="Thumb">
                                <div class="info-title">
                                    <h4>Faculty of GK/GS</h4>
                                    <span style="color: #c50c03">Rajnish Sir</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="advisor-item">
                            <div class="info-box">
                                <img src="{{asset('assets/images/abishekh-sir.jpg')}}" alt="Thumb">
                                <div class="info-title">
                                    <h4>Faculty of Science</h4>
                                    <span style="color: #c50c03">Abhishek Pathak Sir</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="advisor-item">
                            <div class="info-box">
                                <img src="{{asset('assets/images/aryan-sir.jpg')}}" alt="Thumb">
                                <div class="info-title">
                                    <h4>Faculty of History</h4>
                                    <span style="color: #c50c03">Aryan Pandey Sir</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="advisor-item">
                            <div class="info-box">
                                <img src="{{asset('assets/images/abhijeet-sir.jpg')}}" alt="Thumb">
                                <div class="info-title">
                                    <h4>Faculty of Polity</h4>
                                    <span style="color: #c50c03">Abhijeet Dubey Sir</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Item -->
                        <!-- Single Item -->
                        <div class="advisor-item">
                            <div class="info-box">
                                <img src="{{asset('assets/images/mrityunjay-sir.jpg')}}" alt="Thumb">
                                <div class="info-title">
                                    <h4>Faculty of Economics</h4>
                                    <span style="color: #c50c03">Mrityunjay Sir</span>
                                </div>
                            </div>
                        </div>
                        <!-- Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Advisor Area -->

    <!-- Start Fun Factor
    ============================================= -->
    <div class="fun-factor-area default-padding bottom-less text-center bg-fixed shadow dark-hard" style="background-image: url({{asset('assets/img/banner/2.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-contract"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="25" data-speed="5000"></span>
                            <span class="medium">National Awards</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-professor"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="47845" data-speed="5000"></span>
                            <span class="medium">Students Enrolled</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-online"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="8970" data-speed="5000"></span>
                            <span class="medium">Successfull Students</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 item">
                    <div class="fun-fact">
                        <div class="icon">
                            <i class="flaticon-reading"></i>
                        </div>
                        <div class="info">
                            <span class="timer" data-to="6" data-speed="5000"></span>
                            <span class="medium">Cources</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor -->

    <!-- Start Event
    ============================================= -->
    <section id="event" class="event-area default-padding">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">Upcoming Events</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="event-items">
                @foreach(App\Models\Event::where('status','1')->orderBy('id','desc')->get() as $rows)
                    <div class="item vertical col-md-6">
                        <div class="thumb">
                            <img src="{{asset($rows->image_link)}}" alt="Thumb" style="width: 100%;">
                        </div>
                        <div class="info">
                            <h4>
                                <a href="#">{{$rows->event_name;}}</a>
                            </h4>
                            <p>
                               {!!$rows->description!!}
                            </p>
                            <a href="{{url('book-event')}}/{{$rows->id}}" class="btn btn-dark effect btn-sm">
                                <i class="fas fa-chart-bar"></i> Book Now
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK" class="btn btn-gray btn-sm">
                                <i class="fas fa-ticket-alt"></i>View More
                            </a>
                        </div>
                    </div>
                @endforeach
                    <div class="more-btn col-md-12 text-center">
                        <a href="{{route('our-event')}}" class="btn btn-dark border btn-md">View All Events</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Event -->

    <!-- Start Registration
    ============================================= -->
    <div class="reg-area default-padding-top bg-gray">
        <div class="container">
            <div class="row">
                <div class="reg-items">
                    <div class="col-md-6 reg-form default-padding-bottom">
                        <div class="site-heading text-left">
                            <h2>Get a Free online Registration</h2>
                            <p>
                                If you have any questions or queries, please fill out the form and drop us an email.
                            </p>
                        </div>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="First Name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Last Name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email*" type="email">
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <select>
                                            <option value="1">Chose Subject</option>
                                            <option value="2">Computer Engineering</option>
                                            <option value="4">Accounting Technologies</option>
                                            <option value="5">Web Development</option>
                                            <option value="6">Machine Language</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" style="background-color: #0f0e0e; color:#ffffff">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 thumb">
                        <img src="{{asset('assets/images/student-enquiry.jpg')}}" alt="Thumb" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Registration -->

    <!-- Start Testimonials
    ============================================= -->
    <div class="testimonials-area carousel-shadow default-padding bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">Students Review</h2>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="clients-review-carousel owl-carousel owl-theme">
                        <!-- Single Item -->
                        <div class="item">
                            <div class="col-md-5 thumb">
                                <img src="{{asset('assets/images/male-student.png')}}" alt="Thumb">
                            </div>
                            <div class="col-md-7 info">
                                <p style="text-align: justify">
                                    Mission 50 IAS is one of the best institutes if you aspire to become a government officer. Everyone at the coaching center, including the staff, helped me a lot. The DPP and the mock tests were very useful. The guidance from the teachers was also top-notch.
                                </p>
                                <h4>Ranjan kumar</h4>
                                <span>BPSC 65th</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials -->

    <!-- Start Blog
    ============================================= -->
    <div id="blog" class="blog-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="site-heading text-center">
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-transform: uppercase;">Latest News</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog-items">

                    <!-- Single Item -->
                    @foreach(App\Models\News::where('status','1')->orderBy('id','desc')->get() as $rows)
                    <div class="col-md-4 single-item">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{asset($rows->image_link)}}" alt="Thumb"></a>
                                {{-- <div class="date">
                                    <h4><span>{{date('d',strtotime($rows->date))}}</span> {{date('M',strtotime($rows->date))}}, {{date('Y',strtotime($rows->date))}}</h4>
                                </div> --}}
                            </div>
                            <div class="info">
                                <h4>
                                    <a href="#" style="color:#0f0e0e">{{$rows->news_title}}</a>
                                </h4>
                                <p>
                                    {!!$rows->description!!}
                                </p>
                                <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">Read More <i class="fas fa-angle-double-right"></i></a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="more-btn col-md-12 text-center">
                        <a href="{{route('news-update')}}" class="btn btn-dark border btn-md">View All News & Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('#indexmodel').modal('show');
    });
</script> -->
