@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('template.create')}}"
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
                <th>{{__('product.template.name')}}</th>
                <th>{{__('product.template.created_at')}}</th>
                <th>{{__('product.template.updated_at')}}</th>
                <th class="text-center">{{__('button.action')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($templates as $template)
                <tr>
                    <td>{{$template->id}}</td>
                    <td>{{$template->name}}</td>
                    <td>{{$template->created_at}}</td>
                    <td>{{$template->updated_at}}</td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('template.edit', ['id'=> $template->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('template.delete', ['id'=> $template->id])}}" class="confirm-delete-action"> <i
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