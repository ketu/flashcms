@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('gallery.create')}}"
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
                <th>ID</th>

                <th>{{__('gallery.name')}}</th>
                <th>{{__('gallery.created_at')}}</th>
                <th>{{__('gallery.updated_at')}}</th>
                <th>{{__('gallery.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($galleries as $gallery)
                <tr>
                    <td>{{$gallery->id}}</td>

                    <td>{{$gallery->name}}</td>
                    <td>{{$gallery->created_at}}</td>
                    <td>{{$gallery->updated_at}}</td>
                    <td><span class="label label-success">{{$gallery->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                        <li><a href="{{route('gallery.image', ['galleryId'=> $gallery->id])}}"> <i class="fa fa-male"></i></a>
                            </li>

                            <li><a href="{{route('gallery.edit', ['id'=> $gallery->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('gallery.delete', ['id'=> $gallery->id])}}" class="confirm-delete-action"> <i
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