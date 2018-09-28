<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="id" content="{{session('home_user')['id']}}">
    <meta http-equiv="Cache-Control" content="no-transform " />

    <title>{{$contents->title}}_木知网</title>
    <meta name="keywords" content="{{$contents->title}}" />
    <meta name="description" content="{{$contents->title}}" />
    
     <!-- 广告 -->
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/style.css">
    <!-- 广告结束 -->
    <link rel="stylesheet" type="text/css" href="/static/home/show/css/index_3.css">
    <link rel="stylesheet" type="text/css" href="/static/home/show/css/comment_3.css">
    <style type="text/css">
        .gzBtn{ display:inline-block; margin-left:20px; padding:0px 10px; line-height:22px;border:1px solid #3ACA81;border-radius: 1px;}
        .wgt_name a.gzBtn{  color:#3ACA81;}
        .wgt_right{ position:relative;}
        .wgt_gz{ position:absolute; right:20px; top:14px; display:block;padding:0px 12px; line-height:22px; background:#3ACA81; border:1px solid #3ACA81;border-radius: 3px;}
        .wgt_gz a{color:#FFF; line-height:24px;}
        .wgt_gz:hover{ font-weight:bold;}
    </style>
    <script src="/static/home/show/js/jquery-1.8.1.min_3.js" type="text/javascript"></script>
    <script src="/static/home/show/js/pc_3.js" type="text/javascript"></script>
    <script src="/static/home/show/js/d0d59938f54c4522be984a8f5a3352d3.js" type="text/javascript"></script>
    <script src="/static/home/show/js/layer_3.js" type="text/javascript"></script>
    <script src="/static/home/show/js/zan_3.js" type="text/javascript"></script>
    <style>
        a {
            cursor: pointer;
        }
        .logo2{
            margin-top: 15px;
            height: 40px;
        }
        .main>a{
            float: left;
        }
    </style>
</head>
<body>
<div class="head">
    <div class="main">
        <a href="/" target="_blank"><img src="/static/home/index/images/logo2.png" class="logo2"></a>
        <a href="/" class="name fl">日记大全</a>
    </div>
</div>
<div class="nav2">
    <div class="main2">
        <div class="subNav2 fl">
            <a href="/">首页</a>
        @foreach($cates as $k=>$cate_v)
            <a href="/list/{{$cate_v->id}}" style="cursor:pointer;" title="小学生日记">{{$cate_v->name}}</a>
        @endforeach
        <a href="/jokeList">笑话大全</a>
        <a href="/getXingzuo/白羊座">星座运势</a>
        </div>
    </div>
</div>
<div class="main mt15">
    <div class="l-box fl">
        <div class="mb30 shadow border">
            <div id="path">
                <a href='/'>日记网 </a> >
                <a href='/list/{{$parent_cate->id}}'>{{$parent_cate->name}} </a> >
                <a href='/list/{{$childrent_cate->id}}'>{{$childrent_cate->name}}</a>
            </div>
            <div class="l-th mb16 ar2_bt" style="height: 100px;">
                <h1>{{$contents->title}}</h1>
            </div>
            <div class="wgt_main">
                <div class="wgt_box">
                    <div class="grid">
                        <p class="wgt_photo">
                        @if($contents->is_admin === '0')
                            <a rel="nofollow" href="/ps_space/{{$contents->uid}}" target="_blank">
                                <img src="{{$contents->uface}}">
                            </a>
                        @else
                            <a href="javascript:void(0);">
                                <img src="/static/home/person/images/boy.jpg">
                            </a>
                        @endif
                        </p>
                    </div>
                    <div class="wgt_right">
                        <div class="wgt_name clearfix">
                            @if( $contents->is_admin === '0' )
                                <a class="user_name" rel="nofollow" href="/ps_space/{{$contents->uid}}" target="_blank">{{$contents->uname}}</a>
                                @if ( in_array( session('home_user')['id'] , $gz_from_ids ) )
                                <a class="gzBtn" id="guanzhu" href="javascript:void(0);">已关注</a>
                                @else
                                <a class="gzBtn" id="guanzhu" href="javascript:void(0);">关注</a>
                                @endif
                            @else
                                <a class="user_name" rel="nofollow" href="javascript:void(0);">{{$contents->uname}}</a>
                            @endif
                        </div>
                        <div class="carefield">
                            <span class="mr_15">发布时间：{{date('Y-m-d H:i:s',$contents->created_at)}}</span>
                            <span class="mr_15">{{$contents->week}}</span>
                            <span class="mr_15">{{$contents->weather}}</span>
                            <span>浏览次数: </span>
                            <span>{{$contents->num}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="l-tbody">
                <div class="art-text">
                    <div style="float:right; width:336px; height:250px;padding-left:15px; padding-top:8px; padding-bottom:5px;">
                        <div class="htmleaf-container">
                            <div class="mod18" style="width: 270px">
                                <span id="prev" class="btn prev"></span>
                                <span id="next" class="btn next"></span>
                                <span id="prevTop" class="btn prev"></span>
                                <span id="nextTop" class="btn next" style="right:10px;"></span>
                                <div id="picBox" class="picBox" style="width: 270px;height:210px;background-color: #fff;">
                                    <ul class="cf">
                                        @foreach($data as $v)
                                        <li> <a href="{{$v->url}}"><img src="{{$v->pic}}" alt="" style="width:270px; height:215px;"></a> <span style="bottom: 20px">{{$v->name}}</span> </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="listBox" class="listBox" style="width:270px;margin-left:-3px;height: 80px;margin-top: -12px">
                                    <ul class="cf">
                                        @foreach($data as $v)
                                        <li class="on"><i class="arr2"></i><img style="width: 56px;height: 44px" src="{{$v->pic}}" alt=""></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                        {!! $contents->content !!}
                    </div>
                    <div class="xg" id="newdigg">
                        <div class="vote_box">
                            <a id="diggGood" class="vote_recommend" title="哎哟,不错喔">
                                <span class="vote_icon"><i class="face_happy face_happyPlay"></i></span>
                                <span class="vote_number c_good" id="voteLike"  data-likenum="点赞">点赞（<i>{{$contents->laud}}</i>）</span>
                                <span class="vote_text c_good">点赞（<i>{{$contents->laud}}</i>）</span>
                            </a>

                            <a id="diggBad" class="vote_not_recommend" title="不怎么样">
                                <span class="vote_icon"><i class="face_unhappy face_unhappyPlay"></i></span>
                                <span class="vote_number c_bad" id="voteUnLike"  data-unlikenum="呵呵">呵呵（<i>{{$contents->belittle}}</i>）</span>
                                <span class="vote_text c_bad">呵呵（<i>{{$contents->belittle}}</i>）</span>
                            </a>
                        </div>
                    </div>
                    <ul>
                        <li>上一篇：
                            @if($lastPage)
                                <a href='/list/{{$lastPage->id}}/show' title="{{$lastPage->title}}">{{changeStr($lastPage->title,20,'...')}}</a>
                            @else
                                没有了
                            @endif
                        </li>
                        <li>下一篇：
                            @if($nextPage)
                                <a href='/list/{{$nextPage->id}}/show' title="{{$nextPage->title}}">{{changeStr($nextPage->title,20,'...')}}</a>
                            @else
                                没有了
                            @endif
                        </li>
                    </ul>
                    <div style="clear:both"></div>
                    <div class="emoticons">
                        <div style="width:682px; margin-top:15px;">
                            <div class="publisher">
                                <textarea name="msg" id="msg" class="comment-msg-txt"></textarea>
                                <div style="width:704px">

                                    <button type="button" class="button" id="comment">评论</button>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="comment-list">
                        @foreach($comment as $v)
                        <dl class="fix fixss{{$v->id}}" >
                            <dt>
                                <a href="/ps_space/{{$v->uid}}" target="_blank">
                                    <img src="{{$v->uface}}" width="46" height="46">
                                </a>
                            </dt>
                            <dd id="comm" class="comm">
                                <a href="/ps_space/{{$v->uid}}" target="_blank">
                                    <span style="color:#3ACA81" id="nicknames">{{$v->nickname}}</span>
                                </a>：{{$v->content}}
                                <div class="comment-info"> {{date('m-d H:i',$v->created_at)}}
                                    <a href="javascript:void(0);" class="response" vid="{{$v->id}}" from_uid="{{$v->from_uid}}" >回复</a>
                                    @if($v->uid == session('home_user')['id'])
                                    <a class="del{{$v->id}} {{$v->id}}" href="javascript:void(0);" style="float: right" onclick="del({{$v->id}})">删除</a>
                                    @endif
                                </div>
                                <!-- 回复内容 -->
                                <!-- 回复表中的对应评论id和评论表id相等时显示对应回复内容 -->
                                <div class="comment-recommend fixs{{$v->id}}">
                                @foreach($recomment as $value)
                                    @if( $value->c_id == $v->id)
                                        <!-- 遍历数据表中的回复内容 -->
                                        <dl class="fix{{$value->uid}} wu" id="wu">

                                            <dt>
                                                <a href="/ps_space/{{$value->uid}}" target="_blank">
                                                    <img src="{{$value->uface}}" width="46" height="46">
                                                </a>
                                            </dt>
                                            <dd>
                                                <a href="/ps_space/{{$value->uid}}" target="_blank">
                                                    <span style="color:#3ACA81" id="nickname">{{$value->nickname}}</span>
                                                </a>：
                                                <span class="contentss">{{$value->reply_content}}</span>
                                                <div class="comment-info"> <span class="timess">{{date('m-d H:i',$value->created_at)}}</span>
                                                    @if($value->uid == session('home_user')['id'])
                                                    <a class="dels{{$value->id}} {{$value->id}}" href="javascript:void(0);" onclick="dels({{$value->id}})" style="position: relative;left: 453px">删除
                                                    </a>
                                                    @endif
                                                </div>
                                            </dd>
                                        </dl>
                                    @endif
                                @endforeach

                                </div>
                                <!-- 回复内容结束 -->


                            </dd>
                        </dl>
                        @endforeach
                    </div>
                    <div class="comment-more fang" style="display: none;"> <a href="javascript:void(0);" id="jiazai">加载更多</a> </div>
                    <div class="comment-more shou" style="display: none;"> <a href="javascript:void(0);" id="shouqi">点击收起</a> </div>
                </div>
            </div>
        </div>
        <!-- 这里是评论框 -->
        <div class="comment-post" id="comment-post" style="display: none">
            <div class="emoticons">
                <div class="publisher">
                    <div class="comment-msg">
                        <textarea name="msg" id="msg4367" class="comment-msg-txt recomment recomment{{$v->id or ''}}"></textarea>
                        <p></p>
                        <p>
                            <button type="button" class="button" refrom_uid='{{$v->from_uid or ""}}' revid='{{$v->id or ''}}' reuid='{{$v->uid or ""}}' >回复</button>
                            <button type="button" class="button2 mr20 {{$v->id or ''}}" delid='{{$v->id or ''}}'>取消</button>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <!-- <div class="knows shadow border mb30" style=" padding-top:3px;padding-left:12px;">
            <script type="text/javascript" src="/static/home/show/js/niaokhqxjlprx_3.js"></script>
        </div> -->
        <div class="knows shadow border mb30">
            <div class="ar_tit"> <span class="mark">相关日记</span> </div>
            <div class="lBox-tb lBox-List2-tb">
                <ul class="ulList">
                @foreach($relateds as $k=>$v)
                    <li><a href="/list/{{$v->id}}/show" target="_blank" title="{{$v->title}}">{{changeStr($v->title,15,'...')}}</a></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="r-box">
        <div id="JscrollBox">
            <!-- <div class="mb30" style="width: 303px; height: 250px; background:white;">
                广告位置
                <script type="text/javascript">a300();</script>
            </div> -->
            <div class="relation shadow border tjzt mb30">
                <div class="list3_th"><span class="mark">阅读排行</span></div>
                <ul class="red_ph">
                @foreach($readTop10 as $k=>$v)
                    @if( $k < 3 )
                    <li>
                        <span class="ar_onHot">{{$k+1}}</span>
                        <a href="/list/{{$v->id}}/show" target="_blank" title="{{$v->title}}">{{changeStr($v->title,13,'...')}}</a>
                    </li>
                    @else
                        <li>
                            <span class="ar_offHot">{{$k+1}}</span>
                            <a href="/list/{{$v->id}}/show" target="_blank" title="{{$v->title}}">{{changeStr($v->title,13,'...')}}</a>
                        </li>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="border shadow tjzt mb30">
                <div class="list3_th"><span class="mark">年级分类</span></div>
                <div class="qc-list3 color9">
                @foreach($classCates as $k=>$v)
                    <a href="/list/{{$v->id}}" title="{{$v->name}}">{{$v->name}}</a>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div style="clear:both;"></div>
<div class="footer">
    <div class='footerIn'>
        <a href='#' target='_blank'>关于我们</a>|<a href='#' target='_blank'>网站申明</a>|<a href='#' target='_blank'>投稿帮助</a>|<a href='#' target='_blank'>意见建议</a>|<a href='#' target='_blank'>联系我们</a>
    </div>
    <div style="clear:both;"></div>
    <div class="bqsm">Copyright &copy; 2018</div>
    <div id="asas"></div>
</div>

<!-- 这个是评论的东西 -->
<dl class="fix fixss{{$v->id}} cmt" style="display: none" >
    <dt>
        <a href="{{session('home_user')['id']}}" target="_blank">
            <img src="{{session('home_user')['uface']}}" width="46" height="46">
        </a>
    </dt>
    <dd id="comm" class="comm">
        <a href="{{session('home_user')['id']}}" target="_blank">
            <span style="color:#3ACA81" id="nicknames">{{session('home_user')['nickname']}}:</span>
        </a>：
        <span id="cnt"></span>
        <div class="comment-info"> <span id="time"></span>
            <a href="javascript:void(0);" class="response" vid="" from_uid="">回复</a>

            <a class="del" id="getids" href="javascript:void(0);" style="float: right" onclick="">删除</a>

        </div>
        <!-- 回复内容 -->
        <!-- 回复表中的对应评论id和评论表id相等时显示对应回复内容 -->
        <div class="comment-recommend fixs{{$v->id}}">

        </div>
        <!-- 回复内容结束 -->
    </dd>
</dl>
<!-- 回复模板 -->
<dl class="fix wus" id="wu" style="display: none">
    <dt>
        <a href="/ps_space/{{session('home_user')['id']}}" target="_blank">
            <img src="{{session('home_user')['uface']}}" width="46" height="46">
        </a>
    </dt>
    <dd>
        <a href="/ps_space/{{session('home_user')['id']}}" target="_blank">
            <span style="color:#3ACA81" id="nickname">{{session('home_user')['nickname']}}:</span>
        </a>：
        <span class="contents"></span>
        <div class="comment-info"> <span class="times"></span>

            <a class="dels" id="getid" href="javascript:void(0);" onclick="dels" style="position: relative;left: 453px">删除
            </a>

        </div>
    </dd>
</dl>

</div>
<!-- 评论的JS -->
<script type="text/javascript">
    // 加载更多的点击事件
    if($('.comment-list').height() > 400) {
        $('.fang').css('display','block');
        $('.comment-list').css('height','400px');
        $('.comment-list').css('overflow','hidden');
    }

    $('#jiazai').click(function(){
        $('#jiazai').html('加载中。。。');
        setTimeout(function() {
            $('.fang').css('display','none');
            $('.shou').css('display','block');
            $('.comment-list').css('height','auto');
            $('.comment-list').css('overflow','visible');
        }, 2000);
    });

    $('#shouqi').click(function(){
        $('.comment-list').css('height','400px');
        $('.comment-list').css('overflow','hidden');
        $('.fang').css('display','block');
        $('.shou').css('display','none');
        $('#jiazai').html('加载更多');
    });

    //评论的点击事件
    $('#comment').click(function(){
        com = $('#msg').val();
        id =  {{$contents->id}};
        if (com.length < 5) {
            alert('评论回复不能少于5个字');
        } else {
            $.get('/comment',{id:id,content:com},function(res){
                if (res.code === 00000) {
                    //克隆副本
                    dl = $('.cmt').clone();
                    dl.css('display','block');
                    //为副本设置类名
                    dl.attr('class','fix fixss'+id);
                    //设置属性
                    dl.find('#cnt').html(com);
                    dl.find('#time').html(res.ctime);
                    dl.find('.response').attr('from_uid',{{session('home_user')['id']}});
                    dl.find('.response').attr('vid',res.id);
                    dl.find('#getids').attr('class','del'+res.id);
                    dl.find('#getids').attr('onclick','del('+res.id+')');
                    //插入到最后
                    $('.comment-list').append(dl);
                    //清空文本框的值
                    $('#msg').val('');
                    location.reload();
                } else if(res.code === 10000) {
                    alert(res.msg);
                    window.location.href = '/';
                }
            },'json');
        }
    });

    // 回复点击事件
    responses = $('.comment-list').find(".fix").find('.comm').find('.comment-info').find('.response');
    responses.each(function(i){
        $(this).on('click',function(){
            comments = $('.comment-list').find('.fix').find('.comm').find('.comment-recommend').find('.comment-post');
            //移除原来的文本框
            comments.each(function(){
                $(this).remove();
            });
            id = $(this).attr('vid');
            from_uid = $(this).attr('from_uid');
            clone = $(this).parents('.l-box').find('.comment-post').clone();
            //给克隆的设置新的类名
            clone.attr('class','comment-post comment-post'+id);
            //清空文本框内容
            $('.recomment').val("");
            clone.css('display','block');
            $(this).parents('.comment-info').parents('.comm').find('.fixs'+id).append(clone);

            //移除文本框
            delids = $(this).parents('.comm').find('.fixs'+id).find('.comment-post'+id).find('.emoticons').find('.publisher').find('.comment-msg').find('p').find('.button2');
            //单击取消移除文本框
            delids.click(function(){
                comments = $('.comment-list').find('.fix').find('.comm').find('.comment-recommend').find('.comment-post');
                comments.each(function(){
                    $(this).remove();
                });
            });

            //回复
            ReComments = $(this).parents('.comm').find('.fixs'+id).find('.comment-post'+id).find('.emoticons').find('.publisher').find('.comment-msg').find('p').find('.button');
            rec = $(this).parents('.comm').find('.fixs'+id).find('.comment-post'+id).find('.emoticons').find('.publisher').find('.comment-msg').find('.recomment');
            ReComments.click(function(){
                recontent = rec.val();
                cont_id =  {{$contents->id}};
                // alert(from_uid);
                if (recontent.length < 5) {
                    alert('评论回复不能少于5个字');
                } else {
                    mod = $(this).parents('.comment-list').find('.fixss'+id).find('.comm').find('.fixs'+id);
                    o = $(this);

                    $.get('/recomment',{cont_id:cont_id,recontent:recontent,reply_id:from_uid,id:id},function(res){
                        if(res.code == 10001){
                            remove = o.parents('.comment-list').find('.fixss'+id).find('.comm').find('.fixs'+id).find('.comment-post'+id);
                            // alert(remove.length);
                            remove.remove();
                            dll = $('.wus').clone();
                            dll.attr('class','fix'+id);
                            dll.css('display','block');
                            dll.find('.contents').html(recontent);
                            dll.find('.times').html(res.time);
                            dll.find('#getid').attr('class','dels'+res.id);
                            dll.find('#getid').attr('onclick','dels('+res.id+')');

                            // $('.fixss'+id).find('.fixs'+id).append(dll);
                            mod.append(dll);

                            // alert('a');
                            // dll.remove();
                        }else if(res.code == 10000){
                            alert(res.msg);
                        }
                   },'json');
                }
            });
        });
    });



    //评论删除
    function del(id) {
        $.get('/show_del',{id:id},function(res){
            if(res.code == 10001){
                alert(res.msg);
                $('.del'+id).parents('dl').remove();
            }else if(res.code == 10002){
                alert(res.msg);
            }
        },'json');
    }

    //回复删除
    function dels(id) {
         $.get('/show_dels',{id:id},function(res){
            if(res.code == 10001){
                alert(res.msg);
                $('.dels'+id).parents('#wu').remove();
            }else if(res.code == 10002){
                alert(res.msg);
            }
        },'json');
    }

</script>
<!-- JS脚本结束 -->

<!-- 赞和踩 -->
<script>
    $diggGood   = $("#diggGood");//赞按钮
    $diggBad    = $("#diggBad");//踩按钮

    $diggGood.click(function(){
        diggPost('good',{{$contents->id}});
    });
    $diggBad.click(function(){
        diggPost('bad',{{$contents->id}});
    });

    function diggPost($type,$id) {
        $.ajax({
            url: '/digg',
            type: 'post',
            dataType:'json',
            data: {
                digg:$type,
                id:$id,
                uid: $("meta[name='id']").attr('content')
            },
            success:function(res) {
                if ( res.type === 'good' && res.code === '000' ) { //点赞成功后点踩数+1
                    $(".c_good").find('i').each(function(){
                        $n1 = parseInt( $(this).text() );
                        $(this).text( $n1+1 );
                    });
                } else if( res.type === 'bad' && res.code === '000' ) {//点踩成功后点踩数+1
                    $(".c_bad").find('i').each(function(){
                        $n1 = parseInt( $(this).text() );
                        $(this).text( $n1+1 );
                    });
                } else if ( res.code === '111' ) {
                    alert( res.msg );
                } else if( res.code === '222') {
                    alert( res.msg );
                    window.location.href='/';
                }
            },error:function(err) {
                console.log('网络错误');
            },beforeSend:function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}')
            }
        });
    }
</script>
{{--点击关注按钮事件--}}
<script>
$(function(){
    $("#guanzhu").click(function(){
        let that = $(this);
        //先检测当前用户是否登录
        @if ( empty( session('home_user')['id'] ) )
            alert('请先登录');
            window.location.href='/';
        @else
            $.get('/user/guanzhu',{to_uid: {{$contents->uid}} },function(res){
                if ( res.code === '00000' ) {
                    that.text('已关注');
                } else {
                    alert( res.msg );
                }
        },'json');
        @endif
    });
});
</script>
<script src="/static/home/show/js/dpl-tab_v2_3.js" type="text/javascript"></script>
<script type="text/javascript">
    //document.getElementById("click").innerHTML = document.getElementById("click_num").innerHTML;
</script>

<!-- 广告 -->
<script src="/static/home/ads/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="/static/home/ads/js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="/static/home/ads/js/jqueryPhoto.js" type="text/javascript"></script>
<!-- 广告结束 -->
</body>
</html>
