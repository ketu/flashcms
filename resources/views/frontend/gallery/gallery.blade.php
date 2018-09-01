@extends('frontend.layout')
@section('title'){{$gallery->name}}@stop
@section('content')
<div class="row">

					<div class="col-md-10">

						<div class="simplebar-container">
							<h1 class="title">{{$gallery->name}}</h1>
							<div class="gallery">
													
							@foreach($gallery->images as $image)      
								<div class="col-lg-3 col-md-4 col-xs-6">
									<a href="/{{$image->link}}" data-fancybox="gallery" data-caption="{{$image->name}}">
										<img class="img-fluid img-thumbnail" src="/{{$image->link}}" alt="">
									</a>
									<p>{{$image->name}}</p>
								</div>
								@endforeach
								 
							</div>
						</div>
					</div>
				</div>

@endsection
@section('footer.scripts.extra')
<script>
		$(document).ready(function () {
			$.backstretch("{{asset('assets/img/bg/gallery.png')}}");
			const ps = new PerfectScrollbar('.simplebar-container', {});
		});
	</script>
	@stop