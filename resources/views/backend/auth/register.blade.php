@extends('backend.layout')
@section('body.class', 'login-container login-cover')
@section('body')
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Form with validation -->
                    <form class="form-validate" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="fa fa-hand-o-up"></i>
                                </div>
                                <h5 class="content-group">{{__('auth.signup_an_account')}}</h5>
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       placeholder="{{__('auth.username')}}" required autofocus>

                                <div class="form-control-feedback">
                                    <i class="fa fa-user text-muted"></i>
                                </div>
                                @if ($errors->has('name'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('name') }}
                                    </label>
                                @endif
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" placeholder="{{__('auth.email')}}" required>

                                <div class="form-control-feedback">
                                    <i class="fa fa-envelope text-muted"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>


                            <div class="form-group has-feedback has-feedback-left">
                                <input class="form-control" type="password" id="login-password"
                                       placeholder="{{__('auth.password')}}"
                                       name="password">
                                <div class="form-control-feedback">
                                    <i class="fa fa-lock text-muted"></i>
                                </div>
                                @if ($errors->has('password'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('password') }}
                                    </label>
                                @endif
                            </div>

                            <div class="form-group has-feedback has-feedback-left">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"
                                       placeholder="{{__('auth.password_confirmation')}}" required>


                                <div class="form-control-feedback">
                                    <i class="fa fa-lock text-muted"></i>
                                </div>

                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn bg-pink-400 btn-block">{{__('button.signup')}}
                                    <i class="fa fa-arrow-right position-right"></i></button>
                            </div>


                            <div class="content-divider text-muted form-group"><span>{{__('auth.have_an_account')
                            }}</span></div>
                            <a href="{{route('login')}}"
                               class="btn btn-default btn-block content-group">{{__('button.login')}}</a>

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
