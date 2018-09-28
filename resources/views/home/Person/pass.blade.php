@extends('home.PersonPublic.index')
@section('title','修改密码')
@section('container')
<div class="ab_right">
  <form name="form2" action="/ps_pass/doedit" method="post" onsubmit="return checkSubmit();" enctype="multipart/form-data">
    <div class="shop-nav"><a>修改密码</a></div>
    <dl class="editInfo">
      <dt>修改密码</dt>
      <dd>
        <input name="pass" class="password" title="密码" type="password">
        <span class="pass-value">密码</span>
      </dd>
      <dd>
        <input name="repass" class="passconf" title="确认密码" type="password">
        <span class="pass-value">确认密码</span>
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
