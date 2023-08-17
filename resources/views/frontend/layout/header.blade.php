<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Start Header Top
    ============================================= -->
    <div class="top-bar-area address-two-lines bg-dark text-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 address-info">
                    <div class="info box">
                        <ul>
                            <li>
                                <span><i class="fas fa-envelope-open"></i> Email</span>mission50iaspatna@gmail.com
                            </li>
                            <li>
                                <span><i class="fas fa-phone"></i> Contact</span>+91-8538-917-71 /  8825319955
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="user-login text-right col-md-4">
                    <a href="{{route('pay-now')}}" style="color: #ffffff; background-color:#cb2316;">
                        <i class="fa fa-money"></i> Pay Now
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK" style="color: #ffffff">
                        <i class="fa fa-android"></i> Download App
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar navbar-default navbar-sticky bootsnav">

            <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="#">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container">

                <!-- Start Atribute Navigation -->
                <!-- <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>  -->
                <!-- End Atribute Navigation -->

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{route('home')}}">
                        <img src="{{asset('img/mission-ias.jpg')}}" class="logo" alt="Logo" style="height: 63px;">
                    </a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right" data-in="#" data-out="#">
                       <li>
                            <a href="{{route('home')}}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >About us</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('about-us')}}">About us</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Courses</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('our-course')}}">Our Courses</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Books</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('all-book')}}">All Book</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" >Test Series</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('test-series')}}">Test Series</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >News & Update</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('news-update')}}">News & Update</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >Event</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('our-event')}}">Our Events</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('contact-us')}}">contact</a>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>

        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

    <!-- Start Login Form
    ============================================= -->
    <form action="#" id="login-form" class="mfp-hide white-popup-block">
        <div class="col-md-4 login-social">
            <h4>Login with social</h4>
            <ul>
                <li class="facebook">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="twitter">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="linkedin">
                    <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-8 login-custom">
            <h4>login to your registered account!</h4>
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
                        <input class="form-control" placeholder="Password*" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <label for="login-remember"><input type="checkbox" id="login-remember">Remember Me</label>
                    <a title="Lost Password" href="#" class="lost-pass-link">Lost your password?</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <button type="submit">
                        Login
                    </button>
                </div>
            </div>
            <p class="link-bottom">Not a member yet? <a href="#">Register now</a></p>
        </div>
    </form>
    <!-- End Login Form -->

    <!-- Start Register Form
    ============================================= -->
    <form action="#" id="register-form" class="mfp-hide white-popup-block">
        <div class="col-md-4 login-social">
            <h4>Register with social</h4>
            <ul>
                <li class="facebook">
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </li>
                <li class="twitter">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="linkedin">
                    <a href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-8 login-custom">
            <h4>Register a new account</h4>
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
                        <input class="form-control" placeholder="Username*" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <input class="form-control" placeholder="Password*" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="form-group">
                        <input class="form-control" placeholder="Repeat Password*" type="text">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <button type="submit">
                        Sign up
                    </button>
                </div>
            </div>
            <p class="link-bottom">Are you a member? <a href="#">Login now</a></p>
        </div>
    </form>
    <form action="#" id="course-enquiry" class="mfp-hide white-popup-block">
        <div class="course-enquery-data">
            <div class="col-md-5 login-social">
                <img src="{{asset('img/6457a00156713.png')}}" style="max-width: 100%; height:250px;">
                <h4 class="text-center mt-4">Foundation of BPSC</h4>
                <div class="price"><del class="text-danger">Price: ₹10000</del> <b style="font-size: 15px; color:#0a9e15">Offer Price: ₹9500</b></div>
            </div>
            <div class="col-md-7 login-custom">
                <h4>Enquery for BPSC Foundation</h4>
                <div class="col-md-12">
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
