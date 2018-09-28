@extends('home.PersonPublic.index')
@section('title','站内信') 
@section('container') 
<div class="ab_right"> 
	<div class="shop-nav2">
		<a href="/ps_letter/in"><span>收件箱</span></a>
		<a href="/ps_letter/out" class="selected"><span>发件箱</span></a>
	</div> 
	<ul class="znx_list"> 
		 	
			@foreach($data as $v)
			<li> 
				<div class="znx_info">
					<a><img src="{{$v->uface}}" /></a>
					<span> 
						<a class="znx_name" href="/ps_space/{{$v->to_uid}}" target="_blank">{{$v->nickname}}</a>(收件人) {{date('Y-m-d H:i:s',$v->created_at)}} 
					</span> 
					<!-- <input type="checkbox" class="fxk" name="deleteid" value="{{$v->to_uid}}" />  -->
					<a class="fxk" href="/ps_letter/del/{{$v->id}}">删除</a>
				</div> 
				<div style="clear:both"></div> 
				<div class="znx_other">
					{{$v->content}}
				</div> 
			</li> 
			@endforeach
			 
		
	</ul> 
	<div class="article_pages"> 
		<span>
			{{$data->render()}}
		</span> 
	</div> 
</div> 

@endsection
