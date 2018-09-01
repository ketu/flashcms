 
<div class="frame row">

					<div class="col-md-10">
						<div class="simplebar-container-frame">
						<h3 class="title">{{$blog->name}}</h3>

<p class="created-time">发布时间:{{$blog->created_at}}</p>
<hr>

		
{!!$blog->description!!}
						 
</div>
				</div>

				</div>

 

 <style>
	 .frame {padding: 10px 30px; }

 

.frame .title, .frame .created-time {
	text-align:center;
}
	 </style>
 