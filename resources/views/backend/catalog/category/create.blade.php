@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('category.save')}}">
                {{ csrf_field() }}
                <fieldset class="content-group">
                    <legend class="text-bold">Basic inputs</legend>
                    <!-- Input with icons -->
                    <div class="form-group has-feedback">
                        <label class="control-label col-lg-3">{{ __('category.name') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" required="required"
                                   value="{{Request::old('name')}}"
                                   placeholder="{{ __('category.name') }}">
                            @if ($errors->first('name'))
                                <label id="name-error" class="validation-error-label"
                                       for="name">{{$errors->first('name')}}</label>
                            @endif

                        </div>
                    </div>
                    <!-- /input with icons -->





                    <!-- Basic text input -->
                    <div class="form-group">
                        <label class="control-label col-lg-3">{{ __('category.parent_id') }}<span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <select name="parent_id" class="form-control select2" data-placeholder="{{__('button.please_select')}}">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if(Request::old('parent_id') == $category->id) checked
                                    @endif >{{$category->name}}</option>
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
                        <label class="control-label col-lg-3">{{__('category.status')}}<span
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