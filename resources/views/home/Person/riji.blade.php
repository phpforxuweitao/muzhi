@extends('home.PersonPublic.index')
@section('title','日记投稿')
 @section('container')
  <div class="ab_right">
    <div class="shop-nav"><a>日记投稿</a></div>
    <div class="add_con">
      <form name="form1" action="/ps_riji/doadd" method="post" enctype="multipart/form-data">
        <input name="uname" value="admin" type="hidden">
        <input name="writer" class="author_ipt" id="writer" size="30" value="一年级小学生" type="hidden">
        <div class="form_top1">
          <div class="top1Left" style="width: 620px">
            <div id="selects" style="width: 220px;height: 30px;float: left;">
              <select name="cid" id="" class="selecting" style="width: 150px;height: 30px;border-radius: 4px;">
                @foreach($data as $v)
                <option value="{{$v->id}}" class="options">{{$v->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="selects" style="width: 190px;height: 30px;float: left;">
              <select name="week" id="" class="selecting" style="width: 120px;height: 30px;border-radius: 4px;">
                <option value="星期一" class="options">星期一</option>
                <option value="星期二" class="options">星期二</option>
                <option value="星期三" class="options">星期三</option>
                <option value="星期四" class="options">星期四</option>
                <option value="星期五" class="options">星期五</option>
                <option value="星期六" class="options">星期六</option>
                <option value="星期日" class="options">星期日</option>
              </select>
            </div>
            <div class="selects" style="width: 200px;height: 30px;float: left;">
              <select name="weather" id="" class="selecting" style="width: 120px;height: 30px;border-radius: 4px;">
                <option value="晴" class="options">晴</option>
                <option value="多云" class="options">多云</option>
                <option value="阴" class="options">阴</option>
                <option value="雨" class="options">雨</option>
                <option value="雪" class="options">雪</option>
              </select>
            </div>
            <div class="publish-title" style="clear: both">
              <input name="title" title="请输入日记标题" id="title" placeholder="请输入日记标题" type="text">
            </div>
          </div>
          <!--<div class="top1Right">

            <div class="rj_sx">字数：<span id="counter" style="color:#F00">0</span>字</div>
          </div>-->
          <div class="clear"></div>
        </div>
        <script id="editor" type="text/plain"  name="content" style="width:700px;height:300px;position:relative;z-index: 10"></script> 
        <div class="button_area">
          <input name="dede_addonfields" value="" type="hidden">
          {{csrf_field()}}
          <input name="dede_fieldshash" value="e52d77bcf131d8cb793501dc3758c148" type="hidden">          
          <button class="editPassword-reset" type="submit" id="btnSubmit" style="margin-right: 50px">提交</button>
        </div>
        <div class="clear"></div>
      </form>
    </div>
  </div>
</div>


<div id="winpop" style="height: 0px; display: none; z-index: 100">
 <div class="title">《木知网》投稿须知<span class="close" onclick="tips_pop()">X</span></div>
    <div class="con">
    ① 要求内容原创<br>
    ② 请认真选择年级分类<br>
    ③ 投稿前请备份，未通过的投稿会被直接删除<br>
    ④ <font color="#FF7E69"> <strong>转载抄袭，可能会被扣除积分、限制投稿！</strong></font>
    </div>
</div>
<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('editor',{toolbars:[
            [
                'undo', //撤销
                'redo', //重做
                'fontfamily', //字体
                'fontsize', //字号
                'forecolor', //字体颜色
                'backcolor', //背景色
                'indent', //首行缩进
                'bold', //加粗
                'italic', //斜体
                'underline', //下划线
                'strikethrough', //删除线
                'horizontal', //分隔线
                'link', //超链接
                'searchreplace', //查询替换
                'rowspacingtop', //段前距
                'rowspacingbottom', //段后距
                'lineheight', //行间距
            ]
        ]});
</script>
@endsection

