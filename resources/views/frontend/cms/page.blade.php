@extends('frontend.layout')
@section('title'){{$page->name}}@stop
@section("body.class"){{$page->slug}}@stop
@section('content')
<div class="row">
				 
				 <div class="col-md-10">

	
					  <div data-simplebar class="simplebar-container">
						 <h1 class="title"> {{$page->name}}</h1>
						  {!!$page->content!!}
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