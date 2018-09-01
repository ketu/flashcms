@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-6">
    <!-- Form with validation -->
    <form class="form-validate" action="{{route('login')}}" method="post">
        {{ csrf_field() }}

        <div class="panel panel-body login-form">
       

            <div class="form-group has-feedback has-feedback-left">
                <input class="form-control" type="text" id="login-username"
                       name="email" required placeholder="{{__('auth.email')}}">
          
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
               
                @if ($errors->has('password'))
                    <label class="validation-error-label">
                        {{ $errors->first('password') }}
                    </label>
                @endif
            </div>

        

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">{{__('button.login')}}</button>
            </div>


          


        </div>
    </form>
    <!-- /form with validation -->
        </div>
    </div>
@endsection
@section('footer.scripts.extra')
	<script>
		$(document).ready(function () {
			$.backstretch("{{asset('assets/img/bg/index.png')}}");
		});
	</script>
@stop