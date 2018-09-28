@extends('home.PersonPublic.index')
@section('title','我的个人中心')
@section('container')
  <div class="ab_right">
    <div class="shop-nav">发送私信</div>
    <form class="sx_form" action="/ps_letter/dosend" method="post" name="form1">
      <input name="to_uid" value="{{$to_uid}}" type="hidden">
      <div class="sx_content">
        <label>信件内容：</label>
        <textarea class="sx_txt" name="content"></textarea>
      </div>
      {{csrf_field()}}
      <button class="sxSub_btn" type="submit">确认发送</button>
    </form>
  </div>
@endsection