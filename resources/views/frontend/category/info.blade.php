@extends('frontend.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
           <h1>{{$category->name}}</h1>
            <p>The action camera that made a buzz in digital camera reviews and known as the best budget action camera today. Get your YI 4K action camera, now.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <div class="row">
        <div class="product-grid">
            @foreach($category->products as $product)
        <div class="col-md-3">
            <a href="{{route('frontend.product.info', ["id" => $product->id])}}"><img src="//cdn.shopify.com/s/files/1/1645/3149/products/lADOtzmnIs0CCs0CCg_522_522_250x.jpg?v=1490687263" class="img-responsive" alt="YI 4K+ Action Camera with Waterproof Case"></a>
            <p class="text-center">YI 4K+ Action Camera with Waterproof Case</p>
            <div class="price">
                <span>$999.99</span>
                <del>$199.99</del>
            </div>
        </div>
                @endforeach
        </div>
    </div>

@endsection
