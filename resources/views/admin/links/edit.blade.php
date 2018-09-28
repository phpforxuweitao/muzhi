@extends('admin.AdminPublic.index')
@section('title','友情链接页面')
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
                <li><a href=""><i class="fa fa-book"></i> 友情链接修改页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12"> 
            <section class="panel">
                <header class="panel-heading">友情链接编辑</header>   
                <div class="panel-body">
                    <div class="wrapper">
                        <div class="col-lg">   
                            <div class="panel-body">
                                <form action="/bk_links/doedit" method="post">
                                    <input type="hidden" name="id" value="{{$edit->id}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">友情链接名称 : </label>
                                        <input type="text" class="form-control" style="width:60%" value="{{$edit->name}}" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">友情链接url : </label>
                                        <input type="text" class="form-control" style="width:60%" value="{{$edit->url}}" name="url">
                                    </div>
                                    {{csrf_field()}} 
                                    <button type="submit" class="btn btn-primary">修改</button>
                                </form>
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