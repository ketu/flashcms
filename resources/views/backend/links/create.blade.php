@extends('backend.layout')
@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('links.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('links.info')}}</legend>

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('links.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('links.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('links.link') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="link" class="form-control" required="required"
                                   value="{{Request::old('link')}}"
                                   placeholder="{{ __('links.link') }}">
                            @if ($errors->first('link'))
                                <label id="code-error" class="validation-error-label"
                                       for="code">{{$errors->first('link')}}</label>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('links.logo')}}</label>
                        <div class="col-lg-9">
                            <input type="file" name="logo" class="file-styled">
                        </div>
                    </div>
                    <!-- /basic text input -->
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('links.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if(Request::old('status')) checked
                                       @endif value="1" class="switch">
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

            // Initialize
            var validator = $(".form-validate-jquery").validate();
        });
    </script>
@endsection