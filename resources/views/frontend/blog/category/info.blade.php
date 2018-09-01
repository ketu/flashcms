@extends('frontend.layout')
@section('title'){{$category->name}}@stop
@section('content')
<div class="row">

					<div class="col-md-10">



						<div class="simplebar-container">
							<div class="row">
								<div class="col-md-12">
									<h1 class="title">{{$category->name}}</h1>
								</div>

							</div>

							
							<div class="row">
								<div class="col-md-12">

									<ul class="list-unstyled">
										
									@foreach($category->blogs as $blog)       
									@if ($loop->first)
									<li>
									<div class="hot-news clearfix">
								<div class="col-md-5">
									<a href="javascript:void(0)" data-fancybox data-type="iframe" data-src="{{route('frontend.blog.info', ['blogId'=> $blog->id])}}">
										<img class="img-fluid img-thumbnail" src="/{{$blog->thumb}}" alt="">
									</a>
								</div>
								<div class="col-md-7">
									<h5>
									<a href="javascript:void(0)" data-fancybox data-type="iframe" data-src="{{route('frontend.blog.info', ['blogId'=> $blog->id])}}">{!! str_limit(strip_tags($blog->name), $limit = 20, $end = '...') !!}</a>
									<span class="small"><!--{{$blog->created_at}}--></span>
									</h3>
									{!! str_limit(strip_tags($blog->description), $limit = 50, $end = '...') !!}
				 
								</div>
							</div>
									</li>
									@else
										<li>
											<a href="javascript:void(0)" data-fancybox data-type="iframe" data-src="{{route('frontend.blog.info', ['blogId'=> $blog->id])}}"> >> {{$blog->name}}</a>
										</li>		
									@endif
																											
            						@endforeach

									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

@endsection
@section('footer.scripts.extra')
<script>
		$(document).ready(function () {
			$.backstretch("{{asset('assets/img/bg/page.png')}}");
			const ps = new PerfectScrollbar('.simplebar-container', {
			});
		});
	</script>
	@stop