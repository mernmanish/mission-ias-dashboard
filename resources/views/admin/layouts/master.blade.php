<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="manifest" href="{{ asset('ico/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('img/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">
    <style>
        .errorText{
            color: #cd1000;
        }
    </style>
    <link href="{{ asset('css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css\icons\material\styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.min.css') }}" rel="stylesheet" type="text/css">

    <script src="{{ asset('js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('js/main/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ui/ripple.min.js') }}"></script>
    <script src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script src="{{ asset('js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script> --}}
    <script src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="{{ asset('js/demo_pages/dashboard.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/demo_charts/pages/dashboard/light/streamgraph.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/sparklines.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/lines.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/areas.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/donuts.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/bars.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/progress.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/heatmaps.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/pies.js') }}"></script>
    <script src="{{ asset('js/demo_charts/pages/dashboard/light/bullets.js') }}"></script> --}}
    <script src="{{ asset('tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/main/validate.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
    <script>
        function deleteItem(event) {
            swal({
                title: "Delete Alert!",
                text: "You want to delete this?",
                icon: "error",
                dangerMode:true,
                buttons: {
                    cancel : 'Cancel',
                    delete: {
                        text:"Yes Delete",
                        value:'delete'
                    }
                }
            }).then((val)=>{
                switch (val) {
                    case "delete":
                        window.location = event.dataset.href
                        break;
                    default:
                        break;
                }
            })
        }
    </script>

    @if (session()->has('message'))
        <script>
            swal({
                title: "Success !",
                text: "{{ session('message') }}",
                icon: "success",
                button: "OK",
                timer: 3000
           });
        </script>
    @endif
    @if (session('error'))
        <script>
            swal({
                title: "Oops!",
                text: "{{ session('error') }}",
                icon: "warning",
                button: "OK",
            });
        </script>

    @endif
    <style type="text/css">
        #navbar-footer {
            width: 100%;
        }

        #navbar-footer span,
        .ml-lg-auto {
            width: 50%;
        }

        .ml-lg-auto li {
            float: left;
            list-style: none;
            width: 33%;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#table').DataTable('show');
        });
    </script>
    {{-- @php
    if(empty(session('sessionadmin')['name']))
    {
    	return redirect()->to('admin');
    }
   @endphp --}}
</head>

