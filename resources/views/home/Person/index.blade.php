@extends('home.PersonPublic.index')
@section('title','我的个人中心')
  <style type="text/css">

    #lean_overlay { position: fixed; z-index: 100; top: 0px; left: 0px; height: 100%; width: 100%; background: #000; display: none; }
    #OpenWindow { background: none repeat scroll 0 0 #FFFFFF; border-radius: 5px 5px 5px 5px; box-shadow: 0 0 4px rgba(0, 0, 0, 0.7); display: none; padding-bottom: 2px; width: 404px; z-index: 11000; left: 50%; margin-left: -202px; opacity: 1; position: fixed; top: 200px; }
    #OpenWindow-header {  border-bottom: 1px solid #CCCCCC; border-top-left-radius: 5px; border-top-right-radius: 5px; padding: 18px 18px 14px; }
    .modal_close { background: url("/static/home/index/images/modal_close.png") repeat scroll 0 0 transparent; display: block; height: 14px; position: absolute; right: 12px; top: 12px; width: 14px; z-index: 2; border-radius: 14px; }
    body { font-size: 13px; }

    #fcontent p{margin:10px 20px;text-indent: 2em}
    #OpenWindow .btn-fld { overflow: hidden; padding: 12px 36px 12px 180px; width: 254px;}
    button { background: none repeat scroll 0 0 #3F9D4A; border: medium none; border-radius: 4px 4px 4px 4px; color: #FFFFFF; font-family: Verdana; font-size: 13px; font-weight: bold; overflow: visible; padding: 7px 10px; text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4); width: auto; cursor: pointer; }
    h2{ font-weight: 500; }

  </style>
<div style="clear:both"></div>

 @section('container')
  <div class="ab_right">
    <div class="shop-nav"><a>会员中心</a></div>
    <div class="moudle-one new_moudle">

      <div class="infor-div clearfix">
        <div class="fl portrait"><img src="{{$data->uface}}" width="98" height="98"></div>
        <div class="kinds_of fl">
          <div class="name-user clearfix">
            <div class="notice-i fl"></div>
            <div class="say-hello fl"><span>{{$data->nickname}} ( ID：{{$data->name}} )</span></div>
            <div class="" target="" href="" style="width:120px;float:left;margin-left:10px">
              @if($score <= 1000)
                <i class="iconfont icon-dengji1" style="font-size: 16px; color: rgb(190, 190, 190)"></i>
              @elseif($score <= 2000 && $score > 1000)
                <i class="iconfont icon-dengji4" style="font-size: 16px; color: rgb(148, 220, 178)"></i>
              @elseif($score <= 3000 && $score > 2000)
                <i class="iconfont icon-dengji2" style="font-size: 16px; color: rgb(145, 208, 228)"></i>
              @elseif($score <= 4000 && $score > 3000)
                <i class="iconfont icon-dengji3" style="font-size: 16px; color: rgb(254, 178, 124)"></i>
              @else
                <i class="iconfont icon-dengji" style="font-size: 16px; color: rgb(255, 107, 8)"></i>
              @endif
              <a id="aOpen" href="#OpenWindow" rel="leanModal" title="点击了解详情"><i class="iconfont icon-iconfontquestion" style="color: #08B286"></i></a>
            </div>
          </div>
          <div class="kinds_state clearfix">
            <div class="every  fl">
              <i class="bd-qq every-i"></i>
              <div class="notice">
                <i class="triangle"></i>{{$data->qq}}
              </div>
            </div>
            <!--<div class="every  fl"> <a href="#"><i class="no-phone every-i"></i></a>
              <div class="notice"> <i class="triangle"></i>点击绑定</div>
            </div>-->
            <div class="every fl">
              <i class="bd-mail every-i"></i>
              <div class="notice" style="width: 200px">
                <i class="triangle"></i>{{$data->email}}
              </div>
            </div>
          </div>
          <div class="Balance  new_balance">
            <p class="fl">
              积分：<span id="jf">{{$data->score}}</span>
              人气：<span>{{$data->fame}}</span>
              粉丝：<span>{{$to_uid}}</span>
            </p>
            @foreach($qd as $v)
              @if($v->status == 0)
              <a href="javascript:void(0)" class="qd_btn fl" style="background: #04CE9B;">签到</a>
              @elseif($v->status == 1)
              <a href="javascript:void(0)" class="qd_btn fl">已签到</a>
              @endif
            @endforeach

          </div>
        </div>
        <div class="fl reply-box"> </div>
      </div>

      <div style="clear:both"></div>
      <div class="context">
      	<div class="zb_wrap">
          <div id="" class="pl_con">
            <div class="">
              <ul class="zb_list">
                <li class="zb_head zb">收到的评论</li>
              </ul>
            </div>
            <div class="pl_conTxt">
              <div class="">
              @foreach($comment_me as $rows)
                <ul id="dt_list" class="dt_list">
                  <li>
                    <span>{{date('m-d H:i',$rows->created_at)}}</span>
                    <a class="link" href="/ps_space/{{$rows->uid}}" target="_blank">{{$rows->nickname}}</a> 评论了文章
                    <a class="key_word" href="/list/{{$rows->id}}/show" target="_blank">{{$rows->title}}</a>
                  </li>
                </ul>
              @endforeach
              </div>
            </div>
          </div>
          <div id="" class="pl_con">
            <div class="">
              <ul class="zb_list">
                <li class="zb_head">会员动态</li>
              </ul>
            </div>
            <div class="pl_conTxt">
              <div class="">
              @foreach($comment as $row)
                <ul id="dt_list" class="dt_list">
                  <li>
                    <span>{{date('m-d H:i',$row->created_at)}}</span>
                    <a class="link" href="/ps_space/{{$row->uid}}" target="_blank">{{$row->nickname}}</a> 评论了文章
                    <a class="key_word" href="/list/{{$row->id}}/show" target="_blank">{{changeStr($row->title,12,'...')}}</a>
                  </li>
                </ul>
              @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="OpenWindow">
    <div id="signup-ct">
      <div id="OpenWindow-header">
        <h2>积分等级介绍</h2>
        <a href="javascript:void(0)" class="modal_close closess"></a>
      </div>
        <div id="fcontent">
          <p>积分0-1000会员等级为1级，积分1001-2000会员等级为2级，积分2001-3000会员等级为3级，积分3001-4000会员等级为4级，积分4000以上会员等级为5级，会员等级升级后，积分不清零</p>
        </div>
        <div class="btn-fld">
            <button type="button" class="closess">确定</button>
        </div>
    </div>
  </div>
<script>
  $('.qd_btn').click(function(){
    qd = $(this);
    $.get('/ps_index/qiandao',{},function(data){
      if(data.code == 1){
        alert('签到成功，获得'+data.num+'积分');
        qd.text('已签到');
        qd.css('background','#ff7e69');
        $('#jf').text(data.score);
      }else if(data == 0){
        alert('今日已签到过,请不要重复签到');
      }
    },'json');
  });

  $(document).ready(function () {
      //$('#aOpen').leanModal({ top: 100, closeButton: ".modal_close" });
      $('a[rel*=leanModal]').leanModal({ top: 100, closeButton: ".closess" });
  });
</script>
@endsection
