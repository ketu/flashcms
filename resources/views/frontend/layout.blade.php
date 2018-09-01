<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'T-Creative | 同创新科技工程: 洁净工程: 净化工程')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicons -->
    <link rel="shortcut icon" href="img/favicons/favicon.png">
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">

    <link href="{{asset('assets/css/reset.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/font-awesome.all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/idangerous.swiper.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/jquery.fancybox.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="@yield('body.class')">
    @section('body')
 
    <!-- Top header -->
    <div id="top">

        <!-- Sidebar button -->
        <a href="#" id="sidebar-button"></a>

        <!-- Logo -->
        <header id="logo">
            @section('logo')
            <a href="/">
                <!--
				<img src="{{asset('assets/img/logo.png')}}">
	-->
            </a>
            @show
        </header>
        <div class="language"><a href="{{Request::fullUrlWithQuery(['locale'=> 'zh'])}}">中</a> | <a href='{{Request::fullUrlWithQuery(['locale'=> 'en'])}}'>EN</a></div>
    </div>

    <!-- Main wrapper -->
    <div id="main-wrapper" class="container">


        <div class="row" style="min-height:600px;">
            <div class="col-md-4 col-xs-12">
                <!-- Collapsible sidebar -->
                <div id="sidebar">

                    <!-- Widget Area -->
                    <div id="widgets">

                        <!-- Main menu -->
                        @section('main.nav')
                        <nav id="mainmenu">
                        @include("frontend.menu.partial")
                            <!-- <ul>

                                
                                <li>
                                    <a href="javascript:void(0)">走进同创新</a>
                                    <ul>
                                        <li>
                                            <a href="/about-us">关于我们</a>
                                        </li>
                                        <li>
                                            <a href="/culture">企业文化</a>
                                        </li>
                                        <li>
                                            <a href="/qualification">企业资质</a>
                                        </li>
                                        <li>
                                            <a href="/team">团队风采</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="javascript:void(0)">新闻动态</a>
                                    <ul>
                                        <li>
                                            <a href="/blog/category/1">企业新闻</a>
                                        </li>
                                        <li>
                                            <a href="/blog/category/2">行业动态</a>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0)">工程案例</a>
                                    <ul>
                                        <li>
                                            <a href="/gallery/1">洁净工程</a>
                                        </li>
                                        <li>
                                            <a href="/gallery/2">净化工程</a>
                                        </li>
                                        <li>
                                            <a href="/gallery/3">装修装饰</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="/blog/category/3">技术支持</a>
                                </li>
                                <li>
                                    <a href="/network">网点支持</a>
                                </li>
                                <li>
                                    <a href="/contact-us">联系我们</a>
                                </li>
                            </ul> -->
                        </nav>
                        @show
                    </div>



                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-xs-12">
                <!-- Content -->
                <div id="content">
     
                    <div class="container">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

 
 <div class="footer-container">
            <!-- Copyright -->
            <footer class="container-fluid">

                <div class="row">
                    @section('footer')
                    <div class="col-md-6 col-xs-12">
                    {{Block::show("footer-copyright")}}
                        <!-- <p class="service-info">工匠精神 服务客户 以人为本</p>
                        <p class="copyright">版权所有 © 深圳同创新科技工程有限公司</p> -->
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p class="social-links">
                            <a href="">
                                <i class="fab fa-qq"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-weixin"></i>
                            </a>
                            <a href="">
                                <i class="fab fa-weibo"></i>
                            </a>
                        </p>
                    </div>
                    <!-- <div class="col-md-6 col-xs-12">
                        <p class="copyright">邮箱地址:zxb@t-creative.cn&nbsp;&nbsp;地址:深圳市宝安中心区兴华路南侧龙光世纪大厦A栋3-50号</p>
                    </div> -->
                    @show
				</div>

            </footer>	</div>
 
    </div>


    @section('footer.scripts')
    <!-- JavaScripts -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/swiper/idangerous.swiper.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/masonry/masonry.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/isotope/jquery.isotope.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery-backstretch/jquery.backstretch.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom.js')}}"></script>

    <!-- /theme JS files -->

    <script>
        $(document).ready(function () {

            $("#mainmenu ul > li.expandable").hover(function () {
                $(this).addClass("expanded");
            }, function () {
                $(this).removeClass("expanded");
            });
        });
    </script> @show @section('footer.scripts.extra') @show @show
</body>

</html>