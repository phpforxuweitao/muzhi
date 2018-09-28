<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" id="csrftoken" content="{{csrf_token()}}">
    <title>会员注册_木知网</title>
    <meta name="keywords" content="会员注册" />
    <meta name="description" content="木知网会员注册" />
    <link href="/static/home/register/static/css/reg_1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/static/home/register/bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/home/register/static/css/mycss1.css">
    <link rel="stylesheet" type="text/css" href="/static/home/register/mycss/mycss.css">
    <link rel="stylesheet" type="text/css" href="static/home/index/mycss/iconfont.css">
    <script type="text/javascript" src="/static/home/register/static/js/jquery-3.1.1.js"></script>
    <style type="text/css">
        .wawa{
            top: -10px;
            left: -50px;
        }
        .tupian{
            z-index:50;
        }
        .regNew_top{
            z-index: 50;
        }
    </style>
</head>

<body>

<div class="regNew_top" style="height: 80px; line-height: 80px;">
    <div class="reg_topCon tupian">
        <a href="/">
            <img style="height: 60px;" src="/static/home/index/images/logo2.png" class="logo2">
        </a>
        <div class="clock">
            <img src="/static/home/register/img/aa.png" width="100px" class="wawa">
        </div>
        <div class="regNew_enter" style="display: none;">
            <a href="/login">登录</a> <a href="/reg">注册</a>
        </div>
    </div>
</div>
<!-- <button class="btn btn-success btn-lg btn-block" type="button">Block level button</button> -->
<div style="clear:both"></div>

<div class="reg_main">
    <div class=" col-md-2">
    </div>
    <div class=" reg_border col-md-8">
        <section class="panel">
            <header class="panel-heading htt">
                <h4>账号注册</h4>
            </header>
            <div class="col-md-1 "></div>
            <div class="panel-body col-md-10 ht">
                <form class="form-horizontal" id="fm_reg">
                    <div class="form-group ">
                        <label class="col-lg-2 control-label">账号</label>
                        <div class="col-lg-7">
                            <input type="text" id="f_name" class="form-control" name="name" placeholder="建议用拼音名字/QQ号"/>
                        </div>
                        <span class="col-lo-3 hide">账号名不符合规则密码错误为啥啊</span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">密码</label>
                        <div class="col-lg-7">
                            <input type="password" placeholder="设置密码（6-16位字符）" id="pass" class="form-control" name="pass">
                        </div>
                        <span  class="col-lo-3 hide">账号名不符合规则密码错误为啥啊</span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">确认密码</label>
                        <div class="col-lg-7">
                            <input type="password" placeholder="请重复上面密码" id="repass" class="form-control" name="repass">
                        </div>
                        <span  class="col-lo-3 hide">账号名不符合规则密码错误为啥啊</span>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 control-label">笔名/昵称</label>
                        <div class="col-lg-7">
                            <input type="text"  placeholder="笔名站内昵称仅允许汉字" id="f_nickname" autocomplete="off" class="form-control" onkeyup="value=value.replace(/[^\u4E00-\u9FA5]/g,'')" onpaste="value=value.replace(/[^\u4E00-\u9FA5]/g,'')" oncontextmenu="value=value.replace(/[^\u4E00-\u9FA5]/g,'')" name="nickname">
                        </div>
                        <span  class="col-lo-3 hide">账号名不符合规则密码错误为啥啊</span>
                    </div>
                    <div class="form-group ">
                        <label class="col-lg-2 control-label">邮箱</label>
                        <div class="col-lg-7">
                            <input type="text" vchecked="false" placeholder="请填写您的邮箱" id="f_email" class="form-control" name="email">
                        </div>
                        <span  class="col-lo-3 hide">账号名不符合规则密码错误为啥啊</span>
                    </div>
                    <div class="info_tip">点击“立即注册”,即表示您同意并愿意遵守<a href="javascript:void(0)" id='xieyi'>《用户协议》</a></div>
                    <div class="form-group text-center" style="text-align: center;">
                        <div class="col-lg-8 ">
                            <button class="reg_btn" id="reg_save" type="submit">立即注册</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <div class=" col-md-2 tupian">
        <img src="/static/home/register/img/6.jpg" width="150px" class='yay'>
    </div>
    <script type="text/javascript">
        $(function(){
             $fm_reg = $("#fm_reg");
             $f_name = $("#f_name");
             $f_pass = $("#pass");
             $f_repass = $("#repass");
             $f_nickname = $("#f_nickname");
             $f_email       = $("#f_email");
             $f_reg_save    = $("#reg_save");

            $fm_reg.find('input').keydown(function(event){
                if (event.keyCode === 13) {
                    event.preventDefault ? event.preventDefault() : event.returnValue = false;
                }
            }); //禁用form表单下所有input的回车提交表单事件

            $f_name.blur(function(){    //检测帐号
                that = $(this);
                if ( !$(this).val().length ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('帐号不能为空');
                    return false;
                }
                $.ajax({
                    url:'/regCheckName',
                    method:'post',
                    dataType:'json',
                    contentType:'application/x-www-form-urlencoded',
                    data:{
                        'name':$(this).val()
                    },
                    success:function(res){
                        if (res.code === '000') {
                            that.parent().next('span').removeClass('hide').css({'color':'green'}).text(res.msg);
                        } else {
                            that.parent().next('span').removeClass('hide').css({'color':'red'}).text(res.msg);
                        }
                    },error:function(err){
                        console.log('网络错误');
                    },beforeSend:function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}')
                    }
                });
            });
            $f_nickname.blur(function(){    //检测笔名/妮称
                that = $(this);
                if ( !$(this).val().length ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('笔名/妮称 不能为空');
                    return false;
                }
                $.ajax({
                    url:'/regCheckNickname',
                    method:'post',
                    dataType:'json',
                    contentType:'application/x-www-form-urlencoded',
                    data:{
                        'nickname':that.val()
                    },
                    success:function(res){
                        if (res.code === '000') {
                            that.parent().next('span').removeClass('hide').css({'color':'green'}).text(res.msg);
                        } else {
                            that.parent().next('span').removeClass('hide').css({'color':'red'}).text(res.msg);
                        }
                    },error:function(err){
                        console.log('网络错误');
                    },beforeSend:function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}')
                    }
                });
            });
            $f_pass.blur(function(){
                if ( $(this).val().length < 6 || $(this).val().length > 16 ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('密码必须为6-16位');
                    return false;
                }
                $(this).parent().next('span').removeClass('hide').css({'color':'green'}).text('密码正确');
            });
            $f_repass.blur(function(){
                if ( $(this).val().length < 6 || $(this).val().length > 16 ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('密码必须为6-16位');
                    return false;
                } else if( $f_pass.val() !== $f_repass.val() ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('密码与确认密码不一致');
                    return false;
                }
                $(this).parent().next('span').removeClass('hide').css({'color':'green'}).text('确认密码一致');
            });
            $f_email.blur(function(){
                that = $(this);
                that_val = that.val();
                reg_email = /^\w+@\w+(\.\w+){1,3}$/;
                if ( !that_val.length ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('邮箱不能为空');
                    return false;
                } else if ( !reg_email.test(that_val) ) {
                    $(this).parent().next('span').removeClass('hide').css({'color':'red'}).text('邮箱格式错误');
                    return false;
                }
                $(this).parent().next('span').removeClass('hide').css({'color':'green'}).text('');
                $(this).attr('vchecked','true');
                $.ajax({
                    url:'/regCheckEmail',
                    method:'post',
                    dataType:'json',
                    contentType:'application/x-www-form-urlencoded',
                    data:{
                        'email':that_val
                    },
                    success:function(res){
                        if (res.code === '000') {
                            that.parent().next('span').removeClass('hide').css({'color':'green'}).text(res.msg);
                        } else {
                            that.parent().next('span').removeClass('hide').css({'color':'red'}).text(res.msg);
                        }
                    },error:function(err){
                        console.log('网络错误');
                    },beforeSend:function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}')
                    }
                });
            });

            $fm_reg.submit(function(ev){
                $reg_data = $(this).serialize();
                $.ajax({
                    url: '/register_check',
                    method: 'post',
                    contentType:'application/x-www-form-urlencoded',
                    dataType:'json',
                    data:$reg_data,
                    success:function(res){
                        if ( res.code === '000' ) { //注册成功
                            $("#modal_reg").find('.reg_body').text(res.msg);
                            $("#modal_reg").removeClass('reg_hide');
                            setInterval(function(){
                                $("#modal_reg>.reg>i").trigger('click');
                                window.location.href='/';
                            },3000);
                        } else {
                            $f_reg_save.removeAttr('disabled','true').css({'cursor':'pointer'});
                            $("#modal_reg").find('.reg_body').text(res.msg);
                            $("#modal_reg").removeClass('reg_hide');
                            setInterval(function(){
                                $("#modal_reg>.reg>i").trigger('click');
                            },3000);
                        }
                        console.log(res);
                    },error:function(err) {
                        console.log('网络错误');
                    },beforeSend:function(xhr){
                        if ( !$f_name.val().length || !$f_pass.val().length || !$f_repass.val().length || !$f_nickname.val().length || !$f_email.val().length ) {
                            return false;
                        }
                        $f_reg_save.attr('disabled','true').css({'cursor':'not-allowed'});
                        xhr.setRequestHeader('X-CSRF-TOKEN',$("#csrftoken").attr('content'));
                    }
                });
                ev.preventDefault();    //阻止表单的默认跳转
            });
        });
    </script>
