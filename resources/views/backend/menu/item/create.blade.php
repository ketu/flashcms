@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('menu.item.save')}}">
                {{ csrf_field() }}
                <input type="hidden" name="menuId" value="{{$menu->id}}">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('menu.item.add_new_information', [$menu->name])}}</legend>
                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('item.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('item.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->


                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('item.link') }}</label>
                        <div class="col-lg-9">
                            <input type="text" name="link" class="form-control"
                                   value="{{Request::old('link')}}" required
                                   placeholder="{{ __('item.link') }}">
                            @if ($errors->first('link'))
                                <label id="link-error" class="validation-error-label"
                                       for="link">{{$errors->first('link')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- /input with icons -->

                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('menu.item.parent_id') }}</label>
                        <div class="col-lg-9">
                            <select name="parent_id" class="form-control select2" data-placeholder="{{__('button.please_select')}}">
                                <option value="">
                                    {{__('button.please_select')}}
                                </option>
                                @foreach($items as $item)
                                    <option value="{{$item->id}}" @if(Request::old('parent_id') == $item->id) selected
                                    @endif >{{$item->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('parent_id'))
                                <label id="parent_id-error" class="validation-error-label"
                                       for="parent_id">{{$errors->first('parent_id')}}</label>
                            @endif
                        </div>
                    </div>
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('item.status')}}<span
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
            $('.select2').select2();

            // Initialize
            var validator = $(".form-validate-jquery").validate();

        });

    </script>
@endsection