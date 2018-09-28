@extends('admin.AdminPublic.index')
@section('title','排版管理')
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
                <li><a href="#">排版管理</a></li>
                <li class="active">排版列表</li>
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
                        <h4>排版列表</h4>
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
                                    <th>排版类别</th>
                                    <th>状态</th>
                                    <th>排版位置</th>
                                    <th class="col-sm-3 text-center" >操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                        @if($v->status == 0)
                                        <span class="badge badge-success">正常</span>
                                        @elseif($v->status == 1)
                                        <span class="badge badge-important">禁用</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($v->position == 0)
                                        <span class="badge">未排版</span>
                                        @elseif($v->position == 1)
                                        <span class="badge badge-warning">1号位</span>
                                        @elseif($v->position == 2)
                                        <span class="badge badge-primary">2号位</span>
                                        @elseif($v->position == 3)
                                        <span class="badge badge-success">3号位</span>
                                        @elseif($v->position == 4)
                                        <span class="badge badge-info">4号位</span>
                                        @elseif($v->position == 5)
                                        <span class="badge badge-inverse">5号位</span>
                                        @elseif($v->position == 6)
                                        <span class="badge badge-important">6号位</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="label label-warning" id="add-without-image" href="/bk_layout/{{$v->id}}/edit">位置调整</a>
                                         <a class="label label-danger" id="add-without-image" href="/bk_layout/{{$v->id}}/show">排版详情</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- 分页 -->
                        <div class="row">
                            <div class="col-xs-12" style="text-align: right;" >

                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
    <!--右侧显示内容区域 结束-->
@endsection
