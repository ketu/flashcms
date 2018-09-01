@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('gallery.image.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$image->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('gallery.image.information')}}</legend>


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('image.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$image->name}}"
                                   placeholder="{{ __('image.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('image.link')}}</label>
                        <div class="col-lg-9">
                            <input type="file" name="link" class="file-styled">
                            <p class="help-block">
                            <img width="100" height="100" src="/{{$image->link}}">
          
                            </p>
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
            var validator = $(".form-validate-jquery").validate();
        });
    </script>
@endsection