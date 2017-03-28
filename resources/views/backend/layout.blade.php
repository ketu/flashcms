<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FlashCMS')</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <!-- <link href="assets/css/app.min.css" rel="stylesheet" type="text/css"> -->
    <link href="{{asset('assets/backend/css/app.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>

<body class="@yield('body.class', 'navbar-top')">
@section('body')
    @section('topnav')
<!-- Main navbar -->
<div class="navbar navbar-default navbar-fixed-top header-highlight">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="{{asset('assets/backend/images/logo_light.png')}}"
                                                       alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="fa  fa-align-justify"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="fa fa-list"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="fa  fa-align-justify"></i></a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">


            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/image.png" alt="">
                    <span>Victoria</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                    <li><a href="#"><i class="icon-coins"></i> My balance</a></li>
                    <li><a href="#"><span class="badge badge-warning pull-right">58</span> <i
                                    class="icon-comment-discussion"></i> Messages</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
                    <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
    @show

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main">
            <div class="sidebar-content">
                @section('sidebar_profile')
                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="category-content">
                        <div class="media">
                            <a href="#" class="media-left"><img src="assets/images/image.png" class="img-circle img-sm"
                                                                alt=""></a>
                            <div class="media-body">
                                <span class="media-heading text-semibold">Victoria Baker</span>
                                <div class="text-size-mini text-muted">
                                    <i class="fa fa-map-pin text-size-small"></i> &nbsp;Santa Ana, CA
                                </div>
                            </div>

                            <div class="media-right media-middle">
                                <ul class="icons-list">
                                    <li>
                                        <a href="#"><i class="fa fa-gears"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /user menu -->
                @show


                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        @section('navigation')
                        <ul class="navigation navigation-main navigation-accordion">

                            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                            <li>
                                <a href="#"><i class="fa fa-s15"></i> <span>CMS</span></a>
                                <ul>
                                    <li><a href="{{route('cms.page')}}">Page</a></li>
                                    <li><a href="horizontal_nav.html">Block</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-user"></i> <span>Users</span></a>
                                <ul>
                                    <li><a href="horizontal_nav.html">Users</a></li>
                                    <li><a href="horizontal_nav.html">User Group</a></li>
                                    <li><a href="horizontal_nav.html">User Role</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-gear"></i><span>System</span></a>
                                <ul>
                                    <li><a href="horizontal_nav.html">Horizontal navigation</a></li></ul>
                            </li>
                           {{-- <li>
                                <a href="#"><i class="icon-stack"></i> <span>Starter kit</span></a>
                                <ul>
                                    <li><a href="horizontal_nav.html">Horizontal navigation</a></li>
                                    <li><a href="1_col.html">1 column</a></li>
                                    <li><a href="2_col.html">2 columns</a></li>
                                    <li>
                                        <a href="#">3 columns</a>
                                        <ul>
                                            <li><a href="3_col_dual.html">Dual sidebars</a></li>
                                            <li><a href="3_col_double.html">Double sidebars</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="4_col.html">4 columns</a></li>
                                    <li>
                                        <a href="#">Detached layout</a>
                                        <ul>
                                            <li><a href="detached_left.html">Left sidebar</a></li>
                                            <li><a href="detached_right.html">Right sidebar</a></li>
                                            <li><a href="detached_sticky.html">Sticky sidebar</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="layout_boxed.html">Boxed layout</a></li>
                                    <li class="navigation-divider"></li>
                                    <li><a href="layout_navbar_fixed_main.html">Fixed top navbar</a></li>
                                    <li><a href="layout_navbar_fixed_secondary.html">Fixed secondary navbar</a></li>
                                    <li><a href="layout_navbar_fixed_both.html">Both navbars fixed</a></li>
                                    <li class="active"><a href="layout_fixed.html">Fixed layout</a></li>
                                </ul>
                            </li>--}}
                            <!-- /main -->
                        </ul>
                            @show
                    </div>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /main sidebar -->


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    @section('page.title')
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Starters</span>
                            - Fixed Layout</h4>
                    </div>
                    @show
     {{--               <div class="heading-elements">
                        <a href="#" class="btn btn-labeled btn-labeled-right bg-blue heading-btn">Button <b><i
                                        class="fa fa-bars"></i></b></a>
                    </div>--}}
                </div>

                <div class="breadcrumb-line breadcrumb-line-component">
                    @section('breadcrumb')
                {{--        <ul class="breadcrumb">
                        <li><a href="index.html"><i class=" position-left fa fa-home fa-2" aria-hidden="true"></i> Home</a>
                        </li>
                        <li><a href="layout_fixed.html">Starters</a></li>
                        <li class="active">Fixed layout</li>
                    </ul>--}}
                    @show
                </div>
            </div>
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">
                @yield('content')


                <!-- Footer -->
                <div class="footer text-muted">
                    @section('footer')
                    &copy; 2017. <a href="#">FlashCMS</a> by <a href="http://themeforest.net/user/Kopyov"
                                                                target="_blank">Kakuer CO.,Ltd</a>
                    @show
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

@section('footer.scripts')
<!-- Core JS files -->
<script type="text/javascript" src="{{ asset('assets/backend/js/app.min.js')}}"></script>
<!-- /theme JS files -->
    @show
@show
</body>
</html>
