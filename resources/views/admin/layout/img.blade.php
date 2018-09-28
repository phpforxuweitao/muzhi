@extends('admin.AdminPublic.index')
@section('title','内容图片设定页')
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
                    <li><a href="/bk_layout"><i class="fa fa-book"></i> 排版管理</a></li>
                    <li><a href="/bk_layout/{id}/img"><i class="fa fa-book"></i> 图片设定页</a></li>
                </ul>
                <!--breadcrumbs end -->
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">图片设定添加</header>
                    <div class="panel-body">
                        <div class="form">

                            <form class="cmxform form-horizontal adminex-form" method="post" action="/bk_layout/doimg" enctype="multipart/form-data">
                                <div class="form-group ">
                                    <label class="col-lg-2 control-label">文章标题：</label>
                                    <div class="col-lg-8">
                                        <input class="form-control" id="disabledInput" type="text" placeholder="" disabled="" value="{{$data->title}}">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <div class="form-group">
                                    <label class="control-label col-lg-2" for="exampleInputFile">设定图片</label>
                                    <input class="control-label col-lg-4" type="file" name="img" id="file0">
                                    <img class="control-label" style="height: 60px" src="" id="img0" alt="">
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">是否设推荐位 : </label>
                                    <div class="col-lg-8">
                                         <input class="control-label" type="radio" value="3" name="recommand" checked>上架
                                         <input class="control-label" type="radio" value="0" name="recommand" >下架
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-offset-2 col-xs-10">
                                        {{csrf_field()}}
                                        <button class="btn btn-success col-xs-2" type="submit">设置</button>
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
