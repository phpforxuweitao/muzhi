<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" id="csrftoken" content="{{ csrf_token() }}">
    <title>修改密码_木知网</title>
    <meta name="keywords" content="修改密码" />
    <meta name="description" content="木知网会员修改密码" />
    <link href="/static/home/register/static/css/reg_1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/static/home/register/bs/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/static/home/register/static/css/mycss1.css">
    <link rel="stylesheet" type="text/css" href="/static/home/register/mycss/mycss.css">
    <script type="text/javascript" src="/static/home/register/static/js/jquery-3.1.1.js"></script>
    <style type="text/css">
        .wawa{
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
<div class="regNew_top">
    <div class="reg_topCon tupian">
        <a href="/">
            <div class="logo" style="z-index: 50"></div>
        </a>
        <div class="clock">
            <img src="/static/home/register/img/aa.png" width="100px" class="wawa">
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
                <h4>修改密码</h4>
            </header>
            <div class="col-md-1 "></div>
            <div class="panel-body col-md-10 ht">
                <form class="form-horizontal" id="fm_savechangepwd">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">密码</label>
                        <div class="col-lg-7">
                            <input type="password" autocomplete="off" placeholder="请输入修改密码..." id="f_pass" class="form-control" name="pass">
                        </div>
                        <span  class="col-lo-3 hide">密码错误</span>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">确认密码</label>
                        <div class="col-lg-7">
                            <input type="password" autocomplete="off" placeholder="请输入确认密码..." id="f_repass" class="form-control" name="repass">
                        </div>
                        <span  class="col-lo-3 hide">密码错误</span>
                    </div>
                    <div class="form-group text-center" style="text-align: center;">
                        <div class="col-lg-4">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="token" value="{{$token}}">
                            <button class="reg_btn btn_disabled" disabled id="btn_changePwd" type="submit">修改密码</button>
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
            $fm_savechangepwd  = $("#fm_savechangepwd");
            $f_pass    = $("#f_pass");
            $f_repass    = $("#f_repass");
            //禁用form表单下所有input的回车提交表单事件
            $fm_savechangepwd.find('input').keydown(function(event){
                if (event.keyCode === 13) {
                    event.preventDefault ? event.preventDefault() : event.returnValue = false;
                }
            });

            $f_pass.blur(function(){
                if ( !$(this).val().length ) {
                    $f_pass.parent().next("span").removeClass('hide').css('color','red').text('密码为空');
                    $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                    return false;
                }
                $("#btn_changePwd").removeClass('btn_disabled').removeAttr('disabled');
                $f_pass.parent().next("span").addClass('hide');
            });
            $f_repass.blur(function(){
                if ( !$(this).val().length ) {
                    $f_repass.parent().next("span").removeClass('hide').css('color','red').text('确认密码为空');
                    $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                    return false;
                } else if ( $f_pass.val() != $f_repass.val() ) {
                    $f_repass.parent().next("span").removeClass('hide').css('color','red').text('密码与确认密码不一致');
                    $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                    return false;
                }
                $("#btn_changePwd").removeClass('btn_disabled').removeAttr('disabled');
                $f_repass.parent().next("span").addClass('hide');
            });

            $fm_savechangepwd.submit(function(ev){
                if ( !$f_pass.val().length ) {
                    $f_pass.parent().next("span").removeClass('hide').css('color','red').text('密码为空');
                    $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                    return false;
                }
                if ( !$f_repass.val().length ) {
                    $f_repass.parent().next("span").removeClass('hide').css('color','red').text('确认密码为空');
                    $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                    return false;
                }
                $("#btn_changePwd").addClass('btn_disabled').attr('disabled','true');
                let $fm_savechangepwd = $(this).serialize();
                $.ajax({
                    url: '/dochangepwd',
                    method: 'POST',
                    contentType:'application/x-www-form-urlencoded',
                    dataType:'json',
                    data:$fm_savechangepwd,
                    success:function(res){
                        if ( res.code === '000' ) {
                            $("#modal_reg").find('.reg_body').text(res.msg);
                            $("#modal_reg").removeClass('reg_hide');
                            setInterval(function(){
                                $("#modal_reg>.reg>i").trigger('click');
                                window.location.href='/';
                            },2000);
                        } else {
                            $("#modal_reg").find('.reg_body').text(res.msg);
                            $("#modal_reg").removeClass('reg_hide');
                            setInterval(function(){
                                $("#modal_reg>.reg>i").trigger('click');
                            },2000);
                        }
                    },error:function(err) {
                        console.log('网络错误');
                    },beforeSend:function(xhr){
                        xhr.setRequestHeader('X-CSRF-TOKEN',$("#csrftoken").attr('content'));
                    }
                });
                ev.preventDefault();    //阻止表单的默认跳转
            });
        });
    </script>
</div>

<div id="modal_reg" class="reg_hide">
    <div class="reg">
        <i class="iconfont icon-guanbi">x</i>
        <div class="reg_head">注册提示</div>
        <div class="reg_body">内容</div>
    </div>
</div>
<script>
    //关闭注册提示信息模态框
    $("#modal_reg>.reg>i").click(function(){
        $(this).parents("#modal_reg").addClass('reg_hide');
    });
</script>

<div class="reg_footer" style="position: fixed; bottom: 0;">
    <div class="reg_bqsm">
        Copyright © 2018
    </div>
</div>
</body>
</html>
