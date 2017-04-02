@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">


        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('user.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('user.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required" value="{{Request::old('name')}}"
                                   placeholder="{{ __('user.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label" for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->


                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('user.email') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" required="required" value="{{Request::old('email')}}"
                                   placeholder="{{ __('user.email') }}">
                            <div class="form-control-feedback">
                                <i class="fa fa-user"></i>
                            </div>
                            @if ($errors->first('email'))
                            <label id="email-error" class="validation-error-label" for="email">{{$errors->first('email')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('user.nickname') }}</label>
                        <div class="col-lg-9">
                            <input type="text" name="nickname" class="form-control" value="{{Request::old('nickname')}}"
                                   placeholder="{{ __('user.nickname') }}">
                            @if ($errors->first('nickname'))
                                <label id="nickname-error" class="validation-error-label" for="nickname">{{$errors->first('nickname')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('user.password') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input id="password" type="password" name="password" class="form-control" required="required"
                                   placeholder="{{ __('user.password') }}">
                        </div>
                    </div>
                    <!-- /basic text input -->
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('user.password_confirmation') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="password" name="password_confirmation" class="form-control" required="required"
                                   placeholder="{{ __('user.password_confirmation') }}">
                            @if ($errors->first('password_confirmation'))
                                <label id="password_confirmation-error" class="validation-error-label" for="password_confirmation">{{$errors->first('password_confirmation')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

                </fieldset>

                <hr>
                <fieldset>
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('user.roles')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                             <select multiple name="groups[]" data-placeholder="{{__('user.please_select_roles')}}" class="select2" required>
                                 @foreach($roles as $role)
                                    <option value="{{$role->id}}" @if ( Request::old('roles') && in_array($role->id, Request::old('roles'))) selected @endif>{{$role->display_name}}</option>
                                     @endforeach
                             </select>
                            @if ($errors->first('groups'))
                                <label id="groups[]-error" class="validation-error-label" for="groups[]">{{$errors->first('groups')}}</label>
                            @endif
                        </div>
                    </div>
                </fieldset>


                <fieldset>
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('user.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if(Request::old('status')) checked @endif value="1" class="switch">
                            </label>
                        </div>
                    </div>
                    <!-- /inline switch group -->

                </fieldset>



                <div class="text-right">

                    <button type="submit" class="btn btn-primary">{{__('button.save')}} <i
                                class="icon-arrow-right14 position-right"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /form validation -->

@endsection

@section('footer.scripts.additional')
    <script>


        $(document).ready(function () {

            $('.select2').select2({
                    width: '100%'
                }
            );
            // Initialize
            var validator = $(".form-validate-jquery").validate({
                rules: {
                    password: {
                        minlength: 5
                    },
                    password_confirmation: {
                        equalTo: "#password"
                    },
                    email: {
                        email: true
                    },
                    name: {
                        minlength: 5
                    }
                }
            });

        });

    </script>
@endsection