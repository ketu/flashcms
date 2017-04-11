@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('menu.item.create', ['menuId'=> $menu->id])}}"
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
                <th>{{__('menu.item.id')}}</th>
                <th>{{__('menu.item.name')}}</th>
                <th>{{__('menu.item.parent')}}</th>
                <th>{{__('menu.item.created_at')}}</th>
                <th>{{__('menu.item.updated_at')}}</th>
                <th>{{__('menu.item.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{str_repeat('---', $item->depth)}} {{$item->name}}</td>
                    <td>{{$item->parent?$item->parent->name:""}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td><span class="label label-success">{{$item->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('menu.item.edit', ['id'=> $item->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('menu.item.delete', ['id'=> $item->id])}}" class="confirm-delete-action"> <i
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