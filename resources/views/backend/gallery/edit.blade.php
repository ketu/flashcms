@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('gallery.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$gallery->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('gallery.information')}}</legend>


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('gallery.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$gallery->name}}"
                                   placeholder="{{ __('gallery.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->
              
                    
                     
                    <!-- /basic text input -->
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('gallery.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if($gallery->status) checked
                                       @endif value="1" class="switch">
                            </label>
                        </div>
                    </div>
                    <div class="form-group" id="gallery">
                    <label class="control-label col-lg-3">{{ __('gallery.images') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <!-- Removable thumbnails -->
                         
                            <!-- /removable thumbnails -->
                            </div>

                        </div>
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

