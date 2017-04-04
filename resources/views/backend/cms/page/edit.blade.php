@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">


        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('cms.page.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$page->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('page.title') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$page->name}}" placeholder="{{ __('page.title') }}">
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
                                   value="{{$page->slug}}" placeholder="{{ __('page.slug') }}">
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
                                <input type="checkbox" name="status" @if($page->status) checked @endif value="1"
                                       class="switch">
                            </label>
                        </div>
                    </div>
                    <!-- /inline switch group -->

                </fieldset>

                <hr>
                <textarea name="content" class="summernote-height">
                    {{$page->content}}
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


            });

        });

    </script>
@endsection