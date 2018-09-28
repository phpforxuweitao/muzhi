<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-Control" content="no-transform " />
    <title>{{$cate_info->name}}_木知网</title>
    <meta name="keywords" content="{{$cate_info->name}}" />
    <meta name="description" content="{{$cate_info->name}}"/>

    <!-- 广告 -->
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="/static/home/ads/css/style.css">
    <!-- 广告结束 -->

    <link href="/static/home/list/css/index.css" rel="stylesheet" type="text/css">
    <script src="/static/home/list/js/jquery-3.1.1.js" type="text/javascript"></script>
    <script src="/static/home/list/js/uaredirect.js" type="text/javascript"></script>
    <script src="/static/home/list/js/g.js" type="text/javascript"></script>
    <script src="/static/home/index/js/slideshow.js" type="text/javascript"></script>
    <style>
        div.list_page>span {
            text-align: center;
        }
        div.list_page>span>.pagination>li {
            float: left;
        }
        div.list_page>span>.pagination>li.disabled>span {
            border: 1px solid #ededed;
            cursor: not-allowed;
        }
        div.list_page>span>.pagination>li.active>span {
            border: 1px solid #81c08f;
        }
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
        <a style="cursor:pointer;" href="/" class="name fl">日记</a>
        <p class="h-crumb">
            <em class="arr"></em>
            <a href='/list/{{$cate_info->id}}'>{{$cate_info->name}}</a>
        </p>
        <div class="search">
        </div>
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
                <a class="toc current" href="/list/{{$cate_info->id}}" target="_self">{{$cate_info->name}}大全</a>
            </div>
            <div class="lBox-tb">
                <ul class="qaList-ulList ">
                @foreach($list as $k=>$v)
                    <li>
                        <p class="pQ">
                            <span class="fr lgray">{{date('Y-m-d',$v->created_at)}}</span>
                            <span class="fr lgray">{{$v->size}}字</span>
                            <span class="fr pAuthor">{{$v->uname}}</span>
                            <a style="cursor:pointer;" href="/list/{{$v->id}}/show">{{changeStr($v->title,'20','...')}}</a>
                        </p>
                    </li>
                @endforeach
                </ul>
                <div class="list_page">
                    <span>
                        {{$list->render()}}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="right305">
        <div class="rad shadow mb30" style="width:303px; height:250px;">
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

        <div class="rBox part">
            <div class="rBox-th"><h3 class="mark">教育图库</h3></div>
            <div class="rBox-ulPic">
                <ul class="clearfix">
                    <li><a target="_blank" href="https://www.riji.cn/scb/"><img src="/static/home/list/picture/li4img1.jpg" width="118" height="88"><p>手抄报</p></a></li>
                    <li><a><img src="/static/home/list/picture/li4img2.jpg" width="118" height="88"><p>黑板报</p></a></li>
                    <li><a><img src="/static/home/list/picture/li4img3.jpg" width="118" height="88"><p>小制作</p></a></li>
                    <li><a target="_blank" href="https://www.riji.cn/jbh/"><img src="/static/home/list/picture/li4img3.jpg" width="118" height="88"><p>简笔画</p></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div style="clear:both"></div>
<div class="footer">
    <script src="/static/home/list/js/link.js" type="text/javascript"></script>
    <div style="clear:both;"></div>
    <div class="bqsm">Copyright 2018</div>
</div>

<script src="/static/home/list_p/js/dpl-tab_v2.js" type="text/javascript"></script>
<!-- 广告 -->
<script src="/static/home/ads/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="/static/home/ads/js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="/static/home/ads/js/jqueryPhoto.js" type="text/javascript"></script>
<!-- 广告结束 -->
</body>
</html>
