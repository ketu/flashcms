<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FlashCMS')</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.geekzu.org/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
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
            <a class="navbar-brand" href="{{route('dashboard')}}"><img
                        src="{{asset('assets/backend/images/logo_light.png')}}"
                        alt=""></a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="fa  fa-align-justify"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="fa fa-list"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
                <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="fa fa-align-justify"></i></a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">


                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">

                        <span>{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{$localeCode}}"
                                   href="{{Request::fullUrlWithQuery(['locale'=> $localeCode])}}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
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
                                @if (Auth::check())
                                    <div class="media-body">
                                        <span class="media-heading text-semibold">{{Auth::user()->name}}</span>
                                        <div class="text-size-mini text-muted">
                                            {{Auth::user()->nickname}}
                                        </div>
                                    </div>
                                @endif

                                <div class="media-right media-middle">
                                    <ul class="icons-list">
                                        <li>
                                            <a href="{{route('dashboard')}}"><i class="fa fa-gears"></i></a>
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

                                <li class="{{Menu::isActive() ? 'active' : ''}}"><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> <span>{{__
                            ('nav.dashboard')}}</span></a></li>
                                <li>
                                    <a href="#"><i class="fa fa-s15"></i> <span>{{__('nav.cms')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('cms/page*') ? 'active' : ''}}"><a href="{{route('cms.page')}}">{{__('nav.page')}}</a></li>
                                        <li class="{{Menu::isActive('cms/block*') ? 'active' : ''}}"><a href="{{route('cms.block')}}">{{__('nav.block')}}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> <span>{{__('nav.users')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('user*') ? 'active' : ''}}"><a href="{{route('user')}}">{{__('nav.users')}}</a></li>
                                        <li class="{{Menu::isActive('role*') ? 'active' : ''}}"><a href="{{route('role')}}">{{__('nav.user.role')}}</a></li>
                                        <li class="{{Menu::isActive('permission*') ? 'active' : ''}}"><a href="{{route('permission')}}">{{__('nav.user.permission')}}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-user"></i> <span>{{__('nav.catalog')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('catalog/category*') ? 'active' : ''}}"><a href="{{route('category')}}">{{__('nav.category')}}</a></li>
                                        <li class="{{Menu::isActive('catalog/product*') ? 'active' : ''}}"><a href="{{route('product')}}">{{__('nav.product')}}</a></li>
                                        <li class="{{Menu::isActive('catalog/template*') ? 'active' : ''}}"><a href="{{route('template')}}">{{__('nav.template')}}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gear"></i><span>{{__('nav.newsletter')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('subscriber*') ? 'active' : ''}}"><a href="{{route('subscriber')}}">{{__('nav.newsletter.subscriber')}}</a></li>


                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gear"></i><span>{{__('nav.menu')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('menu*') ? 'active' : ''}}"><a href="{{route('menu')}}">{{__('nav.menu')}}</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-gear"></i><span>{{__('nav.system')}}</span></a>
                                    <ul>
                                        <li class="{{Menu::isActive('system*') ? 'active' : ''}}"><a href="{{route('system.config')}}">{{__('nav.system.config')}}</a></li>
                                        <li class="{{Menu::isActive('attribute*') ? 'active' : ''}}"><a href="{{route('attribute')}}">{{__('nav.attribute')}}</a></li>

                                    </ul>
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
                            <h4><i class="icon-arrow-left52 position-left"></i> <span
                                        class="text-semibold">Starters</span>
                                - Fixed Layout</h4>
                        </div>
                    @show
                    @section('page.button')
                    @show
                    @if (Session::has('success'))
                        {{ Session::get('success') }}
                    @endif
                    @if (Session::has('failed'))
                        {{ Session::get('failed') }}
                    @endif
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
                    &copy; 2017. <a href="#">FlashCMS</a> by <a href="#"
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
@section('footer.scripts.additional')
@show
@show
</body>
</html>
