@extends('backend.layout')

@section('content')


    <!-- Whole row as a control -->
    <div class="panel panel-flat">

        <table class="table datatable-responsive">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Created At</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
            <tr>
                <td>{{$page->id}}</td>
                <td>{{$page->name}}</td>
                <td><a href="#">{{$page->slug}}</a></td>
                <td>{{$page->created_at}}</td>
                <td><span class="label label-success">{{$page->status}}</span></td>
                <td class="text-center">
                    <ul class="icons-list">

                        <li><a href="{{route('cms.page.edit', ['id'=> $page->id])}}"> <i class="fa fa-edit"></i></a></li>
                        <li><a href="#" class="confirm-delete-action"> <i class="fa fa-remove"></i></a></li>

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