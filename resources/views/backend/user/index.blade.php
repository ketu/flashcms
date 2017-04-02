@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('user.create')}}"
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
                <th>{{__('user.name')}}</th>
                <th>{{__('user.email')}}</th>
                <th>{{__('user.nickname')}}</th>
                <th>{{__('user.created_at')}}</th>
                <th>{{__('user.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->nickname}}</td>
                    <td>{{$user->created_at}}</td>
                    <td><span class="label label-success">{{$user->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">

                            <li><a href="{{route('user.edit', ['id'=> $user->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('user.delete', ['id'=> $user->id])}}" class="confirm-delete-action"> <i
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