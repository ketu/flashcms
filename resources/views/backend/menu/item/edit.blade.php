@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('menu.item.update')}}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$item->id}}" name="id">
                <fieldset class="content-group">
                    <legend class="text-bold">{{__('menu.item.information')}}</legend>
                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('menu.item.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{$item->name}}"
                                   placeholder="{{ __('menu.item.name') }}">
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
                                   value="{{$item->link}}"
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
                        <label class="control-label col-lg-3">{{ __('menu.item.parent_id') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select name="parent_id" class="form-control select2" data-placeholder="{{__('button.please_select')}}">

                                @foreach($items as $menuItem)
                                    <option value="{{$menuItem->id}}" @if(in_array($menuItem->id, $children))
                                    disabled @endif @if($item->parent && $item->parent->id == $item->id) selected @endif >{{$menuItem->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('parent_id'))
                                <label id="parent_id-error" class="validation-error-label"
                                       for="parent_id">{{$errors->first('parent_id')}}</label>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <!-- Inline switch group -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{__('menu.item.status')}}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <label class="checkbox-inline checkbox-switch">
                                <input type="checkbox" name="status" @if($item->status) checked
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