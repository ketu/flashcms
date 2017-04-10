@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('template.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$template->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('product.template.information')}}</legend>


                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('template.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$template->name}}"
                                   placeholder="{{ __('template.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /basic text input -->

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('template.attributes') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select multiple="multiple" name="attributes[]" class="form-control listbox" required>
                                @foreach($attributes as $attribute)
                                    <option value="{{$attribute->id }}"
                                            @if($template->attributes->contains($attribute)) selected
                                            @endif>{{$attribute->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('permission'))
                                <label id="permission[]-error" class="validation-error-label"
                                       for="permission[]">{{$errors->first('permission')}}</label>
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