@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('gallery.image.save')}}">
                {{ csrf_field() }}
                <input type="hidden" name="galleryId" value="{{$gallery->id}}">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('gallery.image.add_new_information', [$gallery->name])}}</legend>
                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('image.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('image.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->


                    <!-- Input with icons -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('gallery.image.link')}}</label>
                        <div class="col-lg-9">
                            <input type="file" name="link" class="file-styled">
                        </div>
                    </div>
                    <!-- /input with icons -->

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