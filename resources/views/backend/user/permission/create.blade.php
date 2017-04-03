@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('permission.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>

                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('permission.display_name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="display_name" class="form-control" required="required"
                                   value="{{Request::old('display_name')}}"
                                   placeholder="{{ __('permission.display_name') }}">
                            @if ($errors->first('display_name'))
                                <label id="display_name-error" class="validation-error-label"
                                       for="display_name">{{$errors->first('display_name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('permission.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('permission.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->



                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('permission.description') }}</label>
                        <div class="col-lg-9">
                            <textarea type="text" rows="10" name="description" class="form-control"
                                      placeholder="{{ __('permission.description') }}">{{Request::old
                            ('description')}}</textarea>
                            @if ($errors->first('description'))
                                <label id="description-error" class="validation-error-label"
                                       for="description">{{$errors->first('description')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

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