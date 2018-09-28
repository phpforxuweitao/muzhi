<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-transform " />
    <meta name="csrf_token" content="{{csrf_token()}}">
    <title>笑话大全_木知网 </title>
    <meta name="keywords" content="笑话大全_木知网" />
    <meta name="description" content="笑话大全_木知网"/>
    <link href="/static/home/list/css/index.css" rel="stylesheet" type="text/css">
    <script src="/static/home/list/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script src="/static/home/list/js/uaredirect.js" type="text/javascript"></script>
    <script src="/static/home/list/js/g.js" type="text/javascript"></script>
    <script src="/static/home/index/js/slideshow.js" type="text/javascript"></script>
    <style>
        div.list_page {
            padding: 10px 0 40px 40px;
        }
        div.list_page>.pagination>li {
            float: left;
        }
        div.list_page>.pagination>li.disabled>a {
            border: 1px solid #ededed;
            cursor: not-allowed;
        }
        div.list_page>.pagination>li.active>a {
            border: 1px solid #81c08f;
            cursor: default;
        }
        a {
            cursor: pointer;
        }
        .qaList-ulList {
            padding: 20px 20px 10px 40px;
            font-size: 18px;
        }
        .qaList-ulList>li {
            line-height: 35px;
        }
        .qaList-ulList>li>span {
            padding-left: 50px;
        }
        .list_loading {
            padding: 10px 20px;
            font-size: 20px;
            text-align: center;
        }
        .logoo{
            width: 160px;
            float:left;
        }
        .logoo img{
            height: 38px;
            margin-top:13px;
            margin-right: 8px;
        }
    </style>
</head>
<body id="Jbody">
<div class="head">
    <div class="main">
        <a style="cursor:pointer;" class="logoo" href="/">
            <img src="/static/home/index/images/logo2.png" class="logo2">
        </a>
        <a style="cursor:pointer;" href="/" class="name fl">日记</a>
        <p class="h-crumb">
            <em class="arr"></em>
            <a href='/jokeList'>笑话大全</a>
        </p>
        <div class="search"></div>
    </div>
</div>
<!-- nav S -->
<div class="nav2">
    <div class="main2">
        <div class="subNav2 fl">
            <a href="/">首页</a>
            @foreach($cates as $k => $v)
                <span class="subNav-more2">
                <a style="cursor:pointer;" href="/list/{{$v->id}}">{{$v->name}}</a>
                <em class="subNav-more-btn2"></em>
                    @if( !empty($v->child) )
                        <ul class="subNav-more-ul2">
                @foreach($v->child as $k2=>$v2)
                                <li class="subNav-more-li">
                        <a style="cursor:pointer;" href="/list/{{$v2->id}}" target="_blank" title="{{$v2->name}}">{{$v2->name}}</a>
                    </li>
                            @endforeach
                </ul>
                    @endif
            </span>
            @endforeach
            <a href="/jokeList">笑话大全</a>
            <a href="/getXingzuo/白羊座">星座运势</a>

        </div>
    </div>
</div>
<div class="main2 mb30">
    <div class="left665">
        <div class="lBox qaList part">
            <div class="lBox-th2 qaList-nav">
                <a class="toc current" href="/jokeList" target="_self">笑话大全</a>
            </div>
            <div class="lBox-tb">
                <p class="list_loading">加载中...</p>
                <ol id="lists" class="qaList-ulList"></ol>
                <div class="list_page">
                    <ul class="pagination" id="link_btns" role="navigation"></ul>
                </div>
            </div>
        </div>
    </div>
    <div class="right305">
        <div class="rad shadow mb30" style="width:303px; height:250px">
            <script type="text/javascript">a300();</script>
        </div>
        <div class="relation shadow border tjzt mb30">
            <div class="list3_th"><span class="mark">阅读排行</span></div>
            <ul class="red_ph">
                @foreach($readTop10 as $k=>$v)
                    @if( $k<3 )
                        <li>
                            <span class="ar_onHot">{{$k+1}}</span>
                            <a href="/list/{{$v->id}}/show" target="_blank" title="{{$v->title}}">{{changeStr($v->title,15,'...')}}</a>
                        </li>
                    @else
                        <li>
                            <span class="ar_offHot">{{$k+1}}</span>
                            <a href="/list/{{$v->id}}/show" target="_blank" title="{{$v->title}}">{{changeStr($v->title,15,'...')}}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div class="footer">
    <script src="/static/home/list/js/link.js" type="text/javascript"></script>
    <div style="clear:both;"></div>
    <div class="bqsm">Copyright 2018</div>
