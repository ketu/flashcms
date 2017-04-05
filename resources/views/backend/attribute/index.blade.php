@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('attribute.create')}}"
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
                <th>{{__('attribute.code')}}</th>
                <th>{{__('attribute.name')}}</th>
                <th>{{__('attribute.created_at')}}</th>
                <th>{{__('attribute.updated_at')}}</th>
                <th>{{__('attribute.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($attributes as $attribute)
                <tr>
                    <td>{{$attribute->id}}</td>
                    <td>{{$attribute->code}}</td>
                    <td>{{$attribute->name}}</td>
                    <td>{{$attribute->created_at}}</td>
                    <td>{{$attribute->updated_at}}</td>
                    <td><span class="label label-success">{{$attribute->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('attribute.edit', ['id'=> $attribute->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('attribute.delete', ['id'=> $attribute->id])}}" class="confirm-delete-action"> <i
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