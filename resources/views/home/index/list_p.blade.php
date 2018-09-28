<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-transform " />
    <title>{{$cate_info->name}}_日记大全</title>
    <meta name="keywords" content="{{$cate_info->name}}" />
    <meta name="description" content="{{$cate_info->name}}"/>
    <!-- 广告 -->
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/style.css">
    <!-- 广告结束 -->
    <link rel="stylesheet" type="text/css" href="/static/home/list_p/css/index.css">
    <script src="/static/home/list_p/js/uaredirect.js" type="text/javascript"></script>
    <script src="/static/home/list_p/js/jquery-1.8.1.min.js" type="text/javascript"></script>
    <script src="/static/home/list_p/js/g.js" type="text/javascript"></script>
    <style>
        a {
            cursor: pointer;
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
        <a target="_blank" style="cursor:pointer;" href="/" class="name fl">日记</a>
        <p class="h-crumb">
            <em class="arr"></em>
            <a style="cursor:pointer;" href='/'>木知网</a> >
            <a href='/list/{{$cate_info->id}}'>{{$cate_info->name}}</a>
        </p>
        <div class="search"></div>
    </div>
</div>
<div class="nav2">
    <div class="main2">
        <div class="subNav2 fl">
            <a href="/">首页</a>
        @foreach($cates as $k=>$v)
            <span class="subNav-more2">
                <a style="cursor:pointer;" href="/list/{{$v->id}}">{{$v->name}}</a>
            </span>
        @endforeach
            <a href="/jokeList">笑话大全</a>
            <a href="/getXingzuo/白羊座">星座运势</a>
        </div>
    </div>
</div>
<div class="main mt15">
    <div class="l-box fl">
    {{--foreach--}}
    @foreach($lists as $k=>$v)
        <div class="mb30 border shadow">
            <div class="ia_ListPart">
                <div class="ia_part">
                    <div class="iaAt_title">
                        <h2><a style="cursor:pointer;" href="/list/{{$v->id}}">{{$v->name}}</a></h2>
                    </div>
                    <div class="ia_articleList">
                        <ul>
                        @foreach($v->child as $k2=>$v2)
                            <li>
                                <a style="cursor:pointer;" href="/list/{{$v2->id}}/show">{{changeStr($v2->title,20,'...')}}</a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{--endforeach--}}
    </div>

    <div class="r-box">
        <div id="JscrollBox" class="">
            <div class="mb30" style="width:300px; height:265px; background-color:white;">
                {{--广告开始--}}
                <div class="htmleaf-container">
                    <div class="mod18" style="width: 300px">
                        <span id="prev" class="btn prev"></span>
                        <span id="next" class="btn next"></span>
                        <span id="prevTop" class="btn prev"></span>
                        <span id="nextTop" class="btn next"></span>
                        <div id="picBox" class="picBox" style="width: 300px;">
                            <ul class="cf">
                                @foreach($ads_data as $v)
                                <li> <a href="{{$v->url}}"><img src="{{$v->pic}}" alt="" style="width:300px; height:265px;"></a> <span>{{$v->name}}</span> </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="listBox" class="listBox">
                            <ul class="cf">
                                @foreach($ads_data as $v)
                                <li class="on"><i class="arr2"></i><img style="width: 56px;height: 44px" src="{{$v->pic}}" alt=""></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                {{--广告结束--}}
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
    <script src="/static/home/list_p/js/link.js" type="text/javascript"></script>
    <div style="clear:both;"></div>
    <div class="bqsm">Copyright &copy; 2018</div>
</div>

<script src="/static/home/list_p/js/dpl-tab_v2.js" type="text/javascript"></script>
<!-- 广告 -->
<script src="/static/home/ads/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="/static/home/ads/js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="/static/home/ads/js/jqueryPhoto.js" type="text/javascript"></script>
<!-- 广告结束 -->
</body>
</html>
