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
    @endif
    <!--右侧显示内容区域 开始-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb panel">
                    <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
                    <li><a href="/bk_cates/add"><i class="fa fa-book"></i> 分类添加页</a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">分类添加</header>
                    <div class="panel-body">
                        <div class="form">

                            <form class="cmxform form-horizontal adminex-form" method="post" action="/bk_cates/doadd">
                                <div class="form-group ">
                                    <label for="firstname" class="control-label col-lg-2">父类名称</label>
                                    <div class="col-lg-4">
                                        <select name="pid" class="form-control m-bot15">
                                            <option value="0">顶级类</option>
                                        @foreach($cates as $k=>$v)
                                            @php
                                                $n = substr_count($v->path,',')-1;
                                            @endphp

                                            <option value="{{$v->id}}" @if($v->id == $cate_id) selected @endif>{!!str_repeat('&nbsp;',4*$n)!!}|{{str_repeat('-',$n+1)}} {{$v->name}}</option>

                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label for="name" class="control-label col-lg-2">子类名称</label>
                                    <div class="col-lg-4">
                                        <input class="form-control" id="name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        {{csrf_field()}}
                                        <button class="btn btn-success col-xs-2" type="submit">添加</button>
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
@endsection
