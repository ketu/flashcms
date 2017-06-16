@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    <!-- Form with validation -->
    <form class="form-validate" action="{{route('login')}}" method="post">
        {{ csrf_field() }}

        <div class="panel panel-body login-form">
            <div class="text-center">

                <h3 class="content-group">{{__('auth.login_to_your_account')}}</h3>
            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input class="form-control" type="text" id="login-username"
                       name="email" required placeholder="{{__('auth.email')}}">
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
                <input class="form-control" type="password" required id="login-password"
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

            <div class="form-group login-options">
                <div class="row">
                    <div class="col-sm-6">


                        <label>
                            <input type="checkbox" class="styled"
                                   class="single_basic_checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('auth.remember_me')}}
                        </label>

                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="{{ route('password.request') }}">{{__('auth.forgot_password')}}</a>
                    </div>
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">{{__('button.login')}} <i
                            class="icon-arrow-right14 position-right"></i></button>
            </div>


            <div class="content-divider text-muted form-group"><span>{{__('auth.do_not_have_account')
                            }}</span>&nbsp;<a href="{{route('register')}}">{{__('button.signup')}}</a></div>


        </div>
    </form>
    <!-- /form with validation -->
        </div>
    </div>
@endsection
