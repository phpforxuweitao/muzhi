@extends('home.PersonPublic.index')
@section('title','站内信') 
@section('container')
<div class="ab_right">
<div class="shop-nav2">
    <a href="/ps_letter/in" class="selected">
   		<span>收件箱</span>
    </a>
    <a href="/ps_letter/out">
    	<span>发件箱</span>
    </a>
</div>
<ul class="znx_list">
    <form action="" method="post" name="form1">
        <input name="dopost" value="del" type="hidden">
        @foreach($data as $v)
        <li>
        	<div class="znx_info">
        	<a><img src="{{$v->uface}}"></a>
        	<span>
        		<a class="znx_name" href="/ps_space/{{$v->from_uid}}" target="_blank">{{$v->nickname}}</a> 
        		{{date('Y-m-d H:i:s',$v->created_at)}} 
        		<a href="/ps_letter/send/{{$v->from_uid}}">[回复TA]</a>
            </span>
          	<!-- <input class="fxk" name="deleteid" value="705" type="checkbox" -->>
                <a class="fxk" href="/ps_letter/del/{{$v->id}}">删除</a>
        	</div>
        	<div style="clear:both"></div>
        	<div class="znx_other">{{$v->content}}</div>
      	</li>
      	@endforeach
        
    </form>
</ul>
<div class="article_pages">
	<span>
		{{$data->render()}}
	</span> 
</div>
</div>
@endsection
