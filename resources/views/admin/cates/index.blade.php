@extends('admin.AdminPublic.index')
@section('title','分类列表页面')
@section('container')
<!--右侧显示内容区域 开始-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                <li><a href="/bk_cates"><i class="fa fa-book"></i> 分类列表页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">分类列表</header>
                <div class="panel-body">
                    <div class="adv-table">
                        <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                            <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
                                <thead>
                                    <tr role="row">
                                        <th width="60">编号</th>
                                        <th>名称</th>
                                        <th>pid</th>
                                        <th>path</th>
                                        <th width="200">添加时间</th>
                                        <th width="200">修改时间</th>
                                        <th width="260">操作</th>
                                    </tr>
                                </thead>
                                <tbody role="alert" aria-live="polite" aria-relevant="all">
                                @foreach($cates as $k=>$v)
                                    @php
                                        $n = substr_count($v->path,',')+1;
                                    @endphp
                                    <tr class="gradeA odd">
                                        <td class="center">{{$v->id}}</td>
                                        <td class="sorting_1">
                                            {!!str_repeat('&nbsp;',4*$n)!!}|{{str_repeat('-',$n+1)}} {{$v->name}}
                                        </td>
                                        <td class="center">{{$v->pid}}</td>
                                        <td class="center hidden-phone ">{{$v->path}}</td>
                                        <td class="center hidden-phone ">{{date('Y-m-d H:i:s',$v->created_at)}}</td>
                                        <td class="center hidden-phone ">{{date('Y-m-d H:i:s',$v->updated_at)}}</td>
                                        <td class="center hidden-phone">
                                            @if($v->pid == '0')
                                                <a class="label label-primary" href="/bk_cates/add/{{$v->id}}">添加子类</a>&nbsp;
                                            @endif
                                            @if($v->status == '3' && $v->pid != '0')
                                                    <a class="label label-danger" href="/bk_cates/{{$v->id}}/cancelhost">取消热门</a>&nbsp;&nbsp;
                                            @elseif($v->status == '0' && $v->pid != '0')
                                                    <a class="label label-warning" href="/bk_cates/{{$v->id}}/signhot">标记热门</a>&nbsp;&nbsp;
                                            @endif
                                            <a class="label label-success" href="/bk_cates/edit-{{$v->id}}">修改</a>&nbsp;&nbsp;
                                            <a class="label label-warning" href="/bk_cates/del-{{$v->id}}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row-fluid">
                                <div class="span6" style="text-align: right;">
                                    {{$cates->render()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--右侧显示内容区域 结束-->
@endsection
