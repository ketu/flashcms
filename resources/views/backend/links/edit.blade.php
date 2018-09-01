@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('links.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$link->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('menu.information')}}</legend>


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('link.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$link->name}}"
                                   placeholder="{{ __('link.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->
                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('link.link') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="link" class="form-control" required="required"
                                   value="{{$link->link}}"
                                   placeholder="{{ __('link.link') }}">
                            @if ($errors->first('link'))
                                <label id="code-error" class="validation-error-label"
                                       for="code">{{$errors->first('link')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('links.logo')}}</label>
                        <div class="col-lg-9">
                            <input type="file" name="logo" class="file-styled">
                            <p class="help-block">
                                {{$link->logo}}
                            </p>
                        </div>
                    </div>
                    <!-- /basic text input -->
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('links.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if($link->status) checked
                                       @endif value="1" class="switch">
                            </label>
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
            // Basic example
            var dualListElem = $('.listbox').bootstrapDualListbox({
                iconsPrefix: 'fa',                                                           // string, set the icon prefix (e.g. "fa", "glyphicon", etc.)
                icons: {                                                                            // object, set the icon for move and remove operations
                    move: 'fa-arrow-right',
                    remove: 'fa-arrow-left'
                },
                moveOnSelect: true,
                selectorMinimalHeight: 400
            });
            // Initialize
            var validator = $(".form-validate-jquery").validate();
        });
    </script>
@endsection