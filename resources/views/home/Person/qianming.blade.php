@extends('home.PersonPublic.index')
@section('title','个性签名') 
@section('container')
  <div class="ab_right">
    <div class="shop-nav"><a>个性签名</a></div>
    <div class="add_con">
      <form action="/ps_qianming/doadd" method="post" enctype="multipart/form-data" name="form1">
        <input name="dopost" value="save" type="hidden">
        <input name="pagesize" id="pagesize" value="10" maxlength="100" class="linput" type="hidden">
        <textarea name="sign" id="sign" cols="85" rows="5" class="ltextarea" placeholder="请输入您的个性签名"></textarea><br><br>
        {{csrf_field()}}
        <button class="editPassword-submit" id="btn" type="submit">更新</button>
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p><img src="/static/home/person/images/qianming.jpg" width="682" height="231"></p>
    </div>
  </div>
@endsection

