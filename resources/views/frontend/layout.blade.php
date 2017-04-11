<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FlashCMS')</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/bower/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="assets/bower/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="assets/bower/bxslider-4/dist/jquery.bxslider.css" rel="stylesheet">


    <link href="assets/css/screen.css" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/app.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="@yield('body.class')">
@section('body')
    <div class="main-nav navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-default main-nav">

                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                        </button>
                            <a class="navbar-brand page-scroll" href="index.html"><img src="assets/img/logo.png"></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="index.html">Home</a>
                                </li>
                                <li>
                                    <a href="phones.html">Phones</a>
                                </li>
                                <li>
                                    <a href="news.html">News</a>
                                </li>
                                <li>
                                    <a href="store.html">Store</a>
                                </li>
                                <li>
                                    <a href="service.html">Service</a>
                                </li>
                                <li role="presentation" class="dropdown languages">
                                    <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">English<span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li> <a href="es">Español</a></li>
                                        <li> <a href="ru">Русский</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->

                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top:90px;">
        <div class="row">
            <div class="col-lg-12 full-banner">

                <div>
                    <a href="promotion.html"> <img src="assets/img/banner/home-banner.png" class="img-responsive"></a>
                </div>
                <div>
                    <a href="note.html"> <img src="assets/img/banner/banner_03.png" class="img-responsive"></a>
                </div>
                <div>
                    <a href="http://www.geotel.cc/en/product/a1"> <img src="assets/img/banner/banner_01.png" class="img-responsive"></a>
                </div>


            </div>
        </div>
    </div>


    <div class="container-fluid info-box">
        <div class="row">
            <div class="col-lg-4 col-xs-4 box">
                <a href="https://www.youtube.com/watch?v=DX6KjyrOlGY" target="_blank"><img src="assets/img/video-01.png" class="img-responsive"><i class="play-icon"></i></a>
            </div>
            <div class="col-lg-4 col-xs-4 box">
                <a href="https://www.youtube.com/watch?v=Nx6UXBEnTvE" target="_blank"><img src="assets/img/video-02.png" class="img-responsive"><i class="play-icon"></i></a>
            </div>
            <div class="col-lg-4 col-xs-4 box">
                <a href="https://www.youtube.com/watch?v=-GPDewuSSBc" target="_blank"><img src="assets/img/video-03.png" class="img-responsive"><i class="play-icon"></i></a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center social-links">
                <a href="https://www.facebook.com/geotelmobile/" target="_blank"><img src="assets/img/social/1_facebook.png"> </a>
                <a href="https://plus.google.com/u/0/communities/116174518862974353696" target="_blank"><img src="assets/img/social/2_google.png"> </a>
                <a href="https://vk.com/geotelmobile" target="_blank"><img src="assets/img/social/3_vk.png"> </a>
                <a href="https://twitter.com/Geotel_mobile" target="_blank"><img src="assets/img/social/4_twitter.png"> </a>
                <a href="https://www.instagram.com/geotel_mobile/" target="_blank"><img src="assets/img/social/5_instagram.png"> </a>
                <a href="https://www.youtube.com/channel/UCl8R-1gC9SFNK54KyoZy7RQ" target="_blank"><img src="assets/img/social/6_youtube1.png"> </a>
            </div>
        </div>
    </div>


    <footer>
        <div class="links">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <dl>
                            <dt>
                            Products
                        </dt>
                            <dd>
                                <a href="note.html">NOTE</a>
                            </dd>
                            <dd>
                                <a href="http://www.geotel.cc/en/product/a1">A1</a>
                            </dd>

                        </dl>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <dl>
                            <dt>
                            About
                        </dt>
                            <dd>
                                <a href="about.html">About Us</a>
                            </dd>
                            <dd>
                                <a href="http://www.geotel.cc/en/news">News</a>
                            </dd>

                        </dl>
                    </div>
                    <div class="col-md-3 col-xs-6">
                        <dl>
                            <dt>
                            Contact
                        </dt>
                            <dd>
                                <a href="http://geotel.cc/new/service.html">Sales</a>
                            </dd>

                        </dl>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <dl>
                            <dt>
                            Support
                        </dt>
                            <dd>
                                <a href="service.html">Service</a>
                            </dd>
                            <dd>
                                <a href="service.html">FAQ</a>
                            </dd>
                            <dd>
                                <a href="service.html">Warranty</a>
                            </dd>

                        </dl>
                    </div>


                </div>
            </div>

        </div>
        <div class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-xs-12">
                        <a href="index.html" class="footer-logo-link"> <img src="assets/img/footer_logo.png"></a>
                    </div>
                    <div class="col-lg-7 col-xs-12">
                        <div class="address">
                            <div class="row">
                                <div class="col-lg-5 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-1 col-xs-2">
                                            <img src="assets/img/icon/icon_tel.png">
                                        </div>
                                        <div class="col-md-8 col-xs-9">
                                            <address>
                                            Tel:+86-0755-83754730
                                        </address>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-1 col-xs-2">
                                            <img src="assets/img/icon/icon_email.png">
                                        </div>
                                        <div class="col-md-8 col-xs-9">
                                            <address>
                                        Email:nancy@geotel.cc
                                    </address>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-1 col-xs-2">
                                            <img src="assets/img/icon/icon_Address.png">
                                        </div>
                                        <div class="col-md-8 col-xs-9">
                                            <address>
                                            Address:E.416 Building 4 Saige Sci-Tech Park<br>
                                            NO 3021, Huaqiang North <br>
                                            Road, Futian District, Shenzhen, GuangDong
                                        </address>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-xs-12">
                        <ul class="list-unstyled col-lg-12 hide">
                            <li class="col-md-2 col-xs-6"><a href="#">Privacy Policy</a></li>
                            <li class="col-md-2 col-xs-6"><a href="#">Terms Of Use</a></li>
                            <li class="col-md-2 col-xs-6"><a href="#">Disclaimer</a></li>
                            <li class="col-md-2 col-xs-6"><a href="#">Sitemap</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12">
                        <p class="copyright-text">&copy;2016 GEOTEL All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hosting">

        </div>
    </footer>


@section('footer.scripts')
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/backend/js/app.min.js')}}"></script>
    <!-- /theme JS files -->
@show
@section('footer.scripts.additional')
@show
    <!-- child of the body tag -->
    <span id="top-link-block" class="hidden">
        <a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
        </a>
    </span><!-- /top-link-block -->
    <!-- jQuery -->


    <script>
        $(document).ready(function() {
            $('.full-banner').bxSlider({
                mode: 'horizontal',
                auto: false,
                controls: false,
                infiniteLoop: true,

                slideWidth: 1920,
                minSlides: 1,
                maxSlides: 1,
                speed: 1000,
                captions: false,
                pager: true,
                responsive: true,
                useCSS: true

            });

            // Only enable if the document has a long scroll bar
            // Note the window height + offset
            if ( ($(window).height() + 100) < $(document).height() ) {
                $('#top-link-block').removeClass('hidden').affix({
                    // how far to scroll down before link "slides" into view
                    offset: {top:100}
                });
            }
        });
    </script>
@show
</body>

</html>
