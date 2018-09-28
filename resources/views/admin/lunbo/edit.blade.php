@extends('admin.AdminPublic.index')
@section('title','轮播图页面')
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
                <li><a href=""><i class="fa fa-book"></i> 轮播图修改页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    轮播图修改页
                </header>
                <div class="panel-body">
                    <form role="form" action="/bk_lunbo/doedit" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group">
                            <label for="exampleInputFile">图片链接</label>
                            <input type="file" name="pic" id="file0"><br>
                            <img style="width:100px" src="{{$data->pic}}" id="img0" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">轮播图链接</label>
                            <input type="text" name="url" value="{{$data->url}}" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">排序号</label>
                            <input type="text" name="listorder" value="{{$data->orderlist}}" class="form-control" id="exampleInputPassword1">
                        </div>
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-success">修改</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>

<!--右侧显示内容区域 结束-->
@endsection