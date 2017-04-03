@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('role.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$role->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>

                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('role.display_name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="display_name" class="form-control" required="required"
                                   value="{{$role->display_name}}"
                                   placeholder="{{ __('role.display_name') }}">
                            @if ($errors->first('display_name'))
                                <label id="display_name-error" class="validation-error-label" for="display_name">{{$errors->first('display_name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('role.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$role->name}}"
                                   placeholder="{{ __('role.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label" for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->



                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('role.description') }}</label>
                        <div class="col-lg-9">
                            <textarea type="text" rows="10" name="description" class="form-control"
                                      placeholder="{{ __('role.description')
                                      }}">{{$role->description}}</textarea>
                            @if ($errors->first('description'))
                                <label id="description-error" class="validation-error-label" for="description">{{$errors->first('description')}}</label>
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