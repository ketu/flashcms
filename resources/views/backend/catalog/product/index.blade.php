@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('category.create')}}"
           class="btn btn-labeled btn-labeled-right bg-blue heading-btn">{{__('button.add')}} <b><i
                        class="fa fa-creative-commons"></i></b></a>

        <a href="{{route('category.rebuild')}}"
           class="btn btn-labeled btn-labeled-right bg-blue heading-btn">{{__('button.rebuild')}} <b><i
                        class="fa fa-building"></i></b></a>
    </div>
@endsection
@section('content')


    <!-- Whole row as a control -->
    <div class="panel panel-flat">

        <table class="table datatable-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>{{__('category.parent')}}</th>
                <th>{{__('category.name')}}</th>
                <th>{{__('category.created_at')}}</th>
                <th>{{__('category.updated_at')}}</th>
                <th>{{__('category.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($products as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->parent?$category->parent->name:""}}</td>
                    <td>{{str_repeat('---', $category->depth)}} {{$category->name}}</td>
                    <td>{{$category->created_at}}</td>
                    <td>{{$category->updated_at}}</td>
                    <td><span class="label label-success">{{$category->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('category.edit', ['id'=> $category->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('category.delete', ['id'=> $category->id])}}" class="confirm-delete-action"> <i
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