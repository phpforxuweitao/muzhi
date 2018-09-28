@extends('admin.AdminPublic.index')
@section('title','管理员管理-角色添加')
@section('container')

<!-- 右侧顶部搜索部分 开始 -->
@include('admin.AdminPublic.header')
<!-- 右侧顶部搜索部分 结束 -->
<!-- 右侧顶部链接导航区域 开始 -->
	<div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb panel">
                    <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                    <li><a href="/bk_/role">管理员管理</a></li>
                    <li class="active">角色添加</li>
                </ul>
                <!--breadcrumbs end -->
            </div>
   </div>
  @if (count($errors) > 0)
   <div class="alert alert-warning fade in">
          <button type="button" class="close close-sm" data-dismiss="alert">
              <i class="fa fa-times"></i>
          </button>
          @foreach ($errors->all() as $error)
            <strong>{{ $error }}...</strong>

          @endforeach
    </div>
  @endif
<div class="wrapper ">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    添加角色和权限
                </header>
                <div class="panel-body">
                    <form id="fm_role" class="form-horizontal adminex-form" method="post" action="/bk_role/add">
                        <div class="form-group ">
                            <label class="col-lg-2 control-label">角色名：</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="" id="f-name" class="form-control" name="name">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-lg-2 control-label">角色管理描述：</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="" id="email2" class="form-control" name="remark">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">选择：</label>
                            <div class="col-lg-8">
                                <button class="btn btn-success btn-sm" id="chooseAll" type="button">全选</button>
                                <button class="btn btn-default btn-sm" id="chooseNone" type="button">全不选</button>
                                <button class="btn btn-info btn-sm" id="chooseReverse" type="button">反选</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">权限分配：</label>
                            <div class="col-lg-8" id="box_ipt">
                            @foreach($node as $v)
                                <label class="checkbox col-lg-3">
                                    <input type="checkbox" value="{{$v->id}}" name="role[] ">
                                    {{$v->name}}
                                </label>
                            @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-8">
                                {{csrf_field()}}
                                <input  class="btn btn-primary" type="submit" value="提交">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<script>
$(function(){
    //阻止form表单中所有input的回车时间
    $("#fm_role").find("input").each(function(){
        $(this).keydown(function(ev){
            if ( ev.keyCode === 13 ) {
                return false;
            }
        });
    });

    let $chooseAll      = $("#chooseAll");//权限全选按钮
    let $chooseReverse  = $("#chooseReverse");//权限反选按钮
    let $chooseNone     = $("#chooseNone");//权限全不选按钮
    let $ipt_box        = $("#box_ipt");//所有的选项列表的父类
    let $ipts           = $ipt_box.find("label>input[type='checkbox']");//所有的复选框

    //全选操作
    $chooseAll.on('click',function(){
        $ipts.attr('checked',true);
    });
    //全部选操作
    $chooseNone.on('click',function(){
        $ipts.attr('checked',false);
    });
    //反选按钮
    $chooseReverse.on('click',function(){
        $ipts.each(function(){
            if ( $(this).attr('checked') ) {
                $(this).attr('checked',false);
            } else {
                $(this).attr('checked',true);
            }
        });
    });

});
</script>
<!--右侧显示内容区域 结束-->
@endsection
