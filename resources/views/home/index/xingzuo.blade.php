<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="id" content="{{session('home_user')['id']}}">
    <meta http-equiv="Cache-Control" content="no-transform " />

    <title>星座_木知网</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
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

    <link href="/static/home/xingzuo/css/public.css" rel="stylesheet" type="text/css" charset="utf-8" />
    <script src="/static/home/xingzuo/js/jquery.js" type="text/javascript"></script>
    <link href="/static/home/xingzuo/css/yunshi.css" rel="stylesheet" type="text/css" />
    <script src="/static/home/xingzuo/js/yunshi.js" type="text/javascript"></script>
    <style>
        a {
            cursor: pointer;
        }
        .logo0{
            float: left;
            width: 250px;
            height: 270px;
            text-align: center;
            display: block;
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
        }
        .logo0 img{
            width: 160px;
            margin: 40px 45px 0;
        }
        .logo0 span{
            display: inline-block;
            height: 30px;
            line-height: 30px;
            font-size: 24px;
            margin-top: 8px;
            color: #555;
        }
        .Fortune{
            display: none;
        }
        .today{
            display: block;
        }
        .r-box{
            z-index: 1000;
        }
        .wrapper{
            width:auto;
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
<body>
<div class="head">
    <div class="main">
        <a style="cursor:pointer;" class="logoo" href="/">
            <img src="/static/home/index/images/logo2.png" class="logo2">
        </a>
        <a style="cursor:pointer;" href="/getXingzuo/白羊座" class="name fl">星座运势</a>
    </div>
</div>
<div class="nav2">
    <div class="main2">
        <div class="subNav2 fl">
            <a href="/">首页</a>
        @foreach($cates as $k=>$v)
            <a href="/list/{{$v->id}}" style="cursor:pointer;" title="小学生日记">{{$v->name}}</a>
        @endforeach
            <a href="/jokeList">笑话大全</a>
            <a href="/getXingzuo/白羊座">星座运势</a>
        </div>
    </div>
</div>
<div class="main mt15">
    <div class="l-box fl">
        <div class="mb30 shadow border">
            <!-- <星座内容 -->
            <div id="MAIN_DIV" class="wrapper">
                <div id="PAGE_LEFT" class="yunshi_left">
                    <div class="yunshi_nav">
                        <strong id="SELECT_SIGN_BTN">{{$data[0]['name']}}<em></em></strong>
                        <a href="javascript:void(0);" class="cur" onclick="tday('today')" title="{{$data[0]['name']}}今日运势_{{$data[0]['name']}}今日运势查询_{{$data[0]['name']}}每日运势/运程">今日运势</a>
                        <a  href="javascript:void(0);" onclick="tday('tomorrow')" title="{{$data[0]['name']}}明日运势_{{$data[0]['name']}}明日运势查询_{{$data[0]['name']}}明日运程">明日运势</a>
                        <a href="javascript:void(0);" onclick="tday('week')" title="{{$data[0]['name']}}本周运势_{{$data[0]['name']}}本周运势查询_{{$data[0]['name']}}本周运程">本周运势</a>
                        <a href="javascript:void(0);" onclick="tday('nextweek')" title="{{$data[0]['name']}}下周运势_{{$data[0]['name']}}下周运势查询_{{$data[0]['name']}}下周运程">下周运势</a>
                        <a href="javascript:void(0);" onclick="tday('month')" title="{{$data[0]['name']}}本月运势_{{$data[0]['name']}}本月运势查询_{{$data[0]['name']}}本月运程">本月运势</a>
                        <a href="javascript:void(0);" onclick="tday('year')" title="{{$data[0]['name']}}2018年运势_{{$data[0]['name']}}2018年运势查询_{{$data[0]['name']}}2018年运程">2018运势</a>
                        <div id="SIGN_NAV" class="sign_nav">
                            <a href="/getXingzuo/白羊座"><span class="by"></span>白羊座<small>3.21-4.20</small></a>
                            <a href="/getXingzuo/金牛座"><span class="jn"></span>金牛座<small>4.21-5.21</small></a>
                            <a href="/getXingzuo/双子座"><span class="sz"></span>双子座<small>5.22-6.21</small></a>
                            <a href="/getXingzuo/巨蟹座"><span class="jx"></span>巨蟹座<small>6.22-7.23</small></a>
                            <a href="/getXingzuo/狮子座"><span class="shz"></span>狮子座<small>7.24-8.23</small></a>
                            <a href="/getXingzuo/处女座"><span class="cn"></span>处女座<small>8.24-9.23</small></a>
                            <a href="/getXingzuo/天秤座"><span class="tc"></span>天秤座<small>9.24-10.23</small></a>
                            <a href="/getXingzuo/天蝎座"><span class="tx"></span>天蝎座<small>10.24-11.22</small></a>
                            <a href="/getXingzuo/射手座"><span class="ss"></span>射手座<small>11.23-12.21</small></a>
                            <a href="/getXingzuo/摩羯座"><span class="mj"></span>摩羯座<small>12.22-1.20</small></a>
                            <a href="/getXingzuo/水瓶座"><span class="sp"></span>水瓶座<small>1.21-2.19</small></a>
                            <a href="/getXingzuo/双鱼座"><span class="sy"></span>双鱼座<small>2.20-3.20</small></a>
                            <icon></icon>
                        </div>
                    </div>
                    <!-- 今日的运势 -->
                    <div class="Fortune today" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[0]['pic']}}" alt="{{$data[0]['name']}}" />
                                <span>{{$data[0]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[0]['name']}}今日运势<small>{{$data[0]['datetime']}}</small></h1>
                                <ul>
                                    <li>整体运势：<em class="star st_{{$data[0]['all']}}"></em></li>
                                    <li>幸运数字：<b>{{$data[0]['number']}}</b></li>
                                    <li>爱情运势：<em class="star st_{{$data[0]['love']}}"></em></li>
                                    <li>贵人星座：<b>{{$data[0]['QFriend']}}</b></li>
                                    <li>事业运势：<em class="star st_{{$data[0]['work']}}"></em></li>
                                    <li>幸运颜色：<b>{{$data[0]['color']}}</b></li>
                                    <li>财富运势：<em class="star st_{{$data[0]['money']}}"></em></li>
                                    <li>星座月份：<b>{{$data[0]['mon']}}</b></li>
                                    <li>健康运势：<em class="star st_{{$data[0]['health']}}"></em></li>

                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="dp">今日概述</span>
                                {{$data[0]['summary']}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 今日运势结束 -->
                    <!-- 明日的运势开始 -->
                    <div class="Fortune tomorrow" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[1]['pic']}}" alt="{{$data[1]['name']}}" />
                                <span>{{$data[1]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[1]['name']}}明日运势<small>{{$data[1]['datetime']}}</small></h1>
                                <ul>
                                    <li>整体运势：<em class="star st_{{$data[1]['all']}}"></em></li>
                                    <li>幸运数字：<b>{{$data[1]['number']}}</b></li>
                                    <li>爱情运势：<em class="star st_{{$data[1]['love']}}"></em></li>
                                    <li>贵人星座：<b>{{$data[1]['QFriend']}}</b></li>
                                    <li>事业运势：<em class="star st_{{$data[1]['work']}}"></em></li>
                                    <li>幸运颜色：<b>{{$data[1]['color']}}</b></li>
                                    <li>财富运势：<em class="star st_{{$data[1]['money']}}"></em></li>
                                    <li>星座月份：<b>{{$data[0]['mon']}}</b></li>
                                    <li>健康运势：<em class="star st_{{$data[1]['health']}}"></em></li>
                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="dp">明日概述</span>
                                {{$data[1]['summary']}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 明日运势结束 -->
                    <!-- 本周的运势开始 -->
                    <div class="Fortune week" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[2]['pic']}}" alt="{{$data[2]['name']}}" />
                                <span>{{$data[2]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[2]['name']}}本周运势<small>{{$data[2]['date']}}</small></h1>
                                <ul>
                                    <li>整体运势：<em class="star st_{{$data[1]['all']}}"></em></li>
                                    <li>幸运数字：<b>{{$data[0]['number']}}</b></li>
                                    <li>爱情运势：<em class="star st_{{$data[0]['love']}}"></em></li>
                                    <li>贵人星座：<b>{{$data[0]['QFriend']}}</b></li>
                                    <li>事业运势：<em class="star st_{{$data[1]['work']}}"></em></li>
                                    <li>幸运颜色：<b>{{$data[0]['color']}}</b></li>
                                    <li>财富运势：<em class="star st_{{$data[0]['money']}}"></em></li>
                                    <li>星座月份：<b>{{$data[0]['mon']}}</b></li>
                                    <li>健康运势：<em class="star st_{{$data[1]['health']}}"></em></li>

                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="zt">运势短评</span>
                                {{$data[0]['summary']}}
                            </p>
                             <p>
                                <span class="aq">爱情运势</span>
                                {{$data[2]['love']}}
                            </p>
                            <p>
                                <span class="sy">事业学业</span>
                                {{$data[2]['work']}}
                            </p>
                            <p>
                                <span class="cf">财富运势</span>
                                {{$data[2]['money']}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 本周运势结束 -->
                    <!-- 下周的运势开始 -->
                    <div class="Fortune nextweek" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[3]['pic']}}" alt="{{$data[3]['name']}}" />
                                <span>{{$data[3]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[3]['name']}}下周运势<small>{{$data[3]['date']}}</small></h1>
                                <ul>
                                    <li>整体运势：<em class="star st_{{$data[0]['all']}}"></em></li>
                                    <li>幸运数字：<b>{{$data[1]['number']}}</b></li>
                                    <li>爱情运势：<em class="star st_{{$data[1]['love']}}"></em></li>
                                    <li>贵人星座：<b>{{$data[1]['QFriend']}}</b></li>
                                    <li>事业运势：<em class="star st_{{$data[0]['work']}}"></em></li>
                                    <li>幸运颜色：<b>{{$data[1]['color']}}</b></li>
                                    <li>财富运势：<em class="star st_{{$data[1]['money']}}"></em></li>
                                    <li>星座月份：<b>{{$data[0]['mon']}}</b></li>
                                    <li>健康运势：<em class="star st_{{$data[0]['health']}}"></em></li>

                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="zt">运势短评</span>
                                {{$data[1]['summary']}}
                            </p>
                             <p>
                                <span class="aq">爱情运势</span>
                                {{$data[3]['love']}}
                            </p>
                            <p>
                                <span class="sy">事业学业</span>
                                {{$data[3]['work']}}
                            </p>
                            <p>
                                <span class="cf">财富运势</span>
                                {{$data[3]['money']}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 下周运势结束 -->
                    <!-- 本月的运势开始 -->
                    <div class="Fortune month" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[4]['pic']}}" alt="{{$data[4]['name']}}" />
                                <span>{{$data[4]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[4]['name']}}本月运势<small>{{$data[4]['date']}}</small></h1>
                                <ul>
                                    <li>整体运势：<em class="star st_{{$data[1]['all']}}"></em></li>
                                    <li>幸运数字：<b>{{$data[0]['number']}}</b></li>
                                    <li>爱情运势：<em class="star st_{{$data[1]['love']}}"></em></li>
                                    <li>贵人星座：<b>{{$data[0]['QFriend']}}</b></li>
                                    <li>事业运势：<em class="star st_{{$data[0]['work']}}"></em></li>
                                    <li>幸运颜色：<b>{{$data[0]['color']}}</b></li>
                                    <li>财富运势：<em class="star st_{{$data[1]['money']}}"></em></li>
                                    <li>星座月份：<b>{{$data[0]['mon']}}</b></li>
                                    <li>健康运势：<em class="star st_{{$data[1]['health']}}"></em></li>

                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="zt">运势短评</span>
                                {{$data[0]['summary']}}
                            </p>
                             <p>
                                <span class="aq">爱情运势</span>
                                {{$data[4]['love']}}
                            </p>
                            <p>
                                <span class="sy">事业学业</span>
                                {{$data[4]['work']}}
                            </p>
                            <p>
                                <span class="cf">财富运势</span>
                                {{$data[4]['money']}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 本月运势结束 -->
                    <!-- 本年的运势开始 -->
                    <div class="Fortune year" >
                        <div id="YUNSHI_TITLE" aid="11271" class="yunshi_summary">
                            <div class="logo0">
                                <img src="{{$data[5]['pic']}}" alt="{{$data[5]['name']}}" />
                                <span>{{$data[5]['name']}}</span>
                            </div>
                            <div class="info">
                                <h1>{{$data[5]['name']}}本年运势<small>{{$data[5]['date']}}</small></h1>
                                <ul>
                                    <li style="width: 500px">年度密码：<b>{{$data[5]['mima']['info']}}</b></li>

                                    <li>幸运饰品：<b>{{$data[5]['luckeyStone']}}</b></li>
                                    <li>&nbsp;</li>
                                    <li>星座月份：<b>{{$data[5]['mon']}}</b></li>
                                </ul>
                            </div>
                        </div>
                        <div class="yunshi_content">
                            <p>
                                <span class="zt">年度概述</span>
                                {{$data[5]['mima']['text'][0]}}
                            </p>
                             <p>
                                <span class="aq">爱情运势</span>
                                {{$data[5]['love'][0]}}
                            </p>
                            <p>
                                <span class="sy">事业学业</span>
                                {{$data[5]['career'][0]}}
                            </p>
                            <p>
                                <span class="cf">财富运势</span>
                                {{$data[5]['finance'][0]}}
                            </p>
                            <p>
                                <span class="jk">健康运势</span>
                                {{$data[5]['health'][0]}}
                            </p>
                            <br>
                        </div>
                    </div>
                    <!-- 本年运势结束 -->
                </div>

            </div>
        </div>
    <!-- <div class="knows shadow border mb30" style=" padding-top:3px;padding-left:12px;">
        <script type="text/javascript" src="/static/home/show/js/niaokhqxjlprx_3.js"></script>
    </div> -->
    <!-- <div class="knows shadow border mb30">
        <div class="ar_tit"> <span class="mark">相关日记</span> </div>
        <div class="lBox-tb lBox-List2-tb">
            <ul class="ulList">
                <li><a href="/" target="_blank" title=""></a></li>
            </ul>
        </div>
    </div> -->
</div>
    <div class="r-box">
        <div id="JscrollBox">
            <!-- <div class="mb30" style="width: 303px; height: 250px; background:white;">
                广告位置
                <script type="text/javascript">a300();</script>
            </div> -->
            <div class="relation shadow border tjzt mb30">
                <div class="list3_th"><span class="mark">星座列表</span></div>
                <ul class="red_ph">
                @foreach($xingzuo as $k=>$v)
                    @if( $k < 3 )
                    <li>
                        <span class="ar_onHot">{{$k+1}}</span>
                        <a href="/getXingzuo/{{$v->name}}" target="_blank" title="{{$v->name}}">{{$v->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$v->mon}}</a>
                    </li>
                    @else
                        <li>
                            <span class="ar_offHot">{{$k+1}}</span>
                            <a href="/getXingzuo/{{$v->name}}" target="_blank" title="{{$v->name}}">{{$v->name}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$v->mon}}</a>
                        </li>
                    @endif
                @endforeach
                </ul>
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
</div>


</div>


<script src="/static/home/show/js/dpl-tab_v2_3.js" type="text/javascript"></script>
<script type="text/javascript">
    //document.getElementById("click").innerHTML = document.getElementById("click_num").innerHTML;
</script>
<script type="text/javascript">
    $(".yunshi_nav>a").map(function(){
        $(this).click(function(){
            $(".yunshi_nav>a").removeClass('cur');
            $(this).addClass('cur');
        });
    });


     function tday(t){
        // alert($('this').html());
        $('.Fortune').css('display','none');
        $('.'+t).css('display','block');
    }
</script>
</body>
</html>

