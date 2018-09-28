@extends('admin.AdminPublic.index')
@section('title','图片位设置列表')
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
                <li><a href="/bk_layout">排版管理</a></li>
                <li><a href="/bk_layout">排版列表</a></li>
                <li class="active">图片位设置</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="wrapper">
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <!-- 搜索  -->
                    <div class="panel-body col-sm-6">
                        <h4> {{$cates->name}} 类下列表</h4>
                    </div>
                    <div class="panel-body col-sm-6 text-right">
                        <form class="form-inline" role="form" method="get" action="/bk_layout">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">内容搜索</label>
                                <input type="text" class="form-control" id="exampleInputEmail2" placeholder="发布者/标题" name="keywords" />
                            </div>
                            <button type="submit" class="btn btn-primary">搜索</button>
                        </form>
                    </div>
                    <div class="panel-body" style="display: block;">
                        <table class="table  table-hover ">
                            <thead>
                                <tr>
                                    <th> ID</th>
                                    <th>标题</th>
                                    <th>图片位（是/否）</th>
                                    <th>图片</th>
                                    <th class="col-sm-2 " >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->title}}</td>
                                    <td>
                                        @if($v->recommand == 2)
                                        <span class="badge badge-success">是</span>
                                        @else
                                        <span class="badge badge-important">否</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{$v->img}}" width="200px;">
                                    </td>
                                    <td>
                                        <a class="label label-warning" id="add-without-image" href="/bk_layout/{{$v->id}}/img">图片位设定</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- 分页 -->
                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;" >
                                {{$data->appends($request)->render()}}
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--右侧显示内容区域 结束-->
@endsection
