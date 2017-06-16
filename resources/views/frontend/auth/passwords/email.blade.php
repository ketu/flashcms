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
                    <form class="form-validate" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                                <h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
                            </div>

                            <div class="form-group has-feedback">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <label class="validation-error-label">
                                        {{ $errors->first('email') }}
                                    </label>
                                @endif
                            </div>

                            <button type="submit" class="btn bg-pink-400 btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
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
