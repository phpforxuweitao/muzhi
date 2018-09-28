@extends('admin.AdminPublic.index')
@section('title','广告页面')
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
                <li><a href="/bk_cates/add"><i class="fa fa-book"></i> 广告添加页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">广告添加</header>
                <div class="panel-body">
                    <div class="form">

                        <form class="cmxform form-horizontal adminex-form" method="post" action="/bk_ads/doadd" enctype="multipart/form-data">
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">广告名称</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="name" name="name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2" for="exampleInputFile">图片链接</label>
                                <input class="control-label col-lg-4" type="file" name="pic" id="file0" style="text-align: left">
                                <img class="control-label" style="height: 60px" src="" id="img0" alt="">
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">广告链接</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="url" name="url" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">广告位置</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="pos" name="pos" type="text">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="name" class="control-label col-lg-2">排序号</label>
                                <div class="col-lg-8">
                                    <input class="form-control" id="listorder" name="orderlist" type="text">
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