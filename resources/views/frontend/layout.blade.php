<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FlashCMS')</title>

    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="@yield('body.class')">
@section('body')
@section('main.nav')
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top top-nav" role="navigation">
        <div class="container">


            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/150x50&text=Logo" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/collections/action-camera" class="">Action</a>
                    </li>


                    <li>
                        <a href="/collections/mirrorless-camera">Mirrorless</a>
                    </li>


                    <li>
                        <a href="/collections/home-camera">Home</a>
                    </li>


                    <li>
                        <a href="/collections/smart-dash-camera">Dash</a>
                    </li>


                    <li>
                        <a href="/collections/accessories">Accessories</a>
                    </li>


                    <li>
                        <a href="https://help.yitechnology.com/hc/en-us">Support</a>
                    </li>


                </ul>

                <form class="navbar-form navbar-right">
                    <p class="small account-text text-right"><a href="{{route('login')}}" class="navbar-link">Sign in</a> or <a href="{{route('register')}}">Create
                            an account</a></p>
                    <div class="form-group">
                        <input type="text" class="form-control top-search-input" name="q" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-default btn-top-search"><i
                                class="glyphicon glyphicon-search"></i></button>
                </form>


            </div>
            <!-- /.navbar-collapse -->

        </div>
        <!-- /.container -->
    </nav>
@show
<div class="container">
    @yield('content')
</div>

@section('footer')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2">


                    <h4>Quick links</h4>


                    <ul class="list-unstyled">

                        <li><a href="https://yitechnology.com/aboutus/">About Us</a></li>

                        <li><a href="https://yitechnology.com/press/">YI News</a></li>

                        <li><a href="https://help.yitechnology.com/hc/en-us">Help Center</a></li>

                    </ul>


                </div>
                <div class="col-md-6">
                    <h4>Get in touch</h4>
                    <p class="small">We believe the very best imaging and computer vision technology should be easy and
                        accessible
                        to everyone.&nbsp;We are YI, <em>Your Innovator</em>.&nbsp;</p>
                    <p class="small">(U.S. Shipping Address Only)</p>
                </div>
                <div class="col-md-4">
                    <h4>Newsletter</h4>
                    <form class="form-inline" id="subscribe-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email address...">
                        </div>
                        <button type="submit" class="btn btn-default">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr>
                    <ul class="list-unstyled list-inline footer-menu">
                        <li><a href="/pages/legal-terms-of-use">Terms of Use</a></li>
                        <li><a href="/pages/legal-privacy-policy">Privacy Policy</a></li>
                        <li><a href="/pages/legal-limited-warranty">Limited Warranty</a></li>
                        <li class="pull-right">
                            <a class="icon-fallback-text" href="https://www.twitter.com/yitechnology"
                               title="YI on Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a class="icon-fallback-text" href="https://www.twitter.com/yitechnology"
                               title="YI on Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a class="icon-fallback-text" href="https://www.twitter.com/yitechnology"
                               title="YI on Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="pull-right">
                            <a class="icon-fallback-text" href="https://www.twitter.com/yitechnology"
                               title="YI on Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>

                    </ul>

                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>© 2017 YI Technologies, Inc.</p>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </footer>
@show
@section('back_to_top')
    <!-- child of the body tag -->
    <span id="top-link-block" class="hidden">
            <a href="#top" class="well well-sm" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
                <i class="glyphicon glyphicon-chevron-up"></i> Back to Top
            </a>
        </span><!-- /top-link-block -->
    <!-- jQuery -->
@show
@section('footer.scripts')
    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/app.min.js')}}"></script>
    <!-- /theme JS files -->
@show
@section('footer.scripts.extra')
@show
@show
</body>

</html>
