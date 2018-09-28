@extends('admin.AdminPublic.index')
@section('title','分类添加页面')
@section('container')
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setInterval(function(){
                $(".close").trigger('click');
            },2000);
        </script>
    @endif
    <!--右侧显示内容区域 开始-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb panel">
                    <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                    <li><a href="#">内容管理</a></li>
                    <li class="active">日记修改页面</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">日记修改</header>
                    <div class="panel-body">
                        <div class="form">
                            <form class="cmxform form-horizontal adminex-form" method="post" action="/bk_content/riji/rijieditsave">
                                <div class="form-group ">
                                    <label for="firstname" class="control-label col-xs-1">类别</label>
                                    <div class="col-xs-2">
                                        <select name="cid" class="form-control m-bot15">
                                            @foreach($cate_data as $k=>$v)
                                                @php
                                                    $n = substr_count($v->path,',')-1;
                                                @endphp
                                                <option value="{{$v->id}}" @if($v->pid=='0') disabled @endif >{!! str_repeat('&nbsp;',4*$n) !!}|{!! str_repeat('-',$n+1) !!} {{$v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="firstname" class="control-label col-xs-1">星期</label>
                                    <div class="col-xs-2">
                                        <select name="week" class="form-control m-bot15">
                                            <option value="星期一" @if($info->week == '星期一') selected @endif>星期一</option>
                                            <option value="星期二" @if($info->week == '星期二') selected @endif>星期二</option>
                                            <option value="星期三" @if($info->week == '星期三') selected @endif>星期三</option>
                                            <option value="星期四" @if($info->week == '星期四') selected @endif>星期四</option>
                                            <option value="星期五" @if($info->week == '星期五') selected @endif>星期五</option>
                                            <option value="星期六" @if($info->week == '星期六') selected @endif>星期六</option>
                                            <option value="星期日" @if($info->week == '星期日') selected @endif>星期日</option>
                                        </select>
                                    </div>
                                    <label for="firstname" class="control-label col-xs-1">天气</label>
                                    <div class="col-xs-2">
                                        <select name="weather" class="form-control m-bot15">
                                            <option value="晴" @if($info->weather == '晴') selected @endif>晴</option>
                                            <option value="多云" @if($info->weather == '多云') selected @endif>多云</option>
                                            <option value="阴" @if($info->weather == '阴') selected @endif>阴</option>
                                            <option value="雨" @if($info->weather == '雨') selected @endif>雨</option>
                                            <option value="雪" @if($info->weather == '雪') selected @endif>雪</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="name" class="control-label col-xs-1">标题</label>
                                    <div class="col-xs-6">
                                        <input class="form-control" id="title" name="title" type="text" value="{{$info->title}}">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="name" class="control-label col-xs-1">日记内容</label>
                                    <div class="col-xs-4">
                                        <div id="editorCont" name="content" type="text/plain" style="width: 800px;height: 400px;" ></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-1 col-xs-11">
                                        {{csrf_field()}}
                                        <input type="hidden" name="con_id" value="{{$info->id}}">
                                        <button class="btn btn-success col-xs-2" type="submit">修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--右侧显示内容区域 结束-->
<script type="text/javascript">
    var ue = UE.getEditor('editorCont',{
        toolbars:[
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
        ],
        enableContextMenu:false,    //内容区域右击菜单 默认为true
        elementPathEnabled:false,   //是否启用元素路径，默认是显示
        maximumWords:1000,          //允许的最大字符数
        wordCountMsg:'{#count} / {#leave} 字',   //输入字体数提示
        allowDivTransToP: false
    });
    ue.addListener('ready',function(){
        ue.setContent('{{strip_tags($info->content)}}');
    });
    uParse('#editorCont',{
        rootPath: '/static/ueditor/'
    });
</script>
@endsection