</div>
{{--注册提示模态框--}}
<div id="modal_reg" class="reg_hide">
    <div class="reg">
        <i class="iconfont icon-guanbi"></i>
        <div class="reg_head">注册提示</div>
        <div class="reg_body">内容</div>
    </div>
</div>
{{--注册提示模态框 结束--}}
{{--协议 模态框--}}
<div class="motai">
    <div class="gonggao">
        <h2 id="notitle">本站协议</h2>
        <p id="nocontent">&nbsp;&nbsp;&nbsp;&nbsp;大哥们，我现在要说的呢！！！很重要，关于用户协议呢，只要你们不犯法怎么舒服怎么来，大佬们高兴就好。。。当然本站最终解释权归老子所有...<br>PS：有什么得罪的地方你，请找我老大</p>
        <div id="notiem">
            伟大的站长致<br>
            2018/09/03
        </div>
        <button class="g-but">确定</button>
        <i class="iconfont icon-guanbi"></i>
    </div>
</div>
{{--协议 模态框结束--}}
<div class="reg_footer">
    <div class="reg_bqsm">Copyright © 2018</div>
</div>
<script>
    //点击协议显示协议模态框
    $('#xieyi').click(function(){
        // $('#notitle').html('本站协议');
        $('.motai').css('display','block');
    });
    // 公告框隐藏
    $('.icon-guanbi,.g-but').click(function(){
        $('.motai').css('display','none');
    });

    //关闭注册提示信息模态框
    $("#modal_reg>.reg>i").click(function(){
        $(this).parents("#modal_reg").addClass('reg_hide');
    });
</script>
</body>
</html>
