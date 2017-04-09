@extends('backend.layout')

@section('content')
    <!-- Form validation -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal form-validate-jquery" method="POST" action="{{route('product.update')}}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$product->id}}">
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
                                           value="{{$product->name}}"
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
                                           value="{{$product->slug}}"
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
                                           value="{{$product->sku}}"
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
                                <label class="control-label col-lg-3">{{__('product.status')}}<span
                                            class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <label class="checkbox-inline checkbox-switch">
                                        <input type="checkbox" name="status" @if($product->status) checked
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
                                              class="summernote">{{$product->description}}</textarea>
                                </div>

                            </div>


                        </div>

                        <div class="tab-pane" id="attribute">
                            Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid
                            laeggin.
                        </div>
                        <div class="tab-pane" id="gallery">
                            <!-- Removable thumbnails -->
                            <div action="{{route('product.gallery.upload', ['id'=> $product->id])}}" class="dropzone" id="uploader"></div>
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
        var storage = Storages.localStorage;


        var uploadedImages = '{!! $uploadedImages !!}';
        Dropzone.options.uploader = {
            paramName: "file", // The name that will be used to transfer the file
            dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
            maxFilesize: 3, // MB
            addRemoveLinks: true,
            acceptedFiles: 'image/*',
            autoProcessQueue:true,
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            init: function () {
                var uploader = this;

                if (uploadedImages) {

                    uploadedImages = $.parseJSON(uploadedImages);



                    $.each(uploadedImages, function (i, f) {
                        $.ajax({
                            //dataType:'blob',
                            type:'GET',
                            url:f.url
                        }).done(function(blob){
                            var file = new File([blob], f.name, {type:f.mimeType});
                            file.status=Dropzone.SUCCESS;


                            file.uploaded = {
                                path: f.path,
                                url: f.url
                            };

                            uploader.emit("addedfile", file);
                            // And optionally show the thumbnail of the file:

                            uploader.emit("thumbnail", file, f.url);
                            uploader.emit("success", file);
                            uploader.emit("complete", file);
                            uploader.files.push(file);
                        });
                    });


                } else {
                    var galleryQueue = storage.get('productGalleryQueue');
                    if (galleryQueue !== null) {
                        $.each(galleryQueue, function (i, f){
                            var blob = dataURItoBlob(f.url);
                            var file = new File([blob], f.name, {type:f.type});
                            // Call the default addedfile event handler
                            uploader.emit("addedfile", file);
                            // And optionally show the thumbnail of the file:
                            uploader.emit("thumbnail", file, f.url);
                            uploader.files.push(file);
                            uploader.uploadFile(file);
                        } );
                        storage.set('productGalleryQueue', null);
                    }
                }
                this.on('success', function (file, resp) {


                    if (typeof resp == 'undefined') {
                        return true;
                    }


                    $(file.previewElement).append($('<input>').attr('type', 'hidden').attr('name', 'gallery[]').val(resp.path));

                    file.uploaded = {
                        path: resp.path,
                        url: resp.url
                    };
                });

                this.on('removedfile', function (file){

                    if (file.uploaded != 'undefined') {
                        $.ajax({
                            method: 'POST',
                            url:'{{route('product.gallery.delete', ['id'=> $product->id])}}',
                            data: {
                                path: file.uploaded.path
                            },
                            headers:{
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            }
                        });
                    }

                });




            }
        };
        $(document).ready(function () {
            $('.select2').select2();
            // Initialize
            var validator = $(".form-validate-jquery").validate();
        });

    </script>
@endsection

