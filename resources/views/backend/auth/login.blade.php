@extends('backend.layout')
@section('body.class', 'login-container login-cover')
@section('body')
    <!-- Page container -->
    <div class="page-container">


        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Form with validation -->
                    <form class="form-validate" action="{{route('login')}}" method="post">
                        {{ csrf_field() }}

                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="fa fa-hand-o-up"></i>
                                </div>
                                <h5 class="content-group">L{{'backend.auth.login_to_your account'}}

                                </h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" type="text" id="login-username"
                                       name="email" placeholder="{{__('backend.auth.email')}}">
                                <div class="form-control-feedback">
                                    <i class="fa fa-user text-muted"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" type="password" id="login-password"
                                       placeholder="{{__('backend.auth.password')}}"
                                       name="password">
                                <div class="form-control-feedback">
                                    <i class="fa fa-lock text-muted"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>

                            <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" class="styled"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('backend.auth.remember_me')}}
                                        </label>
                                    </div>

                                    <div class="col-sm-6 text-right">
                                        <a href="{{ route('password.request') }}">{{__('backend.auth.forgot_password')}}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-pink-400 btn-block">{{__('backend.button.login')}} <i
                                            class="icon-arrow-right14 position-right"></i></button>
                            </div>


                            <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
                            <a href="{{route('register')}}" class="btn btn-default btn-block content-group">{{__('backend.button.signup')}}</a>

                        </div>
                    </form>
                    <!-- /form with validation -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->


@endsection
