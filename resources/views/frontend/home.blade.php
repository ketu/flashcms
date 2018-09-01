@extends('frontend.layout')
@section("loading")	<!-- Preloader -->
	<div id="preloader">
			<div id="status"></div>
		</div>
 @stop
@section('content')
<div class="row">
				 

<div class="col-md-1 col-xs-2" style="overflow:hidden">				
	<i class="far fa-square" style="    font-size: 140px;    color: #fff;    margin-top: 17px;"></i></div>
					<div class="col-md-8 col-xs-10">
	

 {{Block::show("home-center")}}
						<!-- <p class="home-info">
							为全球行业顶尖客户<br>
							<br>
							<br>
							提供洁净服务支持
						</p>
						<p class="home-sub-info">
							专研洁净系统工程10余年
						</p> -->
					</div>
				</div>

@endsection
@section('footer.scripts.extra')
	<script>
		$(document).ready(function () {
			$.backstretch("{{asset('assets/img/bg/index.png')}}");
		});
	</script>
@stop