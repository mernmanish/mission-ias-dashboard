<footer class="bg-dark default-padding-top text-light">
        <div class="container">
            <div class="row">
                <div class="f-items">
                    <div class="col-md-4 item">
                        <div class="f-item text-center">
                            <img src="{{asset('img/mission-ias.jpg')}}" alt="Logo" style="height: 65px;">
                            <p style="text-align: justify">
                                All aspirants are welcome in Mission IAS. This institute is the dream destination for aspirants of BPSC other PCS and IAS Examination. We in Mission IAS teamed up with the renowned subject experts to give you the best possible coaching facilities. The course modules of General Studies and Optional have been meticulously designed to cater to the changing analytical patterns of BPSC UPSC question papers.
                            </p>

                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Courses</h4>
                            <ul>
                                @foreach(App\Models\Course::where('status','1')->orderBy('id','desc')->limit(4)->get() as $rows)
                                <li>
                                    <a href="https://play.google.com/store/apps/details?id=co.msnias&hl=en-IN" target="_BLANK">{{$rows->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 item">
                        <div class="f-item link">
                            <h4>Links</h4>
                            <ul>
                                <li>
                                    <a href="{{route('about-us')}}">About us</a>
                                </li>
                                <li>
                                    <a href="{{route('all-book')}}">Books</a>
                                </li>
                                <li>
                                    <a href="{{route('test-series')}}">Test Series</a>
                                </li>
                                <li>
                                    <a href="{{route('news-update')}}">News & Update</a>
                                </li>
                                <li>
                                    <a href="{{route('our-event')}}">Events</a>
                                </li>
                                <li>
                                    <a href="{{route('contact-us')}}">Contact us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 item">
                        <div class="f-item address">
                            <h4>Address</h4>
                            <ul>
                                <li>
                                    <i class="fas fa-envelope"></i>
                                    <p>Email <span><a href="mailto:mission50iaspatna@gmail.com">mission50iaspatna@gmail.com</a></span></p>
                                </li>
                                <li>
                                    <i class="fas fa-map"></i>
                                    <p>Office <span>Mission 50 IAS, Aparajita Building, Kidwaipuri, Near Income Tax Golamber, Patna 800001</span></p>
                                </li>
                            </ul>
                            <div class="opening-info">
                                <h5>Opening Hours</h5>
                                <ul>
                                    <li> <span> Mon - Sat :  </span>
                                      <div class="pull-right"> 6.00 am - 10.00 pm </div>
                                    </li>
                                    <li> <span> Sun : </span>
                                      <div class="pull-right closed"> Closed </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p>&copy; Copyright 2023. All Rights Reserved by <a href="#" style="color: #cb2316;">Mission IAS</a></p>
                        </div>
                        <div class="col-md-6 text-right link">
                            <ul>
                                <li>
                                    <a href="#">Terms & Conditions</a>
                                </li>
                                <li>
                                    <a href="#">Privacy Policy</a>
                                </li>
                                <li>
                                    <a href="#">Support</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
    </footer>
    <!-- End Footer -->

    <!-- jQuery Frameworks
    ============================================= -->
    <script src="{{asset('assets/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/equal-height.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.appear.js')}}"></script>
    <script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.custom.13711.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/js/count-to.js')}}"></script>
    <script src="{{asset('assets/js/loopcounter.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('assets/js/bootsnav.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    {{-- <script>
        function course_enquiry(id)
        {
            alert(id);
            var html = '<div class="col-md-5 login-social"><img src="" style="max-width: 100%; height:250px;"><h4 class="text-center mt-4">Foundation of BPSC</h4>
                <div class="price"><del class="text-danger">Price: ₹10000</del> <b style="font-size: 15px; color:#0a9e15">Offer Price: ₹9500</b></div></div><div class="col-md-7 login-custom"><h4>Enquery for BPSC Foundation</h4><div class="col-md-12"><div class="row"><div class="form-group"><input class="form-control" placeholder="Name*" type="text"></div></div></div><div class="col-md-12"><div class="row"><div class="form-group"><input class="form-control" placeholder="Mobile*" type="number"></div></div></div><div class="col-md-12"><div class="row"><div class="form-group"><input class="form-control" placeholder="Email*" type="email"></div></div></div><div class="col-md-12"><div class="row"><div class="form-group"><input class="form-control" placeholder="City*" type="text"></div></div></div> <div class="col-md-12"><div class="row"><div class="form-group"><textarea class="form-control" placeholder="Message*"></textarea></div></div></div><div class="col-md-12"><div class="row"><button type="submit">Send Enquery</button></div></div></div>';
                $('.course-enquery-data').append(html);
                alert(html);
                return false;
        }
    </script> --}}
</body>
</html>
