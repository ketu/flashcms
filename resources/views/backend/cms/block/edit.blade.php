@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">


        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('cms.block.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$block->id}}" name="id">

                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('page.title') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$block->name}}" placeholder="{{ __('page.title') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->


                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('page.slug') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="slug" class="form-control" required="required"
                                   value="{{$block->slug}}" placeholder="{{ __('page.slug') }}">
                            @if ($errors->first('slug'))
                                <label id="slug-error" class="validation-error-label"
                                       for="slug">{{$errors->first('slug')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /input with icons -->


                </fieldset>


                <fieldset>
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('page.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if($block->status) checked @endif value="1"
                                       class="switch">
                            </label>
                        </div>
                    </div>
                    <!-- /inline switch group -->

                </fieldset>

                <hr>
                <textarea name="content" class="summernote-height">
                    {{$block->content}}
                </textarea>

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
                    repeat_password: {
                        equalTo: "#password"
                    },
                    email: {
                        email: true
                    },
                    repeat_email: {
                        equalTo: "#email"
                    },
                    minimum_characters: {
                        minlength: 10
                    },
                    maximum_characters: {
                        maxlength: 10
                    },
                    minimum_number: {
                        min: 10
                    },
                    maximum_number: {
                        max: 10
                    },
                    number_range: {
                        range: [10, 20]
                    },
                    url: {
                        url: true
                    },
                    date: {
                        date: true
                    },
                    date_iso: {
                        dateISO: true
                    },
                    numbers: {
                        number: true
                    },
                    digits: {
                        digits: true
                    },
                    creditcard: {
                        creditcard: true
                    },
                    basic_checkbox: {
                        minlength: 2
                    },
                    styled_checkbox: {
                        minlength: 2
                    },
                    switchery_group: {
                        minlength: 2
                    },
                    switch_group: {
                        minlength: 2
                    }
                },
                messages: {
                    custom: {
                        required: "This is a custom error message"
                    },
                    agree: "Please accept our policy"
                }
            });

        });

    </script>
@endsection