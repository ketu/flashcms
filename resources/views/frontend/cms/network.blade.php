@extends('frontend.layout')
@section('title'){{$page->name}}@stop
@section("body.class"){{$page->slug}}@stop
@section('content')
<div class="row">
				 

<div class="col-md-1" style="overflow:hidden">				
	<i class="far fa-square" style="    font-size: 140px;    color: #01a3e3;    margin-top: 17px;"></i></div>
					<div class="col-md-10">
	


						<p class="home-info">
							<font color="#01a3e3">布局全球</font><br>
							<br>
							<br>
							面向未来，面向全球的发展战略
						</p>
						<p class="home-sub-info">
						<font color="#01a3e3">同世界，同创新</font>
						</p>
					</div>
				</div>
@endsection
@section('footer.scripts.extra')
<script>
		$(document).ready(function () {
			$.backstretch("{{asset('assets/img/bg/network.png')}}");

			const ps = new PerfectScrollbar('.simplebar-container', {
 
			});
		});
	</script>
	@stop