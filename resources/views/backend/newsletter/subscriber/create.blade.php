@extends('backend.layout')
@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">

        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('subscriber.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>


                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('subscriber.email') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="email" class="form-control" required="required" value="{{Request::old('email')}}"
                                   placeholder="{{ __('subscriber.email') }}">
                            <div class="form-control-feedback">
                                <i class="fa fa-user"></i>
                            </div>
                            @if ($errors->first('email'))
                            <label id="email-error" class="validation-error-label" for="email">{{$errors->first('email')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->



                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('subscriber.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if(!Request::old('status')) checked @endif
                                value="1" class="switch">
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
            var validator = $(".form-validate-jquery").validate();
        });

    </script>
@endsection