@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" enctype="multipart/form-data" method="POST" action="{{route('blog.update')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$blog->id}}">
                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#information" data-toggle="tab">{{__('blog.information')}} <i
                                        class="fa fa-menu"></i></a></li>                 
                    </ul>

                    <div class="tab-content panel-body">
                        <div class="tab-pane active" id="information">
                            <!-- Input with icons -->
                            <div class="form-group has-feedback">
                                <label class="control-label col-lg-3">{{ __('blog.name') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" required="required"
                                           value="{{$blog->name}}"
                                           placeholder="{{ __('blog.name') }}">
                                    @if ($errors->first('name'))
                                        <label id="name-error" class="validation-error-label"
                                               for="name">{{$errors->first('name')}}</label>
                                    @endif

                                </div>
                            </div>
                            <!-- /input with icons -->
                            <!-- Input with icons -->
                            <div class="form-group has-feedback">
                                <label class="control-label col-lg-3">{{ __('blog.slug') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" required="required"
                                           value="{{$blog->slug}}"
                                           placeholder="{{ __('blog.slug') }}">
                                    @if ($errors->first('slug'))
                                        <label id="slug-error" class="validation-error-label"
                                               for="slug">{{$errors->first('slug')}}</label>
                                    @endif

                                </div>
                            </div>
                            <!-- /input with icons -->

                          
                            <!-- Basic text input -->
                            <div class="form-group">
                                <label class="control-label col-lg-3">{{ __('blog.categories') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="categories" multiple class="form-control select2" required
                                            data-placeholder="{{__('button.please_select')}}">

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(in_array($category->id, $categoryIds)) selected
                                                    @endif >{{str_repeat(' --- ', $category->depth)}}{{$category->name}}</option>
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
                                <label class="control-label col-lg-3">{{__('blog.status')}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <label class="checkbox-inline checkbox-switch">
                                        <input type="checkbox" name="status" @if($blog->status) checked
                                               @endif value="1" class="switch">
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="control-label col-lg-3">{{__('blog.thumb')}}</label>
                            <div class="col-lg-9">
                                <input type="file" name="thumb" class="file-styled">
                                <p class="help-block">
                                    {{$blog->thumb}}
                                </p>
                            </div>
                        </div>
                            <!-- /inline switch group -->
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-lg-3">{{__('blog.description')}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="content" required
                                              class="summernote">{{$blog->description}}</textarea>
                                </div>
                            </div>
                        </div>
 


                    </div>
                </div>
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
            $('.select2').select2({
                width: '100%'
            });
 
            // Initialize
            var validator = $(".form-validate-jquery").validate();
        });

    </script>
@endsection