</div>
<script src="/static/home/list/js/jquery.min.js" type="text/javascript"></script>
<script src="/static/home/list/js/jquery-3.1.1.js" type="text/javascript"></script>
<script>
$(function(){
    $.ajax({
        url: '/getJokeData',
        type: 'post',
        dataType: 'json',
        contentType:'application/x-www-form-urlencoded',
        data:{page:1},
        success:function(res) {

            $('.list_loading').css('display','none');
            if ( res.error_code === 0 && res.reason === 'Success' ) {
                $datas = res.result.data;
                for ( let $item of $datas ) {
                    $content = $item.content;
                    $time = $item.updatetime;
                    $content = $content.replace(/搜索/g,'');
                    $content = $content.replace(/复制/g,'');
                    $('<li>'+$content+'<span> —— '+$time+'</span></li>').appendTo( $("#lists") );
                }

                let num = 10;//默认给10个分页的api笑话数据(最新200条)
                let $link_btns = $("#link_btns");
                for ( let i=1; i <= num; i++ ) {
                    if ( i === 1 ) {
                        $('<li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void(0);" page="'+i+'">'+i+'</a></li>').appendTo( $link_btns );
                    } else {
                        $('<li class="page-item" aria-current="page"><a class="page-link" href="javascript:void(0);" page="'+i+'">'+i+'</a></li>').appendTo( $link_btns );
                    }
                }
            } else {
                alert( '获取数据失败' );
                console.log( res );
            }
        },error:function (err) {
            console.log( err );
        },beforeSend:function (xhr) {
            xhr.setRequestHeader('X-CSRF-TOKEN',$("meta[name='csrf_token']").attr('content'));
        }
    });

    $("#link_btns").on('click','li>a',function(){
        if ( !$(this).parent('li').hasClass('active') ) { //点击当前页面的按钮不给予触发函数
            $(this).parents('#link_btns').find('li').each(function(i){
                $(this).removeClass('active');
            });
            $page = $(this).attr('page');
            $(this).parent('li').addClass('active');
            getJokeData($page);
        }
    });

    function getJokeData( $page ) {
        $.ajax({
            url: '/getJokeData',
            type: 'post',
            dataType: 'json',
            contentType:'application/x-www-form-urlencoded',
            data:{page:$page},
            success:function(res) {
                let $lists = $("#lists");
                $lists.empty();
                $('.list_loading').css('display','none');
                if ( res.error_code === 0 && res.reason === 'Success' ) {
                    $datas = res.result.data;
                    for ( let $item of $datas ) {
                        $content = $item.content;
                        $time = $item.updatetime;
                        $content = $content.replace(/搜索/g,'');
                        $content = $content.replace(/复制/g,'');
                        $('<li>'+$content+'<span> —— '+$time+'</span></li>').appendTo( $lists );
                    }

                    $("body,html").animate({scrollTop:0},100);//回滚到顶部
                } else {
                    alert( res.reason );
                }
            },error:function (err) {
                console.log( err );
            },beforeSend:function (xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN',$("meta[name='csrf_token']").attr('content'));
            }
        });
    }
});
</script>
<script src="/static/home/list/js/dpl-tab_v2.js" type="text/javascript"></script>
</body>
</html>
