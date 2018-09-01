@extends('backend.layout')

@section('page.button')
    <div class="heading-elements">
        <a href="{{route('product.create')}}"
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

                <th>{{__('product.name')}}</th>
                <th>{{__('product.created_at')}}</th>
                <th>{{__('product.updated_at')}}</th>
                <th>{{__('product.status')}}</th>
                <th class="text-center">{{__('button.action')}}</th>

            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>

                    <td>{{$product->name}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                    <td><span class="label label-success">{{$product->status}}</span></td>
                    <td class="text-center">
                        <ul class="icons-list">
                            <li><a href="{{route('product.edit', ['id'=> $product->id])}}"> <i class="fa fa-edit"></i></a>
                            </li>
                            <li><a href="{{route('product.delete', ['id'=> $product->id])}}" class="confirm-delete-action"> <i
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