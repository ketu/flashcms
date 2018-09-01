@extends('frontend.layout')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    <!-- Form with validation -->
    <form class="form-validate" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="panel panel-body login-form">
            <div class="text-center">

                <h3 class="content-group">{{__('auth.signup_an_account')}}</h3>
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


            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">{{__('button.signup')}}</button>
            </div>


            <div class="content-divider text-muted form-group"><span>{{__('auth.have_an_account')
                            }}</span>&nbsp;<a href="{{route('login')}}">{{__('button.login')}}</a></div>


        </div>
    </form>
    <!-- /form with validation -->
        </div>
    </div>
@endsection
