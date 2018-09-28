@extends('home.PersonPublic.index')
@section('title','修改信息')
@section('container')
<div class="ab_right">
  <form name="form2" action="/ps_msg/doedit" method="post" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <div class="shop-nav"><a>修改信息</a></div>
    <dl class="editInfoPhone">
      <input name="dopost" value="save" type="hidden">
      <dt>基本信息</dt>
      <dd style="height: 150px;">
        <img src="{{$data->uface}}" id="img0" alt="" style="width: 100px;height: 100px;border-radius: 100px">
        <input type="file" id="file0" name="pic" style="position: relative;top: 30px;left: -100px">
      </dd>
      <dd style="clear: both">帐号：<span>&nbsp;{{$data->name}}</span></dd>
      <dd>
        笔名：
        <span>
          <input name="nickname" id="uname" value="{{$data->nickname}}" class="intxt" style="width: auto;height: 24px;border-radius: 3px;border:1px solid #ccc;text-indent: 5px;" type="text">
        </span>
      </dd>
      <dd>
        qq：
        <span>
          <input name="qq" id="una" value="{{$data->qq}}" class="intxt" style="width: auto;height: 24px;border-radius: 3px;border:1px solid #ccc;margin-left: 10px;text-indent: 5px;" type="text">
        </span>
      </dd>
      <dd>
        生日：
        <span>
          <input type="date" name="birthday" class="date" value="{{$data->birthday}}" style="width: 130px;height: 24px;border-radius: 3px;border:1px solid #ccc;">
        </span>
      </dd>
      <dd>
        性别：
        <span>
          @if($data->sex == 'm')
          <input name="sex" value="男" type="radio" checked>
          男 &nbsp;
          <input name="sex" value="女" type="radio">
          女
          @elseif($data->sex == 'w')
          <input name="sex" value="男" type="radio">
          男 &nbsp;
          <input name="sex" value="女" type="radio" checked>
          女
          @endif
        </span>
      </dd>
      <dd class="editInfo-btn">
        {{csrf_field()}}
        <input value="保存" class="editPassword-submit" type="submit">
        <input value="取消" class="editPassword-reset" type="reset">
      </dd>
    </dl>
  </form>
</div>
@endsection
