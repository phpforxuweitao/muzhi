@extends('home.PersonPublic.index')
@section('title','粉丝关注') 
@section('container')
  <div class="ab_right">
    <div class="shop-nav2">
      <a class="selected">我关注的</a> 
      <a href="/ps_guanzhu/fensi">我的粉丝</a>
    </div>
    <ul class="gz_list">  
      @foreach($data as $v)
      <li>
        <a href="/ps_space/{{$v->uid}}"><img src="{{$v->uface}}" width="60" height="60"></a>
        <div class="gz_info">
          <a href="/ps_space/{{$v->uid}}" target="_blank">{{$v->nickname}}</a>
          <span>
            性别：@if($v->sex == 'm')
                  男
                  @elseif($v->sex == 'w')
                  女
                  @elseif($v->sex == 'x')
                  保密
                  @endif
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            积分：{{$v->fame}}
          </span>
          <a href="/ps_letter/send/{{$v->to_uid}}">发送短信</a>
          <a href="/ps_guanzhu/quxiao/{{$v->to_uid}}">取消关注</a>
        </div>
      </li>
      @endforeach
    </ul>
    <div class="gz_page">   
      <span>
        {{$data->render()}}
      </span>
    </div> 
  </div>
@endsection