<body>
    <div class="navbar navbar-expand-md navbar-dark bg-blue navbar-static">
        <div class="navbar-brand">
            <a href="{{ url('dashboard') }}" class="d-inline-block">
                <h4 class="text-center" style="font-size: 18px; color:#ffffff; font-weight:bold;">Mission <span style="color: #cd1000">Admin</span> Panel</h4>
                {{-- <img src="{{ asset('img/mission-ias.jpg') }}" alt="" style=" height: 30px; width:100%;"> --}}
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>
            </ul>

            <span class="navbar-text ml-md-3">
                <span class="badge badge-mark border-orange-300 mr-2"></span>
                Welcome, {{ session('sessionadmin')['name'] }}
            </span>

            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{asset('img/admin.png')}}" class="rounded-circle mr-2" height="34" alt="">
						<span>{{ session('sessionadmin')['name'] }}</span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="#" class="dropdown-item"><i class="icon-envelop4"></i> {{ session('sessionadmin')['email'] }}</a>
						<a href="#" class="dropdown-item"><i class="icon-mobile"></i> {{ session('sessionadmin')['mobile'] }}</a>
						<div class="dropdown-divider"></div>
						<a href="{{url('changeAdminPassword')}}" class="dropdown-item"><i class="icon-cog5"></i> Change Password</a>
						<a href="{{ url('logout') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
                {{-- <li class="nav-item">
                    <a href="{{ url('logout') }}" class="navbar-nav-link">
                        <i class="icon-switch2"></i>
                        <span class="d-md-none ml-2">Logout</span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
            <div class="sidebar-mobile-toggler text-center">
                <a href="#" class="sidebar-mobile-main-toggle">
                    <i class="icon-arrow-left8"></i>
                </a>
                <span class="font-weight-semibold">Navigation</span>
                <a href="#" class="sidebar-mobile-expand">
                    <i class="icon-screen-full"></i>
                    <i class="icon-screen-normal"></i>
                </a>
            </div>
            <div class="sidebar-content">
                {{-- <div class="sidebar-user-material">
                    <div class="sidebar-user-material-body">
                        <div class="sidebar-user-material-footer">
                            <a href="#user-nav"
                                class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle"
                                data-toggle="collapse"><span>My account</span></a>
                        </div>
                    </div>

                    <div class="collapse" id="user-nav">
                        <ul class="nav nav-sidebar">
                            <li class="nav-item">
                                <a href="{{ url('myprofile') }}" class="nav-link">
                                    <i class="icon-user-plus"></i>
                                    <span>My profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-coins"></i>
                                    <span>My balance</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-comment-discussion"></i>
                                    <span>Messages</span>
                                    <span class="badge bg-teal-400 badge-pill align-self-center ml-auto">58</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="icon-cog5"></i>
                                    <span>Account settings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('logout') }}" class="nav-link">
                                    <i class="icon-switch2"></i>
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <!-- /user menu -->


                <!-- Main navigation -->
                <div class="card card-sidebar-mobile">
                    <ul class="nav nav-sidebar" data-nav-type="accordion">

                        <!-- Main -->
                        <li class="nav-item-header">
                            <div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu"
                                title="Main"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('dashboard') }}" class="nav-link active">
                                <i class="icon-home4"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                        </li>

                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-book"></i> <span>Course</span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">

								<li class="nav-item"><a href="{{ route('course-type') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i> Course Type</a></li>
								<li class="nav-item"><a href="{{ route('addCourses') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i> Add Course</a></li>
                                <li class="nav-item"><a href="{{ route('course-list') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>All Course</a></li>
                                <li class="nav-item"><a href="{{ url('category') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>Category</a></li>
                                <li class="nav-item"><a href="{{ route('sub-category') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>Sub Category</a></li>
                                {{-- <li class="nav-item"><a href="{{ url('batch') }}" class="nav-link"><i
                                            class="fa fa-list" aria-hidden="true"></i>Batch</a></li>
                                <li class="nav-item"><a href="{{ url('subject') }}" class="nav-link"><i
                                            class="fa fa-list" aria-hidden="true"></i> Subject</a></li>
                                <li class="nav-item"><a href="{{ url('topics') }}" class="nav-link"><i
                                            class="fa fa-list" aria-hidden="true"></i> Topics</a></li> --}}
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-video-camera2"></i> <span> Videos
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-videos') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Videos</a></li>
                                <li class="nav-item"><a href="{{ url('add-video') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>Add Video</a></li>
                                {{-- <li class="nav-item"><a href="{{ route('chat-list') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>All Chat</a></li> --}}
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-clapboard-play"></i> <span> Live Class
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-live-class') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>Live Classes</a></li>
                                <li class="nav-item"><a href="{{ url('add-live-class') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>Add Live Class</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-clipboard"></i> <span> Test Series
                                    </span></a>

                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('add-test-series') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>Add Test</a></li>
                                <li class="nav-item"><a href="{{ url('all-test-series') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>View Test</a></li>
                                {{-- <li class="nav-item"><a href="{{ url('add-test-series') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Bulk Upload</a></li> --}}
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-book3"></i> <span> Books
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ url('all-books') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Books</a></li>
                                <li class="nav-item"><a href="{{ url('add-book') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Add Book</a></li>
                            </ul>
                        </li>
                        {{-- <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-file-download2"></i> <span> Study Material
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ url('all-study-material') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Study Material</a></li>
                                <li class="nav-item"><a href="{{ url('add-study-material') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Add Study Material</a></li>
                            </ul>
                        </li> --}}
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-newspaper2"></i> <span> Live Events
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-event') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Events</a></li>
                                <li class="nav-item"><a href="{{ route('add-event') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Add Events</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-megaphone"></i> <span> News
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-news') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All News</a></li>
                                <li class="nav-item"><a href="{{ route('add-news') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Add News</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-image2"></i> <span> Banner
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-banner') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Banner</a></li>
                                <li class="nav-item"><a href="{{ route('add-banner') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Add Banner</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-medal"></i> <span> Assign Course
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-assign-course') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All Assign Course</a></li>
                                @if(session('sessionadmin')['user_type']=="super_admin")
                                <li class="nav-item"><a href="{{ route('add-assign-course') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>Assign Course</a></li>
                                <li class="nav-item"><a href="{{ route('assign-bulk-upload') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>Bulk Upload</a></li>
                                @endif
                                <li class="nav-item"><a href="{{ route('online-payment') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>Online Payment</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="icon-collaboration"></i> <span> User
                                    </span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                                <li class="nav-item"><a href="{{ route('all-users') }}" class="nav-link"><i
                                    class="fa fa-list" aria-hidden="true"></i>All User</a></li>
                                <li class="nav-item"><a href="{{ route('login-users') }}" class="nav-link"><i
                                        class="fa fa-list" aria-hidden="true"></i>User Login List</a></li>
                                <li class="nav-item"><a href="{{ route('user-bulk-upload') }}" class="nav-link"><i class="fa fa-list" aria-hidden="true"></i>Bulk Upload</a></li>
                                <li class="nav-item"><a href="{{ route('notification') }}" class="nav-link"><i
                                            class="fa fa-list" aria-hidden="true"></i>User Notification</a></li>
                            </ul>
                        </li>
                        @if(session('sessionadmin')['user_type']=="super_admin")
                        <li class="nav-item nav-item-submenu">
                            <a href="#" class="nav-link"><i class="fa fa-cog" style="font-size: 17px;" aria-hidden="true"></i>
                                <span>Account Setting</span></a>
                            <ul class="nav nav-group-sub" data-submenu-title="Layouts">

                                <li class="nav-item"><a href="{{ url('admin-list') }}" class="nav-link"><i
                                            class="fa fa-list" aria-hidden="true"></i>Admin Registration</a></li>
                            </ul>
                        </li>
                        @endif
                        <!-- <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-cube4"></i> <span>Practice Test</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-cube3"></i> <span>Mock Test</span></a>
      </li>
       <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-piggy-bank"></i> <span>Test Package</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-book3"></i> <span>Quiz Module</span></a>
      </li>
       <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-video-camera2"></i> <span>Videos</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-book"></i> <span>Study Material</span></a>
      </li>
       <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-magazine"></i> <span>Reports</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-wallet"></i> <span>Revenue</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-bubble-lines3"></i> <span>News</span></a>
      </li>
       <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-bell2"></i> <span>Job Notification</span></a>
      </li>
      <li class="nav-item">
       <a href="#" class="nav-link"><i class="icon-hammer-wrench"></i> <span>Help & Support</span></a>
      </li> -->
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
            <!-- /sidebar content -->

        </div>


        <div class="content-wrapper">
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4 style="font-size: 1.00rem;"><span class="font-weight-semibold">Home</span> <i class="icon-arrow-right13"></i><span class="font-weight-semibold" style="color: #cb2316; font-size:14px;"> @yield('breadcrumb')</span></h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i
                                class="icon-more"></i></a>
                    </div>

                    <div class="header-elements d-none">
                        <div class="d-flex justify-content-center">
                            <a href="#"
                                class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                                <i class="icon-bars-alt text-pink-300"></i>
                                <span>Statistics</span>
                            </a>
                            <a href="#"
                                class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                                <i class="icon-calculator text-pink-300"></i>
                                <span>Invoices</span>
                            </a>
                            <a href="#"
                                class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
                                <i class="icon-comment-discussion text-pink-300"></i>
                                <span>Support</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>

        <div class="navbar navbar-expand-lg navbar-dark fixed-bottom">
            <div id="navbar-footer">
                <span class="navbar-text d-none d-sm-block float-left">
                    &copy; 2023 - 2024. <a href="#">Copyright @</a> <a href="#"
                        target="_blank"><span style="color: #cb2316; font-weight:bold;">Mission</span>.</a>
                </span>

                <ul class="ml-lg-auto float-right">
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i
                                class="icon-lifebuoy mr-2"></i> Support</a></li>
                    <li class="nav-item"><a href="#" class="navbar-nav-link" target="_blank"><i
                                class="icon-file-text2 mr-2"></i> Docs</a></li>
                    <li class="nav-item"><a href="#" class="navbar-nav-link font-weight-semibold"
                            style="color:#e91e63"><i class="icon-cart2 mr-2"></i> Purchase</a></li>
                </ul>
            </div>
        </div>
    </div>
    @stack('footscript')
</body>

</html>
