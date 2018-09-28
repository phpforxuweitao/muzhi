@include('home.PersonPublic.header')

<link rel="stylesheet" type="text/css" href="/static/home/person/css/user.css">
<link rel="stylesheet" type="text/css" href="/static/home/person/css/riji.css">
<!-- 文章 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/article.css">
<!-- 签名 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/qianming.css">
<!-- 积分 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/jifen.css">
<!-- 粉丝 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/fensi.css">
<!-- 发件箱收件箱 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/fajianxiang.css">
<!-- 关注 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/guanzhu.css">
<!-- 发送信件 -->
<link rel="stylesheet" type="text/css" href="/static/home/person/css/send.css">
<link rel="stylesheet" type="text/css" href="/static/home/person/css/iconfont.css">


<script type="text/javascript" src="/static/home/person/js/jquery-1.js"></script>
<script type="text/javascript" src="/static/home/person/js/box.js"></script>
<!-- <script type="text/javascript" language="javascript" src="/static/home/person/js/j.js"></script> -->
<script type="text/javascript" language="javascript" src="/static/home/person/js/table_function.js"></script>
<script type="text/javascript" src="/static/home/person/js/dedeajax2.js"></script>
<!-- <script type="text/javascript" src="/static/home/person/js/ajaxpage.js"></script> -->
<script language="javascript" src="/static/home/person/js/main.js"></script>
<script language="javascript" src="/static/home/person/js/article_htm.js"></script>
<script language="javascript" src="/static/home/person/js/msgbox.js"></script>
<script language="javascript" src="/static/home/person/js/dropdownlist.js"></script>
<!-- 站内信 -->
<script language="javascript" src="/static/home/person/js/fajianxiang.js"></script>
<!-- 个性签名 -->
<script language="javascript" src="/static/home/person/js/qianming.js"></script>
<!-- 日记投稿 -->
<script language="javascript" src="/static/home/person/js/riji.js"></script>
<!-- 我的文章 -->
<script language="javascript" src="/static/home/person/js/wenzhang.js"></script>
<!-- <script src="/static/admin/js/bootstrap.min.js"></script> -->
<script src="/static/admin/js/modernizr.min.js"></script>
<script src="/static/home/index/js/jquery.leanModal.min.js" type="text/javascript"></script>
<!--百度编辑器配置文件-->
<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.config.js"></script>
<!--编辑器源码文件-->
<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.all.js"> </script>
<!--uparse-->
<script type="text/javascript" charset="utf-8" src="/static/ueditor/ueditor.parse.min.js"></script>
<!--设置语言类型-->
<script type="text/javascript" charset="utf-8" src="/static/ueditor/lang/zh-cn/zh-cn.js"></script>

<style>
  .ps_logo2{
    margin-top:-5px;
    width: 80%;
  }
</style>
</head>
<body>

<div class="header_view">
  <div class="header_top_view">
	<div class="islogin"> <a href="#"></a>你好，{{session('home_user')['name']}} ( ID：{{session('home_user')['id']}} )，欢迎回来！ </div>
  </div>
</div>
<div id="rj_header" class="header">
  <div class="w1000 clearfix">
    <div class="fl logo">
      <a href="/"><img src="/static/home/index/images/logo2.png" class="ps_logo2"></a>
    </div>	
  </div>           
</div>

<div id="wrapper" class="clearfix w1000">
  <!-- 左侧导航栏 -->
  @include('home.PersonPublic.menu')
  <!-- 左侧导航栏结束 -->

  <!-- 右侧区域开始 -->
  @section('container')
  @show
  <!-- 右侧区域结束 -->
</div>

  <!-- 成功失败提示框弹出 -->
  @if(session('success'))
  <strong class="a" style="display: none">{{session('success')}}</strong>
  <script>
  a = $('.a').text();
  alert(a);
  </script>
  @endif

  @if(session('error'))
  <strong class="a" style="display: none">{{session('error')}}</strong>
  <script>
  a = $('.a').text();
  alert(a);
  </script>
  @endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
  @foreach ($errors->all() as $error)
      <li class="a" style="display: none">{{ $error }}</li>
  @endforeach
  </div>

  <script>
  a = $('.a').text();
  alert(a);
  </script>
  @endif
  <!-- 成功失败提示框弹出结束 -->
  
</body>
<!-- 图片预览 -->
<script src="/static/admin/js/ads.js"></script>

</html>