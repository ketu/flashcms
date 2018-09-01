@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('gallery.image.create', ['galleryId'=> $gallery->id])}}"
           class="btn btn-labeled btn-labeled-right bg-blue heading-btn">{{__('button.add')}} <b><i
                        class="fa fa-creative-commons"></i></b></a>
    </div>
@endsection
@section('content')


    <!-- Whole row as a control -->
    <div class="panel panel-flat">

        <table class="table datatable-responsive">
            <thead>
            <tr>
 
                <th>{{__('gallery.image.name')}}</th>
  
                <th>{{__('gallery.image.link')}}</th>
                <th>{{__('gallery.image.sort_order')}}</th>
 
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($images as $image)
                <tr>
               
                    <td>{{$image->name}}</td>
                    <td><img width="100" height="100" src="/{{$image->link}}"></td>
                    <td>{{$image->sort_order}}</td>
             

                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('gallery.image.edit', ['id'=> $image->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('gallery.image.delete', ['id'=> $image->id])}}" class="confirm-delete-action"> <i
                                            class="fa fa-remove"></i></a></li>
                        </ul>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /whole row as a control -->

@endsection

@section('footer.scripts')
    @parent
    <script>

        // Basic responsive configuration
        $('.datatable-responsive').DataTable({
            responsive: {
                details: {
                    type: 'column'
                }
            },
            columnDefs: [
                {
                    searchable: false,
                    targets: 0
                }
            ],
            order: [0, 'DESC']
        });
    </script>
@endsection