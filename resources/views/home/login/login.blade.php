<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员登录_木知网</title>
    <meta name="keywords" content="会员登录" />
    <meta name="description" content="木知网会员登录" />
    <link href="/static/home/login/css/reg.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/static/home/login/js/qqlogin.js"></script>
    <style type="text/css">
        .login_left{ width:450px; height:360px; float:left;}
        .login_right{ width:310px;height:360px; float:right; overflow:hidden;}
        .loginItem {height: 46px;margin-bottom:16px;width: 100%;clear:both; color:#5a5a5a}
        .loginItem label {float: left;line-height: 40px;width: 85px;display: block; font-size:15px; text-align:right;}
        .loginInput_text{float:left; margin-left:12px;width: 260px;height: 20px;padding: 10px 10px 10px 14px;border-radius: 1px;border: 1px solid #AFCBAD;font-size: 14px;line-height: 20px;outline: 0;font-family:'microsoft yahei';}
        .login_tip{ padding:10px 65px 16px 58px; overflow:hidden;}
        .fl{ float:left;}
        .fr{ float:right;}
        .tip1{line-height: 20px; font-size:13px;color: #666;}
        .checkbox {margin-right: 5px;vertical-align: middle;}
        .fr a {color: #55c447;font-size: 14px;padding: 0 3px;}
        .fr a:hover{ color:#FF6625;}
        .login_btn{display: block;width:76%; margin:0px auto; margin-top:15px;height: 38px;background-color: #44b336;border: 0;border-radius: 3px;color: #fff;font-size: 18px;line-height: 38px;text-align: center;outline: 0;cursor: pointer;font-family:'microsoft yahei';}
        .login_btn:hover{background-color: #55c447;}
        .login_foot{ margin-top:200px;}
    </style>
</head>
<body>
<div class="regNew_top">
    <div class="reg_topCon">
        <div class="logo"></div>
        <div class="regNew_enter">
            <a href="/login">登录</a> <a href="/reg">注册</a>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div class="reg_main" style="margin-top:150px">
    <div class="login_left reg_border">
        <div class="reg_head" style="margin-bottom:40px"><span>会员登录</span></div>
        <form action="/login_check/" id="regUser" method="post">
            <input type="hidden" name="fmdo" value="login">
            <input type="hidden" name="dopost" value="login">
            <input type="hidden" name="gourl" value="">
            <div class="loginItem">
                <label>账号</label>
                <input class="loginInput_text" name="userid" type="text">
            </div>
            <div class="loginItem">
                <label>密码</label>
                <input class="loginInput_text" name="pwd" type="text">
            </div>
            <div class="login_tip">
      	<span class="fl tip1">
          <input name="auto_login" type="checkbox" class="checkbox" value="30" >
          下次自动登录
        </span>
                <span class="fr"><a href="/user/reg">立即注册</a></span>
            </div>
            <button class="login_btn" type="submit">登 录</button>
        </form>
    </div>
    <div class="login_right reg_border">
        <div class="reg_rightHead"><span>第三方账号一键登录</span></div>
        <div class="login_kind">
            <a href="javascript:void(0);"><!--onclick="QQLogin();"-->
                <img src="/static/home/login/picture/qq.png" title="qq一键登录" alt="qq一键登录"/>
            </a>
            <a>
                <img src="/static/home/login/picture/wx.png" title="微信登录(暂未开放)" alt="微信一键登录"/>
            </a>
        </div>

    </div>
</div>
<div class="reg_footer login_foot">
    <div class="reg_bqsm">Copyright © 2018 All Rights Reserved</div>
</div>
</body>
</html>

