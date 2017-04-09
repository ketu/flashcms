@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('product.save')}}">
                {{ csrf_field() }}

                <div class="tabbable">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="active"><a href="#information" data-toggle="tab">{{__('product.information')}} <i
                                        class="fa fa-menu"></i></a></li>
                        <li><a href="#attribute" data-toggle="tab">{{__('product.attribute')}} <i
                                        class="fa fa-menu"></i></a></li>
                        <li><a href="#gallery" data-toggle="tab">{{__('product.gallery')}} <i
                                        class="fa fa-menu"></i></a></li>

                    </ul>

                    <div class="tab-content panel-body">
                        <div class="tab-pane active" id="information">
                            <!-- Input with icons -->
                            <div class="form-group has-feedback">
                                <label class="control-label col-lg-3">{{ __('product.name') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="name" class="form-control" required="required"
                                           value="{{Request::old('name')}}"
                                           placeholder="{{ __('product.name') }}">
                                    @if ($errors->first('name'))
                                        <label id="name-error" class="validation-error-label"
                                               for="name">{{$errors->first('name')}}</label>
                                    @endif

                                </div>
                            </div>
                            <!-- /input with icons -->
                            <!-- Input with icons -->
                            <div class="form-group has-feedback">
                                <label class="control-label col-lg-3">{{ __('product.slug') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="slug" class="form-control" required="required"
                                           value="{{Request::old('slug')}}"
                                           placeholder="{{ __('product.slug') }}">
                                    @if ($errors->first('slug'))
                                        <label id="slug-error" class="validation-error-label"
                                               for="slug">{{$errors->first('slug')}}</label>
                                    @endif

                                </div>
                            </div>
                            <!-- /input with icons -->

                            <!-- Input with icons -->
                            <div class="form-group has-feedback">
                                <label class="control-label col-lg-3">{{ __('product.sku') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="sku" class="form-control" required="required"
                                           value="{{Request::old('sku')}}"
                                           placeholder="{{ __('product.sku') }}">
                                    @if ($errors->first('sku'))
                                        <label id="sku-error" class="validation-error-label"
                                               for="sku">{{$errors->first('sku')}}</label>
                                    @endif

                                </div>
                            </div>
                            <!-- /input with icons -->


                            <!-- Basic text input -->
                            <div class="form-group">
                                <label class="control-label col-lg-3">{{ __('product.categories') }}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select name="categories" multiple class="form-control select2" required
                                            data-placeholder="{{__('button.please_select')}}">

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                    @if(Request::old('parent_id') == $category->id) checked
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
                                <label class="control-label col-lg-3">{{__('product.status')}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <label class="checkbox-inline checkbox-switch">
                                        <input type="checkbox" name="status" @if(Request::old('status')) checked
                                               @endif value="1" class="switch">
                                    </label>
                                </div>
                            </div>
                            <!-- /inline switch group -->
                            <hr>
                            <div class="form-group">
                                <label class="control-label col-lg-3">{{__('product.description')}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="content" required
                                              class="summernote">{{Request::old('description')}}</textarea>
                                </div>

                            </div>


                        </div>

                        <div class="tab-pane" id="attribute">
                            Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid
                            laeggin.
                        </div>
                        <div class="tab-pane" id="gallery">
                            <!-- Removable thumbnails -->
                            <div action="javascript:void(0);" class="dropzone" id="uploader"></div>
                            <!-- /removable thumbnails -->


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
        var galleryQueue = [];
        var storage = Storages.localStorage;
        storage.set('productGalleryQueue', null);
        Dropzone.options.uploader = {
            paramName: "file", // The name that will be used to transfer the file
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize: 3, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            autoProcessQueue:false,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            init: function () {
                this.on('thumbnail', function (file, dataUrl){
                    galleryQueue.push(
                        {
                            url:dataUrl,
                            file:file
                        }
                    );
                });
                this.on('removedfile', function (file) {
                    galleryQueue = galleryQueue.filter(function(el){
                        return file!==el.file;
                    });

                });
            }
        };
        $(document).ready(function () {
            $('.select2').select2();
            // Initialize
            var validator = $(".form-validate-jquery").validate({
                submitHandler: function (form){

                    var addedFiles = [];

                    for(var i = 0; i < galleryQueue.length; i++) {
                        addedFiles.push({
                            url: galleryQueue[i].url,
                            type:  galleryQueue[i].file.type,
                            size: galleryQueue[i].file.size,
                            name:  galleryQueue[i].file.name
                        });
                    }
                    if (addedFiles.length > 0) {
                        storage.set('productGalleryQueue', addedFiles);
                    }

                    form.submit();
                }
            });
        });

    </script>
@endsection

