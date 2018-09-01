@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('attribute.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>
                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('attribute.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('attribute.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('attribute.code') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="code" class="form-control" required="required"
                                   value="{{Request::old('code')}}"
                                   placeholder="{{ __('attribute.code') }}">
                            @if ($errors->first('code'))
                                <label id="code-error" class="validation-error-label"
                                       for="code">{{$errors->first('code')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('attribute.type') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select name="type" class="form-control select2" required>
                                <option value="">{{__('button.please_select')}}</option>
                                @foreach($attributeTypes as $code=> $name)
                                    <option value="{{$code}}">{{$name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('type'))
                                <label id="type-error" class="validation-error-label"
                                       for="type">{{$errors->first('type')}}</label>
                            @endif
                        </div>
                    </div>

                    <div class="form-group attribute-options" hidden>
                        <label class="control-label col-lg-3">{{ __('attribute.options') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <ul class="list-unstyled" id="attribute-option-container"
                                data-prototype='     &lt;li&gt;
                                    &lt;div class="form-group"&gt;
                                        &lt;label class="control-label col-lg-2"&gt;{{ __('attribute.option.label') }}&lt;span
                                                    class="text-danger"&gt;*&lt;/span&gt;&lt;/label&gt;
                                        &lt;div class="col-lg-5"&gt;
                                            &lt;input type="text" name="option.label[]" class="form-control"
                                                   required="required"
                                                   value="__value__"
                                                   placeholder="{{ __('attribute.option.label') }}"&gt;
                                        &lt;/div&gt;
                                        &lt;button class="btn btn-xs btn-danger btn-remove-option" type="button"&gt;Remove&lt;/button&gt;
                                    &lt;/div&gt;
                                &lt;/li&gt;'>

                            </ul>
                            <div class="col-lg-offset-7">
                                <button type="button" class="btn btn-lg btn-info btn-add-option">add</button>
                            </div>

                        </div>
                    </div>


                </fieldset>
                <fieldset>
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('attribute.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if(Request::old('status')) checked
                                       @endif value="1" class="switch">
                            </label>
                        </div>
                    </div>
                    <!-- /inline switch group -->
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('attribute.is_required')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="is_required" @if(Request::old('is_required')) checked
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
            var attributeType = $('.select2').select2();

             var attributeTypeHasOption = $.parseJSON('{!! $attributeTypeHasOption !!}');

            $('.select2').on('select2:select', function (evt) {
                // Do something
                var selected = $(this).select2('val');

                if ($.inArray(selected, attributeTypeHasOption) != -1) {
                    $('.attribute-options').show();
                    var container = $('#attribute-option-container');
                    var children = container.find('li');
                    if (children.length == 0) {
                        $('.btn-add-option').click();
                    }
                } else {
                    $('.attribute-options').hide();
                }
            });

            $('.btn-add-option').click(function () {
                var container = $('#attribute-option-container');
                var prototypeTemplate = container.data('prototype');
                prototypeTemplate = prototypeTemplate.replace('__value__', '');
                var child = $(prototypeTemplate);

                var children = container.find('li');

                if (children.length == 0) {
                    child.find('.btn-remove-option').remove();
                }
                container.append(child);
                container.find('.btn-remove-option').click(function () {
                    $(this).parent().parent().remove();
                });
            });

            // Initialize
            var validator = $(".form-validate-jquery").validate();
        });

    </script>
@endsection